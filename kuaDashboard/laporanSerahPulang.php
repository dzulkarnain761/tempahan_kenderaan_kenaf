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
	<style>
		
		
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

        .recentOrders form table tr {
            color: var(--black1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .recentOrders form table tr:last-child {
            border-bottom: none;
        }

        .recentOrders form table tbody tr:hover {
            background: var(--white);
            color: var(--black);
        }

        .recentOrders form table tr td {
            padding: 10px;
        }

        .recentOrders form table tr td:last-child {
            text-align: center;
        }

        .recentOrders form table tr td:nth-child(2) {
            text-align: center;
        }

        .recentOrders form table tr td:nth-child(3) {
            text-align: center;
        }
		
		textarea {
			width: 350px; 
			height: 70px; 
			resize: vertical; 
		}
		
		
</style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="laporanSerahPulang.php">
                        <img src="../assets/images/logo2.png" alt="Brand Logo" style="margin-top: 10px; width:60px; height:60px;">
						<span class="title" style="margin-top: 10px; font-size: 18px;">LKTNBooking</span>
                    </a>
                </li>

                <li>
                    <a href="laporanSerahPulang.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
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
		
		 <!-- ======================= Laporan ================== -->
		 <div class="recentOrders">
			<h2>Borang Laporan Pemeriksaan Penyerahan dan Pemulangan Traktor</h2>
			<form action="laporanSerahPulang.php" method="post">
				<table>
				  <thead>
					<tr>
						<td>Bil</td>
						<td>Perkara</td>
						<td>Keadaan Semasa Penyerahan</td>
						<td>Keadaan Semasa Pemulangan</td>
						<td>Ulasan Mekanik</td>
					</tr>
				   </thead>
					<tr>
						<td>1</td>
						<td>Minyak Enjin</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td class="textarea-wrapper">
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>

						<td>2</td>
						<td>Minyak Steering</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
					<tr>
						<td>3</td>
						<td>Minyak Hidraulik</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
					<tr>
						<td>4</td>
						<td>Minyak brek</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				   <tr>
						<td>5</td>
						<td>Air Radiator</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				   <tr>
						<td>6</td>
						<td>Air Bateri</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				   <tr>
						<td>7</td>
						<td>Bolt atau Nat Tayar</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				   <tr>
						<td>8</td>
						<td>Brek Tangan</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				   <tr>
						<td>9</td>
						<td>Lampu Signal</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				   <tr>
						<td>10</td>
						<td>Lampu Brek</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				   <tr>
						<td>11</td>
						<td>Tali Sawat (Alternator, Pam Air dan Steering)</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				   <tr>
						<td>12</td>
						<td>Bahan Api</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				   <tr>
						<td>13</td>
						<td>Minyak Gris</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				   <tr>
						<td>14</td>
						<td>Kebersihan</td>
						<td>
							<input type="radio" name="penyerahan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="penyerahan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<input type="radio" name="pemulangan_minyak_enjin" value="baik"> Baik
							<input type="radio" name="pemulangan_minyak_enjin" value="rosak"> Rosak
						</td>
						<td>
							<textarea name="ulasan_minyak_enjin" rows="4"></textarea>
						</td>
					</tr>
				   
				</table>
				<button type="submit" class="btn btn-primary" style="margin-top: 30px;">
                   Hantar
                </button>
			</form>
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