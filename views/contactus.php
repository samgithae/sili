<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/16/17
 * Time: 10:35 AM
 */
require_once __DIR__.'/../vendor/autoload.php';
$success = $error = '';
use \App\Services\SendEmail;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['contactEmail']) && !empty($_POST['contactMessage'])){
        $email = clean($_POST['contactEmail']);
        $message = clean($_POST['contactMessage']);
        $vendor = '';
        $vendorEmail = "info@asilie-learning.co.ke";
        if(isset($_POST['contactName'])){
            $vendor = clean($_POST['contactName']);
        }
        $mail = new SendEmail($vendorEmail,$email);
        $mail->setVendor($vendor);
        $mail->setSubject("Contact Message");
        $mail->setMessage($message);
        if($mail->send()){
            $success = "You message has been received";
        }else{
            $error = "Error occurred try again later";
        }
    }
}
function clean($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>