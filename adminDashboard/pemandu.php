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
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 50px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9em;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        h2, h3 {
            margin-bottom: 15px;
        }

        table {
            border: 1px solid #ddd;
            padding: 8px;
            border-collapse: collapse;
            text-align: center;
            background-color: #f2f2f2;
            width: 100%;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 0.9em;
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
            padding: 15px;
            border: 1px solid #888;
            width: 30%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .details {
            margin-top: 20px;
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
        .form-group input[type="date"],
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

        .btn-edit, .btn-delete {
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-update, .btn-daftar {
            background-color: #28a745;
            color: white;
            border: none;
            font-size: 1em;
        }

        .btn-update:hover, .btn-daftar:hover {
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
                        <h2>SENARAI PEMANDU</h2>
                        <a class="btn" onclick="openModal()">DAFTAR PEMANDU</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Bil</td>
                                <td>Nama Pemandu</td>
                                <td>No Kad Pengenalan</td>
                                <td>Kategori Lesen</td>
                                <td>Tarikh Tamat Lesen</td>
								<td>Status</td>
                                <td>Kemaskini</td>
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
        <h3>DAFTAR PEMANDU</h3>
        <form id="registerForm">
            <div class="form-group">
                <label for="adminPemandu">ADMIN PEMANDU:</label>
                <input type="text" id="adminPemandu" name="adminPemandu" placeholder="adminPemandu" required>
            </div>
            <div class="form-group">
                <label for="namaPemandu">NAMA PEMANDU:</label>
                <input type="text" id="namaPemandu" name="namaPemandu" placeholder="Masukkan nama pemandu" required>
            </div>
            <div class="form-group">
                <label for="noKp">NO KAD PENGENALAN:</label>
                <input type="text" id="noKp" name="noKp" maxlength="12" placeholder="Masukkan No Kad Pengenalan" required>
            </div>
            <div class="form-group">
                <label for="noTel">NO TELEFON:</label>
                <input type="tel" id="noTel" name="noTel" maxlength="12" placeholder="Masukkan no telefon" required>
            </div>
            <div class="form-group">
                <label for="kategoriLesen">KATEGORI LESEN:</label>
                <select id="kategoriLesen" name="kategoriLesen" required>
                    <option value="" disabled selected>--Pilih Kategori Lesen--</option>
                    <option value="GDL D">GDL</option>
                    <option value="CDL">CDL</option>
                    <option value="Lesen H">H</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tarikhTamatLesen">TARIKH TAMAT LESEN:</label>
                <input type="date" id="tarikhTamatLesen" name="tarikhTamatLesen" required>
            </div>
            <div class="form-group">
                <label for="status">STATUS:</label>
                <select id="status" name="status" required>
                    <option value="" disabled selected>--Pilih Status--</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
			
			<div class="form-group">
				<label for="password">KATA LALUAN:</label>
				<input type="password" id="password" name="password" placeholder="Masukkan kata laluan" required>
            </div>
			
			<div class="form-group">
				<label for="confirmPassword">KATA LALUAN:</label>
				<input type="password" id="confirmPassword" name="confirmPassword" placeholder="Sahkan kata laluan" required>
            </div>
			
			
            <input type="button" value="DAFTAR" class="btn btn-daftar" onclick="saveChanges()">
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>KEMASKINI PEMANDU</h2>
        <form id="editForm">
            <div class="form-group">
                <label for="adminPemanduEdit">ADMIN PEMANDU:</label>
                <input type="text" id="adminPemanduEdit" name="adminPemandu" placeholder="adminPemandu">
            </div>
            <div class="form-group">
                <label for="namaPemanduEdit">NAMA PEMANDU:</label>
                <input type="text" id="namaPemanduEdit" name="namaPemandu" placeholder="Masukkan nama pemandu" required>
            </div>
            <div class="form-group">
                <label for="noKpEdit">NO KAD PENGENALAN:</label>
                <input type="text" id="noKpEdit" name="noKp" maxlength="12" placeholder="Masukkan no kad pengenalan" >
            </div>
            <div class="form-group">
                <label for="noTelEdit">NO TELEFON:</label>
                <input type="tel" id="noTelEdit" name="noTel" maxlength="12" placeholder="Masukkan no telefon" >
            </div>
            <div class="form-group">
                <label for="kategoriLesenEdit">KATEGORI LESEN:</label>
                <select id="kategoriLesenEdit" name="kategoriLesen" required>
                    <option value="" disabled selected>--Pilih Kategori Lesen--</option>
                    <option value="GDL">GDL</option>
                    <option value="CDL">CDL</option>
                    <option value="H">H</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tarikhTamatLesenEdit">TARIKH TAMAT LESEN:</label>
                <input type="date" id="tarikhTamatLesenEdit" name="tarikhTamatLesen" required>
            </div>
            <div class="form-group">
                <label for="statusEdit">STATUS:</label>
                <select id="statusEdit" name="status" required>
                    <option value="" disabled selected>--Pilih Status--</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
			
			<div class="form-group">
				<label for="password">KATA LALUAN:</label>
				<input type="password" id="password" name="password" placeholder="Masukkan kata laluan" required>
            </div>
			
			<div class="form-group">
				<label for="confirmPassword">KATA LALUAN:</label>
				<input type="password" id="confirmPassword" name="confirmPassword" placeholder="Sahkan kata laluan" required>
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
            var namaPemandu = row.cells[0].innerText;
            var noKp = row.cells[1].innerText;
            var noTel = row.cells[2].innerText;
            var kategoriLesen = row.cells[3].innerText;
			var tarikhTamatLesen = row.cells[4].innerText;
			var status = row.cells[5].innerText;
			
            document.getElementById('namaPemanduEdit').value = namaPemandu;
            document.getElementById('noKpEdit').value = noKp;
            document.getElementById('noTelEdit').value = noTel;
			document.getElementById('kategoriLesenEdit').value = kategoriLesen;
			document.getElementById('tarikhTamatLesenEdit').value = tarikhTamatLesen;
            document.getElementById('statusEdit').value = status;
			
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
