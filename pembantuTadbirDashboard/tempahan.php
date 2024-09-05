<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
	<style>
	</style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="tempahan.php">
                        <img src="../assets/images/logo2.png" alt="Brand Logo" style="margin-top: 10px; width:60px; height:60px;">
						<span class="title" style="margin-top: 10px; font-size: 18px;">LKTNBooking</span>
                    </a>
                </li>

                <li>
                    <a href="tempahan.php">
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
						<img src="../assets/images/user.png" alt="User Image">
					</div>
				</div>
			</div>
			
			<div class="recentOrders">
				<div class="cardHeader">
					<h2>Pembayaran</h2>
				</div>
				<table>
					<thead>
						<tr>
							<td>Bil</td>
							<td>Nama Pemohon</td>
							<td>Lokasi Projek</td>
							<td>Tarikh Kerja</td>
							<td>Bayaran Pendahuluan</td>
							<td>Bayaran Keseluruhan</td>
							<td>Maklumat</td>
							<td>Tindakan</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Ahmad Bin Ali</td>
							<td>Kelantan</td>
							<td>21/06/2024</td>
							<td>RM 50</td>
							<td>RM 100</td>
							<td><a href="file.pdf" target="_blank">Lihat PDF</a></td>
							<td>
								<form method="POST" action="#">
									<input type="hidden" name="id_permohonan" value="1">
									<button type="submit" name="tindakan" value="terima"
										class="btn btn-success">Terima</button>
									<button type="submit" name="tindakan" value="tolak"
										class="btn btn-danger">Tolak</button>
								</form>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>