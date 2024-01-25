<?php
include "db_connection.php";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sqlStatement = $conn->prepare("SELECT * FROM `users` WHERE email = :email");

    // execute select statement and bind the value of $email into 'email' key of $result array
    $result = $sqlStatement->execute(array('email' => $email));
    $user = $sqlStatement->fetch();

    // verify if userr has been found and if pw matches the pw in database
    // if so, set session variable to true
    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['loggedin'] = true;
        header("Location: index_clients.php");
    } else {
        echo '<br><div class="alert alert-danger alert-dismissible" role="alert">
                Ihre Zugangsdaten scheinen nicht korrekt zu sein. Bitte überprüfen Sie Ihre Eingabe.
                </div>
                ';
    }
}
