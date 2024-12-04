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
                                        <li class="breadcrumb-item"><a href="jobsheet.php">Tempahan</a></li>
                                        <li class="breadcrumb-item"><a href="butiran_tempahan.php?tempahan_id=<?php echo $_GET['tempahan_id'] ?>">Butiran Tempahan</a></li>
                                        <li class="breadcrumb-item"><a href="pengesahan_jobsheet.php?tempahan_id=<?php echo $_GET['tempahan_id'] ?>&tempahan_kerja_id=<?php echo $_GET['tempahan_kerja_id'] ?>">Butiran Kerja</a></li>
                                        <li class="breadcrumb-item active">Butiran Jobsheet</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Butiran Jobsheet</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    require_once '../../Models/Jobsheet.php';
                                    $jobsheet = new Jobsheet();
                                    $jobsheets = $jobsheet->findById($_GET['jobsheet_id']);


                                    if ($jobsheets['status_jobsheet'] === 'pengesahan') {
                                        $select_input = 'required';
                                        $input_price = 'readonly';
                                    } else if ($jobsheets['status_jobsheet'] === 'dijalankan') {
                                        $select_input = 'disabled';
                                        $input_price = 'required';
                                    }

                                    ?>
                                    <form action="controller/update_jobsheet.php" method="POST">

                                        <div class="row mb-3">
                                            <label for="jobsheet_id" class="col-3 col-form-label">Jobsheet ID</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" name="jobsheet_id" value="<?php echo $jobsheets['jobsheet_id']; ?>" readonly>
                                            </div>
                                        </div>
                                        <?php
                                        require_once '../../Models/Kerja.php';
                                        $kerja = new Kerja();
                                        $kerjaData = $kerja->findByTempahanKerjaId($_GET['tempahan_kerja_id']);
                                        $nama_kerja = isset($kerjaData['nama_kerja']) ? $kerjaData['nama_kerja'] : 'Tidak Ditemukan';

                                        require_once '../../Models/Tugasan.php';
                                        $tugasan = new Tugasan();
                                        $task = $tugasan->getCategoryByName($nama_kerja);
                                        $kategori_kenderaan = $task['kategori_kenderaan'];

                                        $task = $tugasan->getRateByName($nama_kerja);
                                        $rate_per_hour = $task['harga_per_jam'];
                                        ?>
                                        <div class="row mb-3">
                                            <label for="nama_kerja" class="col-3 col-form-label">Nama Kerja</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" value="<?php echo $nama_kerja ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="pemandu" class="col-3 col-form-label">Pemandu</label>
                                            <div class="col-9">
                                                <select name="pemandu_id" id="pemandu_id" class="form-select" <?php echo $select_input ?>>
                                                    <option value="">Sila Pilih Pemandu</option>
                                                    <?php
                                                    require_once '../../Models/Admin.php';
                                                    $pemandu = new Admin();
                                                    $drivers = $pemandu->getPemandu();
                                                    foreach ($drivers as $driver) {
                                                        echo '<option value="' . $driver['id'] . '"' . ($driver['id'] == $jobsheets['pemandu_id'] ? ' selected' : '') . '>' . htmlspecialchars($driver['nama']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="kenderaan_id" class="col-3 col-form-label">Kenderaan</label>
                                            <div class="col-9">
                                                <select name="kenderaan_id" id="kenderaan_id" class="form-select" <?php echo $select_input ?>>
                                                    <option value="">Sila Pilih Kenderaan</option>
                                                    <?php
                                                    require_once '../../Models/Kenderaan.php';
                                                    $kenderaan = new Kenderaan();
                                                    $vehicles = $kenderaan->getAllKenderaanByType($kategori_kenderaan);
                                                    foreach ($vehicles as $vehicle) {
                                                        $selected = ($vehicle['id'] == $jobsheets['kenderaan_id']) ? ' selected' : '';
                                                        echo '<option value="' . $vehicle['id'] . '"' . $selected . '>' . htmlspecialchars($vehicle['no_pendaftaran']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="tarikh_kerja_dijalankan" class="col-3 col-form-label">Tarikh Kerja Dijalankan</label>
                                            <div class="col-9">
                                                <input type="date" class="form-control " name="tarikh_kerja_dijalankan" <?php echo $input_price ?>>
                                            </div>
                                        </div>

                                        <input type="hidden" class="rate_per_hour" value="<?php echo $rate_per_hour ?>">
                                        <div class="row mb-3">
                                            <label for="jam" class="col-3 col-form-label">Jam</label>
                                            <div class="col-9">
                                                <input type="number" class="form-control input_hours" name="input_hours" value="0" min="0" max="10" <?php echo $input_price ?>>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="minutes" class="col-3 col-form-label">Minit</label>
                                            <div class="col-9">
                                                <input type="number" class="form-control input_minutes" name="input_minutes" value="0" min="0" max="45" step="15" <?php echo $input_price ?>>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="price" class="col-3 col-form-label">Harga</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control input_price" name="input_price" value="0.00" readonly>
                                            </div>
                                        </div>
                                        <input type="hidden" name="tempahan_kerja_id" value="<?php echo $_GET['tempahan_kerja_id']; ?>">
                                        <div class="justify-content-end row">
                                            <div class="col-9">
                                                <?php

                                                if ($jobsheets['status_jobsheet'] === 'pengesahan') { ?>
                                                    <input type="submit" class="btn btn-success" value="Kemaskini Jobsheet">
                                                <?php } else if ($jobsheets['status_jobsheet'] === 'dijalankan') { ?>
                                                    <input type="submit" class="btn btn-success" formaction="controller/selesai_jobsheet.php" value="Selesai Jobsheet">
                                                <?php  } ?>
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
        $(document).ready(function() {
            // Function to calculate price
            function calculatePrice(row) {
                const hours = parseFloat($(row).find('.input_hours').val()) || 0;
                const minutes = parseFloat($(row).find('.input_minutes').val()) || 0;
                const ratePerHour = parseFloat($(row).find('.rate_per_hour').val()) || 0;

                // Convert minutes to hours (e.g., 30 minutes = 0.5 hours)
                const totalHours = hours + (minutes / 60);

                // Calculate total price
                const totalPrice = totalHours * ratePerHour;

                // Update the price field with 2 decimal places
                $(row).find('.input_price').val(totalPrice.toFixed(2));
            }

            // Add event listeners for hours and minutes inputs
            $('.input_hours, .input_minutes').on('input', function() {
                calculatePrice($(this).closest('form'));
            });
        });
    </script>



</body>

</html>