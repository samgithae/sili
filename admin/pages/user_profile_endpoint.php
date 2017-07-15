<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/25/17
 * Time: 11:13 PM
 */

require_once __DIR__.'/../../vendor/autoload.php';
use App\Controller\UserController;

$data = json_decode(file_get_contents('php://input'), true);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $option = $data['option'];
    if($option == 'make_admin'){
        $made = UserController::makeAdmin($data['username']);
        if($made){
            print_r(json_encode(array(
                'statusCode'=>200,
                'message'=>"User Made Admin Successfully"
            )));
        }else{
            print_r(json_encode(array(
                'statusCode'=>500,
                'message'=>"Error Occurred User not Made Admin"
            )));
        }
    }

    if($option == 'remove_admin'){
        $made = UserController::removeAdmin($data['username']);
        if($made){
            print_r(json_encode(array(
                'statusCode'=>200,
                'message'=>"User Removed from Admins List Successfully"
            )));
        }else{
            print_r(json_encode(array(
                'statusCode'=>500,
                'message'=>"Error Occurred User not Removed From Admins List"
            )));
        }
    }
}