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
            $sqlTempahan = "SELECT t.tempahan_id,t.lokasi_kerja,t.luas_tanah, t.tarikh_kerja, p.*, r.jenis_pembayaran, r.cara_bayar,r.nombor_rujukan, t.total_harga_anggaran, t.total_harga_sebenar, t.total_baki, t.status_tempahan
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                LEFT JOIN resit_pembayaran r ON r.tempahan_id = t.tempahan_id
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
                    <h2>Butiran Penyewa</h2>
                </div>

                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">Nama Penyewa :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['nama'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">No. Tel :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['contact_no'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">Email :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['email'] ?? 'Tiada Email' ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">Alamat :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['alamat'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">Nama Bank :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['nama_bank'] ?? 'Tiada' ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">No Bank :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['no_bank'] ?? 'Tiada' ?>" disabled>
                </div>


                <?php if ($tempahan['cara_bayar'] == 'fpx') { ?>
                    <div class="mb-3">
                        <label for="tarikhKerja" class="form-label">Nombor Rujukan :</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?php echo $tempahan['nombor_rujukan'] ?>" readonly>
                            <button type="button" class="btn btn-outline-secondary " data-bs-toggle="modal" data-bs-target="#fpxDetails">Lihat Butiran</button>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Butiran Tempahan</h2>
                </div>



                <form>
                    <div class="mb-3">
                        <label for="namaPenyewa" class="form-label">Tempahan ID :</label>
                        <input type="text" class="form-control" id="namaPenyewa" value="<?php echo $tempahan['tempahan_id'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="tarikhKerja" class="form-label">Nama Penyewa :</label>
                        <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['nama'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="tarikhKerja" class="form-label">Lokasi Kerja :</label>
                        <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['lokasi_kerja'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="tarikhKerja" class="form-label">Luas Tanah (Hektar) :</label>
                        <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['luas_tanah'] ?>" disabled>
                    </div>


                    <?php if ($tempahan['cara_bayar'] == 'fpx') { ?>
                        <div class="mb-3">
                            <label for="tarikhKerja" class="form-label">Nombor Rujukan :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?php echo $tempahan['nombor_rujukan'] ?>" readonly>
                                <button type="button" class="btn btn-outline-secondary " data-bs-toggle="modal" data-bs-target="#fpxDetails">Lihat Butiran</button>
                            </div>
                        </div>
                    <?php } ?>


                    <label for="exampleFormControlInput1" class="form-label">Harga Pengesahan :</label>

                    <div class="input-group mb-2">
                        <span class="input-group-text">Harga (RM)</span>
                        <input type="text" class="form-control output_price" name="input_price[]" value="<?php echo htmlspecialchars($tempahan['total_harga_anggaran']); ?>" disabled>
                    </div>

                    <label for="exampleFormControlInput1" class="form-label">Harga Jobsheet :</label>

                    <div class="input-group mb-2">
                        <span class="input-group-text">Harga (RM)</span>
                        <input type="text" class="form-control output_price" name="input_price[]" value="<?php echo htmlspecialchars($tempahan['total_harga_sebenar']); ?>" disabled>
                    </div>

                    <label for="exampleFormControlInput1" class="form-label">Baki :</label>

                    <div class="input-group mb-2">
                        <span class="input-group-text">Harga (RM)</span>
                        <input type="text" class="form-control output_price" name="input_price[]" value="<?php echo htmlspecialchars($tempahan['total_baki']); ?>" disabled>
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

                                $sqlFPX = "SELECT * FROM `fpx_payments` WHERE 1";

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

                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-primary" onclick="window.open('controller/getPDF_quotation_fullpayment.php?tempahan_id=<?= $tempahan_id ?>', '_blank')">Lihat Sebut Harga</button>
                        <button type="button" class="btn btn-primary" onclick="window.open('controller/getPDF_resit_fullpayment.php?tempahan_id=<?= $tempahan_id ?>', '_blank')">Lihat Resit</button>
                    </div>
                    <?php if ($tempahan['status_tempahan'] == 'refund kewangan') { ?>
                        <div>
                            <button type="button" class="btn btn-success refundKewangan" value="<?= $tempahan_id ?>">Refund</button>
                        </div>

                    <?php } ?>

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

            $(document).on('click', '.refundKewangan', function(e) {
                let tempahanId = $(this).attr('value');

                Swal.fire({
                    title: "Refund",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'controller/refund_kewangan.php',
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



        });
    </script>


</body>

</html>