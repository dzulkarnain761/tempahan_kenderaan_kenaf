<?php

include 'controller/connection.php';
include 'controller/session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
    </style>

</head>

<!-- =============== Navigation ================ -->
<div class="custom-container">
    <?php
    include 'partials/navigation.php';
    ?>

    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>

            <?php include 'partials/name_display.php'; ?>
        </div>

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="jobsheet.php">Jobsheet</a></li>
                <li class="breadcrumb-item active" aria-current="page">Maklumat Tempahan</li>
            </ol>
        </nav>
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>MAKLUMAT TEMPAHAN</h2>
            </div>

            <?php
            $tempahan_id = $_GET['tempahan_id'];

            // Ensure you escape the ID to prevent SQL injection
            $tempahan_id = mysqli_real_escape_string($conn, $tempahan_id);

            $sqlTempahan = "SELECT t.*, p.nama 
                FROM tempahan t
                INNER JOIN penyewa p ON p.id = t.penyewa_id WHERE t.tempahan_id = $tempahan_id";
            $resultTempahan = mysqli_query($conn, $sqlTempahan);

            // Fetch the Pemandu member's data
            if ($resultTempahan && mysqli_num_rows($resultTempahan) > 0) {
                $tempahan = mysqli_fetch_assoc($resultTempahan);
            } else {
                // Handle the case where no Pemandu member is found
                echo "Tiada Tempahan Dijumpai";
                exit;
            }

            ?>


            <input type="hidden" name="tempahan_id" value="<?php echo htmlspecialchars($tempahan['tempahan_id']) ?>">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tarikh Permohonan:</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" value="<?php echo date('Y-m-d', strtotime($tempahan['created_at'])) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Pemohon:</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['nama']) ?>"
                    disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tarikh Cadangan:</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['tarikh_kerja']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Keluasan Tanah(Hektar):</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['luas_tanah']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Lokasi Kerja:</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['lokasi_kerja']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Catatan:</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['catatan']) ?>" disabled>
            </div>
        </div>

        <div class="recentOrders">
            <div class="cardHeader">
                <h2>PENGESAHAN TEMPAHAN</h2>
            </div>

            <form id="terimaTempahan" method="POST">
                <input type="hidden" name="tempahan_id" value="<?php echo htmlspecialchars($tempahan['tempahan_id']) ?>">


                <div class="mb-3">
                    <?php
                    $tempahanId = $tempahan_id;
                    $sqlKerja = "SELECT * FROM `tempahan_kerja` WHERE tempahan_id = $tempahanId";
                    $resultKerja = mysqli_query($conn, $sqlKerja);

                    if ($resultKerja && mysqli_num_rows($resultKerja) > 0):

                        while ($rowKerja = mysqli_fetch_assoc($resultKerja)):



                            $tempahan_id = htmlspecialchars($rowKerja['tempahan_id']);
                            $nama_kerja = htmlspecialchars($rowKerja['nama_kerja']);
                            $rateharga = 0; // Default rate

                            // Fetch the rate per hour from the database based on the work name
                            $sqltugasan = "SELECT * FROM `tugasan` WHERE kerja = '$nama_kerja'";
                            $resulttugasan = mysqli_query($conn, $sqltugasan);

                            if ($resulttugasan && mysqli_num_rows($resulttugasan) > 0) {
                                $fetchTugasan = mysqli_fetch_assoc($resulttugasan);
                                $rateharga = $fetchTugasan['harga_per_jam'];
                            }
                    ?>
                            <div class="mb-5" id="row-<?php echo $rowKerja['tempahan_kerja_id']; ?>">

                                <?php
                                $inputaction = 'disabled';

                                ?>
                                

                                <input type="hidden" name="tempahan_kerja_id[]" value="<?php echo htmlspecialchars($rowKerja['tempahan_kerja_id']); ?>">

                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">Nama Kerja</span>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rowKerja['nama_kerja']); ?>" disabled>


                                </div>

                                <div class="input-group mb-2">
                                    <span class="input-group-text">Tarikh Kerja</span>
                                    <input type="date" class="form-control input_date" name="input_date[]" value="<?php echo htmlspecialchars($rowKerja['tarikh_kerja_cadangan']); ?>" <?php echo $inputaction ?>>
                                </div>

                                <div class="input-group mb-2">
                                    <input type="hidden" class="form-control rate_per_hour" value="<?php echo $rateharga; ?>">
                                    <span class="input-group-text">Jam</span>
                                    <input type="number" class="form-control input_hours" name="input_hours[]" value="<?php echo htmlspecialchars($rowKerja['jam_anggaran']); ?>" min="0" max="6" <?php echo $inputaction ?>>
                                    <span class="input-group-text">Minit</span>
                                    <input type="number" class="form-control input_minutes" name="input_minutes[]" value="<?php echo htmlspecialchars($rowKerja['minit_anggaran']); ?>" min="0" max="55" step="5" <?php echo $inputaction ?>>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Harga (RM)</span>
                                    <input type="text" class="form-control output_price" name="input_price[]" value="<?php echo htmlspecialchars($rowKerja['harga_anggaran']); ?>" readonly>
                                </div>
                                

                            </div>
                        <?php

                        endwhile;
                    else: ?>
                        <input type="text" class="form-control mb-2" id="jenis_kerja_input" value="No kerja found" disabled>
                    <?php endif; ?>
                </div>

                <?php if ($tempahan['status_tempahan'] == 'pengesahan pee') { ?>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Pengesahan Oleh :</label>
                        <select name="pengesahan_pee" class="form-select" required>
                            <option value="">--Pilih PEE--</option>
                            <?php
                            $sqlAdminPee = "SELECT id, nama FROM admin WHERE kumpulan = 'D'";
                            $result = mysqli_query($conn, $sqlAdminPee);

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['nama'] . "'>" . $row['nama'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger cancelTempahan" value="<?php echo $tempahanId ?>">Tolak Tempahan</button>
                        <button type="button" class="btn btn-secondary previewQuotation" value="<?php echo $tempahan_id ?>">Preview Sebut Harga</button>
                        <button type="submit" class="btn btn-primary">Terima Dan Hantar Ke KPP</button>
                    </div>

                <?php } ?>




            </form>
        </div>

    </div>
</div>

<script src="../assets/js/main.js"></script>
<script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
<script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
    var changeEditModal = document.getElementById('changeEditModal');
    $(document).ready(function() {



        $(document).on('input', '.input_hours, .input_minutes', function() {
            // Find the closest parent with the class `.mb-2` (adjust to match your structure)
            let parentDiv = $(this).closest('.mb-5');

            // Get the rate per hour, hours, and minutes from the respective input fields
            let rate_per_hour = parseFloat(parentDiv.find('.rate_per_hour').val());
            let hours = parseInt(parentDiv.find('.input_hours').val()) || 0;
            let minutes = parseInt(parentDiv.find('.input_minutes').val()) || 0;

            // Convert minutes to hours and calculate the total time
            let totalHours = hours + (minutes / 60);

            // Calculate the price based on the total hours
            if (totalHours && rate_per_hour) {
                let price = (totalHours * rate_per_hour).toFixed(2); // To ensure 2 decimal places
                parentDiv.find('.output_price').val(price);
            } else {
                parentDiv.find('.output_price').val('0.00');
            }
        });



        // Attach click event to all buttons with class 'cancelKerja'
        $('.cancelKerja').on('click', function(e) {
            // Get the kerjaId from the button's value
            let kerjaId = $(this).val();

            Swal.fire({
                title: "Tolak Kerja",
                text: "Anda tidak akan dapat membatalkan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, padamkannya!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/cancelKerja.php',
                        type: 'POST',
                        data: {
                            id: kerjaId
                        },
                        success: function(response) {
                            let res = JSON.parse(response);

                            if (res.success) {
                                Swal.fire({
                                    title: "Berjaya dipadam",
                                    text: res.message,
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal Padam",
                                    text: res.message,
                                    icon: "error"
                                })
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Ralat!",
                                text: "Ralat berlaku semasa mengemaskini status kerja.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });


        $('.previewQuotation').on('click', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Get the form related to the button clicked
            var form = $(this).closest('form');
            let tempahan_id = $(this).val(); // Get the value of the button (tempahan_id)

            $.ajax({
                url: 'controller/preview_quotation.php',
                type: 'POST',
                data: form.serialize(), // Serialize form data
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        // Use backticks to interpolate `id` into the URL
                        window.open(`controller/getPDF_quotation_fullpayment.php?tempahan_id=${tempahan_id}`, '_blank');
                    } else {
                        // Show error message if failure
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                }
            });
        });




        $('#terimaTempahan').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Hantar Ke KPP",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/terimaTempahan.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            let res = JSON.parse(response);
                            if (res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.message,
                                }).then(() => {
                                    window.location.href = 'tempahan.php';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message,
                                });
                            }
                        }
                    });
                }
            });


        });

        $(document).on('click', '.cancelTempahan', function(e) {
            let tempahanId = $(this).attr('value');

            Swal.fire({
                title: "Tolak Tempahan",
                text: "Sila nyatakan sebab menolak tempahan:",
                input: 'textarea', // Add input field
                inputPlaceholder: 'Sebab tolak tempahan...',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                inputValidator: (value) => {
                    if (!value) {
                        return 'Anda perlu memberikan sebab untuk menolak tempahan!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let reason = result.value; // Get input value
                    $.ajax({
                        url: 'controller/cancelTempahan.php',
                        type: 'POST',
                        data: {
                            tempahan_id: tempahanId,
                            sebab_ditolak: reason // Pass the reason to the server
                        },
                        success: function(response) {
                            let res = JSON.parse(response);
                            Swal.fire({
                                title: "Berjaya",
                                text: "Tempahan Dibatalkan",
                                icon: "success"
                            }).then(() => {
                                window.location.href = 'tempahan.php';
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Ralat!",
                                text: "Ralat berlaku semasa mengemaskini status kerja.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });


    });
</script>


</body>

</html>