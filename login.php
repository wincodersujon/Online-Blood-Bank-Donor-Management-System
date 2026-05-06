<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Handle login form submission
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $sql = "SELECT id, FullName FROM tblblooddonars WHERE EmailId=:email AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    if($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['bbdmsdid'] = $result->id;
            $_SESSION['bbdmsname'] = $result->FullName;
        }
        $_SESSION['login'] = $_POST['email'];
        echo "<script type='text/javascript'> document.location ='index.php'; </script>";
    } else {
        $error = "Invalid email or password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Donor Management System | Login</title>
    <meta name="description" content="Login to access your blood donor account and manage your donations.">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Custom CSS for Login Page -->
    <style>
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #3498db;
            --accent-color: #2c3e50;
            --light-color: #f8f9fa;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f5f7fa;
            color: #444;
            line-height: 1.6;
        }
        
        .hero-section {
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.9), rgba(231, 76, 60, 0.7)), 
                        url('images/blood-donation-hero.jpg') center/cover no-repeat;
            min-height: 40vh;
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
        
        .login-section {
            padding: 80px 0;
        }
        
        .login-container {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .login-header {
            background: var(--gradient-primary);
            padding: 30px;
            text-align: center;
            color: #fff;
        }
        
        .login-header h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .login-header p {
            margin: 0;
            opacity: 0.9;
        }
        
        .login-form {
            padding: 40px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-group label {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark-color);
        }
        
        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
        }
        
        .input-group-text {
            background: transparent;
            border: 1px solid #e0e0e0;
            border-right: none;
            color: #777;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
        }
        
        .btn-login {
            background: var(--gradient-primary);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-weight: 600;
            padding: 15px;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
            background: var(--gradient-primary);
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .form-check {
            display: flex;
            align-items: center;
        }
        
        .form-check-input {
            margin-right: 8px;
        }
        
        .forgot-password {
            color: var(--primary-color);
            font-size: 14px;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e0e0e0;
        }
        
        .divider span {
            background: #fff;
            padding: 0 15px;
            color: #777;
            position: relative;
        }
        
        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .social-btn.facebook:hover {
            background: #3b5998;
            color: #fff;
            border-color: #3b5998;
        }
        
        .social-btn.google:hover {
            background: #db4437;
            color: #fff;
            border-color: #db4437;
        }
        
        .social-btn.twitter:hover {
            background: #1da1f2;
            color: #fff;
            border-color: #1da1f2;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 20px;
            font-size: 15px;
        }
        
        .signup-link a {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 12px 15px;
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
            
            .login-form {
                padding: 30px 20px;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
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
                <h1>Donor Login</h1>
                <p>Access your account to manage your blood donations and save lives</p>
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="login-container">
                <div class="login-header">
                    <h2>Welcome Back</h2>
                    <p>Please login to your account</p>
                </div>
                
                <div class="login-form">
                    <?php if(isset($error)) { ?>
                    <div class="alert-danger">
                        <?php echo $error; ?>
                    </div>
                    <?php } ?>
                    
                    <form action="#" method="post" name="login">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                        </div>
                        
                        <div class="form-options">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                            <a href="#" class="forgot-password">Forgot Password?</a>
                        </div>
                        
                        <button type="submit" class="btn btn-login" name="login">Login</button>
                    </form>
                    
                    <div class="divider">
                        <span>OR</span>
                    </div>
                    
                    <div class="social-login">
                        <a href="#" class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-btn google">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-btn twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                    
                    <div class="signup-link">
                        Don't have an account? <a href="sign-up.php">Create one now</a>
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
            const loginForm = document.querySelector('form[name="login"]');
            
            loginForm.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                
                if (!email || !password) {
                    e.preventDefault();
                    alert('Please fill in all fields');
                    return false;
                }
                
                // Simple email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    e.preventDefault();
                    alert('Please enter a valid email address');
                    return false;
                }
                
                return true;
            });
            
            // Password visibility toggle (optional enhancement)
            const passwordInput = document.getElementById('password');
            const passwordIcon = passwordInput.previousElementSibling.querySelector('i');
            
            // Create toggle button
            const toggleButton = document.createElement('button');
            toggleButton.type = 'button';
            toggleButton.className = 'btn btn-outline-secondary';
            toggleButton.style.borderLeft = 'none';
            toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
            
            // Add toggle functionality
            toggleButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Update icon
                const icon = this.querySelector('i');
                icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
            });
            
            // Add toggle button to input group
            const inputGroup = passwordInput.closest('.input-group');
            if (inputGroup) {
                inputGroup.appendChild(toggleButton);
            }
        });
    </script>
</body>
</html>