<?php
// Include configuration file
include('includes/config.php');

// Initialize variables
 $donors = [];
 $error = '';

try {
    // Fetch active donors from database
    $sql = "SELECT * FROM tblblooddonars WHERE status = :status ORDER BY FullName ASC";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $status = 1; // Active status
    $query->execute();
    $donors = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Donor Management System | Blood Donor List</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #c0392b;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-text);
            background-color: #f5f5f5;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0;
        }
        
        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .breadcrumb-item a:hover {
            color: white;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .section-title h3 {
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
        }
        
        .section-title .icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .donor-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 2rem;
            background-color: white;
        }
        
        .donor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        .donor-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }
        
        .donor-name {
            font-weight: 600;
            color: var(--dark-text);
            margin-top: 1rem;
        }
        
        .donor-details {
            padding: 1.5rem;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 500;
            color: #555;
        }
        
        .detail-value {
            color: var(--dark-text);
        }
        
        .blood-group {
            background-color: var(--primary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            margin-top: 0.5rem;
        }
        
        .request-btn {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            font-weight: 500;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 1rem;
        }
        
        .request-btn:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .filter-section {
            background-color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }
        
        .filter-btn {
            background-color: var(--light-bg);
            border: 1px solid #ddd;
            color: var(--dark-text);
            padding: 0.5rem 1rem;
            border-radius: 30px;
            margin: 0.25rem;
            transition: all 0.3s;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .no-donors {
            text-align: center;
            padding: 3rem;
            background-color: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
        }
        
        .no-donors i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }
        
        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blood Donor List</li>
                </ol>
            </nav>
            <h1 class="display-5 fw-bold mt-3">Blood Donor List</h1>
            <p class="lead">Find blood donors in your area</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <!-- Section Title -->
        <div class="section-title">
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <h3>Available Blood Donors</h3>
            <p class="text-muted">Connect with life-saving blood donors in your community</p>
        </div>

        <!-- Error Message -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- Filter Section -->
        <div class="filter-section">
            <h5 class="mb-3">Filter by Blood Group:</h5>
            <div class="d-flex flex-wrap">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="A+">A+</button>
                <button class="filter-btn" data-filter="A-">A-</button>
                <button class="filter-btn" data-filter="B+">B+</button>
                <button class="filter-btn" data-filter="B-">B-</button>
                <button class="filter-btn" data-filter="AB+">AB+</button>
                <button class="filter-btn" data-filter="AB-">AB-</button>
                <button class="filter-btn" data-filter="O+">O+</button>
                <button class="filter-btn" data-filter="O-">O-</button>
            </div>
        </div>

        <!-- Donor List -->
        <div class="row" id="donor-container">
            <?php if (count($donors) > 0): ?>
                <?php foreach ($donors as $donor): ?>
                    <div class="col-lg-4 col-md-6 donor-item" data-blood-group="<?php echo $donor->BloodGroup; ?>">
                        <div class="donor-card">
                            <img src="images/blood-donor.jpg" alt="Blood Donor" class="donor-image">
                            <div class="donor-details">
                                <h4 class="donor-name"><?php echo htmlspecialchars($donor->FullName); ?></h4>
                                <span class="blood-group"><?php echo htmlspecialchars($donor->BloodGroup); ?></span>
                                
                                <div class="mt-3">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-venus-mars me-2"></i>Gender</span>
                                        <span class="detail-value"><?php echo htmlspecialchars($donor->Gender); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-phone me-2"></i>Mobile</span>
                                        <span class="detail-value"><?php echo htmlspecialchars($donor->MobileNumber); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-envelope me-2"></i>Email</span>
                                        <span class="detail-value"><?php echo htmlspecialchars($donor->EmailId); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-birthday-cake me-2"></i>Age</span>
                                        <span class="detail-value"><?php echo htmlspecialchars($donor->Age); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-map-marker-alt me-2"></i>Address</span>
                                        <span class="detail-value"><?php echo htmlspecialchars($donor->Address); ?></span>
                                    </div>
                                </div>
                                
                                <a href="contact-blood.php?cid=<?php echo $donor->id; ?>" class="btn request-btn">
                                    <i class="fas fa-hand-holding-medical me-2"></i>Request Blood
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="no-donors">
                        <i class="fas fa-user-slash"></i>
                        <h4>No Donors Found</h4>
                        <p class="text-muted">There are currently no blood donors available. Please check back later.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Filter functionality
            $('.filter-btn').click(function() {
                // Update active button
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');
                
                // Get filter value
                var filterValue = $(this).data('filter');
                
                // Filter donors
                if (filterValue === 'all') {
                    $('.donor-item').show();
                } else {
                    $('.donor-item').hide();
                    $('.donor-item[data-blood-group="' + filterValue + '"]').show();
                }
            });
        });
    </script>
</body>
</html>