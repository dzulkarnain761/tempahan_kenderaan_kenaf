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
            $sqlTempahan = "SELECT t.*, p.nama
                    FROM tempahan t
                    INNER JOIN penyewa p ON p.id = t.penyewa_id
                    WHERE t.status_bayaran = 'selesai'  AND t.penyewa_id = $id";

            $resultTempahan = mysqli_query($conn, $sqlTempahan);

            if (mysqli_num_rows($resultTempahan) == 0) {
                echo '<div style="text-align: center;">
                        <span>Tiada tempahan yang selesai dijumpai. <a href="sewaan.php">Lihat Tempahan</a></span>
                    </div>';
            } else {
                // Loop through each booking
                while ($row = mysqli_fetch_assoc($resultTempahan)) {
                    // Get the booking ID and the renter's name
                    $tempahanId = $row['tempahan_id'];
                    $penyewaNama = $row['nama'];
                    $tarikhKerja = $row['tarikh_kerja'];

                    // Fetch the list of tasks for the current booking
                    $sqlKerja = "SELECT * FROM tempahan_kerja WHERE tempahan_id = $tempahanId AND status_kerja = 'selesai'";
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
                    <div class="rental-item wow fadeIn" data-wow-duration="0.90s" data-wow-delay="0.1s">
                        <div class="id">
                            Tempahan ID: <?php echo $tempahanId; ?> <!-- Display booking ID -->

                            <?php
                            switch ($statusBayaran) {
                                case 'selesai':
                                    echo '<div class="status badge bg-success">Selesai</div>';
                                    break;

                                default:
                                    echo '<div class="status badge bg-dark">STATUS TIDAK DIKENALI</div>';
                                    break;
                            }
                            ?>
                        </div><br>

                        <p><span class="semibold">Senarai Kerja : </span></p>
                        <ol>
                            <?php
                            $counterKerja = 1; // Initialize a counter for task numbering
                            while ($kerja = mysqli_fetch_assoc($resultKerja)) {
                                ?>
                                    <!-- Display task list for statuses other than 'pengesahan pee' -->
                                    <li style="display: flex; justify-content: space-between; align-items: center;">
                                        <span><?php echo $counterKerja . '. ' . $kerja['nama_kerja']; ?></span> <!-- Display task name with numbering -->
                                    </li>
                            <?php
                                // Increment the counter after each task
                                $counterKerja++;
                            }
                            ?>
                        </ol>

                        <hr>
                        <?php
                        switch ($statusBayaran) {
                            case 'selesai':
                                echo '<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                                    <!-- Left side: Link to Lihat Sebut Harga -->
                                    <span>
                                        <a href="controller/quotationPDF_fullpayment.php?id=' . $tempahanId . '" target="_blank" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
                                    </span>

                                    <!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
                                    <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                        <span>
                                            <button class="btn btn-success btn-sm " onclick="window.open(\'controller/resitPDF_fullpayment.php?id=' . $tempahanId . '\', \'_blank\')">Resit</button>
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
                                    <a href="controller/quotationPDF_fullpayment.php?id=' . $tempahanId . '" target="_blank" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
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
                    <!-- Modal Detail for each booking with unique ID -->
                    <div class="modal fade" id="detailModal_<?php echo $tempahanId; ?>" tabindex="-1" aria-labelledby="detailModalLabel_<?php echo $tempahanId; ?>" aria-hidden="true">
                        <div class="modal-dialog ">
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
                                                <th>Tarikh kerja</th>
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
    </script>


</body>

</html>