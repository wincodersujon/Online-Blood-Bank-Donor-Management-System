<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
else{

// Initialize variables
 $sql = "SELECT tblbloodrequirer.BloodDonarID, tblbloodrequirer.name, tblbloodrequirer.EmailId, tblbloodrequirer.ContactNumber, tblbloodrequirer.BloodRequirefor, tblbloodrequirer.Message, tblbloodrequirer.ApplyDate, tblblooddonars.id as donid, tblblooddonars.FullName, tblblooddonars.MobileNumber FROM tblbloodrequirer JOIN tblblooddonars ON tblblooddonars.id=tblbloodrequirer.BloodDonarID";
 $search_performed = false;
 $search_term = "";

// Check if a search has been submitted
if(isset($_POST['search']))
{ 
    $search_performed = true;
    $search_term = $_POST['searchdata'];
    // Append the WHERE clause to the SQL query
    $sql .= " WHERE tblblooddonars.FullName LIKE '%$search_term%' OR tblblooddonars.MobileNumber LIKE '%$search_term%' OR tblbloodrequirer.name LIKE '%$search_term%' OR tblbloodrequirer.ContactNumber LIKE '%$search_term%'";
}
// Execute the final query
 $query = $dbh->prepare($sql);
 $query->execute();
 $results = $query->fetchAll(PDO::FETCH_OBJ);
 $cnt = 1;
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
    
    <title>BBDMS | Search Blood Requests</title>

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
            margin-bottom: 2rem; /* Space between cards */
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
        .search-result-heading {
            color: #5a5c69;
            font-size: 1.1rem;
            font-weight: 600;
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
                    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-search fa-fw"></i> Search Blood Requests</h1>
                </div>

                <!-- Search Form Card -->
                <div class="card shadow modern-card">
                    <div class="card-header py-3">
                        <i class="fas fa-filter fa-fw"></i> Search Filters
                    </div>
                    <div class="card-body p-4">
                        <form method="post" name="search">
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <label for="searchdata" class="form-label">Search by Donor or Requirer Name / Phone Number</label>
                                    <input type="text" class="form-control form-control-lg" name="searchdata" id="searchdata" value="<?php echo htmlspecialchars($search_term); ?>" required>
                                </div>
                                <div class="col-md-3 text-md-end mt-4 mt-md-0">
                                    <button class="btn btn-primary btn-lg w-100" name="search" type="submit">
                                        <i class="fas fa-search fa-fw"></i> Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Results Table Card -->
                <div class="card shadow modern-card">
                    <div class="card-header py-3">
                        <i class="fas fa-list fa-fw"></i> Blood Request Details
                    </div>
                    <div class="card-body">
                        <?php if($search_performed) { ?>
                            <h5 class="search-result-heading mb-3">Results against "<?php echo htmlspecialchars($search_term); ?>" keyword</h5>
                        <?php } ?>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="searchResultsTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Donor Name</th>
                                        <th>Donor Contact</th>
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
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $row)
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($row->FullName);?></td>
                                        <td><?php echo htmlentities($row->MobileNumber);?></td>
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
                                            <th colspan="9" class="text-center">No Records Found</th>
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
            if ($.fn.DataTable.isDataTable('#searchResultsTable')) {
                $('#searchResultsTable').DataTable().destroy();
            }

            // --- Initialize the DataTable with improvements ---
            $('#searchResultsTable').DataTable({
                "responsive": true,
                "pageLength": 25,
                "order": [[ 8, "desc" ]], // Order by 'Apply Date', newest first
                "language": {
                    "emptyTable": "Perform a search to see results.",
                    "zeroRecords": "No matching requests found.",
                    "search": "Search within results:"
                }
            });
        });
    </script>

</body>
</html>
<?php } ?>