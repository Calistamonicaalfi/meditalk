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
Route::get('/dokter', [PublicController::class, 'dokter'])->name('dokter.index');
Route::get('/dokter/{id}', [PublicController::class, 'showDokter'])->name('dokter.detail');
Route::get('/artikel', [PublicController::class, 'artikel'])->name('artikel.index');
Route::get('/artikel/{id}', [PublicController::class, 'showArtikel'])->name('artikel.detail');
Route::get('/booking', [PublicController::class, 'bookingForm'])->name('booking');
Route::post('/booking', [PublicController::class, 'storeBooking'])->name('booking.store');

// =====================
// AUTHENTIKASI (Login, Register, Logout)
// =====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// FITUR KHUSUS (Perlu login)
// =====================
Route::middleware('auth')->group(function () {
    // Admin Dashboard (khusus admin)
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('admin')->name('admin.dashboard');

    // Pasien Dashboard (khusus pasien)
    Route::get('/pasien/dashboard', [App\Http\Controllers\Pasien\DashboardController::class, 'index'])->middleware('pasien')->name('pasien.dashboard');

    // =====================
    // ADMIN: DOKTER, JADWAL, BOOKING, ARTIKEL (khusus admin)
    // =====================
    Route::prefix('admin')->middleware('admin')->group(function () {
        
        // Doctor Management
        Route::resource('/dokter', DoctorController::class)->names([
            'index' => 'admin.dokter.index',
            'create' => 'admin.dokter.create',
            'store' => 'admin.dokter.store',
            'edit' => 'admin.dokter.edit',
            'update' => 'admin.dokter.update',
            'destroy' => 'admin.dokter.destroy',
            'show' => 'admin.dokter.show',
        ]);
        
        Route::resource('/jadwal', ScheduleController::class);
        // Booking Management
        Route::get('/booking', [BookingAdminController::class, 'index'])->name('admin.booking.index');
        Route::get('/booking/{id}', [BookingAdminController::class, 'show'])->name('admin.booking.show');
        Route::patch('/booking/{id}/status', [BookingAdminController::class, 'updateStatus'])->name('admin.booking.updateStatus');
        Route::post('/booking/{id}/confirm', [BookingAdminController::class, 'confirm'])->name('admin.booking.confirm');
        Route::post('/booking/{id}/cancel', [BookingAdminController::class, 'cancel'])->name('admin.booking.cancel');
        Route::post('/booking/{id}/complete', [BookingAdminController::class, 'complete'])->name('admin.booking.complete');
        Route::get('/booking/filter/{status}', [BookingAdminController::class, 'filterByStatus'])->name('admin.booking.filter');
        // Resource untuk artikel
        Route::resource('/article', ArticleController::class)->names([
            'index' => 'article.index',
            'create' => 'article.create',
            'store' => 'article.store',
            'edit' => 'article.edit',
            'update' => 'article.update',
            'destroy' => 'article.destroy',
            'show' => 'article.show',
        ]);
    });

    // =====================
    // PASIEN: Booking Konsultasi (khusus pasien)
    // =====================
    Route::prefix('pasien')->middleware('pasien')->group(function () {
        Route::get('/booking', [BookingController::class, 'index'])->name('pasien.booking.index');
        Route::get('/booking/create', [BookingController::class, 'create'])->name('pasien.booking.create');
        Route::post('/booking', [BookingController::class, 'store'])->name('pasien.booking.store');
        Route::get('/booking/{id}', [BookingController::class, 'show'])->name('pasien.booking.show');
        Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('pasien.booking.destroy');
    });
});
