<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\BillingController;

// Welcome Route
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes (if using Laravel Breeze/Jetstream)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Resource Routes for all models
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('prescriptions', PrescriptionController::class);
    Route::resource('labtests', LabTestController::class);
    Route::resource('billings', BillingController::class);
});

// User management routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// If you need authentication, you can use:
require __DIR__.'/auth.php';