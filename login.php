<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="assets/images/styles/login.css">
</head>
<body>

    <div class="container">
        <div class="login-container">
            <h2>Log Masuk</h2>
			<label for="nokp">No Kad Pengenalan:<label/>
            <input type="text" id="nokp" placeholder="No Kad Pengenalan" required><br><br>
			<label for="password">Kata Laluan:</label>
            <input type="password" id="password" placeholder="Kata Laluan" required>
			<p class="forgot-password"><a href="forgotPassword.php">Lupa Kata Laluan</a></p>
			<button id="loginButton">Log Masuk</button>
			<div style="text-align:center;">
				<p>Belum daftar? <a href="signup.php">Daftar</a></p>
			</div>
        </div>
    </div>

    <script>
        document.getElementById('loginButton').addEventListener('click', function() {
            window.location.href = 'homepage.php'; // Change 'homepage.html' to the URL of your main page
        });
    </script>

</body>
</html>
