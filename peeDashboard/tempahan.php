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

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <?php include 'partials/name_display.php'; ?>
            </div>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>SENARAI TEMPAHAN</h2>
                </div>

                <table id="tempahanTable">
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Nama Pemohon</td>
                            <td>Tarikh Cadangan</td>
                            <td>Jenis Kerja</td>
                            <td>Status</td>
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

        <!-- =========== Scripts =========  -->
        <script src="../assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
        <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
        <!-- <script src="assets/js/main.js"></script> -->
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
                                    <td colspan="7" class="text-center">Tiada rekod dalam Database</td>
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

                                let actionButtons = '';

                                if (item.status_tempahan == 'pengesahan pee') {
                                    actionButtons = `
                                    <td>
                                        <button onclick="window.location.href = 'terimaTempahan.php?tempahan_id=${item.tempahan_id}'" class="btn btn-primary">
                                            Lihat Butiran
                                        </button>

                                    </td>
                                `;
                                } else if (item.status_tempahan == 'pengesahan kpp') {
                                    actionButtons = `
                                    <td>
                                        <button class="btn btn-primary" onclick="window.open('controller/getPDF_quotation_fullpayment.php?tempahan_id=${item.tempahan_id}', '_blank')">
                                            Lihat Sebut Harga
                                        </button>
                                        <button onclick="window.location.href = 'terimaTempahan.php?tempahan_id=${item.tempahan_id}'" class="btn btn-secondary">
                                            Lihat Butiran
                                        </button>
                                    </td>
                                `;
                                } else {
                                    actionButtons = `
                                    <td>
                                        <button class="btn btn-primary" onclick="window.open('controller/getPDF_quotation_deposit.php?id=${item.tempahan_id}', '_blank')">
                                            Lihat Butiran
                                        </button>
                                        <button onclick="window.location.href = 'kemaskiniKerja.php?tempahan_id=${item.tempahan_id}'" class="btn btn-warning">
                                            Kemaskini
                                        </button>
                                    </td>
                                `;
                                }
                                tbody.append(`
                                    <tr data-id="${item.tempahan_id}">
                                        <td>${(response.currentPage - 1) * 5 + index + 1}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.tarikh_kerja}</td>
                                        <td>${kerjaList}</td>
                                        <td>${item.status_tempahan}</td>
                                        ${actionButtons}
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



            
        </script>
    </div>
</body>

</html>