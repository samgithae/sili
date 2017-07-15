<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/6/17
 * Time: 12:25 AM
 */

namespace App\Auth;


use App\DBManager\DB;

/**
 * Class Auth
 * @package Hudutech\Auth
 */
class Auth
{
    use PasswordValidator;
    /**
     * @var string
     */
    private $csrf_token;

    /**
     * @param $username
     * @param $password
     * @return mixed
     */
    public static function authenticate($username, $password)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username OR email=:email LIMIT 1");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $username);

            $stmt->execute();

            if ($stmt->rowCount() == 1) {

                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                if(password_verify($password, $row['password'])){
                    return $row;
                } else{
                    return [];
                }

            } else {
                return [];
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    /**
     * @return string
     * generates crsf token to be using when performing form submission via
     * the web this reduces the cross forgery request  attacks
     */
    public function generateToken(){
        return $this->csrf_token = sha1(md5(uniqid("auth_token", true)));
    }

    public static function checkEmail($email){
        $db = new DB();
        $conn = $db->connect();
        try{
            $stmt = $conn->prepare("SELECT email FROM users WHERE email=:email");
            $stmt->bindParam(":email", $email);
            return $stmt->execute() && $stmt->rowCount() == 1 ? true: false;
        } catch (\PDOException $e){
            return [
                "error"=>$e->getMessage()
            ];
        }
    }

    public static function makePassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function resetPassword($email, $newPassword)
    {
        $db = new DB();
        $conn = $db->connect();
        $password = self::makePassword($newPassword);

        try {
            $stmt = $conn->prepare("UPDATE `users` SET `password`=:password WHERE `email`=:email");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            return $stmt->execute() ? true : false;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }
}