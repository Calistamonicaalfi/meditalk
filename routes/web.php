<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingAdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PublicController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PasienMiddleware;

// =====================
// HALAMAN PUBLIK (Bisa diakses tanpa login)
// =====================
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/dokter', [PublicController::class, 'dokter'])->name('dokter');
Route::get('/dokter/{id}', [PublicController::class, 'showDokter'])->name('dokter.detail');
Route::get('/artikel', [PublicController::class, 'artikel'])->name('artikel');
Route::get('/artikel/{id}', [PublicController::class, 'showArtikel'])->name('artikel.show');

// =====================
// AUTHENTIKASI
// =====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// BOOKING (Perlu login)
// =====================
Route::get('/booking', [PublicController::class, 'bookingForm'])->name('booking');
Route::post('/booking', [PublicController::class, 'storeBooking'])->name('booking.store');

// =====================
// HALAMAN DASHBOARD (Perlu login)
// =====================
Route::middleware('auth')->group(function () {

    // Admin Dashboard - Gunakan class langsung
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(AdminMiddleware::class)->name('admin.dashboard');

    // Pasien Dashboard - Gunakan class langsung
    Route::get('/pasien/dashboard', function () {
        return view('pasien.dashboard');
    })->middleware(PasienMiddleware::class)->name('pasien.dashboard');

    // =====================
    // ADMIN: DOKTER, JADWAL, BOOKING, ARTIKEL
    // =====================
    Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
        Route::resource('/dokter', DoctorController::class);
        Route::resource('/jadwal', ScheduleController::class);
        Route::get('/booking', [BookingAdminController::class, 'index'])->name('admin.booking.index');
        Route::patch('/booking/{id}/status', [BookingAdminController::class, 'updateStatus'])->name('admin.booking.updateStatus');
        Route::resource('/article', ArticleController::class);
        Route::post('/booking/{id}/confirm', [BookingAdminController::class, 'confirm'])->name('admin.booking.confirm');
        Route::post('/booking/{id}/cancel', [BookingAdminController::class, 'cancel'])->name('admin.booking.cancel');
    });

    // =====================
    // PASIEN: Booking Konsultasi
    // =====================
    Route::prefix('pasien')->middleware(PasienMiddleware::class)->group(function () {
        Route::get('/booking', [BookingController::class, 'index'])->name('pasien.booking.index');
        Route::get('/booking/create', [BookingController::class, 'create'])->name('pasien.booking.create');
        Route::post('/booking', [BookingController::class, 'store'])->name('pasien.booking.store');
        Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('pasien.booking.destroy');
    });

    // Article routes
    Route::get('/admin/article', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/admin/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/admin/article', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/admin/article/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/admin/article/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/admin/article/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
    Route::get('/admin/article/{id}', [ArticleController::class, 'show'])->name('article.show');
});