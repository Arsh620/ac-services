@extends('layouts.master')

@section('content')
<!-- Hero Section with Carousel -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1568634697393-0165d25e7acb?q=80&w=1196&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="AC Installation">
            <div class="carousel-caption d-none d-md-block">
                <h2>Professional AC Installation</h2>
                <p>Expert installation services for all types of air conditioners</p>
                @auth
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-lg">Book Now</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login to Book</a>
                @endauth
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://plus.unsplash.com/premium_photo-1683134512538-7b390d0adc9e?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="AC Repair">
            <div class="carousel-caption d-none d-md-block">
                <h2>Quick AC Repair Services</h2>
                <p>Fast and reliable repair for all brands and models</p>
                @auth
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-lg">Book Now</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login to Book</a>
                @endauth
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1552853160-8ec65527b252?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="AC Maintenance">
            <div class="carousel-caption d-none d-md-block">
                <h2>Regular AC Maintenance</h2>
                <p>Keep your AC running efficiently with our maintenance services</p>
                @auth
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-lg">Book Now</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login to Book</a>
                @endauth
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container py-5">
    <!-- Services Section -->
    <h2 class="text-center mb-5">Our Services</h2>
    <div class="row g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm">
                <img src="https://images.unsplash.com/photo-1580655653885-65763b2597d0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="AC Installation">
                <div class="card-body text-center">
                    <h5 class="card-title">AC Installation</h5>
                    <p class="card-text">Professional installation of all types of air conditioning systems.</p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="btn btn-outline-primary">Book Service</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login to Book</a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm">
                <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="AC Repair">
                <div class="card-body text-center">
                    <h5 class="card-title">AC Repair</h5>
                    <p class="card-text">Quick and reliable repair services for all AC brands and models.</p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="btn btn-outline-primary">Book Service</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login to Book</a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm">
                <img src="https://images.unsplash.com/photo-1581244277943-fe4a9c777189?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="AC Maintenance">
                <div class="card-body text-center">
                    <h5 class="card-title">AC Maintenance</h5>
                    <p class="card-text">Regular maintenance to keep your AC running efficiently.</p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="btn btn-outline-primary">Book Service</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login to Book</a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm">
                <img src="https://images.unsplash.com/photo-1631545308539-82cabb845367?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="AC Cleaning">
                <div class="card-body text-center">
                    <h5 class="card-title">AC Cleaning</h5>
                    <p class="card-text">Deep cleaning services to improve air quality and efficiency.</p>
                    @auth
                        <a href="{{ route('bookings.create') }}" class="btn btn-outline-primary">Book Service</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login to Book</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="mt-5 pt-5">
        <h2 class="text-center mb-5">Why Choose Us</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-people-fill text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title">Experienced Technicians</h5>
                        <p class="card-text">Our technicians are certified and have years of experience in the field.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-cash-coin text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title">Affordable Pricing</h5>
                        <p class="card-text">We offer competitive rates with no hidden charges or surprise fees.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-lightning-charge-fill text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title">Quick Response</h5>
                        <p class="card-text">Fast and reliable service when you need it most, including emergency services.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="mt-5 pt-5">
        <h2 class="text-center mb-5">What Our Customers Say</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="card-text">"The technicians were professional and completed the AC installation quickly. Very satisfied with the service!"</p>
                        <div class="d-flex align-items-center mt-3">
                            <div class="flex-shrink-0">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle" width="50" alt="Customer">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">John Smith</h6>
                                <small class="text-muted">Residential Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="card-text">"They responded quickly to our emergency AC repair call. The technician was knowledgeable and fixed the issue promptly."</p>
                        <div class="d-flex align-items-center mt-3">
                            <div class="flex-shrink-0">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle" width="50" alt="Customer">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">Business Owner</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="mb-3 text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <p class="card-text">"I've been using their maintenance service for years. My AC runs efficiently and has had fewer problems since I started with them."</p>
                        <div class="d-flex align-items-center mt-3">
                            <div class="flex-shrink-0">
                                <img src="https://randomuser.me/api/portraits/men/67.jpg" class="rounded-circle" width="50" alt="Customer">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Michael Chen</h6>
                                <small class="text-muted">Homeowner</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="mt-5 pt-3 text-center">
        <div class="p-5 bg-primary text-white rounded-3">
            <h2>Ready to Book Your AC Service?</h2>
            <p class="lead">Our professional technicians are ready to help you with all your AC needs.</p>
            @auth
                <a href="{{ route('bookings.create') }}" class="btn btn-light btn-lg px-4 mt-3">Book a Service Now</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 me-md-2 mt-3">Register Now</a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4 mt-3">Login</a>
            @endauth
        </div>
    </div>
</div>

<style>
    /* Custom styles for the carousel */
    .carousel-item {
        height: 500px;
    }
    
    .carousel-item img {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }
    
    .carousel-caption {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 10px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .carousel-item {
            height: 300px;
        }
        
        .carousel-caption {
            display: block !important;
            padding: 10px;
        }
        
        .carousel-caption h2 {
            font-size: 1.5rem;
        }
        
        .carousel-caption p {
            font-size: 0.9rem;
        }
    }
</style>
@endsection