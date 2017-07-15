<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/18/17
 * Time: 4:30 PM
 */
require_once __DIR__ . '/../vendor/autoload.php';
$data = file_get_contents('php://input');
$json = json_decode($data, true);
use \App\Controller\PaymentController;
use \App\Controller\ReferralTreeController;
use \App\Controller\UserController;

if (strtolower($json['status']) == 'success') {
    $id = $json['requestMetadata']['userId'];
    $referralCode = $json['requestMetadata']['referralCodePosted'];
    $userReferralCode = $json['requestMetadata']['userReferralCode'];
    $completed = PaymentController::completeTxn($json['transactionId']);
    if ($completed === true) {

        if (!empty($data['requestMetadata']['referralCodePosted'])) {
            $refTree = ReferralTreeController::createReferralTree($id, $userReferralCode, $referralCode);
        } elseif (empty($data['requestMetadata']['referralCodePosted'])) {
            $refTree = ReferralTreeController::createReferralTree($id, $userReferralCode);
        }
        ReferralTreeController::createReferralCodeEarning($id, $userReferralCode);
        ReferralTreeController::createReferralCodeCounts($userReferralCode);
        $updated = ReferralTreeController::updateReferralTree($userReferralCode);
        ReferralTreeController::debitAccounts($userReferralCode);
        ReferralTreeController::updateTotalEarning();
        UserController::updatePaymentStatus($id);

        print_r(json_encode(array(
            "statusCode"=>200
        )));
        echo "<script>window.location.href='signup_success.php?status=200'</script>";
        header("Location: signup_success.php?status=200");


    } elseif ($completed === false) {
        print_r(json_decode(array(
            "statusCode" => 500,
            "message" => "Error occurred while processing your request, Please wait for 5 minutes before
            making payment again."
        )));
        header("Location: signup_success.php?status=500");
    }

} elseif (strtolower($json['status']) == 'failed') {
    $id =  $id = $json['requestMetadata']['userId'];
    $deleted = UserController::delete($id);
    if ($deleted) {
        print_r(json_encode(array(
            "statusCode" => 500,
            "message" => "Transaction failed.{$json['description']}"
        )));
    }
    echo "<script>window.location.href='signup_success.php?status=500'</script>";
    header("Location: signup_success.php?status=500");
}
