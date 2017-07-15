<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 7:43 PM
 */

namespace App\Entity;


class ReferralTree
{
    private $id;
    private $userId;
    private $userReferralCode;

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
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserReferralCode()
    {
        return $this->userReferralCode;
    }

    /**
     * @param mixed $userReferralCode
     */
    public function setUserReferralCode($userReferralCode)
    {
        $this->userReferralCode = $userReferralCode;
    }
}