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
            $resit_id = $_GET['resit_id'];

            // Query to get the necessary details
            $sqlTempahan = "SELECT t.tempahan_id,t.lokasi_kerja,t.luas_tanah, t.tarikh_kerja, p.nama, r.jenis_pembayaran, r.cara_bayar,r.nombor_rujukan
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                LEFT JOIN resit_pembayaran r ON r.tempahan_id = t.tempahan_id
                WHERE r.resit_id = $resit_id";

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
                            <label for="tempahan_id" class="form-label fw-bold mt-2 mb-1">Tempahan ID</label>
                            <p class="form-control-plaintext ps-2 border rounded bg-light" id="tempahan_id"><?php echo htmlspecialchars($tempahan['tempahan_id']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <label for="tarikhCadangan" class="form-label fw-bold mt-2 mb-1">Tarikh Cadangan</label>
                            <p class="form-control-plaintext ps-2 border rounded bg-light" id="tarikhCadangan"> <?php echo date('d/m/Y', strtotime($tempahan['tarikh_kerja'])) ?> </p>
                        </div>
                        
                        
                        
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="namaPemohon" class="form-label fw-bold mt-2 mb-1">Nama Pemohon</label>
                            <p class="form-control-plaintext ps-2 border rounded bg-light" id="namaPemohon"><?php echo htmlspecialchars($tempahan['nama']); ?></p>
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

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label for="lokasiKerja" class="form-label fw-bold mt-2 mb-1">Lokasi Kerja</label>
                            <p class="form-control-plaintext ps-2 border rounded bg-light" id="lokasiKerja"> <?php echo htmlspecialchars($tempahan['lokasi_kerja']) ?> </p>
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_pembayaran" class="form-label fw-bold mt-2 mb-1">Jenis Pembayaran</label>
                            <p class="form-control-plaintext ps-2 border rounded bg-light" id="jenis_pembayaran"><?php echo htmlspecialchars($tempahan['jenis_pembayaran']); ?></p>
                        </div>
                        
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="luasTanah" class="form-label fw-bold mt-2 mb-1">Keluasan Tanah (Hektar)</label>
                            <p class="form-control-plaintext ps-2 border rounded bg-light" id="luasTanah"> <?php echo htmlspecialchars($tempahan['luas_tanah']) ?> </p>
                        </div>
                        <div class="col-md-6">
                            <label for="cara_bayar" class="form-label fw-bold mt-2 mb-1">Cara Bayar</label>
                            <p class="form-control-plaintext ps-2 border rounded bg-light" id="cara_bayar"><?php echo htmlspecialchars($tempahan['cara_bayar']); ?></p>
                        </div>
                        <?php if ($tempahan['cara_bayar'] == 'fpx') { ?>
                            <div class="col-md-6">
                                <label for="nomborRujukan" class="form-label fw-bold mt-2 mb-1">Nombor Rujukan :</label>
                                <div class="d-flex align-items-center">
                                    <p class="form-control-plaintext ps-2 border rounded bg-light mb-0 me-2 flex-shrink-1" id="nomborRujukan"><?php echo htmlspecialchars($tempahan['nombor_rujukan']); ?></p>
                                    <button type="button" class="btn btn-outline-secondary flex-shrink-0" data-bs-toggle="modal" data-bs-target="#fpxDetails">Lihat Butiran</button>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                    <div class="row mb-3">    
                        <?php if ($tempahan['cara_bayar'] == 'fpx') { ?>
                            <div class="col-md-6">
                                <label for="nomborRujukan" class="form-label fw-bold mt-2 mb-1">Nombor Rujukan :</label>
                                <div class="d-flex align-items-center">
                                    <p class="form-control-plaintext ps-2 border rounded bg-light mb-0 me-2 flex-shrink-1" id="nomborRujukan"><?php echo htmlspecialchars($tempahan['nombor_rujukan']); ?></p>
                                    <button type="button" class="btn btn-outline-secondary flex-shrink-0" data-bs-toggle="modal" data-bs-target="#fpxDetails">Lihat Butiran</button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Modal FPX-->
                    <div class="modal fade" id="fpxDetails" tabindex="-1" aria-labelledby="fpxDetailsLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="fpxDetailsLabel">Butiran FPX</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <?php

                                $nombor_rujukan = $tempahan['nombor_rujukan'];

                                $sqlFPX = "SELECT * FROM `fpx_payments` WHERE nombor_rujukan = '$nombor_rujukan'";

                                $result = mysqli_query($conn, $sqlFPX);

                                // Check if there are results
                                if (mysqli_num_rows($result) > 0) {
                                    // Fetch the data into an associative array
                                    $row = mysqli_fetch_assoc($result);

                                    // Extracting values
                                    $fpx_id_transaksi = $row['fpx_id_transaksi'];
                                    $fpx_id_bank = $row['fpx_id_bank'];
                                    $fpx_nama_bank = $row['fpx_nama_bank'];
                                    $fpx_nama_pembeli = $row['fpx_nama_pembeli'];
                                    $fpx_akaun_bank_pembeli = $row['fpx_akaun_bank_pembeli'];
                                    $jumlah_bayaran = $row['jumlah_bayaran'];
                                    $fpx_masa_transaksi = $row['fpx_masa_transaksi'];
                                    $fpx_kod_respon = $row['fpx_kod_respon'];
                                    $nombor_rujukan = $row['nombor_rujukan'];
                                    $catatan = $row['catatan'];
                                }
                                ?>
                                <div class="modal-body">
                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            FPX ID
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $fpx_id_transaksi; ?>
                                        </span>
                                    </p>
                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Bank Name
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $fpx_nama_bank; ?>
                                        </span>
                                    </p>
                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Buyer Name
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $fpx_nama_pembeli; ?>
                                        </span>
                                    </p>
                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Amount Paid
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $jumlah_bayaran; ?>
                                        </span>
                                    </p>
                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Transaction Time
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $fpx_masa_transaksi; ?>
                                        </span>
                                    </p>
                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Reference Number
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $nombor_rujukan; ?>
                                        </span>
                                    </p>
                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            FPX respons kod
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $fpx_kod_respon; ?>
                                        </span>
                                    </p>
                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Notes
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $catatan; ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Butiran Kerja</h2>
                </div>

                <?php
                $jenis_pembayaran = $tempahan['jenis_pembayaran'];
                // Prepare the first statement to get total_harga_anggaran, total_harga_sebenar, and total_baki
                $sql1 = $conn->prepare("SELECT total_harga_anggaran, total_harga_sebenar, total_baki FROM tempahan WHERE tempahan_id = ?");
                $sql1->bind_param("s", $tempahan_id);
                $sql1->execute();
                $sql1->bind_result($total_harga_anggaran, $total_harga_sebenar, $total_baki);
                $sql1->fetch();
                $sql1->close();

                // Fetch tempahan_kerja records
                $sqlkerja = $conn->prepare("SELECT * FROM tempahan_kerja WHERE tempahan_id = ?");
                $sqlkerja->bind_param("s", $tempahan_id);
                $sqlkerja->execute();
                $result = $sqlkerja->get_result();
                ?>

                <?php if ($result->num_rows > 0): ?>
                    <?php while ($rowKerja = $result->fetch_assoc()): ?>
                        <div class="mb-4 p-3 border rounded bg-light">
                            <div class="" id="row-<?php echo $rowKerja['tempahan_kerja_id']; ?>">
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
                                        <div class=" p-3 border rounded custom-bg-color">
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
                                        <div class=" p-3 border rounded custom-bg-color">
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
                        <br>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No work found for this order.</p>
                <?php endif; ?>

                <div class="col-md-6">
                        <label for="harga_anggaran" class="form-label fw-bold mt-2 mb-1">Harga Pengesahan</label>
                        <p class="form-control-plaintext ps-2 border rounded bg-light" id="harga_anggaran">RM <?php echo htmlspecialchars($tempahan['total_harga_anggaran']); ?></p>
                    </div>

                    <div class="col-md-6">
                        <label for="harga_jobsheet" class="form-label fw-bold mt-2 mb-1">Harga Jobsheet</label>
                        <p class="form-control-plaintext ps-2 border rounded bg-light" id="harga_jobsheet">RM <?php echo htmlspecialchars($tempahan['total_harga_sebenar']); ?></p>
                    </div>

                    <div class="col-md-6">
                        <label for="harga_baki" class="form-label fw-bold mt-2 mb-1">Baki</label>
                        <p class="form-control-plaintext ps-2 border rounded bg-light" id="harga_baki">RM <?php echo htmlspecialchars($tempahan['total_baki']); ?></p>
                    </div>

                <div class="modal-footer d-flex justify-content-between">
                    <?php if ($jenis_pembayaran == 'bayaran penuh'): ?>
                        <button type="button" class="btn btn-primary" onclick="window.open('controller/quotationPDF_fullpayment.php?tempahan_id=<?= $tempahan_id ?>', '_blank')">Lihat Sebut Harga</button>
                    <?php else: ?>
                        <button type="button" class="btn btn-primary" onclick="window.open('controller/quotationPDF_extrapayment.php?tempahan_id=<?= $tempahan_id ?>', '_blank')">Lihat Sebut Harga</button>

                    <?php endif; ?>
                    <div>
                        <button type="button" class="btn btn-danger cancelTempahan" value="<?= $tempahan_id ?>">Batal Tempahan</button>
                        <button type="button" class="btn btn-success terimaBayaran" value="<?= $tempahan_id ?>">Hantar Ke Pengarah</button>
                    </div>
                </div>
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

    <script>
        $(document).ready(function() {

            $(document).on('click', '.terimaBayaran', function(e) {
                let tempahanId = $(this).attr('value');

                Swal.fire({
                    title: "Hantar Ke Pengarah",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'controller/terimaBayaran.php',
                            type: 'POST',
                            data: {
                                tempahan_id: tempahanId
                            },
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
                    }
                });

            });

            $(document).on('click', '.cancelTempahan', function(e) {
                let tempahanId = $(this).attr('value');

                Swal.fire({
                    title: "Tolak Tempahan",
                    text: "Sila nyatakan sebab menolak tempahan:",
                    input: 'textarea', // Add input field
                    inputPlaceholder: 'Sebab tolak tempahan...',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya",
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Anda perlu memberikan sebab untuk menolak tempahan!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        let reason = result.value; // Get input value
                        $.ajax({
                            url: 'controller/cancelTempahan.php',
                            type: 'POST',
                            data: {
                                tempahan_id: tempahanId,
                                sebab_ditolak: reason // Pass the reason to the server
                            },
                            success: function(response) {
                                let res = JSON.parse(response);
                                Swal.fire({
                                    title: "Berjaya",
                                    text: "Tempahan Dibatalkan",
                                    icon: "success"
                                }).then(() => {
                                    window.location.href = 'tempahan.php';
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: "Ralat!",
                                    text: "Ralat berlaku semasa mengemaskini status kerja.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });

        });
    </script>


</body>

</html>