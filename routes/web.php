<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LupaPasswordController;
use App\Http\Controllers\Profil\ProfilController;
use App\Http\Controllers\Profil\EditProfilController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Event\CariEventController;
use App\Http\Controllers\Event\FilterEventController;
use App\Http\Controllers\Event\EventDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TiketSaya\TiketSayaController;
use App\Http\Controllers\TiketSaya\DetailTiketSayaController;
use App\Http\Controllers\PesanTiketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Admin\AdminLihatEventController;
use App\Http\Controllers\Admin\AdminRekapPenjualanController;
use App\Http\Controllers\Admin\AdminBuatEventController;
use App\Http\Controllers\Admin\AdminEditEventController;
use App\Http\Controllers\Admin\AdminTutupEventController;


// Landing / Dashboard (untuk guest & user)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// AUTH GUEST
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

    Route::get('/register/otp', [RegisterController::class, 'showOtpForm'])->name('otp.form');
    Route::post('/register/otp', [RegisterController::class, 'verifyOtp'])->name('otp.verify');
    Route::get('/register/otp/resend', [RegisterController::class, 'resendOtp'])->name('otp.resend');

    // Lupa password
    Route::get('/forgot-password', [LupaPasswordController::class, 'forgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [LupaPasswordController::class, 'sendResetLink'])->name('password.email');

    // Reset password
    Route::get('/reset-password/{token}', [LupaPasswordController::class, 'resetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [LupaPasswordController::class, 'updatePassword'])->name('password.update');
});

// AUTH LOGIN
Route::middleware('auth')->group(function () {

    // keperluan user login misalnya edit profil dll nanti di sini

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Halaman profil utama
    Route::get('/profile', [ProfilController::class, 'index'])->name('profile');

    // Edit profil
    Route::get('/profile/edit', [EditProfilController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [EditProfilController::class, 'updateProfile'])->name('profile.update');

    // Ganti password
    Route::get('/profile/change-password', [EditProfilController::class, 'changePasswordForm'])->name('profile.password');
    Route::post('/profile/change-password', [EditProfilController::class, 'updatePassword'])->name('profile.password.update');




});

Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/event/{slug}', [EventDetailController::class, 'show'])->name('events.detail');

// Search
Route::get('/cari-event', [CariEventController::class, 'search'])->name('events.search');

// Filter
Route::get('/filter-event', [FilterEventController::class, 'filter'])->name('events.filter');

Route::middleware('auth')->group(function () {

    Route::get('/tiket-saya', [TiketSayaController::class, 'index'])
        ->name('tiket.saya');

    Route::get('/tiket-saya/{order_id}', [DetailTiketSayaController::class, 'show'])
        ->name('tiket.saya.detail');
});

Route::middleware('auth')->group(function () {

    // Form Checkout
    Route::get('/pesan-tiket', [PesanTiketController::class, 'checkout'])
        ->name('pesan.checkout');

    // Submit Pembelian -> Halaman pilih pembayaran
    Route::post('/pesan-tiket/proses', [PesanTiketController::class, 'proses'])
        ->name('pesan.proses');

    // Halaman pembayaran (gimik)
    Route::get('/pembayaran/{order_id}', [PembayaranController::class, 'halamanPembayaran'])
        ->name('pembayaran.halaman');

    // Tombol selesai bayar
    Route::post('/pembayaran/{order_id}/selesai', [PembayaranController::class, 'selesai'])
        ->name('pembayaran.selesai');

    // Detail transaksi akhir
    Route::get('/transaksi/{order_id}', [PembayaranController::class, 'detailTransaksi'])
        ->name('transaksi.detail');

});


Route::middleware(['auth', \App\Http\Middleware\AdminOnly::class])
    ->prefix('admin')
    ->group(function () {

        Route::get('/events', [\App\Http\Controllers\Admin\AdminLihatEventController::class, 'index'])
            ->name('admin.events');

        Route::get('/events/create', [\App\Http\Controllers\Admin\AdminBuatEventController::class, 'index'])
            ->name('admin.event.create');

        Route::post('/events/create', [\App\Http\Controllers\Admin\AdminBuatEventController::class, 'store'])
            ->name('admin.event.store');

        Route::get('/events/{id}/edit', [\App\Http\Controllers\Admin\AdminEditEventController::class, 'index'])
            ->name('admin.event.edit');

        Route::put('/events/{id}/edit', [\App\Http\Controllers\Admin\AdminEditEventController::class, 'update'])
            ->name('admin.event.update');

        Route::post('/events/{id}/tutup', [\App\Http\Controllers\Admin\AdminTutupEventController::class, 'tutup'])
            ->name('admin.event.tutup');

        Route::get('/events/{id}/rekap', [\App\Http\Controllers\Admin\AdminRekapPenjualanController::class, 'index'])
            ->name('admin.event.rekap');
});




