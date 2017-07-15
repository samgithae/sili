<?php
session_start();

/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/13/17
 * Time: 10:22 PM
 */

require_once __DIR__.'/../vendor/autoload.php';
use \App\Controller\UserController;
use \App\Controller\FundController;
use \App\Controller\ReferralTreeController;

$userId = UserController::getUserId($_SESSION['username']);
$profile = FundController::myEarning($userId);
$user=UserController::getId($userId);
$referralTree=ReferralTreeController::getCounts($user['userReferralCode']);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile</title>
    
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    
    <link rel="stylesheet" href="../public/assets/css/bootstrap.css">
    <link rel="stylesheet" href="../public/assets/css/main.css">

    <link rel="stylesheet" href="../public/assets/css/custom.css">

</head>
<body>

<section id="header" class="bg-color0">
    <div class="container"><div class="row">

            <a class="navbar-brand" href="#top"><img src="../public/assets/img/logo4.png" alt=""></a>

            <div class="col-sm-12 mainmenu_wrap"><div class="main-menu-icon visible-xs"><span></span><span></span><span></span></div>
                <?php
                include_once 'header_menu_views.php';
                ?>
            </div>

        </div></div>
</section>

<section id="services" class="grey_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <br/>
                <h1 class="block-header">Profile</h1>
                <h3></h3>
            </div>
        </div>

    </div>

  <div class="container">
        <div class="row">
            <div class="col-sm-3">
                Quick Links
                <ul class="nav nav-pills nav-stacked nav-email shadow mb-20">
                    <li >
                        <a href="home.php">
                            <i class="fa fa-home"></i> Home  <span class="label pull-right">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-key"></i>Change Password</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sign-out"></i> Log out</a>
                    </li>


                </ul><!-- /.nav -->

<!--                <h5 class="nav-email-subtitle">More</h5>-->
<!--                <ul class="nav nav-pills nav-stacked nav-email mb-20 rounded shadow">-->
<!--                    <li>-->
<!--                        <a href="#">-->
<!--                            <i class="fa fa-folder-open"></i> Promotions  <span class="label label-danger pull-right">3</span>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">-->
<!--                            <i class="fa fa-folder-open"></i> Job list-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">-->
<!--                            <i class="fa fa-folder-open"></i> Backup-->
<!--                        </a>-->
<!--                    </li>-->
<!--                </ul><!-- /.nav -->
            </div>
            <div class="col-sm-9">

                <!-- resumt -->
                <div class=" panel-default">
                    <div class="panel-heading resume-heading">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-xs-12 col-sm-4">
                                    <figure>
                                        <img class="img-circle img-responsive" alt="" src="../public/assets/img/default-profile-picture.jpg">
                                    </figure>

                                </div>
                                <div class="col-xs-12 col-sm-8">
                                    <ul class="list-group">
                                        <li class="list-group-item"> <b>Referral Code :</b> <?php echo $user['userReferralCode'] ?></li>
                                        <li class="list-group-item"> <b>Name :</b> <?php echo $profile['fullName'] ?></li>
                                        <li class="list-group-item"> <b>Username :</b> <?php echo $profile['username'] ?></li>
                                        <li class="list-group-item"> <b>Phone Number:</b> <?php echo $profile['phoneNumber']?></li>
                                        <li class="list-group-item"> <b>Email:</b> <?php echo $profile['email']?></li>
                                        <li class="list-group-item"> <b>Date Joined:</b> <?php echo $profile['createdAt']?></li>
                                        <li class="list-group-item"> <b>Total Earning:</b> <?php echo $profile['totalEarning']?></li>
                                        <li class="list-group-item"> <b>Account Balance:</b> <?php echo $profile['balance']?></li>
                                       </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 bs-callout bs-callout-danger">
                        <h4>Users Referred</h4>
                        <div class="col-md-2 bs-callout bs-callout-danger">
                            <h4 style="text-align: center;">Generation 1</h4>
                            <h1 style="text-align: center;">
                                <?php echo $referralTree['l1Count']; ?>
                            </h1>
                        </div>
                        <div class="col-md-2 bs-callout bs-callout-danger">
                            <h4 style="text-align: center;">Generation 2</h4>
                            <h1 style="text-align: center;">
                                <?php echo $referralTree['l2Count']; ?>
                            </h1>
                        </div>
                        <div class="col-md-2 bs-callout bs-callout-warning">
                            <h4 style="text-align: center;">Generation 3</h4>
                            <h1 style="text-align: center;">
                                <?php echo $referralTree['l3Count']; ?>
                            </h1>
                        </div>
                        <div class="col-md-2 bs-callout bs-callout-warning">
                            <h4 style="text-align: center;">Generation 4</h4>
                            <h1 style="text-align: center;">
                                <?php echo $referralTree['l4Count']; ?>
                            </h1>
                        </div>
                        <div class="col-md-2 bs-callout bs-callout-info">
                            <h4 style="text-align: center;">Generation 5</h4>
                            <h1 style="text-align: center;">
                                <?php echo $referralTree['l5Count']; ?>
                            </h1>
                        </div>
                        <div class="col-md-2 bs-callout bs-callout-info">
                            <h4 style="text-align: center;">Generation 6</h4>
                            <h1 style="text-align: center;">
                                <?php echo $referralTree['l6Count']; ?>
                            </h1>
                        </div>

                    </div>




                </div>
                <div class="col-md-12 bs-callout bs-callout-info">
                    <h4>Referral system up to the 6th generation</h4>
                    <table class="table table-striped table-responsive ">
                        <thead>
                        <tr>
                            <th>Generation</th>
                            <th>Number of People</th>
                            <th>Payments in percentages</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>You</td>
                            <td>1</td>
                            <td> 0% </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>5</td>
                            <td> 20 </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>25</td>
                            <td>15% </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>125</td>
                            <td> 10%</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>625</td>
                            <td>5% </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>3125</td>
                            <td> 3%</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>15625</td>
                            <td> 2%</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- resume -->

        </div>
    </div>


</section>
<?php include_once 'contact_footer_views.php';?>

</body>
</html>
