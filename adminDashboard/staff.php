<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
}

$sqlKumpulan = "SELECT `kump_kod`, `kump_desc` 
FROM `kumpulan` 
WHERE `kump_kod` != 'F' AND `kump_kod` != 'H' AND `kump_kod` != 'Z'";

$sqlStaff = "SELECT `id`, `nama`, `no_kp`, `email`, `contact_no`, `kumpulan` FROM `pengguna` WHERE 'kumpulan' != 'F' AND `kumpulan` != 'H' AND `kumpulan` != 'Z'";

$resultKumpulan = mysqli_query($conn, $sqlKumpulan);

$resultStaff = mysqli_query($conn, $sqlStaff);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

        h2,
        h3 {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 0.9em;
        }

        table th {
            background-color: #007bff;
            color: white;
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


                        <?php
                        $counter = 1;
                        while ($row = mysqli_fetch_assoc($resultStaff)) {
                            echo
                            '<tr data-id="' . $row['id'] . '">
                                <td>' . $counter . '</td>
                                <td>' . $row['kumpulan'] .  '</td>
                                <td>' . $row['nama'] . '</td>
                                <td>' . $row['no_kp'] . ' </td>
                                <td>' . $row['contact_no'] .  ' </td>
                                <td>
                                    <button onclick="editItem(this)" class="btn btn-edit">
                                        <i class="fas fa-edit" style="font-size: 1.5em;"></i>
                                    </button>
                                    <button onclick="deleteItem(this)" class="btn btn-delete">
                                        <i class="fas fa-trash-alt" style="font-size: 1.5em;"></i>
                                    </button>
                                </td>
                            </tr>';

                            $counter++;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>


        <!-- Register Modal -->
        <div id="registerModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3>DAFTAR STAF</h3>
                <form id="registerForm" x-data>
                    <div class="form-group">
                        <label for="kumpulan">Kumpulan:</label>
                        <select id="kumpulan" name="kumpulan" required>
                            <option value="" disabled selected>--Pilih Kumpulan--</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($resultKumpulan)) {
                                echo '<option value="' . $row['kump_kod'] . '">' . $row['kump_kod']  . ' - ' . $row['kump_desc'] . '</option>';
                            }


                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fullname">NAMA STAF:</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Masukkan nama staf" required>
                    </div>

                    <div class="form-group">
                        <label for="nokp">NO KAD PENGENALAN:</label>
                        <input type="text" id="nokp" name="nokp" x-mask="999999-99-9999" placeholder="Masukkan No Kad Pengenalan" required>
                    </div>

                    <div class="form-group">
                        <label for="contactno">NO TELEFON:</label>
                        <input type="tel" id="contactno" name="contactno" x-mask="999-99999999" placeholder="Masukkan no telefon" required>
                    </div>

                    <div class="form-group">
                        <label for="password">KATA LALUAN:</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan kata laluan" required>
                    </div>

                    <div class="form-group">
                        <label for="confirmPass">KATA LALUAN:</label>
                        <input type="password" id="confirmPass" name="confirmPass" placeholder="Sahkan kata laluan" required>
                    </div>

                    <input type="submit" value="DAFTAR" class="btn btn-daftar">
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>KEMASKINI STAF</h2>
                <form id="editForm" x-data>

                    <input type="hidden" id="staffIdEdit" name="staffIdEdit">
                    <div class="form-group">
                        <label for="fullnameEdit">NAMA STAF:</label>
                        <input type="text" id="fullnameEdit" name="fullnameEdit" placeholder="Masukkan nama staf" required>
                    </div>
                    <div class="form-group">
                        <label for="nokpEdit">NO KAD PENGENALAN:</label>
                        <input type="text" id="nokpEdit" name="nokpEdit" x-mask="999999-99-9999" placeholder="Masukkan no kad pengenalan">
                    </div>
                    <div class="form-group">
                        <label for="contactnoEdit">NO TELEFON:</label>
                        <input type="tel" id="contactnoEdit" name="contactnoEdit" x-mask="999-99999999" placeholder="Masukkan no telefon">
                    </div>

                    <input type="submit" value="KEMASKINI" class="btn btn-update">
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


        function deleteItem(button) {
            var row = button.parentNode.parentNode;
            var staffId = row.getAttribute('data-id');


            console.log(staffId);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../controller/delete_staff.php',
                        type: 'POST',
                        data: {
                            id: staffId
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error!",
                                text: "An error occurred while deleting the staff member.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }

        $('#registerForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '../controller/signup_staff.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Pendaftaran Berjaya',
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                }
            });
        });



        $('#editForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '../controller/edit_staff.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Kemaskini Berjaya',
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                }
            });
        });

        function editItem(button) {
            document.getElementById('editModal').style.display = "block";
            var row = button.parentNode.parentNode;
            var staffId = row.getAttribute('data-id');
            var namaStaf = row.cells[2].innerText;
            var noKp = row.cells[3].innerText;
            var noTel = row.cells[4].innerText;

            document.getElementById('staffIdEdit').value = staffId;
            document.getElementById('fullnameEdit').value = namaStaf;
            document.getElementById('nokpEdit').value = noKp;
            document.getElementById('contactnoEdit').value = noTel;

            function saveChanges() {
                closeModal();
            }
        }
    </script>
</body>

</html>