<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ================== Table details ============== */
        .recentOrders {
            position: relative;
            background: var(--white);
            padding: 20px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }

        .recentOrders h2 {
            margin-top: 20px;
            margin-bottom: 50px;
            border-bottom: 2px solid #e0e0e0;
        }

        .profile-section {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .profile-image {
            flex: 0 0 100px;
            margin-right: 20px;
        }

        .profile-details {
            flex: 1;
        }

        .text-muted {
            color: #919aa3 !important;
        }
		
		.profile-details h4 {
            margin-bottom: 20px;
        }
		
		.profile-details p {
            margin-bottom: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .recentOrders {
                margin: 20px 10px;
                padding: 15px;
            }

            .profile-section {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .profile-image {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 480px) {
            .recentOrders h2 {
                margin-bottom: 30px;
            }

            .profile-details h4 {
                margin-bottom: 20px;
            }

            .profile-image {
                flex: 0 0 80px;
            }
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="profile.php">
                        <img src="../assets/images/logo2.png" alt="Brand Logo" style="margin-top: 10px; width:60px; height:60px;">
						<span class="title" style="margin-top: 10px; font-size: 18px;">LKTNBooking</span>
                    </a>
                </li>

                <li>
                    <a href="laporanSerahPulang.php">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Laporan</span>
                    </a>
                </li>

                <li>
                    <a href="profile.php">
                        <span class="icon">
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Profil</span>
                    </a>
                </li>

                <li>
                    <a href="../login.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="userName">
                    <div class="user-name">NAMA BINTI PENUH</div>
                    <div class="user">
                        <img src="assets/images/user.png" alt="User Image">
                    </div>
                </div>
            </div>

            <div class="recentOrders">
                <h2>Maklumat</h2>
                <section class="profile-section">
                    <div class="profile-image">
                        <img src="assets/images/user.png" alt="Admin Profile Picture">
                    </div>
                    <div class="profile-details">
                        <p>Nama Penuh :</p>
                        <h4 class="text-muted">NAMA BIN PENUH</h4>
                        <p>Nombor Kad Pengenalan :</p>
                        <h4 class="text-muted">000000-00-0000</h4>
                        <p>Nombor Telefon :</p>
                        <h4 class="text-muted">000-0000000</h4>
                    </div>
					<div class="text-end">
						<!-- Button to trigger modal -->
						<button type="button" class="btn btn-primary" onclick="window.location.href = 'tukarKataLaluanKUA.php'">
							Tukar Kata Laluan
						</button>
						<button type="button" class="btn btn-primary" onclick="window.location.href = 'kemaskiniProfileKUA.php'">
							Kemaskini
						</button>
					</div>
                </section>
            </div>

        </div>

        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </div>
</body>

</html>
