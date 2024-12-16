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
        <img src="assets/images/logo/logo_tempahan_kenderaan_black.png" alt="Logo" class="img-fluid" style="width: 200px; height:auto;">
    </div>

    <!-- Login Form Container -->
    <div class="container-sm border rounded p-4 bg-white shadow" style="max-width: 500px;">
        <h3 class="text-center mb-4">Pendaftaran Penyewa</h3>
        <form>
            <div class="mb-3">
                <label for="nama_penuh" class="form-label">Nama Penuh <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_penuh" placeholder="Masukkan Nama Penuh">
            </div>
            <div class="mb-3">
                <label for="no_kp" class="form-label">No Kad Pengenalan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="no_kp" placeholder="Masukkan No Kad Pengenalan">
            </div>
            <div class="mb-3">
                <label for="contact_no" class="form-label">No Telefon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="contact_no" placeholder="Masukkan No Telefon">
            </div>
            <div class="mb-3">
                <label for="alamat_rumah" class="form-label">Alamat Rumah <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat_rumah" placeholder="Masukkan Alamat Rumah"></textarea>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Masukkan Email">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="mt-3 text-center">Sudah Daftar? <a href="login.php">Log Masuk</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>