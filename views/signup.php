<?php
session_start();
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 06/05/2017
 * Time: 22:22
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once 'AfricasTalkingGateway.php';
require_once 'config.php';
include "includes/signup.inc.php";
function cleanInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../public/assets/css/bootstrap.css">
    <link rel="stylesheet" href="../public/assets/css/main.css">

    <link rel="stylesheet" href="../public/assets/css/custom.css">
    <style>
        .error {
            color: rgba(206, 25, 17, 0.82);
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
    improve your experience.</p>
<![endif]-->


<section id="header" class="bg-color0">
    <div class="container">
        <div class="row">

            <a class="navbar-brand" href="#top"><img src="public/assets/img/logo4.png" alt=""></a>

            <div class="col-sm-12 mainmenu_wrap">
                <div class="main-menu-icon visible-xs"><span></span><span></span><span></span></div>
                <?php
                include_once 'header_menu2.php';
                ?>
            </div>

        </div>
    </div>
</section>

<section id="join" class="grey_section" style="padding-top: 7%;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <br/>
                <br/>
                <h3 class="block-header">Join Us</h3>
                <p>Please fill the information below to join us.</p>
                <?php
                if (empty($success) && !empty($error)) {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $error ?>
                    </div>
                    <?php
                } elseif (empty($error) and !empty($success)) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $success ?>
                    </div>

                    <?php
                } else {
                    echo "";
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="page-container">

                <div class="col-md-12 col-md-offset-2">

                    <div><span class="error"><?php echo $strengthErr;?></span></div>
                    <form role="form" class="form-horizontal form-groups-bordered" method="post"
                          action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">


                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label for="referralCode" class="control-label">Referral Code</label>


                                <input type="text" class="form-control " name="referralCode" id="referralCode" value="<?php echo isset($_POST['referralCode']) ? $_POST['referralCode']: '' ?>">

                            </div>

                            <div class="col-sm-4">
                                <label for="fullName" class=" control-label">Full Name <span
                                            class="error"> * <?php echo $fullNameErr ?></span></label>
                                <input type="text" class="form-control" name="fullName" id="fullName" value="<?php echo isset($_POST['fullName']) ? $_POST['fullName']: '' ?>" required>

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">

                            <div class="col-sm-4">
                                <label for="username" class="control-label">Username <span
                                            class="error">* <?php echo $usernameErr ?></span></label>

                                <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($_POST['username']) ? $_POST['username']: '' ?>" required>
                            </div>

                            <div class="col-sm-4">
                                <label for="idNo" class="control-label">ID Number <span
                                            class="error">* <?php echo $idNoErr ?></span></label>
                                <input type="number" class="form-control" name="idNo" id="idNo" value="<?php echo isset($_POST['idNo']) ? $_POST['idNo']: '' ?>" required>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label for="phoneNumber" class="control-label">Phone Number <span
                                            class="error">* <?php echo $phoneNumberErr ?></span></label>

                                <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" value="<?php echo isset($_POST['phoneNumber']) ? $_POST['phoneNumber']: '' ?>" required>


                            </div>
                            <div class="col-sm-4">
                                <label for="email" class="control-label">Email <span
                                            class="error">* <?php echo $emailErr ?></span></label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email']: '' ?>" required/>
                            </div>
                        </div>


                        <!--text input-->
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label for="password" class=" control-label">Password <span
                                            class="error">* <?php echo $passwordErr ?></span></label>

                                <input type="password" class="form-control" id='password' name="password" value="<?php echo isset($_POST['password']) ? $_POST['password']: '' ?>" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="confirmPassword" class="control-label">Confirm Password <span class="error">* <?php echo $confirmPasswordErr ?></span></label>


                                <input type="password" class="form-control" name="confirmPassword"
                                       id="confirmPassword" value="<?php echo isset($_POST['confirmPassword']) ? $_POST['confirmPassword']: '' ?>" required/>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <span class="error"><?php echo $matchErr; ?></span>
                                <input type="submit" name="submit" value="Checkout"
                                       class="btn btn-info btn-lg btn-block "/>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>


<?php include_once 'contact_footer_views.php'; ?>
<script src="../public/assets/js/jquery-1.11.3.min.js"></script>

<script src="../public/assets/js/bootstrap.js"></script>

<script>
    $(document).ready(function (e) {
       e.preventDefault;
       checkIpn();
       
    })
</script>
<script>
    function checkIpn() {
        var url = 'ipn.php';
        $.ajax(
            {
               type: 'GET',
                url: url,
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                async: false

            }
        ).success(function (response) {
            console.log(response);
            if(response.statusCode == 200){
                window.location.href = 'signup_success.php?status=200';
            }
            setTimeout(function () {
                checkIpn()
            },500);
        })
    }
</script>
</body>
</html>


