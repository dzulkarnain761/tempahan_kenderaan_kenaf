<?php
include 'controller/session.php';

require_once '../../Models/Jobsheet.php';


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
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="jobsheet.php">Senarai Jobsheet</a></li>

                                        <li class="breadcrumb-item active">Butiran Tugasan</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Butiran Tugasan</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php

                                    $jobsheet = new Jobsheet();
                                    $job = $jobsheet->fetchDetail($_GET['jobsheet_id']);
                                    ?>

                                    <div class="row mb-3">
                                        <label for="nama" class="col-3 col-form-label">Nama Penyewa</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="<?php echo $job['nama']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="lokasi_tanah" class="col-3 col-form-label">Lokasi Tanah</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="<?php echo $job['lokasi_tanah']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="luas_tanah" class="col-3 col-form-label">Luas Tanah (Hektar)</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="<?php echo $job['luas_tanah']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nama_kerja" class="col-3 col-form-label">Nama Kerja</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="<?php echo $job['nama_kerja']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tarikh_kerja" class="col-3 col-form-label">Tarikh Tugasan</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($job['cadangan_tarikh_kerja'])); ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="no_pendaftaran" class="col-3 col-form-label">Jentera</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="<?php echo $job['no_pendaftaran']; ?>" readonly>
                                        </div>
                                    </div>




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







</body>

</html>