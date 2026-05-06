<?php
session_start();
include('includes/config.php');
if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);
    
    $sql = "SELECT Email FROM tbladmin WHERE Email=:email and MobileNumber=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    
    if($query->rowCount() > 0) {
        $con = "update tbladmin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        $success_msg = "Your password has been successfully changed!";
    } else {
        $error_msg = "Email ID or Mobile number is invalid";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodBank & Donor Management | Reset Password</title>
    
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
            --success-color: #27ae60;
            --danger-color: #e74c3c;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .password-reset-container {
            width: 100%;
            max-width: 450px;
        }
        
        .reset-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }
        
        .card-header-custom::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .card-header-custom i {
            font-size: 48px;
            color: white;
            margin-bottom: 15px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .card-header-custom h2 {
            color: white;
            font-weight: 600;
            margin: 0;
            font-size: 24px;
        }
        
        .card-body-custom {
            padding: 50px 30px 30px;
        }
        
        .form-floating {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 15px;
            transition: all 0.3s ease;
            height: 50px;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.1);
        }
        
        .form-floating label {
            color: #6c757d;
            padding: 12px 15px;
            font-size: 14px;
        }
        
        .form-floating .form-control:focus ~ label,
        .form-floating .form-control:not(:placeholder-shown) ~ label {
            color: var(--primary-color);
            transform: translateY(-10px) scale(0.85);
        }
        
        .input-group-text {
            background: transparent;
            border: 2px solid #e0e0e0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: var(--gray-text);
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .btn-reset {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(231, 76, 60, 0.3);
            color: white;
        }
        
        .btn-reset:active {
            transform: translateY(0);
        }
        
        .divider {
            text-align: center;
            margin: 25px 0;
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
            background: white;
            padding: 0 15px;
            color: var(--gray-text);
            font-size: 14px;
            position: relative;
        }
        
        .back-link {
            display: inline-block;
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .back-link:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
        
        .alert-custom {
            border-radius: 10px;
            padding: 12px 20px;
            margin-bottom: 20px;
            border: none;
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .alert-success-custom {
            background: #d4edda;
            color: #155724;
        }
        
        .alert-danger-custom {
            background: #f8d7da;
            color: #721c24;
        }
        
        .password-strength {
            height: 5px;
            border-radius: 3px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }
        
        .strength-weak { background: #e74c3c; width: 33%; }
        .strength-medium { background: #f39c12; width: 66%; }
        .strength-strong { background: #27ae60; width: 100%; }
        
        @media (max-width: 480px) {
            .card-body-custom {
                padding: 40px 20px 20px;
            }
            
            .card-header-custom {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="password-reset-container">
        <div class="reset-card">
            <div class="card-header-custom">
                <i class="fas fa-lock"></i>
                <h2>Reset Password</h2>
            </div>
            
            <div class="card-body-custom">
                <?php if(isset($success_msg)): ?>
                    <div class="alert alert-success-custom alert-custom">
                        <i class="fas fa-check-circle me-2"></i><?php echo $success_msg; ?>
                    </div>
                <?php endif; ?>
                
                <?php if(isset($error_msg)): ?>
                    <div class="alert alert-danger-custom alert-custom">
                        <i class="fas fa-exclamation-circle me-2"></i><?php echo $error_msg; ?>
                    </div>
                <?php endif; ?>
                
                <form method="post" name="chngpwd" id="resetForm" onsubmit="return validatePassword();">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" 
                               pattern="[0-9]{10}" maxlength="10" required>
                        <label for="mobile"><i class="fas fa-phone me-2"></i>Mobile Number</label>
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control" id="newpassword" name="newpassword" 
                               placeholder="New Password" required onkeyup="checkPasswordStrength(this.value)">
                        <label for="newpassword"><i class="fas fa-key me-2"></i>New Password</label>
                        <div id="passwordStrength" class="password-strength"></div>
                    </div>
                    
                    <div class="form-floating">
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" 
                               placeholder="Confirm Password" required>
                        <label for="confirmpassword"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-reset">
                        <i class="fas fa-sync-alt me-2"></i>Reset Password
                    </button>
                </form>
                
                <div class="divider">
                    <span>OR</span>
                </div>
                
                <div class="text-center">
                    <a href="index.php" class="back-link">
                        <i class="fas fa-arrow-left me-1"></i>Back to Sign In
                    </a>
                </div>
                
                <div class="text-center mt-3">
                    <a href="../index.php" class="btn btn-outline-secondary btn-sm rounded-pill">
                        <i class="fas fa-home me-1"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function validatePassword() {
            const newPassword = document.getElementById('newpassword').value;
            const confirmPassword = document.getElementById('confirmpassword').value;
            
            if(newPassword !== confirmPassword) {
                showNotification('New Password and Confirm Password do not match!', 'danger');
                document.getElementById('confirmpassword').focus();
                return false;
            }
            
            if(newPassword.length < 6) {
                showNotification('Password must be at least 6 characters long!', 'danger');
                return false;
            }
            
            return true;
        }
        
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('passwordStrength');
            let strength = 0;
            
            if(password.length >= 6) strength++;
            if(password.length >= 10) strength++;
            if(/[A-Z]/.test(password) && /[a-z]/.test(password)) strength++;
            if(/[0-9]/.test(password)) strength++;
            if(/[^A-Za-z0-9]/.test(password)) strength++;
            
            strengthBar.className = 'password-strength';
            
            if(strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if(strength <= 4) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        }
        
        function showNotification(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}-custom alert-custom`;
            alertDiv.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle me-2"></i>${message}`;
            
            const form = document.getElementById('resetForm');
            form.parentNode.insertBefore(alertDiv, form);
            
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }
        
        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>