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
	<title>eBooking</title>
	<link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>

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
                            <td>Tarikh Kerja</td>
                            <td>Jenis Kerja</td>
                            <td>Pemandu</td>
                            <td>Status</td>
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

                    if (response.data.length === 0) {
                        tbody.append(`
                                <tr>
                                    <td colspan="7" class="text-center">Tiada rekod yang dijumpai.</td>
                                </tr>
                            `);
                        pagination.hide(); // Hide pagination
                    } else {

                        // Populate table
                        response.data.forEach(function(item, index) {
                            tbody.append(`
                        <tr data-id="${item.id}">
                            <td>${(response.currentPage - 1) * 5 + index + 1}</td>
                            <td>${item.nama}</td>
                            <td>${item.tarikh_kerja_cadangan}</td>
                            <td>${item.nama_kerja}</td>
                            <td>${item.nama_pemandu}</td>
                            <td>${item.status_kerja}</td>
                            
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




                }
            });
        }

        // Load the first page by default
        loadPage(1);
    </script>
</body>

</html>