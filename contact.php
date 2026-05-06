<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Handle contact form submission
if(isset($_POST['send'])) {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $message = $_POST['message'];
    
    // Validate input
    $name = htmlspecialchars(trim($name));
    $email = htmlspecialchars(trim($email));
    $contactno = htmlspecialchars(trim($contactno));
    $message = htmlspecialchars(trim($message));
    
    // Basic validation
    if(empty($name) || empty($email) || empty($contactno) || empty($message)) {
        $error = "Please fill in all required fields.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif(!preg_match('/^[0-9]{10}$/', $contactno)) {
        $error = "Please enter a valid 10-digit phone number.";
    } else {
        try {
            $sql = "INSERT INTO tblcontactusquery(name, EmailId, ContactNumber, Message) VALUES(:name, :email, :contactno, :message)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':name', $name, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
            $query->bindParam(':message', $message, PDO::PARAM_STR);
            $query->execute();
            
            if($query->rowCount() > 0) {
                $success = "Your query has been sent successfully. We will contact you shortly.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        } catch(PDOException $e) {
            $error = "Database error: " . $e->getMessage();
            // In production, you might want to log this error instead of showing it to users
            // $error = "Something went wrong. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Donor Management System | Contact Us</title>
    <meta name="description" content="Contact us for any queries about blood donation or to become a donor. We're here to help save lives together.">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Custom CSS for Contact Page -->
    <style>
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #3498db;
            --accent-color: #2c3e50;
            --light-color: #f8f9fa;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
            --gradient-primary: linear-gradient(135deg, #e74c3c, #c0392b);
            --gradient-secondary: linear-gradient(135deg, #3498db, #2980b9);
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.08);
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f5f7fa;
            color: #444;
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        /* Optimized for performance */
        * {
            box-sizing: border-box;
        }
        
        img {
            max-width: 100%;
            height: auto;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.9), rgba(231, 76, 60, 0.7)), 
                        url('images/contact-hero.jpg') center/cover no-repeat;
            min-height: 50vh;
            display: flex;
            align-items: center;
            color: #fff;
            position: relative;
        }
        
        .hero-content {
            text-align: center;
            padding: 80px 0;
        }
        
        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            animation: fadeInDown 0.8s ease;
        }
        
        .hero-content p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            animation: fadeInUp 0.8s ease;
        }
        
        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 20px;
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
        
        .contact-section {
            padding: 80px 0;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 50px;
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
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--primary-color);
        }
        
        .section-title p {
            max-width: 700px;
            margin: 0 auto;
            color: #666;
        }
        
        .contact-form-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .contact-form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark-color);
            display: block;
        }
        
        .form-control, .form-select {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 15px;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
            outline: none;
        }
        
        .btn-submit {
            background: var(--gradient-primary);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            padding: 12px 30px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
            background: var(--gradient-primary);
        }
        
        /* Contact Information Styles */
        .contact-info-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
            height: 100%;
        }
        
        .contact-info-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 25px;
            display: flex;
            align-items: flex-start;
            transition: all 0.3s ease;
            height: auto;
        }
        
        .contact-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .contact-info-card .icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            flex-shrink: 0;
            margin-right: 15px;
        }
        
        .contact-info-card .info-content {
            flex-grow: 1;
        }
        
        .contact-info-card h4 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
        }
        
        .contact-info-card p, .contact-info-card a {
            color: #666;
            margin-bottom: 5px;
            display: block;
        }
        
        .contact-info-card a:hover {
            color: var(--primary-color);
            text-decoration: none;
            transform: translateX(3px);
            transition: all 0.2s ease;
        }
        
        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }
        
        .social-links a {
            width: 36px;
            height: 36px;
            background: rgba(231, 76, 60, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: var(--primary-color);
            color: #fff;
            transform: translateY(-3px);
        }
        
        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            height: 400px;
            margin-bottom: 30px;
        }
        
        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }
        
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
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
            
            .contact-form-container {
                padding: 25px 15px;
                margin-bottom: 20px;
            }
            
            .contact-info-card {
                padding: 20px;
            }
            
            .contact-info-card .icon {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
            
            .contact-info-card h4 {
                font-size: 1.1rem;
            }
            
            .social-links a {
                width: 32px;
                height: 32px;
                font-size: 14px;
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
                <h1>Contact Us</h1>
                <p>Get in touch with us for any queries about blood donation or to become a donor. We're here to help save lives together.</p>
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="section-title">
                <h2>Get In Touch</h2>
                <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>
            
            <div class="row g-4">
                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="contact-form-container">
                        <?php if(isset($success)) { ?>
                        <div class="alert-success">
                            <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                        </div>
                        <?php } ?>
                        
                        <?php if(isset($error)) { ?>
                        <div class="alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                        </div>
                        <?php } ?>
                        
                        <form action="#" method="post" id="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullname">Full Name</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="contactno">Phone Number</label>
                                <input type="tel" class="form-control" id="contactno" name="contactno" placeholder="Enter your phone number" pattern="[0-9]{10}" required>
                                <small class="form-text text-muted">10-digit mobile number</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-submit" name="send">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="col-lg-4">
                    <div class="contact-info-wrapper">
                        <div class="contact-info-card">
                            <div class="icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content">
                                <h4>Address</h4>
                                <p>Dhaka<br>Bangladesh, 1212</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-card">
                            <div class="icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="info-content">
                                <h4>Phone</h4>
                                <p><a href="tel:+1234567890">+880 1688238801</a></p>
                            </div>
                        </div>
                        
                        <div class="contact-info-card">
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-content">
                                <h4>Email</h4>
                                <p><a href="mailto:sujoncse26@gmail.com">topsourcecode9@gmail.com</a></p>
                                <p><a href="mailto:sujoncse26@gmail.com">sujoncse26@gmail.com</a></p>
                            </div>
                        </div>
                        
                        <div class="contact-info-card">
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <h4>Working Hours</h4>
                                <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p>Saturday: 9:00 AM - 2:00 PM</p>
                                <p>Sunday: Closed</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-card">
                            <div class="icon">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <div class="info-content">
                                <h4>Follow Us</h4>
                                <div class="social-links">
                                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Map -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.8793557276!2d-74.01234567890123!3d40.71234567890123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDUwLjUyTiA3NC4wMTIzNDU2NzgxMjM!5e0!3m2!1sen!2sus!4v1234567890" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php'); ?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const contactForm = document.getElementById('contactForm');
            
            contactForm.addEventListener('submit', function(e) {
                const name = document.getElementById('fullname').value.trim();
                const email = document.getElementById('email').value.trim();
                const phone = document.getElementById('contactno').value.trim();
                const message = document.getElementById('message').value.trim();
                
                // Simple validation
                if (!name || !email || !phone || !message) {
                    e.preventDefault();
                    alert('Please fill in all fields');
                    return false;
                }
                
                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    e.preventDefault();
                    alert('Please enter a valid email address');
                    return false;
                }
                
                // Phone validation
                const phoneRegex = /^[0-9]{10}$/;
                if (!phoneRegex.test(phone)) {
                    e.preventDefault();
                    alert('Please enter a valid 10-digit phone number');
                    return false;
                }
                
                return true;
            });
        });
    </script>
</body>
</html>