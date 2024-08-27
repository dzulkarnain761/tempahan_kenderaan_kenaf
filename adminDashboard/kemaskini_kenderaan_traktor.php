<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        nav .breadcrumb {
            margin-left: 24px;
        }

        .recentOrders {
            position: relative;
            display: grid;
            min-height: 500px;
            background: var(--white);
            padding: 20px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }
    </style>

</head>

<body>
    <div class="custom-container">
        <?php
        include 'partials/navigation.php';
        ?>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="userName">
                    <div class="user-name">NAMA BINTI PENUH</div>
                    <div class="user">
                        <img src="assets/images/user.png" alt="User Image">
                    </div>
                </div>
            </div>

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="kenderaan_traktor.php">Senarai Traktor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kemaskini Traktor</li>
                </ol>
            </nav>
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Kemaskini Traktor</h2>
                </div>
                <?php
                $id = $_GET['id'];

                // Ensure you escape the ID to prevent SQL injection
                $id = mysqli_real_escape_string($conn, $id);

                $sqlKenderaan = "SELECT * FROM `kenderaan_traktor` WHERE id = $id";
                $resultEditKenderaan = mysqli_query($conn, $sqlKenderaan);

                // Fetch the Pemandu member's data
                if ($resultEditKenderaan && mysqli_num_rows($resultEditKenderaan) > 0) {
                    $kenderaan = mysqli_fetch_assoc($resultEditKenderaan);
                } else {
                    // Handle the case where no Pemandu member is found
                    echo "Tiada Kenderaan Dijumpai";
                    exit;
                }

                ?>

                <form class="editKenderaan" novalidate>
                    <!-- <div class="mb-3">
                        <label for="kategori_kenderaan" class="form-label">Kategori Kenderaan</label>
                        <select id="kategori_kenderaan" class="form-control" name="kategori_kenderaan">

                            <?php

                            // $sqlKategori = "SELECT * FROM `kategori_kenderaan`";

                            // $resultKategori = mysqli_query($conn, $sqlKategori);
                            // // Fetch the current `kump_kod` value from the database
                            // $currentKategori = $kenderaan['kategori']; // Assuming you already have this value from a previous query

                            // while ($row = mysqli_fetch_assoc($resultKategori)) {
                            //     // Check if the current `kump_kod` matches the one in the loop
                            //     $selected = ($row['kategori'] == $currentKategori) ? 'selected' : '';
                            //     echo '<option value="' . $row['kategori'] . '" ' . $selected . '>' . $row['kategori'] .  '</option>';
                            // }

                            ?>
                        </select>
                    </div> -->

                    <div class="mb-3">
                        <label for="no_aset" class="form-label">Nombor Aset</label>
                        <input type="text" class="form-control" id="no_aset" name="no_aset" placeholder="Masukkan Nombor Aset" value="<?php echo htmlspecialchars($kenderaan['no_aset']); ?>" required>
                        <div class="invalid-feedback">Sila masukkan nombor aset.</div>
                    </div>
                    <div class="mb-3">
                        <label for="no_pendaftaran_kenderaan" class="form-label">Nombor Pendaftaran Kenderaan</label>
                        <input type="text" class="form-control" id="no_pendaftaran_kenderaan" name="no_pendaftaran_kenderaan" value="<?php echo htmlspecialchars($kenderaan['no_pendaftaran']); ?>" placeholder="Masukkan Nombor Pendaftaran Kenderaan" required>
                        <div class="invalid-feedback">Sila masukkan nombor pendaftaran kenderaan.</div>
                    </div>

                    <div class="mb-3">
                        <label for="tahun_daftar" class="form-label">Tahun Daftar</label>
                        <input type="text" class="form-control" id="tahun_daftar" name="tahun_daftar" value="<?php echo htmlspecialchars($kenderaan['tahun_daftar']); ?>" placeholder="Masukkan Tahun Daftar" required>
                        <div class="invalid-feedback">Sila masukkan tahun daftar.</div>
                    </div>

                    <div class="mb-3">
                        <label for="negeri_penempatan" class="form-label">Negeri Penempatan</label>
                        <select id="negeri_penempatan" class="form-control" name="negeri_penempatan" required>

                            <?php
                            $sqlNegeri = "SELECT * FROM negeri";
                            $resultNegeri = mysqli_query($conn, $sqlNegeri);

                            $currentNegeri = $kenderaan['negeri_penempatan'];

                            while ($row = mysqli_fetch_assoc($resultNegeri)) {
                                $selected = ($row['nama_negeri'] == $currentNegeri) ? 'selected' : '';
                                echo '<option value="' . $row['id_negeri'] . '" ' . $selected . '>' . $row['nama_negeri'] .  '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Sila pilih negeri penempatan.</div>
                    </div>

                    <div class="mb-3">
                        <label for="kawasan_penempatan" class="form-label">Kawasan</label>
                        <select id="kawasan_penempatan" class="form-control" name="kawasan_penempatan" required>
                            <?php
                            // Populate kawasan_penempatan based on the current negeri_penempatan
                            $sqlKawasan = "SELECT * FROM kawasan WHERE id_negeri = (SELECT id_negeri FROM negeri WHERE nama_negeri = '$currentNegeri')";
                            $resultKawasan = mysqli_query($conn, $sqlKawasan);

                            while ($row = mysqli_fetch_assoc($resultKawasan)) {
                                $selected = ($row['nama_kaw'] == $currentKawasan) ? 'selected' : '';
                                echo '<option value="' . $row['id_kaw'] . '" ' . $selected . '>' . $row['nama_kaw'] . '</option>';
                            }
                            ?>
                            <!-- Options will be populated by AJAX -->
                        </select>
                        <div class="invalid-feedback">Sila pilih kawasan penempatan.</div>
                    </div>

                    <div class="mb-3">
                        <label for="harga_belian" class="form-label">Harga Belian</label>
                        <input type="text" class="form-control" id="harga_belian" name="harga_belian" value="<?php echo htmlspecialchars($kenderaan['harga_belian']); ?>" placeholder="Masukkan Harga Belian" required>
                        <div class="invalid-feedback">Sila masukkan harga belian.</div>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <input type="text" class="form-control" id="catatan" name="catatan" value="<?php echo htmlspecialchars($kenderaan['catatan']); ?>">
                        <!-- <div class="invalid-feedback">Sila masukkan tahun daftar.</div> -->
                    </div>

                    <div class="mb-3">
                        <label for="status_kenderaan" class="form-label">Status</label>
                        <select id="status_kenderaan" class="form-control" name="status_kenderaan" required>
                            <option value="Aktif" <?php echo ($kenderaan['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="Tidak Aktif" <?php echo ($kenderaan['status'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                        <div class="invalid-feedback">Sila pilih status kenderaan.</div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kemaskini Traktor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
    <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.editKenderaan')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })


        })()


        $(document).ready(function() {

            $('#negeri_penempatan').change(function() {
                var id_negeri = $(this).val();

                if (id_negeri) {
                    $.ajax({
                        type: 'POST',
                        url: 'controller/get_kawasan.php',
                        data: {
                            id_negeri: id_negeri
                        },
                        success: function(response) {
                            $('#kawasan_penempatan').html(response);
                        }
                    });
                } else {
                    $('#kawasan_penempatan').html('<option disabled selected>--Pilih Kawasan--</option>');
                }
            });

            $('.editKenderaan').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/edit/edit_kenderaan_traktor.php',
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
                                window.location.href = 'kenderaan_traktor.php';
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