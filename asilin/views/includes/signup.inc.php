<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/12/17
 * Time: 10:40 PM
 */

use \App\Entity\User;
use \App\Entity\Payment;
use \App\Controller\UserController;
use \App\Controller\ReferralTreeController;
use \App\Controller\PaymentController;

$error = $success = $usernameErr = $fullNameErr = $idNoErr
    = $passwordErr = $confirmPasswordErr = $phoneNumberErr
    = $emailErr = $matchErr = '';
$_SESSION['referralCode'] = ReferralTreeController::generateReferralCode();
$fullName = $idNo = $username = $phoneNumber = $email =
$password = $confirmPassword = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['username'])) {
        $usernameErr .= "Username  required";
    } else {
        $username = cleanInput($_POST['username']);
    }
    if (empty($_POST['fullName'])) {
        $fullNameErr = 'Full Name Required';
    } else {
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['fullName'])) {
            $fullNameErr = "Only letters and white space allowed";
        } else {
            $fullName = cleanInput($_POST['fullName']);
        }
    }
    if (empty($_POST['email'])) {
        $emailErr = "Email Required";
    } else {
        if (!filter_var(cleanInput($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email";
        } else {
            $email = cleanInput($_POST['email']);
        }
    }
    if (empty($_POST['idNo'])) {
        $idNoErr = 'Id Number Required';
    } else {
        if (!is_numeric(cleanInput($_POST['idNo']))) {
            $idNoErr = "Only Numeric Value Allowed";
        } else {
            $idNo = cleanInput($_POST['idNo']);
        }
    }
    if (empty($_POST['phoneNumber'])) {
        $phoneNumberErr = "Phone Number Required";
    } else {
        $phoneNumber = cleanInput($_POST['phoneNumber']);
    }

    if (empty($_POST['password'])) {
        $passwordErr = "Password Required";
    } else {
        $password = cleanInput($_POST['password']);
    }
    if (empty($_POST['confirmPassword'])) {
        $confirmPasswordErr = "Confirm Password Required";
    } else {
        $confirmPassword = cleanInput($_POST['confirmPassword']);
    }
    if ($confirmPassword != $password) {
        $matchErr = 'Password Did not Match';
        $error .= 'Error! Password Did not Match';
    }
    if ($usernameErr == '' && $fullNameErr == '' &&
        $idNoErr == '' && $passwordErr == '' &&
        $confirmPasswordErr == '' && $phoneNumberErr == '' &&
        $emailErr == '' && $matchErr == ''
    ) {

        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setFullName($fullName);
        $user->setCreatedAt(date('Y-m-d H:i:s'));
        $user->setAccountStatus('pending');
        $user->setEmail($email);
        $user->setIdNo($idNo);
        $user->setLastLogin(date('Y-m-d H:i:s'));
        $user->setLoginIp($_SERVER['REMOTE_ADDR']);
        $user->setPhoneNumber($phoneNumber);
        $user->setPaymentStatus('pending');
        $user->setUserReferralCode($_SESSION['referralCode']);
        $user->setIsAdmin(0);
        $userCtrl = new UserController();
        $created = $userCtrl->create($user);
        //print_r($user);
        print_r($created);
        if ($created===true) {
            $id = ReferralTreeController::getUserId($_SESSION['referralCode']);
            try {

                $metadata = array(
                    "userId" => $id,
                    "userReferralCode" => $_SESSION['referralCode'],
                    "referralCodePosted"=>isset($_POST['referralCode']) ? $_POST['referralCode'] : null
                );

                $phoneNumber = cleanInput($_POST['phoneNumber']);
                $gateway = new AfricasTalkingGateway(constant('API_USERNAME'), constant('API_KEY'), "sandbox");
                $transactionId = $gateway->initiateMobilePaymentCheckout(
                    constant('MOBILE_PRODUCT'),
                    $phoneNumber,
                    constant('CURRENCY_CODE'),
                    (float)constant('AMOUNT'),
                    $metadata
                );
                $payment = new Payment();
                $payment->setEmail($email);
                $payment->setUserId($id);
                $payment->setAmount((float)constant('AMOUNT'));
                $payment->setDatePaid(date('Y-m-d H:i:s'));
                $payment->setTransactionId($transactionId);
                $payment->setStatus("pending");
                $payment->setPhoneNumber($phoneNumber);
                $payment->setPaymentMethod("Mpesa");
                $paymentCtrl = new PaymentController();
                $paymentCtrl->create($payment);
                unset($_SESSION['referralCode']);
            } catch (AfricasTalkingGatewayException $e) {
                echo $e->getMessage();
            }

            $success .= "Checkout initiated successfully please confirm the payment sent in your phone to complete Sign Up process";
        } elseif(array_key_exists('error', $created)) {
            $error .= "Error Internal Server error occurred. Account not Created {$created['error']}";
        } elseif($created === FALSE){
            $error .="Error occurred";
        }
    }
}

