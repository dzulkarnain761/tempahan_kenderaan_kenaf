<?php

include 'controller/db-connect.php';

// session_start();

// if (!isset($_SESSION["id"])) {
//     header("Location: login.php");
//     exit();
// }

include 'controller/get_userdata.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <style>
        .border-first-button button {
            display: inline-block !important;
            padding: 10px 20px !important;
            color: #4da6e7 !important;
            border: 1px solid #4da6e7 !important;
            border-radius: 23px;
            font-weight: 500 !important;
            letter-spacing: 0.3px !important;
            transition: all .5s;
            background-color: #fff;
            margin-top: 30px;
            margin-left: 10px;
        }

        .border-first-button button:hover {
            background-color: #4da6e7;
            color: #fff !important;
        }

        html,
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            background-color: #fff;
            -ms-text-size-adjust: 100%;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* 
---------------------------------------------
Banner Style
--------------------------------------------- 
*/

        .main-banner {
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            padding: 200px 0px 120px 0px;
            position: relative;
            overflow: hidden;
        }


        .main-banner:before {
            content: '';
            background-image: url(../images/slider-right-dec.jpg);
            background-repeat: no-repeat;
            position: absolute;
            right: 0;
            top: 60px;
            width: 1159px;
            height: 797px;
            z-index: -1;
        }

        .main-banner .left-content {
            margin-right: 15px;
        }

        .main-banner .left-content h6 {
            text-transform: capitalize;
            font-size: 20px;
            font-weight: 700;
            color: #4da6e7;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .main-banner .left-content h2 {
            z-index: 2;
            position: relative;
            font-weight: 700;
            font-size: 50px;
            color: #2a2a2a;
            margin-bottom: 20px;
        }

        .main-banner .left-content p {
            margin-bottom: 30px;
            margin-right: 45px;
        }

        .main-banner .right-image {
            text-align: right;
            position: relative;
            z-index: 20;
        }

        .main-banner .right-image img {
            max-width: 593px;
        }

        /* 
---------------------------------------------
preloader
--------------------------------------------- 
*/

        .js-preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            display: -webkit-box;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            opacity: 1;
            visibility: visible;
            z-index: 9999;
            -webkit-transition: opacity 0.25s ease;
            transition: opacity 0.25s ease;
        }

        .js-preloader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        @-webkit-keyframes dot {
            50% {
                -webkit-transform: translateX(96px);
                transform: translateX(96px);
            }
        }

        @keyframes dot {
            50% {
                -webkit-transform: translateX(96px);
                transform: translateX(96px);
            }
        }

        @-webkit-keyframes dots {
            50% {
                -webkit-transform: translateX(-31px);
                transform: translateX(-31px);
            }
        }

        @keyframes dots {
            50% {
                -webkit-transform: translateX(-31px);
                transform: translateX(-31px);
            }
        }

        .preloader-inner {
            position: relative;
            width: 142px;
            height: 40px;
            background: #fff;
        }

        .preloader-inner .dot {
            position: absolute;
            width: 16px;
            height: 16px;
            top: 12px;
            left: 15px;
            background: #4da6e7;
            border-radius: 50%;
            -webkit-transform: translateX(0);
            transform: translateX(0);
            -webkit-animation: dot 2.8s infinite;
            animation: dot 2.8s infinite;
        }

        .preloader-inner .dots {
            -webkit-transform: translateX(0);
            transform: translateX(0);
            margin-top: 12px;
            margin-left: 31px;
            -webkit-animation: dots 2.8s infinite;
            animation: dots 2.8s infinite;
        }

        .preloader-inner .dots span {
            display: block;
            float: left;
            width: 16px;
            height: 16px;
            margin-left: 16px;
            background: #4da6e7;
            border-radius: 50%;
        }

        /* 
	---------------------------------------------
	header
	--------------------------------------------- 
	*/


        .header-area {
            background-color: #fff;
            box-shadow: 0px 5px 8px rgba(0, 0, 0, 0.03);
        }

        .header-area .main-nav .logo {
            line-height: 100px;
            float: left;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        .header-area .main-nav .nav {
            float: left;
            margin-top: 30px;
            margin-right: 0px;
            background-color: transparent;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            position: relative;
            z-index: 999;
        }

        .header-area .main-nav .nav li {
            padding-left: 20px;
            padding-right: 20px;
        }

        .header-area .main-nav .nav li a {
            display: block;
            font-weight: 500;
            font-size: 15px;
            color: #2a2a2a;
            text-transform: capitalize;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            height: 40px;
            line-height: 40px;
            border: transparent;
            letter-spacing: 1px;
        }

        .header-area .main-nav .nav li:hover a,
        .header-area .main-nav .nav li a.active {
            color: #4da6e7 !important;
        }

        a {
            color: #0d6efd;
            text-decoration: none;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #bcbfc2;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }


        /* Center modal dialog */
        .modal-dialog {
            max-width: 500px;
            margin: auto;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Override specific properties for modal-dialog-centered */
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: auto;
            /* Remove fixed width */
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 500px;
            /* Optional: maximum width */
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: .3rem;
            outline: 0;
            max-height: 100%;
            border: solid grey 2px;
            overflow: hidden;
            box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.19), 0 20px 20px 0 rgba(0, 0, 0, 0.19);
        }

        @media (min-width: 576px) {
            .modal-dialog {
                width: 500px;
            }

            .modal-dialog-scrollable {
                height: calc(100% - 3.5rem);
            }

            .modal-dialog-centered {
                min-height: calc(100% - 3.5rem);
            }

            .modal-sm {
                max-width: 300px;
            }
        }
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="tempahan.php" class="logo">
                            <img src="assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
                            <img src="assets/images/logo.jpeg" alt="" style="width: 120px; height: auto;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="homepage.php">Laman Utama</a></li>
                            <li class="scroll-to-section"><a href="tempahan.php" class="active">Tempah</a></li>
                            <li class="scroll-to-section"><a href="sewaan.php">Sewaan</a></li>
                            <li class="scroll-to-section"><a href="profil.php">Profil</a></li>
                        </ul>

                        <div class="border-first-button" style="float: right; display: flex; align-items: center;">
                            <ion-icon name="person-outline" style="font-size: 24px; margin-top: 30px;"></ion-icon>
                            <span style="margin-left: 10px; margin-top: 30px;"><?php echo htmlspecialchars($nama);?></span>
                            <button id="logoutButton">Logout</button>
                        </div>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Content Start ***** -->
    <div class="modal-dialog modal-dialog-centered wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
        <div class="modal-content" style="margin-top: 20px; width:900px;">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Sila Pilih</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="sewa" class="form-label">Jenis Sewa :</label>
                        <select id="sewa" class="form-control" name="sewa" required onchange="showForm()">
                            <option disabled selected>Sila Pilih Jenis Sewa</option>
                            <option value="jam/harian">Per Jam atau Harian</option>
                            <option value="bulanan">Bulanan</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ***** Jam Harian ***** -->
    <div class="modal-dialog modal-dialog-centered" id="form-jam-harian" style="display: none;">
        <div class="modal-content" style="margin-top: 20px; margin-bottom:25px;">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Sewa Per Jam atau Harian</h5>
            </div>
            <div class="modal-body">

                <form class="createTempahan" method="POST">
                    <div class="mb-3">
                        <label for="tarikh_kerja" class="form-label">Cadangan Tarikh Kerja :</label>
                        <input type="date" class="form-control" id="tarikh_kerja" name="tarikh_kerja" required>
                    </div>
                    <div class="mb-3">
                        <label for="negeri" class="form-label">Negeri</label>
                        <select id="negeri" class="form-control" name="negeri" required>
                            <option disabled selected value="">--Pilih Negeri--</option>
                            <?php
                            $sqlNegeri = "SELECT * FROM negeri";
                            $resultNegeri = mysqli_query($conn, $sqlNegeri);

                            while ($row = mysqli_fetch_assoc($resultNegeri)) {
                                echo '<option value="' . $row['nama_negeri'] . '">' . $row['nama_negeri'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Sila pilih negeri penempatan.</div>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi_kerja" class="form-label">Lokasi Kerja :</label>
                        <input type="text" class="form-control" id="lokasi_kerja" name="lokasi_kerja" placeholder="Masukkan Lokasi Kerja" required>
                    </div>
                    <div class="mb-3">
                        <label for="keluasan_tanah" class="form-label">Keluasan Tanah (Hektar) :</label>
                        <input type="number" class="form-control" id="keluasan_tanah" name="keluasan tanah" min="1" placeholder="Masukkan Keluasan Tanah" required>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan :</label>
                        <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan">
                    </div>

                    <div class="mb-3">
                        <label for="kerja" class="form-label">Jenis Kerja :</label>
                        <select id="kerja" class="form-control" name="kerja[]" required onchange="showButton()">
                            <option disabled selected value="">Sila Pilih Jenis Kerja</option>
                            <?php
                            // Assuming you have a database connection set up as $conn
                            $sqlTugasan = "SELECT * FROM `tugasan`";
                            $result = $conn->query($sqlTugasan);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['kerja'] . '">' . $row['kerja'] . ' - RM ' . $row['harga_per_jam'] . '/Jam' . '</option>';
                                }
                            } else {
                                echo '<option disabled>No available options</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div id="additionalSelects"></div>

                    <div class="d-flex mt-3 mb-3">
                        <button id="addButton" class="btn btn-primary me-2" style="display:none;" type="button" onclick="addSelect()">+</button>
                        <button id="removeButton" class="btn btn-danger" style="display:none;" type="button" onclick="removeSelect()">-</button>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Hantar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bulanan -->
    <div class="modal-dialog modal-dialog-centered" id="form-bulanan" style="display: none;">
        <div class="modal-content" style="margin-top: 20px;">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Sewa Bulanan</h5>
            </div>
            <div class="modal-body">
                <form action="sewaan.php" method="POST">
                    <div class="mb-3">
                        <label for="tarikh_mula" class="form-label">Tarikh Mula :</label>
                        <input type="date" class="form-control" id="tarikh_mula" required>
                    </div>
                    <div class="mb-3">
                        <label for="tempoh" class="form-label">Tempoh Sewa :</label>
                        <input type="number" class="form-control" id="tempoh" min="1" placeholder="Masukkan Tempoh Sewa" required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasiKerja" class="form-label">Lokasi Kerja :</label>
                        <input type="text" class="form-control" id="lokasiKerja" placeholder="Masukkan Lokasi Kerja" required>
                    </div>
                    <div class="mb-3">
                        <label for="keluasanTanah" class="form-label">Keluasan Tanah (Hektar) :</label>
                        <input type="number" class="form-control" id="keluasanTanah" min="1" placeholder="Masukkan Keluasan Tanah" required>
                    </div>
                    <input type="hidden" value="<?php $_SESSION['id']; ?>">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Hantar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ***** Content End ***** -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/custom.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        function showButton() {
            var kerja = document.getElementById("kerja").value;
            var addButton = document.getElementById("addButton");
            if (kerja) {
                addButton.style.display = "inline-block";
            } else {
                addButton.style.display = "none";
            }
        }

        function addSelect() {
            var additionalSelects = document.getElementById("additionalSelects");
            var newSelectDiv = document.createElement("div");
            newSelectDiv.className = "mb-3";
            newSelectDiv.style.marginTop = "10px";

            var newSelect = document.createElement("select");
            newSelect.className = "form-control";
            newSelect.name = "kerja[]";
            newSelect.required = true;

            var defaultOption = document.createElement("option");
            defaultOption.disabled = true;
            defaultOption.selected = true;
            defaultOption.value = "";
            defaultOption.textContent = "Sila Pilih Jenis Kerja";

            newSelect.appendChild(defaultOption);

            <?php
            $result->data_seek(0); // Reset the result pointer to the beginning
            while ($row = $result->fetch_assoc()) {
                echo 'var option = document.createElement("option");';
                echo 'option.value = "' . $row['kerja'] . '";';
                echo 'option.textContent = "' . $row['kerja'] . ' - RM ' . $row['harga_per_jam'] . '/Jam";';
                echo 'newSelect.appendChild(option);';
            }
            ?>

            newSelectDiv.appendChild(newSelect);
            additionalSelects.appendChild(newSelectDiv);

            document.getElementById("removeButton").style.display = "inline-block";
        }

        function removeSelect() {
            var additionalSelects = document.getElementById("additionalSelects");
            if (additionalSelects.lastChild) {
                additionalSelects.removeChild(additionalSelects.lastChild);
            }

            if (additionalSelects.childElementCount === 0) {
                document.getElementById("removeButton").style.display = "none";
            }
        }

        function showForm() {
            var sewa = document.getElementById("sewa").value;
            var formJamHarian = document.getElementById("form-jam-harian");
            var formBulanan = document.getElementById("form-bulanan");

            formJamHarian.style.display = "none";
            formBulanan.style.display = "none";

            if (sewa === "jam/harian") {
                formJamHarian.style.display = "block";
            } else if (sewa === "bulanan") {
                formBulanan.style.display = "block";
            }
        }

        const logoutButton = document.getElementById('logoutButton');

        // Add a click event listener to the logout button
        logoutButton.addEventListener('click', function() {
            // Show the confirmation dialog
            Swal.fire({
                title: "Log Keluar",
                // text: "You won't be able to revert this!",
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
                        window.location.href = 'controller/auth/logout.php'; // Update with your actual logout URL
                    });
                }
            });
        });


        $(document).ready(function() {
            $('.createTempahan').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // // Log the selected Kerja values
                // logKerjaData();

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/create_tempahan.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Penambahan Berjaya',
                            }).then(() => {
                                window.location.href = 'sewaan.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                    }
                });
            });
        });

        function logKerjaData() {
            // Collect all values of the kerja fields
            const kerjaFields = document.querySelectorAll('select[name="kerja[]"]');
            const kerjaValues = Array.from(kerjaFields).map(select => select.value);

            // Log the values to the console
            console.log("Selected Kerja values:", kerjaValues);
        }
    </script>

</body>

</html>