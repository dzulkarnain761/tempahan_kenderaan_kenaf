<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <title>Booking</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
	<style>
	:root {
		--skyblue: #d0e5f5;
}

.details .recentOrders table tbody tr:hover {
  background: var(--white);
  color: var(--black);
}
	
	.details table thead td {
		background: var(--blue);
		color: var(--white);
		font-size: 18px;
}

.details table tbody {
		font-size: 18px;
}

</style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="dashboard.php">
                        <img src="assets/images/logo2.png" alt="Brand Logo" style="margin-top: 10px; width:60px; height:60px;">
						<span class="title" style="margin-top: 10px; font-size: 18px;">LKTNBooking</span>
                    </a>
                </li>

                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="staff.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Staff</span>
                    </a>
                </li>

                <li>
                    <a href="kenderaan.php">
                        <span class="icon">
                            <ion-icon name="car-outline"></ion-icon>
                        </span>
                        <span class="title">Kenderaan</span>
                    </a>
                </li>

                <li>
                    <a href="pemandu.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Pemandu</span>
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
                    <a href="tetapan.php">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Tetapan</span>
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
			
			<!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">100</div>
                        <div class="cardName">Tempahan</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="book-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">10</div>
                        <div class="cardName">Staf</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">15</div>
                        <div class="cardName">Kenderaan</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="car-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">10</div>
                        <div class="cardName">Pemandu</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>
            </div>
			
			<!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Kerja Berjalan</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
								<td>Bil</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Payment</td>
                                <td>Status</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
								<td>1</td>
                                <td>Star Refrigerator</td>
                                <td>$1200</td>
                                <td>Paid</td>
                                <td><span class="status delivered">Delivered</span></td>
                            </tr>

                            <tr>
								<td>2</td>
                                <td>Dell Laptop</td>
                                <td>$110</td>
                                <td>Due</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>

                            <tr>
								<td>3</td>
                                <td>Apple Watch</td>
                                <td>$1200</td>
                                <td>Paid</td>
                                <td><span class="status return">Return</span></td>
                            </tr>

                            <tr>
								<td>4</td>
                                <td>Addidas Shoes</td>
                                <td>$620</td>
                                <td>Due</td>
                                <td><span class="status inProgress">In Progress</span></td>
                            </tr>

                            <tr>
                                <td>5</td>
								<td>Star Refrigerator</td>
                                <td>$1200</td>
                                <td>Paid</td>
                                <td><span class="status delivered">Delivered</span></td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>Dell Laptop</td>
                                <td>$110</td>
                                <td>Due</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>

                            <tr>
                                <td>7</td>
                                <td>Apple Watch</td>
                                <td>$1200</td>
                                <td>Paid</td>
                                <td><span class="status return">Return</span></td>
                            </tr>

                            <tr>
                                <td>8</td>
                                <td>Addidas Shoes</td>
                                <td>$620</td>
                                <td>Due</td>
                                <td><span class="status inProgress">In Progress</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	
	

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
</body>

</html>