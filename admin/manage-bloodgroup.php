<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
 $id=$_GET['del'];
 $sql = "delete from tblbloodgroup  WHERE id=:id";
 $query = $dbh->prepare($sql);
 $query -> bindParam(':id',$id, PDO::PARAM_STR);
 $query -> execute();
 $msg="Data Deleted successfully";
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
    
    <title>BBDMS | Admin Manage Blood Groups</title>

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
        /* DataTable Styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(to bottom, #4e73df 0%, #224abe 100%) !important;
            border: 1px solid #4e73df !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #e3e6f0;
            border: 1px solid #ddd4e1;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }
        .action-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.2rem;
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

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-list fa-fw"></i> Manage Blood Groups</h1>
                    <a href="add-bloodgroup.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Add New Blood Group
                    </a>
                </div>

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

                <!-- Data Table -->
                <div class="card shadow modern-card">
                    <div class="card-header py-3">
                        <i class="fas fa-tint fa-fw"></i> Listed Blood Groups
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zctb" class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Blood Group</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sql = "SELECT * from tblbloodgroup ";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $result)
                                        {				
                                    ?>	
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($result->BloodGroup);?></td>
                                        <td><?php echo htmlentities($result->PostingDate);?></td>
                                        <td>
                                            <a href="manage-bloodgroup.php?del=<?php echo $result->id;?>" onclick="return confirm('Are you sure you want to delete this blood group?');" class="btn btn-danger btn-sm action-btn">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $cnt=$cnt+1; }} ?>
                                </tbody>
                            </table>
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

<!-- ======================= START: DATATABLES FIX SCRIPT ======================= -->
<script>
 $(document).ready(function() {
    // --- FIX: Check if the table is already initialized ---
    // This prevents the "Cannot reinitialise DataTable" error.
    if ($.fn.DataTable.isDataTable('#zctb')) {
        $('#zctb').DataTable().destroy(); // Destroy the old instance
    }

    // --- Initialize the DataTable with improvements ---
    $('#zctb').DataTable({
        "responsive": true,              // Makes the table look good on mobile
        "pageLength": 25,                // Show 25 rows by default
        "order": [[ 2, "desc" ]],       // Order by 'Creation Date', newest first
        "language": {
            "emptyTable": "No blood groups found in the database.",
            "zeroRecords": "No matching blood groups found.",
            "search": "Search:"
        },
        "columnDefs": [
            { "orderable": false, "targets": -1 } // Disable sorting on the last 'Action' column
        ]
    });
});

// --- Auto-hide alerts after 5 seconds (this is fine as is) ---
window.setTimeout(function() {
    $(".alert-modern").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);
</script>
<!-- ======================= END: DATATABLES FIX SCRIPT ======================= -->
<?php } ?>