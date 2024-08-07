<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Booking</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <style>
    </style>
</head>

<body>

   

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="profil.php" class="logo">
                            <img src="assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
                            <img src="assets/images/logo.jpeg" alt="logoLKTN" style="width: 120px; height: auto;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="homepage.php">Laman Utama</a></li>
                            <li class="scroll-to-section"><a href="tempahan.php">Tempah</a></li>
                            <li class="scroll-to-section"><a href="sewaan.php">Sewaan</a></li>
                            <li class="scroll-to-section"><a href="bayaran.php">Bayaran</a></li>
                            <li class="scroll-to-section"><a href="profil.php" class="active">Profil</a></li>
                            <li class="scroll-to-section">
                                <div class="border-first-button">
                                    <button id="logoutButton">Logout</button>
                                </div>
                            </li>
                        </ul>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Profile ***** -->
    <div class="page-content page-container d-flex justify-content-center align-items-center" id="page-content" style="min-height: 100vh;">
        <div class="row container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-xl-8 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white d-flex justify-content-center align-items-center" style="height: 100%;">
                                <div class="m-b-25">
                                    <img src="assets/images/profil.png" class="img-radius" alt="User-Profile-Image" style="width: 170px; height: 170px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600" style="font-size: 1.5rem;">Maklumat</h6>
                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nama Penuh</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;">NAMA PENUH BINTI NAMA PENUH</h6>
                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nombor Kad Pengenalan</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;">000000-00-0000</h6>
                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nombor Telefon</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;">000-0000000</h6>
                                <div class="text-end border-first-button">
                                    <!-- Button to trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                        Tukar Kata Laluan
                                    </button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeEditModal">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tukar Kata Laluan -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Tukar Kata Laluan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Kata Laluan Semasa</label>
                            <input type="password" class="form-control" id="currentPassword" placeholder="Masukkan kata laluan semasa">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Kata Laluan Baru</label>
                            <input type="password" class="form-control" id="newPassword" placeholder="Masukkan kata laluan baru">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Sahkan Kata Laluan Baru</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Sahkan kata laluan baru">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div class="modal fade" id="changeEditModal" tabindex="-1" aria-labelledby="changeEditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeEditModalLabel">Edit Maklumat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="currentName" class="form-label">Nama Penuh</label>
                            <input type="text" class="form-control" id="currentName" value="NAMA PENUH BINTI NAMA PENUH">
                        </div>
                        <div class="mb-3">
                            <label for="currentNoKp" class="form-label">Nombor Kad Pengenalan</label>
                            <input type="text" class="form-control" id="currentNoKp" value="000000-00-0000">
                        </div>
                        <div class="mb-3">
                            <label for="currentNoTel" class="form-label">Nombor Telefon</label>
                            <input type="text" class="form-control" id="currentNoTel" value="000-0000000">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/jquery/jquery-3.7.1.min.js" defer></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/custom.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    <script>
        const logoutButton = document.getElementById('logoutButton');

        // Add a click event listener to the logout button
        logoutButton.addEventListener('click', function() {
            // Show the confirmation dialog
            Swal.fire({
                title: "Log Keluar",
                // text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal",
                confirmButtonText: "Log Keluar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Handle the logout logic here (e.g., redirecting to a logout route)
                    // Example: window.location.href = '/logout';

                    // Show the success dialog
                    Swal.fire({
                        title: "Logged out!",
                        text: "You have been successfully logged out.",
                        icon: "success"
                    }).then(() => {
                        // Optionally, redirect the user after the success dialog
                        window.location.href = 'controller/auth/logout.php'; // Update with your actual logout URL
                    });
                }
            });
        });
    </script>
</body>

</html>