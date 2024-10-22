<?php

include 'controller/connection.php';
include 'controller/session.php';
include 'controller/get_userdata.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>eBooking</title>
	<link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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

                <?php include 'partials/name_display.php'; ?>
            </div>

            <div class="recentOrders">
				<div class="cardHeader">
					<h2>MAKLUMAT</h2>
				</div>
                <section class="profile-section">
                    <div class="profile-image">
                        <img src="../assets/images/user.png" alt="Admin Profile Picture">
                    </div>
                    <div class="profile-details">
                        <p>Email :</p>
                        <h4 class="text-muted"><?php echo htmlspecialchars($email); ?></h4>
						<p>Nama Penuh :</p>
                        <h4 class="text-muted"><?php echo htmlspecialchars($nama); ?></h4>
                        <p>Nombor Kad Pengenalan :</p>
                        <h4 class="text-muted"><?php echo htmlspecialchars($no_kp); ?></h4>
                        <p>Nombor Telefon :</p>
                        <h4 class="text-muted"><?php echo htmlspecialchars($contact_no); ?></h4>
                    </div>
					<div class="text-end">
						<button type="button" class="btn btn-primary" onclick="window.location.href = 'kemaskiniProfile.php'">
							Kemaskini
						</button>
					</div>
                </section>
            </div>

        </div>

        <!-- =========== Scripts =========  -->
        <script src="../assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </div>
</body>

</html>
