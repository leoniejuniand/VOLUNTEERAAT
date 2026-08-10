<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Secretariat;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Menampilkan daftar kegiatan
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            $events = Event::with('secretariat')->latest()->get();
        } else {
            $events = Event::with('secretariat')
                           ->where('secretariat_id', $user->secretariat_id)
                           ->latest()->get();
        }

        return view('admin.events.index', compact('events'));
    }

    // Menampilkan form tambah kegiatan
    public function create()
    {
        $secretariats = Secretariat::all();
        return view('admin.events.create', compact('secretariats'));
    }

    // Menyimpan kegiatan baru ke database
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar (maks 2MB)
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'secretariat_id' => $user->hasRole('super_admin') ? 'required|exists:secretariats,id' : 'nullable',
            'registration_deadline' => 'nullable|date',
            'quota' => 'nullable|integer|min:1',
        ]);

        $secretariat_id = $user->hasRole('super_admin') ? $request->secretariat_id : $user->secretariat_id;

        // Proses unggah gambar jika ada
        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('event_posters', 'public');
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover_image' => $imagePath, // Simpan path gambar ke database
            'event_date' => $request->event_date,
            'location' => $request->location,
            'secretariat_id' => $secretariat_id,
            'status' => 'Buka',
            'registration_deadline' => $request->registration_deadline,
            'quota' => $request->quota,
        ]);

        return redirect()->route('events.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }
    // Menampilkan form edit kegiatan
    public function edit(Event $event)
    {
        $user = Auth::user();

        // Keamanan: Admin Sekre hanya bisa edit kegiatan dari sekre-nya sendiri
        if ($user->hasRole('admin_sekre') && $event->secretariat_id != $user->secretariat_id) {
            abort(403, 'Akses ditolak. Anda tidak bisa mengedit kegiatan dari sekretariat lain.');
        }

        $secretariats = Secretariat::all();
        return view('admin.events.edit', compact('event', 'secretariats'));
    }

    // Menyimpan perubahan kegiatan
    public function update(Request $request, Event $event)
    {
        $user = Auth::user();

        if ($user->hasRole('admin_sekre') && $event->secretariat_id != $user->secretariat_id) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'status' => 'required|string',
            'secretariat_id' => $user->hasRole('super_admin') ? 'required|exists:secretariats,id' : 'nullable',
            'registration_deadline' => 'nullable|date',
            'quota' => 'nullable|integer|min:1',
        ]);

        $secretariat_id = $user->hasRole('super_admin') ? $request->secretariat_id : $user->secretariat_id;

        // Proses unggah gambar baru jika ada
        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama jika ada
            if ($event->cover_image) {
                Storage::disk('public')->delete($event->cover_image);
            }
            $imagePath = $request->file('cover_image')->store('event_posters', 'public');
            $event->cover_image = $imagePath;
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'status' => $request->status,
            'secretariat_id' => $secretariat_id,
            'registration_deadline' => $request->registration_deadline,
            'quota' => $request->quota,
        ]);

        return redirect()->route('events.index')->with('success', 'Kegiatan berhasil diperbarui!');
    }
    // Menghapus kegiatan
    public function destroy(Event $event)
    {
        $user = Auth::user();

        if ($user->hasRole('admin_sekre') && $event->secretariat_id != $user->secretariat_id) {
            abort(403, 'Akses ditolak.');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Kegiatan berhasil dihapus!');
    }

    // FUNGSI : Menampilkan daftar pendaftar di suatu kegiatan
    public function participants(Event $event)
    {
        $user = Auth::user();

        // Keamanan: Admin Sekre hanya bisa melihat pendaftar di kegiatannya sendiri
        if ($user->hasRole('admin_sekre') && $event->secretariat_id != $user->secretariat_id) {
            abort(403, 'Akses ditolak.');
        }

        // Ambil data pendaftaran beserta data user-nya
        $registrations = EventRegistration::with('user')->where('event_id', $event->id)->get();
        
        return view('admin.events.participants', compact('event', 'registrations'));
    }

    // FUNGSI : Mengubah status pendaftaran (Terima/Tolak)
    public function updateRegistrationStatus(Request $request, EventRegistration $registration)
    {
        $user = Auth::user();
        $event = $registration->event;

        if ($user->hasRole('admin_sekre') && $event->secretariat_id != $user->secretariat_id) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'status' => 'required|string',
            'is_present' => 'required|boolean', // Validasi absensi
        ]);

        $registration->update([
            'status' => $request->status,
            'is_present' => $request->is_present, // Simpan absensi
        ]);

        return back()->with('success', 'Status pendaftar berhasil diperbarui!');
    }

    // FUNGSI BARU: Download Data Peserta (CSV/Excel)
    public function exportParticipants(Event $event)
    {
        $user = Auth::user();

        // Keamanan: Admin Sekre hanya bisa export data kegiatannya sendiri
        if ($user->hasRole('admin_sekre') && $event->secretariat_id != $user->secretariat_id) {
            abort(403, 'Akses ditolak.');
        }

        // Ambil data pendaftaran yang sudah Diterima atau Menunggu
        $registrations = EventRegistration::with('user')->where('event_id', $event->id)->get();

        $fileName = 'Rekap_Peserta_' . Str::slug($event->title) . '.csv';
        
        // Header untuk memaksa browser mengunduh file
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Nama-nama kolom di Excel nanti
        $columns = ['No', 'Nama Relawan', 'Email', 'No WhatsApp', 'Instansi', 'Waktu Daftar', 'Status', 'Kehadiran'];

        // Proses penulisan data ke dalam file CSV
        $callback = function() use($registrations, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); // Tulis header kolom

            $row = 1;
            foreach ($registrations as $reg) {
                fputcsv($file, [
                    $row++,
                    $reg->user->name,
                    $reg->user->email,
                    $reg->user->whatsapp_number ?? '-',
                    $reg->user->institution ?? '-',
                    $reg->created_at->format('Y-m-d H:i'),
                    $reg->status,
                    $reg->is_present ? 'Hadir' : 'Tidak Hadir'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}