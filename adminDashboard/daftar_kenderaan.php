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
                    <li class="breadcrumb-item"><a href="kenderaan.php">Senarai Kenderaan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Kenderaan</li>
                </ol>
            </nav>
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Daftar Kenderaan</h2>
                </div>

                <form class="registerKenderaan" novalidate>
                    <div class="mb-3">
                        <label for="kategori_kenderaan" class="form-label">Pilih Kategori Kenderaan</label>
                        <select id="kategori_kenderaan" class="form-control" name="kategori_kenderaan" required>
                            <option disabled selected value="">--Pilih Kategori Kenderaan--</option>
                            <?php
                            $sqlNegeri = "SELECT * FROM kategori_kenderaan";
                            $resultNegeri = mysqli_query($conn, $sqlNegeri);

                            while ($row = mysqli_fetch_assoc($resultNegeri)) {
                                echo '<option value="' . $row['kategori'] . '">' . $row['kategori'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Sila pilih negeri penempatan.</div>
                    </div>

                    <div class="mb-3">
                        <label for="no_aset" class="form-label">Nombor Aset</label>
                        <input type="text" class="form-control" id="no_aset" name="no_aset" placeholder="Masukkan Nombor Aset " required>
                        <div class="invalid-feedback">Sila masukkan nombor aset.</div>
                    </div>
                    <div class="mb-3">
                        <label for="no_pendaftaran_kenderaan" class="form-label">Nombor Pendaftaran Kenderaan</label>
                        <input type="text" class="form-control" id="no_pendaftaran_kenderaan" name="no_pendaftaran_kenderaan" placeholder="Masukkan Nombor Pendaftaran Kenderaan" required>
                        <div class="invalid-feedback">Sila masukkan nombor pendaftaran kenderaan.</div>
                    </div>

                    <div class="mb-3">
                        <label for="tahun_daftar" class="form-label">Tahun Daftar</label>
                        <input type="text" class="form-control" id="tahun_daftar" name="tahun_daftar" placeholder="Masukkan Tahun Daftar" minlength="4" maxlength="4" required>
                        <div class="invalid-feedback">Sila masukkan tahun daftar.</div>
                    </div>


                    <div class="mb-3">
                        <label for="negeri_penempatan" class="form-label">Negeri Penempatan</label>
                        <select id="negeri_penempatan" class="form-control" name="negeri_penempatan" required>
                            <option disabled selected value="">--Pilih Negeri--</option>
                            <?php
                            $sqlNegeri = "SELECT * FROM negeri";
                            $resultNegeri = mysqli_query($conn, $sqlNegeri);

                            while ($row = mysqli_fetch_assoc($resultNegeri)) {
                                echo '<option value="' . $row['id_negeri'] . '">' . $row['nama_negeri'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Sila pilih negeri penempatan.</div>
                    </div>

                    <div class="mb-3">
                        <label for="kawasan_penempatan" class="form-label">Kawasan</label>
                        <select id="kawasan_penempatan" class="form-control" name="kawasan_penempatan" required>
                            <option disabled selected value="">--Pilih Kawasan--</option>
                            <!-- Options will be populated by AJAX -->
                        </select>
                        <div class="invalid-feedback">Sila pilih kawasan penempatan.</div>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="harga_belian" class="form-label">Harga Belian</label>
                        <input type="text" class="form-control" id="harga_belian" name="harga_belian" placeholder="Masukkan Harga Belian" required>
                        <div class="invalid-feedback">Sila masukkan harga belian.</div>
                    </div> -->
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <input type="text" class="form-control" id="catatan" name="catatan">
                        <!-- <div class="invalid-feedback">Sila masukkan tahun daftar.</div> -->
                    </div>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Daftar Kenderaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.registerKenderaan')

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

            $('#negeri_penempatan').change(function() {
                var id_negeri = $(this).val();

                if (id_negeri) {
                    $.ajax({
                        type: 'POST',
                        url: 'controller/get_kawasan.php',
                        data: {
                            id_negeri: id_negeri
                        },
                        success: function(response) {
                            $('#kawasan_penempatan').html(response);
                        }
                    });
                } else {
                    $('#kawasan_penempatan').html('<option disabled selected>--Pilih Kawasan--</option>');
                }
            });

            $('.registerKenderaan').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/add/signup_kenderaan.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Pendaftaran Berjaya',
                            }).then(() => {
                                window.location.href = 'kenderaan.php';
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