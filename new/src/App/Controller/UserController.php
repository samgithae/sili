<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 5:13 PM
 */

namespace App\Controller;


use App\AppInterface\UserInterface;
use App\Entity\User;
use App\DBManager\DB;

class UserController implements UserInterface
{
    public function create(User $user)
    {
        $userReferralCode = $user->getUserReferralCode();
        $fullName = $user->getFullName();
        $idNo = $user->getIdNo();
        $phoneNumber = $user->getPhoneNumber();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $paymentStatus = $user->getPaymentStatus();
        $accountStatus = $user->getAccountStatus();
        $loginIp = $user->getLoginIp();
        $createdAt = $user->getCreatedAt();
        $isAdmin = $user->getIsAdmin();
        //print_r($user);
        try {
            $db = new DB();
            $conn = $db->connect();

            $stmt = $conn->prepare("INSERT INTO users(
                                                        userReferralCode,
                                                        fullName,
                                                        idNo,
                                                        phoneNumber, 
                                                        email, 
                                                        username,
                                                        password, 
                                                        paymentStatus,
                                                        accountStatus,   
                                                        loginIp, 
                                                        createdAt,
                                                        isAdmin
                                                        ) 
                                                  VALUES(
                                                        :userReferralCode,
                                                        :fullName,
                                                        :idNo,
                                                        :phoneNumber, 
                                                        :email, 
                                                        :username,
                                                        :password, 
                                                        :paymentStatus,
                                                        :accountStatus,
                                                        :loginIp, 
                                                        :createdAt,
                                                        :isAdmin
                                                        ) 
                                                  ");
            $stmt->bindParam(":userReferralCode", $userReferralCode);
            $stmt->bindParam(":fullName", $fullName);
            $stmt->bindParam(":idNo", $idNo);
            $stmt->bindParam(":phoneNumber", $phoneNumber);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":paymentStatus", $paymentStatus);
            $stmt->bindParam(":accountStatus", $accountStatus);
            $stmt->bindParam(":loginIp", $loginIp);
            $stmt->bindParam(":createdAt", $createdAt);
            $stmt->bindParam(":isAdmin", $isAdmin);
            $query = $stmt->execute();
            if ($query) {
                $db->closeConnection();
                return true;
            } else {
                $db->closeConnection();
                return [
                    "error"=>"STMT ERROR 0".$stmt->errorInfo()[0]."1 ".$stmt->errorInfo()['1']." 2 ".$stmt->errorInfo()['2']
                ];
            }

        } catch (\PDOException $e) {
            return [
                "error"=>$e->getMessage()
            ];
        }
    }

    public function update(User $user, $id)
    {
        $userReferralCode = $user->getUserReferralCode();
        $fullName = $user->getFullName();
        $idNo = $user->getIdNo();
        $phoneNumber = $user->getPhoneNumber();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $paymentStatus = $user->getPaymentStatus();
        $accountStatus = $user->getAccountStatus();
        $loginIp = $user->getLoginIp();
        $createdAt = $user->getCreatedAt();
        $isAdmin = $user->getIsAdmin();
        try {

            $db = new DB();
            $conn = $db->connect();

            $stmt = $conn->prepare("UPDATE users SET 
                                                    userReferralCode=:userReferralCode,
                                                    fullName=:fullName,
                                                    idNo=:idNo,
                                                    phoneNumber=:phoneNumber, 
                                                    email=:email, 
                                                    username=:username,
                                                    password=:password, 
                                                    paymentStatus=:paymentStatus,
                                                    accountStatus=:accountStatus,   
                                                    loginIp=:loginIp, 
                                                    createdAt=:createdAt,
                                                    isAdmin=:isAdmin
                                              WHERE id=:id");

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":userReferralCode", $userReferralCode);
            $stmt->bindParam(":fullName", $fullName);
            $stmt->bindParam(":idNo", $idNo);
            $stmt->bindParam(":phoneNumber", $phoneNumber);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":paymentStatus", $paymentStatus);
            $stmt->bindParam(":accountStatus", $accountStatus);
            $stmt->bindParam(":loginIp", $loginIp);
            $stmt->bindParam(":createdAt", $createdAt);
            $stmt->bindParam(":isAdmin", $isAdmin);
            $query = $stmt->execute();
            if ($query) {
                $db->closeConnection();
                return true;
            } else {
                $db->closeConnection();
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function delete($id)
    {
        try {

            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("DELETE FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $query = $stmt->execute();
            if ($query) {
                $db->closeConnection();
                return true;
            } else {
                $db->closeConnection();
                return false;
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function destroy()
    {
        try {

            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("DELETE FROM users WHERE 1");
            $query = $stmt->execute();
            if ($query) {
                $db->closeConnection();
                return true;
            } else {
                $db->closeConnection();
                return false;
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getId($id)
    {
        try {
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute() and $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $db->closeConnection();
                return $row;
            } else {
                $db->closeConnection();
                return [];
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public static function getUserId($username)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT id FROM users WHERE username=:username LIMIT 1");
            $stmt->bindParam(":username", $username);
            $id = null;
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $id = $row['id'];
            }
            return $id;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }


    public static function getUserByUsername($username)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username LIMIT 1");
            $stmt->bindParam(":username", $username);
            $row = null;
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            }
            return $row;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public static function getObject($id)
    {
        try {
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, User::class);
            if ($stmt->execute() and $stmt->rowCount() == 1) {
                $user = $stmt->fetch();
                $db->closeConnection();
                return $user;
            } else {
                $db->closeConnection();
                return null;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public static function all()
    {
        try {
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE 1");
            if ($stmt->execute() and $stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $db->closeConnection();
                return $rows;
            } else {
                $db->closeConnection();
                return [];
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public static function approveAccount($userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $status = "active";
        try {
            $stmt = $conn->prepare("UPDATE users SET accountStatus=:accountStatus WHERE id=:userId AND 
                                    accountStatus='pending'");
            $stmt->bindParam(":userId", $userId);

            $stmt->bindParam(":accountStatus", $status);
            if ($stmt->execute()) {
                $db->closeConnection();
                return true;
            } else {
                $db->closeConnection();
                return false;
            }
        } catch (\PDOException $e) {

            return [
                "error" => $e->getMessage()
            ];
        }
    }

    public static function blockAccount($userId){
        $db = new DB();
        $conn = $db->connect();
        $status = "blocked";

        try {
            $stmt = $conn->prepare("UPDATE users SET accountStatus=:accountStatus WHERE id=:userId AND 
                                    accountStatus='active'");
            $stmt->bindParam(":userId", $userId);

            $stmt->bindParam(":accountStatus", $status);
            if ($stmt->execute()) {
                $db->closeConnection();
                return true;
            } else {
                $db->closeConnection();
                return false;
            }
        } catch (\PDOException $e) {

            return [
                "error" => $e->getMessage()
            ];
        }
    }

    public static function unblockAccount($userId){
        $db = new DB();
        $conn = $db->connect();
        $status = "active";
        $user = self::getId($userId);
        $email = $user['email'];

        try {
            $stmt = $conn->prepare("UPDATE users SET accountStatus=:accountStatus WHERE id=:userId AND 
                                    accountStatus='blocked'");
            $stmt->bindParam(":userId", $userId);

            $stmt->bindParam(":accountStatus", $status);
            if ($stmt->execute()) {
                $db->closeConnection();
                return true;
            } else {
                $db->closeConnection();
                return false;
            }
        } catch (\PDOException $e) {

            return [
                "error" => $e->getMessage()
            ];
        }
    }

}