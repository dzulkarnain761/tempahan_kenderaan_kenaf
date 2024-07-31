<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Masuk</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="signup-container">
            <form id="signupForm" x-data>
                <h2>Daftar Masuk</h2>
                <label for="nokp">No Kad Pengenalan :</label>
                <input x-mask="999999-99-9999" type="text" id="nokp" name="nokp" placeholder="No Kad Pengenalan" required oninvalid="this.setCustomValidity('Isi No Kad Pengenalan')" oninput="this.setCustomValidity('')"><br><br>
                <label for="fullname">Nama Penuh :</label>
                <input type="text" id="fullname" name="fullname" placeholder="Nama Penuh" required oninvalid="this.setCustomValidity('Isi Name Penuh')" oninput="this.setCustomValidity('')"><br><br>
                <label for="contactno">No Telefon :</label>
                <input x-mask="999-99999999" type="text" id="contactno" name="contactno" placeholder="No Telefon" required oninvalid="this.setCustomValidity('Isi No Telefon')" oninput="this.setCustomValidity('')"><br><br>
                <label for="password">Kata Laluan:</label>
                <input type="password" id="password" name="password" placeholder="Kata Laluan" required oninvalid="this.setCustomValidity('Isi Kata Laluan')" oninput="this.setCustomValidity('')"><br><br>
                <label for="confirmPass">Sahkan Kata Laluan :</label>
                <input type="password" id="confirmPass" name="confirmPass" placeholder="Sahkan Kata Laluan" required oninvalid="this.setCustomValidity('Sahkan Kata Laluan')" oninput="this.setCustomValidity('')"><br><br>

                <button type="submit">Daftar Masuk</button>
            </form>
            <p><a href="login.php">Kembali ke Log masuk</a></p>
        </div>
    </div>

    <script>
        
       
        $(document).ready(function() {
            $('#signupForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'controller/signup_penyewa_proses.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Pendaftaran Berjaya',
                            }).then(() => {
                                window.location.href = 'login.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>