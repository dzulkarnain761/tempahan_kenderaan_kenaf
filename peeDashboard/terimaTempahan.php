<?php

include 'controller/connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css" rel="stylesheet">
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
<div class="container">
    <?php
    include 'partials/navigation.php';
    ?>

    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>

            <div class="userName">
                <div class="user-name">NAMA BINTI PENUH</div>
                <div class="user">
                    <img src="../assets/images/user.png" alt="User Image">
                </div>
            </div>
        </div>

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="tempahan.php">Tempahan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Maklumat Tempahan</li>
            </ol>
        </nav>
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>MAKLUMAT TEMPAHAN</h2>
            </div>

            <?php
            $id = $_GET['id'];

            // Ensure you escape the ID to prevent SQL injection
            $id = mysqli_real_escape_string($conn, $id);

            $sqlTempahan = "SELECT t.*, p.nama 
                FROM tempahan t
                INNER JOIN penyewa p ON p.id = t.penyewa_id WHERE t.tempahan_id = $id";
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

            <form id="terimaTempahan" method="POST">
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

                <div class="mb-3">
                    <label for="jenis_kerja_input" class="form-label">Jenis Kerja:</label>
                    <?php
                    $tempahanId = $id;
                    $sqlKerja = "SELECT * FROM `tempahan_kerja` WHERE tempahan_id = $tempahanId AND status_kerja != 'cancelled'";
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
                            <div class="mb-5">
                                <input type="hidden" name="kerja_id[]" value="<?php echo htmlspecialchars($rowKerja['tempahan_kerja_id']); ?>">
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">Nama Kerja</span>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($rowKerja['nama_kerja']); ?>" disabled>
                                    <button class="btn btn-outline-danger cancelKerja" type="button" value="<?php echo htmlspecialchars($rowKerja['tempahan_kerja_id']); ?>">Batal Kerja</button>
                                </div>



                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">Kenderaan</span>
                                    <select id="kenderaan_id" class="form-select" name="kenderaan_id[]" required>
                                        <option value="" disabled selected>--Pilih Kenderaan--</option>
                                        <?php
                                        // Assuming $conn is your mysqli connection

                                        // Use prepared statements to avoid SQL injection
                                        $stmt = $conn->prepare("SELECT * FROM `tugasan` WHERE kerja = ?");
                                        $stmt->bind_param('s', $nama_kerja);
                                        $stmt->execute();
                                        $resulttugasan = $stmt->get_result();

                                        if ($resulttugasan && $resulttugasan->num_rows > 0) {
                                            $fetchTugasan = $resulttugasan->fetch_assoc();
                                            $kategoriKenderaan = $fetchTugasan['kategori_kenderaan'];

                                            if ($kategoriKenderaan) {
                                                // Prepare the statement for the second query
                                                $stmt = $conn->prepare("SELECT * FROM `kenderaan` WHERE kategori_kenderaan = ?");
                                                $stmt->bind_param('s', $kategoriKenderaan);
                                                $stmt->execute();
                                                $resultkenderaan = $stmt->get_result();

                                                if ($resultkenderaan && $resultkenderaan->num_rows > 0) {
                                                    while ($rowkenderaan = $resultkenderaan->fetch_assoc()) {
                                                        // Check if the current kenderaan is selected
                                                        $selectedkenderaan = ($rowKerja['kenderaan_id'] == $rowkenderaan['id']) ? 'selected' : '';
                                                        // Properly format the option element
                                                        echo "<option value='" . htmlspecialchars($rowkenderaan['id']) . "' $selectedkenderaan>" . htmlspecialchars($rowkenderaan['no_pendaftaran']) . ' - ' . htmlspecialchars($rowkenderaan['catatan']) . "</option>";
                                                    }
                                                } else {
                                                    echo "<option value='' disabled>No vehicles found</option>";
                                                }
                                            } else {
                                                echo "<option value='' disabled>No category found for the task</option>";
                                            }
                                        } else {
                                            echo "<option value='' disabled>No task found</option>";
                                        }

                                        // Close the statement
                                        $stmt->close();
                                        ?>
                                    </select>
                                </div>


                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">Pemandu</span>
                                    <select id="pemandu_id" class="form-select" name="pemandu_id[]" required>
                                        <option value="" disabled selected>--Pilih Pemandu--</option>
                                        <?php
                                        // Query to get pemandu from the database
                                        $sqlpemandu = "SELECT * FROM `admin` WHERE kumpulan = 'Y'";
                                        $resultpemandu = mysqli_query($conn, $sqlpemandu);

                                        // Check if the query returns any rows
                                        if ($resultpemandu && mysqli_num_rows($resultpemandu) > 0) {
                                            // Loop through the pemandu and create option elements
                                            while ($rowpemandu = mysqli_fetch_assoc($resultpemandu)) {
                                                // Determine if this option should be selected
                                                $selected = ($rowKerja['pemandu_id'] == $rowpemandu['id']) ? 'selected' : '';
                                                echo "<option value='" . htmlspecialchars($rowpemandu['id']) . "' $selected>" . htmlspecialchars($rowpemandu['nama']) . "</option>";
                                            }
                                        } else {
                                            // Display message if no pemandu are found
                                            echo "<option value='' disabled>No pemandu found</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Tarikh Kerja</span>
                                    <input type="date" class="form-control input_date" name="input_date[]" value="<?php echo htmlspecialchars($rowKerja['tarikh_kerja_cadangan']); ?>"  required>
                                    
                                </div>

                                <div class="input-group mb-2">
                                    <!-- Store the rate per hour as a hidden input field -->
                                    <input type="hidden" class="form-control rate_per_hour" value="<?php echo $rateharga; ?>">
                                    <span class="input-group-text">Jam</span>
                                    <input type="number" class="form-control input_hours" name="input_hours[]" value="<?php echo htmlspecialchars($rowKerja['jam']); ?>" min="0" step="0.5" placeholder="<?php echo $rateharga; ?> / Jam" required>
                                    <span class="input-group-text">Harga (RM)</span>
                                    <input type="text" class="form-control output_price" name="input_price[]" value="<?php echo htmlspecialchars($rowKerja['harga']); ?>" readonly>
                                    <span class="input-group-text">.00</span>
                                </div>


                            </div>
                        <?php endwhile;
                    else: ?>
                        <input type="text" class="form-control mb-2" id="jenis_kerja_input" value="No kerja found" disabled>
                    <?php endif; ?>
                </div>



                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Terima Tempahan</button>
                </div>


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



        $(document).on('input', '.input_hours', function() {
            // Find the closest parent with the class `.mb-5` to ensure the correct set of inputs
            let parentDiv = $(this).closest('.mb-5');

            // Get the rate per hour and hours from the respective input fields
            let rate_per_hour = parentDiv.find('.rate_per_hour').val();
            let hours = $(this).val();

            // Calculate the price if both values are provided
            if (hours && rate_per_hour) {
                let price = hours * rate_per_hour;
                parentDiv.find('.output_price').val(price);
            } else {
                parentDiv.find('.output_price').val('0');
            }
        });


        // Attach click event to all buttons with class 'cancelKerja'
        $('.cancelKerja').on('click', function(e) {
            // Get the kerjaId from the button's value
            let kerjaId = $(this).val();

            Swal.fire({
                title: "Adakah anda pasti?",
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
                            Swal.fire({
                                title: "Berjaya dipadam!",
                                text: "Status kerja telah dikemaskini.",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
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




        $('#terimaTempahan').on('submit', function(e) {
            e.preventDefault();

            // Serialize form data and make AJAX request
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
        });

    });
</script>


</body>

</html>