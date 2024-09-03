<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>eBooking</title>
	<link rel="icon" type="image/x-icon" href="images/logo2.png">
    <link rel="stylesheet" href="css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
		rel="stylesheet">
</head>

<body>
	<!-- =============== Navigation ================ -->
	<div class="container">
		<div class="navigation">
			<ul>
				<li>
					<a href="profile.php">
						<img src="images/logo2.png" alt="Brand Logo"
							style="margin-top: 10px; width:60px; height:60px;">
						<span class="title" style="margin-top: 10px; font-size: 18px;">LKTNBooking</span>
					</a>
				</li>

				<li>
					<a href="pengesahanTolakTerima.php">
						<span class="icon">
							<ion-icon name="document-text-outline"></ion-icon>
						</span>
						<span class="title">Pengesahan</span>
					</a>
				</li>

				<li>
					<a href="profile.php">
						<span class="icon">
							<ion-icon name="person-circle-outline"></ion-icon>
						</span>
						<span class="title">Profile</span>
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
						<img src="images/user.png" alt="User Image">
					</div>
				</div>
			</div>

			<div class="recentOrders">
				<div class="cardHeader">
					<h2>MAKLUMAT</h2>
				</div>
				<section class="profile-section">
					<div class="profile-image">
						<img src="images/user.png" alt="Admin Profile Picture">
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
						<button type="button" class="btn btn-primary"
							onclick="window.location.href = 'tukarKataLaluan.php'">
							Tukar Kata Laluan
						</button>
						<button type="button" class="btn btn-primary"
							onclick="window.location.href = 'kemaskiniProfile.php'">
							Kemaskini
						</button>
					</div>
				</section>
			</div>
		</div>
	</div>

	<!-- =========== Scripts =========  -->
	<script src="js/main.js"></script>

	<!-- ====== ionicons ======= -->
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>