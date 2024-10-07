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
                <li class="breadcrumb-item"><a href="sejarahTempahan.php">Sejarah</a></li>
                <li class="breadcrumb-item active" aria-current="page">Maklumat Tempahan</li>
            </ol>
        </nav>
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>MAKLUMAT TEMPAHAN</h2>
            </div>

            <?php
            $id = $_GET['id'];

            // Ensure you escape the ID to prevent SQL injection
            $id = mysqli_real_escape_string($conn, $id);

            $sqlTempahan = "SELECT t.*, p.nama 
                FROM tempahan t
                INNER JOIN penyewa p ON p.id = t.penyewa_id WHERE t.tempahan_id = $id";
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

            <form id="terimaTempahan" method="POST">
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

                <div class="mb-3">
                    <label for="jenis_kerja_input" class="form-label">Jenis Kerja:</label>
                    <?php
                    $tempahanId = $id;
                    $sqlKerja = "SELECT * FROM `tempahan_kerja` t
					LEFT JOIN kenderaan k ON k.id = t.kenderaan_id
					LEFT JOIN tugasan tgs ON tgs.kerja = t.nama_kerja
					LEFT JOIN admin a ON a.id = t.pemandu_id
					LEFT JOIN tempahan tempahan ON tempahan.tempahan_id = t.tempahan_id
					WHERE t.tempahan_id = $tempahanId
					AND t.status_kerja NOT IN ('ditolak', 'dibatalkan')";
                    $resultKerja = mysqli_query($conn, $sqlKerja);

                    if ($resultKerja && mysqli_num_rows($resultKerja) > 0):
                        while ($rowKerja = mysqli_fetch_assoc($resultKerja)):
                            $tempahan_id = htmlspecialchars($rowKerja['tempahan_id']);
                            $nama_kerja = htmlspecialchars($rowKerja['nama_kerja']);
                    ?>
                        <div class="mb-5">
                            <input type="hidden" name="kerja_id[]" value="<?php echo htmlspecialchars($rowKerja['tempahan_kerja_id']); ?>">
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">Nama Kerja</span>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rowKerja['nama_kerja']); ?>" readonly>
								</div>

                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">Kenderaan</span>
									<input type="text" class="form-control" 
										   value="<?php 
											   echo isset($rowKerja['no_pendaftaran']) ? htmlspecialchars($rowKerja['no_pendaftaran']) : 'Unknown';
											   echo '  -  ';
											   echo isset($rowKerja['kategori_kenderaan']) ? htmlspecialchars($rowKerja['kategori_kenderaan']) : 'Unknown';
										   ?>" 
										   readonly>
								</div>


                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">Pemandu</span>
									<input type="text" class="form-control" value="<?php echo htmlspecialchars($rowKerja['nama']); ?>" readonly>
                                </div>
								
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Tarikh Kerja</span>
                                    <input type="date" class="form-control input_date" name="input_date[]" value="<?php echo htmlspecialchars($rowKerja['tarikh_kerja_cadangan']); ?>"  readonly>
                                </div>

                                <div class="input-group mb-2"> <span class="input-group-text">Jam</span>
									<input type="number" class="form-control" value="<?php echo htmlspecialchars($rowKerja['jumlah_jam']); ?>" readonly>
									<span class="input-group-text" id="basic-addon1">Harga (RM)</span>
									<input type="text" class="form-control" value="<?php echo htmlspecialchars($rowKerja['jumlah_bayaran']); ?>" readonly>
                                </div>
                        </div>
                        <?php endwhile;
                    else: ?>
                        <input type="text" class="form-control mb-2" id="jenis_kerja_input" value="Tiada kerja dijumpai." disabled>
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
</script>


</body>

</html>