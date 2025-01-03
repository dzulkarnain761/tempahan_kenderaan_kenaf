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
                                        <li class="breadcrumb-item"><a href="sejarah_tempahan.php">Sejarah Tempahan</a></li>
                                        <li class="breadcrumb-item active">Butiran Tempahan</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Butiran Tempahan</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    require_once '../../Models/Tempahan.php';
                                    $tempahan = new Tempahan();
                                    $booking = $tempahan->findByTempahanId($_GET['tempahan_id']);
                                    ?>

                                    <div class="row mb-3">
                                        <label for="id" class="col-3 col-form-label">Tempahan ID</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="tempahan_id" name="tempahan_id" value="<?php echo $booking['tempahan_id']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nama_penyewa" class="col-3 col-form-label">Nama Penyewa</label>
                                        <div class="col-9">
                                            <?php
                                            require_once '../../Models/Penyewa.php';
                                            $penyewa = new Penyewa();
                                            $user = $penyewa->findById($booking['penyewa_id']);
                                            ?>
                                            <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" value="<?php echo $user['nama']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="lokasi_tanah" class="col-3 col-form-label">Lokasi Tanah</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="lokasi_tanah" name="lokasi_tanah" value="<?php echo $booking['lokasi_tanah']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="luas_tanah" class="col-3 col-form-label">Keluasan Tanah</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" value="<?php echo $booking['luas_tanah']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="created_at" class="col-3 col-form-label">Tarikh Tempahan</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="created_at" name="created_at" value="<?php echo date('d/m/Y g:i A', strtotime($booking['created_at'])); ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="catatan" class="col-3 col-form-label">Catatan</label>
                                        <div class="col-9">
                                            <textarea class="form-control" id="catatan" name="catatan" rows="3" readonly><?php echo $booking['catatan']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="total_harga_anggaran" class="col-3 col-form-label">Total Harga Pengesahan</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="RM <?php echo $booking['total_harga_anggaran']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="total_harga_sebenar" class="col-3 col-form-label">Total Harga Jobsheet</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="RM <?php echo $booking['total_harga_sebenar']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="total_baki" class="col-3 col-form-label">Total Baki</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="RM <?php echo $booking['total_baki']; ?>" readonly>
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

                                <h4 class="page-title">Butiran Resit</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Resit ID</th>
                                                    <th>Jenis Pembayaran</th>
                                                    <th>Jumlah</th>
                                                    <th>Cara Bayar</th>
                                                    <th>Bukti</th>
                                                    <th>Tarikh Bayaran</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php
                                                require_once '../../Models/Resit.php';
                                                $resit = new Resit();
                                                $resits = $resit->findByTempahanId($_GET['tempahan_id']);

                                                foreach ($resits as $resit) { ?>
                                                    <tr>

                                                        <td>
                                                            <?php echo $resit['resit_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $resit['jenis_pembayaran']; ?>
                                                        </td>

                                                        <td>
                                                            RM <?php echo $resit['jumlah']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $resit['cara_bayar']; ?>
                                                        </td>
                                                        <td>
                                                            <?php


                                                            echo $resit['nombor_rujukan'];


                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date('d/m/Y g:i A', strtotime($resit['created_at'])); ?>
                                                        </td>

                                                        <td>
                                                            <?php
                                                            if ($resit['cara_bayar'] == 'fpx') {

                                                                require_once '../../Models/Fpx.php';
                                                                $fpx = new FPX();
                                                                $fpx_details = $fpx->findByReferenceNo($resit['nombor_rujukan']);

                                                                // Pass the details to the frontend as JSON
                                                                $fpx_json = json_encode($fpx_details);
                                                            ?>
                                                                <button
                                                                    class="btn btn-primary"
                                                                    onclick='lihatFpxDetails(<?php echo $fpx_json; ?>)'
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Lihat Butiran FPX">
                                                                    <i class="mdi mdi-eye"></i>
                                                                </button>

                                                            <?php } else { ?>
                                                                <button
                                                                    class="btn btn-primary"
                                                                    onclick="lihatResit('<?php echo addslashes($resit['bukti_pembayaran_tunai']); ?>')"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Lihat Resit">
                                                                    <i class="mdi mdi-eye"></i>
                                                                </button>


                                                            <?php  } ?>


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

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">

                                <h4 class="page-title">Butiran Kerja</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nama Kerja</th>
                                                    <th>Tarikh Kerja</th>
                                                    <th>Harga Pengesahan</th>
                                                    <th>Harga Jobsheet</th>
                                                    <th>Total Jobsheet</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php
                                                require_once '../../Models/Kerja.php';
                                                $tempahan_kerja = new Kerja();
                                                $works = $tempahan_kerja->findByTempahanId($_GET['tempahan_id']);

                                                foreach ($works as $work) { ?>
                                                    <tr>

                                                        <td>
                                                            <?php echo $work['nama_kerja']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date('d/m/Y', strtotime($work['cadangan_tarikh_kerja'])); ?>
                                                        </td>
                                                        <td>
                                                            RM <?php echo $work['harga_anggaran']; ?>
                                                        </td>
                                                        <td>
                                                            RM <?php echo $work['total_harga']; ?>
                                                        </td>
                                                        <?php
                                                        require_once '../../Models/Jobsheet.php';
                                                        $jobsheet = new Jobsheet();
                                                        $total_jobsheets = $jobsheet->totalJobsheetByKerja($work['tempahan_kerja_id']);
                                                        ?>
                                                        <td>
                                                            <?php echo $total_jobsheets ?>
                                                        </td>

                                                        <td>
                                                            <a href="sejarah_butiran_kerja.php?tempahan_id=<?php echo $booking['tempahan_id']; ?>&tempahan_kerja_id=<?php echo $work['tempahan_kerja_id']; ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Butiran Kerja"><i class="mdi mdi-file"></i></a>

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

    <script>
        function lihatResit(path) {
            if (path && path.trim() !== "") {
                Swal.fire({
                    imageUrl: "../../bukti_pembayaran_tunai/" + path, // Ensure the slash is included

                    imageAlt: "resit",
                });
            } else {
                Swal.fire({
                    title: "Tiada Resit",
                    icon: "warning", // Add an icon for better UX
                });
            }
        }

        function lihatFpxDetails(fpxDetails) {
            // Use SweetAlert2 to display FPX details in a title-data format
            Swal.fire({
                title: 'Butiran Transaksi FPX',
                html: `
            <div style="text-align: left; font-size: 14px;">
                <p><strong>PID:</strong> <span style="float: right;">${fpxDetails.pid}</span></p>
                <p><strong>Application ID:</strong> <span style="float: right;">${fpxDetails.rsp_appln_id}</span></p>
                <p><strong>Organization ID:</strong> <span style="float: right;">${fpxDetails.rsp_org_id}</span></p>
                <p><strong>Order ID:</strong> <span style="float: right;">${fpxDetails.rsp_orderid}</span></p>
                <p><strong>Amount:</strong> <span style="float: right;">RM ${fpxDetails.rsp_amount}</span></p>
                <p><strong>Transaction Status:</strong> <span style="float: right;">${fpxDetails.rsp_trxstatus}</span></p>
                
                <p><strong>Bank ID:</strong> <span style="float: right;">${fpxDetails.rsp_bankid}</span></p>
                <p><strong>Bank Name:</strong> <span style="float: right;">${fpxDetails.rsp_bankname}</span></p>
                <p><strong>FPX ID:</strong> <span style="float: right;">${fpxDetails.rsp_fpxid}</span></p>
                <p><strong>FPX Order No:</strong> <span style="float: right;">${fpxDetails.rsp_fpxorderno}</span></p>
                <p><strong>Date Created:</strong> <span style="float: right;">${fpxDetails.date_created}</span></p>
                
                
            </div>

        `,
                icon: 'info',
                confirmButtonText: 'Tutup',
            });
        }
    </script>


</body>

</html>