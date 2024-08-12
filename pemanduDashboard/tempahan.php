<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    
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
		}
		table thead td {
			background: var(--blue);
			color: var(--white);
			font-size: 18px;
		}
		table tbody {
				font-size: 18px;
		}
		.recentOrders table tr {
		  color: var(--black1);
		  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		}
		.recentOrders table tr:last-child {
		  border-bottom: none;
		}
		.recentOrders table tbody tr:hover {
		  background: var(--white);
		  color: var(--black);
		}
		.recentOrders table tr td {
		  padding: 10px;
		}
		.recentOrders table tr td:last-child {
		  text-align: center;
		}
		.recentOrders table tr td:nth-child(2) {
		  text-align: center;
		}
		.recentOrders table tr td:nth-child(3) {
		  text-align: center;
		}
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
						<img src="assets/images/user.png" alt="User Image">
					</div>
				</div>
			</div>
			
			<!-- ================ Order Details List ================= -->
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Tempahan</h2>
                </div>

                <table>
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Nama Penyewa</td>
                            <td>Lokasi</td>
                            <td>Tarikh Kerja</td>
							<td>Maklumat</td>
                            <td>Status</td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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