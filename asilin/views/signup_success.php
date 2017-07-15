<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/13/17
 * Time: 5:32 PM
 */
$message = '';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Success</title>
    <link rel="stylesheet" href="../public/assets/css/bootstrap.css">
    <link rel="stylesheet" href="../public/assets/css/main.css">

    <link rel="stylesheet" href="../public/assets/css/custom.css">
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<section id="header" class="bg-color0">
    <div class="container"><div class="row">

            <a class="navbar-brand" href="#top"><img src="../public/assets/img/logo4.png" alt=""></a>

            <div class="col-sm-12 mainmenu_wrap"><div class="main-menu-icon visible-xs"><span></span><span></span><span></span></div>
                <?php
                include_once 'header_menu2.php';
                ?>
            </div>

        </div></div>
</section>
<section id="services" class="grey_section">
    <div class="container"><div class="row" style="padding: 50px;">
            <div class="col-sm-8 col-md-offset-2" >
                <?php
                if(isset($_GET['status']) && $_GET['status']==200) {
                ?>
                <div class="alert alert-success " style="text-align: center;">
                     <h2>Account created successfully</h2>
                    <br>
                    <h4>You will receive a confirmation email once your account is approved</h4>
                    <a href="../index.php" class="theme_btn" style="padding: 10px;"><i class="rt-icon-ok"></i> Back to Home </a>

                </div>

                <?php
                }
                ?></div>

        </div></div>
</section>

<?php include_once 'contact_footer_views.php';?>



</body>
</html>