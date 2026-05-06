<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbdmsdid']==0)) {
  header('location:logout.php');
} else {

if(isset($_POST['change']))
{
 $uid=$_SESSION['bbdmsdid'];
 $cpassword=md5($_POST['currentpassword']);
 $newpassword=md5($_POST['newpassword']);
 $sql ="SELECT ID FROM tblblooddonars WHERE id=:uid and Password=:cpassword";
 $query= $dbh -> prepare($sql);
 $query-> bindParam(':uid', $uid, PDO::PARAM_STR);
 $query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
 $query-> execute();
 $results = $query -> fetchAll(PDO::FETCH_OBJ);

if($query -> rowCount() > 0)
{
 $con="update tblblooddonars set Password=:newpassword where id=:uid";
 $chngpwd1 = $dbh->prepare($con);
 $chngpwd1-> bindParam(':uid', $uid, PDO::PARAM_STR);
 $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
 $chngpwd1->execute();

echo '<script>alert("Your password successfully changed"); window.location.href = "change-password.php";</script>';
} else {
echo '<script>alert("Your current password is wrong")</script>';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Donor Management System | Change Password</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #3498db;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
            --success-color: #2ecc71;
            --gradient-primary: linear-gradient(to right, var(--primary-color), #c0392b);
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Hero Section */
        .hero-section {
            background: var(--gradient-primary);
            padding: 80px 0 60px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('images/pattern.png') repeat;
            opacity: 0.1;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-content h1 {
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }
        
        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 20px;
            border-radius: 50px;
            display: inline-block;
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
        
        /* Password Card */
        .password-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: -50px;
            position: relative;
            z-index: 10;
            transition: transform 0.3s ease;
        }
        
        .password-card:hover {
            transform: translateY(-5px);
        }
        
        .password-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            color: white;
            font-size: 36px;
        }
        
        .form-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
            text-align: center;
        }
        
        .form-subtitle {
            color: #777;
            text-align: center;
            margin-bottom: 40px;
        }
        
        /* Form Styling */
        .form-group {
            position: relative;
            margin-bottom: 25px;
        }
        
        .form-group label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
            display: block;
        }
        
        .form-control {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
            padding-left: 50px;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            outline: none;
        }
        
        .input-icon {
            position: absolute;
            left: 18px;
            top: 48px;
            color: #777;
            font-size: 18px;
        }
        
        .password-toggle {
            position: absolute;
            right: 18px;
            top: 48px;
            color: #777;
            cursor: pointer;
            font-size: 18px;
        }
        
        .password-strength {
            height: 5px;
            border-radius: 3px;
            margin-top: 8px;
            background-color: #eee;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease, background-color 0.3s ease;
        }
        
        .strength-weak {
            background-color: #e74c3c;
            width: 33%;
        }
        
        .strength-medium {
            background-color: #f39c12;
            width: 66%;
        }
        
        .strength-strong {
            background-color: #2ecc71;
            width: 100%;
        }
        
        .btn-change {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            width: 100%;
            margin-top: 10px;
        }
        
        .btn-change:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(231, 76, 60, 0.3);
            color: white;
        }
        
        /* Security Tips */
        .security-tips {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            margin-top: 30px;
        }
        
        .security-tips h4 {
            color: var(--dark-color);
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        
        .security-tips ul {
            padding-left: 20px;
            margin-bottom: 0;
        }
        
        .security-tips li {
            margin-bottom: 8px;
            color: #555;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .password-card {
                padding: 30px 20px;
            }
        }
        
        /* Animation for form elements */
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
        
        .password-card {
            animation: fadeInUp 0.6s ease;
        }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <h1>Change Password</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Password Change Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="password-card">
                        <div class="password-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        
                        <h2 class="form-title">Reset Your Password</h2>
                        <p class="form-subtitle">Create a strong password to secure your account</p>
                        
                        <form action="#" method="post" id="changePasswordForm">
                            <div class="form-group">
                                <label for="currentpassword">Current Password</label>
                                <i class="fas fa-key input-icon"></i>
                                <input type="password" class="form-control" name="currentpassword" id="currentpassword" required>
                                <i class="fas fa-eye-slash password-toggle" data-target="currentpassword"></i>
                            </div>
                            
                            <div class="form-group">
                                <label for="newpassword">New Password</label>
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" class="form-control" name="newpassword" id="newpassword" required>
                                <i class="fas fa-eye-slash password-toggle" data-target="newpassword"></i>
                                <div class="password-strength">
                                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirmpassword">Confirm Password</label>
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
                                <i class="fas fa-eye-slash password-toggle" data-target="confirmpassword"></i>
                                <div class="invalid-feedback" id="passwordMatchFeedback">Passwords do not match</div>
                            </div>
                            
                            <button type="submit" name="change" class="btn-change">
                                <i class="fas fa-sync-alt me-2"></i>Update Password
                            </button>
                        </form>
                        
                        <div class="security-tips">
                            <h4><i class="fas fa-shield-alt me-2"></i>Password Security Tips</h4>
                            <ul>
                                <li>Use at least 8 characters</li>
                                <li>Include uppercase and lowercase letters</li>
                                <li>Add numbers and special characters</li>
                                <li>Avoid using personal information</li>
                                <li>Don't reuse passwords from other accounts</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php');?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const toggleButtons = document.querySelectorAll('.password-toggle');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    } else {
                        input.type = 'password';
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    }
                });
            });
            
            // Password strength checker
            const newPasswordInput = document.getElementById('newpassword');
            const strengthBar = document.getElementById('passwordStrengthBar');
            
            newPasswordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                
                if (password.length >= 8) strength += 1;
                if (password.match(/[a-z]+/)) strength += 1;
                if (password.match(/[A-Z]+/)) strength += 1;
                if (password.match(/[0-9]+/)) strength += 1;
                if (password.match(/[$@#&!]+/)) strength += 1;
                
                strengthBar.className = 'password-strength-bar';
                
                if (password.length > 0) {
                    if (strength <= 2) {
                        strengthBar.classList.add('strength-weak');
                    } else if (strength <= 4) {
                        strengthBar.classList.add('strength-medium');
                    } else {
                        strengthBar.classList.add('strength-strong');
                    }
                }
            });
            
            // Password matching validation
            const confirmPasswordInput = document.getElementById('confirmpassword');
            const form = document.getElementById('changePasswordForm');
            
            confirmPasswordInput.addEventListener('input', function() {
                const password = newPasswordInput.value;
                const confirmPassword = this.value;
                
                if (password !== confirmPassword && confirmPassword.length > 0) {
                    this.classList.add('is-invalid');
                    document.getElementById('passwordMatchFeedback').style.display = 'block';
                } else {
                    this.classList.remove('is-invalid');
                    document.getElementById('passwordMatchFeedback').style.display = 'none';
                }
            });
            
            // Form validation before submission
            form.addEventListener('submit', function(e) {
                const password = newPasswordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('New Password and Confirm Password field does not match');
                    confirmPasswordInput.focus();
                    return false;
                }
                
                return true;
            });
        });
    </script>
</body>
</html>
<?php } ?>