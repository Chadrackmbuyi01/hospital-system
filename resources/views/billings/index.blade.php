<!-- resources/views/billings/index.blade.php -->
@extends('layouts.app')

@section('title', 'Billings')

@section('header')
    <h1 class="h2">Billings</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('billings.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> New Billing
        </a>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">All Billings</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Amount</th>
                        <th>Billing Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($billings as $billing)
                    <tr>
                        <td>{{ $billing->id }}</td>
                        <td>{{ $billing->patient->name ?? 'N/A' }}</td>
                        <td>${{ number_format($billing->amount, 2) }}</td>
                        <td>{{ $billing->billing_date->format('M d, Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $billing->status === 'paid' ? 'success' : ($billing->status === 'pending' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($billing->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('billings.show', $billing) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('billings.edit', $billing) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('billings.destroy', $billing) }}" method="POST" class="d-inline">
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
                        <td colspan="6" class="text-center">No billings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection