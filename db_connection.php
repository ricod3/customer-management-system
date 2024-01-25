<?php

$servername = "mysql-";
$username = "";
$password = "";
$dbname = "";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //echo "Connected successfully";
} catch (PDOException $exc) {
    echo "Connection failed: " . $exc->getMessage();
}

?>
