<?php
include 'controller/db-connect.php';

// session_start();

// if (!isset($_SESSION["id"])) {
//     header("Location: login.php");
//     exit();
// }
include 'controller/get_userdata.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
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

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="sewaan.php" class="logo">
                            <img src="assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
                            <img src="assets/images/logo.jpeg" alt="" style="width: 120px; height: auto;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="homepage.php">Laman Utama</a></li>
                            <li class="scroll-to-section"><a href="tempahan.php">Tempah</a></li>
                            <li class="scroll-to-section"><a href="sewaan.php" class="active">Sewaan</a></li>
                            <li class="scroll-to-section"><a href="profil.php">Profil</a></li>
                        </ul>
                        <div class="border-first-button" style="float: right; display: flex; align-items: center;">
                            <ion-icon name="person-outline" style="font-size: 24px; margin-top: 30px;"></ion-icon>
                            <span style="margin-left: 10px; margin-top: 30px;"><?php echo htmlspecialchars($nama);?></span>
                            <button id="logoutButton">Logout</button>
                        </div>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
    <div class=" wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
        <div class="formTable">
            <h3 class="text-center fw-bold" style="margin-top: 30px; margin-bottom: 30px;">MAKLUMAT SEWAAN</h3>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Tarikh Buat Tempahan</th>
                            <th>Cadangan Tarikh Kerja</th>
                            <th>Senarai Kerja Kerja</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = $_SESSION['id'];
                        $sqlTempahan = "SELECT * FROM `tempahan` WHERE penyewa_id = $id";
                        $resultTempahan = mysqli_query($conn, $sqlTempahan);
                        $no = 1; // Initialize row number

                        while ($row = mysqli_fetch_assoc($resultTempahan)): ?>
                            <tr data-id="<?= $row['id']; ?>">
                                <td><?= $no++; ?></td> <!-- Increment the row number -->
                                <td><?= date('d-m-Y', strtotime($row['tarikh_tempahan'])); ?></td> <!-- Format the date -->
                                <td><?= date('d-m-Y', strtotime($row['tarikh_kerja'])); ?></td> <!-- Format the date -->
                                <td>
                                    <?php
                                    $tempahanId = $row['id'];
                                    $sqlKerja = "SELECT * FROM `tempahan_kerja` WHERE tempahan_id = $tempahanId";
                                    $resultKerja = mysqli_query($conn, $sqlKerja);
                                    $listno = 1;
                                    while ($rowKerja = mysqli_fetch_assoc($resultKerja)): ?>
                                        <span><?= $listno++; ?>. <?= htmlspecialchars($rowKerja['nama_kerja']); ?><br></span>
                                    <?php endwhile; ?>
                                </td>
                                <td><?= htmlspecialchars($row['status']); ?></td> <!-- Escape the status -->
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/custom.js"></script>
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
                        title: "Logged out!",
                        text: "You have been successfully logged out.",
                        icon: "success"
                    }).then(() => {
                        // Optionally, redirect the user after the success dialog
                        window.location.href = 'controller/auth/logout.php'; // Update with your actual logout URL
                    });
                }
            });
        });
    </script>

</body>

</html>