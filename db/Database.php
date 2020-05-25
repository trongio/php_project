<?php

namespace app\db;
use \PDO;


class Database
{
    /**
     * @var \PDO
     */
    public PDO $pdo;
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

    public function get_max_id(){
        $statement = $this->pdo->prepare("SELECT MAX(id) FROM posts");
        $statement->execute();
        $maxid= $statement->fetchAll(PDO::FETCH_ASSOC);
        return intval($maxid[0]['MAX(id)'])+1;
    }

    public function get_posts(){
        $statement = $this->pdo->prepare("SELECT * FROM posts");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_users(){
        $statement = $this->pdo->prepare("SELECT full_name,email,reg_date FROM users");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_email($email){
        $statement = $this->pdo->prepare("SELECT * FROM users where email = :email");
        $statement->bindValue(':email',$email);
        $statement->execute();
        $user =  $statement->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($user)){
            return true;
        }else return false;
    }

    public function get_full_name($full_name){
        $statement = $this->pdo->prepare("SELECT * FROM users where full_name = :full_name");
        $statement->bindValue(':full_name',$full_name);
        $statement->execute();
        $user =  $statement->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($user)){
            return true;
        }else return false;
    }

    public function search($search_text){
        $statement = $this->pdo->prepare("SELECT * FROM posts where post_title like :search_text or post_text like :search_text or poster_name like :search_text");
        $statement->bindValue(':search_text',"%".$search_text."%");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}