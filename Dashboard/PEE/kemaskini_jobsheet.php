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
                                        <li class="breadcrumb-item active">Butiran Kerja</li>
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
                                    ?>
                                    <form action="">
                                        <?php
                                        require_once '../../Models/Tugasan.php';
                                        $tugasan = new Tugasan();
                                        $task = $tugasan->getCategoryByName($jobsheets['nama_kerja']);
                                        $kategori_kenderaan = $task['kategori_kenderaan'];

                                        $task = $tugasan->getRateByName($jobsheets['nama_kerja']);
                                        $rate_per_hour = $task['harga_per_jam'];
                                        ?>

                                        <input type="hidden" class="form-control rate_per_hour" value="<?php echo $rate_per_hour; ?>">


                                        <div class="row mb-3">
                                            <label for="lokasi_kerja" class="col-3 col-form-label">Jobsheet ID</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" value="<?php echo $jobsheets['jobsheet_id']; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="lokasi_kerja" class="col-3 col-form-label">Jobsheet ID</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" value="<?php echo $jobsheets['jobsheet_id']; ?>" readonly>
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
                calculatePrice($(this).closest('tr'));
            });
        });
    </script>



</body>

</html>