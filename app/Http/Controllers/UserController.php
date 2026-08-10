<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\Secretariat;

class UserController extends Controller
{
public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            $users = User::with('secretariat', 'roles')->get();
        } else {
            $users = User::with('secretariat', 'roles')
                         ->where('secretariat_id', $user->secretariat_id)
                         ->get();
        }

        return view('admin.users.index', compact('users'));
    }

    // FUNGSI BARU: Menampilkan halaman form edit
    public function edit(User $user)
    {
        $currentUser = Auth::user();

        // Keamanan: Admin Sekre hanya boleh edit relawan dari sekre-nya sendiri
        if ($currentUser->hasRole('admin_sekre') && $currentUser->secretariat_id != $user->secretariat_id) {
            abort(403, 'Anda tidak berhak mengedit data relawan dari sekretariat lain.');
        }

        $roles = Role::all();
        $secretariats = Secretariat::all();

        return view('admin.users.edit', compact('user', 'roles', 'secretariats'));
    }

    // FUNGSI BARU: Menyimpan perubahan data ke database
    public function update(Request $request, User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->hasRole('admin_sekre') && $currentUser->secretariat_id != $user->secretariat_id) {
            abort(403);
        }

        $request->validate([
            'role' => 'required',
            'secretariat_id' => 'nullable|exists:secretariats,id',
        ]);

        // Ganti Role
        $user->syncRoles([$request->role]);

        // Ganti Sekretariat
        $user->update([
            'secretariat_id' => $request->secretariat_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Data relawan berhasil diperbarui!');
    }
    }