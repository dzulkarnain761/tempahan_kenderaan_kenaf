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

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="tetapan.php">Tetapan</a></li>
                    <li class="breadcrumb-item"><a href="crud_tugasan.php">Tugasan </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Tugasan</li>
                </ol>
            </nav>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h3>Tambah Tugasan</h3>
                </div>

                <form class="tambahTugasan" novalidate>

                    <div class="mb-3">
                        <label for="kategori_kenderaan_input" class="form-label">Kategori Kenderaan</label>
                        <select name="kategori_kenderaan" id="kategori_kenderaan" class="form-control" required>
                            <option value="" selected disabled>--Pilih Kategori--</option>
                            <?php

                            // Query to fetch categories
                            $sql = "SELECT id, kategori FROM kategori_kenderaan";
                            $result = mysqli_query($conn, $sql);

                            // Check if there are results and populate the dropdown
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . htmlspecialchars($row['kategori']) . '">' . htmlspecialchars($row['kategori']) . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>No categories available</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Sila Pilih Kategori Kenderaan
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama_kerja_input" class="form-label">Nama Kerja</label>
                        <input type="text" class="form-control" id="nama_kerja_input" name="nama_kerja" placeholder="Masukkan Nama Kerja" required>
                        <div class="invalid-feedback">
                            Sila masukkan nama kerja.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kadar_per_jam_input" class="form-label">Kadar Per Jam</label>
                        <input type="text" class="form-control" id="kadar_per_jam_input" name="kadar_per_jam" placeholder="Masukkan kadar Per Jam" required>
                        <div class="invalid-feedback">
                            Sila masukkan kadar per jam.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah Tugasan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
    <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.tambahTugasan')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()


        $(document).ready(function() {
            $('.tambahTugasan').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/add/add_tugasan.php',
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
                                window.location.href = 'crud_tugasan.php';
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
    </script>

</body>

</html>