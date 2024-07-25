<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/images/styles/login.css">
</head>
<body>

    <div class="container">
        <div class="login-container">
            <h2>Log Masuk</h2>
			<div style="text-align:left;">
			<label for="nokp">No Kad Pengenalan:<label/>
			</div>
            <input type="text" id="nokp" placeholder="NoKp" required>
			<div style="margin: 20px 0;">
			</div>
			<div style="text-align:left;">
			<label for="password">Kata Laluan:</label>
			</div>
            <input type="password" id="password" placeholder="Kata Laluan" required>
			<div style="margin-top: 0; padding-top: 0">
			<p class="forgot-password"><a href="forgotPassword.html">Lupa Kata Laluan</a></p>
            </div>
			<button id="loginButton">Log Masuk</button>
            <p>Belum daftar? <a href="signup.html">Daftar</a></p>
        </div>
    </div>

    <script>
        document.getElementById('loginButton').addEventListener('click', function() {
            window.location.href = 'homepage.html'; // Change 'homepage.html' to the URL of your main page
        });
    </script>

</body>
</html>
