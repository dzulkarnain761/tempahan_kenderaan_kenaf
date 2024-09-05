
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>eBooking</title>
	<link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
    </style>
</head>

<body>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Log Masuk</h5>
                <img src="assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
            </div>
            <div class="modal-body">
                <form class="loginForm" novalidate>
                    <div class="mb-3">
                        <label for="nokp" class="form-label">Nombor Kad Pengenalan:</label>
                        <input type="text" class="form-control" id="nokp" name="nokp" placeholder="Masukkan Nombor Kad Pengenalan" minlength="12" maxlength="12" required>
                        <div class="invalid-feedback">
                            Sila masukkan nombor kad pengenalan yang sah.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kataLaluan" class="form-label">Kata Laluan</label>
                        <input type="password" class="form-control" id="kataLaluan" name="kataLaluan"  placeholder="Masukkan Kata Laluan" required>
                        <div class="invalid-feedback">
                            Sila masukkan kata laluan yang sah.
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label class="form-check-label" for="showPassword">Lihat Kata Laluan</label>
                    </div>
					<div class="modal-footer">
                        <button id="loginButton" type="submit" class="btn btn-primary">Log Masuk</button>
                    </div>
                    <div style="text-align:center; margin-top: 10px;">
                        <p>Belum daftar? <a href="signup.php">Daftar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
    <script src="vendor/jquery/jquery-3.7.1.min.js"></script>

    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.loginForm')

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
            // const passwordInput = document.getElementById('kataLaluan');
            // const confirmPasswordInput = document.getElementById('confirmPass');

            // showPasswordCheckbox.addEventListener('change', () => {
            //     const type = showPasswordCheckbox.checked ? 'text' : 'password';
            //     passwordInput.type = type;
            //     confirmPasswordInput.type = type;
            // });

        })()




        $(document).ready(function() {
            $('.loginForm').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/auth/login_proses.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            }).then(() => {
                                window.location.href = res.location;
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