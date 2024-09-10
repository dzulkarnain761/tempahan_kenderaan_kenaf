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
	
    <div class=" wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
        <div class="formTable">
            <h3 class="text-center fw-bold" style="margin-top: 15px; margin-below: 15px;">MAKLUMAT SEWAAN</h3>
            <div class="table-responsive">
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
                            <tr data-id="<?= $row['tempahan_id']; ?>">
                                <td><?= $no++; ?></td> <!-- Increment the row number -->
                                <td><?= date('d-m-Y', strtotime($row['created_at'])); ?></td> <!-- Format the date -->
                                <td><?= date('d-m-Y', strtotime($row['tarikh_kerja'])); ?></td> <!-- Format the date -->
                                <td>
                                    <?php
                                    $tempahanId = $row['tempahan_id'];
                                    $sqlKerja = "SELECT * FROM `tempahan_kerja` WHERE tempahan_id = $tempahanId";
                                    $resultKerja = mysqli_query($conn, $sqlKerja);
                                    $listno = 1;
                                    while ($rowKerja = mysqli_fetch_assoc($resultKerja)): ?>
                                        <span><?= htmlspecialchars($rowKerja['nama_kerja']); ?><br></span>
                                    <?php endwhile; ?>
                                </td>
                                <td><?= htmlspecialchars($row['status']); ?></td> <!-- Escape the status -->
                            </tr>
                        <?php endwhile; ?>
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
        logoutButton.addEventListener('click', function () {
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
    </script>
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