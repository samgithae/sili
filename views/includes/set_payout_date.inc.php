<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 13/06/2017
 * Time: 18:45
 */
use App\Entity\Setting;
use App\Controller\SettingController;
$success_msg='';
$error_msg='';

if($_SERVER['REQUEST_METHOD']=='POST')
{
if(!empty($_POST['date'])) {
    
    

    $setting = new Setting();
    $setting->setPayoutDay($_POST['date']);
    
    $settingCtrl = new SettingController();
    $created = $settingCtrl->update($setting,1);
    if ($created) {
        $success_msg .= 'Date saved Successfully';
    } else {
        $error_msg .= "Error occurred, please try again later";
    }

}
else{
    $error_msg .= "Invalid date";
}
}