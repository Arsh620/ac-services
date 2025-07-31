@extends('layouts.sidebar')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-receipt me-2"></i>Payment Receipt</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h2 class="text-success">Payment Successful!</h2>
                        <p class="text-muted">Thank you for your payment</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Transaction Details</h6>
                            <p><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</p>
                            <p><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
                            <p><strong>Amount:</strong> ${{ number_format($payment->amount, 2) }}</p>
                            <p><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($payment->status) }}</span></p>
                            <p><strong>Date:</strong> {{ $payment->created_at->format('M d, Y H:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Booking Details</h6>
                            <p><strong>Booking ID:</strong> #{{ $payment->booking->id }}</p>
                            <p><strong>Service:</strong> {{ $payment->booking->service_type }}</p>
                            <p><strong>Date:</strong> {{ $payment->booking->booking_date }}</p>
                            <p><strong>Time:</strong> {{ $payment->booking->booking_time }}</p>
                            <p><strong>Customer:</strong> {{ $payment->booking->user->name }}</p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button onclick="window.print()" class="btn btn-primary me-2">
                            <i class="bi bi-printer me-1"></i>Print Receipt
                        </button>
                        <a href="{{ route('bookings.show', $payment->booking) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Back to Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection