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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">


    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .custom-container {
            position: relative;
            width: 100%;
        }

        ul {
            all: unset;
            list-style: disc;
            /* padding-left: 20px; */
            margin: 0;
        }

        nav .breadcrumb {
            margin-left: 24px;
        }

        .cardHeader h3 {
            font-weight: 600;
            color: var(--blue);
            text-transform: uppercase;
            margin-bottom: 25px;
        }


        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        h2,
        h3 {
            margin-bottom: 15px;
        }

        .cardHeader {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* ================== Table details ============== */
        .recentOrders {
            position: relative;
            display: grid;
            min-height: 500px;
            background: var(--white);
            padding: 20px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }

        .cardHeader {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .cardHeader h2 {
            color: var(--blue);
            text-transform: uppercase;
        }

        .cardHeader .btn {
            position: relative;
            padding: 5px 10px;
            background: var(--blue);
            text-decoration: none;
            color: var(--white);
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table thead td {
            background: var(--blue);
            color: var(--white);
            font-size: 18px;
        }

        table tbody {
            font-size: 18px;
        }

        .recentOrders table tr {
            color: var(--black1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .recentOrders table tr:last-child {
            border-bottom: none;
        }

        .recentOrders table tbody tr:hover {
            background: var(--white);
            color: var(--black);
        }

        .recentOrders table tr td {
            padding: 10px;
        }

        .recentOrders table tr td:last-child {
            text-align: center;
        }

        .recentOrders table tr td:nth-child(2) {
            text-align: center;
        }

        .recentOrders table tr td:nth-child(3) {
            text-align: center;
        }

        .btn-outline-edit {
            border: 2px solid #007bff;
            /* Choose the color you prefer */
            color: #007bff;
            background-color: transparent;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-outline-edit:hover {
            background-color: #007bff;
            color: white;
        }

        .btn-outline-delete {
            border: 2px solid #dc3545;
            /* Choose the color you prefer */
            color: #dc3545;
            background-color: transparent;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-outline-delete:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>

</head>

<body>
    <div class="custom-container">
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

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="tetapan.php">Tetapan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kategori Kenderaan</li>
                </ol>
            </nav>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h3>Kategori Kenderaan</h3>
                    <a class="btn" onclick="window.location.href = 'tambah_kategori_kenderaan.php'">TAMBAH KATEGORI</a>
                </div>


                <table>
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Kategori</td>
                            <td>Tindakan</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // SQL query to select all staff excluding specific groups
                        $sqlLesen = "SELECT * FROM `kategori_kenderaan`";

                        $resultLesen = mysqli_query($conn, $sqlLesen);
                        $count = 1;

                        // Loop through the result set
                        while ($row = mysqli_fetch_assoc($resultLesen)) {
                        ?>
                            <tr data-id="<?php echo $row['id']; ?>">
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['kategori']; ?></td>
                                <td>
                                    <button onclick="window.location.href = 'kemaskini_lesen.php?id=<?php echo $row['id']; ?>'" class="btn btn-outline-edit">
                                        <i class="fas fa-edit" style="font-size: 1.5em;"></i>
                                    </button>
                                    <button onclick="deleteItem(this)" class="btn btn-outline-delete"> <!-- Pass this to the function -->
                                        <i class="fas fa-trash-alt" style="font-size: 1.5em;"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</body>

</html>