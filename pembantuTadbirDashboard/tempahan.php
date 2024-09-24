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
                    <h2>Pengesahan Bayaran </h2>
                </div>

                <table id="tempahanTable">
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Nama Pemohon</td>
                            <td>Tarikh Cadangan</td>
                            <td>Jenis Kerja</td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
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

                            var actionButton = '';

                            if (item.status_bayaran === 'deposit diproses') {
                                actionButton = `
                                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_${item.tempahan_id}">Lihat Butiran</button>
                                    <button class="btn btn-success btn-sm terimaDeposit" value="${item.tempahan_id}">
                                        Terima Deposit
                                    </button>`;
                            } else if (item.status_bayaran === 'bayaran diproses') {
                                actionButton = `
                                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_${item.tempahan_id}">Lihat Butiran</button>
                                        <button class="btn btn-success btn-sm selesaiTempahan" value="${item.tempahan_id}">
                                            Terima Bayaran
                                        </button>`;
                            } else {
                                actionButton = `
                                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal_${item.tempahan_id}">Lihat Butiran</button>
                                        <button class="btn btn-success btn-sm refundTempahan" value="${item.tempahan_id}">
                                            Bayar Balik
                                        </button>`;
                            }


                            // Append the row to tbody
                            tbody.append(`
                                    <tr>
                                        <td>${(response.currentPage - 1) * 5 + index + 1}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.tarikh_kerja}</td>
                                        <td>${kerjaList}</td>
                                        <td>${actionButton}</td>
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

        $(document).on('click', '.terimaDeposit', function(e) {
            let tempahanId = $(this).attr('value');

            Swal.fire({
                title: "Mula Kerja",
                text: "Anda tidak akan dapat membatalkan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/terimaDeposit.php',
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

        $(document).on('click', '.selesaiTempahan', function(e) {
            let tempahanId = $(this).attr('value');

            Swal.fire({
                title: "Selesai Tempahan",
                text: "Anda tidak akan dapat membatalkan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/selesaiTempahan.php',
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

        $(document).on('click', '.refundTempahan', function(e) {
            let tempahanId = $(this).attr('value');

            Swal.fire({
                title: "Bayar Balik Tempahan",
                text: "Anda akan pergi ke page lain",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/refund.php',
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
    </script>
</body>

</html>