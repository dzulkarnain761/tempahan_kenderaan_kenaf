<?php

include 'controller/connection.php';
include 'controller/session.php';

$pemandu_id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="custom-container">
        <?php
        include 'partials/navigation.php';
        ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <?php include 'partials/name_display.php'; ?>
            </div>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>SENARAI TUGASAN</h2>
                </div>

                <table id="tempahanTable">
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Nama Penyewa</td>
                            <td>Tarikh Cadangan</td>
                            <td>Jenis Kerja</td>
                            <td>Tindakan</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlTempahan = "SELECT t.lokasi_kerja, t.luas_tanah, p.nama, tk.*
                                        FROM tempahan t
                                        LEFT JOIN penyewa p ON p.id = t.penyewa_id
                                        LEFT JOIN tempahan_kerja tk ON tk.tempahan_id = t.tempahan_id
                                        WHERE tk.status_kerja = 'dijalankan' AND tk.pemandu_id = $pemandu_id";

                        $result = mysqli_query($conn, $sqlTempahan);
                        $bil = 1;

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                                <tr>
                                    <td><?php echo $bil++; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['tarikh_kerja_cadangan']; ?></td>
                                    <td><?php echo $row['nama_kerja']; ?></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location.href='jobsheet.php?id=<?php echo $row['tempahan_kerja_id']; ?>'">Kemaskini</button>
                                    </td>
                                </tr>
                            <?php
                            endwhile;
                        } else {
                            ?>
                            <tr>
                                <td colspan="5" class="text-center">Tiada Tugasan</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>




            </div>
        </div>

        <!-- =========== Scripts =========  -->
        <script src="../assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
        <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
        <!-- <script src="assets/js/main.js"></script> -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    </div>
</body>

</html>