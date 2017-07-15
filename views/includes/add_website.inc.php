<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 13/06/2017
 * Time: 18:45
 */
use App\Entity\Site;
use App\Controller\SiteController;
$success_msg='';
$error_msg='';


if(!empty($_POST['url'])) {
    $website = $_POST["url"];
    if (preg_match("/\b(?:(?:https?|http):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {


    $site = new Site();
    $site->setUrlName($_POST['urlName']);
    $site->setUrl($_POST['url']);
    $site->setDescription(null);
    $site->setCategory($_POST['category']);
    $siteCtrl = new SiteController();
    $created = $siteCtrl->createSingle($site);
    if ($created) {
        $success_msg .= 'Website saved Successfully';
    } else {
        $error_msg .= "Error occurred, please try again later";
    }

}
else{
    $error_msg .= "Invalid URL";
}

}