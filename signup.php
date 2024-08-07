<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
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

        .modal-header {
            display: flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1rem;
            border-bottom: 1px solid #dee2e6;
            border-top-left-radius: calc(.3rem - 1px);
            border-top-right-radius: calc(.3rem - 1px);
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
    </style>
</head>

<body>

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Daftar Masuk</h5>
                <img src="assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="nokp" class="form-label">Nombor Kad Pengenalan:</label>
                        <input type="text" class="form-control" id="nokp" placeholder="Masukkan Nombor Kad Pengenalan"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Penuh :</label>
                        <input type="text" class="form-control" id="name" placeholder="Masukkan Nama Penuh" required>
                    </div>
                    <div class="mb-3">
                        <label for="contactno" class="form-label">Nombor Telefon :</label>
                        <input type="text" class="form-control" id="contactno" placeholder="Masukkan Nombor Telefon"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="kataLaluan" class="form-label">Kata Laluan :</label>
                        <input type="password" class="form-control" id="kataLaluan" placeholder="Masukkan Kata Laluan"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPass" class="form-label">Sahkan Kata Laluan :</label>
                        <input type="password" class="form-control" id="confirmPass" placeholder="Sahkan Kata Laluan"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button id="signupButton" type="button" class="btn btn-primary">Daftar Masuk</button>
                    </div>
                    <div style="text-align:center; margin-top: 10px;">
                        <p><a href="login.php">Kembali ke Log masuk</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var password = document.getElementById("password");
            var confirmPass = document.getElementById("confirmPass");
            if (password.type === "password") {
                password.type = "text";
                confirmPass.type = "text";
            } else {
                password.type = "password";
                confirmPass.type = "password";
            }
        }

        $(document).ready(function() {
            $('#signupForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'controller/signup_penyewa_proses.php',
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
                                window.location.href = 'login.php';
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
        document.getElementById('signupButton').addEventListener('click', function () {
            window.location.href = 'login.php';
        });

    });
    </script>
</body>

</html>