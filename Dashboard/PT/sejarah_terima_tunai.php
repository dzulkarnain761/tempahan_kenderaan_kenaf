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
                                                    <th>Tempahan ID</th>
                                                    <th>Nama Penyewa</th>
                                                    <th>Tugasan</th>
                                                    <th>Jumlah</th>
                                                    <th>Jenis Pembayaran</th>
                                                    <th>Tarikh Bayaran</th>
                                                    <!-- <th class="non-sortable text-center">Tindakan</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
                                                $quotation = new Quotation();
                                                $resits = $quotation->getQuotationDetail('pengesahan','pengesahan pt');

                                                foreach ($resits as $resit) { ?>
                                                    <tr>
                                                        <td><?php echo $resit['tempahan_id']; ?></td>
                                                        <td><?php echo $resit['nama']; ?></td>
                                                        <td><?php
                                                            require_once '../../Models/Kerja.php';
                                                            $kerja = new Kerja();
                                                            $works = $kerja->findByTempahanId($resit['tempahan_id']);
                                                            $count = 1;

                                                            foreach ($works as $work) {
                                                                echo $count . '. ' . $work['nama_kerja'] . '<br>';
                                                                $count++;
                                                            }
                                                            ?></td>
                                                        <td><?php echo $resit['jumlah']; ?></td>
                                                        <td><?php echo $resit['jenis_pembayaran']; ?></td>
                                                        <td><?php echo date('d/m/Y', strtotime($resit['created_at'])); ?></td>
                                                        
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
        function lihatResit(path) {
            if (path && path.trim() !== "") {
                Swal.fire({
                    imageUrl: "../../bukti_resit/" + path, // Ensure the slash is included
                    
                    imageAlt: "resit",
                });
            } else {
                Swal.fire({
                    title: "Tiada Resit",
                    icon: "warning", // Add an icon for better UX
                });
            }
        }
    </script>

</body>

</html>