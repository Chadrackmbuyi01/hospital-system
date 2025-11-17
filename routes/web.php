<?php
// routes/web.php
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;

Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
        Route::resource('/admin/users', UserController::class);
        Route::resource('/admin/departments', DepartmentController::class);
    });

    // Doctor routes
    Route::middleware(['role:doctor'])->group(function () {
        Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard']);
        Route::get('/doctor/appointments', [AppointmentController::class, 'doctorIndex']);
        Route::resource('/doctor/medical-records', MedicalRecordController::class);
        Route::resource('/doctor/prescriptions', PrescriptionController::class);
    });

    // Patient routes
    Route::middleware(['role:patient'])->group(function () {
        Route::get('/patient/dashboard', [PatientController::class, 'dashboard']);
        Route::resource('/patient/appointments', AppointmentController::class);
        Route::get('/patient/medical-history', [MedicalRecordController::class, 'patientHistory']);
    });

    // Receptionist routes
    Route::middleware(['role:receptionist'])->group(function () {
        Route::get('/receptionist/dashboard', [ReceptionistController::class, 'dashboard']);
        Route::resource('/receptionist/appointments', AppointmentController::class);
    });

    // Common routes
    Route::resource('appointments', AppointmentController::class)->only(['index', 'show']);
});