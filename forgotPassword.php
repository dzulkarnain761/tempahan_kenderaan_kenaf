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
        <div class="forgot-password-container">
            <h2>Lupa Kata Laluan</h2>
			<div style="text-align: left;">
            <p>Sila masukkan nombor kad pengenalan anda untuk menukar kata laluan baharu.</p>
            <input type="noKp" id="noKp" placeholder="Masukkan No Kad Pengenalan" required>
			</div>
            <button id="resetButton">Sahkan</button>
            <p><a href="login.php">Kembali ke Log masuk</a></p>
        </div>
    </div>
	<script>
        document.getElementById('resetButton').addEventListener('click', function() {
            window.location.href = 'enterNewPass.php';
        });
    </script>

</body>
</html>
