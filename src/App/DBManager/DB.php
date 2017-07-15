<?php

/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/1/17
 * Time: 11:46 PM
 */
namespace App\DBManager;
class DB
{
    /**
     * @var string
     */
    private $databaseName = 'asiliele_db';
    /**
     * @var string
     */
    private $password = 'asili123..';
    /**
     * @var string
     */
    private $databaseHost = 'localhost';
    /**
     * @var string
     */
    private $databaseUser = 'asiliele_admin';
    /**
     * @var
     */
    private $conn;

    /**
     * @return null|\PDO
     */
    public function connect(){
        try{

            $this->conn = new \PDO(
                "mysql:host={$this->databaseHost};
                 dbname={$this->databaseName}",
                $this->databaseUser,
                $this->password
            );

            return $this->conn;

        } catch (\PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * @return bool
     */
    public function closeConnection(){
        $this->conn = null;
        return true;
    }
}

