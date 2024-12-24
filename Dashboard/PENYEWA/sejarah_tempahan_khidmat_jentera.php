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
        .page-title {
            color: #fff; /* Menjadikan teks putih */
        }

        
    </style>

                    <!-- start page title -->
                    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <br><h4 style="color: white">SENARAI TEMPAHAN PERKHIDMATAN JENTERA TERDAHULU</h4>
            </div>
        </div>
    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                              <div class="card custom-card">
									<div class="card-body custom-card-body">
                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Tarikh & Masa Tempahan</th>
                                                    <th>Lokasi Tanah</th>
                                                    <th>Luas Tanah</th>
                                                    <th>Tugasan</th>
                                                    <th>Catatan</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="non-sortable text-center">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $penyewa_id = $_SESSION['id'];
                                                require_once '../../Models/Tempahan.php';
                                                $tempahan = new Tempahan();
                                                $bookings = $tempahan->displaySejarahKhidmatJenteraPenyewa($penyewa_id);

                                                foreach ($bookings as $booking) { ?>
                                                    <tr>

                                                        <td><?php echo date('d/m/Y, g:i A', strtotime($booking['created_at'])); ?></td>
                                                        <td><?php echo $booking['lokasi_tanah'] ?></td>
                                                        <td><?php echo $booking['luas_tanah'] ?></td>
                                                        <td>
                                                            <?php
                                                            require_once '../../Models/Kerja.php';
                                                            $kerja = new Kerja();
                                                            $works = $kerja->findByTempahanId($booking['tempahan_id']);
                                                            $count = 1;

                                                            foreach ($works as $work) {
                                                                // Output the string directly in HTML
                                                            ?>
                                                                <?= $count . '. ' . $work['nama_kerja'] . '<br>' ?>
                                                            <?php
                                                                $count++;
                                                            }
                                                            ?>
                                                        </td>

                                                        <td><?php echo empty($booking['catatan']) ? 'Tiada Catatan' : $booking['catatan'] ?></td>
                                                        <?php

                                                        switch ($booking['status_bayaran']) {
                                                            
                                                            case 'selesai';
                                                                $badgecolor = 'success';
                                                                break;
                                                            default:
                                                                $badgecolor = 'danger';
                                                                break;
                                                        }
                                                        
                                                        ?>
                                                        <td class="text-center"><?php

                                                                                echo '<span class="badge bg-' . $badgecolor . '">' . strtoupper($booking['status_bayaran']) . '</span>';
                                                                                ?></td>

                                                        <td class="table-action text-center">
                                                            <a href="sejarah_butiran_tempahan.php?tempahan_id=<?php echo $booking['tempahan_id']; ?>"
                                                                class="btn btn-primary"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Lihat Butiran Tempahan">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>

                                                            <a href="../../Controller/pdf/getPDF_full_detail.php?tempahan_id=<?php echo $booking['tempahan_id']; ?>"
                                                                class="btn btn-secondary"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Lihat Borang Butiran Tempahan">
                                                                <i class="mdi mdi-file"></i>
                                                            </a>
                                                           

                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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

                </div> <!-- container -->

            </div> <!-- content -->


            <?php include 'partials/footer.php'; ?>

        </div>


    </div>
    <!-- END wrapper -->


    <?php include 'partials/script.php'; ?>

</body>

</html>