<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Booking</title>
    <style>
        html,
        body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            background-color: #fff;
            -ms-text-size-adjust: 100%;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .modal-dialog-centered {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
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

        .modal-content {
            max-height: 100%;
            border: solid grey 2px;
            overflow: hidden;
            box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.19), 0 20px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .modal-dialog {
            max-width: 500px;
            margin: 1.75rem auto;
        }

        .intro {
            font-weight: 600;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Lupa Kata Laluan</h5>
                <img src="assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
            </div>
            <div class="modal-body">
                <form class="resetForm" novalidate>
                    <p class="intro">Sila masukkan nombor kad pengenalan anda untuk menukar kata laluan baharu.</p>
                    <div class="mb-3">
                        <label for="nokp" class="form-label">Nombor Kad Pengenalan:</label>
                        <input type="text" class="form-control" id="nokp" name="nokp" placeholder="Masukkan Nombor Kad Pengenalan" inputmode="numeric" minlength="12" maxlength="12" required>
                        <div class="invalid-feedback">
                            Sila masukkan nombor kad pengenalan yang sah.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="resetButton" type="submit" class="btn btn-primary">Sahkan</button>
                    </div>
                    <div style="text-align:center; margin-top: 10px;">
                        <p><a href="login.php">Kembali ke Log masuk</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.resetForm')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            });

            // function restrictToNumbers(inputId) {
            //     document.getElementById(inputId).addEventListener('input', function(e) {
            //         this.value = this.value.replace(/\D/g, '');
            //     });
            // }

            // restrictToNumbers('nokp');
        })()


        $(document).ready(function() {
            $('.resetForm').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/auth/reset_password.php',
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
                                var encodedValue = encodeURIComponent(res.nokp);
                                window.location.href = 'enterNewPass.php?nokp=' + encodedValue;
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