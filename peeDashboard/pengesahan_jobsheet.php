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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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

        <div class="recentOrders px-5">
            <div class="cardHeader">
                <h2>MAKLUMAT TEMPAHAN</h2>
            </div>

            <input type="hidden" name="tempahan_id" value="<?php echo htmlspecialchars($tempahan['tempahan_id']) ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="namaPemohon" class="form-label fw-bold mt-2 mb-1">Nama Pemohon</label>
                    <p class="form-control-plaintext ps-2 border rounded bg-light" id="namaPemohon"><?php echo htmlspecialchars($tempahan['nama']); ?></p>
                </div>
                <div class="col-md-6">
                    <label for="tarikhPermohonan" class="form-label fw-bold mt-2 mb-1">Tarikh Permohonan</label>
                    <p class="form-control-plaintext ps-2 border rounded bg-light" id="tarikhPermohonan"> <?php echo date('d/m/Y', strtotime($tempahan['created_at'])) ?> </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tarikhCadangan" class="form-label fw-bold mt-2 mb-1">Tarikh Cadangan</label>
                    <p class="form-control-plaintext ps-2 border rounded bg-light" id="tarikhCadangan"> <?php echo date('d/m/Y', strtotime($tempahan['tarikh_kerja'])) ?> </p>
                </div>
                <div class="col-md-6">
                    <label for="luasTanah" class="form-label fw-bold mt-2 mb-1">Keluasan Tanah (Hektar)</label>
                    <p class="form-control-plaintext ps-2 border rounded bg-light" id="luasTanah"> <?php echo htmlspecialchars($tempahan['luas_tanah']) ?> </p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="lokasiKerja" class="form-label fw-bold mt-2 mb-1">Lokasi Kerja</label>
                    <p class="form-control-plaintext ps-2 border rounded bg-light" id="lokasiKerja"> <?php echo htmlspecialchars($tempahan['lokasi_kerja']) ?> </p>
                </div>
                <div class="col-md-6">
                    <label for="catatan" class="form-label fw-bold mt-2">Catatan</label>
                    <?php if (empty($tempahan['catatan'])): ?>
                        <p class="form-control-plaintext ps-2 border rounded bg-light mb-1" id="catatan">Tiada catatan</p>
                    <?php else: ?>
                        <p class="form-control-plaintext ps-2 border rounded bg-light mb-1" id="catatan"><?php echo htmlspecialchars($tempahan['catatan']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="recentOrders" style="background-color: #caf0f8;">
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
                            <div class="mb-4 p-3 border rounded bg-light">
                                <div class="mb-3" id="row-<?php echo $rowKerja['tempahan_kerja_id']; ?>">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1" style="width: 125px;">Nama Kerja</span>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($rowKerja['nama_kerja']); ?>" disabled style="flex: 1;">
                                    </div>

                                    <div class="input-group mb-4">
                                        <span class="input-group-text" style="width: 125px;">Tarikh Kerja</span>
                                        <input type="date" class="form-control input_date" name="input_date[]" value="<?php echo htmlspecialchars($rowKerja['tarikh_kerja_cadangan']); ?>" disabled>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4 p-3 border rounded custom-bg-color">
                                                <label for="exampleFormControlInput1" class="form-label">Masa & Harga Pengesahan :</label>
                                                <div class="input-group mb-2">
                                                    <input type="hidden" class="form-control rate_per_hour" value="<?php echo $rateharga; ?>">
                                                    <span class="input-group-text" style="width: 75px;">Jam</span>
                                                    <input type="number" class="form-control input_hours" name="input_hours[]" value="<?php echo htmlspecialchars($rowKerja['jam_anggaran']); ?>" min="0" max="6" disabled>
                                                    <span class="input-group-text" style="width: 75px;">Minit</span>
                                                    <input type="number" class="form-control input_minutes" name="input_minutes[]" value="<?php echo htmlspecialchars($rowKerja['minit_anggaran']); ?>" min="0" max="55" step="5" disabled>
                                                </div>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text" style="width: 75px;">RM</span>
                                                    <input type="text" class="form-control output_price" name="input_price[]" value="<?php echo htmlspecialchars($rowKerja['harga_anggaran']); ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4 p-3 border rounded custom-bg-color">
                                                <label for="exampleFormControlInput1" class="form-label">Masa & Harga Jobsheet :</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text" style="width: 75px;">Jam</span>
                                                    <input type="number" class="form-control input_hours" name="input_hours[]" value="<?php echo htmlspecialchars($rowKerja['total_jam']); ?>" disabled>
                                                    <span class="input-group-text" style="width: 75px;">Minit</span>
                                                    <input type="number" class="form-control input_minutes" name="input_minutes[]" value="<?php echo htmlspecialchars($rowKerja['total_minit']); ?>" disabled>
                                                </div>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text" style="width: 75px;">RM</span>
                                                    <input type="text" class="form-control output_price" name="input_price[]" value="<?php echo htmlspecialchars($rowKerja['total_harga']); ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
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