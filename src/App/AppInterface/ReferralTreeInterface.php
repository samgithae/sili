<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 7:45 PM
 */

namespace App\AppInterface;


use App\Entity\ReferralTree;

interface ReferralTreeInterface extends BaseInterface
{
  public function create(ReferralTree $referralTree);

}