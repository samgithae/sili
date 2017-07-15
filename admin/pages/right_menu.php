<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 13/06/2017
 * Time: 12:00
 */
?>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../../index.php">Asili Africa E-learning Centre</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
       
       
        
        
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="../../views/profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                
                <li class="divider"></li>
                <li><a href="../../views/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                   <p style="text-align:center"><a href="index.php"> <img src='../../public/assets/img/logo3.png' width='100px' height='100px'></a></p>
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="users.php"><i class="fa fa-user fa-fw"></i> View Users<span class="fa arrow"></span></a>

                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="payment.php"><i class="fa fa-dollar  fa-fw"></i> Payments</a>
                </li>
                <li>
                    <a href="earning.php"><i class="fa fa-dollar fa-fw"></i> Earnings</a>
                </li>
                
                <li>
                    <a href="txnLogs.php"><i class="fa fa-history fa-fw"></i> Transactions</a>
                </li>
                <li>
                    <a href="add_website.php"><i class="fa fa-plus-circle fa-fw"></i> Add Website Url<span class="fa arrow"></span></a>

                    <!-- /.nav-second-level -->
                </li>
                 <li>
                    <a href="payout_day.php"><i class="fa fa-calendar-o fa-fw"></i>Set Payout Day<span class="fa arrow"></span></a>

                    <!-- /.nav-second-level -->
                </li>


            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

