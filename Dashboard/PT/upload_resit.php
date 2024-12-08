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
                                        <li class="breadcrumb-item"><a href="staff.php">Pengesahan T </a></li>
                                        <li class="breadcrumb-item active">Kemaskini Staff</li>
                                    </ol>
                                </div> -->
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
                                            $penyewa = new User();
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
                                            <input type="text" class="form-control" id="tarikh_kerja" name="tarikh_kerja" value="<?php echo $booking['tarikh_kerja']; ?>" readonly>
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
                                <!-- <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="staff.php">Pengesahan T </a></li>
                                        <li class="breadcrumb-item active">Kemaskini Staff</li>
                                    </ol>
                                </div> -->
                                <h4 class="page-title">Butiran Kerja</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="uploadResit" enctype="multipart/form-data">
                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Nama Kerja</th>
                                                        <th>Tarikh Kerja</th>
                                                        <th>Jam</th>
                                                        <th>Minit</th>

                                                        <th>Harga</th>

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
                                                                <?php echo $work['tarikh_kerja_cadangan']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $work['jam_anggaran']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $work['minit_anggaran']; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $work['harga_anggaran']; ?>
                                                            </td>

                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <label for="gambar_resit" class="col-3 col-form-label">Bukti Resit</label>
                                        <div class="row mb-3">
                                            <div class="col-9">
                                                <input type="file" class="form-control" name="gambar_resit" required>
                                            </div>
                                        </div>

                                        <input type="hidden" name="resit_id" value="<?php echo $_GET['resit_id'] ?>">
                                        <input type="hidden" name="tempahan_id" value="<?php echo $_GET['tempahan_id'] ?>">
                                        <div class="justify-content-start row">
                                            <div class="col-9">
                                                <button type="button" onclick="window.open('../../Controller/pdf/getPDF_quotation_fullpayment.php?tempahan_id=<?php echo $_GET['tempahan_id']; ?>', '_blank')" class="btn btn-primary">Lihat Sebut Harga</button>
                                                <button type="submit" onclick="submitForm(event)" class="btn btn-success">Muat Naik Bukti Resit</button>
                                            </div>
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
        function submitForm(event) {
            event.preventDefault(); // Prevent default form submission behavior

            const form = document.getElementById('uploadResit'); // Replace with the actual form ID
            const inputs = form.querySelectorAll('[required]'); // Select all required inputs
            let isValid = true;

            // Validate required inputs
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('is-invalid'); // Add a class for visual feedback (optional)
                } else {
                    input.classList.remove('is-invalid'); // Remove class if valid
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ralat',
                    text: 'Sila pastikan semua medan yang diperlukan telah diisi.',
                });
                return; // Stop execution if validation fails
            }

            Swal.fire({
                title: "Muat Naik Resit",
                text: "Adakah anda pasti untuk kemaskini resit ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(form);

                    fetch('controller/upload_bukti_resit.php', {
                            method: 'POST',
                            body: formData // Send FormData directly
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berjaya',
                                    text: data.message || 'Berjaya',
                                }).then(() => {
                                    window.location.href = 'senarai_resit.php';
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