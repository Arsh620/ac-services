@extends('layouts.sidebar')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Payment for Booking #{{ $booking->id }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Service:</strong> {{ $booking->service_type }}
                    </div>
                    <div class="mb-3">
                        <strong>Date:</strong> {{ $booking->booking_date }} at {{ $booking->booking_time }}
                    </div>
                    <div class="mb-4">
                        <strong>Amount:</strong> <span class="h4 text-success">${{ $booking->service_price }}</span>
                    </div>

                    <form method="POST" action="{{ route('payments.process', $booking) }}" onsubmit="console.log('Form submitted with method:', document.querySelector('input[name=payment_method]:checked').value)">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash" checked>
                                <label class="form-check-label" for="cash">
                                    <i class="bi bi-cash-coin me-2"></i>Cash Payment
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                                <label class="form-check-label" for="card">
                                    <i class="bi bi-credit-card me-2"></i>Card Payment
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="online" value="online">
                                <label class="form-check-label" for="online">
                                    <i class="bi bi-phone me-2"></i>Online Payment
                                </label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success" onclick="console.log('Button clicked')">
                                <i class="bi bi-check-circle me-2"></i>Complete Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection