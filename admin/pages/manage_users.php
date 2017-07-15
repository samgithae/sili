<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/15/17
 * Time: 3:09 PM
 */
require_once __DIR__.'/../../vendor/autoload.php';
use \App\Controller\UserController;
use \App\Services\SendEmail;

$vendorEmail = "asilie-learning.co.ke";

$data = json_decode(file_get_contents('php://input'), true);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
 if(!empty($data)){
     $option = $data['option'];
     switch ($option){
         case 'approve':
             approveAccount();
             break;
         case 'block':
             blockAccount();
             break;
         case 'unblock':
             unblockAccount();
             break;
     }
 }
}

function approveAccount(){
    global $data;
    $approved  = UserController::approveAccount($data['userId']);
    if($approved === true){
        $user = UserController::getId($data['userId']);
        global $vendorEmail;
        $mail = new SendEmail($user['email'], $vendorEmail);
        $mail->setSubject("Asili Africa Account Approval");
        $mail->setMessage("Your Asili Africa E-learning Account has been approved visit www.asilie-learning.co.ke ");
        $mail->setVendor("Asili Elearning");
        $mail->send();

        print_r(json_encode(array(
            "statusCode"=>200,
            "message"=>"Account Approved successfully"
        )));

    }else{
        print_r(json_encode(array(
            "statusCode"=>500,
            "message"=>"Internal Server Error Occurred please try again latter"
        )));
    }
}
function blockAccount(){
    global $data;
    $blocked  = UserController::blockAccount($data['userId']);
    if($blocked === true){
        $user = UserController::getId($data['userId']);

        global $vendorEmail;
        $mail = new SendEmail($user['email'], $vendorEmail);
        $mail->setSubject("Account Blocked");
        $mail->setMessage("Dear {$user['fullName']}, Your Asili Africa E-learning Account has been Blocked Contact support@asilie-learning.co.ke for any queries");
        $mail->setVendor("Asili Elearning");
        $mail->send();

        print_r(json_encode(array(
            "statusCode"=>200,
            "message"=>"Account Blocked "
        )));

    }else{
        print_r(json_encode(array(
            "statusCode"=>500,
            "message"=>"Internal Server Error Occurred please try again latter"
        )));
    }
}
function unblockAccount(){
    global $data;
    $unblocked  = UserController::unblockAccount($data['userId']);
    if($unblocked === true){
        print_r(json_encode(array(
            "statusCode"=>200,
            "message"=>"Account Unblocked "
        )));

        $user = UserController::getId($data['userId']);
        global $vendorEmail;
        $mail = new SendEmail($user['email'], $vendorEmail);
        $mail->setSubject("Account Reactivated");
        $mail->setMessage("Hello {$user['fullName']} We are glad to inform you that your Asili Africa E-learning Account has been Reactivated. Welcome back");
        $mail->setVendor("Asili Elearning");
        $mail->send();
    }else{
        print_r(json_encode(array(
            "statusCode"=>500,
            "message"=>"Internal Server Error Occurred please try again latter"
        )));
    }
}