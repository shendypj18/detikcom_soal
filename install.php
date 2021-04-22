<?php
 $host = "localhost";
 $db_name = "detikcom_soal";
 $username = "root";
 $password = "";

try{
    $db = new PDO('mysql:host=localhost', $username, $password);
    $db->exec("DROP DATABASE IF EXISTS `$db_name`") or die (print_r($db->errorInfo(),true));
    $db->exec("CREATE DATABASE IF NOT EXISTS `$db_name`") or die (print_r($db->errorInfo(),true));
} catch(PDOException $e) {
    echo "Database error: " . $exception->getMessage();
}

?>