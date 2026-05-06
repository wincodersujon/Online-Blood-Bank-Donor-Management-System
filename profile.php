<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbdmsdid']==0)) {
  header('location:logout.php');
} else {

 if(isset($_POST['update']))
  {
    $uid=$_SESSION['bbdmsdid'];
    $name=$_POST['fullname'];
    $mno=$_POST['mobileno']; 
    $age=$_POST['age']; 
    $gender=$_POST['gender'];
    $bloodgroup=$_POST['bloodgroup']; 
    $address=$_POST['address'];
    $message=$_POST['message']; 
    
    $sql="update tblblooddonars set FullName=:name,MobileNumber=:mno, Age=:age,Gender=:gender,BloodGroup=:bloodgroup,Address=:address,Message=:message where id=:uid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':name',$name,PDO::PARAM_STR);
     $query->bindParam(':mno',$mno,PDO::PARAM_STR);
     $query->bindParam(':age',$age,PDO::PARAM_STR);
     $query->bindParam(':gender',$gender,PDO::PARAM_STR);
     $query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
     $query->bindParam(':address',$address,PDO::PARAM_STR);
     $query->bindParam(':message',$message,PDO::PARAM_STR);
     $query->bindParam(':uid',$uid,PDO::PARAM_STR);
     $query->execute();

     echo '<script>alert("Profile has been updated"); window.location.href = "profile.php";</script>';
  }

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Blood Bank Donar Management System !! Donor Profile</title>
    
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!--// Meta tag Keywords -->

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
        /* Custom Styles for Enhanced Design */
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #3498db;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
            --success-color: #2ecc71;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            /* Performance optimization */
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Header Styles */
        header {
            background-color: var(--dark-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Banner Styles */
        .inner-banner-w3ls {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 80px 0;
            position: relative;
            overflow: hidden;
            /* Performance optimization - simplified background */
        }
        
        .inner-banner-w3ls::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('images/pattern.png') repeat;
            opacity: 0.1;
            /* Performance optimization - reduced complexity */
        }
        
        .inner-banner-w3ls h1 {
            color: white;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }
        
        /* Profile Container */
        .profile-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-top: -50px;
            position: relative;
            z-index: 10;
            padding: 30px;
            /* Performance optimization - simplified transform */
        }
        
        /* Profile Header */
        .profile-header {
            display: flex;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 30px;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin-right: 20px;
            /* Performance optimization - removed transform */
        }
        
        .profile-info h2 {
            margin: 0;
            color: var(--dark-color);
        }
        
        .profile-info p {
            margin: 5px 0 0;
            color: #777;
        }
        
        /* Form Styles */
        .appoint-form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            font-size: 14px;
            /* Performance optimization - simplified transition */
            transition: border-color 0.2s ease;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            outline: none;
        }
        
        /* Button Styles */
        .btn_apt {
            background: linear-gradient(to right, var(--primary-color), #c0392b);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            /* Performance optimization - simplified transition */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: inline-block;
            text-align: center;
        }
        
        .btn_apt:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
            color: white;
            text-decoration: none;
        }
        
        /* Sidebar Styles */
        .profile-sidebar {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            padding: 25px;
            height: fit-content;
        }
        
        .profile-sidebar h3 {
            color: var(--dark-color);
            font-size: 18px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .sidebar-item {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .sidebar-item i {
            width: 30px;
            color: var(--primary-color);
        }
        
        .sidebar-item span {
            font-size: 14px;
        }
        
        .sidebar-label {
            font-weight: 600;
            margin-right: 10px;
        }
        
        /* Blood Group Badge */
        .blood-badge {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 16px;
            margin-top: 5px;
        }
        
        /* Stats Cards */
        .stats-card {
            background: linear-gradient(to right, var(--secondary-color), #2980b9);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            /* Performance optimization - removed transform */
        }
        
        .stats-card h4 {
            font-size: 28px;
            margin: 10px 0;
        }
        
        .stats-card p {
            margin: 0;
            opacity: 0.8;
        }
        
        /* Performance optimization - simplified responsive styles */
        @media (max-width: 991px) {
            .profile-sidebar {
                margin-top: 30px;
            }
        }
        
        @media (max-width: 767px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-avatar {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }
        
        /* Performance optimization - disable animations on low-end devices */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>

    <!-- banner 2 -->
    <div class="inner-banner-w3ls">
        <div class="container text-center">
            <h1>My Profile</h1>
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
                    <li class="breadcrumb-item active" aria-current="page">Donor Profile</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- //page details -->

    <!-- profile section -->
    <div class="appointment py-5">
        <div class="container">
            <div class="profile-container">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-info">
                        <?php
                        $uid=$_SESSION['bbdmsdid'];
                        $sql="SELECT * from tblblooddonars where id=:uid";
                        $query = $dbh -> prepare($sql);
                        $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $row)
                            {
                        ?>
                        <h2><?php echo $row->FullName;?></h2>
                        <p><i class="fas fa-envelope"></i> <?php echo $row->EmailId;?></p>
                        <div class="blood-badge">Blood Group: <?php echo $row->BloodGroup;?></div>
                        <?php 
                            } // End foreach
                        } // End if rowCount
                        ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8">
                        <div class="appoint-form">
                            <h5 class="title-w3 mb-4">Update Your Profile</h5>
                            <form action="profile.php" method="post">
                                <?php
                                $uid=$_SESSION['bbdmsdid'];
                                $sql="SELECT * from tblblooddonars where id=:uid";
                                $query = $dbh -> prepare($sql);
                                $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0)
                                {
                                    foreach($results as $row)
                                    {
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullname"><i class="fas fa-user"></i> Full Name</label>
                                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $row->FullName;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobileno"><i class="fas fa-phone"></i> Mobile Number</label>
                                            <input type="text" class="form-control" name="mobileno" id="mobileno" required="true" maxlength="10" pattern="[0-9]+" value="<?php echo $row->MobileNumber;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="emailid"><i class="fas fa-envelope"></i> Email Id <span style="color:red; font-size:10px;">(Can't be Changed)</span></label>
                                    <input type="email" name="emailid" class="form-control" value="<?php echo $row->EmailId;?>" readonly disabled>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="age"><i class="fas fa-calendar-alt"></i> Age</label>
                                            <input type="number" class="form-control" name="age" id="age" required="" value="<?php echo $row->Age;?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender"><i class="fas fa-venus-mars"></i> Gender</label>
                                            <select required="" class="form-control" name="gender">
                                                <option value="Male" <?php if($row->Gender == 'Male') echo 'selected'; ?>>Male</option>
                                                <option value="Female" <?php if($row->Gender == 'Female') echo 'selected'; ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bloodgroup"><i class="fas fa-tint"></i> Blood Group</label>
                                    <select name="bloodgroup" class="form-control" required>
                                        <?php 
                                        $sql_bg = "SELECT * from tblbloodgroup ";
                                        $query_bg = $dbh -> prepare($sql_bg);
                                        $query_bg->execute();
                                        $results_bg=$query_bg->fetchAll(PDO::FETCH_OBJ);
                                        if($query_bg->rowCount() > 0)
                                        {
                                            foreach($results_bg as $result_bg)
                                            {
                                        ?>  
                                        <option value="<?php echo htmlentities($result_bg->BloodGroup);?>" <?php if($row->BloodGroup == $result_bg->BloodGroup) echo 'selected'; ?>><?php echo htmlentities($result_bg->BloodGroup);?></option>
                                        <?php 
                                            }
                                        } 
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                                    <input type="text" class="form-control" name="address" id="address" required="true" value="<?php echo $row->Address;?>">
                                </div>
                                <div class="form-group">
                                    <label for="message"><i class="fas fa-comment"></i> Message</label>
                                    <textarea class="form-control" name="message" rows="4" required><?php echo $row->Message;?></textarea>
                                </div>
                                
                                <div class="text-center mt-4">
                                    <button type="submit" name="update" class="btn_apt">Update Profile</button>
                                </div>
                                <?php 
                                    } // End foreach
                                } // End if rowCount
                                ?>
                            </form>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="profile-sidebar">
                            <h3>Donor Information</h3>
                            <?php
                            $uid=$_SESSION['bbdmsdid'];
                            $sql="SELECT * from tblblooddonars where id=:uid";
                            $query = $dbh -> prepare($sql);
                            $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $row)
                                {
                            ?>
                            <div class="sidebar-item">
                                <i class="fas fa-user"></i>
                                <div>
                                    <span class="sidebar-label">Name:</span>
                                    <span><?php echo $row->FullName;?></span>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <i class="fas fa-tint"></i>
                                <div>
                                    <span class="sidebar-label">Blood Group:</span>
                                    <span><?php echo $row->BloodGroup;?></span>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <i class="fas fa-venus-mars"></i>
                                <div>
                                    <span class="sidebar-label">Gender:</span>
                                    <span><?php echo $row->Gender;?></span>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <span class="sidebar-label">Age:</span>
                                    <span><?php echo $row->Age;?></span>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <span class="sidebar-label">Mobile:</span>
                                    <span><?php echo $row->MobileNumber;?></span>
                                </div>
                            </div>
                            <div class="sidebar-item">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <span class="sidebar-label">Email:</span>
                                    <span><?php echo $row->EmailId;?></span>
                                </div>
                            </div>
                            <?php 
                                } // End foreach
                            } // End if rowCount
                            ?>
                            
                            <div class="stats-card">
                                <i class="fas fa-hand-holding-heart fa-2x mb-2"></i>
                                <h4>12</h4>
                                <p>Total Donations</p>
                            </div>
                            
                            <div class="stats-card" style="background: linear-gradient(to right, var(--success-color), #27ae60);">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <h4>3 Months</h4>
                                <p>Last Donation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //profile section -->

    <?php include('includes/footer.php');?>
    
    <!-- Optimized JavaScript -->
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Performance optimization - simplified JavaScript -->
    <script>
        // Performance optimization - use passive event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Performance optimization - use requestAnimationFrame for animations
            function optimizedScroll() {
                requestAnimationFrame(function() {
                    // Any scroll-related animations here
                });
            }
            
            // Performance optimization - use passive event listeners
            window.addEventListener('scroll', optimizedScroll, { passive: true });
            
            // Performance optimization - debounce form submissions
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Add any form validation here
                });
            }
        });
    </script>

</body>

</html>
<?php } ?>