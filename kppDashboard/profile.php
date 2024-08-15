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
            display: grid;
            min-height: 500px;
            background: var(--white);
            padding: 20px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            margin-top: 30px;
            margin-left: 30px;
            margin-right: 30px;
			padding: 20px 28px;
        }

        .recentOrders h2 {
            margin-top: 20px;
            margin-bottom: 50px;
			color: var(--blue);
			font-weight: 600;
			font-size: 34px;
        }

        .profile-section {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .profile-image {
            margin-right: 20px;
			margin-top: 20px;
        }

        .profile-details {
            flex: 1;
			margin-left: 40px;
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

		.btn {
			background-color: #007bff;
			color: #fff;
			border: none;
			padding: 9px 12px;
			margin-left: 10px; /* Add spacing between buttons */
			border-radius: 8px;
			transition: background-color 0.3s ease, transform 0.3s ease;
			font-size: 15px;
		}

		.btn:hover {
			background-color: #0056b3;
			transform: translateY(-2px);
		}
		
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <img src="assets/images/logo2.png" alt="Brand Logo" style="margin-top: 10px; width:60px; height:60px;">
						<span class="title" style="margin-top: 10px; font-size: 18px;">LKTNBooking</span>
                    </a>
                </li>

                
                <li>
                    <a href="pengesahanTolakTerima.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Tempahan</span>
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
                <h2>MAKLUMAT</h2>
                <section class="profile-section">
                    <div class="profile-image">
                        <img src="assets/images/user.png" alt="Admin Profile Picture">
                    </div>
                    <div class="profile-details">
                        <p>Email :</p>
                        <h4 class="text-muted">abc@gmail.com</h4>
						<p>Nama Penuh :</p>
                        <h4 class="text-muted">NAMA BIN PENUH</h4>
                        <p>Nombor Kad Pengenalan :</p>
                        <h4 class="text-muted">000000-00-0000</h4>
                        <p>Nombor Telefon :</p>
                        <h4 class="text-muted">000-0000000</h4>
                    </div>
					<div class="text-end">
						<!-- Button to trigger modal -->
						<button type="button" class="btn btn-primary" onclick="window.location.href = 'tukarKataLaluan.php'">
							Tukar Kata Laluan
						</button>
						<button type="button" class="btn btn-primary" onclick="window.location.href = 'kemaskiniProfile.php'">
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
