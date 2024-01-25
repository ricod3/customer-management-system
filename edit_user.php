<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-eqiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>CSM Solutions</title>
</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #0a53be; color: white">
    CSM-Solutions
</nav>

<div class="container">
    <div class="text-center mb-4">
        <h3>Edit User Information</h3>
        <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    include "db_connection.php";

    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE user_id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container d-flex justify-content-center">
        <?php
        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $conn->prepare("UPDATE `users` SET `name` = :name, `email` = :email, `password` = :password ,  WHERE `user_id` = :id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                header("Location: index_user.php?msg=User erfolgreich aktualisiert!");
            } else {
                echo "Failed: " . implode(", ", $stmt->errorInfo());
            }
        }
        ?>

        <form action="" method="post" style="max-width: 500px; min-width: 300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Name: </label>
                    <input type="text" class="form-control" name="name" value="<?php echo $row['name']?>">
                </div>
                <p></p>
                <div class="mb-3">
                    <label class="form-label">E-Mail: </label>
                    <input type="text" class="form-control" name="email" value="<?php echo $row['email']?>">
                </div>
                <div class="col">
                    <label class="form-label">Password: </label>
                    <input type="password" class="form-control" name="password" value="<?php echo $row['password']?>">
                </div>
                <p></p>

                <div>
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    <a href="index_user.php" class="btn btn-danger">Abbruch</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>