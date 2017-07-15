<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 4:38 PM
 */

namespace App\AppInterface;


use App\Entity\User;

interface UserInterface extends BaseInterface
{
    public function create(User $user);
    public function update(User $user, $id);
}