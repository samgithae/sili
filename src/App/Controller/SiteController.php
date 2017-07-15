<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 10:05 PM
 */

namespace App\Controller;


use App\AppInterface\SiteInterface;
use App\DBManager\DB;
use App\Entity\Site;

class SiteController implements SiteInterface
{
    public function createSingle(Site $site)
    {
        $name = $site->getUrlName();
        $url = $site->getUrl();
        $category = $site->getCategory();
        $description = $site->getDescription();

        try{
            $db = new DB();
            $conn = $db->connect();

            $stmt = $conn->prepare("INSERT INTO sites(urlName, url, category, description) VALUES (:urlName, :url, :category, :description)");
            $stmt->bindParam(":urlName", $name);
            $stmt->bindParam(":url", $url);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":description", $description);
            $query = $stmt->execute();
            if ($query) {
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

    public function createMultiple(array $sites)
    {
        try{
            $db = new DB();
            $conn = $db->connect();

            $stmt = $conn->prepare("INSERT INTO sites(urlName, url, category, description) VALUES (:urlName, :url, :category, :description)");

            foreach ($sites as $site) {
                $stmt->bindParam(":urlName", $site['urlName']);
                $stmt->bindParam(":url", $site['url']);
                $stmt->bindParam(":category", $site['category']);
                $stmt->bindParam(":description", $site['description']);
                $stmt->execute();
            }
            $db->closeConnection();
            return true;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateSingle(Site $site, $id)
    {
        $urlName = $site->getUrlName();
        $url = $site->getUrl();
        $category = $site->getCategory();
        $description = $site->getDescription();

        try{
            $db = new DB();
            $conn = $db->connect();

            $stmt = $conn->prepare("UPDATE sites SET urlName=:urlName, url=:url, category=:category, description=:description WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":urlName", $urlName);
            $stmt->bindParam(":url", $url);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":description", $description);
            $query = $stmt->execute();
            if ($query) {
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

    public function updateMultiple(array $sites)
    {
        try{
            $db = new DB();
            $conn = $db->connect();

            $stmt = $conn->prepare("UPDATE sites SET urlName=:urlName, url=:url, category=:category, description=:description WHERE id=:id");

            foreach ($sites as $site) {
                $stmt->bindParam(":id", $site['id']);
                $stmt->bindParam(":urlName", $site['urlName']);
                $stmt->bindParam(":url", $site['url']);
                $stmt->bindParam(":category", $site['category']);
                $stmt->bindParam(":description", $site['description']);
                $stmt->execute();
            }
            $db->closeConnection();
            return true;

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
            $stmt = $conn->prepare("DELETE FROM sites WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $query = $stmt->execute();
             if ($query) {
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
        try {
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("DELETE FROM sites WHERE 1");
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
        try{
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare("SELECT t.* FROM sites t WHERE t.id=:id");
            $stmt->bindParam(":id", $id);
            if($stmt->execute() and $stmt->rowCount()==1){
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
            $stmt = $conn->prepare("SELECT t.* FROM sites t WHERE t.id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Site::class);
            if($stmt->execute() and $stmt->rowCount()==1){
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $db->closeConnection();
                return $row;
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
            $stmt = $conn->prepare("SELECT t.* FROM sites t WHERE 1");
            if($stmt->execute() && $stmt->rowCount() > 0){
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

}