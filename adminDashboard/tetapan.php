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


            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>TETAPAN</h2>
                </div>

                <div class="buttonSettings">
                    <!-- <div>
                        <button onclick="window.location.href='crud_jawatan.php'">
                            Jawatan <span class="icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div> -->
                    <div>
                        <button onclick="window.location.href='crud_lesen.php'">
                            Lesen <span class="icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div>
                    <div>
                        <button onclick="window.location.href='crud_tugasan.php'">
                            Tugasan<span class="icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div>
                    <!-- <div>
                        <button onclick="window.location.href='crud_tugasan_jengkaut.php'">
                            Tugasan Jengkaut<span class="icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div> -->
                    <div>
                        <button onclick="window.location.href='crud_kategori_kenderaan.php'">
                            Kategori Kenderaan <span class="icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</body>

</html>