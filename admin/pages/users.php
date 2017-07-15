<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 13/06/2017
 * Time: 08:27
 */

require_once '../../vendor/autoload.php';
$users = \App\Controller\UserController::all();
$counter = 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manage Users</title>

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
    <?php include_once 'right_menu.php' ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Registered users
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-bordered table-hover"
                                   id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Referral Code</th>
                                    <th>FullName</th>
                                    <th>username</th>
                                    <th>Id No</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $counter++ ?></td>
                                        <td style="font-weight: bolder; color:<?php if($user['isAdmin']==1): echo 'red';endif;?>"><?php echo $user['userReferralCode']; ?></td>
                                        <td><?php echo $user['fullName']; ?></td>
                                        <td><a href="user_profile.php?q=<?php echo $user['username']?>" class="btn btn-link"><?php echo $user['username']; ?></a></td>
                                        <td><?php echo $user['idNo']; ?></td>
                                        <td><?php echo $user['phoneNumber']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo $user['accountStatus']; ?></td>
                                        <td>
                                            <?php if ($user['accountStatus'] == 'pending'): ?>
                                                <button class="btn btn-xs btn-success" onclick="approveAccount('<?php echo $user['id']?>')">Approve</button>
                                            <?php endif; ?>
                                            <?php if ($user['accountStatus'] == 'active') { ?>
                                                <button class="btn btn-xs btn-danger" onclick="blockAccount('<?php echo $user['id']?>')">Block</button>
                                            <?php
                                            } elseif ($user['accountStatus'] == 'blocked') {
                                                ?>
                                                <button class="btn btn-xs btn-info" onclick="unBlockAccount('<?php echo $user['id']?>')">Unblock</button>

                                            <?php
                                            }
                                            ?>


                                        </td>


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
    <!-- Modal 4 (Confirm)-->
    <div class="modal fade" id="confirmApprove" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Approve Account</h4>
                    <div id="confirmFeedback1">

                    </div>
                </div>

                <div class="modal-body">
                    <p style="font-size: 16px;"> Click Continue to Approve the account</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id='btnApprove' class="btn btn-info">Continue</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--end-->


    <!-- Modal 4 (Confirm)-->
    <div class="modal fade" id="confirmBlock" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Block Account </h4>
                    <div id="confirmFeedback2">

                    </div>
                </div>

                <div class="modal-body">
                    <p style="font-size: 16px;"> Click Continue to block this account.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id='btnBlock' class="btn btn-info">Continue</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--end-->

    <!-- Modal 4 (Confirm)-->
    <div class="modal fade" id="confirmUnblock" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Unblock Account</h4>
                    <div id="confirmFeedback3">

                    </div>
                </div>

                <div class="modal-body">
                    <p style="font-size: 16px;"> Click Continue to Unblock Account.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id='btnUnblock' class="btn btn-info">Continue</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--end-->
    <?php include_once 'footer.php' ?>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
    <script>
        function approveAccount(userId) {
            $('#confirmApprove').modal('show');
            var data = JSON.stringify(
                {
                    userId:userId,
                    option: "approve"
                }
            );
            var url = 'manage_users.php';
            $('#btnApprove').on('click', function (e) {
                e.preventDefault;
                $.ajax(
                    {
                        type: 'POST',
                        url: url,
                        data: data,
                        dataType: 'json',
                        contentType: 'application/json;charset=utf-8;',
                        traditional: true,
                        success: function (response) {
                            console.log(response);
                            if (response.statusCode == 200) {
                                console.log(response);
                                $('#confirmFeedback1').removeClass('alert alert-danger')
                                    .addClass('alert alert-success')
                                    .text(response.message);
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            }
                            if (response.statusCode == 500) {
                                $('#confirmFeedback1').removeClass('alert alert-success')
                                    .html('<div class="alert alert-danger alert-dismissable">' +
                                        '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                        '<strong>Error! </strong> ' + response.message + '</div>')

                            }
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    }
                )
            })
        }

        function blockAccount(userId) {
            $('#confirmBlock').modal('show');
            var data = JSON.stringify(
                {
                    userId:userId,
                    option: "block"
                }
            );
            var url = 'manage_users.php';
            $('#btnBlock').on('click', function (e) {
                e.preventDefault;
                $.ajax(
                    {
                        type: 'POST',
                        url: url,
                        data: data,
                        dataType: 'json',
                        contentType: 'application/json;charset=utf-8;',
                        traditional: true,
                        success: function (response) {
                            console.log(response);
                            if (response.statusCode == 200) {
                                console.log(response);
                                $('#confirmFeedback2').removeClass('alert alert-danger')
                                    .addClass('alert alert-success')
                                    .text(response.message);
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            }
                            if (response.statusCode == 500) {
                                $('#confirmFeedback2').removeClass('alert alert-success')
                                    .html('<div class="alert alert-danger alert-dismissable">' +
                                        '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                        '<strong>Error! </strong> ' + response.message + '</div>')

                            }
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    }
                )
            })
        }

        function unBlockAccount(userId) {
            $('#confirmUnblock').modal('show');
            var data = JSON.stringify(
                {
                    userId:userId,
                    option: "unblock"
                }
            );
            var url = 'manage_users.php';
            $('#btnUnblock').on('click', function (e) {
                e.preventDefault;
                $.ajax(
                    {
                        type: 'POST',
                        url: url,
                        data: data,
                        dataType: 'json',
                        contentType: 'application/json;charset=utf-8;',
                        traditional: true,
                        success: function (response) {
                            console.log(response);
                            if (response.statusCode == 200) {
                                console.log(response);
                                $('#confirmFeedback3').removeClass('alert alert-danger')
                                    .addClass('alert alert-success')
                                    .text(response.message);
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            }
                            if (response.statusCode == 500) {
                                $('#confirmFeedback3').removeClass('alert alert-success')
                                    .html('<div class="alert alert-danger alert-dismissable">' +
                                        '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                        '<strong>Error! </strong> ' + response.message + '</div>')

                            }
                        },
                        error: function (e) {
                            console.log(e);
                        }

                    }
                )
            })
        }
    </script>
</body>
</html>
