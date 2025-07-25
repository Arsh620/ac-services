@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    
                    <div class="mt-4">
                        <a href="{{ route('bookings.index') }}" class="btn btn-primary">View My Bookings</a>
                        <a href="{{ route('bookings.create') }}" class="btn btn-success">Book New Service</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection