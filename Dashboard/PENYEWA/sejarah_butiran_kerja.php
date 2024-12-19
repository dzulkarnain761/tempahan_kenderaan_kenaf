<?php include 'controller/session.php'; ?>
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
                                        <li class="breadcrumb-item"><a href="sejarah_tempahan_khidmat_jentera.php">SEJARAH TEMPAHAN</a></li>
                                        <li class="breadcrumb-item"><a href="sejarah_butiran_tempahan.php?tempahan_id=<?php echo $_GET['tempahan_id'] ?>">SEJARAH TEMPAHAN</a></li>
                                        <li class="breadcrumb-item active">BUTIRAN KERJA</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">BUTIRAN KERJA</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    require_once '../../Models/Kerja.php';
                                    $kerja = new Kerja();
                                    $work = $kerja->findByTempahanKerjaId($_GET['tempahan_kerja_id']);
                                    ?>
                                    <div class="row mb-3">
                                        <label for="nama_kerja" class="col-3 col-form-label">Nama Kerja</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="<?php echo $work['nama_kerja']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tarikh_kerja" class="col-3 col-form-label">Tarikh Kerja</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($work['cadangan_tarikh_kerja'])); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="harga_pengesahan" class="col-3 col-form-label">Harga Pengesahan</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="RM <?php echo $work['harga_anggaran']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="harga_jobsheet" class="col-3 col-form-label">Harga Jobsheet</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="RM <?php echo $work['total_harga']; ?>" readonly>
                                        </div>
                                    </div>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">

                                <h4 class="page-title">JOBSHEET</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">

                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Pemandu</th>
                                                    <th>Kenderaan</th>
                                                    <th>Tarikh Kerja</th>
                                                    <th>Jam</th>
                                                    <th>Minit</th>
                                                    <th>Harga</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php
                                                require_once '../../Models/Jobsheet.php';
                                                $jobsheet = new Jobsheet();
                                                $jobsheets = $jobsheet->findByKerjaId($_GET['tempahan_kerja_id']);
                                                foreach ($jobsheets as $jobs) { ?>

                                                    <tr>

                                                        <td>
                                                            <?php
                                                            require_once '../../Models/Admin.php';
                                                            $pemandu = new Admin();
                                                            $driver = $pemandu->findById($jobs['pemandu_id']);

                                                            ?>
                                                            <?php echo $driver['nama'] ?? 'Sila Pilih Pemandu'; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            require_once '../../Models/Kenderaan.php';
                                                            $kenderaan = new Kenderaan();
                                                            $vehicle = $kenderaan->findById($jobs['kenderaan_id']);
                                                            ?>
                                                            <?php echo $vehicle['no_pendaftaran'] ?? 'Sila Pilih Kenderaan'; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo isset($jobs['tarikh_kerja_dijalankan'])
                                                                ? date('d/m/Y', strtotime($jobs['tarikh_kerja_dijalankan']))
                                                                : 'Tiada Tarikh';
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <?php echo htmlspecialchars($jobs['jam'] ?? '0'); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo htmlspecialchars($jobs['minit']?? '0'); ?>
                                                        </td>
                                                        <td>
                                                            RM <?php echo htmlspecialchars($jobs['harga'] ?? '0.00'); ?>
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
                </div> <!-- container -->

            </div> <!-- content -->




            <?php include 'partials/footer.php'; ?>

        </div>


    </div>

    <!-- END wrapper -->





    <?php include 'partials/script.php'; ?>
 


    



</body>

</html>