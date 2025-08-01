<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Slot routes
Route::get('/slots', [SlotController::class, 'index'])->name('slots.index');
Route::post('/slots/get-by-date', [SlotController::class, 'getSlotsByDate'])->name('slots.get-by-date');

// Booking routes
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/create/{slot}', [BookingController::class, 'showBookingForm'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Admin routes
Route::get('/admin', [AdminController::class, 'slots'])->name('admin.slots');
Route::get('/admin/booked-slots', [AdminController::class, 'bookedSlots'])->name('admin.booked-slots');
Route::post('/admin/booked-slots/get-by-date', [AdminController::class, 'getBookedSlotsByDate'])->name('admin.booked-slots.get-by-date');
Route::get('/admin/create-slots', [AdminController::class, 'createSlots'])->name('admin.create-slots');
Route::post('/admin/create-slots', [AdminController::class, 'storeSlots'])->name('admin.store-slots');
Route::get('/admin/view-bookings', [AdminController::class, 'viewBookings'])->name('admin.view-bookings');
