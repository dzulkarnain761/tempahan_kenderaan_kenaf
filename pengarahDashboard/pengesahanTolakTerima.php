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
        <?php
        include 'partials/navigation.php';
        ?>

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

			<!-- ======================= Pengesahan ================== -->
			<div class="recentOrders">
				<div class="cardHeader">
					<h2>Pengesahan Permohonan</h2>
				</div>
				<table>
					<thead>
						<tr>
							<td>Bil</td>
							<td>Nama Pemohon</td>
							<td>Lokasi Projek</td>
							<td>Jenis Kerja</td>
							<td>Keluasan Tanah (Hektar)</td>
							<td>Maklumat</td>
							<td>Tindakan</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Ahmad Bin Ali</td>
							<td>Kelantan</td>
							<td>Piring</td>
							<td>5.5</td>
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
	<script src="js/main.js"></script>

	<!-- ====== ionicons ======= -->
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>