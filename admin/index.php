<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
 $username=$_POST['username'];
 $password=md5($_POST['password']);
 $sql ="SELECT UserName,Password FROM tbladmin WHERE UserName=:username and Password=:password";
 $query= $dbh -> prepare($sql);
 $query-> bindParam(':username', $username, PDO::PARAM_STR);
 $query-> bindParam(':password', $password, PDO::PARAM_STR);
 $query-> execute();
 $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
 $_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Online Blood Bank & Donor Management System | Admin Login</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #c0392b;
            --blood-color: #8B0000; /* Dark blood red */
            --blood-light: #CD5C5C; /* Lighter blood color */
            --accent-color: #ffffff;
            --text-color: #333333;
            --light-bg: rgba(255, 255, 255, 0.9);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 15px;
            position: relative;
            z-index: 10;
        }
        
        .login-card {
            background: var(--light-bg);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }
        
        .login-header {
            background: var(--primary-color);
            padding: 20px;
            text-align: center;
            color: var(--accent-color);
        }
        
        .login-header h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .login-header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .blood-drops {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .blood-drop {
            position: absolute;
            background: linear-gradient(135deg, var(--blood-color) 0%, var(--blood-light) 100%);
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            opacity: 0.6;
            animation: falling 15s linear infinite;
            box-shadow: 0 0 10px rgba(139, 0, 0, 0.3);
        }
        
        .blood-drop::before {
            content: '';
            position: absolute;
            top: 10%;
            left: 10%;
            width: 30%;
            height: 30%;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            filter: blur(5px);
        }
        
        .blood-drop:nth-child(1) {
            width: 50px;
            height: 50px;
            left: 10%;
            animation-duration: 10s;
            animation-delay: 0s;
            background: linear-gradient(135deg, var(--blood-color) 0%, #A52A2A 100%);
        }
        
        .blood-drop:nth-child(2) {
            width: 30px;
            height: 30px;
            left: 30%;
            animation-duration: 12s;
            animation-delay: 2s;
            background: linear-gradient(135deg, #8B0000 0%, var(--blood-light) 100%);
        }
        
        .blood-drop:nth-child(3) {
            width: 40px;
            height: 40px;
            left: 50%;
            animation-duration: 8s;
            animation-delay: 1s;
            background: linear-gradient(135deg, var(--blood-color) 0%, #B22222 100%);
        }
        
        .blood-drop:nth-child(4) {
            width: 60px;
            height: 60px;
            left: 70%;
            animation-duration: 15s;
            animation-delay: 3s;
            background: linear-gradient(135deg, #800000 0%, var(--blood-light) 100%);
        }
        
        .blood-drop:nth-child(5) {
            width: 25px;
            height: 25px;
            left: 90%;
            animation-duration: 11s;
            animation-delay: 4s;
            background: linear-gradient(135deg, #8B0000 0%, #DC143C 100%);
        }
        
        .blood-drop:nth-child(6) {
            width: 35px;
            height: 35px;
            left: 15%;
            animation-duration: 13s;
            animation-delay: 5s;
            background: linear-gradient(135deg, var(--blood-color) 0%, #A52A2A 100%);
        }
        
        .blood-drop:nth-child(7) {
            width: 45px;
            height: 45px;
            left: 85%;
            animation-duration: 9s;
            animation-delay: 6s;
            background: linear-gradient(135deg, #800000 0%, var(--blood-light) 100%);
        }
        
        @keyframes falling {
            0% {
                top: -100px;
                opacity: 0;
                transform: rotate(-45deg) scale(0.8);
            }
            10% {
                opacity: 0.6;
                transform: rotate(-45deg) scale(1);
            }
            90% {
                opacity: 0.6;
                transform: rotate(-45deg) scale(1);
            }
            100% {
                top: 100vh;
                opacity: 0;
                transform: rotate(-45deg) scale(0.8);
            }
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px 12px 45px;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2);
            outline: none;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
        }
        
        .btn-login {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }
        
        .btn-login:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.3);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }
        
        .forgot-password a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        
        .forgot-password a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .back-home {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .back-home a {
            display: inline-block;
            background: #f8f9fa;
            color: var(--text-color);
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .back-home a:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }
        
        .blood-icon {
            font-size: 50px;
            color: var(--accent-color);
            margin-bottom: 15px;
            animation: pulse 2s infinite;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
        
        .alert-message {
            background: rgba(231, 76, 60, 0.1);
            border-left: 4px solid var(--primary-color);
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 8px;
        }
        
        .remember-me label {
            font-size: 14px;
            color: #666;
        }
        
        /* Blood splash effect */
        .blood-splash {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, var(--blood-color) 0%, transparent 70%);
            border-radius: 50%;
            opacity: 0.2;
            z-index: 0;
        }
    </style>
</head>
<body>
    <div class="blood-drops">
        <div class="blood-drop"></div>
        <div class="blood-drop"></div>
        <div class="blood-drop"></div>
        <div class="blood-drop"></div>
        <div class="blood-drop"></div>
        <div class="blood-drop"></div>
        <div class="blood-drop"></div>
    </div>
    
    <div class="blood-splash"></div>
    
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="fas fa-tint blood-icon"></i>
                <h2>Admin Login</h2>
                <p>Online Blood Bank & Donor Management System</p>
            </div>
            
            <div class="login-body">
                <div class="alert-message" id="alertMessage">
                    <i class="fas fa-exclamation-circle"></i> Invalid username or password
                </div>
                
                <form method="post" id="loginForm">
                    <div class="form-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" placeholder="Username" name="username" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" placeholder="Password" name="password" class="form-control" required>
                    </div>
                    
                    <div class="form-footer">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="forgot-password.php">Forgot Password?</a>
                    </div>
                    
                    <button type="submit" name="login" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> LOGIN
                    </button>
                </form>
                
                <div class="back-home">
                    <a href="../index.php">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if there's an error message in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('error') === '1') {
                document.getElementById('alertMessage').style.display = 'block';
            }
            
            // Form validation
            const loginForm = document.getElementById('loginForm');
            loginForm.addEventListener('submit', function(e) {
                const username = document.querySelector('input[name="username"]').value;
                const password = document.querySelector('input[name="password"]').value;
                
                if (!username || !password) {
                    e.preventDefault();
                    document.getElementById('alertMessage').style.display = 'block';
                    document.getElementById('alertMessage').innerHTML = '<i class="fas fa-exclamation-circle"></i> Please enter both username and password';
                }
            });
            
            // Hide alert when user starts typing
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('input', function() {
                    document.getElementById('alertMessage').style.display = 'none';
                });
            });
            
            // Create additional blood drops dynamically
            function createBloodDrop() {
                const bloodDrops = document.querySelector('.blood-drops');
                const drop = document.createElement('div');
                drop.className = 'blood-drop';
                drop.style.width = Math.random() * 30 + 20 + 'px';
                drop.style.height = drop.style.width;
                drop.style.left = Math.random() * 100 + '%';
                drop.style.animationDuration = Math.random() * 10 + 10 + 's';
                drop.style.animationDelay = Math.random() * 5 + 's';
                
                const bloodColors = [
                    'linear-gradient(135deg, #8B0000 0%, #CD5C5C 100%)',
                    'linear-gradient(135deg, #800000 0%, #A52A2A 100%)',
                    'linear-gradient(135deg, #8B0000 0%, #B22222 100%)',
                    'linear-gradient(135deg, #A52A2A 0%, #DC143C 100%)'
                ];
                drop.style.background = bloodColors[Math.floor(Math.random() * bloodColors.length)];
                
                bloodDrops.appendChild(drop);
                
                // Remove the drop after animation completes
                setTimeout(() => {
                    drop.remove();
                }, 20000);
            }
            
            // Create new blood drops periodically
            setInterval(createBloodDrop, 3000);
        });
    </script>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>