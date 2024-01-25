<?php
session_start();
include "db_connection.php";

// if user is not logged in redirect to login.php
if (!isset($_SESSION["loggedin"])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $company_name = $_POST['company_name'];
    $contact_person = $_POST['contact_person'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sqlStatement = $conn->prepare("INSERT INTO `clients`(`company_id`, `company_name`, `contact_person`, `phone`, `address`, `created_by`) VALUES (NULL, :company_name, :contact_person, :phone, :address, :created_by)");
    $sqlStatement->bindParam(':company_name', $company_name);
    $sqlStatement->bindParam(':contact_person', $contact_person);
    $sqlStatement->bindParam(':phone', $phone);
    $sqlStatement->bindParam(':address', $address);
    $sqlStatement->bindParam(':created_by', $_SESSION['user_id']);


    if ($sqlStatement->execute()) {
        // set session variable
        header("Location: index_clients.php?msg=Neuer Kunde wurde erfolgreich angelegt!");
    } else {
        echo "Failed: " . implode(", ", $sqlStatement->errorInfo());
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
    <title>CSM - Kunden registrieren</title>
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
                        <img src="img/skyscrapers4.jpg"
                             alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;"/>
                    </div>
                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">

                            <form action="" method="post">

                                <div class="d-flex align-items-center mb-3 pb-1">
                                    <img src="img/cms.png" class="img-fluid" alt="...">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kundenname: </label>
                                    <input type="text" class="form-control" name="company_name"
                                           placeholder="Musterfirma GmbH">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kontaktperson: </label>
                                    <input type="text" class="form-control" name="contact_person"
                                           placeholder="Max Mustermann">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Telefon: </label>
                                    <input type="number" class="form-control" name="phone" placeholder="0732 00 00">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Adresse: </label>
                                    <input type="text" class="form-control" name="address"
                                           placeholder="Musterstraße 1, Musterstadt">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-dark" name="submit">Kundendaten erfassen
                                    </button>
                                    <a href="index_clients.php" class="btn btn-danger">Abbruch</a>
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
<script src="https://unpkg.com/swup@4"></script>
<script>
    const swup = new Swup();
</script>

</body>
</html>