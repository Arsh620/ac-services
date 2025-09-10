<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinnacle Academy - Government Educational Institution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --govt-blue: #003366;
            --govt-blue-light: #1e4a66;
            --govt-gold: #ffd700;
            --govt-red: #cc0000;
            --govt-green: #006633;
            --govt-gray: #f8f9fa;
            --govt-dark-gray: #6c757d;
            --white: #ffffff;
            --light-blue: #e3f2fd;
            --border-color: #dee2e6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: var(--white);
        }

        /* Government Header */
        .govt-header {
            background: linear-gradient(90deg, var(--govt-blue) 0%, var(--govt-blue-light) 100%);
            color: white;
            padding: 8px 0;
            font-size: 0.85rem;
        }

        .govt-emblem {
            width: 40px;
            height: 40px;
            background: var(--govt-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--govt-blue);
            font-weight: bold;
            margin-right: 15px;
        }

        /* Navigation */
        .navbar {
            background: var(--white);
            border-bottom: 3px solid var(--govt-blue);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--govt-blue) !important;
        }

        .nav-link {
            color: var(--govt-blue) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            background-color: var(--light-blue);
            color: var(--govt-blue) !important;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 51, 102, 0.9), rgba(30, 74, 102, 0.9)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect width="100" height="100" fill="%23003366"/><rect x="0" y="0" width="50" height="50" fill="%23004080" opacity="0.3"/><rect x="50" y="50" width="50" height="50" fill="%23004080" opacity="0.3"/></svg>');
            color: white;
            padding: 120px 0 80px;
            text-align: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-cta {
            background: var(--govt-gold);
            color: var(--govt-blue);
            padding: 15px 40px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .hero-cta:hover {
            background: #ffed4e;
            color: var(--govt-blue);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }

        /* Announcement Bar */
        .announcement-bar {
            background: var(--govt-red);
            color: white;
            padding: 12px 0;
            font-weight: 500;
        }

        .announcement-text {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .announcement-text i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        /* Sections */
        .section {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--govt-blue);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--govt-gold);
        }

        /* About Section */
        .about-section {
            background: var(--govt-gray);
        }

        .about-card {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }

        .about-card .icon {
            width: 70px;
            height: 70px;
            background: var(--govt-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .about-card h4 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--govt-blue);
        }

        /* Quick Links Section */
        .quick-links-section {
            background: var(--white);
            border-top: 1px solid var(--border-color);
        }

        .quick-link-card {
            background: var(--light-blue);
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            text-decoration: none;
            color: var(--govt-blue);
        }

        .quick-link-card:hover {
            border-color: var(--govt-blue);
            background: var(--white);
            color: var(--govt-blue);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        .quick-link-card i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--govt-blue);
        }

        .quick-link-card h5 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        /* Programs Section */
        .programs-section {
            background: var(--govt-gray);
        }

        .program-card {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }

        .program-header {
            background: var(--govt-blue);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .program-header i {
            font-size: 3.5rem;
            margin-bottom: 15px;
        }

        .program-body {
            padding: 30px;
        }

        .program-body h5 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--govt-blue);
        }

        /* Statistics Section */
        .stats-section {
            background: var(--govt-blue);
            color: white;
            padding: 60px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--govt-gold);
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            font-weight: 500;
        }

        /* Contact Section */
        .contact-section {
            background: var(--white);
        }

        .contact-card {
            background: var(--govt-gray);
            border-left: 5px solid var(--govt-blue);
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 0 8px 8px 0;
            height: 100%;
        }

        .contact-card .icon {
            width: 60px;
            height: 60px;
            background: var(--govt-blue);
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .contact-card h5 {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--govt-blue);
        }

        /* Footer */
        .footer {
            background: var(--govt-blue);
            color: white;
            padding: 50px 0 30px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--govt-gold);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.2);
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .govt-header {
                text-align: center;
            }
        }

        /* Accessibility */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    </style>
