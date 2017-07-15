
<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 08/05/2017
 * Time: 19:31
 */
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
            <a class="navbar-brand mobile-hide" href="#top"><img src="public/assets/img/logo4.png" alt=""></a>
            <a class="navbar-brand desktop-hide" href="#top"><img src="public/assets/img/logo3.png" width="50" height="50" alt=""></a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse" id="navigationbar">
            <ul class="nav navbar-nav   menu sf-menu responsive-menu superfish">
                <li class="">
                    <a href="#"  style="font-size: 15px;  padding: 20px 10px 5px 10px;">Home</a>
                </li>
                <li class="">
                    <a href="#title_about"  style="font-size: 15px;  padding: 20px 10px 5px 10px;">About</a>
                </li>


                <li class="">
                    <a href="#contact"  style="font-size: 15px;  padding: 20px 10px 5px 10px;">Contact</a>
                </li>
                <li class="">
                    <a href="views/signup.php"><button class="joinBtn">Join Us</button></a>
                </li>

                <li>
                    <a href="#"><button class="loginBtn">Login</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

