<?php
session_start();

if (isset($_SESSION["pengguna_id"])) {
    header("Location: homepage.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="login-container">
            <form id="loginForm" method="POST"x-data>
                <h2>Log Masuk</h2>
                <label for="nokp">No Kad Pengenalan:</label>
                <input x-mask="999999-99-9999" type="text" id="nokp" name="nokp" placeholder="No Kad Pengenalan" required><br><br>
                <label for="password">Kata Laluan:</label>
                <input type="password" id="password" name="password" placeholder="Kata Laluan" required>
                <p class="forgot-password"><a href="forgotPassword.php">Lupa Kata Laluan</a></p>
                <button type="submit" id="submit">Log Masuk</button>
                <div style="text-align:center;">
                    <p>Belum daftar? <a href="signup.php">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>

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
                                window.location.href = 'homepage.php';
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
        });
    </script>

</body>

</html>