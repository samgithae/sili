<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/5/17
 * Time: 5:28 PM
 */

namespace App\Controller;


use App\AppInterface\FundInterface;
use App\DBManager\DB;
use App\Entity\Fund;

class FundController implements FundInterface
{
    public function create(Fund $fund){
        $userId = $fund->getUserId();
        $totalEarning = $fund->getAmountEarning();
        $balance = $fund->getBalance();
        $db = new DB();
        $conn = $db->connect();
        try{
            $stmt = $conn->prepare("INSERT INTO earning_account(userId, totalEarning, balance)
                                    VALUES(:userId, :totalEarning, :balance)");
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":totalEarning", $totalEarning);
            $stmt->bindParam(":balance", $balance);
            if($stmt->execute()){
                $db->closeConnection();
                return true;
            } else{
                $db->closeConnection();
                return false;
            }
        } catch (\PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public static function updateAccountEarning($userId, $amount)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("UPDATE earning_account SET totalEarning=totalEarning+{$amount}
                                    WHERE userId=:userId");
            $stmt->bindParam(":userId", $userId);
            if ($stmt->execute()) {
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

    public static function updateAccountBalance($userId, $amount)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("UPDATE earning_account SET balance=balance+{$amount}
                                    WHERE userId=:userId");
            $stmt->bindParam(":userId", $userId);
            if ($stmt->execute()) {
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


    public static function checkBalance($userId)
    {
        try {
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("SELECT balance FROM earning_account WHERE userId=:userId");
            $stmt->bindParam(":userId", $userId);
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $db->closeConnection();
                return $row['balance'];
            } else {
                $db->closeConnection();
                return 0;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public static function withDraw($userId, $amount)
    {
        $db = new DB();
        $conn = $db->connect();
        //check if the account balance is sufficient

        $balance = self::checkBalance($userId);

        try {
            if ((float)$balance >= (float)$amount) {
                $stmt = $conn->prepare("UPDATE earning_account SET balance=balance-{$amount} 
                                        WHERE  userId=:userId");
                $stmt->bindParam(":userId", $userId);
                if ($stmt->execute()) {
                    $db->closeConnection();
                    return true;
                } else {
                    $db->closeConnection();
                    return false;
                }
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public static function destroy()
    {
        // TODO: Implement destroy() method.
    }

    public static function getId($id)
    {
        // TODO: Implement getId() method.
    }

    public static function getObject($id)
    {
        // TODO: Implement getObject() method.
    }

    public static function all()
    {
        // TODO: Implement all() method.
    }

    public static function showAllEarnings(){
        $db = new DB();
        $conn = $db->connect();
        try{
            $stmt = $conn->prepare("SELECT DISTINCT u.userReferralCode,
                                    u.fullName, u.idNo, u.email, u.phoneNumber,
                                    t.totalEarning, t.balance
                                    FROM users u , earning_account t
                                    INNER JOIN users ur ON t.userId=ur.id
                                    WHERE t.userId=u.id AND t.totalEarning !=0");
            if($stmt->execute()){
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $db->closeConnection();
                return $rows;
            } else{
                $db->closeConnection();
                return [];
            }
        } catch (\PDOException $e){
            echo $e->getMessage();
            return [];
        }
    }

    public static function myEarning($userId){
        $db = new DB();
        $conn = $db->connect();
        try{
            $stmt = $conn->prepare("SELECT DISTINCT u.userReferralCode,u.username,
                                    u.fullName, u.idNo, u.email, u.phoneNumber,
                                    u.createdAt, t.totalEarning, t.balance
                                    FROM users u , earning_account t
                                    INNER JOIN users ur ON t.userId=ur.id
                                    WHERE t.userId=u.id  AND
                                    t.userId=:userId LIMIT 1");
            $stmt->bindParam(":userId", $userId);
            if($stmt->execute()){
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $db->closeConnection();
                return $row;
            } else{
                $db->closeConnection();
                return [];
            }
        } catch (\PDOException $e){
            echo $e->getMessage();
            return [];
        }
    }

}