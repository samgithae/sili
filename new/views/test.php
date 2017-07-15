<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/16/17
 * Time: 9:57 AM
 */

require_once __DIR__.'/../vendor/autoload.php';
require_once 'config.php';
use \App\Entity\Payment;
use \App\Controller\PaymentController;
//
//$payment = new Payment();
//$payment = new Payment();
//$payment->setEmail("test@mail.com");
//$payment->setUserId(rand(1, 1000));
//$payment->setAmount((float)constant('AMOUNT'));
//$payment->setDatePaid(date('Y-m-d H:i:s'));
//$payment->setPhoneNumber("1234");
//$payment->setTransactionId(md5(uniqid("txnId", true)));
//
//
//$paymentCtrl = new PaymentController();
//if($paymentCtrl->create($payment) ===TRUE){
//    echo "i executed";
//}
//else{
//    print_r($paymentCtrl->create($payment));
//}

$password = "123@123.Ab";
if(\App\Auth\Auth::passwordValidator($password) === true){
    echo "strong password";
}else if(\App\Auth\Auth::passwordValidator($password) === false){
    echo "password must contain at least 1 capital letter, a number and atleast 1 special character ";
}