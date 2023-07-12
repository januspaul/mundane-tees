<?php
$host = 'localhost';
$dbname = 'catalogue';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Connected to database';
} catch (PDOException $e){
    die('Database connection failed'. $e->getMessage());
    exit;
}