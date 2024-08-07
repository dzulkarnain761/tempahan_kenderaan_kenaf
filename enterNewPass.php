<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
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
                <h5 class="modal-title fw-bold">Tukar Kata Laluan</h5>
                <img src="assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
            </div>
            <div class="modal-body">
                <form>
                    <p class="intro">Sila masukkan kata laluan baharu anda.</p>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Kata Laluan Baharu:</label>
                        <input type="password" class="form-control" id="newPassword"
                            placeholder="Masukkan Kata Laluan Baharu" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Sahkan Kata Laluan Baharu:</label>
                        <input type="password" class="form-control" id="confirmPassword"
                            placeholder="Sahkan Kata Laluan Baharu" required>
                    </div>
                    <div class="modal-footer">
                        <button id="resetButton" type="button" class="btn btn-primary">Hantar</button>
                    </div>
                    <div style="text-align:center; margin-top: 10px;">
                        <p><a href="login.php">Kembali ke Log masuk</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('resetButton').addEventListener('click', function () {
            var newPassword = document.getElementById('newPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;

            if (newPassword === confirmPassword) {
                // Passwords match; proceed with password reset
                alert('Kata Laluan telah berjaya ditukar!');
                // Optionally, redirect to login or other page
                window.location.href = 'login.php';
            } else {
                // Passwords do not match; show error
                alert('Kata laluan tidak sepadan. Sila cuba lagi.');
            }
        });
    </script>

</body>

</html>