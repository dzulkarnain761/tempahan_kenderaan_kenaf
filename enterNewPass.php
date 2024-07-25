<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #c9d9f5, #538ff5);
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .reset-password-container {
            flex: 1;
            padding: 40px;
            text-align: center;
        }
        .reset-password-container h2 {
            margin-bottom: 20px;
            font-size: 2em;
            color: #333;
        }
        .reset-password-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }
        .reset-password-container button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background: #2575fc;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background 0.3s;
        }
        .reset-password-container button:hover {
            background: #767af5;
        }
        .reset-password-container p {
            font-size: 0.9em;
            color: #666;
        }
        .reset-password-container p a {
            color: #2575fc;
            text-decoration: none;
        }
        .reset-password-container p a:hover {
            text-decoration: underline;
        }
    </style>
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
