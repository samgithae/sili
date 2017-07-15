<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 4:34 PM
 */

namespace App\AppInterface;


interface BaseInterface
{
    public static function delete($id);

    public static function destroy();

    public static function getId($id);

    public static function getObject($id);

    public static function all();


}