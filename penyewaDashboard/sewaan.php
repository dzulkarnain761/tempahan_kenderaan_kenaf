<?php
include '../controller/db-connect.php';

// session_start();

// if (!isset($_SESSION["id"])) {
//     header("Location: login.php");
//     exit();
// }
include '../controller/get_userdata.php';
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
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">

    <style>

    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <!-- <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div> -->
    <!-- ***** Preloader End ***** -->

    <?php include 'partials/header.php'; ?>

    <div class=" wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
        <div class="formTable">
            <h3 class="text-center fw-bold" style="margin-top: 15px; margin-below: 15px;">Dalam Pengesahan</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Tarikh Kerja</th>
                            <th>Lokasi Kerja</th>
                            <th>Luas Tanah</th>
                            <th>Senarai Kerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = $_SESSION['id'];
                        $sqlTempahan = "SELECT * FROM tempahan WHERE penyewa_id = $id AND status = 'dalam pengesahan'";
                        $resultTempahan = mysqli_query($conn, $sqlTempahan);

                        if (!$resultTempahan) {
                            echo '<tr><td colspan="5">Error fetching data: ' . mysqli_error($conn) . '</td></tr>';
                        } elseif (mysqli_num_rows($resultTempahan) == 0) {
                            echo '<tr><td colspan="5">Tiada Tempahan</td></tr>';
                        } else {
                            $no = 1; // Initialize row number

                            while ($row = mysqli_fetch_assoc($resultTempahan)):
                                $tempahanId = $row['tempahan_id'];
                                $sqlKerja = "SELECT * FROM tempahan_kerja WHERE tempahan_id = $tempahanId AND status_kerja = 'dalam pengesahan'";
                                $resultKerja = mysqli_query($conn, $sqlKerja);

                                if (!$resultKerja) {
                                    echo '<tr><td colspan="5">Error fetching kerja data: ' . mysqli_error($conn) . '</td></tr>';
                                    continue;
                                }

                                $totalRows = mysqli_num_rows($resultKerja); // Get total number of rows for this tempahan
                        ?>
                                <tr data-id="<?= htmlspecialchars($row['tempahan_id']); ?>">
                                    <!-- Use rowspan to span the number of tempahan_kerja rows -->
                                    <td rowspan="<?= $totalRows; ?>"><?= $no++; ?></td>
                                    <td rowspan="<?= $totalRows; ?>"><?= date('d-m-Y', strtotime($row['tarikh_kerja'])); ?></td>
                                    <td rowspan="<?= $totalRows; ?>"><?= htmlspecialchars($row['lokasi_kerja']); ?></td>
                                    <td rowspan="<?= $totalRows; ?>"><?= htmlspecialchars($row['luas_tanah']); ?></td>

                                    <!-- Display the first row of tempahan_kerja -->
                                    <?php if ($rowKerja = mysqli_fetch_assoc($resultKerja)): ?>
                                        <td>
                                            <li style="display: flex; justify-content: space-between; align-items: center;">
                                                <span><?= htmlspecialchars($rowKerja['nama_kerja']); ?></span>
                                                <span>
                                                    <button class="btn btn-danger btn-sm cancelKerja" type="button" value="<?= htmlspecialchars($rowKerja['tempahan_kerja_id']); ?>">Batal Kerja</button>
                                                </span>
                                            </li>
                                        </td>
                                </tr>

                                <?php while ($rowKerja = mysqli_fetch_assoc($resultKerja)): ?>
                                    <tr>
                                        <td>
                                            <li style="display: flex; justify-content: space-between; align-items: center;">
                                                <span><?= htmlspecialchars($rowKerja['nama_kerja']); ?></span>
                                                <span>
                                                    <button class="btn btn-danger btn-sm cancelKerja" type="button" value="<?= htmlspecialchars($rowKerja['tempahan_kerja_id']); ?>">Batal Kerja</button>
                                                </span>
                                            </li>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php } ?>
                    </tbody>
                </table>




            </div>
        </div>

        <div class="formTable" style="margin-top: 50px;">
            <h3 class="text-center fw-bold" style="margin-top: 15px; margin-below: 15px;">Diterima</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Lokasi Kerja</th>
                            <th>Senarai Kerja</th>
                            <th>Tarikh Dicadangkan</th>
                            <th>Tindakan</th> <!-- Tindakan column with rowspan -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = $_SESSION['id'];
                        $sqlTempahan = "SELECT * FROM tempahan WHERE penyewa_id = $id AND status = 'bayaran deposit'";
                        $resultTempahan = mysqli_query($conn, $sqlTempahan);
                        $no = 1; // Initialize row number

                        if (!$resultTempahan || mysqli_num_rows($resultTempahan) == 0) {
                            // Display a single row indicating no results
                            echo '<tr><td colspan="5">Tiada Tempahan</td></tr>';
                        } else {
                            while ($row = mysqli_fetch_assoc($resultTempahan)) {
                                $tempahanId = $row['tempahan_id'];
                                $sqlKerja = "SELECT * FROM tempahan_kerja WHERE tempahan_id = $tempahanId AND status_kerja = 'bayaran deposit'";
                                $resultKerja = mysqli_query($conn, $sqlKerja);
                                $totalRows = mysqli_num_rows($resultKerja); // Get total number of rows for this tempahan
                        ?>
                                <tr data-id="<?= $row['tempahan_id']; ?>">
                                    <!-- Use rowspan to span the number of tempahan_kerja rows -->
                                    <td rowspan="<?= $totalRows; ?>"><?= $no++; ?></td>
                                    <td rowspan="<?= $totalRows; ?>"><?= $row['lokasi_kerja']; ?></td>

                                    <!-- Display the first row of tempahan_kerja -->
                                    <?php
                                    $rowKerja = mysqli_fetch_assoc($resultKerja);
                                    ?>
                                    <td><?= $rowKerja['nama_kerja']; ?></td>
                                    <td><?= $rowKerja['tarikh_kerja_cadangan']; ?></td>

                                    <!-- Use rowspan for Tindakan button -->
                                    <td rowspan="<?= $totalRows; ?>">
                                        <button class="btn btn-primary btn-sm lihatButiran" onclick="window.open('controller/getPDF.php?id=<?= $row['tempahan_id']; ?>', '_blank')">
                                            Lihat Butiran
                                        </button>

                                        <button class="btn btn-success btn-sm bayarDeposit" value="<?= $row['tempahan_id']; ?>">
                                            Bayar
                                        </button>
                                        <button class="btn btn-danger btn-sm cancelTempahan" value="<?= $row['tempahan_id']; ?>">
                                            Tolak
                                        </button>
                                    </td>
                                </tr>

                                <!-- Loop through the rest of the tempahan_kerja rows -->
                                <?php while ($rowKerja = mysqli_fetch_assoc($resultKerja)): ?>
                                    <tr>
                                        <td><?= $rowKerja['nama_kerja']; ?></td>
                                        <td><?= $rowKerja['tarikh_kerja_cadangan']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>


            </div>
        </div>



    </div>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/animation.js"></script>
    <script src="../assets/js/imagesloaded.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        const logoutButton = document.getElementById('logoutButton');

        // Add a click event listener to the logout button
        logoutButton.addEventListener('click', function() {
            // Show the confirmation dialog
            Swal.fire({
                title: "Log Keluar",
                // text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal",
                confirmButtonText: "Log Keluar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Handle the logout logic here (e.g., redirecting to a logout route)
                    // Example: window.location.href = '/logout';

                    // Show the success dialog
                    Swal.fire({
                        title: "Log Keluar!",
                        text: "Anda telah berjaya log keluar.",
                        icon: "success"
                    }).then(() => {
                        // Optionally, redirect the user after the success dialog
                        window.location.href = '../controller/auth/logout.php'; // Update with your actual logout URL
                    });
                }
            });
        });

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
        $('.cancelKerja').on('click', function(e) {
            // Get the kerjaId from the button's value
            let kerjaId = $(this).val();

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
                                title: "Berjaya ",
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

        $('.cancelTempahan').on('click', function(e) {
            // Get the kerjaId from the button's value
            let tempahanId = $(this).val();

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

        $('.bayarDeposit').on('click', function(e) {
            // Get the kerjaId from the button's value
            let tempahanId = $(this).val();

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
                                text: "Tempahan Diterima",
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