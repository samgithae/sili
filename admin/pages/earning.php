<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 13/06/2017
 * Time: 08:27
 */

require_once '../../vendor/autoload.php';
$earnings = \App\Controller\FundController::showAllEarnings();
$counter=1;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Earnings</title>
    
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">
    <?php include_once 'right_menu.php'?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User Earnings</h1>
                <a href="payout_endpoint.php" class="btn btn-primary btn-lg pull-right" style="margin-bottom: 10px;">Export Payout to Excel</a>
            </div>
            <?php if(isset($_GET['status']) && $_GET['status'] == 200): ?>
            <div class="alert alert-success">
                <p>Payout created successfully check your download folder</p>
                <a href="earning.php" class="btn btn-warning">Reload</a

            </div>
            <?php endif;?>

            <?php if(isset($_GET['status']) && $_GET['status'] == 500): ?>
                <div class="alert alert-danger">
                    <p>Error: No client found with minimum balance to create payout</p>
                    <a href="earning.php" class="btn btn-info">Try Again</a>
                </div>
            <?php endif;?>

            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Recorded Earning
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Referral Code</th>
                                <th>Full name</th>
                                <th>Id No</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Total Earning</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($earnings as $earning): ?>
                            <tr class="odd gradeX">
                                <td><?php echo $counter++ ?></td>
                                <td><?php echo $earning['userReferralCode'];?></td>
                                <td><?php echo $earning['fullName'];?></td>
                                <td><?php echo $earning['idNo'];?></td>
                                <td><?php echo $earning['phoneNumber'];?></td>
                                <td><?php echo $earning['email'];?></td>
                                <td><?php echo $earning['totalEarning'];?></td>
                                <td><?php echo $earning['balance'];?></td>




                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="../../public/assets/js/jquery-1.11.3.min.js"></script>
<?php include_once 'footer.php'?>

    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
    <script>
        function exportExcel() {
            var url = 'payout_endpoint.php';
            $.ajax(
                {
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    contentType: 'application/json',
                    success: function (response) {
                        console.log(response);
                        if(response.statusCode == 200){
                            window.location.href = 'earning.php?status=200';
                        }else{
                            alert('ERROR OCCURRED');
                        }
                    }
                }
            )
        }
    </script>
</body>
</html>
