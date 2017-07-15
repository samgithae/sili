<?php
session_start();
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 12/05/2017
 * Time: 11:30
 */

unset($_SESSION['username']);


$cookie_name = md5('asili_username');
$cookie_value = "";
setcookie($cookie_name, $cookie_value, time() - (86400 * 30), "/");

session_destroy();
header('Location: ../index.php');