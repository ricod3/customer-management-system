<?php
session_start();
include "db_connection.php";

// check if register has been "posted"
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // prepared select statement - bind values of $variables into :values
    $sqlStatement = $conn->prepare("INSERT INTO `users`(`user_id`, `name`, `email`, `password`) VALUES (NULL, :name, :email, :password)");
    $sqlStatement->bindParam(':name', $name);
    $sqlStatement->bindParam(':email', $email);
    $sqlStatement->bindParam(':password', $password);

    if ($sqlStatement->execute()) {
        // set session variable
        $_SESSION['message'] = 'Der User ' . $name . ' wurde erfolgreich angelegt. Sie können sich nun anmelden.';
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-eqiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>CSM - User registrieren</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: rgb(1, 42, 74);
            background: linear-gradient(0deg, rgb(1, 32, 56) 16%, rgb(30, 77, 105) 89%);
        }
    </style>
</head>
<body>

<div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem; border: none">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="img/pexels-cottonbro-studio-4065617.jpg"
                             alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;"/>
                    </div>
                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">

                            <form action="" method="post">

                                <div class="d-flex align-items-center mb-3 pb-1">
                                    <img src="img/cms.png" class="img-fluid" alt="...">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Name: </label>
                                    <input type="text" class="form-control" name="name" placeholder="Max Mustermann">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">E-Mail: </label>
                                    <input type="text" class="form-control" name="email"
                                           placeholder="max@mustermann.at">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Passwort: </label>
                                    <input type="password" class="form-control" name="password" placeholder="***">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-dark" name="submit">Registrieren</button>
                                    <a href="login.php" class="btn btn-danger">Abbruch</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>