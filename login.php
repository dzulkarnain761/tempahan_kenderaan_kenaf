<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>eTEMPAHAN JENTERA</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="d-flex flex-column align-items-center justify-content-center vh-100 " style="background-color: #d8e6ff;">
    <!-- Logo -->
    <div class="mb-4">
        <img src="assets/images/logo/logo_tempahan_kenderaan_black.png" alt="Logo" class="img-fluid" style="width: 200px; height:auto;">
    </div>



    <!-- Login Form Container -->
    <div class="container-sm border rounded p-4 bg-white shadow" style="max-width: 500px;">
        <h3 class="text-center mb-4">Log Masuk</h3>
        <form id="loginForm" action="Controller/auth/login_proses.php" method="post">
            <div class="mb-3">
                <label for="no_kp" class="form-label">No Kad Pengenalan</label>
                <input type="text" class="form-control" id="no_kp" name="no_kp" placeholder="Masukkan No Kad Pengenalan" maxlength="12" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Laluan</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Laluan" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="loginButton">
                <span class="spinner-border spinner-border-sm d-none" id="loadingSpinner" role="status" aria-hidden="true"></span>
                <span id="buttonText">Log Masuk</span>
            </button>
        </form>
        <p class="mt-3 text-center">Tiada Akaun? <a href="signup.php">Daftar Sekarang</a></p>
    </div>

    <script src="assets/js/sweetalert2.min.js"></script>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            const submitButton = document.getElementById('loginButton');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const buttonText = document.getElementById('buttonText');

             // Show loading animation
             submitButton.setAttribute('disabled', 'true');
            loadingSpinner.classList.remove('d-none');
            buttonText.textContent = 'Memproses...';


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
                            text: data.message,
                        }).then(() => {
                            window.location.href = data.location;
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
                }).finally(() => {
                    // Hide loading animation and enable button
                    submitButton.removeAttribute('disabled');
                    loadingSpinner.classList.add('d-none');
                    buttonText.textContent = 'Log Masuk';
                });
        });
    </script>

</body>

</html>