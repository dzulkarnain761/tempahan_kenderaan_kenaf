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
.status.delivered {
  padding: 2px 4px;
  background: #8de02c;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}
.status.pending {
  padding: 2px 4px;
  background: #e9b10a;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}
.status.return {
  padding: 2px 4px;
  background: #f00;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}
.status.inProgress {
  padding: 2px 4px;
  background: #1795ce;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}

.recentCustomers {
  position: relative;
  display: grid;
  min-height: 500px;
  padding: 20px;
  background: var(--white);
  box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
  border-radius: 20px;
}
.recentCustomers .imgBx {
  position: relative;
  width: 40px;
  height: 40px;
  border-radius: 50px;
  overflow: hidden;
}
.recentCustomers .imgBx img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.recentCustomers table tr td {
  padding: 12px 10px;
}
.recentCustomers table tr td h4 {
  font-size: 16px;
  font-weight: 500;
  line-height: 1.2rem;
}
.recentCustomers table tr td h4 span {
  font-size: 14px;
  color: var(--black2);
}
.recentCustomers table tr:hover {
  background: var(--blue);
  color: var(--white);
}
.recentCustomers table tr:hover td h4 span {
  color: var(--white);
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

                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>SENARAI STAF</h2>
                        <a class="btn" onclick="openModal()">DAFTAR STAF</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Bil</td>
								<td>Kumpulan</td>
                                <td>Nama Staf</td>
                                <td>No Kad Pengenalan</td>
                                <td>No Telefon</td>
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

        <!-- Register Modal -->
<div id="registerModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>DAFTAR STAF</h3>
        <form id="registerForm">
            <div class="form-group">
                <label for="kumpulan">Kumpulan:</label>
				<select id="kumpulan" name="kumpulan" required>
					<option value="" disabled selected>--Pilih Kumpulan--</option>
				</select>
            </div>
			
            <div class="form-group">
                <label for="namaStaf">NAMA STAF:</label>
                <input type="text" id="namaStaf" name="namaStaf" placeholder="Masukkan nama staf" required>
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
        <h2>KEMASKINI STAF</h2>
        <form id="editForm">
            <div class="form-group">
                <label for="kumpulanEdit">KUMPULAN:</label>
				<select id="kumpulanEdit" name="kumpulan" >
					<option value="" disabled selected>--Pilih Kumpulan--</option>
				</select>
            </div>
			
            <div class="form-group">
                <label for="namaStafEdit">NAMA STAF:</label>
                <input type="text" id="namaStafEdit" name="namaStaf" placeholder="Masukkan nama staf" required>
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
                <label for="passwordEdit">KATA LALUAN:</label>
                <input type="text" id="passwordEdit" name="password" placeholder="Masukkan kata laluan" required>
            </div>
			
			<div class="form-group">
                <label for="confirmPasswordEdit">SAHKAN KATA LALUAN:</label>
                <input type="text" id="confirmPasswordEdit" name="confirmPassword" placeholder="Sahkan kata laluan" required>
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
            var namaStaf = row.cells[0].innerText;
            var noKp = row.cells[1].innerText;
            var noTel = row.cells[2].innerText;
            var password = row.cells[3].innerText;
			var confirmPassword = row.cells[4].innerText;
			
            document.getElementById('namaStafEdit').value = namaStaf;
            document.getElementById('noKpEdit').value = noKp;
            document.getElementById('noTelEdit').value = noTel;
			document.getElementById('passwordEdit').value = password;
			document.getElementById('confirmPasswordEdit').value = confirmPassword;
			
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
