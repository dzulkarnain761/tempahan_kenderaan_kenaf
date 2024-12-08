<?php

include 'controller/connection.php';
include 'controller/session.php';
include 'controller/get_userdata.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <style>
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <?php include 'partials/header.php'; ?>

    <!-- ***** Profile ***** -->
    <div class="page-content page-container d-flex justify-content-center align-items-center wow fadeIn"
        data-wow-duration="0.75s" data-wow-delay="0s" id="page-content" style="min-height: 100vh;">
        <div class="row container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-xl-8 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white d-flex justify-content-center align-items-center"
                                style="height: 100%;">
                                <div class="m-b-25">
                                    <img src="../assets/images/profil.png" class="img-radius" alt="User-Profile-Image"
                                        style="width: 170px; height: 170px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nama Penuh</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;"><?php echo htmlspecialchars($nama); ?></h6>

                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nombor Kad Pengenalan</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;"><?php echo htmlspecialchars($no_kp); ?></h6>

                                <p class="m-b-10 f-w-600" style="font-size: 1.2rem;">Nombor Telefon</p>
                                <h6 class="text-muted f-w-400" style="font-size: 1.2rem;"><?php echo htmlspecialchars($contact_no); ?></h6>
                                <div class="text-end border-first-button">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#changeEditModal">
                                        Kemaskini
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div class="modal fade" id="changeEditModal" tabindex="-1" aria-labelledby="changeEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeEditModalLabel">Edit Maklumat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateProfile" method="POST">
                        <input type="hidden" name="penyewa_id" value="<?php echo $user_id ?>">
                        <div class="mb-3">
                            <label for="currentName" class="form-label">Nama Penuh</label>
                            <input type="text" class="form-control" id="currentName" name="nama" value="<?php echo $nama ?>">
                        </div>
                        <div class="mb-3">
                            <label for="currentNoKp" class="form-label">Nombor Kad Pengenalan</label>
                            <input type="text" class="form-control" id="currentNoKp" name="no_kp" value="<?php echo $no_kp ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="currentNoTel" class="form-label">No. Tel</label>
                            <input type="text" class="form-control" id="currentNoTel" name="contact_no" value="<?php echo $contact_no ?>">
                        </div>
                        <div class="mb-3">
                            <label for="currentNoTel" class="form-label">Alamat </label>
                            <input type="text" class="form-control" id="currentNoTel" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                        <div class="mb-3">
                            <label for="currentNoTel" class="form-label">Email </label>
                            <input type="text" class="form-control" id="currentNoTel" name="email" value="<?php echo $email ?>" placeholder="Sila Isi Email">
                        </div>
                        <div class="mb-3">
                            <label for="currentNoTel" class="form-label">Nama Bank</label>
                            <input type="text" class="form-control" id="currentNoTel" name="nama_bank" value="<?php echo $nama_bank ?>" placeholder="Sila Isi Nama Bank">
                        </div>
                        <div class="mb-3">
                            <label for="currentNoTel" class="form-label">No Bank</label>
                            <input type="text" class="form-control" id="currentNoTel" name="no_bank" value="<?php echo $no_bank ?>" placeholder="Sila Isi No Bank">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/animation.js"></script>
    <script src="../assets/js/imagesloaded.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



    <script>
        function myFunction() {
            const dropdown = document.getElementById("myDropdown");
            dropdown.classList.toggle("show");
            dropdown.setAttribute('aria-expanded', dropdown.classList.contains('show'));
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.closest('.dropdown')) {
                document.getElementById("myDropdown").classList.remove("show");
            }
        };

        $('#updateProfile').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Kemaskini Profil",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/update_profile.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            let res = JSON.parse(response);
                            if (res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.message,
                                }).then(() => {
                                    window.location.reload();
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
                }
            });


        });
    </script>
</body>

</html>