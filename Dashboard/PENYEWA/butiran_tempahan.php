<?php include 'controller/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php include 'partials/head.php'; ?>

<body style="background-image: url(../../assets/images/logo/auth-bg1.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;"  class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">

        <?php include 'partials/left-sidemenu.php'; ?>

        <div class="content-page">
            <div class="content">

                <?php include 'partials/topbar.php'; ?>

                <!-- Start Content-->
                <div class="container-fluid">
					
					<style>
						.breadcrumb {
							color: #00C970; /* Warna teks putih */
						}

						.breadcrumb a {
							color: #00C970; /* Warna teks putih untuk pautan */
							text-decoration: none; /* (Pilihan) Buang garisan bawah pautan */
						}

						.breadcrumb a:hover {
							text-decoration: underline; /* (Pilihan) Garisan bawah bila hover */
						}

						.breadcrumb-item.active {
							color: #ooo; /* Warna teks putih untuk item aktif */
						}
					</style>

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
										<li class="breadcrumb-item">
											<a href="tempahan_khidmat_jentera_terkini.php">TEMPAHAN KHIDMAT JENTERA TERKINI</a>
										</li>
										<li class="breadcrumb-item active">BUTIRAN TEMPAHAN</li>
									</ol>
                                </div>
                                <br><h4 style="color: white">BUTIRAN TEMPAHAN</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card custom-card">
									<div class="card-body custom-card-body">
                                    <?php
                                    require_once '../../Models/Tempahan.php';
                                    $tempahan = new Tempahan();
                                    $booking = $tempahan->findByTempahanId($_GET['tempahan_id']);
                                    ?>


                                    <div class="row mb-3">
                                        <label for="lokasi_kerja" class="col-3 col-form-label black-text ">LOKASI TANAH</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control black-text" id="lokasi_kerja" name="lokasi_kerja" value="<?php echo $booking['lokasi_tanah']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="luas_tanah" class="col-3 col-form-label black-text">LUAS TANAH (HEKTAR)</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control black-text" id="luas_tanah" name="luas_tanah" value="<?php echo $booking['luas_tanah']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="created_at" class="col-3 col-form-label black-text">TARIKH TEMPAHAN</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control black-text" id="created_at" name="created_at" value="<?php echo date('d/m/Y g:i A', strtotime($booking['created_at'])); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="catatan" class="col-3 col-form-label black-text">CATATAN</label>
                                        <div class="col-9">
                                            <textarea class="form-control black-text" id="catatan" name="catatan" rows="3" readonly><?php echo !empty($booking['catatan']) ? $booking['catatan'] : 'Tiada Catatan'; ?></textarea>
                                        </div>
                                    </div>






                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
							
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
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
								<br><h4 style="color: white">BUTIRAN KERJA</h4>
                               
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card custom-card">
									<div class="card-body custom-card-body">

                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nama Kerja</th>
                                                    <th>Cadangan Tarikh Kerja</th>

                                                    <?php if ($booking['total_harga_anggaran'] != null) {
                                                        echo '<th>Harga Pengesahan</th>';
                                                    } ?>
                                                    <?php if ($booking['total_harga_sebenar'] != null) {
                                                        echo '<th>Harga Sebenar</th>';
                                                    } ?>
                                                    <?php if ($booking['status_tempahan'] == 'pengesahan pee') {
                                                        echo '<th class="text-center">Tindakan</th>';
                                                    } ?>




                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php
                                                require_once '../../Models/Kerja.php';
                                                $tempahan_kerja = new Kerja();
                                                $works = $tempahan_kerja->findByTempahanId($_GET['tempahan_id']);

                                                foreach ($works as $work) { ?>
                                                    <tr>

                                                        <td>
                                                            <?php echo $work['nama_kerja']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date('d/m/Y', strtotime($work['cadangan_tarikh_kerja'])); ?>
                                                        </td>

                                                        <?php if ($booking['total_harga_anggaran'] != null) { ?>
                                                            <td>
                                                                <?php echo $work['harga_anggaran']; ?>
                                                            </td>
                                                        <?php } ?>
                                                        <?php if ($booking['total_harga_sebenar'] != null) { ?>
                                                            <td>
                                                                <?php echo $work['total_harga']; ?>
                                                            </td>
                                                        <?php } ?>

                                                        <?php if ($booking['status_tempahan'] == 'pengesahan pee') { ?>
                                                            <td class="text-center">
                                                                <button class="btn btn-danger" onclick="batalKerja(<?php echo $work['tempahan_kerja_id'] . ',' . $booking['tempahan_id'] ?>)"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Batal Kerja">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            </td>
                                                        <?php } ?>



                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-2 text-end">

                            </div>
                        </div>
                    </div>
                </div> <!-- container -->


            </div> <!-- content -->




            <?php include 'partials/footer.php'; ?>

        </div>


    </div>
    <!-- END wrapper -->


    <?php include 'partials/script.php'; ?>
    <script>
        function batalKerja(tempahan_kerja_id, tempahan_id) {
            Swal.fire({
                title: "Batal Kerja",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Batal Kerja",
                cancelButtonText: "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/cancel_kerja.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `tempahan_kerja_id=${tempahan_kerja_id}&tempahan_id=${tempahan_id}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Berjaya!',
                                    'Kerja telah berjaya dibatalkan.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Ralat!',
                                    data.message,
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Ralat:', error);
                            Swal.fire(
                                'Ralat!',
                                'Terdapat masalah memproses permintaan anda.',
                                'error'
                            );
                        });
                }
            });
        }
    </script>


</body>

</html>