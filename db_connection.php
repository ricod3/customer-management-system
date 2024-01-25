<?php

$servername = "mysql-3caa43ed-rico-88c5.a.aivencloud.com:22995";
$username = "avnadmin";
$password = "AVNS_EwJ2Wr9Qt13jJTX0x_9";
$dbname = "cms-cloud-mysql-db";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //echo "Connected successfully";
} catch (PDOException $exc) {
    echo "Connection failed: " . $exc->getMessage();
}

?>