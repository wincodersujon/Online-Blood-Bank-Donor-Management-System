<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbdmsdid']==0)) {
  header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Online Blood Bank & Donar Management System !! Request Received</title>
    
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- Custom-Files -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!-- Style-CSS -->
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <!-- Font-Awesome-Icons-CSS -->
    <!-- //Custom-Files -->

    <!-- Web-Fonts -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <!-- //Web-Fonts -->
    
    <style>
        /* Performance optimization styles */
        body {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Disable animations on low-end devices */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* Table styling for better UX */
        .table {
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table thead th {
            background-color: #e74c3c;
            color: white;
            font-weight: 600;
        }
        
        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s ease;
        }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>

    <!-- banner 2 -->
    <div class="inner-banner-w3ls">
        <div class="container">
            <div class="text-center">
                <h1 class="text-white">Request Received</h1>
            </div>
        </div>
        <!-- //banner 2 -->
    </div>
    
    <!-- page details -->
    <div class="breadcrumb-agile">
        <div class="container">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Request Received</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- //page details -->

    <!-- contact -->
    <div class="appointment py-5">
        <div class="container">
            <div class="w3ls-titles text-center mb-5">
                <h3 class="title">Request Received</h3>
                <span>
                    <i class="fas fa-user-md"></i>
                </span>
            </div>
            
            <div class="contact-right-w3l appoint-form">
                <h5 class="title-w3 text-center mb-5">Below is the detail of Blood Requirer.</h5>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                <th>Blood Require For</th>
                                <th>Message</th>
                                <th>Apply Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $uid=$_SESSION['bbdmsdid'];
                            $sql="SELECT tblbloodrequirer.BloodDonarID,tblbloodrequirer.name,tblbloodrequirer.EmailId,tblbloodrequirer.ContactNumber,tblbloodrequirer.BloodRequirefor,tblbloodrequirer.Message,tblbloodrequirer.ApplyDate,tblblooddonars.id as donid from  tblbloodrequirer join tblblooddonars on tblblooddonars.id=tblbloodrequirer.BloodDonarID where tblbloodrequirer.BloodDonarID=:uid";
                            $query = $dbh -> prepare($sql);
                            $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $row)
                                {
                            ?>
                            <tr>
                                <td><?php echo htmlentities($cnt);?></td>
                                <td><?php echo htmlentities($row->name);?></td>
                                <td><?php echo htmlentities($row->ContactNumber);?></td>
                                <td><?php echo htmlentities($row->EmailId);?></td>
                                <td><?php echo htmlentities($row->BloodRequirefor);?></td>
                                <td><?php echo htmlentities($row->Message);?></td>
                                <td><?php echo htmlentities($row->ApplyDate);?></td>
                            </tr>
                            <?php 
                                $cnt=$cnt+1;
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="7" class="text-center" style="color:red;">No Record found</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- //contact -->

    <?php include('includes/footer.php');?>
    
    <!-- Optimized JavaScript -->
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Performance optimization - simplified JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Performance optimization - use passive event listeners
            window.addEventListener('scroll', function() {
                // Any scroll-related functionality here
            }, { passive: true });
        });
    </script>
</body>
</html>
<?php } ?>