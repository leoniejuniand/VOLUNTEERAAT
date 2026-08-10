<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VolunteerEventController;
use App\Http\Controllers\SecretariatController;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $stats = [];

    if ($user->hasRole('super_admin')) {
        // Statistik Super Admin (Seluruh Cabang)
        $stats['total_relawan'] = User::role('relawan')->count();
        $stats['total_kegiatan'] = Event::count();
        $stats['total_pendaftar'] = EventRegistration::count();
    } elseif ($user->hasRole('admin_sekre')) {
        // Statistik Admin Sekre (Hanya Cabangnya Sendiri)
        $stats['total_relawan'] = User::role('relawan')->where('secretariat_id', $user->secretariat_id)->count();
        $stats['total_kegiatan'] = Event::where('secretariat_id', $user->secretariat_id)->count();
        
        // Menghitung pendaftar khusus di kegiatan milik sekre ini
        $stats['total_pendaftar'] = EventRegistration::whereHas('event', function($query) use($user) {
            $query->where('secretariat_id', $user->secretariat_id);
        })->count();
    } else {
        // Statistik Relawan
        $stats['total_diikuti'] = EventRegistration::where('user_id', $user->id)->count();
        $stats['total_diterima'] = EventRegistration::where('user_id', $user->id)->where('status', 'Diterima')->count();
        $stats['kegiatan_tersedia'] = Event::where('secretariat_id', $user->secretariat_id)->where('status', 'Buka')->count();
    }

    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware(['role:super_admin|admin_sekre'])->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::resource('events', EventController::class);
                // Rute Manajemen Pendaftar Kegiatan
            Route::get('/events/{event}/participants', [EventController::class, 'participants'])->name('events.participants');
            Route::put('/event-registrations/{registration}', [EventController::class, 'updateRegistrationStatus'])->name('events.registrations.update');
     });
     // RUTE KHUSUS SUPER ADMIN
    Route::middleware(['role:super_admin'])->group(function () {
        Route::get('/secretariats', [SecretariatController::class, 'index'])->name('secretariats.index');
        Route::post('/secretariats', [SecretariatController::class, 'store'])->name('secretariats.store');
        Route::delete('/secretariats/{secretariat}', [SecretariatController::class, 'destroy'])->name('secretariats.destroy');
    });
     // RUTE UNTUK RELAWAN
    Route::middleware(['role:relawan'])->group(function () {
            Route::get('/kegiatan-tersedia', [VolunteerEventController::class, 'index'])->name('volunteer.events.index');
            Route::post('/kegiatan-tersedia/{event}/daftar', [VolunteerEventController::class, 'register'])->name('volunteer.events.register');
            Route::get('/riwayat-kegiatan', [VolunteerEventController::class, 'history'])->name('volunteer.events.history');
    });
});

require __DIR__.'/auth.php';
