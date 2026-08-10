<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secretariat;

class SecretariatController extends Controller
{
    // Menampilkan daftar sekretariat
    public function index()
    {
        $secretariats = Secretariat::withCount('users', 'events')->get();
        return view('admin.secretariats.index', compact('secretariats'));
    }

    // Menyimpan sekretariat baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:secretariats,name',
        ]);

        Secretariat::create([
            'name' => $request->name,
        ]);

        return redirect()->route('secretariats.index')->with('success', 'Sekretariat baru berhasil ditambahkan!');
    }

    // Menghapus sekretariat
    public function destroy(Secretariat $secretariat)
    {
        // Cegah penghapusan jika masih ada user atau kegiatan yang terikat
        if ($secretariat->users()->count() > 0 || $secretariat->events()->count() > 0) {
            return redirect()->route('secretariats.index')->with('error', 'Tidak dapat menghapus sekretariat karena masih ada Relawan atau Kegiatan yang terdaftar di dalamnya.');
        }

        $secretariat->delete();

        return redirect()->route('secretariats.index')->with('success', 'Sekretariat berhasil dihapus!');
    }
}