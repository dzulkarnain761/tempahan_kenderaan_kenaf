<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
		rel="stylesheet">
    <title>Borang Laporan Pemeriksaan Traktor</title>

    <!-- External CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Internal Styles -->
    <style>
        body {
             font-family: 'Poppins', sans-serif;
            background-color: #f4f7f9;
        }

        .container {
            display: flex;
        }

        .navigation {
            width: 250px;
            background: #2a2185;
            color: #ecf0f1;
            min-height: 100vh;
            padding: 20px;
        }

        .navigation ul {
            list-style-type: none;
            padding: 0;
        }

        .navigation ul li {
            margin: 20px 0;
        }

        .navigation ul li a {
            color: #ecf0f1;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .navigation ul li a:hover {
            background: #ecf0f1;
        }

        .navigation .title {
            margin-left: 10px;
            font-size: 15px;

        }

        .main {
            flex: 1;
            padding: 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #2a2185;
            color: #ecf0f1;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

		.userName {
			display: flex;
			align-items: center; /* Vertically centers the items */
	}
        .topbar .userName .user-name {
            margin-right: 10px;
            font-weight: bold;
        }

        .form-container {
			max-width: 1200px;
			width: 100%;
			padding: 20px;
			background-color: #fff;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			margin: 0 auto; /* Centers the container horizontally */
			}

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            text-align: center;
            border: 1px solid #ddd;
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        td {
            background-color: #fafafa;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            width: 350px;
            height: 70px;
            resize: vertical;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 12px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .textarea-wrapper {
			position: relative;
            display: flex;
            justify-content: center;
        }

        .textarea-wrapper textarea {
            width: 100%;
        }
		:root{
			--skyblue:#d0e5f5;
		}
    </style>
</head>

<body>
    <!-- Navigation -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="laporanSerahPulang.php">
                        <img src="assets/images/logo2.png" alt="Brand Logo" style="margin-top: 10px; width:60px; height:60px;">
                        <span class="title">LKTNBooking</span>
                    </a>
                </li>
                <li>
                    <a href="laporanSerahPulang.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="profil.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Staff</span>
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

        <!-- Main Content -->
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

            <!-- Form Container -->
            <div class="form-container">
                <h2>Borang Laporan Pemeriksaan Penyerahan dan Pemulangan Traktor</h2>

                <form action="#" method="post">
                    <table>
                        <!-- Form Table Rows Here -->
                        <tr>
                            <th>Bil</th>
                            <th>Perkara</th>
                            <th>Keadaan Semasa Penyerahan</th>
                            <th>Keadaan Semasa Pemulangan</th>
                            <th>Ulasan Mekanik</th>
                        </tr>
                        <!-- Repeat rows as needed -->
                        <!-- Example Row -->
                        <tr>
                            <td>1</td>
                            <td>Minyak Enjin</td>
                            <td>
                                <input type="radio" name="penyerahan_minyak_enjin_1" value="baik"> Baik
                                <input type="radio" name="penyerahan_minyak_enjin_1" value="rosak"> Rosak
                            </td>
                            <td>
                                <input type="radio" name="pemulangan_minyak_enjin_1" value="baik"> Baik
                                <input type="radio" name="pemulangan_minyak_enjin_1" value="rosak"> Rosak
                            </td>
                            <td class="textarea-wrapper">
                                <textarea name="ulasan_minyak_enjin_1"></textarea>
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

                    <input type="submit" value="Hantar">
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
</body>

</html>
