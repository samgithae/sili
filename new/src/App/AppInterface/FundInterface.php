<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/5/17
 * Time: 5:22 PM
 */

namespace App\AppInterface;


interface FundInterface extends BaseInterface
{
    public static function updateAccountEarning($userId, $amount);
    public static function updateAccountBalance($userId, $amount);
    public static function checkBalance($userId);
    public static function withDraw($userId, $amount);
}