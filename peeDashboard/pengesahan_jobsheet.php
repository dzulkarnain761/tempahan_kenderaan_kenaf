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
                <li class="breadcrumb-item"><a href="jobsheet.php">Jobsheet</a></li>
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

            <form id="selesaiKerja" method="POST">
                <input type="hidden" name="tempahan_id" value="<?php echo htmlspecialchars($tempahan['tempahan_id']) ?>">


                <div class="mb-3">
                    <?php
                    $tempahanId = $tempahan_id;
                    $sqlKerja = "SELECT * FROM `tempahan_kerja` WHERE tempahan_id = $tempahanId";
                    $resultKerja = mysqli_query($conn, $sqlKerja);

                    if ($resultKerja && mysqli_num_rows($resultKerja) > 0):

                        while ($rowKerja = mysqli_fetch_assoc($resultKerja)):



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



                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">Nama Kerja</span>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rowKerja['nama_kerja']); ?>" disabled>
                                </div>

                                <div class="input-group mb-2">
                                    <span class="input-group-text">Tarikh Kerja</span>
                                    <input type="date" class="form-control input_date" name="input_date[]" value="<?php echo htmlspecialchars($rowKerja['tarikh_kerja_cadangan']); ?>" disabled>
                                </div>

                                <label for="exampleFormControlInput1" class="form-label">Masa & Harga Pengesahan :</label>
                                <div class="input-group mb-2">
                                    <input type="hidden" class="form-control rate_per_hour" value="<?php echo $rateharga; ?>">
                                    <span class="input-group-text">Jam</span>
                                    <input type="number" class="form-control input_hours" name="input_hours[]" value="<?php echo htmlspecialchars($rowKerja['jam_anggaran']); ?>" min="0" max="6" disabled>
                                    <span class="input-group-text">Minit</span>
                                    <input type="number" class="form-control input_minutes" name="input_minutes[]" value="<?php echo htmlspecialchars($rowKerja['minit_anggaran']); ?>" min="0" max="55" step="5" disabled>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Harga (RM)</span>
                                    <input type="text" class="form-control output_price" name="input_price[]" value="<?php echo htmlspecialchars($rowKerja['harga_anggaran']); ?>" disabled>
                                </div>
                                <label for="exampleFormControlInput1" class="form-label">Masa & Harga Jobsheet :</label>
                                <div class="input-group mb-2">

                                    <span class="input-group-text">Jam</span>
                                    <input type="number" class="form-control input_hours" name="input_hours[]" value="<?php echo htmlspecialchars($rowKerja['total_jam']); ?>" disabled>
                                    <span class="input-group-text">Minit</span>
                                    <input type="number" class="form-control input_minutes" name="input_minutes[]" value="<?php echo htmlspecialchars($rowKerja['total_minit']); ?>" disabled>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Harga (RM)</span>
                                    <input type="text" class="form-control output_price" name="input_price[]" value="<?php echo htmlspecialchars($rowKerja['total_harga']); ?>" disabled>
                                </div>

                                <?php

                                $tempahan_kerja_id = $rowKerja['tempahan_kerja_id'];

                                // First query: count all jobsheets for the given `tempahan_kerja_id`
                                $sqlJobsheetCount = "SELECT COUNT(*) AS count FROM jobsheet WHERE tempahan_kerja_id = $tempahan_kerja_id";
                                $resultJobsheetCount = mysqli_query($conn, $sqlJobsheetCount);

                                $totalJobsheets = 0;
                                if ($resultJobsheetCount) {
                                    $row = mysqli_fetch_assoc($resultJobsheetCount);
                                    $totalJobsheets = $row['count'];
                                }

                                // Second query: count jobsheets with specific status
                                $sqlStatusCount = "SELECT COUNT(*) AS count FROM jobsheet WHERE tempahan_kerja_id = $tempahan_kerja_id AND status_jobsheet IN ('pengesahan', 'dijalankan')";
                                $resultStatusCount = mysqli_query($conn, $sqlStatusCount);

                                $statusCount = 0;
                                if ($resultStatusCount) {
                                    $row = mysqli_fetch_assoc($resultStatusCount);
                                    $statusCount = $row['count'];
                                }

                                // Set button class based on the conditions
                                if ($statusCount > 0 || $totalJobsheets == 0) {
                                    $btn = 'btn-warning';
                                } else {
                                    $btn = 'btn-secondary';
                                }
                                ?>
                                <div class="d-flex justify-content-end ">
                                    <button class="btn <?= $btn ?>" type="button" onclick="window.location.href='kemaskini_jobsheet.php?tempahan_id=<?php echo $tempahan_id ?>&tempahan_kerja_id=<?php echo htmlspecialchars($rowKerja['tempahan_kerja_id']); ?>'">Kemaskini Jobsheet</button>
                                </div>

                            </div>
                        <?php

                        endwhile;
                    else: ?>
                        <input type="text" class="form-control mb-2" id="jenis_kerja_input" value="No kerja found" disabled>
                    <?php endif; ?>
                </div>
                <div class="modal-footer justify-content-end">
                    <div>
                        <button type="submit" class="btn btn-success"> Selesai Tempahan</button>
                    </div>
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
    $('#selesaiKerja').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Selesai Kerja",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'controller/selesai_kerja.php',
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
                                window.location.href = 'jobsheet.php';
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
            }
        });


    });
</script>

</body>

</html>