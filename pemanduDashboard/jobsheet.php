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

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="tempahan.php">Tempahan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Jobsheet</li>
            </ol>
        </nav>
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>MAKLUMAT TEMPAHAN</h2>
            </div>

            <?php
            include 'controller/connection.php';

            // Get the ID from the URL query string
            $id = $_GET['id'];

            // Query to get the necessary details
            $sqlTempahan = "SELECT t.lokasi_kerja, t.luas_tanah, p.nama, tk.*, tk.nama_kerja, k.no_pendaftaran, tgs.harga_per_jam
                    FROM tempahan t
                    LEFT JOIN penyewa p ON p.id = t.penyewa_id
                    LEFT JOIN tempahan_kerja tk ON tk.tempahan_id = t.tempahan_id
                    LEFT JOIN kenderaan k ON k.id = tk.kenderaan_id
                    LEFT JOIN tugasan tgs ON tgs.kerja = tk.nama_kerja
                    WHERE tk.tempahan_kerja_id = $id";

            // Execute the query
            $result = $conn->query($sqlTempahan);

            // Fetch the data into an associative array
            if ($result->num_rows > 0) {
                $tempahan = $result->fetch_assoc();
            } else {
                echo "No records found.";
                $tempahan = [];
            }
            ?>

            <form>

                <div class="mb-3">
                    <label for="namaPenyewa" class="form-label">Nama Penyewa :</label>
                    <input type="text" class="form-control" id="namaPenyewa" value="<?php echo isset($tempahan['nama']) ? $tempahan['nama'] : ''; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">Tarikh Kerja :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo isset($tempahan['tarikh_kerja_cadangan']) ? $tempahan['tarikh_kerja_cadangan'] : ''; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="noPendaftaran" class="form-label">Nombor Pendaftaran Kenderaan :</label>
                    <input type="text" class="form-control" id="noPendaftaran" value="<?php echo isset($tempahan['no_pendaftaran']) ? $tempahan['no_pendaftaran'] : ''; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="luasTanah" class="form-label">Luas Tanah :</label>
                    <input type="text" class="form-control" id="luasTanah" value="<?php echo isset($tempahan['luas_tanah']) ? $tempahan['luas_tanah'] : ''; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="lokasiKerja" class="form-label">Lokasi Kerja :</label>
                    <input type="text" class="form-control" id="lokasiKerja" value="<?php echo isset($tempahan['lokasi_kerja']) ? $tempahan['lokasi_kerja'] : ''; ?>" readonly>
                </div>
            </form>



        </div>

        <div class="recentOrders">
            <div class="cardHeader">
                <h2>BORANG PENGESAHAN KERJA</h2>
            </div>

            <form id="selesaiKerja" method="POST">
                <input type="hidden" name="tempahan_kerja_id" value="<?php echo $id ?>">
                <div class="mb-3">
                    <label for="nama_kerja" class="form-label">Nama Kerja :</label>
                    <input type="text" class="form-control" id="nama_kerja" name="nama_kerja" value="<?php echo isset($tempahan['nama_kerja']) ? $tempahan['nama_kerja'] : ''; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="harga_per_jam" class="form-label">Harga Per Jam (RM/Jam)</label>
                    <input type="text" class="form-control" id="harga_per_jam" name="harga_per_jam" value="<?php echo isset($tempahan['harga_per_jam']) ? $tempahan['harga_per_jam'] : ''; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="masa_mula" class="form-label">Odometer Masa Mula</label>
                    <input type="time" class="form-control" id="masa_mula" name="masa_mula" required>
                </div>
                <div class="mb-3">
                    <label for="masa_akhir" class="form-label">Odometer Masa Akhir</label>
                    <input type="time" class="form-control" id="masa_akhir" name="masa_akhir" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_jam" class="form-label">Jumlah Jam Kerja</label>
                    <input type="text" class="form-control" id="jumlah_jam" name="jumlah_jam" placeholder="Jumlah Jam Kerja" readonly>
                </div>
                <div class="mb-3">
                    <label for="jumlah_bayaran" class="form-label">Jumlah Bayaran (RM)</label>
                    <input type="text" class="form-control" id="jumlah_bayaran" name="jumlah_bayaran" placeholder="Jumlah Bayaran" readonly>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Hantar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="../assets/js/main.js"></script>

<!-- ====== ionicons ======= -->
<script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
<script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



<script>
    $(document).ready(function() {
        // Function to calculate total working hours and price
        function calculateTotal() {
            var masa_mula = $('#masa_mula').val();
            var masa_akhir = $('#masa_akhir').val();
            var harga_per_jam = $('#harga_per_jam').val();

            if (masa_mula && masa_akhir) {
                var start_time = new Date("1970-01-01 " + masa_mula);
                var end_time = new Date("1970-01-01 " + masa_akhir);

                // Calculate total hours worked
                var time_diff = (end_time - start_time) / (1000 * 60 * 60); // Convert milliseconds to hours
                if (time_diff < 0) {
                    time_diff += 24; // Handle overnight shifts
                }

                // Calculate total payment
                var total_bayaran = time_diff * parseFloat(harga_per_jam);

                // Update fields
                $('#jumlah_jam').val(time_diff.toFixed(2)); // Show hours worked
                $('#jumlah_bayaran').val(total_bayaran.toFixed(2)); // Show total price
            }
        }

        // Trigger the calculation when the time inputs change
        $('#masa_mula, #masa_akhir').on('change', calculateTotal);


        $('#selesaiKerja').on('submit', function(e) {
            e.preventDefault();

            // Serialize form data and make AJAX request
            $.ajax({
                url: 'controller/selesaiKerja.php',
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