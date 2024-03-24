<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'url_shortener';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    $msg = date("Y-m-d H:i:s") . " " . $e->getMessage();
    file_put_contents("log.txt", $msg . PHP_EOL, FILE_APPEND);
    header("Location:404.php");
    exit();
}