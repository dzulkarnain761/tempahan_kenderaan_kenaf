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
    <link href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="custom-container">
        <?php
        include 'partials/navigation.php';
        ?>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <?php include 'partials/name_display.php'; ?>
            </div>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Pengesahan Tempahan Sewaan per Jam atau Harian </h2>
                </div>

                <table id="tempahanTable">
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Nama Pemohon</td>
                            <td>Tarikh Cadangan</td>
                            <td>Jenis Kerja</td>
                            <td>Disahkan Oleh</td>
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


    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
    <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        function loadPage(page) {
            $.ajax({
                url: 'controller/get_tempahan.php', // The PHP file that handles the database query
                type: 'GET',
                data: {
                    page: page
                },
                dataType: 'json',
                success: function(response) {
                    var tbody = $('#tempahanTable tbody');
                    tbody.empty();

                    // Hide pagination if no data
                    var pagination = $('#pagination');
                    if (response.data.length === 0) {
                        tbody.append(`
                    <tr>
                        <td colspan="7" class="text-center">Tiada Tempahan</td>
                    </tr>
                `);
                        pagination.hide(); // Hide pagination
                    } else {
                        // Populate table
                        response.data.forEach(function(item, index) {
                            var kerjaList = '';
                            item.kerja.forEach(function(kerjaItem, kerjaIndex) {
                                kerjaList += (kerjaIndex + 1) + '. ' + kerjaItem.nama_kerja + '<br>';
                            });

                            tbody.append(`
                            <tr >
                            <td>${(response.currentPage - 1) * 5 + index + 1}</td>
                            <td>${item.nama}</td>
                            <td>${item.tarikh_kerja}</td>
                            <td>${kerjaList}</td>
                            <td>${item.disahkan_oleh}</td>
                            <td>
                                <button onclick="window.open('controller/getPDF_quotation_fullpayment.php?tempahan_id=${item.tempahan_id}', '_blank')" class="btn btn-primary btn-sm">
                                    Lihat Butiran
                                </button>
                                <button  class="btn btn-success btn-sm terimaTempahan" value="${item.tempahan_id}">
                                    Terima
                                </button>
                                <button  class="btn btn-danger btn-sm rejectTempahan" value="${item.tempahan_id}">
                                    Tolak
                                </button>
                            </td>
                        </tr>
                    `);
                        });

                        // Populate pagination and show it if hidden
                        pagination.empty();
                        pagination.show(); // Show pagination

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
                }
            });
        }

        // Load the first page by default
        loadPage(1);

        $(document).on('click', '.terimaTempahan', function(e) {
            let tempahanId = $(this).attr('value');

            Swal.fire({
                title: "Terima Tempahan",
                text: "Anda tidak akan dapat membatalkan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/terimaTempahan.php',
                        type: 'POST',
                        data: {
                            id: tempahanId
                        },
                        success: function(response) {
                            let res = JSON.parse(response);
                            Swal.fire({
                                title: "Berjaya",
                                text: "Berjaya Kemaskini Tempahan",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Ralat!",
                                text: "Ralat berlaku semasa mengemaskini status kerja.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click', '.rejectTempahan', function(e) {
            let tempahanId = $(this).attr('value');

            Swal.fire({
                title: "Tolak Tempahan",
                text: "Sila nyatakan sebab menolak tempahan:",
                input: 'textarea', // Add input field
                inputPlaceholder: 'Sebab tolak tempahan...',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                inputValidator: (value) => {
                    if (!value) {
                        return 'Anda perlu memberikan sebab untuk menolak tempahan!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let reason = result.value; // Get input value
                    $.ajax({
                        url: 'controller/rejectTempahan.php',
                        type: 'POST',
                        data: {
                            tempahan_id: tempahanId,
                            sebab_ditolak: reason // Pass the reason to the server
                        },
                        success: function(response) {
                            let res = JSON.parse(response);
                            Swal.fire({
                                title: "Berjaya",
                                text: "Tempahan Dibatalkan",
                                icon: "success"
                            }).then(() => {
                                window.location.href = 'tempahan.php';
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Ralat!",
                                text: "Ralat berlaku semasa mengemaskini status kerja.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>