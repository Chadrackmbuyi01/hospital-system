<!-- resources/views/prescriptions/index.blade.php -->
@extends('layouts.app')

@section('title', 'Prescriptions')

@section('header')
    <h1 class="h2">Prescriptions</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('prescriptions.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> New Prescription
        </a>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">All Prescriptions</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Medication</th>
                        <th>Issued Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prescriptions as $prescription)
                    <tr>
                        <td>{{ $prescription->id }}</td>
                        <td>{{ $prescription->patient->name ?? 'N/A' }}</td>
                        <td>{{ $prescription->doctor->name ?? 'N/A' }}</td>
                        <td>{{ $prescription->medication }}</td>
                        <td>{{ $prescription->issued_date->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('prescriptions.show', $prescription) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('prescriptions.edit', $prescription) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No prescriptions found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection