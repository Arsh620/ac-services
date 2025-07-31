<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AC Pro Services - Professional AC Solutions</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f8fafc;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Parallax Hero Section */
        .hero-parallax {
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.9), rgba(59, 130, 246, 0.8)), url('/placeholder.svg?height=1080&width=1920') center/cover fixed;
            color: white;
            text-align: center;
            overflow: hidden;
        }

        .hero-content {
            z-index: 2;
            max-width: 800px;
            padding: 0 20px;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease-out;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .hero-cta {
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom Buttons */
        .btn-gradient {
            background: var(--gradient-accent);
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(79, 172, 254, 0.4);
        }

        .btn-outline-gradient {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-outline-gradient:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Services Section */
        .services-section {
            padding: 120px 0;
            background: var(--bg-light);
            position: relative;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .service-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            border: none;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            transition: all 0.3s ease;
        }

        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(5deg);
        }

        /* Why Choose Us Section */
        .why-choose-section {
            padding: 120px 0;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            position: relative;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #fbbf24;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 120px 0;
            background: var(--bg-light);
        }

        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
        }

        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: -10px;
            left: 30px;
            font-size: 6rem;
            color: var(--primary-color);
            opacity: 0.2;
            font-family: serif;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .stars {
            color: #fbbf24;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .customer-info {
            display: flex;
            align-items: center;
            margin-top: 30px;
        }

        .customer-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
            border: 3px solid var(--primary-color);
        }

        /* CTA Section */
        .cta-section {
            padding: 120px 0;
            background: var(--gradient-secondary);
            color: white;
            text-align: center;
        }

        .cta-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .cta-subtitle {
            font-size: 1.2rem;
            margin-bottom: 3rem;
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: white;
            padding: 60px 0 30px;
        }

        .footer h5 {
            color: var(--accent-color);
            margin-bottom: 20px;
        }

        .footer a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .cta-title {
                font-size: 2rem;
            }
        }
            text-align: center;
            position: relative;
        }

        .cta-content {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: rgba(37, 99, 235, 0.2);
            z-index: 9999;
        }

        .scroll-progress {
            height: 100%;
            background: var(--gradient-primary);
            width: 0%;
            transition: width 0.1s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .service-card,
            .feature-card,
            .testimonial-card {
                margin-bottom: 30px;
            }
        }

        /* Custom Animations */
        .slide-in-left {
            animation: slideInLeft 1s ease-out;
        }

        .slide-in-right {
            animation: slideInRight 1s ease-out;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Particle Background */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: particleFloat 15s infinite linear;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: rgba(37, 99, 235, 0.95); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-snow me-2"></i>AC Pro Services
            </a>
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-light">
                    <i class="bi bi-person-plus me-1"></i>Register
                </a>
            </div>
        </div>
    </nav>

    <!-- Scroll Progress Indicator -->
    <div class="scroll-indicator">
        <div class="scroll-progress" id="scrollProgress"></div>
    </div>

    <!-- Hero Section with Parallax -->
    <section class="hero-parallax" id="hero">
        <!-- Floating Elements -->
        <div class="floating-element">
            <i class="bi bi-snow" style="font-size: 4rem;"></i>
        </div>
        <div class="floating-element">
            <i class="bi bi-gear-fill" style="font-size: 3rem;"></i>
        </div>
        <div class="floating-element">
            <i class="bi bi-tools" style="font-size: 3.5rem;"></i>
        </div>

        <!-- Particle Background -->
        <div class="particles" id="particles"></div>

        <div class="hero-content">
            <h1 class="hero-title">AC Pro Services</h1>
            <p class="hero-subtitle">Professional Air Conditioning Solutions for Your Comfort</p>
            <div class="hero-cta">
                <a href="{{ route('login') }}" class="btn btn-gradient me-3 mb-3">Book Service Now</a>
                <a href="#services" class="btn btn-outline-gradient mb-3">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Our Premium Services</h2>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h4 class="mb-3">AC Installation</h4>
                        <p class="text-muted">Professional installation of all AC systems with warranty and expert guidance.</p>
                        <button class="btn btn-outline-primary mt-3">Learn More</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-wrench-adjustable"></i>
                        </div>
                        <h4 class="mb-3">AC Repair</h4>
                        <p class="text-muted">Quick and reliable repairs for all brands with 24/7 emergency service.</p>
                        <button class="btn btn-outline-primary mt-3">Learn More</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-gear-fill"></i>
                        </div>
                        <h4 class="mb-3">AC Maintenance</h4>
                        <p class="text-muted">Keep your AC running efficiently with our comprehensive maintenance plans.</p>
                        <button class="btn btn-outline-primary mt-3">Learn More</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="bi bi-droplet-fill"></i>
                        </div>
                        <h4 class="mb-3">AC Cleaning</h4>
                        <p class="text-muted">Deep cleaning services to improve performance and air quality.</p>
                        <button class="btn btn-outline-primary mt-3">Learn More</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-section" id="why-choose">
        <div class="container">
            <h2 class="section-title text-white" data-aos="fade-up">Why Choose AC Pro Services</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4 class="mb-3">Expert Technicians</h4>
                        <p>Certified professionals with years of hands-on experience in AC services.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <h4 class="mb-3">Affordable Pricing</h4>
                        <p>Transparent pricing with no hidden charges. Best value guaranteed.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-left" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <h4 class="mb-3">Quick Response</h4>
                        <p>Fast service delivery, even for emergency repairs and installations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">What Our Customers Say</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="mb-4">"Excellent service! The technician was professional, punctual, and fixed our AC perfectly. Highly recommend AC Pro Services!"</p>
                        <div class="customer-info">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer" class="customer-avatar">
                            <div>
                                <h6 class="mb-0">John Smith</h6>
                                <small class="text-muted">Verified Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="mb-4">"Amazing experience! Quick response time and fair pricing. Our AC is working better than ever. Thank you!"</p>
                        <div class="customer-info">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Customer" class="customer-avatar">
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">Verified Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <p class="mb-4">"Professional team with great attention to detail. The maintenance service has improved our AC efficiency significantly."</p>
                        <div class="customer-info">
                            <img src="https://randomuser.me/api/portraits/men/56.jpg" alt="Customer" class="customer-avatar">
                            <div>
                                <h6 class="mb-0">Mike Davis</h6>
                                <small class="text-muted">Verified Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section" id="cta">
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2 class="display-4 fw-bold mb-4">Ready to Experience Premium AC Service?</h2>
                <p class="lead mb-5">Join thousands of satisfied customers who trust AC Pro Services for all their cooling needs.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <button class="btn btn-light btn-lg px-5 py-3">
                        <i class="bi bi-telephone-fill me-2"></i>
                        Call Now
                    </button>
                    <button class="btn btn-outline-light btn-lg px-5 py-3">
                        <i class="bi bi-calendar-check me-2"></i>
                        Schedule Service
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Scroll Progress Indicator
        window.addEventListener('scroll', () => {
            const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
            document.getElementById('scrollProgress').style.width = scrolled + '%';
        });

        // Parallax Effect for Hero Section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.getElementById('hero');
            const rate = scrolled * -0.5;
            hero.style.transform = `translateY(${rate}px)`;
        });

        // Create Floating Particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                // Random size between 2px and 8px
                const size = Math.random() * 6 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';

                // Random horizontal position
                particle.style.left = Math.random() * 100 + '%';

                // Random animation delay
                particle.style.animationDelay = Math.random() * 15 + 's';

                // Random animation duration
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';

                particlesContainer.appendChild(particle);
            }
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Initialize particles when page loads
        window.addEventListener('load', () => {
            createParticles();
        });

        // Add scroll-triggered animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for scroll animations
        document.querySelectorAll('.service-card, .feature-card, .testimonial-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });

        // Add hover effects for interactive elements
        document.querySelectorAll('.service-card, .feature-card, .testimonial-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add click ripple effect to buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    </script>

    <style>
        /* Ripple effect for buttons */
        .btn {
            position: relative;
            overflow: hidden;
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>

</html>