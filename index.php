<?php
// FIX 1: Added session_start() at the very top
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Bank & Donor Management System | Home Page</title>

    <!-- Optimized CSS -->
    <style>
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #3498db;
            --accent-color: #2c3e50;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
            --gradient-primary: linear-gradient(135deg, #e74c3c, #c0392b);
            --gradient-secondary: linear-gradient(135deg, #3498db, #2980b9);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Performance optimizations */
        .gpu-accelerated {
            transform: translateZ(0);
            backface-visibility: hidden;
        }

        /* Header Styles */
        .top-bar {
            background: var(--dark-color);
            padding: 10px 0;
            font-size: 14px;
        }

        .top-bar a {
            color: var(--light-color);
            transition: color 0.2s ease;
        }

        .top-bar a:hover {
            color: var(--primary-color);
        }

        .main-top {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
        }

        .navbar-brand span {
            color: var(--dark-color);
        }

        .navbar-brand i {
            margin-left: 10px;
            font-size: 24px;
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            color: var(--dark-color) !important;
            margin: 0 10px;
            position: relative;
            transition: color 0.2s ease;
        }

        .navbar-nav .nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.2s ease;
        }

        .navbar-nav .nav-link:hover:after {
            width: 100%;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .navbar-nav .nav-item.active .nav-link {
            color: var(--primary-color) !important;
        }

        .navbar-nav .nav-item.active .nav-link:after {
            width: 100%;
        }

        .login-button {
            background: var(--gradient-primary);
            border: none;
            color: white !important;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
            color: white !important;
        }

        /* Hero Section Styles - Fixed */
        .slider {
            position: relative;
            overflow: hidden;
        }

        .banner-top1,
        .banner-top2,
        .banner-top3 {
            height: 80vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .banner-top1 {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/blood-donation-hero.jpg');
        }

        .banner-top2 {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/blood-donation-hero2.jpg');
        }

        .banner-top3 {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/blood-donation-hero3.jpg');
        }

        .banner-info_agile_w3ls {
            text-align: center;
            color: white;
            padding: 20px;
            max-width: 800px;
            position: relative;
            z-index: 2;
        }

        .banner-info_agile_w3ls h3 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .banner-info_agile_w3ls span {
            color: var(--primary-color);
            display: block;
        }

        /* ResponsiveSlides Plugin Styles */
        .callbacks_container {
            position: relative;
            width: 100%;
        }

        .callbacks {
            position: relative;
            list-style: none;
            overflow: hidden;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .callbacks li {
            position: absolute;
            width: 100%;
            left: 0;
            top: 0;
            opacity: 0;
            z-index: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .callbacks li.active {
            opacity: 1;
            z-index: 2;
        }

        .callbacks_nav {
            position: absolute;
            top: 50%;
            left: 0;
            opacity: 0.7;
            z-index: 3;
            text-indent: -9999px;
            overflow: hidden;
            text-decoration: none;
            height: 61px;
            width: 38px;
            background: transparent url("themes/themes.gif") no-repeat left top;
            margin-top: -45px;
        }

        .callbacks_nav.next {
            left: auto;
            background-position: right top;
            right: 0;
        }

        .callbacks_nav:hover {
            opacity: 1;
        }

        .rslides_tabs {
            margin-top: 10px;
            text-align: center;
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            z-index: 3;
        }

        .rslides_tabs li {
            display: inline-block;
            margin: 0 5px;
        }

        .rslides_tabs a {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            display: inline-block;
            text-indent: -9999px;
            overflow: hidden;
            transition: background 0.3s ease;
        }

        .rslides_tabs a:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        .rslides_tabs a.rslides_here {
            background: white;
        }

        /* Banner Bottom Section */
        .banner-bottom {
            background: var(--gradient-primary);
            position: relative;
            margin-top: -50px;
            z-index: 10;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .banner-left-bottom-w3ls h3 {
            font-size: 32px;
            font-weight: 700;
        }

        .button .w3ls-button-agile {
            background: white;
            color: var(--primary-color);
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .button .w3ls-button-agile:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            color: var(--primary-color);
        }

        .button .w3ls-button-agile i {
            margin-left: 10px;
        }

        /* Donor Section - Fixed */
        .blog-w3ls {
            background: white;
            padding: 80px 0;
        }

        .w3ls-titles h3 {
            font-size: 36px;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .w3ls-titles h3:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--primary-color);
        }

        .w3ls-titles span {
            font-size: 40px;
            color: var(--primary-color);
            margin: 20px 0;
            display: block;
        }

        .package-grids {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .pricing {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .pricing:hover {
            transform: translateY(-5px);
        }

        .price-top {
            position: relative;
            overflow: hidden;
            height: 250px;
        }

        .price-top img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .pricing:hover .price-top img {
            transform: scale(1.05);
        }

        .price-top h3 {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(231, 76, 60, 0.8);
            color: white;
            padding: 15px;
            margin: 0;
            font-weight: 600;
            font-size: 20px;
        }

        .price-bottom {
            padding: 20px;
        }

        .price-bottom h4 {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark-color);
        }

        .price-bottom p {
            margin-bottom: 15px;
        }

        .btn-request {
            background: var(--gradient-primary);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: inline-block;
        }

        .btn-request:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
            color: white;
        }

        /* Blood Groups Section */
        .screen-w3ls {
            background: var(--light-color);
            padding: 80px 0;
        }

        .screen-w3ls .w3ls-titles h3 {
            color: var(--dark-color);
        }

        .screen-w3ls .w3ls-titles span {
            color: var(--secondary-color);
        }

        .screen-w3ls ul {
            list-style-type: none;
            padding-left: 0;
        }

        .screen-w3ls ul li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            position: relative;
            padding-left: 30px;
        }

        .screen-w3ls ul li:before {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: var(--success-color);
            position: absolute;
            left: 0;
        }

        .screen-w3ls h4 {
            color: var(--dark-color);
            font-weight: 700;
            margin-bottom: 20px;
        }

        .btn-become-donor {
            background: var(--gradient-secondary);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            display: inline-block;
            color: white;
        }

        .btn-become-donor:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
            color: white;
        }

        /* Footer Styles */
        footer {
            background: var(--dark-color);
            color: var(--light-color);
            padding: 60px 0 20px;
        }

        footer h2,
        footer h3 {
            color: white;
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        footer h2:after,
        footer h3:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--primary-color);
        }

        footer a {
            color: var(--light-color);
            transition: color 0.2s ease;
        }

        footer a:hover {
            color: var(--primary-color);
        }

        footer ul li {
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
        }

        footer ul li i {
            margin-right: 10px;
            margin-top: 5px;
            color: var(--primary-color);
        }

        .border-top {
            border-color: rgba(255, 255, 255, 0.1) !important;
            margin-top: 40px !important;
            padding-top: 30px !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .banner-info_agile_w3ls h3 {
                font-size: 32px;
            }

            .banner-top1,
            .banner-top2,
            .banner-top3 {
                height: 60vh;
            }

            .banner-bottom {
                margin-top: -30px;
            }

            .w3ls-titles h3 {
                font-size: 28px;
            }

            .screen-w3ls {
                padding: 60px 0;
            }

            .blog-w3ls {
                padding: 60px 0;
            }

            .package-grids {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
        }
    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/fontawesome-all.css">
  <!-- Bootstrap CSS If you are face responsive problem then 2 link uncomment -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- Web-Fonts -->
    <link href="//fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <!-- Fixed banner with original working slider -->
    <div class="slider">
        <div class="callbacks_container">
            <ul class="rslides callbacks callbacks1" id="slider4">
                <li>
                    <div class="banner-top1">
                        <div class="banner-info_agile_w3ls">
                            <div class="container">
                                <h3>Professional Blood Banking Solutions
                                    <span>Save Lives Today</span>
                                </h3>
                                <p class="lead mt-3">Bridging the gap between blood donors and recipients through our advanced management system. Every donation counts in our mission to save lives.</p>
                                <div class="mt-4">
                                    <a href="about.php" class="btn btn-lg btn-light mr-3">Discover More</a>
                                    <a href="donor-list.php" class="btn btn-lg btn-outline-light">Browse Donors</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="banner-top2">
                        <div class="banner-info_agile_w3ls">
                            <div class="container">
                                <h3>One Donation Can Transform
                                    <span>Multiple Lives</span>
                                </h3>
                                <p class="lead mt-3">Your selfless act of blood donation creates ripples of hope in our community. Join thousands who make a difference every single day.</p>
                                <div class="mt-4">
                                    <a href="search-donor.php" class="btn btn-lg btn-light mr-3">Find Matching Donors</a>
                                    <a href="sign-up.php" class="btn btn-lg btn-outline-light" data-toggle="modal">Get In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="banner-top3">
                        <div class="banner-info_agile_w3ls">
                            <div class="container">
                                <h3>When Every Second Matters
                                    <span>Blood Makes the Difference</span>
                                </h3>
                                <p class="lead mt-3">Become part of our life-saving network. Your contribution ensures critical medical procedures never wait for blood availability.</p>
                                <div class="mt-4">
                                    <a href="contact.php" class="btn btn-lg btn-light mr-3">Get in Touch</a>
                                    <a href="sign-up.php" class="btn btn-lg btn-outline-light">Register Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="clearfix"></div>

    <!-- banner bottom -->
    <div class="banner-bottom py-5">
        <div class="container py-xl-3 py-lg-3">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="text-white my-3">Certified Medical Experts</h3>
                    <p class="text-white">Our healthcare professionals possess extensive field experience and participate regularly in specialized training programs at renowned medical centers across the globe. The well-being and safety of our donors and recipients remain our foremost priority in every procedure we perform.</p>
                </div>
                <div class="col-lg-4 text-lg-right text-center mt-lg-0 mt-4">
                    <div class="button">
                        <a href="about.php" class="w3ls-button-agile">Read More
                            <i class="fas fa-hand-point-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //banner bottom -->

    <!-- blog with fixed donor list -->
    <div class="blog-w3ls py-5" id="blog">
        <div class="container py-xl-5 py-lg-3">
            <div class="w3ls-titles text-center mb-5">
                <h3 class="title">Some of the Donors</h3>
                <span>
                    <i class="fas fa-user-md"></i>
                </span>
                <p class="mt-3">Meet our generous donors who are helping save lives every day</p>
            </div>
            <div class="package-grids">
                <?php
                $status = 1;
                $sql = "SELECT * from tblblooddonars where status=:status order by rand() limit 6";
                $query = $dbh->prepare($sql);
                $query->bindParam(':status', $status, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>
                        <div class="pricing">
                            <div class="price-top">
                                <img src="images/blood-donor.jpg" alt="" class="img-fluid" />
                                <h3><?php echo htmlentities($result->FullName); ?></h3>
                            </div>
                            <div class="price-bottom p-4">
                                <h4 class="text-dark mb-3">Gender: <?php echo htmlentities($result->Gender); ?></h4>
                                <p class="card-text"><b>Blood Group :</b> <?php echo htmlentities($result->BloodGroup); ?></p>

                                <a class="btn-request" style="color:#fff" href="contact-blood.php?cid=<?php echo $result->id; ?>">Request</a>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-12 text-center py-5">
                        <p>No donors found at the moment.</p>
                    </div>
                <?php } ?>
            </div>

            <div class="text-center mt-5">
                <a href="donor-list.php" class="btn btn-lg btn-primary">View All Donors</a>
            </div>
        </div>
    </div>
    <!-- //blog -->

    <!-- treatments -->
    <div class="screen-w3ls py-5">
        <div class="container py-xl-5 py-lg-3">
            <div class="w3ls-titles text-center mb-5">
                <h3 class="title">BLOOD GROUPS</h3>
                <span>
                    <i class="fas fa-tint"></i>
                </span>
                <p class="mt-2">Every individual's blood classification belongs to one of these primary categories...</p>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm p-4">
                        <h4 class="mb-4">Common Blood Types</h4>
                        <ul>
                            <li>A positive or A negative</li>
                            <li>B positive or B negative</li>
                            <li>O positive or O negative</li>
                            <li>AB positive or AB negative.</li>
                        </ul>
                        <div class="alert alert-info mt-4">
                            <h5>Fuel Up for Your Donation</h5>
                            <p class="mb-0">Eating right before donating blood makes the experience smoother and helps you feel great afterward! Explore our suggested meal options to prepare for your life-saving contribution.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <img class="img-fluid rounded" src="images/blood-donor (1).jpg" alt="Blood Donation">
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-0 shadow-sm p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4>UNIVERSAL DONOR & RECIPIENT CONCEPTS</h4>
                                <p class="mt-3">Blood type O represents the most prevalent blood group globally, with type A being the second most common.</p>
                                <p>Individuals with type O blood are classified as "universal donors" due to their compatibility with all blood types during transfusion. Conversely, those with type AB blood are designated as "universal recipients" as they can safely receive blood from any blood group.</p>
                            </div>
                            <div class="col-md-4 text-md-right text-center mt-md-0 mt-4">
                                <a class="btn btn-lg btn-become-donor" data-toggle="modal" data-target="#exampleModalCenter1" href="#">Become a Donor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //treatments -->

    <!-- footer -->
    <?php include('includes/footer.php'); ?>

    <!-- JavaScript files -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <script src="js/bootstrap.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // FIX 2: Added the dropdown fix script inside DOMContentLoaded
            // This manually initializes all Bootstrap dropdowns to prevent conflicts.
            var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });


            // Initialize the slider with original working code
            $("#slider4").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 1000,
                namespace: "callbacks",
                before: function() {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function() {
                    $('.events').append("<li>after event fired.</li>");
                }
            });
        });

        // Performance optimization: Throttle scroll events
        function throttle(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            }
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Optimize scrolling performance
        let ticking = false;

        function updateScrollPosition() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    // Add any scroll-based animations here
                    ticking = false;
                });
                ticking = true;
            }
        }

        window.addEventListener('scroll', updateScrollPosition);

        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.classList.add('fade-in');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img').forEach(img => {
                imageObserver.observe(img);
            });
        }
    </script>

    <style>
        /* Add fade-in animation for lazy loaded images */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</body>

</html>