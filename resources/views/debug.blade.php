@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Debug Information</div>

                <div class="card-body">
                    <h5>User Information</h5>
                    <ul>
                        <li>ID: {{ Auth::user()->id }}</li>
                        <li>Name: {{ Auth::user()->name }}</li>
                        <li>Email: {{ Auth::user()->email }}</li>
                        <li>is_admin (raw): {{ Auth::user()->is_admin }}</li>
                        <li>is_admin (cast): {{ Auth::user()->is_admin ? 'true' : 'false' }}</li>
                        <li>isAdmin() method: {{ Auth::user()->isAdmin() ? 'true' : 'false' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection