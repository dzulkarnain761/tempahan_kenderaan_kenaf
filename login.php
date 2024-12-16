<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>eTempahan BKK</title>
	<link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
</head>
<body class="d-flex flex-column align-items-center justify-content-center vh-100 bg-light">
    <!-- Logo -->
    <div class="mb-4">
    <img src="assets/img/logo_tempahan_kenderaan_black.png" alt="Logo" class="img-fluid" style="width: 200px; height:auto;">
    </div>

    <!-- Login Form Container -->
    <div class="container-sm border rounded p-4 bg-white shadow" style="max-width: 500px;">
        <h3 class="text-center mb-4">Log Masuk</h3>
        <form>
            <div class="mb-3">
                <label for="no_kp" class="form-label">No Kad Pengenalan</label>
                <input type="text" class="form-control" id="no_kp" placeholder="Masukkan No Kad Pengenalan" maxlength="12">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Laluan</label>
                <input type="password" class="form-control" id="password" placeholder="Masukkan Kata Laluan">
            </div>
            <button type="submit" class="btn btn-primary w-100">Log Masuk</button>
        </form>
        <p class="mt-3 text-center">Tiada Akaun? <a href="signup.php">Daftar Sekarang</a></p>
    </div>

</body>
</html>
