<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    //   die("Connection failed: " . mysqli_connect_error());
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        .custom-container {
            position: relative;
            width: 100%;
        }

        ul {
            all: unset;
            list-style: disc;
            /* padding-left: 20px; */
            margin: 0;
        }
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
                <input type="hidden" name="tempahanId" value="<?php echo htmlspecialchars($tempahan['tempahan_id']) ?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tarikh Permohonan:</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['created_at']) ?>" disabled>
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
                    <label for="jenis_kerja_input" class="form-label">Jenis Kerja:</label>
                    <?php
                    $tempahanId = $id;
                    $sqlKerja = "SELECT * FROM `tempahan_kerja` WHERE tempahan_id = $tempahanId";
                    $resultKerja = mysqli_query($conn, $sqlKerja);
                    if ($resultKerja && mysqli_num_rows($resultKerja) > 0):
                        while ($rowKerja = mysqli_fetch_assoc($resultKerja)): ?>
                            <div class="input-group mb-3">
                                <input type="hidden" class="form-control" id="kerjaID" value="<?php echo htmlspecialchars($rowKerja['tempahan_id']); ?>">
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($rowKerja['nama_kerja']); ?>" disabled>
                
                            </div>
                        <?php endwhile;
                    else: ?>
                        <input type="text" class="form-control mb-2" id="jenis_kerja_input" value="No kerja found" disabled>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Catatan:</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($tempahan['catatan']) ?>" disabled>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Terima Tempahan</button>
                </div>


            </form>
        </div>

        <!-- Modal HTML -->
        <div class="modal fade" id="changeEditModal" tabindex="-1" aria-labelledby="changeEditModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeEditModalLabel">Kemaskini Kerja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateKerjaForm" method="POST">
                            <input type="hidden" id="modalKerjaId" name="id">

                            <div class="mb-3" id="display_nama_kerja">
                                <!-- Options will be populated by AJAX -->
                            </div>

                            <div class="mb-3">
                                <label for="no_pendaftaran_kenderaan" class="form-label">Kenderaan</label>
                                <select id="no_pendaftaran_kenderaan" class="form-control" name="no_pendaftaran_kenderaan" required>

                                    <!-- Options will be populated by AJAX -->
                                </select>
                                <div class="invalid-feedback">Sila pilih kenderaan penempatan.</div>
                            </div>

                            <div class="mb-3">
                                <label for="nama_pemandu" class="form-label">Pemandu</label>
                                <select id="nama_pemandu" class="form-control" name="nama_pemandu" required>

                                    <!-- Options will be populated by AJAX -->
                                </select>
                                <div class="invalid-feedback">Sila pilih kawasan penempatan.</div>
                            </div>

                            <div class="mb-3">
                                <label for="harga_anggaran" class="form-label">Harga Tugasan:</label>
                                <input type="number" class="form-control" id="harga_anggaran" name="harga_anggaran" required>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Kemaskini</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
        changeEditModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget;

            // Extract info from data-* attributes
            var kerjaId = button.getAttribute('data-id');

            // Update the modal's hidden input value
            var modalKerjaId = changeEditModal.querySelector('#modalKerjaId');
            modalKerjaId.value = kerjaId;


            // Trigger AJAX to populate nama_kerja
            $.ajax({
                type: 'POST',
                url: 'controller/get_kerja.php',
                data: {
                    id: kerjaId
                },
                success: function(response) {
                    $('#display_nama_kerja').html(response);
                },
                error: function() {
                    $('#display_nama_kerja').html('<input type="text" id="nama_kerja" name="nama_kerja" value="not found">');
                }
            });


            $.ajax({
                type: 'POST',
                url: 'controller/get_kenderaan.php',
                data: {
                    id: kerjaId
                },
                success: function(response) {
                    $('#no_pendaftaran_kenderaan').html(response);
                },
                error: function() {
                    $('#no_pendaftaran_kenderaan').html('<option>NOT FOUND</option>');
                }
            });


            $.ajax({
                type: 'POST',
                url: 'controller/get_pemandu.php',
                data: {
                    id: kerjaId
                },
                success: function(response) {
                    $('#nama_pemandu').html(response);
                },
                error: function() {
                    $('#nama_pemandu').html('<option>NOT FOUND</option>');
                }
            });

            $.ajax({
                type: 'POST',
                url: 'controller/get_harga.php',
                data: {
                    id: kerjaId
                },
                success: function(response) {
                    // Directly set the value of the input field
                    $('#harga_anggaran').val(response.trim());
                },
                error: function() {
                    $('#harga_anggaran').val('not found');
                }
            });



            $.ajax({
                url: 'controller/updateKerja.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Kemaskini Berjaya',
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

            $('#updateKerjaForm').on('submit', function(e) {
                e.preventDefault();

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/updateKerja.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Kemaskini Berjaya',
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while updating. Please try again.',
                        });
                    }
                });

            });

        });

        $('#terimaTempahan').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

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
                                text: 'Kemaskini Berjaya',
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