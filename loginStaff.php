<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

    <div class="container">
        <div class="login-container">
            <h2>Log Masuk</h2>
			<label for="email">Email :</label>
            <input type="text" id="email" placeholder="Email" required><br><br>
			<label for="password">Kata Laluan:</label>
            <input type="password" id="password" placeholder="Kata Laluan" required>
			<p class="forgot-password"><a href="forgotPassword.php">Lupa Kata Laluan</a></p>
			<button id="loginButton">Log Masuk</button>
			<div style="text-align:center;">
				<p>Belum daftar? <a href="signup.php">Daftar</a></p>
			</div>
        </div>
    </div>

    
</body>
</html>
