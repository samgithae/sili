<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/24/17
 * Time: 3:43 PM
 */

namespace App\Entity;


class Setting
{
 private $id;
 private $payoutDay;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPayoutDay()
    {
        return $this->payoutDay;
    }

    /**
     * @param mixed $payoutDay
     */
    public function setPayoutDay($payoutDay)
    {
        $this->payoutDay = $payoutDay;
    }

}