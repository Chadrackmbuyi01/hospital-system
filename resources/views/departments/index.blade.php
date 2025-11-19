<!-- resources/views/departments/index.blade.php -->
@extends('layouts.app')

@section('title', 'Departments')

@section('header')
    <h1 class="h2">Departments</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('departments.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> New Department
        </a>
    </div>
@endsection

@section('content')
<div class="row">
    @foreach($departments as $department)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">{{ $department->name }}</h5>
                <p class="card-text">{{ $department->description ?? 'No description available.' }}</p>
                <p class="card-text">
                    <small class="text-muted">
                        Doctors: {{ $department->doctors->count() }}
                    </small>
                </p>
            </div>
            <div class="card-footer">
                <div class="btn-group btn-group-sm w-100">
                    <a href="{{ route('departments.show', $department) }}" class="btn btn-outline-primary">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a href="{{ route('departments.edit', $department) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($departments->isEmpty())
<div class="alert alert-info text-center">
    <i class="fas fa-info-circle"></i> No departments found.
</div>
@endif
@endsection