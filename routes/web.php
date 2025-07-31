<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BookingAssignmentController;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
    return view('welcome');
})->name('home');

// Debug route
Route::get('/debug', function () {
    return view('debug');
})->middleware('auth');

// Setup routes - Protected by admin middleware
Route::prefix('setup')->middleware(['auth', 'setup.access'])->group(function () {
    Route::get('/', [SetupController::class, 'index'])->name('setup.index');
    Route::post('/users/{user}/make-admin', [SetupController::class, 'makeAdmin'])->name('setup.make-admin');
    Route::post('/users/{user}/remove-admin', [SetupController::class, 'removeAdmin'])->name('setup.remove-admin');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    
    // Payment routes
    Route::post('/payments/verify-razorpay', [PaymentController::class, 'verifyRazorpay'])->name('payments.verify-razorpay');
    Route::get('/payments/{booking}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{booking}', [PaymentController::class, 'process'])->name('payments.process');
    Route::get('/payments/{booking}/razorpay', [PaymentController::class, 'razorpay'])->name('payments.razorpay');
    Route::get('/receipts/{payment}', [PaymentController::class, 'receipt'])->name('payments.receipt');
    

});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::patch('/bookings/{booking}/status', [AdminController::class, 'updateStatus'])->name('admin.bookings.update-status');

    
    // User management
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::patch('/users/{user}/admin-status', [AdminUserController::class, 'updateAdminStatus'])->name('admin.users.update-admin-status');
    
    // Employee management
    Route::get('/employees', [EmployeeController::class, 'index'])->name('admin.employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('admin.employees.store');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('admin.employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('admin.employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('admin.employees.destroy');
    Route::get('/employees/{employee}/assign', [EmployeeController::class, 'assignBookings'])->name('admin.employees.assign');
    
    // Booking assignment
    Route::post('/bookings/{booking}/assign/{employee}', [BookingAssignmentController::class, 'assign'])->name('admin.bookings.assign');
    Route::post('/bookings/{booking}/unassign', [BookingAssignmentController::class, 'unassign'])->name('admin.bookings.unassign');
});
