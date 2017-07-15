<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/24/17
 * Time: 12:16 AM
 */
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Services\FileManager;
use App\Controller\FundController;

$data = FundController::showPayoutList();

if(!empty($data)){
    $fileM = new FileManager();
    $csv = $fileM->createCsv();
    $url = "earning.php?status=200";
   // header("Refresh:3; url={$url}");
}else{
    header('Location: earning.php?status=500');
}







