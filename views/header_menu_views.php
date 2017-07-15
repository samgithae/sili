<?php

/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 08/05/2017
 * Time: 19:31
 */
 
require_once __DIR__.'/../vendor/autoload.php';
use \App\Controller\UserController;

$userId = UserController::getUserId($_SESSION['username']);

$user=UserController::getId($userId);


?>

<nav id="layout-nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand mobile-hide" href="#top"><img src="../public/assets/img/logo4.png" alt=""></a>
            <a class="navbar-brand desktop-hide" href="#top"><img src="../public/assets/img/logo3.png" width="50" height="50" alt=""></a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse" id="navigationbar">
            <ul class="nav navbar-nav   menu sf-menu responsive-menu superfish">
                <li class="">
                    <a href="dashboard.php"  style="font-size: 15px;  padding: 20px 10px 5px 10px;">Dashboard</a>
                </li>
              
               
                 <li class="">
                    <a href="profile.php" style="font-size: 15px;  padding: 20px 10px 5px 10px;"><?php echo $user['username']; ?> </a>
                </li>

                <li>
                    <a href="logout.php"><button  class="loginBtn" > Log out</button> </a>
                </li>
            </ul>
        </div>
    </div>
</nav>