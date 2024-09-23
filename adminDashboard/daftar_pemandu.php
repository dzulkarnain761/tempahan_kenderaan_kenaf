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
                    <li class="breadcrumb-item"><a href="pemandu.php">Pemandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Pemandu</li>
                </ol>
            </nav>
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Daftar Pemandu</h2>
                </div>

                <form class="registerDriver" novalidate>
                    <div class="mb-3">
                        <label for="nama_pemandu" class="form-label">Nama Pemandu</label>
                        <input type="text" class="form-control" id="nama_pemandu" name="nama_pemandu" placeholder="Masukkan Nama Pemandu" minlength="10" required>
                        <div class="invalid-feedback">Sila masukkan nama pemandu.</div>
                    </div>

                    <div class="mb-3">
                        <label for="no_kp" class="form-label">Nombor Kad Pengenalan</label>
                        <input type="text" class="form-control" id="no_kp" name="no_kp" minlength="12" maxlength="12" placeholder="Masukkan Nombor Kad Pengenalan" required>
                        <div class="invalid-feedback">Sila masukkan nombor kad pengenalan.</div>
                    </div>

                    <div class="mb-3">
                        <label for="no_tel" class="form-label">Nombor Telefon</label>
                        <input type="tel" class="form-control" id="no_tel" name="no_tel" placeholder="Masukkan Nombor Telefon" minlength="10" maxlength="11" required>
                        <div class="invalid-feedback">Sila masukkan nombor telefon.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email_pemandu" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_pemandu" name="email_pemandu" placeholder="Masukkan Email">
                        <div class="invalid-feedback">Sila masukkan Email yang betul.</div>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="kategori_lesen" class="form-label">Kategori Lesen</label>
                        <select id="kategori_lesen" class="form-control" name="kategori_lesen" required>
                            <option disabled selected value="">Pilih Kategori Lesen</option>
                            <?php

                            // $sqlKategori = "SELECT * FROM `kategori_lesen`";

                            // $resultKategori = mysqli_query($conn, $sqlKategori);

                            // while ($row = mysqli_fetch_assoc($resultKategori)) {
                            //     echo '<option value="' . $row['kategori'] . '">' . $row['kategori'] . ' - ' . $row['description'] . '</option>';
                            // }
                            ?>
                        </select>
                        <div class="invalid-feedback">Sila pilih kategori lesen.</div>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="tarikh_tamat_lesen" class="form-label">Tarikh Tamat Lesen</label>
                        <input type="date" class="form-control" id="tarikh_tamat_lesen" name="tarikh_tamat_lesen" placeholder="Pilih Tarikh Tamat Lesen" required>
                        <div class="invalid-feedback">Sila pilih tarikh tamat lesen.</div>
                    </div> -->
                    <!-- 
                    <div class="mb-3">
                        <label for="status_pemandu" class="form-label">Status</label>
                        <select id="status_pemandu" class="form-control" name="status_pemandu" required>
                            <option selected disabled value="">--Pilih Status--</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                        <div class="invalid-feedback">Sila pilih status.</div>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="kata_laluan" class="form-label">Kata Laluan</label>
                        <input type="password" class="form-control" id="kata_laluan" name="kata_laluan" placeholder="Masukkan Kata Laluan" required>
                        <div class="invalid-feedback">Sila masukkan kata laluan.</div>
                    </div>

                    <div class="mb-3">
                        <label for="sahkan_kata_laluan" class="form-label">Sahkan Kata Laluan</label>
                        <input type="password" class="form-control" id="sahkan_kata_laluan" name="sahkan_kata_laluan" placeholder="Sahkan Kata Laluan" required>
                        <div class="invalid-feedback">Sila sahkan kata laluan.</div>
                    </div> -->

                    <div class="modal-footer">
                        <!-- <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="showPassword">
                            <label class="form-check-label" for="showPassword">Lihat Kata Laluan</label>
                        </div> -->
                        <div>
                            <button type="submit" class="btn btn-primary">Daftar Pemandu</button>
                        </div>
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
            const forms = document.querySelectorAll('.registerDriver')

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

            // const showPasswordCheckbox = document.getElementById('showPassword');
            // const passwordInput = document.getElementById('kata_laluan');
            // const confirmPasswordInput = document.getElementById('sahkan_kata_laluan');

            // showPasswordCheckbox.addEventListener('change', () => {
            //     const type = showPasswordCheckbox.checked ? 'text' : 'password';
            //     passwordInput.type = type;
            //     confirmPasswordInput.type = type;
            // });


        })()


        $(document).ready(function() {
            $('.registerDriver').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/add/signup_pemandu.php',
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
                                window.location.href = 'pemandu.php';
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

</html