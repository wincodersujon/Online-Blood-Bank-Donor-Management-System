<?php
// Include configuration file
include('includes/config.php');

// Initialize variables
 $donors = [];
 $searchPerformed = false;
 $error = '';

// Process search form submission
if (isset($_POST['sub'])) {
    $searchPerformed = true;
    $bloodgroup = $_POST['bloodgroup'] ?? '';
    $location = $_POST['location'] ?? '';
    
    try {
        $status = 1;
        
        // Build query based on search criteria
        $sql = "SELECT * FROM tblblooddonars WHERE status = :status";
        $params = [':status' => $status];
        
        if (!empty($bloodgroup)) {
            $sql .= " AND BloodGroup = :bloodgroup";
            $params[':bloodgroup'] = $bloodgroup;
        }
        
        if (!empty($location)) {
            $sql .= " AND Address LIKE :location";
            $params[':location'] = '%' . $location . '%';
        }
        
        $query = $dbh->prepare($sql);
        
        // Bind parameters
        foreach ($params as $key => $value) {
            $query->bindValue($key, $value);
        }
        
        $query->execute();
        $donors = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}

// Fetch blood groups for dropdown
try {
    $bloodGroups = [];
    $sql = "SELECT * FROM tblbloodgroup";
    $query = $dbh->prepare($sql);
    $query->execute();
    $bloodGroups = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Bank & Donor Management System | Search Blood Donor</title>
    
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
        
        .search-section {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 0.75rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.25);
        }
        
        .search-btn {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .search-btn:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .results-section {
            margin-top: 2rem;
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
            height: 100%;
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
        
        .no-results {
            text-align: center;
            padding: 3rem;
            background-color: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
        }
        
        .no-results i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }
        
        .alert {
            border-radius: 10px;
        }
        
        .required {
            color: var(--primary-color);
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
                    <li class="breadcrumb-item active" aria-current="page">Search Blood Donor</li>
                </ol>
            </nav>
            <h1 class="display-5 fw-bold mt-3">Search Blood Donor</h1>
            <p class="lead">Find blood donors by blood group and location</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <!-- Search Form -->
        <div class="search-section">
            <h3 class="mb-4">Search Criteria</h3>
            <form name="donar" method="post">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="bloodgroup" class="form-label">Blood Group <span class="required">*</span></label>
                        <select name="bloodgroup" class="form-select" id="bloodgroup" required>
                            <option value="" selected disabled>Select Blood Group</option>
                            <?php if (!empty($bloodGroups)): ?>
                                <?php foreach ($bloodGroups as $group): ?>
                                    <option value="<?php echo htmlspecialchars($group->BloodGroup); ?>">
                                        <?php echo htmlspecialchars($group->BloodGroup); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="location" class="form-label">Location</label>
                        <textarea class="form-control" name="location" id="location" rows="3" placeholder="Enter location (optional)"></textarea>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="sub" class="search-btn">
                            <i class="fas fa-search me-2"></i>Search Donors
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Error Message -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- Search Results -->
        <?php if ($searchPerformed): ?>
            <div class="results-section">
           

                <?php if (count($donors) > 0): ?>
                    <div class="row">
                        <?php foreach ($donors as $donor): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
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
                    </div>
                <?php else: ?>
                    <div class="no-results">
                        <i class="fas fa-search"></i>
                        <h4>No Donors Found</h4>
                        <p class="text-muted">No donors match your search criteria. Please try different search parameters.</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php include('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Form validation feedback
            $('form[name="donar"]').on('submit', function(e) {
                const bloodGroup = $('#bloodgroup').val();
                
                if (!bloodGroup) {
                    e.preventDefault();
                    
                    // Show error message
                    const alert = $('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<i class="fas fa-exclamation-circle me-2"></i>Please select a blood group.' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>');
                    
                    $('.search-section').prepend(alert);
                    
                    // Highlight the blood group field
                    $('#bloodgroup').addClass('is-invalid');
                    
                    // Remove highlight when user changes selection
                    $('#bloodgroup').on('change', function() {
                        $(this).removeClass('is-invalid');
                    });
                }
            });
        });
    </script>
</body>
</html>