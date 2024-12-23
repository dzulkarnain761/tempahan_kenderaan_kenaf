<?php include 'controller/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php include 'partials/head.php'; ?>

<body style="background-image: url(../../assets/images/logo/auth-bg1.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;" class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">
        <?php include 'partials/left-sidemenu.php'; ?>
        <div class="content-page">
            <div class="content">

                <?php include 'partials/topbar.php'; ?>

                <!-- Start Content-->
                <div class="container-fluid">
					
				<style>
							.custom-card {
								background-color: rgba(255, 255, 255, 0.8); /* Warna putih with transparency */
								border: 1px solid #ddd; 
								border-radius: 8px; 
								box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow  */
							}

							.custom-card-body {
								background-color: transparent; /* Bahagian dalam card transparent */
							}
								
								.black-text {
									color: #172c6b; 
								}
								
								   tr {
									color: #172c6b;
									font-weight: bold; 
								}
								
								.page-title {
								color: #fff; /* Warna putih */
							}
								
							</style>

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                
                                <br><h4 style="color: white">PROFIL</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card custom-card">
									<div class="card-body custom-card-body">
                                    <?php

                                    $user_id = $_SESSION['id'];
                                    require_once '../../Models/Penyewa.php';
                                    $user = new Penyewa();
                                    $userdata = $user->findById($user_id);
                                    
                                    ?>
                                    
                                    <form  method="post" id="updateProfil">
                                        <div class="row mb-3">
                                            <label for="penyewa_id" class="col-3 col-form-label black-text">Penyewa ID</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control black-text" id="penyewa_id" name="penyewa_id" value="<?php echo $userdata['id']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="no_kp" class="col-3 col-form-label black-text">No Kad Pengenalan</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control black-text" id="no_kp" name="no_kp" value="<?php echo $userdata['no_kp']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3"> 
                                            <label for="nama" class="col-3 col-form-label black-text">Nama</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control black-text" id="nama" name="nama" value="<?php echo $userdata['nama']; ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label for="email" class="col-3 col-form-label black-text">Email</label>
                                            <div class="col-9">
                                                <input type="email" class="form-control black-text" id="email" name="email" value="<?php echo $userdata['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="contact_no" class="col-3 col-form-label black-text">No Telefon</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control black-text" id="contact_no" name="contact_no" value="<?php echo $userdata['contact_no']; ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="justify-content-end row">
                                            <div class="col-9">
                                                <button type="submit" onclick="updateProfil()" class="gradient-button">Kemaskini Profil</button>
                                            </div>
                                        </div>
										
										<style>
										.gradient-button {
											background: linear-gradient(45deg, #98FB91, #08B118); /* Gradient */
											border: none;
											color: #000;
											padding: 10px 20px;
											font-size: 16px;
											cursor: pointer;
											border-radius: 5px; 
											transition: background 0.3s ease;
										}

										.gradient-button:hover {
											background: linear-gradient(45deg, #08B118, #98FB91); /*  bila hover */
										}
										</style>
                                    </form>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                
                               <br><h4 style="color: white">MAKLUMAT BANK</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card custom-card">
									<div class="card-body custom-card-body">
                                     
                                    <form  method="post" id="updateBankInfo">
                                        <div class="row mb-3">
                                            <label for="nama_bank" class="col-3 col-form-label black-text">Nama Bank</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control black-text" id="nama_bank" name="nama_bank" value="<?php echo $userdata['nama_bank']; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="no_bank" class="col-3 col-form-label black-text">No Bank</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control black-text" id="no_bank" name="no_bank" value="<?php echo $userdata['no_bank']; ?>" >
                                            </div>
                                        </div>
                                        <input type="hidden" name="penyewa_id" value="<?php echo $userdata['id']; ?>">
                                        
                                        <div class="justify-content-end row">
                                            <div class="col-9">
                                                <button type="submit" onclick="updateBankInfo()" class="gradient-button">Kemaskini Maklumat Bank </button>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>



                </div> <!-- container -->

            </div> <!-- content -->


            <?php include 'partials/footer.php'; ?>

        </div>

        
    </div>
    <!-- END wrapper -->


    <?php include 'partials/script.php'; ?>


    <script>
        function updateProfil() {
            const form = document.getElementById('updateProfil');

            // Validate required fields
            if (!form.checkValidity()) {
                form.reportValidity(); // This will highlight invalid fields and show default messages
                return; // Stop execution if the form is invalid
            }
            event.preventDefault();
            Swal.fire({
                title: "Kemaskini Profil",
                text: "Adakah anda pasti?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(form);

                    fetch('controller/update_profil.php', {
                            method: 'POST',
                            body: new URLSearchParams(formData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berjaya',
                                    text: data.message || 'Berjaya Kemaskini',
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ralat',
                                    text: data.message || 'Ralat tidak diketahui',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ralat',
                                text: 'Ralat memproses respons pelayan',
                            });
                        });
                }
            });
        }


        function updateBankInfo() {
            const form = document.getElementById('updateBankInfo');

            // Validate required fields
            if (!form.checkValidity()) {
                form.reportValidity(); // This will highlight invalid fields and show default messages
                return; // Stop execution if the form is invalid
            }
            event.preventDefault();
            Swal.fire({
                title: "Kemaskini Bank Info",
                text: "Adakah anda pasti?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(form);

                    fetch('controller/update_bank_info.php', {
                            method: 'POST',
                            body: new URLSearchParams(formData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berjaya',
                                    text: data.message || 'Berjaya Kemaskini',
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ralat',
                                    text: data.message || 'Ralat tidak diketahui',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ralat',
                                text: 'Ralat memproses respons pelayan',
                            });
                        });
                }
            });
        }



    </script>

</body>

</html>