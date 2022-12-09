<?php

$id = "";
$name = "";
$email = "";
$address = "";
$phone = "";

$errorMessagen = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /daftar-siswa/index.php");
        exit;
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /daftar-siswa/index.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
} else {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {

            $errorMessage = "ALL the field are required";
            break;
        }

        $sql = "UPDATE clients " .
            "SET name = '$name', email = '$email', phone = '$phone', address = '$address' " .
            "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Clients update correctly";

        header("location: /daftar-siswa/index.php");
        exit;
    } while (true);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Siswa</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Data Siswa</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button class='btn-close' data-bs-dismis='alert' aria-label='close' type='button'></button>
            </div>
                ";
        }

        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $name; ?>">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value=" <?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismis='alert' aria-label='close'></button>

                    </div>
                </div>
            </div>
                ";
            }

            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="/daftar-siswa/index.php" role="button" class="btn btn-outline-primary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>