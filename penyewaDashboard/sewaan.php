<?php

include 'controller/connection.php';
include 'controller/session.php';
include 'controller/get_userdata.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">

    <style>
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .container-custom {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 15px;
        }

        .rental-list {
            margin-bottom: 20px;
        }

        .rental-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: box-shadow 0.3s ease;
            position: relative;
        }

        .rental-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .rental-item .id,
        .rental-item .status {
            font-weight: bold;
        }

        .rental-item .status {
            float: right;
        }

        .rental-item .dalamPengesahan {
            color: #007bff;
        }

        .rental-item .bayaranDeposit {
            color: grey;
        }

        .rental-item .ditolak {
            color: red;
        }

        .rental-item .selesai {
            color: green;
        }

        .rental-item .belum-bayar {
            color: #ff0000;
        }

        .rental-item p {
            margin: 5px 0;
        }

        .details {
            display: none;
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #e9f7fd;
        }

        .details.active {
            display: block;
        }

        .details h2 {
            margin-top: 0;
            color: #007bff;
        }

        .semibold {
            font-weight: 600;
        }

        li {
            margin-bottom: 14px;
        }
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <?php include 'partials/header.php'; ?>

    <div class="container-custom">
        <h3 class="text-center fw-bold" style="margin-top: 15px; margin-bottom: 15px;">Tempahan</h3>


        <div class="rental-list">
            <?php
            // Fetch bookings with status 'dalam pengesahan'
            $sqlTempahan = "SELECT t.*, p.nama
                    FROM tempahan t
                    INNER JOIN penyewa p ON p.id = t.penyewa_id
                    WHERE t.status_bayaran != 'dibatalkan'  AND t.penyewa_id = $id";

            $resultTempahan = mysqli_query($conn, $sqlTempahan);

            if (mysqli_num_rows($resultTempahan) == 0) {
                echo '<div style="text-align: center;">
                        <span>Tiada Tempahan. <a href="tempahan.php">Tempah Sekarang</a></span>
                    </div>';
            } else {
                // Loop through each booking
                while ($row = mysqli_fetch_assoc($resultTempahan)) {
                    // Get the booking ID and the renter's name
                    $tempahanId = $row['tempahan_id'];
                    $penyewaNama = $row['nama'];
                    $tarikhKerja = $row['tarikh_kerja'];

                    // Fetch the list of tasks for the current booking
                    $sqlKerja = "SELECT * FROM tempahan_kerja WHERE tempahan_id = $tempahanId AND status_kerja != 'dibatalkan'";
                    $resultKerja = mysqli_query($conn, $sqlKerja);

                    // Fetch additional details for the modal (e.g., booking date, work location, etc.)
                    // Assuming you have these fields in the 'tempahan' table.
                    $tarikhTempahan = $row['created_at'];
                    // $masaTempahan = $row['masa_tempahan'];
                    $negeri = $row['negeri'];
                    $lokasiKerja = $row['lokasi_kerja'];
                    $keluasanTanah = $row['luas_tanah'];
                    $catatan = $row['catatan'] ?? '-'; // If there are no notes, display '-'
                    $statusBayaran = $row['status_bayaran'];
                    $statusTempahan = $row['status_tempahan'];

                    $counterKerja = 1;

            ?>
                    <div class="rental-item">
                        <div class="id">
                            Tempahan ID: <?php echo $tempahanId; ?> <!-- Display booking ID -->

                            <?php
                            switch ($statusBayaran) {
                                case 'dalam pengesahan':
                                    echo '<div class="status badge bg-secondary">Dalam Pengesahan</div>';
                                    break;

                                case 'bayaran deposit':
                                    echo '<div class="status badge bg-warning text-dark">Bayaran Deposit</div>';
                                    break;

                                case 'deposit diproses':
                                    echo '<div class="status badge bg-info text-dark">Deposit Diproses</div>';
                                    break;

                                case 'deposit selesai':
                                    echo '<div class="status badge bg-success">Deposit Selesai</div>';
                                    break;

                                case 'belum bayar':
                                    echo '<div class="status badge bg-danger">Belum Bayar</div>';
                                    break;

                                case 'bayaran diproses':
                                    echo '<div class="status badge bg-info text-dark">Bayaran Diproses</div>';
                                    break;
                                case 'bayaran balik':
                                    echo '<div class="status badge bg-warning text-dark">Bayaran Balik</div>';
                                    break;
                                case 'selesai':
                                    echo '<div class="status badge bg-success">Selesai</div>';
                                    break;

                                default:
                                    echo '<div class="status badge bg-dark">STATUS TIDAK DIKENALI</div>';
                                    break;
                            }
                            ?>

                        </div><br>

                        <p>
                            <span class="semibold">Cadangan Tarikh Kerja : </span>
                            <span><?php echo date('d/m/Y', strtotime($tarikhKerja)); ?></span> <!-- Display proposed work date -->
                        </p>

                        <p><span class="semibold">Senarai Kerja : </span></p>
                        <ol>
                            <?php
                            $counterKerja = 1; // Initialize a counter for task numbering
                            while ($kerja = mysqli_fetch_assoc($resultKerja)) {
                                // Check if the booking status is 'pengesahan pee'
                                if ($statusTempahan == 'pengesahan pee') {
                            ?>
                                    <!-- Display task list with status 'pengesahan pee' -->
                                    <li style="display: flex; justify-content: space-between; align-items: center;">
                                        <span><?php echo $counterKerja . '. ' . $kerja['nama_kerja']; ?></span> <!-- Display task name with numbering -->
                                        <span>
                                            <button class="btn btn-danger btn-sm cancelKerjaBtn" type="button" data-id="<?php echo $kerja['tempahan_kerja_id']; ?>">Batal Kerja</button> <!-- Cancel task button -->
                                        </span>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <!-- Display task list for statuses other than 'pengesahan pee' -->
                                    <li style="display: flex; justify-content: space-between; align-items: center;">
                                        <span><?php echo $counterKerja . '. ' . $kerja['nama_kerja']; ?></span> <!-- Display task name with numbering -->
                                        <?php
                                        switch ($kerja['status_kerja']) {
                                            case 'tempahan diproses':
                                                echo '<span class="badge bg-secondary">Tempahan Diproses</span>';
                                                break;
                                            case 'dijalankan':
                                                echo '<span class="badge bg-warning">Dijalankan</span>';
                                                break;
                                            case 'selesai':
                                                echo '<span class="badge bg-success">Selesai</span>';
                                                break;
                                            case 'ditolak':
                                                echo '<span class="badge bg-danger">Ditolak</span>';
                                                break;
                                            default:
                                                echo '<span class="badge bg-secondary">Status Tidak Diketahui</span>'; // Optional default case
                                        }
                                        ?>
                                    </li>
                            <?php
                                }
                                // Increment the counter after each task
                                $counterKerja++;
                            }
                            ?>
                        </ol>

                        <hr>
                        <?php
                        switch ($statusBayaran) {
                            case 'dalam pengesahan':
                                echo '<div style="display: flex; justify-content: flex-end; gap: 10px;">
                                        <span>
                                            <button class="btn btn-danger btn-sm cancelTempahanBtn" type="button" data-id="' . $tempahanId . '">Batal Tempahan</button> <!-- Cancel booking button -->
                                        </span>
                                        <span>
                                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_' . $tempahanId . '">Lihat Butiran</button> <!-- View details button -->
                                        </span>
                                    </div>';
                                break;

                            case 'bayaran deposit':
                                echo '<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                                    <!-- Left side: Link to Lihat Sebut Harga -->
                                    <span>
                                        <a href="controller/getPDF_deposit.php?id=' . $tempahanId . '" target="_blank" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
                                    </span>

                                    <!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
                                    <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                        <span>
                                            <button class="btn btn-danger btn-sm cancelTempahanBtn" type="button" data-id="' . $tempahanId . '">Batal Tempahan</button>
                                        </span>
                                        <span>
                                            <button class="btn btn-success btn-sm bayarDepositBtn" type="button" data-id="' . $tempahanId . '">Bayar Deposit</button>
                                        </span>
                                        <span>
                                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_' . $tempahanId . '">Lihat Butiran</button>
                                        </span>
                                    </div>
                                </div>';

                                break;

                            case 'deposit diproses':
                                echo '<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                                    <!-- Left side: Link to Lihat Sebut Harga -->
                                    <span>
                                        <a href="controller/getPDF_deposit.php?id=' . $tempahanId . '" target="_blank" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
                                    </span>

                                    <!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
                                    <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                        
                                        <span>
                                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_' . $tempahanId . '">Lihat Butiran</button>
                                        </span>
                                    </div>
                                </div>';
                                break;

                            case 'deposit selesai':
                                echo '<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                                    <!-- Left side: Link to Lihat Sebut Harga -->
                                    <span>
                                        <a href="controller/getPDF_deposit.php?id=' . $tempahanId . '" target="_blank" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
                                    </span>

                                    <!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
                                    <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                        <span>
                                            <button class="btn btn-success btn-sm" type="button" data-id="' . $tempahanId . '">Resit Deposit</button>
                                        </span>
                                        
                                        <span>
                                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_' . $tempahanId . '">Lihat Butiran</button>
                                        </span>
                                    </div>
                                </div>';
                                break;

                            case 'belum bayar':
                                echo '<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                                    <!-- Left side: Link to Lihat Sebut Harga -->
                                    <span>
                                        <a href="controller/getPDF_fullpayment.php?id=' . $tempahanId . '" target="_blank" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
                                    </span>

                                    <!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
                                    <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                        <span>
                                            <button class="btn btn-success btn-sm bayarPenuhBtn" type="button" data-id="' . $tempahanId . '">Bayar</button>
                                        </span>
                                        
                                        <span>
                                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_' . $tempahanId . '">Lihat Butiran</button>
                                        </span>
                                    </div>
                                </div>';
                                break;

                            case 'bayaran diproses':
                                echo '<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                                    <!-- Left side: Link to Lihat Sebut Harga -->
                                    <span>
                                        <a href="controller/getPDF_fullpayment.php?id=' . $tempahanId . '" target="_blank" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
                                    </span>

                                    <!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
                                    <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                        
                                        
                                        <span>
                                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_' . $tempahanId . '">Lihat Butiran</button>
                                        </span>
                                    </div>
                                </div>';
                                break;

                            case 'bayaran balik':
                                echo '<div style="display: flex; justify-content: flex-end; gap: 10px;">
                            
                            <span>
                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_' . $tempahanId . '">Lihat Butiran</button> <!-- View details button -->
                            </span>
                        </div>';
                                break;


                            case 'selesai':
                                echo '<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                                    <!-- Left side: Link to Lihat Sebut Harga -->
                                    <span>
                                        <a href="controller/getPDF_fullpayment.php?id=' . $tempahanId . '" target="_blank" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
                                    </span>

                                    <!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
                                    <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                        <span>
                                            <button class="btn btn-success btn-sm" type="button" data-id="' . $tempahanId . '">Resit</button>
                                        </span>
                                        
                                        <span>
                                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_' . $tempahanId . '">Lihat Butiran</button>
                                        </span>
                                    </div>
                                </div>';
                                break;


                            default:
                                echo '<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                                    <!-- Left side: Link to Lihat Sebut Harga -->
                                <span>
                                    <a href="controller/getPDF_fullpayment.php?id=' . $tempahanId . '" target="_blank" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
                                </span>

                                <!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
                                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                    
                                    
                                    <span>
                                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_' . $tempahanId . '">Lihat Butiran</button>
                                    </span>
                                </div>
                            </div>';
                                break;
                        }
                        ?>


                    </div>

                    <!-- Modal for each booking with unique ID -->
                    <div class="modal fade" id="detailModal_<?php echo $tempahanId; ?>" tabindex="-1" aria-labelledby="detailModalLabel_<?php echo $tempahanId; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel_<?php echo $tempahanId; ?>">Butiran Tempahan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Detailed information for the selected booking -->
                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Tarikh Tempahan:
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo date('d/m/Y', strtotime($tarikhTempahan)); ?>
                                        </span>
                                    </p>

                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Negeri:
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $negeri; ?>
                                        </span>
                                    </p>

                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Lokasi Kerja:
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $lokasiKerja; ?>
                                        </span>
                                    </p>

                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Keluasan Tanah (Hektar):
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $keluasanTanah; ?>
                                        </span>
                                    </p>

                                    <p>
                                        <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                            Catatan:
                                        </span><br>
                                        <span style="font-size: large;">
                                            <?php echo $catatan; ?>
                                        </span>
                                    </p>

                                    <p>
                                        <!-- <span style="text-transform: uppercase; font-weight: bold; font-size: small;">
                                        Senarai Kerja:
                                    </span><br> -->
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama Kerja</th>
                                                <th>Cadangan Tarikh</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Reset the pointer for the task result set to iterate again for the modal
                                            mysqli_data_seek($resultKerja, 0);
                                            while ($kerjaModal = mysqli_fetch_assoc($resultKerja)) { ?>
                                                <tr>
                                                    <td><?php echo $kerjaModal['nama_kerja']; ?></td> <!-- Display task name -->
                                                    <td><?php echo date('d/m/Y', strtotime($kerjaModal['tarikh_kerja_cadangan'])); ?></td> <!-- Display proposed work date -->
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    </p>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            <?php } ?>
        </div>

    </div>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/animation.js"></script>
    <script src="../assets/js/imagesloaded.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        function myFunction() {
            const dropdown = document.getElementById("myDropdown");
            dropdown.classList.toggle("show");
            dropdown.setAttribute('aria-expanded', dropdown.classList.contains('show'));
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.closest('.dropdown')) {
                document.getElementById("myDropdown").classList.remove("show");
            }
        };

        // Attach click event to all buttons with class 'cancelKerja'
        $(document).on('click', '.cancelKerjaBtn', function(e) {
            // Get the kerjaId from the button's data-id attribute
            let kerjaId = $(this).data('id');

            Swal.fire({
                title: "Adakah anda pasti?",
                text: "Anda tidak akan dapat membatalkan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/cancelKerja.php',
                        type: 'POST',
                        data: {
                            id: kerjaId
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Berjaya",
                                text: "Kerja Dibatalkan",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
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


        $(document).on('click', '.cancelTempahanBtn', function(e) {
            // Get the kerjaId from the button's value
            let tempahanId = $(this).data('id');

            Swal.fire({
                title: "Adakah anda pasti?",
                text: "Anda tidak akan dapat membatalkan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/cancelTempahan.php',
                        type: 'POST',
                        data: {
                            id: tempahanId
                        },
                        success: function(response) {
                            let res = JSON.parse(response);
                            Swal.fire({
                                title: "Berjaya",
                                text: "Tempahan Dibatalkan",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
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

        $(document).on('click', '.bayarDepositBtn', function(e) {
            // Get the kerjaId from the button's value
            let tempahanId = $(this).data('id');

            Swal.fire({
                title: "Bayar Tempahan",
                text: "Anda akan dihantar ke page lain",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/bayarDeposit.php',
                        type: 'POST',
                        data: {
                            id: tempahanId
                        },
                        success: function(response) {
                            let res = JSON.parse(response);
                            Swal.fire({
                                title: "Berjaya",
                                text: "Deposit Berjaya Dibayar",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
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

        $(document).on('click', '.bayarPenuhBtn', function(e) {
            // Get the kerjaId from the button's value
            let tempahanId = $(this).data('id');

            Swal.fire({
                title: "Bayar Tempahan",
                text: "Anda akan dihantar ke page lain",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/bayarPenuh.php',
                        type: 'POST',
                        data: {
                            id: tempahanId
                        },
                        success: function(response) {
                            let res = JSON.parse(response);
                            Swal.fire({
                                title: "Berjaya",
                                text: "Berjaya Dibayar",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
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
    </script>


</body>

</html>