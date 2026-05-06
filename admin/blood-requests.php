<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
else{
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
    
    <title>BBDMS | Blood Requests</title>

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
                    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-hand-holding-medical fa-fw"></i> Blood Requests</h1>
                </div>

                <!-- Data Table -->
                <div class="card shadow modern-card">
                    <div class="card-header py-3">
                        <i class="fas fa-list fa-fw"></i> Blood Request Details
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="bloodRequestsTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Donor Name</th>
                                        <th>Donor Contact</th>
                                        <th>Blood Group</th>
                                        <th>Requirer Name</th>
                                        <th>Requirer Mobile</th>
                                        <th>Requirer Email</th>
                                        <th>Require For</th>
                                        <th>Message</th>
                                        <th>Apply Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // NOTE: Removed the WHERE clause with $sdata as it was undefined.
                                    // The query now fetches all records.
                                    $sql="SELECT tblbloodrequirer.BloodDonarID, tblbloodrequirer.name, tblbloodrequirer.EmailId, tblbloodrequirer.ContactNumber, tblbloodrequirer.BloodRequirefor, tblbloodrequirer.Message, tblbloodrequirer.ApplyDate, tblblooddonars.id as donid, tblblooddonars.FullName, tblblooddonars.MobileNumber, tblblooddonars.BloodGroup FROM tblbloodrequirer JOIN tblblooddonars ON tblblooddonars.id=tblbloodrequirer.BloodDonarID";
                                    $query = $dbh -> prepare($sql);
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
                                        <td><?php echo htmlentities($row->FullName);?></td>
                                        <td><?php echo htmlentities($row->MobileNumber);?></td>
                                        <td><span class="badge badge-pill badge-danger"><?php echo htmlentities($row->BloodGroup);?></span></td>
                                        <td><?php echo htmlentities($row->name);?></td>
                                        <td><?php echo htmlentities($row->ContactNumber);?></td>
                                        <td><?php echo htmlentities($row->EmailId);?></td>
                                        <td><?php echo htmlentities($row->BloodRequirefor);?></td>
                                        <td><?php echo htmlentities($row->Message);?></td>
                                        <td><?php echo htmlentities($row->ApplyDate);?></td>
                                    </tr>
                                    <?php $cnt=$cnt+1; }
                                    } else {
                                    ?>
                                        <tr>
                                            <th colspan="10" class="text-center">No Records Found</th>
                                        </tr>
                                    <?php } ?>
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

    <!-- DataTable Initialization -->
    <script>
        $(document).ready(function() {
            // --- FIX: Check if the table is already initialized ---
            if ($.fn.DataTable.isDataTable('#bloodRequestsTable')) {
                $('#bloodRequestsTable').DataTable().destroy();
            }

            // --- Initialize the DataTable with improvements ---
            $('#bloodRequestsTable').DataTable({
                "responsive": true,              // Makes the table look good on mobile
                "pageLength": 25,                // Show 25 rows by default
                "order": [[ 9, "desc" ]],        // Order by 'Apply Date', newest first
                "language": {
                    "emptyTable": "No blood requests found.",
                    "zeroRecords": "No matching requests found.",
                    "search": "Search:"
                }
            });
        });
    </script>

</body>
</html>
<?php } ?>