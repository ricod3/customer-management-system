<?php
global $conn;
session_start();
include "db_connection.php";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.2/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>CSM - Client Base</title>
    <style>
        body {
            background-image: url("img/bg-lighter.png");
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
</head>
<body .bg-light-subtle>
<nav class="navbar navbar-light fs-3 m-lg-3" style="background-color: white; color: #1f487e; font-weight: lighter;">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100">
            <img src="img/cms.png" alt="" width="300" height="auto" style="margin-left: 5%">
            <div style="display: flex; flex-direction: column; align-items: flex-end; font-size: smaller; margin-right: 6%;">
                <?php
                // show logged in user
                if (isset($_SESSION['username'])) {
                    echo 'Angemeldet als ' . $_SESSION['username'];
                    echo '<a href="logout.php" class="btn btn-dark mb-3">Abmelden</a>';
                } else {
                    echo 'Nicht angemeldet';
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<main id="swup" class="transition-fade">
    <div class="container">
        <div class="card mb-3 bg-dark-subtle"
             style="border: none; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
            <img src="img/Kundenstamm.png" class="card-img-top" alt="...">
            <div class="card-body">
                <?php

                if (isset($_GET['msg'])) {
                    $printMessage = $_GET['msg'];
                    echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $printMessage . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
                }
                ?>
                <a href="register_client.php" class="btn btn-dark mb-3">Kundendaten anlegen</a>

                <table data-toggle="table" data-pagination="true"
                       data-search="true">
                    <thead>
                    <tr>
                        <th data-sortable="true" data-field="company_id">ID</th>
                        <th data-sortable="true" data-field="company_name">Name</th>
                        <th data-field="contact_person">Kontaktperson</th>
                        <th data-field="phone">Tel</th>
                        <th data-field="address">Adresse</th>
                        <th data-sortable="true" data-field="created_by">Angelegt von</th>
                        <th data-sortable="true" data-field="created_at">Zeit der Datenerfassung</th>
                        <th data-sortable="true" data-field="edited_at">Zeit der Datenänderung</th>
                        <th data-field="action">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include "db_connection.php";
                    $sqlStatement = $conn->prepare(
                        "SELECT clients.*, users.name
                            FROM clients
                            JOIN users ON clients.created_by = users.user_id");
                    // execution of select statement
                    $sqlStatement->execute();

                    // fetch all result in an array with the key being the name of the columns
                    $result = $sqlStatement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        ?>
                        <tr>
                            <!-- return value of $row - htmlspecialchars for securing against cross-site-scripting -->
                            <td> <?php echo htmlspecialchars($row['company_id'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td> <?php echo htmlspecialchars($row['company_name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td> <?php echo htmlspecialchars($row['contact_person'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td> <?php echo htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td> <?php echo htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td> <?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td> <?php echo htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td> <?php echo htmlspecialchars($row['edited_at'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <?php
                                // if user_id of logged in user equals user_id of created_by row then show editing tools
                                if ($_SESSION['user_id'] == $row['created_by']) {
                                    ?>
                                    <a href="edit_client.php?id=<?php echo $row['company_id'] ?>" class="link-dark"><i
                                                class="fa-solid fa-pen-to-square fs-5"></i></a>
                                    <a href="delete_client.php?id=<?php echo $row['company_id'] ?>" class="link-dark"><i
                                                class="fa-solid fa-trash fs-5"></i></a>
                                    <?php
                                }
                                ?>
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
</main>

<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.2/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/swup@4"></script>
<script type="module">
    import Swup from 'https://unpkg.com/swup@4?module';
    const swup = new Swup();
</script>

</body>
</html>
