<?php
global $conn;
session_start();
include "db_connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM `users` WHERE user_id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: index_user.php?msg=User erfolgreich geloescht!");
    } else {
        echo "Failed: " . implode(", ", $stmt->errorInfo());
    }
} else {
    echo "Keine ID angegeben!";
}
?>