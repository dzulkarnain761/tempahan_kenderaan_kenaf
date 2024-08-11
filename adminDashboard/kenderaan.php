<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
}

$sqlnegeri = "SELECT * FROM negeri";
$resultnegeri = mysqli_query($conn, $sqlnegeri);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .cardHeader .btn {
            position: relative;
            padding: 12px 12px;
            background: var(--blue);
            text-decoration: none;
            color: var(--white);
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        include 'partials/navigation.php';
        ?>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="userName">
                    <div class="user-name">NAMA BINTI PENUH</div>
                    <div class="user">
                        <img src="assets/images/user.png" alt="User Image">
                    </div>
                </div>
            </div>

            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>SENARAI KENDERAAN</h2>
                        <a class="btn" onclick="window.location.href= 'daftar_kenderaan.php'">DAFTAR KENDERAAN</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Bil</td>
                                <td>Nama Kenderaan</td>
                                <td>No Pendaftaran</td>
                                <td>Tarikh Tamat</td>
                                <td>Kemaskini</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button onclick="window.location.href='kemaskini_kenderaan.php'" class="btn btn-edit">
                                        <i class="fas fa-edit" style="font-size: 1.5em;"></i>
                                    </button>
                                    <button onclick="deleteItem(this)" class="btn btn-delete">
                                        <i class="fas fa-trash-alt" style="font-size: 1.5em;"></i>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>

    </script>
</body>

</html>