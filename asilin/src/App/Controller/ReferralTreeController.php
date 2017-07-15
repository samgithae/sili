<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 8:03 PM
 */

namespace App\Controller;


use App\AppInterface\ReferralTreeInterface;
use App\DBManager\DB;
use App\Entity\Fund;
use App\Entity\ReferralTree;

class ReferralTreeController implements ReferralTreeInterface
{
    public function create(ReferralTree $referralTree)
    {
        $userId = $referralTree->getUserId();
        $userReferralCode = $referralTree->getUserReferralCode();

        try {
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("INSERT INTO referral_tree(userId, userReferralCode) VALUES (:userId, :userReferralCode)");
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":userReferralCode", $userReferralCode);
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

            $stmt = $conn->prepare("DELETE FROM referral_tree WHERE id=:id");
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

            $stmt = $conn->prepare("DELETE FROM referral_tree WHERE 1");
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

    public static function getId($id)
    {
        try {
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("SELECT t.* FROM referral_tree t WHERE t.id=:id");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute() && $stmt->rowCount() == 1) {
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

    public static function getObject($id){}

    public static function all()
    {
        try {

            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("SELECT t.* FROM referral_tree t WHERE 1");

            if ($stmt->execute() && $stmt->rowCount() > 0) {
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

    public static function getUserId($referralCode)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT id FROM users WHERE userReferralCode=:referralCode");
            $stmt->bindParam(":referralCode", $referralCode);
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $db->closeConnection();
                return $row['id'];
            } else {
                $db->closeConnection();
                return null;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public static function generateReferralCode($length = 6)
    {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }

        return strtoupper($str);
    }

    public static function createReferralTree($userId, $userReferralCode, $referralCode = null)
    {
        try {
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("INSERT INTO referral_tree(userId, userReferralCode, l1)
                                    VALUES(:userId, :userReferralCode, :l1)");
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":userReferralCode", $userReferralCode);
            $stmt->bindParam(":l1", $referralCode);
            if ($stmt->execute()) {
                $db->closeConnection();
                //create earning account

                $fund = new Fund();
                $fund->setUserId($userId);
                $fund->setAmountEarning(0);
                $fund->setBalance(0);
                $fundCtrl = new FundController();
                $fundCtrl->create($fund);
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


    public static function getL1($referralCode)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT l1 FROM referral_tree WHERE userReferralCode=:referralCode");
            $stmt->bindParam(":referralCode", $referralCode);
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                //check if null first....
                return $row['l1'];
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            print $e->getMessage();
            return false;
        }
    }

    public static function getTree($referralCode)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM referral_tree WHERE userReferralCode=:referralCode");
            $stmt->bindParam(":referralCode", $referralCode);

            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return array(
                    "l1" => isset($row['l1']) ? $row['l1'] : null,
                    "l2" => isset($row['l2']) ? $row['l2'] : null,
                    "l3" => isset($row['l3']) ? $row['l3'] : null,
                    "l4" => isset($row['l4']) ? $row['l4'] : null,
                    "l5" => isset($row['l5']) ? $row['l5'] : null,
                    "l6" => isset($row['l6']) ? $row['l6'] : null
                );
            } else {
                return [];
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return ['error' => $e->getMessage()];
        }
    }

    public static function getReferredByTree($referralCode)
    {
        $db = new DB();
        $conn = $db->connect();
        $l1Code = self::getL1($referralCode);
        try {
            $stmt = $conn->prepare("SELECT * FROM referral_tree WHERE userReferralCode=:referralCode");
            $stmt->bindParam(":referralCode", $l1Code);

            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return array(
                    "l1" => isset($row['l1']) ? $row['l1'] : null,
                    "l2" => isset($row['l2']) ? $row['l2'] : null,
                    "l3" => isset($row['l3']) ? $row['l3'] : null,
                    "l4" => isset($row['l4']) ? $row['l4'] : null,
                    "l5" => isset($row['l5']) ? $row['l5'] : null
                );
            } else {
                return ['empty'];
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * @param $referralCode
     * @return bool
     */
    public static function updateReferralTree($referralCode)
    {
        $levels = self::getReferredByTree($referralCode);

        try {
            if (!empty($levels)) {
                $db = new DB();
                $conn = $db->connect();
                $stmt = $conn->prepare("UPDATE referral_tree SET l2=:l2, l3=:l3, l4=:l4, l5=:l5, l6=:l6
                                        WHERE userReferralCode=:referralCode");
                $stmt->bindParam(":l2", $levels['l1']);
                $stmt->bindParam(":l3", $levels['l2']);
                $stmt->bindParam(":l4", $levels['l3']);
                $stmt->bindParam(":l5", $levels['l4']);
                $stmt->bindParam(":l6", $levels['l5']);
                $stmt->bindParam(":referralCode", $referralCode);
                if ($stmt->execute()) {
                    $db->closeConnection();
                    return true;
                } else {
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

    public static function createReferralCodeCounts($referralCode)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("INSERT INTO referral_code_counts(referralCode) VALUES (:referralCode)");
            $stmt->bindParam(":referralCode", $referralCode);
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

    public static function createReferralCodeEarning($userId, $referralCode)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("INSERT INTO referral_earnings(userId,referralCode) VALUES (:userId, :referralCode)");
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":referralCode", $referralCode);
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

    public static function getCounts($referralCode)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM referral_code_counts WHERE referralCode=:referralCode");
            $stmt->bindParam(":referralCode", $referralCode);
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return array(
                    "l1Count" => (int)$row['l1Count'],
                    "l2Count" => (int)$row['l2Count'],
                    "l3Count" => (int)$row['l3Count'],
                    "l4Count" => (int)$row['l4Count'],
                    "l5Count" => (int)$row['l5Count'],
                    "l6Count" => (int)$row['l6Count']
                );
            } else {
                return [];
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public static function updateCount($referralCode, $level)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            echo $level;
            $stmt = $conn->prepare("UPDATE referral_code_counts SET {$level}={$level}+1 
                                    WHERE referralCode=:referralCode");
            $stmt->bindParam(":referralCode", $referralCode);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function updateEarning($referralCode, $levelEarning, $amount)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            // echo $levelEarning.PHP_EOL;
            $stmt = $conn->prepare("UPDATE referral_earnings SET {$levelEarning}={$levelEarning}+{$amount}
                                    WHERE referralCode='{$referralCode}'");

            if ($stmt->execute()) {
                $db->closeConnection();
                return true;
            } else {
                $db->closeConnection();
                return false;
            }
        } catch (\PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    /**
     * @param $referralCode
     * @return int
     *
     */
    public static function getTotalEarning($referralCode)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT (l1Earning + l2Earning +l3Earning + l4Earning + l5Earning + l6Earning) AS totalEarning
                                    FROM referral_earnings WHERE referralCode=:referralCode");
            $stmt->bindParam(":referralCode", $referralCode);
            if ($stmt->execute() && $stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $db->closeConnection();
                return $row['totalEarning'];
            } else {
                return 0;
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public static function getReferralCodes()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT referralCode FROM referral_earnings WHERE 1");
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

    public static function updateTotalEarning()
    {
        $codes = self::getReferralCodes();
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("UPDATE referral_earnings SET totalEarning=:totalEarning 
                                  WHERE referralCode=:referralCode");
            if (!empty($codes)) {
                foreach ($codes as $code) {
                    $total = self::getTotalEarning($code['referralCode']);
                    $stmt->bindParam(":totalEarning", $total);
                    $stmt->bindParam(":referralCode", $code['referralCode']);
                    $stmt->execute();
                }
                return true;
            } else {
                return false;
            }


        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function debitAccounts($referralCode)
    {
        $codes = self::getTree($referralCode);


        if (!empty($codes['l1']) && !is_null($codes['l1'])) {

            $count = self::getCounts($codes['l1']);

            if (isset($count['l1Count']) && $count['l1Count'] < 5) {
                //update the count with +1
                //and make l1 payment of 20% of 4000
                self::updateCount($codes['l1'], 'l1Count');
                $amount = 0.2 * 4000;
                self::updateEarning($codes['l1'], 'l1Earning', $amount);
                FundController::updateAccountEarning(self::getUserId($codes['l1']), $amount);
                FundController::updateAccountBalance(self::getUserId($codes['l1']), $amount);

            }

        }

        if (!empty($codes['l2']) && !is_null($codes['l2'])) {
            $count2 = self::getCounts($codes['l2']);

            if (isset($count2['l2Count']) && $count2['l2Count'] < 25) {
                self::updateCount($codes['l2'], 'l2Count');
                $amount = 0.15 * 4000;
                self::updateEarning($codes['l2'], 'l2Earning', $amount);
                FundController::updateAccountEarning(self::getUserId($codes['l2']), $amount);
                FundController::updateAccountBalance(self::getUserId($codes['l2']), $amount);
            }
        }
        if (!empty($codes['l3']) && !is_null($codes['l3'])) {
            $count3 = self::getCounts($codes['l3']);

            if (isset($count3['l3Count']) && $count3['l3Count'] < 125) {
                self::updateCount($codes['l3'], 'l3Count');
                $amount = 0.1 * 4000;
                self::updateEarning($codes['l3'], 'l3Earning', $amount);
                FundController::updateAccountEarning(self::getUserId($codes['l3']), $amount);
                FundController::updateAccountBalance(self::getUserId($codes['l3']), $amount);

            }

        }

        if (!empty($codes['l4']) && !is_null($codes['l4'])) {

            $count4 = self::getCounts($codes['l4']);

            if (isset($count4['l4Count']) && $count4['l4Count'] < 625) {
                self::updateCount($codes['l4'], 'l4Count');
                $amount = 0.05 * 4000;
                self::updateEarning($codes['l4'], 'l4Earning', $amount);
                FundController::updateAccountEarning(self::getUserId($codes['l4']), $amount);
                FundController::updateAccountBalance(self::getUserId($codes['l4']), $amount);

            }

        }

        if (!empty($codes['l5']) && !is_null($codes['l5'])) {

            $count5 = self::getCounts($codes['l5']);

            if (isset($count5['l5Count']) && $count5['l5Count'] < 3125) {
                self::updateCount($codes['l5'], 'l5Count');
                $amount = 0.03 * 4000;
                self::updateEarning($codes['l5'], 'l5Earning', $amount);

                FundController::updateAccountEarning(self::getUserId($codes['l5']), $amount);
                FundController::updateAccountBalance(self::getUserId($codes['l5']), $amount);
            }

        }

        if (!empty($codes['l6']) && !is_null($codes['l6'])) {
            $count6 = self::getCounts($codes['l6']);
            if (isset($count6['l6Count']) && $count6['l6Count'] < 15625) {
                self::updateCount($codes['l6'], 'l6Count');
                $amount = 0.02 * 4000;
                self::updateEarning($codes['l6'], 'l6Earning', $amount);

                FundController::updateAccountEarning(self::getUserId($codes['l6']), $amount);
                FundController::updateAccountBalance(self::getUserId($codes['l6']), $amount);

            }

        }
    }

}
