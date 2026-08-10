<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VolunteerEventController extends Controller
{
    // Menampilkan daftar kegiatan yang tersedia untuk relawan
    public function index()
    {
        $user = Auth::user();

        // Ambil kegiatan HANYA dari sekretariat relawan tersebut yang berstatus "Buka"
        $events = Event::with('secretariat')
                    ->withCount('registrations') 
                    ->where('secretariat_id', $user->secretariat_id)
                    ->where('status', 'Buka')
                    ->latest()
                    ->get();

        // Ambil ID kegiatan yang sudah pernah didaftar oleh relawan ini (agar tombol berubah menjadi "Sudah Terdaftar")
        $registeredEventIds = $user->registrations()->pluck('event_id')->toArray();

        return view('events.index', compact('events', 'registeredEventIds'));
    }

    // Memproses pendaftaran ketika tombol diklik
    public function register(Event $event)
    {
        $user = Auth::user();

        // Keamanan: Cek apakah relawan sudah pernah mendaftar ke kegiatan ini
        if ($user->registrations()->where('event_id', $event->id)->exists()) {
            return back()->with('error', 'Anda sudah terdaftar di kegiatan ini.');
        }

            // Cek Deadline
        if ($event->registration_deadline && now()->greaterThan($event->registration_deadline)) {
            return back()->with('error', 'Pendaftaran sudah ditutup karena melewati batas waktu.');
        }

        // Cek Kuota
        if ($event->quota && $event->registrations()->count() >= $event->quota) {
            return back()->with('error', 'Mohon maaf, kuota pendaftaran kegiatan ini sudah penuh.');
        }

        // Simpan data pendaftaran
        EventRegistration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => 'Menunggu Konfirmasi',
        ]);

        return back()->with('success', 'Berhasil mendaftar! Silakan tunggu konfirmasi dari Admin.');
    }

    // FUNGSI : Menampilkan riwayat pendaftaran relawan
    public function history()
    {
        $user = Auth::user();

        // Ambil data pendaftaran milik relawan ini beserta detail kegiatannya
        $registrations = EventRegistration::with('event.secretariat')
                            ->where('user_id', $user->id)
                            ->latest()
                            ->get();

        return view('events.history', compact('registrations'));
    }
}