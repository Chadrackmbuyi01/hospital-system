<!-- resources/views/labtests/index.blade.php -->
@extends('layouts.app')

@section('title', 'Lab Tests')

@section('header')
    <h1 class="h2">Lab Tests</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('labtests.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> New Lab Test
        </a>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">All Lab Tests</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Test Type</th>
                        <th>Scheduled Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($labTests as $labTest)
                    <tr>
                        <td>{{ $labTest->id }}</td>
                        <td>{{ $labTest->patient->name ?? 'N/A' }}</td>
                        <td>{{ $labTest->test_type }}</td>
                        <td>{{ $labTest->scheduled_date->format('M d, Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $labTest->status === 'completed' ? 'success' : ($labTest->status === 'cancelled' ? 'danger' : 'warning') }}">
                                {{ ucfirst($labTest->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('labtests.show', $labTest) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('labtests.edit', $labTest) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('labtests.destroy', $labTest) }}" method="POST" class="d-inline">
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
                        <td colspan="6" class="text-center">No lab tests found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection