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
                                        <label for="created_at" class="col-3 col-form-label">Tarikh Tempahan</label>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="created_at" name="created_at" value="<?php echo date('d/m/Y, g:i A', strtotime($booking['created_at'])); ?>" readonly>
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
                                    <form id="terimaTempahan">
                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Nama Kerja</th>
                                                        <th>Tarikh Kerja</th>
                                                        <th>Jam</th>
                                                        <th>Minit</th>
                                                        <th>Harga Per Jam</th>
                                                        <th>Harga</th>
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
                                                                <input type="date" class="form-control" value="<?php echo $work['tarikh_kerja_cadangan']; ?>" name="input_date[]">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control input_hours" value="<?php echo $work['jam_anggaran']; ?>" name="input_hours[]" min="0" style="min-width: 100px;">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control input_minutes" value="<?php echo $work['minit_anggaran']; ?>" name="input_minutes[]" min="0" max="45" step="15" style="min-width: 100px;">
                                                            </td>
                                                            <?php
                                                            require_once '../../Models/Tugasan.php';
                                                            $tugasan = new Tugasan();
                                                            $task = $tugasan->getRateByName($work['nama_kerja']);
                                                            $rate_per_hour = $task['harga_per_jam'];
                                                            ?>
                                                            <input type="hidden" class="form-control rate_per_hour" value="<?php echo $rate_per_hour; ?>">
                                                            <input type="hidden" class="form-control" value="<?php echo $work['tempahan_kerja_id']; ?>" name="tempahan_kerja_id[]">
                                                            <td>
                                                                <input type="text" class="form-control" value="RM<?php echo $rate_per_hour; ?>" readonly style="min-width: 100px;">
                                                            </td>

                                                            <td>
                                                                <input type="text" class="form-control harga_anggaran" value="<?php echo $work['harga_anggaran']; ?>" name="input_price[]" readonly style="min-width: 100px;">
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger" type="button" onclick="cancelButton(<?php echo $work['tempahan_kerja_id']; ?>)">Tolak</button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="luas_tanah" class="col-3 col-form-label">Disahkan Oleh</label>
                                            <div class="col-9">
                                                <select name="disahkan_oleh" class="form-select" required>
                                                    <option value="">Sila Pilih</option>
                                                    <?php
                                                    require_once '../../Models/Admin.php';
                                                    $admin = new Admin();
                                                    $admins = $admin->getPEE();

                                                    foreach ($admins as $admin) {
                                                        echo "<option value='" . $admin['nama'] . "'>" . $admin['nama'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="tempahan_id" value="<?php echo $_GET['tempahan_id'] ?>">

                                        <div class="text-end">
                                            <button type="button" onclick="rejectTempahan(<?php echo $_GET['tempahan_id']; ?>)" class="btn btn-danger">Tolak Tempahan</button>
                                            <button type="submit" onclick="submitForm()" class="btn btn-success">Hasilkan Sebut Harga</button>
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
        function cancelButton(id) {
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
                    fetch('controller/cancel_kerja.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `tempahan_kerja_id=${id}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Berjaya dipadam",
                                    text: "Kerja telah ditolak",
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


        function rejectTempahan(id) {
            Swal.fire({
                title: "Adakah anda pasti?",
                text: "Tempahan ini akan ditolak",
                icon: "warning",
                input: 'textarea',
                inputLabel: 'Sebab Penolakan',
                inputPlaceholder: 'Sila masukkan sebab penolakan',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Sila masukkan sebab penolakan!'
                    }
                },
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, tolak tempahan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/reject_tempahan.php', {
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
                $(row).find('.harga_anggaran').val(totalPrice.toFixed(2));
            }

            // Add event listeners for hours and minutes inputs
            $('.input_hours, .input_minutes').on('input', function() {
                calculatePrice($(this).closest('tr'));
            });
        });

        function submitForm() {
            const form = document.getElementById('terimaTempahan');

            // Validate required fields
            if (!form.checkValidity()) {
                form.reportValidity(); // This will highlight invalid fields and show default messages
                return; // Stop execution if the form is invalid
            }
            event.preventDefault();

            Swal.fire({
                title: "Hasilkan Sebut Harga?",
                text: "Adakah anda pasti?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hantar!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(form);

                    fetch('controller/terima_tempahan.php', {
                            method: 'POST',
                            body: new URLSearchParams(formData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berjaya',
                                    text: data.message || 'Tempahan telah dihantar ke KPP',
                                }).then(() => {
                                    window.location.href = 'tempahan.php';
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