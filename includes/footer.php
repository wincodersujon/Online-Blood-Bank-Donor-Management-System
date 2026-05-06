<?php
error_reporting(0);
// Database connection
include('includes/config.php');
?>
<footer class="bg-dark text-light pt-5 pb-4">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="footer-about">
                    <h3 class="footer-logo mb-3">
                        <a href="index.php" class="text-white text-decoration-none d-flex align-items-center">
                            <span class="logo-text">Blood Bank</span>
                            <span class="logo-sub">& Donor</span>
                            <i class="fas fa-tint ms-2 text-danger"></i>
                        </a>
                    </h3>
                    <p class="text-white mb-4">Connecting donors with those in need, our platform makes it easy to find and request blood donations in emergency situations. Join our community of life-savers today.</p>
                    
                    <div class="social-icons">
                        <h5 class="text-white mb-3">Follow Us</h5>
                        <div class="d-flex">
                            <a href="#" class="social-icon bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon bg-info text-white rounded-circle me-2 d-flex align-items-center justify-content-center">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon bg-danger text-white rounded-circle me-2 d-flex align-items-center justify-content-center">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h5 class="text-white mb-4 position-relative">
                    Contact Information
                    <span class="position-absolute bottom-0 start-0 w-25 border-bottom border-primary"></span>
                </h5>
                <div class="contact-info">
                    <?php 
                    $sql = "SELECT * FROM tblcontactusinfo";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    
                    if($query->rowCount() > 0) {
                        foreach($results as $result) { ?>
                            <div class="contact-item mb-3 d-flex">
                                <div class="contact-icon me-3">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </div>
                                <div class="contact-text">
                                    <h6 class="text-white mb-1">Address</h6>
                                    <p class="text-white mb-0"><?php echo htmlspecialchars($result->Address); ?></p>
                                </div>
                            </div>
                            
                            <div class="contact-item mb-3 d-flex">
                                <div class="contact-icon me-3">
                                    <i class="fas fa-phone-alt text-primary"></i>
                                </div>
                                <div class="contact-text">
                                    <h6 class="text-white mb-1">Phone</h6>
                                    <p class="text-white mb-0">+<?php echo htmlspecialchars($result->ContactNo); ?></p>
                                </div>
                            </div>
                            
                            <div class="contact-item d-flex">
                                <div class="contact-icon me-3">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <div class="contact-text">
                                    <h6 class="text-white mb-1">Email</h6>
                                    <a href="mailto:<?php echo htmlspecialchars($result->EmailId); ?>" class="text-light">
                                        <?php echo htmlspecialchars($result->EmailId); ?>
                                    </a>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="alert alert-warning">
                            <p class="mb-0">Contact information not available at the moment.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-4 col-md-12">
                <h5 class="text-white mb-4 position-relative">
                    Quick Links
                    <span class="position-absolute bottom-0 start-0 w-25 border-bottom border-primary"></span>
                </h5>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="index.php" class="text-light text-decoration-none d-flex align-items-center">
                                    <i class="fas fa-chevron-right me-2 text-primary"></i> Home
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="about.php" class="text-light text-decoration-none d-flex align-items-center">
                                    <i class="fas fa-chevron-right me-2 text-primary"></i> About Us
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="donor-list.php" class="text-light text-decoration-none d-flex align-items-center">
                                    <i class="fas fa-chevron-right me-2 text-primary"></i> Donor List
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="search-donor.php" class="text-light text-decoration-none d-flex align-items-center">
                                    <i class="fas fa-chevron-right me-2 text-primary"></i> Search Donor
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="contact.php" class="text-light text-decoration-none d-flex align-items-center">
                                    <i class="fas fa-chevron-right me-2 text-primary"></i> Contact Us
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="admin/index.php" class="text-light text-decoration-none d-flex align-items-center">
                                    <i class="fas fa-chevron-right me-2 text-primary"></i> Admin
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Newsletter Subscription -->
                <div class="newsletter mt-4">
                    <h5 class="text-white mb-3">Subscribe to Newsletter</h5>
                    <form action="#" method="post" class="d-flex">
                        <input type="email" class="form-control me-2" placeholder="Your email address" required>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Copyright Section -->
        <div class="border-top border-secondary mt-5 pt-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-light">© <?php echo date('Y'); ?> Online Blood Bank & Donor Management System. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-light me-3">Privacy Policy</a>
                    <a href="#" class="text-light me-3">Terms of Use</a>
                    <a href="#" class="text-light">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back to Top Button -->
    <a href="#" id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>
</footer>

<!-- Custom CSS for Footer -->
<style>
    .footer-logo .logo-text {
        font-size: 24px;
        font-weight: 700;
        color: #fff;
    }
    
    .footer-logo .logo-sub {
        font-size: 24px;
        font-weight: 400;
        color: #fff;
    }
    
    .social-icon {
        width: 40px;
        height: 40px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .social-icon:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    
    .contact-item {
        transition: transform 0.3s ease;
    }
    
    .contact-item:hover {
        transform: translateX(5px);
    }
    
    .contact-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    
    .back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background: var(--primary-color, #e74c3c);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .back-to-top.show {
        opacity: 1;
        visibility: visible;
    }
    
    .back-to-top:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        color: white;
    }
    
    @media (max-width: 768px) {
        .footer-logo .logo-text,
        .footer-logo .logo-sub {
            font-size: 20px;
        }
    }
</style>

<!-- JavaScript for Back to Top Button -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopButton = document.getElementById('backToTop');
        
        // Show/hide the button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });
        
        // Smooth scroll to top when clicking the button
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>