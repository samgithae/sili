<?php
session_start();
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/25/17
 * Time: 9:59 PM
 */
require_once __DIR__.'/../../vendor/autoload.php';
use \App\Controller\UserController;

if(!isset($_SESSION['username'])){
    header('Location: ../../index.php');
}

$user = UserController::getUserByUsername($_GET['q']);
$fullName = isset($user['fullName']) ? $user['fullName'] : '';
$email = isset($user['email']) ? $user['email'] : '';
$idNo = isset($user['idNo']) ? $user['idNo'] : '';
$phoneNumber = isset($user['phoneNumber']) ? $user['phoneNumber'] : '';
$username= isset($user['username']) ? $user['username'] : '';
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
                <h1 class="page-header">UserProfile Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User Profile
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="thumbnail col-md-3">
                            <img src="../../public/assets/img/default-profile-picture.jpg" class="img-circle img-responsive">
                        </div>
                        <div class="col-md-9">
                        <ul class="list-group">
                            <li class="list-group-item">Username : <?php echo $username;?></li>
                            <li class="list-group-item">Name: <?php echo $fullName;?></li>
                            <li class="list-group-item">Email: <?php echo $email;?></li>
                            <li class="list-group-item">Phone Number: <?php echo $phoneNumber;?></li>
                            <li class="list-group-item">ID Number: <?php echo $idNo;?></li>
                            <?php
                            if($user['isAdmin'] == 0) {
                                ?>
                                <li class="list-group-item">
                                    <button class="btn btn-primary" onclick="makeAdmin()">Make Admin</button>
                                </li>
                                <?php
                            }elseif($user['isAdmin'] == 1) {
                                ?>
                                <li class="list-group-item">
                                    <button class="btn btn-danger" onclick="removeAdmin()">Remove Admin</button>
                                </li>
                            <?php
                            }

                            ?>

                        </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 4 (Confirm)-->
    <div class="modal fade" id="confirm" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title"></h4>
                    <div id="confirmFeedback">

                    </div>
                </div>

                <div class="modal-body">
                    <p style="font-size: 16px;"> Click Continue to Confirm Action</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id='btnConfirm' class="btn btn-info">Continue</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--end-->


    <?php include_once 'footer.php'?>

    <script>
        function makeAdmin() {
            $('#confirm').modal('show');
            $('#modal-title').text('Make Admin');
            var url = 'user_profile_endpoint.php';
            var data = JSON.stringify({
                option: 'make_admin',
                username: '<?php echo $_GET['q']?>'
            });
            $('#btnConfirm').on('click', function (e) {
                e.preventDefault();
                $.ajax(
                    {
                        type: 'POST',
                        url:url,
                        data:data,
                        dataType: 'json',
                        contentType: 'application/json',
                        traditional: true,
                        success: function (response) {

                            if (response.statusCode == 200) {
                                console.log(response);
                                $('#confirmFeedback').removeClass('alert alert-danger')
                                    .addClass('alert alert-success')
                                    .text(response.message);
                                setTimeout(function () {
                                    window.location.href = 'users.php';
                                }, 1000);
                            }
                            if (response.statusCode == 500) {
                                $('#confirmFeedback').removeClass('alert alert-success')
                                    .html('<div class="alert alert-danger alert-dismissable">' +
                                        '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                        '<strong>Error! </strong> ' + response.message + '</div>')

                            }

                        }
                    }
                )
            })
        }

        function removeAdmin() {
            $('#confirm').modal('show');
            $('#modal-title').text('Remove Admin Role');
            var url = 'user_profile_endpoint.php';
            var data = JSON.stringify({
                option: 'remove_admin',
                username: '<?php echo $_GET['q']?>'
            });
            $('#btnConfirm').on('click', function (e) {
                e.preventDefault();
                $.ajax(
                    {
                        type: 'POST',
                        url:url,
                        data:data,
                        dataType: 'json',
                        contentType: 'application/json',
                        traditional: true,
                        success: function (response) {

                            if (response.statusCode == 200) {
                                console.log(response);
                                $('#confirmFeedback').removeClass('alert alert-danger')
                                    .addClass('alert alert-success')
                                    .text(response.message);
                                setTimeout(function () {
                                    window.location.href = 'users.php';
                                }, 1000);
                            }
                            if (response.statusCode == 500) {
                                $('#confirmFeedback').removeClass('alert alert-success')
                                    .html('<div class="alert alert-danger alert-dismissable">' +
                                        '<a href="#" class="close"  data-dismiss="alert" aria-label="close">&times;</a>' +
                                        '<strong>Error! </strong> ' + response.message + '</div>')

                            }

                        }
                    }
                )
            })
        }


    </script>

</body>
</html>