</head>
<body>
    <!-- Government Header -->
    <div class="govt-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex align-items-center">
                    <div class="govt-emblem">
                        <i class="bi bi-shield-fill"></i>
                    </div>
                    <div>
                        <strong>Government of Education</strong><br>
                        <small>Ministry of Education & Human Resource Development</small>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <small>
                        <i class="bi bi-telephone me-1"></i> Helpline: 1800-123-4567 |
                        <i class="bi bi-clock me-1"></i> Mon-Fri 9:00 AM - 5:00 PM
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div class="govt-emblem me-2">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                Pinnacle Academy
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#programs">Academic Programs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#admissions">Admissions</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Announcement Bar -->
    <div class="announcement-bar">
        <div class="container">
            <div class="announcement-text">
                <i class="bi bi-megaphone-fill"></i>
                <span><strong>Notice:</strong> Admissions for Academic Year 2025-26 are now open. Apply before March 31, 2025</span>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="hero-title">Pinnacle Academy</h1>
                    <p class="hero-subtitle">A Premier Government Educational Institution committed to Excellence, Integrity, and Innovation in Education</p>
                    <a href="#about" class="hero-cta">
                        <i class="bi bi-info-circle me-2"></i>
                        Learn More About Our Institution
                    </a>
                </div>
                <div class="col-lg-4">
                    <img src="https://lh3.googleusercontent.com/gps-cs-s/AC9h4no6l_k_1S4lNpB1jbicudYjy921Takqos2cjvS2eD89QBZO1v1loFbevvDRk4fK2krbkhZlR01yONw1UHutueeXsh_15z4iQ-VcxxlTV1fE222ZgpIBUwPmHt0oi9F1dIUTGEl9=s1360-w1360-h1020-rw" alt="School Building" class="img-fluid rounded shadow-lg" style="border: 3px solid var(--govt-gold);">
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links Section -->
    <section class="quick-links-section section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <a href="#admissions" class="quick-link-card d-block">
                        <i class="bi bi-file-text-fill"></i>
                        <h5>Online Admission</h5>
                        <p class="mb-0">Apply for admission online</p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#results" class="quick-link-card d-block">
                        <i class="bi bi-trophy-fill"></i>
                        <h5>Examination Results</h5>
                        <p class="mb-0">View latest exam results</p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#faculty" class="quick-link-card d-block">
                        <i class="bi bi-people-fill"></i>
                        <h5>Faculty Portal</h5>
                        <p class="mb-0">Teacher login and resources</p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#downloads" class="quick-link-card d-block">
                        <i class="bi bi-download"></i>
                        <h5>Downloads</h5>
                        <p class="mb-0">Forms, syllabi & documents</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section about-section">
        <div class="container">
            <h2 class="section-title">About Our Institution</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="about-card">
                        <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Excellence" class="img-fluid rounded mb-3" style="height: 200px; width: 100%; object-fit: cover;">
                        <div class="icon">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <h4>Excellence in Education</h4>
                        <p>Recognized as one of the premier government educational institutions with a track record of academic excellence spanning over 50 years.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-card">
                        <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Library" class="img-fluid rounded mb-3" style="height: 200px; width: 100%; object-fit: cover;">
                        <div class="icon">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <h4>Comprehensive Curriculum</h4>
                        <p>Following the latest CBSE curriculum with emphasis on holistic development, critical thinking, and practical learning approaches.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-card">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Technology" class="img-fluid rounded mb-3" style="height: 200px; width: 100%; object-fit: cover;">
                        <div class="icon">
                            <i class="bi bi-globe"></i>
                        </div>
                        <h4>Future-Ready Education</h4>
                        <p>Preparing students for global challenges with modern facilities, technology integration, and skill-based learning programs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="programs" class="section programs-section">
        <div class="container">
            <h2 class="section-title">Academic Programs</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="program-card">
                        <div class="program-header">
                            <i class="bi bi-palette-fill"></i>
                            <h4>Primary Education</h4>
                            <p class="mb-0">Classes I - V</p>
                        </div>
                        <div class="program-body">
                            <h5>Foundation Years</h5>
                            <p>Building strong fundamentals through activity-based learning, play-way methods, and comprehensive personality development.</p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Activity-Based Learning</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Art & Craft Programs</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Sports & Physical Education</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="program-card">
                        <div class="program-header">
                            <i class="bi bi-journal-code"></i>
                            <h4>Secondary Education</h4>
                            <p class="mb-0">Classes VI - X</p>
                        </div>
                        <div class="program-body">
                            <h5>Skill Development</h5>
                            <p>Advanced curriculum focusing on conceptual understanding, practical applications, and career orientation programs.</p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Science & Mathematics Labs</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Computer Education</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Vocational Courses</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="program-card">
                        <div class="program-header">
                            <i class="bi bi-mortarboard-fill"></i>
                            <h4>Senior Secondary</h4>
                            <p class="mb-0">Classes XI - XII</p>
                        </div>
                        <div class="program-body">
                            <h5>Career Preparation</h5>
                            <p>Specialized streams in Science, Commerce, and Humanities with focus on competitive exam preparation and higher education.</p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Stream Selection</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Career Counseling</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Entrance Exam Coaching</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">5000+</div>
                        <div class="stat-label">Students Enrolled</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">95%</div>
                        <div class="stat-label">Pass Percentage</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">200+</div>
                        <div class="stat-label">Qualified Faculty</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Years of Excellence</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section contact-section">
        <div class="container">
            <h2 class="section-title">Contact Information</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="contact-card">
                        <div class="icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h5>Postal Address</h5>
                        <p>Pinnacle Academy<br>
                        123 Education Street<br>
                        Government Complex<br>
                        Learning City - 123456</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-card">
                        <div class="icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <h5>Phone Numbers</h5>
                        <p>Office: (0123) 456-7890<br>
                        Admission: (0123) 456-7891<br>
                        Principal: (0123) 456-7892<br>
                        Toll-Free: 1800-123-4567</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-card">
                        <div class="icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h5>Email Addresses</h5>
                        <p>General: info@pinnacleacademy.gov.in<br>
                        Admission: admission@pinnacleacademy.gov.in<br>
                        Principal: principal@pinnacleacademy.gov.in<br>
                        Grievance: grievance@pinnacleacademy.gov.in</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#admissions">Admission Process</a></li>
                        <li><a href="#results">Examination Results</a></li>
                        <li><a href="#faculty">Faculty Details</a></li>
                        <li><a href="#infrastructure">Infrastructure</a></li>
                        <li><a href="#achievements">Achievements</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Academic</h5>
                    <ul class="footer-links">
                        <li><a href="#curriculum">Curriculum</a></li>
                        <li><a href="#time-table">Time Table</a></li>
                        <li><a href="#syllabus">Syllabus</a></li>
                        <li><a href="#library">Library</a></li>
                        <li><a href="#labs">Laboratories</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Important</h5>
                    <ul class="footer-links">
                        <li><a href="#notices">Notices & Circulars</a></li>
                        <li><a href="#forms">Download Forms</a></li>
                        <li><a href="#holidays">Holiday List</a></li>
                        <li><a href="#grievance">Grievance Redressal</a></li>
                        <li><a href="#rti">RTI Information</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Connect With Us</h5>
                    <p>Follow our official social media channels for updates and announcements.</p>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Pinnacle Academy. All rights reserved. | Website designed and maintained by Government IT Department</p>
                <p class="mb-0">
                    <a href="#privacy" class="text-white">Privacy Policy</a> |
                    <a href="#terms" class="text-white">Terms of Use</a> |
                    <a href="#accessibility" class="text-white">Accessibility</a> |
                    <a href="#sitemap" class="text-white">Sitemap</a>
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerOffset = 100;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Active nav link
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;
                if (sectionTop <= 150) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

        // Stats counter animation
        function animateValue(obj, start, end, duration) {
            let start