<?php

    $host = 'localhost';
    $db = 'dcare_db';
    $user = 'admin';
    $pass = 'admin';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host:3306;dbname=$db;charset=$charset";
    $pdo = null;

    try {
        
        $pdo = new PDO($dsn, $user, $pass);

    } catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }

?>