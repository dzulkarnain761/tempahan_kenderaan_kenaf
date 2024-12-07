<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>eBooking</title>
	<link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
    <link href="penyewaDashboard/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <style>
    </style>
</head>

<body style="height: 100%;">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Daftar Masuk</h5>
                <img src="assets/images/logo_tempahan_kenderaan.png" alt="logoLKTN" style="width: auto; height: 50px;">
            </div>
            <div class="modal-body">
                <form class="signupForm" novalidate>
                    <div class="mb-3">
                        <label for="nokp" class="form-label">No. Kad Pengenalan <span style="color: red;">*</span>  </label>
                        <input type="text" class="form-control" id="nokp" name="nokp" placeholder="Masukkan Nombor Kad Pengenalan" minlength="12" maxlength="12" required>
                        <div class="invalid-feedback">
                            Sila masukkan nombor kad pengenalan yang sah.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Nama Penuh <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Masukkan Nama Penuh" minlength="10" required>
                        <div class="invalid-feedback">
                            Sila masukkan nama penuh yang sah.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contactno" class="form-label">Nombor Telefon <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Masukkan Nombor Telefon"  minlength="10" maxlength="11" required>
                        <div class="invalid-feedback">
                            Sila masukkan nombor telefon yang sah.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Rumah <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Rumah" minlength="10" required>
                        <div class="invalid-feedback">
                            Sila masukkan alamat yang sah.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mail" class="form-label">Email </label>
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="Masukkan Email">
                        <div class="invalid-feedback">
                            Sila masukkan nama penuh yang sah.
                        </div>
                    </div>

                    
                    <!-- <div class="mb-3">
                        <label for="kataLaluan" class="form-label">Kata Laluan :</label>
                        <input type="password" class="form-control" id="kataLaluan" name="kataLaluan" placeholder="Masukkan Kata Laluan" minlength="5" required>
                        <div class="invalid-feedback">
                            Sila Pastikan Kata Laluan Melebihi 5 Aksara.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPass" class="form-label">Sahkan Kata Laluan :</label>
                        <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Sahkan Kata Laluan" minlength="5" required>
                        <div class="invalid-feedback">
                            Sila sahkan kata laluan.
                        </div>
                    </div> -->
                    <!-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label class="form-check-label" for="showPassword">Lihat Kata Laluan</label>
                    </div> -->
                    <div class="modal-footer">
                        <button id="signupButton" type="submit" class="btn btn-primary">Daftar Masuk</button>
                    </div>
                    <div style="text-align:center; margin-top: 10px;">
                        <p style="font-size:17px;"><a href="login.php">Kembali ke Log masuk</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
    <script src="vendor/jquery/jquery-3.7.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <!-- <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->



    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.signupForm')

            // Loop over them and prevent submission if validation fails
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })

            // Toggle password visibility
            // const showPasswordCheckbox = document.getElementById('showPassword');
            // const passwordInput = document.getElementById('kataLaluan');
            // const confirmPasswordInput = document.getElementById('confirmPass');

            // showPasswordCheckbox.addEventListener('change', () => {
            //     const type = showPasswordCheckbox.checked ? 'text' : 'password';
            //     passwordInput.type = type;
            //     confirmPasswordInput.type = type;
            // });

            // function restrictToNumbers(inputId) {
            //     document.getElementById(inputId).addEventListener('input', function(e) {
            //         this.value = this.value.replace(/\D/g, '');
            //     });
            // }

            // restrictToNumbers('nokp');
            // restrictToNumbers('contactno');
        })()

        $(document).ready(function() {
            $('.signupForm').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/auth/signup_penyewa_proses.php',
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
                                // window.location.href = 'login.php';
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Kata Laluan Anda : ',
                                    text: res.password,
                                }).then(() => {
                                    window.location.href = 'login.php';
                                })
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