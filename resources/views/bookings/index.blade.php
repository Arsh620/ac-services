@extends('layouts.sidebar')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>My Bookings</h1>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Book New Service</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($bookings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Service Type</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Charges</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->service_type }}</td>
                                    <td>{{ $booking->booking_date }}</td>
                                    <td>{{ $booking->booking_time }}</td>
                                    <td>${{ $booking->service_price ?? 0 }}</td>
                                    <td>
                                        <span class="badge bg-{{ $booking->payment_status == 'paid' ? 'success' : 'warning' }}">
                                            {{ ucfirst($booking->payment_status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $booking->status == 'Pending' ? 'warning' : ($booking->status == 'Confirmed' ? 'primary' : 'success') }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-info me-1">View</a>
                                        @if($booking->payment_status == 'pending')
                                            <a href="{{ route('payments.show', $booking) }}" class="btn btn-sm btn-success">Pay</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">You don't have any bookings yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection