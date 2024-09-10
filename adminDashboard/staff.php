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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .custom-container {
            position: relative;
            width: 100%;
        }

        ul {
            all: unset;
            list-style: disc;
            /* padding-left: 20px; */
            margin: 0;
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

        .cardHeader {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        .cardHeader {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .cardHeader h2 {
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

        .btn-outline-edit {
            border: 2px solid #007bff;
            /* Choose the color you prefer */
            color: #007bff;
            background-color: transparent;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-outline-edit:hover {
            background-color: #007bff;
            color: white;
        }

        .btn-outline-delete {
            border: 2px solid #dc3545;
            /* Choose the color you prefer */
            color: #dc3545;
            background-color: transparent;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-outline-delete:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body>
    <div class="custom-container">
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

            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>SENARAI STAF</h2>
                    <a class="btn" onclick="window.location.href = 'daftar_staff.php'">DAFTAR STAF</a>
                </div>

                <table id="staffTable">
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Kumpulan</td>
                            <td>Nama Staf</td>
                            <td>No Kad Pengenalan</td>
                            <td>Negeri</td>
                            <td>Kemaskini</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-start mt-4" id="pagination">
                        <!-- Pagination links will be injected here by JavaScript -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
    <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        function loadPage(page) {
            $.ajax({
                url: 'controller/get_staff.php', // The PHP file that handles the database query
                type: 'GET',
                data: {
                    page: page
                },
                dataType: 'json',
                success: function(response) {
                    var tbody = $('#staffTable tbody');
                    tbody.empty();

                    // Populate table
                    response.data.forEach(function(item, index) {
                        tbody.append(`
                        <tr data-id="${item.id}">
                            <td>${(response.currentPage - 1) * 5 + index + 1}</td>
                            <td>${item.kump_desc}</td>
                            <td>${item.nama}</td>
                            <td>${item.no_kp}</td>
                            <td>${item.negeri}</td>
                            <td>
                                <button onclick="window.location.href = 'kemaskini_staff.php?id=${item.id}'" class="btn btn-outline-edit">
                                    <i class="fas fa-edit" style="font-size: 1.5em;"></i>
                                </button>
                                <button onclick="deleteItem(this)" class="btn btn-outline-delete">
                                    <i class="fas fa-trash-alt" style="font-size: 1.5em;"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                    });

                    // Populate pagination
                    var pagination = $('#pagination');
                    pagination.empty();

                    // Previous button
                    pagination.append(`
                    <li class="page-item ${response.currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="loadPage(${response.currentPage - 1})"><</a>
                    </li>
                `);

                    // Page numbers
                    for (var i = 1; i <= response.totalPages; i++) {
                        pagination.append(`
                        <li class="page-item ${i === response.currentPage ? 'active' : ''}">
                            <a class="page-link" href="#" onclick="loadPage(${i})">${i}</a>
                        </li>
                    `);
                    }

                    // Next button
                    pagination.append(`
                    <li class="page-item ${response.currentPage === response.totalPages ? 'disabled' : ''}">
                        <a class="page-link" href="#" onclick="loadPage(${response.currentPage + 1})">></a>
                    </li>
                `);
                }
            });
        }

        // Load the first page by default
        loadPage(1);

        function deleteItem(button) {
            var row = button.closest('tr'); // Find the closest <tr> element
            var staffId = row.getAttribute('data-id'); // Get the data-id from <tr>

            Swal.fire({
                title: "Adakah anda pasti?",
                text: "Anda tidak akan dapat membatalkan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, padamkannya!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/delete/delete_staff.php',
                        type: 'POST',
                        data: {
                            id: staffId
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Berjaya dipadam!",
                                text: "Staff telah dipadam.",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Ralat!",
                                text: "Ralat berlaku semasa memadam Ahli Staff.",
                                icon: "error"
                            });
                        }
                    });
                }
            });

        }
    </script>
</body>

</html>