<?php

$config = require __DIR__ . '/../config.php';

$servername = $config['host'];
$username = $config['username'];
$password = $config['password'];
$database = $config['database'];

$conn = new PDO("mysql:host=$servername", $username, $password);

try {
    $sql = "CREATE DATABASE $database";
    $conn->exec($sql);
    echo "Database created successfully" . PHP_EOL;
    $conn->query("use $database");

    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        full_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255),
        reg_date TIMESTAMP
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table \"users\" created successfully" . PHP_EOL;

    $sql = "CREATE TABLE posts (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        post_title VARCHAR(255) NOT NULL,
        post_text LONGTEXT NOT NULL,
        poster_name VARCHAR(255),
        post_date TIMESTAMP,
        post_image BLOB
    )";

    $conn->exec($sql);
    echo "post database was created" . PHP_EOL;

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}