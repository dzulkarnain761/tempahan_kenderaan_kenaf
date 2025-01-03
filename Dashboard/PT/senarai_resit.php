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
                                <h4 class="page-title">Senarai Resit</h4>
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
                                                    <th>Resit ID</th>
                                                    <th>Nama Penyewa</th>
                                                    <th>Jumlah</th>
                                                    <th>Jenis Pembayaran</th>

                                                    <th class="non-sortable text-center">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                require_once '../../Models/Resit.php';
                                                $resit = new Resit();
                                                $resits = $resit->getResitsWithoutProof();

                                                foreach ($resits as $resit) { ?>
                                                    <tr>
                                                        <td><?php echo $resit['resit_id']; ?></td>
                                                        <td><?php echo $resit['nama']; ?></td>
                                                        
                                                        <td><?php echo $resit['jumlah']; ?></td>
                                                        <td><?php echo $resit['jenis_pembayaran']; ?></td>
                                                        <td class="table-action text-center">
                                                            <a href="upload_resit.php?tempahan_id=<?php echo $resit['tempahan_id'] ?>&resit_id=<?php echo $resit['resit_id'] ?>" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Muat Naik Bukti"> <i class="mdi mdi-upload"></i></a>
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