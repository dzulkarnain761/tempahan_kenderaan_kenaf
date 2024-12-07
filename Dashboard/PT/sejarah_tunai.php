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
                                <!-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Tempahan</li>
                                        </ol>
                                    </div> -->
                                <h4 class="page-title">Sejarah Penerimaan Tunai</h4>
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
                                                    <th>Jumlah</th>
                                                    <th>Jenis Pembayaran</th>
                                                    <th>Tarikh Bayaran</th>
                                                    <th class="non-sortable text-center">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                require_once '../../Models/Resit.php';
                                                $resit = new Resit();
                                                $resits = $resit->getAllResit();

                                                foreach ($resits as $resit) { ?>
                                                    <tr>
                                                        <td><?php echo $resit['nama']; ?></td>
                                                        <td><?php echo $resit['jumlah']; ?></td>
                                                        <td><?php echo $resit['jenis_pembayaran']; ?></td>
                                                        <td><?php echo date('d/m/Y', strtotime($resit['created_at'])); ?></td>
                                                        <td class="table-action text-center">
                                                            <a href="controller/lihat_resit.php?path=<?php echo $resit['bukti_resit_path']; ?>" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Resit"> <i class="mdi mdi-eye"></i></a>
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

        
    </div>
    <!-- END wrapper -->


    <?php include 'partials/script.php'; ?>

    <script>
        

        
    </script>

</body>

</html>