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
WHERE `kump_kod` != 'X' AND `kump_kod` != 'Y' AND `kump_kod` != 'Z'";

$sqlStaff = "SELECT * FROM `pengguna` WHERE `kumpulan` != 'X' AND `kumpulan` != 'Y' AND `kumpulan` != 'Z'";

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
        .cardHeader .btn {
            position: relative;
            padding: 12px 12px;
            background: var(--blue);
            text-decoration: none;
            color: var(--white);
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        include 'partials/navigation.php';
        ?>

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
                        <h2>SENARAI STAF</h2>
                        <a class="btn" onclick="window.location.href = 'daftar_staff.php'">DAFTAR STAF</a>
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
                                    <button onclick="window.location.href='kemaskini_staff.php'" class="btn btn-edit">
                                        <i class="fas fa-edit" style="font-size: 1.5em;"></i>
                                    </button>
                                    <button  class="btn btn-delete">
                                        <i class="fas fa-trash-alt" style="font-size: 1.5em;"></i>
                                    </button>
                                </td>
                            </tr>';

                        </tbody>
                    </table>
                </div>
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