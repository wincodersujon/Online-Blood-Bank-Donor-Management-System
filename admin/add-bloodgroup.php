<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
else{
// Code for change password	
if(isset($_POST['submit']))
{
 $bloodgroup=$_POST['bloodgroup'];
 $sql="INSERT INTO  tblbloodgroup(BloodGroup) VALUES(:bloodgroup)";
 $query = $dbh->prepare($sql);
 $query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
 $query->execute();
 $lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
 $msg="Blood Group Created successfully";
}
else 
{
 $error="Something went wrong. Please try again";
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
    <meta name="theme-color" content="#3e454c">
    
    <title>BBDMS | Admin Add Blood Group</title>

    <!-- Font Awesome 6 for modern icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">

    <!-- ======================= START: CUSTOM MODERN STYLES ======================= -->
    <style>
        body {
            background-color: #f8f9fc;
        }
        .content-wrapper {
            background-color: #f8f9fc;
            padding: 2rem 1.5rem;
        }
        .page-title {
            font-size: 1.75rem;
            color: #5a5c69;
            font-weight: 700;
            margin-bottom: 1.5rem;
            border-bottom: none;
        }
        .modern-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        .modern-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e3e6f0;
            border-radius: 1rem 1rem 0 0 !important;
            font-size: 1.1rem;
            font-weight: 700;
            color: #5a5c69;
        }
        .form-label {
            font-weight: 600;
            color: #5a5c69;
        }
        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        .btn-modern {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        .btn-modern:hover {
            transform: translateY(-1px);
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }
        /* Modern Alert Styles */
        .alert-modern {
            border: none;
            border-radius: 0.5rem;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            border-left: 0.5rem solid;
        }
        .alert-modern-success {
            background-color: #d4edda;
            border-left-color: #28a745;
            color: #155724;
        }
        .alert-modern-danger {
            background-color: #f8d7da;
            border-left-color: #dc3545;
            color: #721c24;
        }
    </style>
    <!-- ======================= END: CUSTOM MODERN STYLES ======================= -->

</head>

<body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8 col-md-10">
                        
                        <h1 class="page-title text-center mb-4"><i class="fas fa-plus-circle fa-fw"></i> Add Blood Group</h1>

                        <!-- ======================= START: MODERN ALERT MESSAGES ======================= -->
                        <?php if($error){ ?>
                            <div class="alert alert-modern-danger alert-modern" role="alert">
                                <i class="fas fa-exclamation-triangle fa-fw"></i> <strong>Error:</strong> <?php echo htmlentities($error); ?>
                            </div>
                        <?php } else if($msg){ ?>
                            <div class="alert alert-modern-success alert-modern" role="alert">
                                <i class="fas fa-check-circle fa-fw"></i> <strong>Success:</strong> <?php echo htmlentities($msg); ?>
                            </div>
                        <?php } ?>
                        <!-- ======================= END: MODERN ALERT MESSAGES ======================= -->

                        <div class="card modern-card">
                            <div class="card-header py-3">
                                <i class="fas fa-tint fa-fw"></i> Blood Group Details
                            </div>
                            <div class="card-body p-4">
                                <form method="post" name="chngpwd">
                                    
                                    <div class="mb-3">
                                        <label for="bloodgroup" class="form-label">Blood Group</label>
                                        <input type="text" class="form-control form-control-lg" id="bloodgroup" name="bloodgroup" placeholder="e.g., A+" required>
                                    </div>
                                
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-modern" name="submit" type="submit">
                                            <i class="fas fa-save fa-fw"></i> Submit Blood Group
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            
            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>

    <!-- Optional: Auto-hide alerts after 5 seconds -->
    <script>
        window.setTimeout(function() {
            $(".alert-modern").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
    </script>

</body>

</html>
<?php } ?>