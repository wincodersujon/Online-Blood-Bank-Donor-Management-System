<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
{
 $eid=intval($_GET['eid']);
 $status=1;
 $sql = "UPDATE tblcontactusquery SET status=:status WHERE  id=:eid";
 $query = $dbh->prepare($sql);
 $query -> bindParam(':status',$status, PDO::PARAM_STR);
 $query-> bindParam(':eid',$eid, PDO::PARAM_STR);
 $query -> execute();

 $msg="Query marked as Read successfully"; // Corrected message for clarity
}

if(isset($_REQUEST['del']))
{
 $did=intval($_GET['del']);
 $sql = "delete from tblcontactusquery WHERE  id=:did";
 $query = $dbh->prepare($sql);
 $query-> bindParam(':did',$did, PDO::PARAM_STR);
 $query -> execute();

 $msg="Record deleted Successfully ";
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
    
    <title>BBDMS | Manage Contact Us Queries</title>

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
        .action-btns .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            margin: 0 0.1rem;
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
                    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-envelope-open-text fa-fw"></i> Manage Contact Info</h1>
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
                        <i class="fas fa-comments fa-fw"></i> User Info
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zctb" class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact No</th>
                                        <th>Message</th>
                                        <th>Posting Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sql = "SELECT * from tblcontactusquery ";
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
                                        <td><?php echo htmlentities($result->name);?></td>
                                        <td><?php echo htmlentities($result->EmailId);?></td>
                                        <td><?php echo htmlentities($result->ContactNumber);?></td>
                                        <td><?php echo htmlentities($result->Message);?></td>
                                        <td><?php echo htmlentities($result->PostingDate);?></td>
                                        
                                        <!-- Status Column -->
                                        <td>
                                            <?php if($result->status==1) { ?>
                                                <span class="badge badge-success">Read</span>
                                            <?php } else { ?>
                                                <span class="badge badge-warning">Pending</span>
                                            <?php } ?>
                                        </td>

                                        <!-- Action Column -->
                                        <td class="action-btns">
                                            <?php if($result->status==1) { ?>
                                                <!-- If Read, only show Delete button -->
                                                <a href="manage-conactusquery.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to delete this query?');" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                            <?php } else { ?>
                                                <!-- If Pending, show Mark as Read and Delete buttons -->
                                                <a href="manage-conactusquery.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Mark this query as read?');" class="btn btn-success btn-sm" title="Mark as Read"><i class="fas fa-check"></i></a>
                                                <a href="manage-conactusquery.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to delete this query?');" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                            <?php } ?>
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

    <!-- DataTable Initialization & Auto-hide Alerts -->
    <script>
        $(document).ready(function() {
            // --- FIX: Check if the table is already initialized ---
            if ($.fn.DataTable.isDataTable('#zctb')) {
                $('#zctb').DataTable().destroy();
            }

            // --- Initialize the DataTable with improvements ---
            $('#zctb').DataTable({
                "responsive": true,
                "pageLength": 25,
                "order": [[ 0, "asc" ]],
                "language": {
                    "emptyTable": "No queries found in the database.",
                    "zeroRecords": "No matching queries found.",
                    "search": "Search:"
                },
                "columnDefs": [
                    { "orderable": false, "targets": -1 }, // Disable sorting on 'Action' column
                    { "orderable": false, "targets": -2 }  // Disable sorting on 'Status' column
                ]
            });
        });

        // Auto-hide alerts after 5 seconds
        window.setTimeout(function() {
            $(".alert-modern").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 5000);
    </script>

</body>
</html>
<?php } ?>