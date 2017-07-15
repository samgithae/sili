<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 7/6/17
 * Time: 12:18 PM
 */

namespace App\Services;


use App\Controller\FundController;

class FileManager
{

    public static function getData(){
        $data = FundController::showPayoutList();
        return $data;
    }

    public static function addRowToCsv(& $csvString, $cols){
        $csvString .= implode(',', $cols) . PHP_EOL;
    }

    public function createCsv(){
        $rows = self::getData();
        $csvString = '';
        $first = true;
        foreach ($rows as $row){
            if($first===true) {
                $first=false;
                self::addRowToCsv($csvString, array_keys($row));
            }
            self::addRowToCsv($csvString, $row);
        }

        header('Content-type: text/csv');
        $fileName = "asili_payment" . date('Ymd') . ".xls";
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        echo $csvString;

    }
}