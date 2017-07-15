<?php
session_start();
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/14/17
 * Time: 11:17 AM
 */
require_once __DIR__ . '/../vendor/autoload.php';
use \App\Auth\Auth;
use \App\Controller\ReferralTreeController;
use \App\Mailer\SendEmail;

$error = $success = '';

if (!empty($_POST['email'])) {
    //check if email exists in our records
    $exists = Auth::checkEmail($_POST['email']);
    if ($exists) {
        //generate password reset code
        $resetCode = ReferralTreeController::generateReferralCode(8);
        $_SESSION['resetCode'] = $resetCode;
        //send email containing the reset code.
        $sender = 'info@hudutech.com';
        $to = $_POST['email'];
        $mail = new SendEmail($to, $sender);
        $mail->setVendor('Asili Africa');
        $mail->setMessage("Your Password Reset Code is {$_SESSION['resetCode']}");
        if($mail->send()){
            $success .= "Submitted Successfully Check you mail inbox";
            header('Refresh: 3;url=reset_password.php');
        }

    } else {
        $error .= 'Email you entered does not exist in our records';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta charset="utf-8">
     <link rel="stylesheet" href="../public/assets/css/bootstrap.css">
    <link rel="stylesheet" href="../public/assets/css/main.css">

    <link rel="stylesheet" href="../public/assets/css/custom.css">
</head>
<body>
<section id="header" class="bg-color0">
    <div class="container"><div class="row">

            <a class="navbar-brand" href="../index.php"><img src="../public/assets/img/logo4.png" alt=""></a>

            <div class="col-sm-12 mainmenu_wrap"><div class="main-menu-icon visible-xs"><span></span><span></span><span></span></div>
                <?php
              //  include_once 'header_menu_views.php';
                ?>
            </div>

        </div></div>
</section>

<section id="services" class="grey_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <br/>
                <h1 class="block-header">Reset Password Step 1</h1>
                <h3>Provide your email, to recover your email</h3>
            </div>
        </div>

        <div class="row">

            <div class="block col-sm-8 col-sm-offset-2">
                <div class="row">
                    <div class="container-fluid">
                        <div class="col col-md-8 col-md-offset-2">
                            <div >
                                <?php if ($error != ''): ?>
                                    <div class="has-error">
                                        <div class="alert alert-danger alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo $error; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($success != ''): ?>
                                    <div>
                                        <div class="alert alert-success alert-dismissable">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo $success; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>


                                <div class="panel-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"
                                          class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="email" name="email" id="email" placeholder="Enter the email you signed up with"
                                               class="form-control" required>
                                        <input type="submit" name="submit" style="margin-top: 10px" value="Submit" class="col-md-offset-3 btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</section>
<?php include_once 'contact_footer_views.php';?>
<?php include 'footer_views.php'?>
</body>
</html>
