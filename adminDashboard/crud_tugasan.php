<?php

include 'controller/connection.php';
include 'controller/session.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>eBooking</title>
	<link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">


    <style>
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

                <?php include 'partials/name_display.php' ?>
            </div>

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="tetapan.php">Tetapan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tugasan </li>
                </ol>
            </nav>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h3>Tugasan</h3>
                    <a class="btn" onclick="window.location.href = 'tambah_tugasan.php'">TAMBAH TUGASAN</a>
                </div>


                <table id="tugasanTable">
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Kategori Kenderaan</td>
                            <td>Nama Kerja</td>
                            <td>Harga Per Jam</td>
                            <td>Tindakan</td>
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
                url: 'controller/get_tugasan.php', // The PHP file that handles the database query
                type: 'GET',
                data: {
                    page: page
                },
                dataType: 'json',
                success: function(response) {
                    var tbody = $('#tugasanTable tbody');
                    tbody.empty();

                    // Populate table
                    response.data.forEach(function(item, index) {
                        tbody.append(`
                        <tr data-id="${item.id}">
                            <td>${(response.currentPage - 1) * 5 + index + 1}</td>
                            <td>${item.kategori_kenderaan}</td>
                            <td>${item.kerja}</td>
                            <td>${item.harga_per_jam}</td>
                            <td>
                                <button onclick="window.location.href = 'kemaskini_tugasan.php?id=${item.id}'" class="btn btn-outline-edit">
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
            var tugasanId = row.getAttribute('data-id'); // Get the data-id from <tr>

            Swal.fire({
                title: "Adakah anda pasti?",
                text: "Anda tidak akan dapat membatalkan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, padamkannya!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/delete/delete_tugasan.php',
                        type: 'POST',
                        data: {
                            id: tugasanId
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Berjaya dipadam!",
                                text: "Fail anda telah dipadam.",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Ralat!",
                                text: "Ralat berlaku semasa memadam.",
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