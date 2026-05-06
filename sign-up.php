<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Handle registration form submission
if(isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobileno'];
    $email = $_POST['emailid'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $bloodgroup = $_POST['bloodgroup'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $status = 1;
    $password = md5($_POST['password']);
    
    // Check if email already exists
    $ret = "SELECT EmailId FROM tblblooddonars WHERE EmailId=:email";
    $query = $dbh->prepare($ret);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    if($query->rowCount() == 0) {
        $sql = "INSERT INTO tblblooddonars(FullName, MobileNumber, EmailId, Age, Gender, BloodGroup, Address, Message, status, Password) 
                VALUES(:fullname, :mobile, :email, :age, :gender, :bloodgroup, :address, :message, :status, :password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        
        if($lastInsertId) {
            $success = "You have registered successfully. Please login to continue.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    } else {
        $error = "Email ID already exists. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Donor Management System | Sign Up</title>
    <meta name="description" content="Register as a blood donor and help save lives. Create your account in just a few simple steps.">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Custom CSS for Sign Up Page -->
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
            display: flex;
            flex-direction: min-height;
            min-height: 100vh;
        }
        
        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
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
        
        .signup-section {
            padding: 60px 0 80px;
            flex: 1;
        }
        
        .signup-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .signup-header {
            background: var(--gradient-primary);
            padding: 30px;
            text-align: center;
            color: #fff;
        }
        
        .signup-header h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .signup-header p {
            margin: 0;
            opacity: 0.9;
        }
        
        .signup-form {
            padding: 40px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark-color);
        }
        
        .form-control, .form-select {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
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
        
        .btn-signup {
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
        
        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
            background: var(--gradient-primary);
        }
        
        .form-check {
            margin-bottom: 20px;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 15px;
        }
        
        .login-link a {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: 5px;
            transition: all 0.3s ease;
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
            background-color: #27ae60;
            width: 100%;
        }
        
        .requirements {
            font-size: 13px;
            color: #666;
            margin-top: 5px;
        }
        
        .requirements i {
            color: #27ae60;
            margin-right: 5px;
        }
        
        .requirements i.invalid {
            color: #e74c3c;
        }
        
        .donor-benefits {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
        }
        
        .donor-benefits h5 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .benefit-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        
        .benefit-item i {
            color: var(--primary-color);
            margin-right: 10px;
            margin-top: 3px;
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
            
            .signup-form {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <?php include('includes/header.php'); ?>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h1>Join Our Life-Saving Community</h1>
                    <p>Register as a blood donor and help save lives. Your donation can make a difference.</p>
                    
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item">
                                <a href="index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <!-- Sign Up Section -->
        <section class="signup-section">
            <div class="container">
                <div class="signup-container">
                    <div class="signup-header">
                        <h2>Create Your Account</h2>
                        <p>Join our community of life-savers today</p>
                    </div>
                    
                    <div class="signup-form">
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
                        
                        <form action="#" method="post" name="signup" id="signupForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullname">Full Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobileno">Mobile Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                            <input type="tel" class="form-control" id="mobileno" name="mobileno" placeholder="Enter mobile number" maxlength="10" pattern="[0-9]{10}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emailid">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter email address" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter age" min="18" max="65" required>
                                        </div>
                                        <small class="text-muted">Must be between 18-65 years</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-venus-mars"></i>
                                            </span>
                                            <select class="form-select" id="gender" name="gender" required>
                                                <option value="" selected disabled>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bloodgroup">Blood Group</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-tint"></i>
                                            </span>
                                            <select class="form-select" id="bloodgroup" name="bloodgroup" required>
                                                <option value="" selected disabled>Select Blood Group</option>
                                                <?php 
                                                $sql = "SELECT * FROM tblbloodgroup";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                
                                                if($query->rowCount() > 0) {
                                                    foreach($results as $result) { ?>
                                                        <option value="<?php echo htmlspecialchars($result->BloodGroup); ?>">
                                                            <?php echo htmlspecialchars($result->BloodGroup); ?>
                                                        </option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter your address" required></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Additional Message (Optional)</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-comment"></i>
                                    </span>
                                    <textarea class="form-control" id="message" name="message" rows="2" placeholder="Any additional information"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength" id="passwordStrength"></div>
                                <div class="requirements">
                                    <small>Password must contain:</small>
                                    <div><i class="fas fa-check-circle" id="length"></i> At least 8 characters</div>
                                    <div><i class="fas fa-check-circle" id="uppercase"></i> At least 1 uppercase letter</div>
                                    <div><i class="fas fa-check-circle" id="number"></i> At least 1 number</div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirmpassword">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm password" required>
                                </div>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a>
                                </label>
                            </div>
                            
                            <button type="submit" class="btn btn-signup" name="submit">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </form>
                        
                        <div class="login-link">
                            Already have an account? <a href="login.php">Sign In</a>
                        </div>
                        
                        <div class="donor-benefits">
                            <h5>Why Become a Blood Donor?</h5>
                            <div class="benefit-item">
                                <i class="fas fa-heart"></i>
                                <div>Save up to 3 lives with a single donation</div>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-clock"></i>
                                <div>The process takes only about 10 minutes</div>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-shield-alt"></i>
                                <div>It's safe and your body quickly replenishes the blood</div>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-users"></i>
                                <div>Join a community of life-savers</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Terms Modal -->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Eligibility Criteria</h6>
                        <ul>
                            <li>Must be between 18-65 years of age</li>
                            <li>Weight must be at least 45 kg</li>
                            <li>Must be in good health</li>
                            <li>Should not have any chronic illnesses</li>
                        </ul>
                        
                        <h6>Donation Process</h6>
                        <p>Blood donation is a safe process. A sterile needle is used only once for each donor and then discarded.</p>
                        
                        <h6>Privacy Policy</h6>
                        <p>Your personal information will be kept confidential and will only be used for blood donation purposes.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include Footer -->
        <?php include('includes/footer.php'); ?>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Update icon
                const icon = this.querySelector('i');
                icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
            });
            
            // Password strength checker
            const passwordStrength = document.getElementById('passwordStrength');
            const lengthCheck = document.getElementById('length');
            const uppercaseCheck = document.getElementById('uppercase');
            const numberCheck = document.getElementById('number');
            
            password.addEventListener('input', function() {
                const value = this.value;
                let strength = 0;
                
                // Check length
                if (value.length >= 8) {
                    strength += 1;
                    lengthCheck.classList.remove('invalid');
                } else {
                    lengthCheck.classList.add('invalid');
                }
                
                // Check uppercase
                if (value.match(/[A-Z]/)) {
                    strength += 1;
                    uppercaseCheck.classList.remove('invalid');
                } else {
                    uppercaseCheck.classList.add('invalid');
                }
                
                // Check number
                if (value.match(/[0-9]/)) {
                    strength += 1;
                    numberCheck.classList.remove('invalid');
                } else {
                    numberCheck.classList.add('invalid');
                }
                
                // Update strength indicator
                passwordStrength.className = 'password-strength';
                if (strength <= 1) {
                    passwordStrength.classList.add('strength-weak');
                } else if (strength === 2) {
                    passwordStrength.classList.add('strength-medium');
                } else {
                    passwordStrength.classList.add('strength-strong');
                }
            });
            
            // Form validation
            const signupForm = document.getElementById('signupForm');
            
            signupForm.addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmpassword').value;
                const email = document.getElementById('emailid').value;
                const age = document.getElementById('age').value;
                const terms = document.getElementById('terms').checked;
                
                // Check if passwords match
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Passwords do not match. Please try again.');
                    return false;
                }
                
                // Check password strength
                if (password.length < 8 || !password.match(/[A-Z]/) || !password.match(/[0-9]/)) {
                    e.preventDefault();
                    alert('Password does not meet the requirements. Please choose a stronger password.');
                    return false;
                }
                
                // Check age
                if (age < 18 || age > 65) {
                    e.preventDefault();
                    alert('You must be between 18-65 years old to donate blood.');
                    return false;
                }
                
                // Check terms
                if (!terms) {
                    e.preventDefault();
                    alert('You must agree to the Terms and Conditions to register.');
                    return false;
                }
                
                return true;
            });
            
            // Initialize requirement icons as invalid
            document.querySelectorAll('.requirements i').forEach(icon => {
                icon.classList.add('invalid');
            });
        });
    </script>
</body>
</html>