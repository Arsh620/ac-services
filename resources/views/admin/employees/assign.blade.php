@extends('layouts.admin-sidebar')

@section('title', 'Assign Bookings')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Assign Bookings to {{ $employee->name }}</h2>
        <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Employees
        </a>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pending Bookings</h5>
                </div>
                <div class="card-body">
                    @if($pendingBookings->count() > 0)
                        <div class="list-group">
                            @foreach($pendingBookings as $booking)
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $booking->service_type }}</h6>
                                        <small>{{ $booking->booking_date }}</small>
                                    </div>
                                    <p class="mb-1">Customer: {{ $booking->user->name }}</p>
                                    <small>Time: {{ $booking->booking_time }}</small>
                                    <form action="{{ route('admin.bookings.assign', [$booking->id, $employee->id]) }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="bi bi-person-check"></i> Assign to {{ $employee->name }}
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No pending bookings available for assignment.</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Assigned Bookings</h5>
                </div>
                <div class="card-body">
                    @if($assignedBookings->count() > 0)
                        <div class="list-group">
                            @foreach($assignedBookings as $booking)
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $booking->service_type }}</h6>
                                        <span class="badge bg-{{ $booking->status == 'Pending' ? 'warning' : ($booking->status == 'Confirmed' ? 'primary' : ($booking->status == 'Completed' ? 'success' : 'danger')) }}">
                                            {{ $booking->status }}
                                        </span>
                                    </div>
                                    <p class="mb-1">Customer: {{ $booking->user->name }}</p>
                                    <small>{{ $booking->booking_date }} at {{ $booking->booking_time }}</small>
                                    <form action="{{ route('admin.bookings.unassign', $booking->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-person-x"></i> Unassign
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No bookings assigned to this employee yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection