<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Pasien\BookingPasienController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Pasien\BookingController;

// =====================
// AUTHENTIKASI
// =====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================
// HALAMAN DASHBOARD
// =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('admin')->name('admin.dashboard');

    Route::get('/pasien/dashboard', function () {
        return view('pasien.dashboard');
    })->middleware('pasien')->name('pasien.dashboard');
});

// =====================
// ADMIN: DOKTER, JADWAL, BOOKING, ARTIKEL
// =====================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('/dokter', DoctorController::class);
    Route::resource('/jadwal', ScheduleController::class);

    Route::get('/booking', [BookingAdminController::class, 'index'])->name('admin.booking.index');
    Route::patch('/booking/{id}/status', [BookingAdminController::class, 'updateStatus'])->name('admin.booking.updateStatus');

    Route::resource('/article', ArticleController::class);
});

// =====================
// PASIEN: Booking Konsultasi
// =====================
Route::middleware(['auth', 'pasien'])->prefix('pasien')->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('pasien.booking.index');
    Route::get('/booking/create', [BookingController::class, 'create'])->name('pasien.booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('pasien.booking.store');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('pasien.booking.destroy');
});

// =====================
// HALAMAN PUBLIK
// =====================
Route::get('/', [PublicController::class, 'home'])->name('home');

// Tambahkan route alias agar sesuai dengan nama di Blade
Route::get('/dokter', [PublicController::class, 'listDokter'])->name('dokter'); // <- alias route tambahan
Route::get('/dokter-list', [PublicController::class, 'listDokter'])->name('dokter.list');

Route::get('/artikel', [PublicController::class, 'listArtikel'])->name('artikel'); // <- tambahkan halaman daftar artikel
Route::get('/artikel/{id}', [PublicController::class, 'showArtikel'])->name('artikel.show');

Route::get('/booking', [PublicController::class, 'bookingForm'])->name('booking');
Route::post('/booking', [PublicController::class, 'storeBooking'])->name('booking.store');
