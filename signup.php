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

<body class="d-flex flex-column align-items-center justify-content-center vh-100" style="background-color: #d8e6ff;">
    <!-- Logo -->
    <div class="mb-4">
        <img src="assets/images/logo/logo_tempahan_kenderaan_black.png" alt="Logo" class="img-fluid" style="width: 200px; height:auto;">
    </div>

    <!-- Login Form Container -->
    <div class="container-sm border rounded p-4 bg-white shadow" style="max-width: 500px;">
        <h3 class="text-center mb-4">Pendaftaran Penyewa</h3>
        <form id="signupForm" action="Controller/auth/signup_penyewa_proses.php" method="post">
            <div class="mb-3">
                <label for="nama_penuh" class="form-label">Nama Penuh <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_penuh" name="nama_penuh" placeholder="Masukkan Nama Penuh"  required>
            </div>
            <div class="mb-3">
                <label for="no_kp" class="form-label">No Kad Pengenalan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="no_kp" name="no_kp" placeholder="Masukkan No Kad Pengenalan" maxlength="12" required>
            </div>
            <div class="mb-3">
                <label for="contact_no" class="form-label">No Telefon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Masukkan No Telefon" maxlength="13" required>
            </div>
            <div class="mb-3">
                <label for="alamat_rumah" class="form-label">Alamat Rumah <span class="text-danger">*</span></label>
                <textarea class="form-control" id="alamat_rumah" name="alamat" placeholder="Masukkan Alamat Rumah" required></textarea>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="mt-3 text-center">Sudah Daftar? <a href="login.php">Log Masuk</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Success - Show a success message and redirect
                        Swal.fire({
                            icon: 'success',
                            title: 'Berjaya',
                            text: "Password : " + data.password,
                        }).then(() => {
                            window.location.href = "login.php";
                        });
                    } else {
                        // Failure - Show an error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Ralat',
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Kesalahan berlaku semasa menghantar borang. Sila cuba lagi.',
                    });
                });
        });
    </script>
</body>

</html>