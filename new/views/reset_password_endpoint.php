<?php
session_start();
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/14/17
 * Time: 4:00 PM
 */

$resetCode = $_SESSION['resetCode'];

$data = json_decode(file_get_contents('php://input'), true);
$requestMethod = $_SERVER['REQUEST_METHOD'];
if($requestMethod == 'POST'){
    //Check if the submitted code matches the session code
    if(!empty($data)){
        if($data['resetCode'] == $resetCode){
            print_r(json_encode(array(
                "statusCode" => 200,
                "message" => "Reset Code Verified Successfully"
            )));
            unset($_SERVER['resetCode']);
        }else{
            print_r(json_encode(array(
                "statusCode" => 403,
                "message" => "The Code you entered is invalid"
            )));
        }
    }else{
        print_r(json_encode(array(
            "statusCode" => 401,
            "message" => "Reset Code is required"
        )));
    }
}