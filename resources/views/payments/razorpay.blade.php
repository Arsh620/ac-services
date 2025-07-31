@extends('layouts.sidebar')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-credit-card me-2"></i>Online Payment</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <h6>Booking #{{ $booking->id }}</h6>
                        <p class="text-muted">{{ $booking->service_type }} Service</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-success">₹{{ number_format($booking->service_price, 2) }}</h3>
                    </div>

                    <!-- **HIGHLIGHTED:** Razorpay payment button -->
                    <button id="rzp-button" class="btn btn-success btn-lg">
                        <i class="bi bi-shield-check me-2"></i>Pay with Razorpay
                    </button>

                    <div class="mt-3">
                        <small class="text-muted">Secure payment powered by Razorpay</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- **HIGHLIGHTED:** Hidden form for payment verification -->
<form id="payment-form" action="{{ route('payments.verify-razorpay') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
</form>

<!-- **HIGHLIGHTED:** Razorpay script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('rzp-button').onclick = function(e) {
        @if(isset($order))
        var options = {
            "key": "{{ env('RAZORPAY_KEY_ID') }}",
            "amount": "{{ $order['amount'] }}",
            "currency": "{{ $order['currency'] }}",
            "name": "AC Service Booking",
            "description": "{{ $booking->service_type }} Service",
            "order_id": "{{ $order['id'] }}",
            "handler": function(response) {
                // **HIGHLIGHTED:** Handle successful payment
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('payment-form').submit();
            },
            "prefill": {
                "name": "{{ $booking->user->name }}",
                "email": "{{ $booking->user->email }}"
            },
            "theme": {
                "color": "#007bff"
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();
        @else
        alert('Payment order not found. Please try again.');
        @endif
        e.preventDefault();
    };
</script>
@endsection