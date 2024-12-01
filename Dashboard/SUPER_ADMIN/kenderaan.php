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
                                <!-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Tempahan</li>
                                        </ol>
                                    </div> -->
                                <h4 class="page-title">Kenderaan</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Tambah Staff</a>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="text-sm-end">
                                                <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog-outline"></i></button>
                                                <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                                <button type="button" class="btn btn-light mb-2">Export</button>
                                            </div>
                                        </div><!-- end col-->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No Aset</th>
                                                    <th>No Pendaftaran</th>
                                                    <th>Kategori Kenderaan</th>
                                                    <th>Tahun Daftar</th>
                                                    <th>Negeri Penempatan</th>
                                                    <th>Kawasan Penempatan</th>
                                                    <th>Catatan</th>
                                                    <th class="non-sortable">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                require_once '../../Models/Kenderaan.php';
                                                $kenderaan = new Kenderaan();
                                                $vehicles = $kenderaan->getAllKenderaan();

                                                foreach ($vehicles as $vehicle) { ?>
                                                    <tr>
                                                        <td><?php echo $vehicle['no_aset']; ?></td>
                                                        <td><?php echo $vehicle['no_pendaftaran']; ?></td>
                                                        <td><?php echo $vehicle['kategori_kenderaan']; ?></td>
                                                        <td><?php echo $vehicle['tahun_daftar']; ?></td>
                                                        <td><?php echo $vehicle['negeri_penempatan']; ?></td>
                                                        <td><?php echo $vehicle['kawasan_penempatan']; ?></td>
                                                        <td><?php echo $vehicle['catatan']; ?></td>
                                                        
                                                        <td class="table-action">
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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