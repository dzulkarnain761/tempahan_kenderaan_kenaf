<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        h2, h3 {
            margin-bottom: 15px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .cardHeader {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 0.9em;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="tel"],
        .form-group input[type="password"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            box-sizing: border-box;
        }

        .form-group input[type="submit"],
        .form-group input[type="button"] {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 10px;
            transition: background-color 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group input[type="submit"]:hover,
        .form-group input[type="button"]:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-edit,
        .btn-delete {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            font-size: 1.2em;
        }

        .btn-edit {
            color: #28a745;
        }

        .btn-edit:hover {
            color: #218838;
        }

        .btn-delete {
            color: #c82333;
        }

        .btn-delete:hover {
            color: #bd2130;
        }

        .btn-update,
        .btn-daftar {
            background-color: #28a745;
            color: white;
            border: none;
            font-size: 1em;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-update:hover,
        .btn-daftar:hover {
            background-color: #218838;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 90%;
            }
        }
		
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

            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>SENARAI KENDERAAN</h2>
                        <a class="btn" onclick="openModal()">DAFTAR KENDERAAN</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Bil</td>
                                <td>Nama Kenderaan</td>
                                <td>No Pendaftaran</td>
                                <td>Tarikh Tamat</td>
                                <td>Kemaskini</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button onclick="editItem(this)" class="btn btn-edit">
                                        <i class="fas fa-edit" style="font-size: 1.5em;"></i>
                                    </button>
                                    <button onclick="deleteItem(this)" class="btn btn-delete">
                                        <i class="fas fa-trash-alt" style="font-size: 1.5em;"></i>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <!-- Register Modal -->
<div id="registerModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>DAFTAR KENDERAAN</h3>
        <form id="registerForm">
            <div class="form-group">
                <label for="adminKenderaan">ADMIN KENDERAAN:</label>
                <input type="text" id="adminKenderaan" name="adminKenderaan" placeholder="Admin Kenderaan" required>
            </div>
            <div class="form-group">
                <label for="namaJenisKenderaan">NAMA / JENIS KENDERAAN:</label>
                <input type="text" id="namaJenisKenderaan" name="namaJenisKenderaan" placeholder="Masukkan nama kenderaan" required>  
            </div>
            <div class="form-group">
                <label for="noDaftar">NO PENDAFTARAN KENDERAAN:</label>
                <input type="text" id="noDaftar" name="noDaftar" placeholder="Masukkan no pendaftaran" required>
            </div>
			
			<div class="form-group">
                <label for="tahunDaftar">TAHUN DAFTAR:</label>
                <input type="text" id="tahunDaftar" name="tahunDaftar" placeholder="Masukkan tahun daftar kenderaan" required>
            </div>
			
			<div class="form-group">
                <label for="tarikhDaftar">TARIKH DAFTAR:</label>
                <input type="date" id="tarikhDaftar" name="tarikhDaftar" required>
            </div>
			
			<div class="form-group">
                <label for="mulaCukaiJalan">MULA CUKAI JALAN:</label>
                <input type="date" id="mulaCukaiJalan" name="mulaCukaiJalan" required>
            </div>

			<div class="form-group">
                <label for="tamatCukaiJalan">TAMAT CUKAI JALAN:</label>
                <input type="date" id="tamatCukaiJalan" name="tamatCukaiJalan" required>
            </div>
			
            <div class="form-group">
                <label for="negeriPenempatan">NEGERI / PENEMPATAN:</label>
				<select id="negeriPenempatan" name="negeriPenempatan" required>
					<option value="" disabled selected>--Pilih Negeri--</option>
					<option value="Kelantan">Kelantan</option>
					<option value="Terengganu">Terengganu</option>
					<option value="Pahang">Pahang</option>
					<option value="Kedah">Kedah</option>
					<option value="Perlis">Perlis</option>
					<option value="Perak">Perak</option>
					<option value="Selangor">Selangor</option>
					<option value="Melaka">Melaka</option>
					<option value="Johor">Johor</option>
					<option value="Sabah">Sabah</option>
					<option value="Sarawak">Sarawak</option>
				</select>
			</div>
			
            <div class="form-group">
                <label for="kawasan">KAWASAN:</label>
                <select id="kawasan" name="kawasan" required>
                    <option value="" disabled selected>--Pilih Kawasan--</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>
			
			<div class="form-group">
                <label for="statusKenderaan">STATUS KENDERAAN:</label>
                <select id="statusKenderaan" name="statusKenderaan" required>
                    <option value="" disabled selected>--Pilih Status Kenderaan--</option>
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>
					
            <div class="form-group">
                <label for="kategoriKenderaan">KATEGORI KENDERAAN:</label>
                <select id="kategoriKenderaan" name="kategoriKenderaan" required>
                    <option value="" disabled selected>--Pilih Kategori Kenderaan--</option>
                    <option value="Jentera">Jentera</option>
                    <option value="Jengkaut">Jengkaut</option>
                </select>
            </div>
            <input type="button" value="DAFTAR" class="btn btn-daftar" onclick="saveChanges()">
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>KEMASKINI KENDERAAN</h2>
        <form id="editForm">
            <div class="form-group">
                <label for="adminKenderaanEdit">ADMIN KENDERAAN:</label>
                <input type="text" id="adminKenderaanEdit" name="adminKenderaan" placeholder="adminKenderaan" readonly>
            </div>
			
            <div class="form-group">
                <label for="namaJenisKenderaanEdit">NAMA / JENIS KENDERAAB:</label>
                <input type="text" id="namaJenisKenderaanEdit" name="namaJenisKenderaan" placeholder="Masukkan nama kenderaan" required>
            </div>
			
            <div class="form-group">
                <label for="noDaftarEdit">NO PENDAFTARAN KENDERAAN:</label>
                <input type="text" id="noDaftarEdit" name="noDaftar" placeholder="Masukkan no pendaftaran kenderaan" >
            </div>
			
            <div class="form-group">
                <label for="tahunDaftaredit">TAHUN DAFTAR:</label>
                <input type="text" id="tahunDaftarEdit" name="tahunDaftar" placeholder="Masukkan tahun daftar kenderaan" >
            </div>
			
            <div class="form-group">
                <label for="tarikhDaftarEdit">TARIKH DAFTAR:</label>
                <input type="date" id="tarikhDaftarEdit" name="tarikhDaftar" required>
                    
            </div>
			
            <div class="form-group">
                <label for="mulaCukaiJalanEdit">MULA CUKAI JALAN:</label>
                <input type="date" id="mulaCukaiJalanEdit" name="mulaCukaiJalan" required>
            </div>
			
			<div class="form-group">
                <label for="tamatCukaiJalanEdit">TAMAT CUKAI JALAN:</label>
                <input type="date" id="tamatCukaiJalanEdit" name="tamatCukaiJalan" required>
            </div>
			
			<div class="form-group">
				<label for="negeriPenempatanEdit">NEGERI / PENEMPATAN:</label>
				<select id="negeriPenempatanEdit" name="negeriPenempatan" required>
					<option value="" disabled selected>--Pilih Negeri--</option>
					<option value="Kelantan">Kelantan</option>
					<option value="Terengganu">Terengganu</option>
					<option value="Pahang">Pahang</option>
					<option value="Kedah">Kedah</option>
					<option value="Perlis">Perlis</option>
					<option value="Perak">Perak</option>
					<option value="Selangor">Selangor</option>
					<option value="Melaka">Melaka</option>
					<option value="Johor">Johor</option>
					<option value="Sabah">Sabah</option>
					<option value="Sarawak">Sarawak</option>
				</select>
			</div>
			
			<div class="form-group">
                <label for="kawasanEdit">KAWASAN:</label>
                <select id="kawasanEdit" name="kawasan" required>
                    <option value="" disabled selected>--Pilih Kawasan--</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                </select>
            </div>
			
            <div class="form-group">
                <label for="statusKenderaanEdit">STATUS:</label>
                <select id="statusKenderaanEdit" name="statusKenderaan" required>
                    <option value="" disabled selected>--Pilih Status--</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
			
			<div class="form-group">
                <label for="kategoriKenderaanEdit">KATEGORI KENDERAAN:</label>
                <select id="kategoriKenderaanEdit" name="kategorikenderaan" required>
                    <option value="" disabled selected>--Pilih Status--</option>
                    <option value="Jentera">Jentera</option>
                    <option value="Jengkaut">Jengkaut</option>
                </select>
            </div>
			
            <input type="button" value="KEMASKINI" class="btn btn-update" onclick="saveChanges()">
        </form>
    </div>
</div>

    </div>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        function openModal() {
            document.getElementById('registerModal').style.display = "block";

        }

        function closeModal() {
            document.getElementById('registerModal').style.display = "none";
            document.getElementById('editModal').style.display = "none";
        }

        function editItem(button) {
            var row = button.parentNode.parentNode;
            var namaJenisKenderaan = row.cells[0].innerText;
            var noDaftar = row.cells[1].innerText;
            var tahundaftar = row.cells[2].innerText;
            var tarikhDaftar = row.cells[3].innerText;
			var mulaCukaiJalan = row.cells[4].innerText;

			
            document.getElementById('namaJenisKenderaanEdit').value = namaJenisKenderaan;
            document.getElementById('noDaftarEdit').value = noDaftar;
            document.getElementById('tahunDaftarEdit').value = tahundaftar;
			document.getElementById('tarikhDaftarEdit').value = tarikhDaftar;
			document.getElementById('mulaCukaiJalanEdit').value = mulaCukaiJalan;

			
			document.getElementById('editModal').style.display = "block";
		}
		
        function deleteItem(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function saveChanges() {
            closeModal();
        }
    </script>
</body>

</html>