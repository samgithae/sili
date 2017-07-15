<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/5/17
 * Time: 5:22 PM
 */

namespace App\Entity;


class Fund
{
    private $userId;
    private $amountEarning;
    private $balance;

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
    public function getAmountEarning()
    {
        return $this->amountEarning;
    }

    /**
     * @param mixed $amountEarning
     */
    public function setAmountEarning($amountEarning)
    {
        $this->amountEarning = $amountEarning;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }


}