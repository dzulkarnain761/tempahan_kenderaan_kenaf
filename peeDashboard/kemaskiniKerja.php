<?php

include 'controller/connection.php';
include 'controller/session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
    </style>

</head>

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

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="tempahan.php">Tempahan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Maklumat Tempahan</li>
            </ol>
        </nav>
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>MAKLUMAT TEMPAHAN</h2>
            </div>

            <?php
            $tempahan_id = $_GET['tempahan_id'];

            // Ensure you escape the ID to prevent SQL injection
            $tempahan_id = mysqli_real_escape_string($conn, $tempahan_id);

            $sqlTempahan = "SELECT t.*, p.nama 
                FROM tempahan t
                INNER JOIN penyewa p ON p.id = t.penyewa_id WHERE t.tempahan_id = $tempahan_id";
            $resultTempahan = mysqli_query($conn, $sqlTempahan);

            // Fetch the Pemandu member's data
            if ($resultTempahan && mysqli_num_rows($resultTempahan) > 0) {
                $tempahan = mysqli_fetch_assoc($resultTempahan);
            } else {
                // Handle the case where no Pemandu member is found
                echo "Tiada Tempahan Dijumpai";
                exit;
            }

            ?>


            <input type="hidden" name="tempahan_id" value="<?php echo htmlspecialchars($tempahan['tempahan_id']) ?>">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tarikh Permohonan:</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" value="<?php echo date('Y-m-d', strtotime($tempahan['created_at'])) ?>" disabled>

            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Pemohon:</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['nama']) ?>"
                    disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tarikh Cadangan:</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['tarikh_kerja']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Keluasan Tanah(Hektar):</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['luas_tanah']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Lokasi Kerja:</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['lokasi_kerja']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Catatan:</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['catatan']) ?>" disabled>
            </div>


        </div>

        <div class="recentOrders">
            <div class="cardHeader">
                <h2>PENGESAHAN TEMPAHAN</h2>
            </div>

            <form id="terimaTempahan" method="POST">
                <input type="hidden" name="tempahan_id" value="<?php echo htmlspecialchars($tempahan['tempahan_id']) ?>">


                <div class="mb-3">
                    <?php
                    $tempahanId = $tempahan_id;
                    $sqlKerja = "SELECT * FROM `tempahan_kerja` WHERE tempahan_id = $tempahanId AND status_kerja = 'tempahan diproses'";
                    $resultKerja = mysqli_query($conn, $sqlKerja);

                    if ($resultKerja && mysqli_num_rows($resultKerja) > 0):

                        while ($rowKerja = mysqli_fetch_assoc($resultKerja)):


                            // Ensure the variable is properly concatenated with the query string
                            $sqlTotalJobsheet = "SELECT COUNT(*) FROM jobsheet WHERE tempahan_kerja_id = " . $rowKerja['tempahan_kerja_id'];
                            $resultTotalJobsheet = mysqli_query($conn, $sqlTotalJobsheet);
                            $totalJobsheet = mysqli_fetch_array($resultTotalJobsheet)[0]; // Get the total count

                            // Run the second query for jobsheet status
                            $sqlJobsheetStatus = "SELECT COUNT(*) FROM jobsheet WHERE status_jobsheet = 'dalam pengesahan' AND tempahan_kerja_id = " . $rowKerja['tempahan_kerja_id'];
                            $resultJobsheetStatus = mysqli_query($conn, $sqlJobsheetStatus);
                            $totalJobsheetStatus = mysqli_fetch_array($resultJobsheetStatus)[0]; // Get the total count for status

                            // Determine the button class based on conditions
                            if ($totalJobsheetStatus > 0 || $totalJobsheet == 0) {
                                $button = 'btn-outline-warning';
                            } else {
                                $button = 'btn-outline-primary';
                            }
                            $tempahan_id = htmlspecialchars($rowKerja['tempahan_id']);
                            $nama_kerja = htmlspecialchars($rowKerja['nama_kerja']);
                            $rateharga = 0; // Default rate

                            // Fetch the rate per hour from the database based on the work name
                            $sqltugasan = "SELECT * FROM `tugasan` WHERE kerja = '$nama_kerja'";
                            $resulttugasan = mysqli_query($conn, $sqltugasan);

                            if ($resulttugasan && mysqli_num_rows($resulttugasan) > 0) {
                                $fetchTugasan = mysqli_fetch_assoc($resulttugasan);
                                $rateharga = $fetchTugasan['harga_per_jam'];
                            }
                    ?>
                            <div class="mb-5" id="row-<?php echo $rowKerja['tempahan_kerja_id']; ?>">


                                <input type="hidden" name="tempahan_kerja_id[]" value="<?php echo htmlspecialchars($rowKerja['tempahan_kerja_id']); ?>">

                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">Nama Kerja</span>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rowKerja['nama_kerja']); ?>" disabled>
                                    <button class="btn btn-outline-secondary" type="button" disabled>Bilangan Pemandu : <?php echo $totalJobsheet;  ?></button>
                                    <button class="btn <?php echo $button ?>" type="button" onclick="window.location.href='kemaskiniJobsheet.php?tempahan_id=<?php echo $tempahan_id ?>&tempahan_kerja_id=<?php echo htmlspecialchars($rowKerja['tempahan_kerja_id']); ?>'">Kemaskini</button>
                                    
                                </div>

                            </div>
                        <?php

                        endwhile;
                    else: ?>
                        <input type="text" class="form-control mb-2" id="jenis_kerja_input" value="No kerja found" disabled>
                    <?php endif; ?>
                </div>

            </form>
        </div>

    </div>
</div>

<script src="../assets/js/main.js"></script>
<script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
<script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
    var changeEditModal = document.getElementById('changeEditModal');
    $(document).ready(function() {


        $('#terimaTempahan').on('submit', function(e) {
            e.preventDefault();

            // Serialize form data and make AJAX request
            $.ajax({
                url: 'controller/terimaTempahan.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then(() => {
                            window.location.href = 'tempahan.php';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                }
            });
        });

    });
</script>


</body>

</html>