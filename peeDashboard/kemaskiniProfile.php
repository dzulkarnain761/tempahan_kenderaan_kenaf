<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">


    <style>
    </style>

</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="kemaskiniProfile.php">
                        <img src="../assets/images/logo2.png" alt="Brand Logo" style="margin-top: 10px; width:60px; height:60px;">
						<span class="title" style="margin-top: 10px; font-size: 18px;">LKTNBooking</span>
                    </a>
                </li>

                <li>
                    <a href="tempahan.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Tempahan</span>
                    </a>
                </li>
				
				<li>
                    <a href="profile.php">
                        <span class="icon">
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Profil</span>
                    </a>
                </li>

                <li>
                    <a href="../login.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="userName">
                    <div class="user-name">NAMA BINTI PENUH</div>
                    <div class="user">
                        <img src="../assets/images/user.png" alt="User Image">
                    </div>
                </div>
            </div>

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="profile.php">Profil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kemaskini</li>
                </ol>
            </nav>

                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Kemaskini Maklumat</h2>
                    </div>

                    <form>
						<div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" value="abc@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Penuh:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" value="NAMA PENUH BINTI NAMA PENUH">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nombor Kad Pengenalan</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" value="000000-00-0000" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nombor Telefon</label>
                            <input type="tel" class="form-control" id="exampleFormControlInput1" value="000-0000000">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Kemaskini</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</body>

</html>