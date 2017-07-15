<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 11:31 PM
 */

namespace App\Controller;


use App\AppInterface\PaymentInterface;
use App\DBManager\DB;
use App\Entity\Payment;


class PaymentController implements PaymentInterface
{
    public function create(Payment $payment)
    {
        $transactionId = $payment->getTransactionId();
        $userId = $payment->getUserId();
        $paymentMethod = $payment->getPaymentMethod();
        $amount = $payment->getAmount();
        $phoneNumber = $payment->getPhoneNumber();
        $email = $payment->getEmail();
        $status = $payment->getStatus();
        $datePaid = $payment->getDatePaid();

        try{
           $db =  new DB();
           $conn = $db->connect();
           $stmt = $conn->prepare("INSERT INTO payments(
                                                        transactionId,
                                                        userId, 
                                                        paymentMethod,
                                                        amount,
                                                        phoneNumber, 
                                                        email,
                                                        status,
                                                        datePaid
                                                        )
                                                VALUES (
                                                :transactionId,
                                                :userId,
                                                :paymentMethod, 
                                                :amount,
                                                :phoneNumber,
                                                :email,
                                                :status,
                                                :datePaid
                                                )
                                                ");
           $stmt->bindParam(":transactionId", $transactionId);
           $stmt->bindParam(":userId", $userId);
           $stmt->bindParam(":paymentMethod", $paymentMethod);
           $stmt->bindParam(":amount", $amount);
           $stmt->bindParam(":phoneNumber", $phoneNumber);
           $stmt->bindParam(":email", $email);
           $stmt->bindParam(":status", $status);
           $stmt->bindParam(":datePaid", $datePaid);
           $query = $stmt->execute();
           if ($query) {
               return true;
           } else{

               return ["error"=>$stmt->errorInfo()];
           }

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;

        }
    }

    public static function delete($id)
    {
        try{
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("DELETE FROM  payments WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $query = $stmt->execute();
            if ($query){
                $db->closeConnection();
                return true;
            } else{
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
        try{
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("DELETE FROM  payments WHERE 1");
            $query = $stmt->execute();
            if ($query){
                $db->closeConnection();
                return true;
            } else{
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
      try{
          $db = new DB();
          $conn = $db->connect();
          $stmt = $conn->prepare("SELECT t.* FROM payments t WHERE t.id=:id");
          $stmt->bindParam(":id", $id);
          if ($stmt->execute() && $stmt->rowCount()==1){
              $row = $stmt->fetch(\PDO::FETCH_ASSOC);
              $db->closeConnection();
              return $row;
          } else{
              $db->closeConnection();
              return [];
          }
      }catch (\PDOException $e){
          echo $e->getMessage();
          return [];
      }
    }

    public static function getObject($id)
    {
        try{
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("SELECT t.* FROM payments t WHERE t.id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(\PDO::FETCH_ASSOC |\PDO::FETCH_PROPS_LATE, Payment::class);
            if ($stmt->execute() && $stmt->rowCount()==1){
                $payment = $stmt->fetch();
                $db->closeConnection();
                return $payment;
            } else{
                $db->closeConnection();
                return null;
            }
        }catch (\PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }

    public static function all()
    {
        try{
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("SELECT t.* FROM payments t WHERE 1");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute() && $stmt->rowCount()>0){
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $db->closeConnection();
                return $rows;
            } else{
                $db->closeConnection();
                return [];
            }
        }catch (\PDOException $e){
            echo $e->getMessage();
            return [];
        }
    }

    public static function completeTxn($transactionId, $status='success'){
        $db = new DB();
        $conn = $db->connect();
        try{
            $stmt = $conn->prepare("UPDATE payments SET `status`=:status WHERE transactionId=:transactionId");
            $stmt->bindParam(":transactionId", $transactionId);
            $stmt->bindParam(":status", $status);
            if($stmt->execute()){
                //$db->closeConnection();
                return true;
            }else{
                //$db->closeConnection();
                return false;
            }
        }catch (\PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

}