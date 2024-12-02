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
                                <h4 class="page-title">Pengesahan Tempahan</h4>
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
                                                    <th>Tarikh & Masa Tempahan</th>
                                                    <th>Tarikh Kerja Dipilih</th>
                                                    <th>Status</th>
                                                    <th class="non-sortable">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                require_once '../../Models/Tempahan.php';
                                                $tempahan = new Tempahan();
                                                $bookings = $tempahan->getAllWithStatusTempahan('pengesahan pee');
                                                

                                                foreach ($bookings as $booking) { ?>
                                                    <tr>
                                                        <td><?php 
                                                            require_once '../../Models/Penyewa.php';
                                                            $penyewa = new User();
                                                            $user = $penyewa->findById($booking['penyewa_id']);
                                                            echo $user['nama'];
                                                        ?></td>
                                                        <td><?php echo $booking['created_at']; ?></td>
                                                        <td><?php echo $booking['tarikh_kerja']; ?></td>
                                                        <td><?php echo $booking['status_tempahan']; ?></td>
                                                        <td class="table-action">
                                                            <a href="pengesahan_tempahan.php?tempahan_id=<?php echo $booking['tempahan_id'] ?>" class="action-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Pengesahan Tarikh & Harga Kerja"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Padam Tempahan"> <i class="mdi mdi-delete"></i></a>
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

</body>

</html>