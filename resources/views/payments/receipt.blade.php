@extends('layouts.sidebar')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0"><i class="bi bi-check-circle me-2"></i>Payment Receipt</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5>AC Service Booking</h5>
                        <p class="text-muted">Transaction Receipt</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h6>Transaction Details</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Transaction ID:</strong></td>
                                    <td>{{ $payment->transaction_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date:</strong></td>
                                    <td>{{ $payment->created_at->format('M d, Y H:i A') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Method:</strong></td>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td><span class="badge bg-success">{{ ucfirst($payment->status) }}</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Service Details</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Booking ID:</strong></td>
                                    <td>#{{ $payment->booking->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Service:</strong></td>
                                    <td>{{ $payment->booking->service_type }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date & Time:</strong></td>
                                    <td>{{ $payment->booking->booking_date }} at {{ $payment->booking->booking_time }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Customer:</strong></td>
                                    <td>{{ $payment->booking->user->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Amount Paid</h6>
                        </div>
                        <div class="col-md-4 text-end">
                            <h4 class="text-success">${{ $payment->amount }}</h4>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button onclick="window.print()" class="btn btn-primary me-2">
                            <i class="bi bi-printer me-1"></i>Print Receipt
                        </button>
                        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Back to Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .btn, .navbar, .sidebar { display: none !important; }
    .card { border: none !important; box-shadow: none !important; }
}
</style>
@endsection