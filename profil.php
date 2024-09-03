<?php

include 'controller/db-connect.php';

include 'controller/get_userdata.php';
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <style>
        /* 
	---------------------------------------------
	global styles
	--------------------------------------------- 
	*/
        html,
        body {
            background: #fff;
            font-family: 'Poppins', sans-serif;
        }

        ::selection {
            background: #4da6e7;
            color: #fff !important;
        }

        ::-moz-selection {
            background: #4da6e7;
            color: #fff !important;
        }

        @media (max-width: 991px) {

            html,
            body {
                overflow-x: hidden;
            }

            .mobile-top-fix {
                margin-top: 30px;
                margin-bottom: 0px;
            }

            .mobile-bottom-fix {
                margin-bottom: 30px;
            }

            .mobile-bottom-fix-big {
                margin-bottom: 60px;
            }
        }

        .page-section {
            margin-top: 120px;
        }

        .section-heading h6 {
            font-size: 15px;
            font-weight: 700;
            color: #4da6e7;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .section-heading h4 {
            color: #2a2a2a;
            font-size: 35px;
            font-weight: 700;
            text-transform: capitalize;
            margin-bottom: 25px;
        }

        .section-heading .line-dec {
            width: 50px;
            height: 2px;
            background-color: #4da6e7;
        }

        .border-first-button button {
            display: inline-block !important;
            padding: 10px 20px !important;
            color: #4da6e7 !important;
            border: 1px solid #4da6e7 !important;
            border-radius: 23px;
            font-weight: 500 !important;
            letter-spacing: 0.3px !important;
            transition: all .5s;
            background-color: #fff;
            margin-top: 30px;
            margin-left: 10px;
        }



        .border-first-button button:hover {
            background-color: #4da6e7;
            color: #fff !important;
        }

        /* 
	---------------------------------------------
	header
	--------------------------------------------- 
	*/


        .header-area {
            background-color: #fff;
            box-shadow: 0px 5px 8px rgba(0, 0, 0, 0.03);
        }

        .header-area .main-nav .logo {
            line-height: 100px;
            float: left;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        .header-area .main-nav .nav {
            float: left;
            margin-top: 30px;
            margin-right: 0px;
            background-color: transparent;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            position: relative;
            z-index: 999;
        }

        .header-area .main-nav .nav li {
            padding-left: 20px;
            padding-right: 20px;
        }

        .header-area .main-nav .nav li a {
            display: block;
            font-weight: 500;
            font-size: 15px;
            color: #2a2a2a;
            text-transform: capitalize;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            height: 40px;
            line-height: 40px;
            border: transparent;
            letter-spacing: 1px;
        }

        .header-area .main-nav .nav li:hover a,
        .header-area .main-nav .nav li a.active {
            color: #4da6e7 !important;
        }


        /* 
	---------------------------------------------
	profile
	--------------------------------------------- 
	*/
        .padding {
            padding: 3rem !important
        }

        .user-card-full {
            overflow: hidden;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            border: none;
            margin-bottom: 30px;
            max-width: auto;
        }

        .m-r-0 {
            margin-right: 0px;
        }

        .m-l-0 {
            margin-left: 0px;
        }

        .user-card-full .user-profile {
            border-radius: 5px 0 0 5px;
        }

        .bg-c-lite-green {
            background: -webkit-gradient(linear, left top, right top, from(#1e4c9e), to(#709ae0));
            background: linear-gradient(to right, #1e4c9e, #709ae0);
        }

        .user-profile {
            padding: 20px 0;
        }

        .card-block {
            padding: 1.25rem;
        }

        .m-b-25 {
            margin-bottom: 25px;
        }

        .img-radius {
            border-radius: 5px;
            width: 150px;
            height: 150px;
        }

        .card .card-block p {
            line-height: 25px;
        }

        @media only screen and (min-width: 1400px) {
            p {
                font-size: 14px;
            }
        }

        .card-block {
            padding: 1.25rem;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .m-b-20 {
            margin-bottom: 20px;
            text-transform: uppercase;
            font-size: 18px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .card .card-block p {
            line-height: 25px;
        }

        .m-b-10 {
            margin-bottom: 10px;
            color: black;
            margin-top: 30px;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .f-w-600 {
            font-weight: 20px;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
            font-weight: bold;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .user-card-full .social-link li {
            display: inline-block;
        }

        .user-card-full .social-link li a {
            font-size: 20px;
            margin: 0 10px 0 0;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        /* 
	---------------------------------------------
	preloader
	--------------------------------------------- 
	*/

        .js-preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            display: -webkit-box;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            opacity: 1;
            visibility: visible;
            z-index: 9999;
            -webkit-transition: opacity 0.25s ease;
            transition: opacity 0.25s ease;
        }

        .js-preloader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        @-webkit-keyframes dot {
            50% {
                -webkit-transform: translateX(96px);
                transform: translateX(96px);
            }
        }

        @keyframes dot {
            50% {
                -webkit-transform: translateX(96px);
                transform: translateX(96px);
            }
        }

        @-webkit-keyframes dots {
            50% {
                -webkit-transform: translateX(-31px);
                transform: translateX(-31px);
            }
        }

        @keyframes dots {
            50% {
                -webkit-transform: translateX(-31px);
                transform: translateX(-31px);
            }
        }

        .preloader-inner {
            position: relative;
            width: 142px;
            height: 40px;
            background: #fff;
        }

        .preloader-inner .dot {
            position: absolute;
            width: 16px;
            height: 16px;
            top: 12px;
            left: 15px;
            background: #4da6e7;
            border-radius: 50%;
            -webkit-transform: translateX(0);
            transform: translateX(0);
            -webkit-animation: dot 2.8s infinite;
            animation: dot 2.8s infinite;
        }

        .preloader-inner .dots {
            -webkit-transform: translateX(0);
            transform: translateX(0);
            margin-top: 12px;
            margin-left: 31px;
            -webkit-animation: dots 2.8s infinite;
            animation: dots 2.8s infinite;
        }

        .preloader-inner .dots span {
            display: block;
            float: left;
            width: 16px;
            height: 16px;
            margin-left: 16px;
            background: #4da6e7;
            border-radius: 50%;
        }

        a {
            color: #0d6efd;
            text-decoration: none;
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

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="profil.php" class="logo">
                            <img src="assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
                            <img src="assets/images/logo.jpeg" alt="logoLKTN" style="width: 120px; height: auto;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="homepage.php">Laman Utama</a></li>
                            <li class="scroll-to-section"><a href="tempahan.php">Tempah</a></li>
                            <li class="scroll-to-section"><a href="sewaan.php">Sewaan</a></li>
                            <li class="scroll-to-section"><a href="profil.php" class="active">Profil</a></li>
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

    <!-- ***** Profile ***** -->
    <div class="page-content page-container d-flex justify-content-center align-items-center wow fadeIn"
        data-wow-duration="0.75s" data-wow-delay="0s" id="page-content" style="min-height: 100vh;">
        <div class="row container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-xl-8 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white d-flex justify-content-center align-items-center"
                                style="height: 100%;">
                                <div class="m-b-25">
                                    <img src="assets/images/profil.png" class="img-radius" alt="User-Profile-Image"
                                        style="width: 170px; height: 170px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nama Penuh</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;"><?php echo htmlspecialchars($nama); ?></h6>

                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nombor Kad Pengenalan</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;"><?php echo htmlspecialchars($no_kp); ?></h6>

                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nombor Telefon</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;"><?php echo htmlspecialchars($contact_no); ?></h6>
                                <div class="text-end border-first-button">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#changeEditModal">
                                        Kemaskini
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div class="modal fade" id="changeEditModal" tabindex="-1" aria-labelledby="changeEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeEditModalLabel">Edit Maklumat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="controller/auth/profile_process.php">
                        <div class="mb-3">
                            <label for="currentName" class="form-label">Nama Penuh</label>
                            <input type="text" class="form-control" id="currentName" name="nama" value="<?php echo $nama ?>">
                        </div>
                        <div class="mb-3">
                            <label for="currentNoKp" class="form-label">Nombor Kad Pengenalan</label>
                            <input type="text" class="form-control" id="currentNoKp" name="no_kp" value="<?php echo $no_kp ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="currentNoTel" class="form-label">Nombor Telefon</label>
                            <input type="text" class="form-control" id="currentNoTel" name="contact_no" value="<?php echo $contact_no ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" form="editForm" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

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