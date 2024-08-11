<?php
session_start();

if (!isset($_SESSION["kumpulan"]) || $_SESSION["kumpulan"] !== 'X') {
    header("Location: login.php");
    exit();
}

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Booking</title>
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
            float: right;
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


        .table-responsive {
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .thead-dark th {
            background-color: #343a40;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }

        .border-first-button button {
            border: 2px solid #343a40;
            padding: 5px 10px;
            background-color: transparent;
            color: #343a40;
            cursor: pointer;
        }

        .kotak {
            border: solid grey 2px;
            padding: 15px;
            background-color: #f9f9f9;
            margin: 20px auto;
            max-width: 60%;
            box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.19), 0 20px 20px 0 rgba(0, 0, 0, 0.19);
            margin-top: 60px;
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
                            <li class="scroll-to-section">
                                <div class="border-first-button">
                                    <button onclick="location.href='login.php'">Logout</button>
                                </div>
                            </li>
                        </ul>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
    </header>
    <!-- ***** Header Area End ***** -->
    <div class=" wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
        <div class="kotak">
            <h3 class="text-center fw-bold" style="margin-top: 30px; margin-below: 30px;">MAKLUMAT SEWAAN</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nama Penyewa</th>
                            <th>Item Disewa</th>
                            <th>Tarikh Mula</th>
                            <th>Tarikh Akhir</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ali Bin Abu</td>
                            <td>Projekor</td>
                            <td>01/08/2024</td>
                            <td>05/08/2024</td>
                            <td>RM 200.00</td>
                            <td>Disahkan</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Fatimah Binti Ali</td>
                            <td>Kerusi</td>
                            <td>03/08/2024</td>
                            <td>06/08/2024</td>
                            <td>RM 150.00</td>
                            <td>Dalam Proses</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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