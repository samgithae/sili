<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 3:14 PM
 */

namespace App\Entity;


class User
{
    private $id;
    private $userReferralCode;
    private $fullName;
    private $idNo;
    private $phoneNumber;
    private $email;
    private $username;
    private $password;
    private $paymentStatus;
    private $accountStatus;
    private $lastLogin;
    private $loginIp;
    private $createdAt;
    private $isAdmin;

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

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getIdNo()
    {
        return $this->idNo;
    }

    /**
     * @param mixed $idNo
     */
    public function setIdNo($idNo)
    {
        $this->idNo = $idNo;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return mixed
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * @param mixed $paymentStatus
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * @return mixed
     */
    public function getAccountStatus()
    {
        return $this->accountStatus;
    }

    /**
     * @param mixed $accountStatus
     */
    public function setAccountStatus($accountStatus)
    {
        $this->accountStatus = $accountStatus;
    }

    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param mixed $lastLogin
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return mixed
     */
    public function getLoginIp()
    {
        return $this->loginIp;
    }

    /**
     * @param mixed $loginIp
     */
    public function setLoginIp($loginIp)
    {
        $this->loginIp = $loginIp;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        $createdAt = date('Y-m-d H:i:s');
        return $createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }


}