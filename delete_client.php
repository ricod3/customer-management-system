<?php
global $conn;
session_start();
include "db_connection.php";

// if id is set as GET-parameter of url then delete from index where company_id equals id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlStatement = $conn->prepare("DELETE FROM `clients` WHERE company_id = :id");
    $sqlStatement->bindParam(':id', $id);

    if ($sqlStatement->execute()) {
        header("Location: index_clients.php?msg=Kundendaten erfolgreich geloescht!");
    } else {
        echo "Failed: " . implode(", ", $sqlStatement->errorInfo());
    }
} else {
    echo "Keine ID angegeben!";
}
?>