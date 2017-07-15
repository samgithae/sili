<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/14/17
 * Time: 11:18 PM
 */
use App\Auth\Auth;

$username = $password = $loginError = '';
if (isset($_SESSION['username'])|| isset($_COOKIE[md5('asili_username')])) {
    header("Location: views/dashboard.php");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['loginUsername']) && !empty($_POST['loginPassword'])) {
        $username = cleanInput($_POST['loginUsername']);
        $password = cleanInput($_POST['loginPassword']);
        if (isset($_POST['keepLoggedIn'])) {
            //login and set cookie
            $cookie_name = md5('asili_username');
            $cookie_value = sha1($username);
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        }
        $auth = Auth::authenticate($username, $password);
        if (!empty($auth['accountStatus'])) {
            if ($auth['accountStatus'] == 'active') {
            
                $_SESSION['username'] = $username;

                header("Location: views/dashboard.php");
            } elseif ($auth['accountStatus'] == 'blocked') {
                $loginError = "Your account has been blocked contact support@asilie-learning.co.ke for more info";
            } elseif ($auth['accountStatus'] == 'pending') {
                $loginError = "Your account is not yet approved you will be notified via email once the approval process is complete";
            } else {
                $loginError = "Invalid username/password";
            }
        } elseif(empty($auth)) {
            $loginError = "Invalid username/password";
        }

    }
}