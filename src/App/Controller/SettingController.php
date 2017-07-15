<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/24/17
 * Time: 3:47 PM
 */

namespace App\Controller;


use App\AppInterface\SettingInterface;
use App\DBManager\DB;
use App\Entity\Setting;

class SettingController implements SettingInterface
{
    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("DELETE FROM settings WHERE id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function destroy()
    {
        // TODO: Implement destroy() method.
    }

    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM settings WHERE id=:id");
            $stmt->bindParam(":id", $id);
            return $stmt->execute() ? $stmt->fetch(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public static function getObject($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM settings WHERE id=:id");
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Setting::class);
            return $stmt->execute() ? $stmt->fetch() : null;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM settings LIMIT 1");
            return $stmt->execute() ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public function create(Setting $setting)
    {
        $payoutDay = $setting->getPayoutDay();
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("INSERT INTO settings(payoutDay) VALUES (:payoutDay)");
            $stmt->bindParam(":payoutDay", $payoutDay);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update(Setting $setting, $id)
    {
        $payoutDay = $setting->getPayoutDay();
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("UPDATE settings SET payoutDay=:payoutDay WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":payoutDay", $payoutDay);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getPayoutDate()
    {
        //TODO: implement getPayoutDate() method
    }

}