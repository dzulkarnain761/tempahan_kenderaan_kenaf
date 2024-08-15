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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
            text-align: center;
        }

        .cardHeader {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .cardHeader h2 {
            font-weight: 600;
            color: var(--blue);
            text-transform: uppercase;
        }

        .cardHeader .btn {
            position: relative;
            padding: 5px 10px;
            background: var(--blue);
            text-decoration: none;
            color: var(--white);
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #F5F5F5;
            border: 1px solid #ddd;
        }

        table thead td {
            background: var(--blue);
            color: var(--white);
            font-size: 18px;
            border: 1px solid #ddd;
        }

        table tbody {
            font-size: 18px;
            border: 1px solid #ddd;
        }

        .recentOrders table tr {
            color: var(--black1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        .recentOrders table tr:last-child {
            border-bottom: none;
            border: 1px solid #ddd;
        }

        .recentOrders table tbody tr:hover {
            background: var(--white);
            color: var(--black);
            border: 1px solid #ddd;
        }

        .recentOrders table tr td {
            padding: 10px;
            border: 1px solid #ddd;
        }
		
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
		.btn {
			display: inline-block;
			font-weight: 400;
			text-align: center;
			vertical-align: middle;
			border: 1px solid transparent;
			padding: .375rem .75rem;
			font-size: 1rem;
			border-radius: .25rem;
			transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
		}
	</style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="custom-container">
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
			
			<!-- ======================= Pengesahan ================== -->
			<div class="recentOrders">
				<div class="cardHeader">
					<h2>Pengesahan Tempahan Sewaan per Jam atau Harian </h2>
				</div>
				<table>
					<thead>
						<tr>
							<td>Bil</td>
							<td>Nama Penyewa</td>
							<td>Perkhidmatan</td>
							<td>Keluasan Tanah (Hektar)</td>
							<td>Lokasi Kerja</td>
							<td>Jenis Kerja</td>
							<td>Tindakan</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Ahmad Bin Ali</td>
							<td>perkhidmatan</td>
							<td>5.5</td>
							<td>lokasi kerja</td>
							<td>jenis kerja</td>
							<td>
								<form method="POST" action="pengesahanTolakTerima.php" id="confirmationForm">
									<input type="hidden" name="id_permohonan" value="1">
									<button type="button" class="btn btn-success" id="btnTerima">Terima</button>
									<button type="button" class="btn btn-danger" id="btnTolak">Tolak</button>
								</form>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>