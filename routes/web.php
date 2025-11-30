<?php

use Illuminate\Support\Facades\Route;

// Customer Controllers
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\TrackingController;
use App\Http\Controllers\Customer\SparepartController;


// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SparepartController as AdminSparepartController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\ReportController;

/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/

// Homepage / Beranda
Route::get('/', [HomeController::class, 'index'])->name('beranda');

// Layanan (static page)
Route::view('/layanan', 'customer.pages.layanan')->name('layanan');

// Artikel (static page)
Route::view('/artikel', 'customer.pages.artikel')->name('artikel');

// Booking
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{booking_code}', [BookingController::class, 'success'])->name('booking.success');

// Tracking
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
Route::post('/tracking/search', [TrackingController::class, 'search'])->name('tracking.search');
Route::get('/tracking/{booking_code}', [TrackingController::class, 'show'])->name('tracking.show');

// Sparepart
Route::get('/sparepart', [SparepartController::class, 'index'])->name('sparepart.index');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected
    Route::middleware(['admin.auth'])->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Booking
        Route::get('/booking', [AdminBookingController::class, 'index'])->name('booking.index');
        Route::get('/booking/{id}', [AdminBookingController::class, 'show'])->name('booking.show');
        Route::post('/booking/{id}/confirm', [AdminBookingController::class, 'confirm'])->name('booking.confirm');
        Route::post('/booking/{id}/reject', [AdminBookingController::class, 'reject'])->name('booking.reject');

        // Service
        Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
        Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show');
        Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
        Route::put('/service/{id}', [ServiceController::class, 'update'])->name('service.update');
        Route::post('/service/{id}/update-status', [ServiceController::class, 'updateStatus'])->name('service.update-status');
        Route::post('/service/{id}/add-sparepart', [ServiceController::class, 'addSparepart'])->name('service.add-sparepart');
        Route::delete('/service/{id}/remove-sparepart/{sparepartId}', [ServiceController::class, 'removeSparepart'])->name('service.remove-sparepart');

        // Sparepart
        Route::get('/sparepart', [AdminSparepartController::class, 'index'])->name('sparepart.index');
        Route::get('/sparepart/create', [AdminSparepartController::class, 'create'])->name('sparepart.create');
        Route::post('/sparepart', [AdminSparepartController::class, 'store'])->name('sparepart.store');
        Route::get('/sparepart/{id}/edit', [AdminSparepartController::class, 'edit'])->name('sparepart.edit');
        Route::put('/sparepart/{id}', [AdminSparepartController::class, 'update'])->name('sparepart.update');
        Route::delete('/sparepart/{id}', [AdminSparepartController::class, 'destroy'])->name('sparepart.destroy');
        Route::post('/sparepart/{id}/toggle-active', [AdminSparepartController::class, 'toggleActive'])->name('sparepart.toggle-active');
        Route::get('/sparepart/{id}/stock', [AdminSparepartController::class, 'stock'])->name('sparepart.stock');
        Route::post('/sparepart/{id}/stock', [AdminSparepartController::class, 'updateStock'])->name('sparepart.update-stock');

        // Testimoni
        Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
        Route::get('/testimoni/create', [TestimoniController::class, 'create'])->name('testimoni.create');
        Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
        Route::get('/testimoni/{id}/edit', [TestimoniController::class, 'edit'])->name('testimoni.edit');
        Route::put('/testimoni/{id}', [TestimoniController::class, 'update'])->name('testimoni.update');
        Route::delete('/testimoni/{id}', [TestimoniController::class, 'destroy'])->name('testimoni.destroy');

        // Report
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');
        Route::get('/report/export', [ReportController::class, 'export'])->name('report.export');
    });
});