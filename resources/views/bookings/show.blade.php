@extends('layouts.sidebar')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Booking Details</span>
                    <a href="{{ route('bookings.index') }}" class="btn btn-sm btn-secondary">Back to Bookings</a>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="card-title">{{ $booking->service_type }} Service</h5>
                        <p class="card-text">
                            <span class="badge bg-{{ $booking->status == 'Pending' ? 'warning' : ($booking->status == 'Confirmed' ? 'primary' : 'success') }}">
                                {{ $booking->status }}
                            </span>
                        </p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p><strong>Service Address:</strong></p>
                        <p>{{ $booking->address }}</p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Service Charge:</strong> ${{ $booking->service_price ?? 0 }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Payment Status:</strong> 
                                <span class="badge bg-{{ $booking->payment_status == 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($booking->payment_status ?? 'pending') }}
                                </span>
                            </p>
                        </div>
                    </div>
                    
                    @if($booking->payment_status == 'paid' && $booking->payment)
                        <div class="card mb-3 border-success">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0"><i class="bi bi-receipt me-2"></i>Payment Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Transaction ID:</strong> {{ $booking->payment->transaction_id }}</p>
                                        <p><strong>Payment Method:</strong> {{ ucfirst($booking->payment->payment_method) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Amount Paid:</strong> ${{ $booking->payment->amount }}</p>
                                        <p><strong>Payment Date:</strong> {{ $booking->payment->created_at->format('M d, Y H:i A') }}</p>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ route('payments.receipt', $booking->payment) }}" class="btn btn-primary">
                                        <i class="bi bi-receipt me-1"></i>View Receipt
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif




                    
                    <div class="mb-3">
                        <p><strong>Booking Created:</strong> {{ $booking->created_at->format('F j, Y, g:i a') }}</p>
                    </div>



                    @if($booking->payment_status == 'pending')
                        <div class="text-center mb-3">
                            <a href="{{ route('payments.show', $booking) }}" class="btn btn-success btn-lg">
                                <i class="bi bi-credit-card me-2"></i>Make Payment
                            </a>
                        </div>
                    @endif
                    
                    @if($booking->status == 'Pending')
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Your booking is pending confirmation. We will contact you shortly.
                        </div>
                    @elseif($booking->status == 'Confirmed')
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> Your booking has been confirmed. Our technician will arrive at the scheduled time.
                        </div>
                    @else
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> This service has been completed. Thank you for choosing our services!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection