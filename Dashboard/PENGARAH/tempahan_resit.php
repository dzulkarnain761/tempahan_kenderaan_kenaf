<?php 
include 'controller/session.php';
require_once '../../Models/Tempahan.php';
require_once '../../Models/Kerja.php';
require_once '../../Models/Quotation.php';
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

                                <h4 class="page-title">Sah Bayaran</h4>
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
                                                    <th>Tempahan ID</th>
                                                    <th>Nama Penyewa</th>
                                                    
                                                    <th>Tugasan</th>
                                                    <th>Jenis Pembayaran</th>


                                                    <th class="non-sortable text-center">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $quotation = new Quotation();
                                                $bookings = $quotation->getQuotationDetail('pengesahan','pengesahan pengarah');

                                                foreach ($bookings as $booking) { ?>
                                                    <tr>
                                                        <td><?php echo $booking['tempahan_id']; ?></td>
                                                        <td><?php echo $booking['nama']; ?></td>
                                                        
                                                        <td><?php
                                                            require_once '../../Models/Kerja.php';
                                                            $kerja = new Kerja();
                                                            $works = $kerja->findByTempahanId($booking['tempahan_id']);
                                                            $count = 1;

                                                            foreach ($works as $work) {
                                                                echo $count . '. ' . $work['nama_kerja'] . '<br>';
                                                                $count++;
                                                            }
                                                            ?></td>
                                                        <td><?php echo $booking['jenis_pembayaran']; ?></td>

                                                        <td class="table-action text-center">
                                                            <a href="sah_bayaran.php?tempahan_id=<?php echo $booking['tempahan_id'] ?>&quotation_id=<?php echo $booking['quotation_id'] ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Sahkan Bayaran"> <i class="mdi mdi-check"></i></a>

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