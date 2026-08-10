<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Secretariat;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
{
    $secretariats = Secretariat::all();
    return view('auth.register', compact('secretariats'));
}

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        'secretariat_id' => ['required', 'exists:secretariats,id'], // Validasi pilihan sekre
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'secretariat_id' => $request->secretariat_id, // Simpan sekre yang dipilih
    ]);

    // Berikan hak akses (role) sebagai relawan secara otomatis
    $user->assignRole('relawan');

    event(new \Illuminate\Auth\Events\Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}
