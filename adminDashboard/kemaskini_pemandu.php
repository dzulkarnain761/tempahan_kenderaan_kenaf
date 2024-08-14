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

$sqlKumpulan = "SELECT `kump_kod`, `kump_desc` 
FROM `kumpulan` 
WHERE `kump_kod` NOT IN ('X', 'Y', 'Z')";

$resultKumpulan = mysqli_query($conn, $sqlKumpulan);



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

        .cardHeader h3 {
            font-weight: 600;
            color: var(--blue);
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        /* ================== Table details ============== */
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
                    <li class="breadcrumb-item"><a href="staff.php">Pemandu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kemaskini Pemandu</li>
                </ol>
            </nav>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h3>Kemaskini Pemandu</h3>
                </div>
                <?php
                $id = $_GET['id'];

                // Ensure you escape the ID to prevent SQL injection
                $id = mysqli_real_escape_string($conn, $id);

                $sqlPemandu = "SELECT * FROM `pemandu` WHERE id_pemandu = $id";
                $resultEditPemandu = mysqli_query($conn, $sqlPemandu);

                // Fetch the Pemandu member's data
                if ($resultEditPemandu && mysqli_num_rows($resultEditPemandu) > 0) {
                    $pemandu = mysqli_fetch_assoc($resultEditPemandu);
                } else {
                    // Handle the case where no Pemandu member is found
                    echo "No Pemandu member found.";
                    exit;
                }

                ?>

                <form class="updatePemandu" method="POST" novalidate>

                    <div class="mb-3">
                        <label for="nama_pemandu" class="form-label">Nama Pemandu</label>
                        <input type="text" class="form-control" id="nama_pemandu" name="nama_pemandu" value="<?php echo htmlspecialchars($pemandu['nama']); ?>" placeholder="Masukkan Nama Pemandu" minlength="10" required>
                        <div class="invalid-feedback">Sila masukkan nama pemandu.</div>
                    </div>

                    <div class="mb-3">
                        <label for="no_kp" class="form-label">Nombor Kad Pengenalan</label>
                        <input type="text" class="form-control" id="no_kp" name="no_kp" minlength="12" maxlength="12" value="<?php echo htmlspecialchars($pemandu['no_kp']); ?>" placeholder="Masukkan Nombor Kad Pengenalan" required>
                        <div class="invalid-feedback">Sila masukkan nombor kad pengenalan.</div>
                    </div>

                    <div class="mb-3">
                        <label for="no_tel" class="form-label">Nombor Telefon</label>
                        <input type="tel" class="form-control" id="no_tel" name="no_tel" value="<?php echo htmlspecialchars($pemandu['contact_no']); ?>" placeholder="Masukkan Nombor Telefon" minlength="10" maxlength="11" required>
                        <div class="invalid-feedback">Sila masukkan nombor telefon.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email_pemandu" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_pemandu" name="email_pemandu" value="<?php echo htmlspecialchars($pemandu['email']); ?>" placeholder="Masukkan Nombor Kad Pengenalan">
                        <div class="invalid-feedback">Sila masukkan Email yang betul.</div>
                    </div>

                    <div class="mb-3">
                        <label for="kategori_lesen" class="form-label">Kategori Lesen</label>
                        <select id="kategori_lesen" class="form-control" name="kategori_lesen" required>
                            <?php

                            $sqlKategori = "SELECT * FROM `kategori_lesen`";

                            $resultKategori = mysqli_query($conn, $sqlKategori);
                            // Fetch the current `kump_kod` value from the database
                            $currentKumpKod = $pemandu['kategori_lesen']; // Assuming you already have this value from a previous query

                            while ($row = mysqli_fetch_assoc($resultKategori)) {
                                // Check if the current `kump_kod` matches the one in the loop
                                $selected = ($row['kategori'] == $currentKumpKod) ? 'selected' : '';
                                echo '<option value="' . $row['kategori'] . '" ' . $selected . '>' . $row['kategori'] . ' - ' . $row['description'] . '</option>';
                            }

                            ?>
                        </select>
                        <div class="invalid-feedback">Sila pilih kategori lesen.</div>
                    </div>

                    <div class="mb-3">
                        <label for="tarikh_tamat_lesen" class="form-label">Tarikh Tamat Lesen</label>
                        <input type="date" class="form-control" id="tarikh_tamat_lesen" name="tarikh_tamat_lesen" value="<?php echo htmlspecialchars($pemandu['tarikh_tamat_lesen']); ?>" placeholder="Pilih Tarikh Tamat Lesen" required>
                        <div class="invalid-feedback">Sila pilih tarikh tamat lesen.</div>
                    </div>

                    <div class="mb-3">
                        <label for="status_pemandu" class="form-label">Status</label>
                        <select id="status_pemandu" class="form-control" name="status_pemandu" required>
                            <option value="Aktif" <?php echo ($pemandu['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="Tidak Aktif" <?php echo ($pemandu['status'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                        <div class="invalid-feedback">Sila pilih status.</div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($pemandu['id_pemandu']); ?>">
                    <div class="modal-footer">

                        <div>
                            <button type="submit" class="btn btn-primary">Kemaskini Staf</button>
                        </div>
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
            const forms = document.querySelectorAll('.updatePemandu')

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
            $('.updatePemandu').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/edit_pemandu.php',
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
                                window.location.href = 'pemandu.php';
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