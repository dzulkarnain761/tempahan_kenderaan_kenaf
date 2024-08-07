<?php
session_start();

if (isset($_SESSION["kumpulan"])) {
    if ($_SESSION['kumpulan'] === 'G') {
        header("Location: homepage.php");
        exit();
    } elseif ($_SESSION['kumpulan'] === 'A') {
        header("Location: adminDashboard/dashboard.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
                <form>
                    <div class="mb-3">
                        <label for="nokp" class="form-label">Nombor Kad Pengenalan:</label>
                        <input type="text" class="form-control" id="nokp" placeholder="Masukkan Nombor Kad Pengenalan" required>
                    </div>
                    <div class="mb-3">
                        <label for="kataLaluan" class="form-label">Kata Laluan</label>
                        <input type="password" class="form-control" id="kataLaluan" placeholder="Masukkan Kata Laluan" required>
                    </div>
                    <p class="forgot-password"><a href="forgotPassword.php">Lupa Kata Laluan</a></p>
                    <div class="modal-footer">
                        <button id="loginButton" type="button" class="btn btn-primary">Log Masuk</button>
                    </div>
                    <div style="text-align:center; margin-top: 10px;">
                        <p>Belum daftar? <a href="signup.php">Daftar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
                    $('#loginForm').on('submit', function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: 'controller/login_proses.php',
                            type: 'POST',
                            data: $(this).serialize(),
                            success: function(response) {

                                let res = JSON.parse(response);
                                if (res.success) {

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Log Masuk',
                                        text: res.message,
                                    }).then(() => {
                                        window.location.href = res.location;
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Log Masuk',
                                        text: res.message,
                                    });
                                }
                            },

                        });
                    });
                    document.getElementById('loginButton').addEventListener('click', function() {
                        window.location.href = 'homepage.php';
                    });

                });
    </script>

</body>

</html>