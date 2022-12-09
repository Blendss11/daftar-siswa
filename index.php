<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Daftar Siswa</title>
</head>

<body>
    <div class="container my-5">
        <h2>Data Siswa</h2>
        <a href="/daftar-siswa/create.php" class="btn btn-primary" role="button">Masukan data</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username   = "root";
                $password   = "";
                $database   = "siswa";



                $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error) {
                    die("koneksi error: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM clients";
                $result = $connection->query($sql);

                if (!$result) {
                    die("invalid query: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[addres]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a href='/daftar-siswa/edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>
                        <a href='/daftar-siswa/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>
                    ";
                }
                ?>


            </tbody>
        </table>

    </div>
</body>

</html>