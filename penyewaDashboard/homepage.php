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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
	<link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
	<link rel="stylesheet" href="path/to/stylesheet.css" media="print" onload="this.media='all'">
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

    <!-- ***** Main Banner Start ***** -->
    <div class="main-banner main-banner-img wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <div class="row">
                                        <h6>Selamat Datang <?php echo htmlspecialchars($nama);?> !</h6>
                                        <h2>TEMPAHAN KENDERAAN LEMBAGA KENAF DAN TEMBAKAU</h2>
                                        <p>Selamat datang ke laman tempahan kenderaan kami! Kami menawarkan pelbagai
                                            pilihan kenderaan untuk memenuhi keperluan anda. Terima kasih.</p>
                                    <div class="back-dropdown">
                                        <div class="border-first-button scroll-to-section">
                                            <button onclick="location.href='tempahan.php'">Tempah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="../assets/images/farm-tractor-concept-illustration.png" alt="Farm Tractor">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner End ***** -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../vendor/jquery/jquery.min.js" defer></script>
    <script src="../assets/js/owl-carousel.js" defer></script>
    <script src="../assets/js/animation.js" defer></script>
    <script src="../assets/js/imagesloaded.js" defer></script>
    <script src="../assets/js/custom.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css">


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
		
		const menuToggle = document.querySelector('.menu-toggle');
		const nav = document.querySelector('.nav');

		menuToggle.addEventListener('click', () => {
			nav.classList.toggle('show');
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
	</script>
</body>

</html>