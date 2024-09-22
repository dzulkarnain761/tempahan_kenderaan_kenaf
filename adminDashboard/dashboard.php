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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <title>Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- ======= Styles ====== -->

    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        :root {
            --skyblue: #d0e5f5;
        }

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        .cardBox {
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 30px;
        }

        .cardBox .card {
            position: relative;
            background: var(--white);
            padding: 30px;
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
        }

        .cardBox .card .numbers {
            position: relative;
            font-weight: 500;
            font-size: 2.5rem;
            color: var(--blue);
        }

        .cardBox .card .cardName {
            color: var(--black2);
            font-size: 1.1rem;
            margin-top: 5px;
        }

        .cardBox .card .iconBx {
            font-size: 3.5rem;
            color: var(--black2);
        }

        .cardBox .card:hover {
            background: var(--blue);
        }

        .cardBox .card:hover .numbers,
        .cardBox .card:hover .cardName,
        .cardBox .card:hover .iconBx {
            color: var(--white);
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

        .status.pending {
            padding: 2px 4px;
            background: #e9b10a;
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

        /* ====================== Responsive Design ========================== */
        @media (max-width: 991px) {
            .navigation {
                left: -300px;
            }

            .navigation.active {
                width: 300px;
                left: 0;
            }

            .main {
                width: 100%;
                left: 0;
            }

            .main.active {
                left: 300px;
            }

            .cardBox {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .details {
                grid-template-columns: 1fr;
            }

            .recentOrders {
                overflow-x: auto;
            }

            .status.inProgress {
                white-space: nowrap;
            }
        }

        @media (max-width: 480px) {
            .cardBox {
                grid-template-columns: repeat(1, 1fr);
            }

            .cardHeader h2 {
                font-size: 20px;
            }

            .user {
                min-width: 40px;
            }

            .navigation {
                width: 100%;
                left: -100%;
                z-index: 1000;
            }

            .navigation.active {
                width: 100%;
                left: 0;
            }

            .toggle {
                z-index: 10001;
            }

            .main.active .toggle {
                color: #fff;
                position: fixed;
                right: 0;
                left: initial;
            }
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php
        include 'partials/navigation.php';
        ?>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <?php include 'partials/name_display.php' ?>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">


                <div class="card">
                    <div>
                        <div class="numbers">100</div>
                        <div class="cardName">Tempahan</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="book-outline"></ion-icon>
                    </div>
                </div>

                <?php
                $sqlTotalUser = "SELECT COUNT(*) AS total_users FROM admin WHERE kumpulan NOT IN ('Z')";
                $resultTotalUser = mysqli_query($conn, $sqlTotalUser);
                $rowTotalUser = mysqli_fetch_assoc($resultTotalUser);
                ?>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $rowTotalUser['total_users']; ?></div>
                        <div class="cardName">Staf</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>

                <?php

                $sqlTotalVehicle = "SELECT COUNT(*) AS total_kenderaan FROM kenderaan";
                $resultTotalvehicle = mysqli_query($conn, $sqlTotalVehicle);
                $rowTotalVehicle = mysqli_fetch_assoc($resultTotalvehicle);
                ?>


                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $rowTotalVehicle['total_kenderaan']; ?></div>
                        <div class="cardName">Kenderaan</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="car-outline"></ion-icon>
                    </div>
                </div>

                <?php
                $sqlTotalDriver = "SELECT COUNT(*) AS total_drivers FROM admin WHERE kumpulan = 'Y'";
                $resultTotalDriver = mysqli_query($conn, $sqlTotalDriver);
                $rowTotalDriver = mysqli_fetch_assoc($resultTotalDriver);
                ?>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $rowTotalDriver['total_drivers']; ?></div>
                        <div class="cardName">Pemandu</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Kerja Berjalan</h2>
                </div>

                <table id="tempahanTable">
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Nama Penyewa</td>
                            <td>Tarikh Cadangan</td>
                            <td>Jenis Kerja</td>
                            <td>Tindakan</td>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>


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



                            tbody.append(`
                                    <tr data-id="${item.tempahan_kerja_id}">
                                        <td>${(response.currentPage - 1) * 5 + index + 1}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.tarikh_kerja}</td>
                                        <td>${kerjaList}</td>
                                        <td>
                                        <button class="btn btn-primary" onclick="window.location.href='jobsheet.php?id=${item.tempahan_kerja_id}'">Kemaskini</button>
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
    </script>
</body>

</html>