@extends('layouts.sidebar')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Book AC Service</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="service_type" class="form-label">Service Type</label>
                            <select id="service_type" name="service_type" class="form-select @error('service_type') is-invalid @enderror" required onchange="updatePrice()">
                                <option value="">Select Service Type</option>
                                @foreach(\App\Models\Service::all() as $service)
                                    <option value="{{ $service->name }}" data-price="{{ $service->price }}">
                                        {{ $service->name }} - ${{ $service->price }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="alert alert-info" id="price-display" style="display: none;">
                                <strong>Service Price: $<span id="selected-price">0</span></strong>
                            </div>
                            <input type="hidden" name="service_price" id="service_price" value="0">
                        </div>

                        <div class="mb-3">
                            <label for="booking_date" class="form-label">Booking Date</label>
                            <input type="date" class="form-control @error('booking_date') is-invalid @enderror" id="booking_date" name="booking_date" required min="{{ date('Y-m-d') }}">
                            @error('booking_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="booking_time" class="form-label">Preferred Time</label>
                            <select id="booking_time" name="booking_time" class="form-select @error('booking_time') is-invalid @enderror" required>
                                <option value="">Select Time</option>
                                <option value="09:00:00">9:00 AM</option>
                                <option value="10:00:00">10:00 AM</option>
                                <option value="11:00:00">11:00 AM</option>
                                <option value="12:00:00">12:00 PM</option>
                                <option value="13:00:00">1:00 PM</option>
                                <option value="14:00:00">2:00 PM</option>
                                <option value="15:00:00">3:00 PM</option>
                                <option value="16:00:00">4:00 PM</option>
                                <option value="17:00:00">5:00 PM</option>
                            </select>
                            @error('booking_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Service Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required></textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Book Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updatePrice() {
    const select = document.getElementById('service_type');
    const selectedOption = select.options[select.selectedIndex];
    const price = selectedOption.getAttribute('data-price') || 0;
    
    document.getElementById('selected-price').textContent = price;
    document.getElementById('service_price').value = price;
    
    const priceDisplay = document.getElementById('price-display');
    if (price > 0) {
        priceDisplay.style.display = 'block';
    } else {
        priceDisplay.style.display = 'none';
    }
}
</script>
@endsection