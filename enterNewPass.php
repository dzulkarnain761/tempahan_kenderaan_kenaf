<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/password.css">
    <title>Booking</title>
</head>
<body>

    <div class="container">
        <div class="reset-password-container">
            <h2>Tukar Kata Laluan</h2>
            <p>Sila masukkan kata laluan baharu anda.</p>
            <input type="password" id="newPassword" placeholder="Kata Laluan Baharu" required>
            <input type="password" id="confirmPassword" placeholder="Sahkan Kata Laluan" required>
            <button id="resetButton">Hantar</button>
            <p><a href="login.php">Kembali ke Log masuk</a></p>
        </div>
    </div>
    <script>
        document.getElementById('resetButton').addEventListener('click', function() {
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
