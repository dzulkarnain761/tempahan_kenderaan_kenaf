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

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <?php include 'partials/name_display.php'; ?>
            </div>

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="tempahan.php">Senarai Tempahan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Butiran Tempahan</li>
                </ol>
            </nav>

            <?php
            include 'controller/connection.php';

            // Get the ID from the URL query string
            $tempahan_id = $_GET['tempahan_id'];

            // Query to get the necessary details
            $sqlTempahan = "SELECT t.*, p.nama
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                WHERE t.tempahan_id = $tempahan_id";

            // Execute the query
            $result = $conn->query($sqlTempahan);

            // Fetch the data into an associative array
            if ($result->num_rows > 0) {
                $tempahan = $result->fetch_assoc();
            } else {
                echo "No records found.";
                $tempahan = [];
            }
            ?>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Butiran Tempahan</h2>
                </div>



                <form>

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



                </form>

            </div>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Butiran Kerja (Anggaran)</h2>
                </div>

                <?php
                // Prepare the first statement to get total_harga_anggaran and total_harga_sebenar
                $sql1 = $conn->prepare("SELECT total_harga_anggaran, total_harga_sebenar FROM tempahan WHERE tempahan_id = ?");
                $sql1->bind_param("s", $tempahan_id);
                $sql1->execute();
                $sql1->bind_result($total_harga_anggaran, $total_harga_sebenar);
                $sql1->fetch(); // Fetch the result

                // Close the first statement
                $sql1->close();

                // Prepare the second statement for tempahan_kerja
                $sqlkerja = $conn->prepare("SELECT * FROM tempahan_kerja WHERE tempahan_id = ?");
                $sqlkerja->bind_param("s", $tempahan_id);
                $sqlkerja->execute();
                $result = $sqlkerja->get_result(); // Get the result set from the prepared statement

                if ($result->num_rows > 0) {
                    while ($rowKerja = $result->fetch_assoc()) {

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



                            </div>
                        </div>

                <?php

                    }
                } else {
                    echo "<p>No work found for this order.</p>";
                }
                ?>

                
            </div>





        </div>
    </div>


    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
    <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</body>

</html>