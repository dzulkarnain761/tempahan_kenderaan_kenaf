<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Masuk Page</title>
    <link rel="stylesheet" href="assets/images/styles/login.css">
</head>
<body>

    <div class="container">
        <div class="signup-container">
            <h2>Daftar Masuk</h2>
			<label for="nokp">No Kad Pengenalan:</label>
            <input type="text" id="nokp" placeholder="No Kad Pengenalan" required><br><br>
			<label for="username">Username:</label>
            <input type="text" id="username" placeholder="Username" required><br><br>
			<label for="password">Kata Laluan:</label>
            <input type="password" id="password" placeholder="Kata Laluan" required><br><br>
			<label for="confirmPass">Sahkan Kata Laluan:</label>
            <input type="text" id="confirmPass" placeholder="Sahkan Kata Laluan" required>
			<button id="signupButton">Daftar Masuk</button>
			<p><a href="login.php">Kembali ke Log masuk</a></p>
        </div>
    </div>

    <script>
        document.getElementById('signupButton').addEventListener('click', function() {
            window.location.href = 'login.php'; 
        });
    </script>

</body>
</html>
