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
                                        <li class="breadcrumb-item"><a href="jobsheet.php">Tempahan</a></li>
                                        <li class="breadcrumb-item"><a href="butiran_tempahan.php?tempahan_id=<?php echo $_GET['tempahan_id'] ?>">Butiran Tempahan</a></li>
                                        <li class="breadcrumb-item active">Butiran Kerja</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Butiran Kerja</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    require_once '../../Models/Kerja.php';
                                    $kerja = new Kerja();
                                    $work = $kerja->findByTempahanKerjaId($_GET['tempahan_kerja_id']);
                                    ?>
                                    <div class="row mb-3">
                                        <label for="lokasi_kerja" class="col-3 col-form-label">Nama Kerja</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="<?php echo $work['nama_kerja']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="luas_tanah" class="col-3 col-form-label">Harga Pengesahan</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="RM <?php echo $work['harga_anggaran']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="tarikh_kerja" class="col-3 col-form-label">Harga Jobsheet</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" value="RM <?php echo $work['total_harga']; ?>" readonly>
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

                                <h4 class="page-title">Jobsheet</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">

                                        <div class="col-sm-5">
                                            <button onclick="createJobsheet(<?php echo $_GET['tempahan_id']; ?>, <?php echo $_GET['tempahan_kerja_id']; ?>)" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Tambah Jobsheet</button>
                                        </div>

                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Pemandu</th>
                                                    <th>Kenderaan</th>
                                                    <th>Tarikh Kerja</th>
                                                    <th>Jam</th>
                                                    <th>Minit</th>
                                                    <th>Harga</th>
                                                    <th class="non-sortable">Tindakan</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php
                                                require_once '../../Models/Jobsheet.php';
                                                $jobsheet = new Jobsheet();
                                                $jobsheets = $jobsheet->findByKerjaId($_GET['tempahan_kerja_id']);
                                                foreach ($jobsheets as $jobs) { ?>

                                                    <tr>


                                                        <td>
                                                            <?php
                                                            require_once '../../Models/Admin.php';
                                                            $pemandu = new Admin();
                                                            $driver = $pemandu->findById($jobs['pemandu_id']);

                                                            ?>
                                                            <?php echo $driver['nama'] ?? 'Sila Pilih Pemandu'; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            require_once '../../Models/Kenderaan.php';
                                                            $kenderaan = new Kenderaan();
                                                            $vehicle = $kenderaan->findById($jobs['kenderaan_id']);
                                                            ?>
                                                            <?php echo $vehicle['no_pendaftaran'] ?? 'Sila Pilih Kenderaan'; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo htmlspecialchars($jobs['tarikh_kerja_dijalankan'] ?? 'Tiada Tarikh'); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo htmlspecialchars($jobs['jam']); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo htmlspecialchars($jobs['minit']); ?>
                                                        </td>
                                                        <td>
                                                            RM <?php echo htmlspecialchars($jobs['harga']); ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($jobs['status_jobsheet'] == 'selesai') { ?>
                                                                Selesai
                                                            <?php } else { ?>
                                                                <a href="kemaskini_jobsheet.php?tempahan_id=<?php echo $_GET['tempahan_id']; ?>&tempahan_kerja_id=<?php echo $_GET['tempahan_kerja_id']; ?>&jobsheet_id=<?php echo $jobs['jobsheet_id'] ?>"
                                                                    class="btn btn-success"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Kemaskini Jobsheet">
                                                                    <i class="mdi mdi-pencil"></i>
                                                                </a>
                                                                <button type="button"
                                                                    class="btn btn-danger"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Buang Jobsheet"
                                                                    onclick="deleteJobsheet(<?php echo $jobs['jobsheet_id'] ?>)">
                                                                    <i class="mdi mdi-trash-can"></i>
                                                                </button>

                                                            <?php } ?>

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
                </div> <!-- container -->

            </div> <!-- content -->




            <?php include 'partials/footer.php'; ?>

        </div>


    </div>

    <!-- END wrapper -->





    <?php include 'partials/script.php'; ?>
    <?php
   

    if (isset($_SESSION['success_message'])) {
        echo "
    <script>
        window.onload = function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '" . htmlspecialchars($_SESSION['success_message']) . "',
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>";
        unset($_SESSION['success_message']); // Clear the message after displaying
    }
    ?>


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

        function createJobsheet(tempahan_id, tempahan_kerja_Id) {
            Swal.fire({
                title: 'Anda pasti?',
                text: "Tindakan ini tidak boleh dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, buat jobsheet!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/create_jobsheet.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `tempahan_id=${tempahan_id}&tempahan_kerja_id=${tempahan_kerja_Id}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Berjaya",
                                    text: "Jobsheet telah berjaya dibuat",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
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

        function deleteJobsheet(jobsheet_id) {
            Swal.fire({
                title: 'Anda pasti?',
                text: "Tindakan ini tidak boleh dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/delete_jobsheet.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `jobsheet_id=${jobsheet_id}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Berjaya dipadam",
                                    text: "Jobsheet telah ditolak",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal Padam",
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