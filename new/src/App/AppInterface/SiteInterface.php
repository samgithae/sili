<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 9:59 PM
 */

namespace App\AppInterface;


use App\Entity\Site;

interface SiteInterface extends BaseInterface
{
    public function createSingle(Site $site);

    public function createMultiple(array $sites);

    public function updateSingle(Site $site, $id);

    public function updateMultiple(array $sites);

}