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
        .forgot-password-container {
            flex: 1;
            padding: 40px;
            text-align: center;
        }
        .forgot-password-container h2 {
            margin-bottom: 20px;
            font-size: 2em;
            color: #333;
        }
        .forgot-password-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }
        .forgot-password-container button {
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
        .forgot-password-container button:hover {
            background: #767af5;
        }
        .forgot-password-container p {
            font-size: 0.9em;
            color: #666;
        }
        .forgot-password-container p a {
            color: #2575fc;
            text-decoration: none;
        }
        .forgot-password-container p a:hover {
            text-decoration: underline;
        }
    </style>
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
