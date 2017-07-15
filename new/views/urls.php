<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/13/17
 * Time: 11:04 PM
 */

require_once __DIR__.'/../vendor/autoload.php';
use \App\Controller\SiteController;
$counter=1;
$sites = SiteController::all();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="../public/assets/css/bootstrap.css">
    <link rel="stylesheet" href="../public/assets/css/main.css">

    <link rel="stylesheet" href="../public/assets/css/custom.css">
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<section id="header" class="bg-color0">
    <div class="container"><div class="row">

            <a class="navbar-brand" href="#top"><img src="../public/assets/img/logo4.png" alt=""></a>

            <div class="col-sm-12 mainmenu_wrap"><div class="main-menu-icon visible-xs"><span></span><span></span><span></span></div>
                <?php
                include_once 'header_menu_views.php';
                ?>
            </div>

        </div></div>
</section>



<section id="services" class="grey_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <br/>
                <h1 class="block-header">E-learning Websites</h1>
                <h3>Here is a list of the best E-learning websites</h3>
            </div>
        </div>

        <div class="row">

            <div class="block col-sm-8 col-sm-offset-2">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Website</th>
                        <th>Description</th>
                        <th>Visit website</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($sites as $site):?>
                    <tr>
                        <th scope="row"><?php echo $counter?></th>
                        <td><?php echo $site['url']?></td>
                        <td><?php echo $site['description'] ?></td>
                        <td><a href="<?php echo $site['url']?> " target="_blank"><button type="button" class=" btn-sm btn-primary" style="text-align: center;">Visit</button></a> </td>
                    </tr>
                        <?php $counter++?>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>




        </div>
    </div>
</section>

<?php include_once 'contact_footer_views.php';?>



</body>
</html>