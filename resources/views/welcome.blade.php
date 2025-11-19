<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Hospital Management System')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body text-center py-5">
                <h1 class="display-4 text-primary mb-4">
                    <i class="fas fa-hospital"></i> MedCare Hospital
                </h1>
                <p class="lead mb-4">Comprehensive Hospital Management System</p>
                
                <div class="row mt-5">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-users fa-2x text-primary mb-3"></i>
                                <h5>User Management</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-calendar-check fa-2x text-success mb-3"></i>
                                <h5>Appointments</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-file-medical fa-2x text-info mb-3"></i>
                                <h5>Medical Records</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-users"></i> Manage Users
                    </a>
                    <a href="{{ route('appointments.index') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-calendar-plus"></i> View Appointments
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection