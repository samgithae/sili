<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/24/17
 * Time: 3:45 PM
 */

namespace App\AppInterface;


use App\Entity\Setting;

interface SettingInterface extends BaseInterface
{
    public function create(Setting $setting);
    public function update(Setting $setting, $id);
}