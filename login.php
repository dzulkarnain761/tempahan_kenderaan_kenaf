<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>eTEMPAHAN JENTERA</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
	<link href="assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
	<style>
        
	.logo-top-left {
    display: flex;
    justify-content: flex-start; 
    align-items: center;
    position: absolute;
    top: 10px;
    left: 10px; 
    z-index: 1000;
}
	   
	    .logo-top-right {
    position: absolute;
    top: 10px;
    right: 10px; /* Ubah dari 'left' ke 'right' */
    z-index: 1000;
}

	   
	   @keyframes swing {
    0% {
        transform: rotate(0deg); 
    }
    50% {
        transform: rotate(3deg); 
    }
    100% {
        transform: rotate(0deg); 
    }
}

.right-image img {
    animation: swing 4s ease-in-out infinite; 
}

	  @keyframes floatScale {
    0%, 100% {
        transform: translateY(0) scale(1);
    }
    50% {
        transform: translateY(-10px) scale(1.05);
    }
}

.right-image img {
    animation: floatScale 5s ease-in-out infinite;
}
		
</style>
</head>

<body class="background-custom" style="background-image: url(assets/images/logo/auth-bg1.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">
    <!-- Logo -->
    <div class="mb-4 logo-top-right">
		  <a href="index.php">
         <img src="assets/images/logo/logo baru.png" alt="ejentera" height="100" class="responsive-img">
		 </a>
    </div>
	
	<div class="logo-top-left">
    <a href="">
        <img src="assets/images/logo/headlktn1.png" alt="Logo LKTN" height="30" class="responsive-img">
    </a>
</div>

    <!-- Login Form Container -->
    <div class="container-sm border rounded p-4 bg-white shadow ms-6" style="max-width: 500px; margin-top: 100px;">
        <h3 class="text-center mb-4">LOG MASUK SISTEM</h3>
        <form id="loginForm" action="Controller/auth/login_proses.php" method="post">
            <div class="mb-3">
                <label for="no_kp" class="form-label">No Kad Pengenalan</label>
                <input type="text" class="form-control" id="no_kp" name="no_kp" placeholder="Masukkan No Kad Pengenalan" maxlength="12" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Laluan</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Laluan" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Log Masuk</button>
        </form>
        <p class="mt-3 text-center">Tiada Akaun? <a href="signup.php">Daftar Sekarang</a></p>
		
		
    </div>
	
	

   
	<script src="assets/js/sweetalert2.min.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
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
                });
        });
    </script>

</body>

</html>