<?php
session_start();

if (isset($_POST['logout'])) {
    unset($_SESSION['user_id']);
    session_destroy();
    header("Location: register_user.php");
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-eqiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.2/dist/bootstrap-table.min.css">
    <title>CSM - Active Users</title>
</head>
<body .bg-light-subtle>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: white; color: white">
    <img src="img/cms.png" alt="" width="300" height="auto">
</nav>

<div class="container">
    <div class="card mb-3 bg-dark-subtle"
         style="border: none; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
        <img src="img/vorhandeneUser.png" class="card-img-top" alt="...">
        <div class="card-body">
            <?php

            // show logged in user
            if (isset($_SESSION['username'])) {
                echo 'Angemeldet als ' . $_SESSION['username'];
            } else {
                echo 'Nicht angemeldet';
            }

            if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $msg . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
            }
            ?>
            <a href="register_user.php" class="btn btn-dark mb-3">User anlegen</a>

            <table data-toggle="table"  data-pagination="true"
                   data-search="true">
                <thead>
                <tr>
                    <th data-sortable="true" data-field="id">ID</th>
                    <th data-sortable="true" data-field="name">Name</th>
                    <th data-field="email">Email</th>
                    <th data-field="action">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include "db_connection.php";
                $stmt = $conn->prepare("SELECT * FROM `users`");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    ?>
                    <tr>
                        <td> <?php echo htmlspecialchars($row['user_id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td> <?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td> <?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['user_id'] ?>" class="link-dark"><i
                                        class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="delete_user.php?id=<?php echo $row['user_id'] ?>" class="link-dark"><i
                                        class="fa-solid fa-trash fs-5 me-3"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <p></p>

</div>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.2/dist/bootstrap-table.min.js"></script>
</body>
</html>
