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
                                        <li class="breadcrumb-item"><a href="tempahan_resit.php">Sah Bayaran</a></li>
                                        <li class="breadcrumb-item active">Butiran</li>
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
                                        <label for="lokasi_kerja" class="col-3 col-form-label">Lokasi Kerja</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="lokasi_kerja" name="lokasi_kerja" value="<?php echo $booking['lokasi_kerja']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="luas_tanah" class="col-3 col-form-label">Keluasan Tanah</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" value="<?php echo $booking['luas_tanah']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="tarikh_kerja" class="col-3 col-form-label">Tarikh Kerja</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="tarikh_kerja" name="tarikh_kerja" value="<?php echo date('d/m/Y', strtotime($booking['tarikh_kerja'])); ?>" readonly>
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
                                
                                <h4 class="page-title">Butiran Kerja</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <form id="terimaTunai">
                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Tempahan ID</th>
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
                                                                <?php echo $work['tempahan_id']; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $work['nama_kerja']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo date('d/m/Y', strtotime($work['tarikh_kerja_cadangan'])); ?>
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

                                        
                                        <input type="hidden" name="resit_id" value="<?php echo $_GET['resit_id'] ?>">

                                        <div class="text-end">

                                            <button type="button" onclick="rejectTempahan(<?php echo $_GET['tempahan_id']; ?>)" class="btn btn-danger">Batal Tempahan</button>
                                            <?php if ($booking['total_baki'] > 0) { ?>
                                                <a href="../../Controller/pdf/getPDF_quotation_extrapayment.php?tempahan_id=<?php echo $booking['tempahan_id']; ?>" target="_blank" class="btn btn-primary">Lihat Sebut Harga</a>
                                            <?php } else { ?>
                                                <a href="../../Controller/pdf/getPDF_quotation_fullpayment.php?tempahan_id=<?php echo $booking['tempahan_id']; ?>" target="_blank" class="btn btn-primary">Lihat Sebut Harga</a>
                                            <?php } ?>
                                            <button type="submit" onclick="submitForm()" class="btn btn-success">Sah Bayaran</button>
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
        function rejectTempahan(id) {
            Swal.fire({
                title: "Adakah anda pasti?",
                text: "Tempahan ini akan dibatalkan",
                icon: "warning",
                input: 'textarea',
                inputLabel: 'Sebab Dibatalkan',
                inputPlaceholder: 'Sila masukkan sebab dibatalkan',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Sila masukkan sebab dibatalkan!'
                    }
                },
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, batal tempahan",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/batal_tempahan.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `tempahan_id=${id}&sebab_ditolak=${encodeURIComponent(result.value)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Berjaya",
                                    text: "Tempahan telah ditolak",
                                    icon: "success"
                                }).then(() => {
                                    window.location.href = 'tempahan.php';
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

        function submitForm() {
            event.preventDefault();
            Swal.fire({
                title: "Sah Bayaran",
                text: "Adakah anda pasti untuk kemaskini tempahan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('terimaTunai');
                    const formData = new FormData(form);

                    fetch('controller/sahkan_bayaran.php', {
                            method: 'POST',
                            body: new URLSearchParams(formData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berjaya',
                                    text: data.message || 'Berjaya',
                                }).then(() => {
                                    window.location.href = 'tempahan_resit.php';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ralat',
                                    text: data.message || 'Ralat tidak diketahui',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ralat',
                                text: 'Ralat memproses respons pelayan',
                            });
                        });
                }
            });
        }
    </script>

</body>

</html>