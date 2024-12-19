<?php
include 'controller/session.php';
require_once '../../Models/Jobsheet.php';
require_once '../../Models/Kerja.php';
require_once '../../Models/Kenderaan.php';

?>
<!DOCTYPE html>
<html lang="en">

<?php include 'partials/head.php'; ?>

<body class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">

        <?php include 'partials/left-sidemenu.php'; ?>

        <div class="content-page">
            <div class="content">

                <?php include 'partials/topbar.php'; ?>

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">

                                <h4 class="page-title">Jobsheet</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nama Penyewa</th>
                                                    <th>Lokasi Tanah</th>
                                                    <th>Luas Tanah</th>
                                                    <th>Tugasan</th>
                                                    <th>Jentera</th>
                                                    <th>Tarikh Tugasan</th>
                                                    

                                                    <th class="non-sortable text-center">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $pemandu_id = $_SESSION['id'];

                                                $jobsheet = new Jobsheet();
                                                $bookings = $jobsheet->getAllbyPemanduId($pemandu_id, 'selesai');

                                                foreach ($bookings as $booking) { ?>
                                                    <tr>

                                                        <td><?php echo $booking['nama']; ?></td>
                                                        <td><?php echo $booking['lokasi_tanah']; ?></td>
                                                        <td><?php echo $booking['luas_tanah']; ?></td>
                                                        <td><?php
                                                            $kerja = new Kerja();
                                                            $tugas = $kerja->findByTempahanKerjaId($booking['tempahan_kerja_id']);
                                                            echo $tugas['nama_kerja'];

                                                            ?></td>

                                                        <td><?php
                                                            $kenderaan = new Kenderaan();
                                                            $jentera = $kenderaan->findById($booking['kenderaan_id']);

                                                            echo $jentera['no_pendaftaran'];

                                                        ?></td>

                                                        <td><?php

                                                            echo date('d/m/Y', strtotime($tugas['cadangan_tarikh_kerja']));

                                                        ?></td>



                                                        <td class="table-action text-center">
                                                            <a href="butiran_jobsheet.php?jobsheet_id=<?= $booking['jobsheet_id'] ?>" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Butiran"> <i class="mdi mdi-eye"></i></a>

                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->


            <?php include 'partials/footer.php'; ?>

        </div>

        <?php include 'partials/right-sidemenu.php'; ?>
    </div>
    <!-- END wrapper -->


    <?php include 'partials/script.php'; ?>

   
</body>

</html>