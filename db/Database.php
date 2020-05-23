<?php

namespace app\db;

class Database
{
    /**
     * @var \PDO
     */
    public $pdo;
    public function __construct()
    {
        $config = require __DIR__ . '/../config.php';

        $servername = $config['host'];
        $username = $config['username'];
        $password = $config['password'];
        $database = $config['database'];

        $this->pdo = new \PDO("mysql:host=$servername;dbname=$database", $username, $password);
    }

    public function login($email, $password, &$user)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->bindValue(':email', $email);
        $statement->execute();
        $user = $statement->fetch(\PDO::FETCH_ASSOC);
        if (!$user){
            return [false, 'User does not exist'];
        }
        if (!password_verify($password, $user['password'])){
            return [false, 'Password is incorrect'];
        }
        return [true, false, $user];
    }

    public function register($full_name,$email,$password,$reg_date){

        $statement = $this->pdo->prepare("insert into users (full_name,email,password,reg_date) 
                                                    Values (:full_name, :email, :password, :date)");
        $statement->bindParam(':full_name',$full_name);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':password',$password);
        $statement->bindParam(':date',$reg_date);
        return $statement->execute();
    }

    public function post($post_title,$post_text,$poster_name,$post_date,$post_image){

        $statement = $this->pdo->prepare("insert into posts (post_title,post_text,poster_name,post_date,post_image) 
                                                    Values (:post_title,:post_text,:poster_name,:post_date,:post_image)");
        $statement->bindParam(':post_title',$post_title);
        $statement->bindParam(':post_text',$post_text);
        $statement->bindParam(':poster_name',$poster_name);
        $statement->bindParam(':post_date',$post_date);
        $statement->bindParam(':post_image',$post_image);
        return $statement->execute();
    }
}