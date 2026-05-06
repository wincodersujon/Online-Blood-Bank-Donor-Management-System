<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['send'])) {
    $cid=$_GET['cid'];
    $name=$_POST['fullname'];
    $email=$_POST['email'];
    $contactno=$_POST['contactno'];
    $brf=$_POST['brf'];
    $message=$_POST['message'];
    $sql="INSERT INTO  tblbloodrequirer(BloodDonarID,name,EmailId,ContactNumber,BloodRequirefor,Message) VALUES(:cid,:name,:email,:contactno,:brf,:message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':cid',$cid,PDO::PARAM_STR);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
    $query->bindParam(':brf',$brf,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId) {
        echo '<script>alert("Request has been sent. We will contact you shortly.")</script>';
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";  
    }
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Blood Bank Donar Management System | Blood Requirer</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #e74c3c;
            --primary-dark: #c0392b;
            --secondary-color: #3498db;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --gray-text: #6c757d;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-text);
            line-height: 1.6;
        }
        
        /* Header Styles */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            color: var(--dark-text) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        /* Banner Styles */
        .banner-section {
            background: linear-gradient(rgba(231, 76, 60, 0.85), rgba(192, 57, 43, 0.85)), url('img/blood-banner.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
        }
        
        .banner-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            animation: fadeInDown 0.8s ease;
        }
        
        .banner-subtitle {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            animation: fadeInUp 0.8s ease;
        }
        
        /* Breadcrumb Styles */
        .breadcrumb-section {
            background: white;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .breadcrumb {
            background: transparent;
            margin: 0;
            padding: 0;
        }
        
        .breadcrumb-item a {
            color: var(--gray-text);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .breadcrumb-item a:hover {
            color: var(--primary-color);
        }
        
        .breadcrumb-item.active {
            color: var(--primary-color);
        }
        
        /* Form Section Styles */
        .form-section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }
        
        .section-title h2::after {
            content: '';
            position: absolute;
            width: 70px;
            height: 4px;
            background: var(--primary-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        .section-title p {
            color: var(--gray-text);
            max-width: 700px;
            margin: 20px auto 0;
        }
        
        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            margin-top: 30px;
            transition: transform 0.3s ease;
        }
        
        .form-card:hover {
            transform: translateY(-5px);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.1);
        }
        
        select.form-control {
            cursor: pointer;
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: none;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(231, 76, 60, 0.3);
            color: white;
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        /* Info Card Styles */
        .info-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            height: 100%;
            transition: transform 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
        }
        
        .info-card h3 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .info-item i {
            color: var(--primary-color);
            font-size: 20px;
            width: 40px;
            text-align: center;
        }
        
        /* Footer Styles */
        footer {
            background: var(--dark-text);
            color: white;
            padding: 50px 0 20px;
        }
        
        .footer-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }
        
        .footer-links a {
            color: #bbb;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
        }
        
        .social-icons a {
            color: white;
            font-size: 20px;
            margin-right: 15px;
            transition: color 0.3s ease;
        }
        
        .social-icons a:hover {
            color: var(--primary-color);
        }
        
        .copyright {
            border-top: 1px solid #444;
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
            color: #bbb;
        }
        
        /* Animation */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .banner-title {
                font-size: 2rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .form-card {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
<?php include('includes/header.php'); ?>
    
    <!-- Banner Section -->
    <section class="banner-section">
        <div class="container">
            <h1 class="banner-title">Request Blood</h1>
            <p class="banner-subtitle">Fill out the form below to request blood. We'll connect you with suitable donors as soon as possible.</p>
        </div>
    </section>
    
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blood Request</li>
                </ol>
            </nav>
        </div>
    </section>
    
    <!-- Form Section -->
    <section class="form-section">
        <div class="container">
            <div class="section-title">
                <h2>Blood Request Form</h2>
                <p>Your request is important to us. Please provide accurate information so we can help you find the right blood donor quickly.</p>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-card">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullname" class="form-label">Your Name</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactno" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="contactno" name="contactno" placeholder="Enter your phone number" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brf" class="form-label">Blood Required For</label>
                                        <select class="form-control" id="brf" name="brf" required>
                                            <option value="" selected disabled>Select relationship</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Brother">Brother</option>
                                            <option value="Sister">Sister</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="message" class="form-label">Additional Message</label>
                                <textarea class="form-control" id="message" name="message" placeholder="Provide any additional information that might help us find the right donor for you" rows="5"></textarea>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" name="send" class="btn-submit">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="info-card">
                        <h3><i class="fas fa-info-circle me-2"></i>Request Information</h3>
                        <p>When you submit a blood request, our system will:</p>
                        <ul class="list-unstyled">
                            <li class="info-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Match your requirements with available donors</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Contact suitable donors on your behalf</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Provide you with donor contact information</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Follow up to ensure the request is fulfilled</span>
                            </li>
                        </ul>
                        
                        <div class="mt-4">
                            <h4>Need Help?</h4>
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <span>+880 1688238801</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <span>sujoncse26@gmail.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const fullname = document.getElementById('fullname').value.trim();
            const email = document.getElementById('email').value.trim();
            const contactno = document.getElementById('contactno').value.trim();
            const brf = document.getElementById('brf').value;
            
            if (!fullname || !email || !contactno || !brf) {
                e.preventDefault();
                alert('Please fill in all required fields.');
                return false;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                return false;
            }
            
            // Phone validation (simple)
            const phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(contactno.replace(/\s/g, ''))) {
                e.preventDefault();
                alert('Please enter a valid 10-digit phone number.');
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>