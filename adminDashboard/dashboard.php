<?php

include 'controller/connection.php';

session_start();

// if (!isset($_SESSION["kumpulan"]) || $_SESSION["kumpulan"] !== 'Z') {
//     header("Location: ../login.php");
//     exit();
// }



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

                <div class="userName">
                    <div class="user-name">NAMA BINTI PENUH</div>
                    <div class="user">
                        <img src="assets/images/user.png" alt="User Image">
                    </div>
                </div>
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
                $sqlTotalUser = "SELECT COUNT(*) AS total_users FROM pengguna WHERE kumpulan NOT IN ('X', 'Z')";
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

                $sqlTotalVehicle = "
                                    SELECT SUM(total_vehicles) AS total_vehicles FROM (
                                        SELECT COUNT(*) AS total_vehicles FROM kenderaan_jengkaut
                                        UNION ALL
                                        SELECT COUNT(*) AS total_vehicles FROM kenderaan_traktor
                                    ) AS combined_counts
                                ";
                $resultTotalvehicle = mysqli_query($conn, $sqlTotalVehicle);
                $rowTotalVehicle = mysqli_fetch_assoc($resultTotalvehicle);
                ?>


                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $rowTotalVehicle['total_vehicles']; ?></div>
                        <div class="cardName">Kenderaan</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="car-outline"></ion-icon>
                    </div>
                </div>

                <?php
                $sqlTotalDriver = "SELECT COUNT(*) AS total_drivers FROM pemandu";
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

                <table>
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Nama Penyewa</td>
                            <td>Tarikh Tempah</td>
                            <td>Tarikh Kerja</td>
                            <td>Maklumat</td>
                            <td>Status</td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nurul</td>
                            <td>21 Jun 2024</td>
                            <td>21 Jun 2024</td>
                            <td><a href="file.pdf" target="_blank">Lihat PDF</a></td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Mohd</td>
                            <td>21 Jun 2024</td>
                            <td>21 Jun 2024</td>
                            <td><a href="file.pdf" target="_blank">Lihat PDF</a></td>
                            <td><span class="status inProgress">In Progress</span></td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Nik</td>
                            <td>21 Jun 2024</td>
                            <td>21 Jun 2024</td>
                            <td><a href="file.pdf" target="_blank">Lihat PDF</a></td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Nur</td>
                            <td>21 Jun 2024</td>
                            <td>21 Jun 2024</td>
                            <td><a href="file.pdf" target="_blank">Lihat PDF</a></td>
                            <td><span class="status inProgress">In Progress</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
    <script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutButton = document.getElementById('logoutButton');

            // Add a click event listener to the logout button
            logoutButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default anchor behavior

                // Show the confirmation dialog
                Swal.fire({
                    title: "Log Keluar",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Batal",
                    confirmButtonText: "Log Keluar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Handle the logout logic here (e.g., redirecting to a logout route)
                        // Example: window.location.href = '/logout';

                        // Show the success dialog
                        Swal.fire({
                            title: "Logged out!",
                            text: "You have been successfully logged out.",
                            icon: "success"
                        }).then(() => {
                            // Optionally, redirect the user after the success dialog
                            window.location.href = '../controller/logout.php'; // Update with your actual logout URL
                        });
                    }
                });
            });
        });
    </script>




</body>

</html>