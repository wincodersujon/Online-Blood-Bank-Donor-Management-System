<?php
error_reporting(0);
session_start();
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Bank & Donor Management System | About Us</title>
    <meta name="description" content="Learn about our blood bank management system, our mission, vision, and our commitment to saving lives through blood donation.">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Custom CSS for About Page -->
    <style>
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #3498db;
            --accent-color: #2c3e50;
            --light-color: #f8f9fa;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
            --gradient-primary: linear-gradient(to right, var(--primary-color), #c0392b);
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: #555;
            line-height: 1.7;
        }
        
        .hero-section {
            background: linear-gradient(rgba(44, 62, 80, 0.85), rgba(44, 62, 80, 0.85)), 
                        url('images/about-hero.jpg') center/cover no-repeat;
            padding: 150px 0 100px;
            color: #fff;
            position: relative;
            text-align: center;
        }
        
        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }
        
        .hero-content p {
            font-size: 1.3rem;
            max-width: 700px;
            margin: 0 auto 30px;
            color: #fff;
            animation: fadeInUp 1s ease;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px 25px;
            border-radius: 50px;
            display: inline-block;
            margin-top: 20px;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.7);
            content: ">";
        }
        
        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.9);
            transition: color 0.3s ease;
        }
        
        .breadcrumb-item a:hover {
            color: #fff;
        }
        
        .breadcrumb-item.active {
            color: #fff;
        }
        
        .section-padding {
            padding: 80px 0;
        }

        .section-title {
            position: relative;
            margin-bottom: 60px;
            text-align: center;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 15px;
        }
        
        .section-title h2:after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary-color);
        }

        .about-image {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease;
        }
        
        .about-image:hover {
            transform: scale(1.03);
        }
        
        .about-text {
            font-size: 1.1rem;
            line-height: 1.9;
            text-align: justify;
        }

        .mission-vision-box {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            height: 100%;
            transition: all 0.3s ease;
        }

        .mission-vision-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }
        
        .mission-vision-box .icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: #fff;
            font-size: 2.2rem;
        }

        .mission-vision-box h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 15px;
        }
        
        .feature-box {
            text-align: center;
            padding: 30px 20px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
            transition: all 0.4s ease;
            height: 100%;
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .feature-box .icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: #fff;
            font-size: 2.5rem;
            transition: all 0.3s ease;
        }
        
        .feature-box:hover .icon {
            background: var(--gradient-primary);
            transform: rotateY(180deg);
        }

        .feature-box h4 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 15px;
        }

        .cta-section {
            background: var(--gradient-primary);
            padding: 100px 0;
            color: #fff;
            text-align: center;
        }
        
        .cta-section h2 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 25px;
        }
        
        .cta-section p {
            font-size: 1.3rem;
            max-width: 700px;
            margin: 0 auto 40px;
        }
        
        .btn-custom-lg {
            background: #fff;
            color: var(--primary-color);
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            display: inline-block;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn-custom-lg:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            color: var(--primary-color);
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }
            .section-title h2 {
                font-size: 1.8rem;
            }
            .cta-section h2 {
                font-size: 2rem;
            }
            .section-padding {
                padding: 60px 0;
            }
        }
    </style>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>About Us</h1>
                <p>Learn about our mission, vision, and our commitment to saving lives through blood donation.</p>
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">About Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

   <!-- Main About Content -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="about-image">
                    <img src="images/about-us.jpg" alt="About Us" class="img-fluid" style="max-height: 400px; width: auto; object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">About Our Blood Bank</h2>
                <div class="about-text">
                    <p>Our Blood Bank Management System is dedicated to building a strong bridge between blood donors and recipients in need. We provide a platform that makes it easy for donors to register their information and for those in need to find compatible blood donors quickly.</p>
                    <p>Through our user-friendly interface and comprehensive database, we strive to close the gap between blood donors and recipients, ensuring that life-saving blood is available when it's needed most.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Mission & Vision Section -->
    <section class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Our Mission & Vision</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="mission-vision-box">
                        <div class="icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3>Our Mission</h3>
                        <p>To ensure safe and suitable blood reaches every person in urgent need, saving lives through technology and community collaboration.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mission-vision-box">
                        <div class="icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3>Our Vision</h3>
                        <p>To create a society where no patient dies due to a lack of blood, and every healthy individual voluntarily participates in blood donation.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mission-vision-box">
                        <div class="icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Our Values</h3>
                        <p>We believe in transparency, compassion, and excellence. Every blood donation is a precious gift, and we handle that gift with respect and care.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose Us?</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-box">
                        <div class="icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Safety & Trust</h4>
                        <p>We follow the highest standards of hygiene and ensure that every blood donation is safe and properly tested.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-box">
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>24/7 Availability</h4>
                        <p>Our platform is always open for emergencies, ensuring you can find a suitable donor at any time of day or night.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-box">
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Large Community</h4>
                        <p>We have a vast network of thousands of registered donors, ensuring quick assistance for any blood group.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-box">
                        <div class="icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h4>Free Service</h4>
                        <p>Our services are completely free for both donors and recipients. We believe in humanitarian service over commercial profit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Join Our Mission Today</h2>
            <p>Register as a donor and help save lives. Your contribution can make a significant difference in someone's life.</p>
            <a href="sign-up.php" class="btn-custom-lg">
                <i class="fas fa-user-plus me-2"></i>Register as a Donor
            </a>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>