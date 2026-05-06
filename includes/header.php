<?php 
error_reporting(0);
session_start();
// Database connection
include('config.php');

// Function to get current page filename
function getCurrentPage() {
    $currentPage = basename($_SERVER['PHP_SELF']);
    return $currentPage;
}

 $currentPage = getCurrentPage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Bank & Donor Management System</title>
    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Custom CSS for Header -->
    <style>
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #3498db;
            --accent-color: #2c3e50;
            --light-color: #f8f9fa;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
            --gradient-primary: linear-gradient(to right, var(--primary-color), #c0392b);
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Top Bar Styles */
        .top-bar {
            background: var(--dark-color);
            padding: 10px 0;
            font-size: 14px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }
        
        .top-bar a {
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .top-bar a:hover {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .top-social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .top-social-icons a {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .top-social-icons a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
        
        /* Navigation Styles */
        .main-header {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .main-header.scrolled {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }
        
        .navbar-brand {
            color: var(--primary-color);
            font-size: 28px;
            font-weight: 700;
            padding: 15px 0;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .navbar-brand:hover {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .navbar-brand span:first-child {
            color: var(--dark-color);
        }
        
        .navbar-brand i {
            color: var(--primary-color);
            font-size: 24px;
            margin-left: 8px;
        }
        
        .navbar-nav .nav-link {
            padding: 25px 15px;
            color: var(--dark-color);
            font-weight: 500;
            font-size: 16px;
            position: relative;
            margin: 0 5px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
        }
        
        .navbar-nav .nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .navbar-nav .nav-link:hover:after,
        .navbar-nav .nav-item.active .nav-link:after {
            width: 80%;
        }
        
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-item.active .nav-link {
            color: var(--primary-color);
        }
        
        .dropdown-menu {
            border: none;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            margin-top: 15px;
            background: #fff;
            animation: fadeInDown 0.3s ease;
        }
        
        .dropdown-item {
            padding: 10px 20px;
            color: var(--dark-color);
            font-size: 15px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
        }
        
        .dropdown-item:hover {
            background: var(--light-color);
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .login-button {
            background: var(--gradient-primary);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
            text-decoration: none;
            display: inline-block;
        }
        
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
            color: white;
            text-decoration: none;
        }
        
        /* Mobile Navigation */
        .navbar-toggler {
            border: none;
            padding: 5px 10px;
            background: var(--primary-color);
            border-radius: 5px;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                padding: 15px;
                border-radius: 0 0 10px 10px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }
            
            .navbar-nav .nav-link {
                padding: 10px 0;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }
            
            .navbar-nav .nav-link:last-child {
                border-bottom: none;
            }
            
            .navbar-nav {
                width: 100%;
            }
            
            .dropdown-menu {
                position: static !important;
                transform: none !important;
                border: none;
                box-shadow: none;
                background: rgba(0, 0, 0, 0.05);
                margin-top: 0;
                padding-left: 20px;
            }
        }
        
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
    </style>
</head>

<body>
    <!-- Top Bar -->
    <header>
        <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="row align-items-center">
                            <!-- Social Icons -->
                            <div class="col-lg-4 col-md-6">
                                <div class="top-social-icons">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="col-lg-8 col-md-6">
                                <?php 
                                $sql = "SELECT * FROM tblcontactusinfo";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                
                                if($query->rowCount() > 0) {
                                    foreach($results as $result) { ?>
                                        <p class="text-white mb-0">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            <?php echo htmlspecialchars($result->Address); ?>
                                        </p>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="row align-items-center">
                            <!-- Email -->
                            <div class="col-lg-7 col-md-6">
                                <?php 
                                // Re-execute the query since we can't reuse the previous results
                                $sql = "SELECT * FROM tblcontactusinfo";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                
                                if($query->rowCount() > 0) {
                                    foreach($results as $result) { ?>
                                        <p class="text-white mb-0">
                                            <i class="far fa-envelope-open me-2"></i>
                                            <a href="mailto:<?php echo htmlspecialchars($result->EmailId); ?>" class="text-white">
                                                <?php echo htmlspecialchars($result->EmailId); ?>
                                            </a>
                                        </p>
                                    <?php }
                                } ?>
                            </div>
                            <!-- Phone -->
                            <div class="col-lg-5 col-md-6">
                                <?php 
                                // Re-execute the query again for the phone number
                                $sql = "SELECT * FROM tblcontactusinfo";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                
                                if($query->rowCount() > 0) {
                                    foreach($results as $result) { ?>
                                        <p class="text-white mb-0">
                                            <i class="fas fa-phone me-2"></i>
                                            +<?php echo htmlspecialchars($result->ContactNo); ?>
                                        </p>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Navigation -->
    <div class="main-header" id="mainHeader">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="index.php">
                    <span>OBB</span>DMS
                    <i class="fas fa-tint"></i>
                </a>
                
                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Navigation Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item <?php echo ($currentPage == 'about.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item <?php echo ($currentPage == 'donor-list.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="donor-list.php">Donor List</a>
                        </li>
                        <li class="nav-item <?php echo ($currentPage == 'search-donor.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="search-donor.php">Search Donor</a>
                        </li>
                        <li class="nav-item <?php echo ($currentPage == 'sign-up.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="sign-up.php">Become a Donor</a>
                        </li>
                        <li class="nav-item <?php echo ($currentPage == 'contact.php') ? 'active' : ''; ?>">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                        <?php if (isset($_SESSION['bbdmsdid']) && strlen($_SESSION['bbdmsdid']) > 0) { ?>
                            <!-- Logged in User Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i> My Account
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="change-password.php"><i class="fas fa-key me-2"></i>Change Password</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="request-received.php"><i class="fas fa-hand-holding-medical me-2"></i>Request Received</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <!-- Admin Link -->
                            <li class="nav-item <?php echo ($currentPage == 'admin/index.php') ? 'active' : ''; ?>">
                                <a class="nav-link" href="admin/index.php">Admin</a>
                            </li>
                            
                            <!-- Login Button -->
                            <li class="nav-item ms-lg-3">
                                <a href="login.php" class="login-button">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Fixed JavaScript for Header -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap dropdowns
        var dropdownTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
        dropdownTriggerList.map(function (dropdownTriggerEl) {
            return new bootstrap.Dropdown(dropdownTriggerEl);
        });

        // Sticky header functionality
        const header = document.getElementById('mainHeader');
        
        // Add scrolled class to header when page is scrolled
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
        
        // Check initial scroll position
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        }
        
        // Mobile navigation handling
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        // Only apply mobile-specific behavior on small screens
        function isMobileView() {
            return window.innerWidth < 992;
        }
        
        // Close mobile menu when clicking outside (only on mobile)
        document.addEventListener('click', function(event) {
            if (!isMobileView()) return;
            
            const isClickInside = navbarCollapse.contains(event.target) || navbarToggler.contains(event.target);
            
            if (!isClickInside && navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });
        
        // Close mobile menu when clicking on a nav link (only on mobile)
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link:not(.dropdown-toggle)');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (isMobileView() && navbarCollapse.classList.contains('show')) {
                    navbarCollapse.classList.remove('show');
                }
                // Allow normal navigation to proceed
            });
        });
    });
    </script>
</body>
</html>