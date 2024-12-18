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
                                        <li class="breadcrumb-item"><a href="terima_tunai.php">Terima Tunai</a></li>
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
                                        <label for="luas_tanah" class="col-3 col-form-label">Keluasan Tanah (Hektar)</label>
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

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                               
                                <h4 class="page-title">Butiran Harga</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="terimaTempahan">
                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Nama Kerja</th>
                                                        <th>Tarikh Kerja</th>
                                                        <th>Harga Pengesahan</th>
                                                        <th>Harga Jobsheet</th>


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

                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
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

                                        <div class="text-end">
                                            <?php if ($booking['total_baki'] > 0) { ?>
                                                <a href="../../Controller/pdf/getPDF_quotation_extrapayment.php?tempahan_id=<?php echo $_GET['tempahan_id']; ?>&quotation_id=<?php echo $_GET['quotation_id'] ?>" target="_blank" class="btn btn-primary">Lihat Sebut Harga</a>
                                            <?php } else { ?>
                                                <a href="../../Controller/pdf/getPDF_quotation_firstpayment.php?tempahan_id=<?php echo $_GET['tempahan_id']; ?>&quotation_id=<?php echo $_GET['quotation_id'] ?>" target="_blank" class="btn btn-primary">Lihat Sebut Harga</a>
                                            <?php } ?>

                                            <button type="button"
                                                class="btn btn-success"
                                                onclick="terimaTunai(<?php echo $_GET['tempahan_id'] ?>)">
                                                Terima Tunai
                                            </button>
                                        </div>

                                    </form>

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
        function terimaTunai(tempahan_id) {
            Swal.fire({
                title: 'Terima Tunai',
                text: "Tindakan ini tidak boleh dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Selesai',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/terima_tunai.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `tempahan_id=${tempahan_id}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Berjaya",
                                    text: "Tunai Diterima",
                                    icon: "success"
                                }).then(() => {
                                    window.location.href = "terima_tunai.php";
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal",
                                    text: data.message || "Ralat tidak diketahui",
                                    icon: "error"
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: "Ralat",
                                text: "Ralat memproses respons pelayan",
                                icon: "error"
                            });
                        });
                }
            });

        }
    </script>

</body>

</html>