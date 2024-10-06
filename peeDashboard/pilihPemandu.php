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

        <?php

        $tempahan_id = $_GET['tempahan_id'];
        $tempahan_kerja_id = $_GET['tempahan_kerja_id'];

        // Ensure you escape the ID to prevent SQL injection
        $tempahan_kerja_id = mysqli_real_escape_string($conn, $tempahan_kerja_id);

        $sqlTempahanKerja = "SELECT * FROM tempahan_kerja WHERE tempahan_kerja_id = $tempahan_kerja_id";
        $resultTempahanKerja = mysqli_query($conn, $sqlTempahanKerja);

        // Fetch the Pemandu member's data
        if ($resultTempahanKerja && mysqli_num_rows($resultTempahanKerja) > 0) {
            $tempahan_kerja = mysqli_fetch_assoc($resultTempahanKerja);
        } else {
            // Handle the case where no Pemandu member is found
            echo "Tiada Tempahan Dijumpai";
            exit;
        }

        ?>

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="tempahan.php">Tempahan</a></li>
                <li class="breadcrumb-item"><a href="terimaTempahan.php?tempahan_id=<?php echo $tempahan_id ?>">Maklumat Tempahan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kemaskini Kerja</li>
            </ol>
        </nav>


        <div class="recentOrders">
            <div class="cardHeader">
                <h2>PENGESAHAN TEMPAHAN</h2>
            </div>



            <form id="updateJobsheet" method="POST">

                <div class="mb-3">
                    <input type="hidden" name="tempahan_kerja_id" value="<?php echo $tempahan_kerja['tempahan_kerja_id']; ?>">
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">Nama Kerja</span>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($tempahan_kerja['nama_kerja']); ?>" disabled>
                    </div><br>

                    <?php
                    $sqlJobsheet = "SELECT * FROM `jobsheet` WHERE tempahan_kerja_id = $tempahan_kerja_id";
                    $resultJobsheet = mysqli_query($conn, $sqlJobsheet);

                    if ($resultJobsheet && mysqli_num_rows($resultJobsheet) > 0) {
                        while ($rowJobsheet = mysqli_fetch_assoc($resultJobsheet)) {

                    ?>
                            <input type="hidden" name="jobsheet_id[]" value="<?php echo $rowJobsheet['jobsheet_id']; ?>">

                            <!-- Kenderaan Select -->
                            <div class="input-group mb-2">
                                <span class="input-group-text" id="basic-addon1">Kenderaan</span>
                                <select class="form-select" name="kenderaan_id[]" required>
                                    <option value="" disabled selected>--Pilih Kenderaan--</option>
                                    <?php

                                    $stmt = $conn->prepare("SELECT * FROM `kenderaan`");
                                    $stmt->execute();
                                    $resultkenderaan = $stmt->get_result();

                                    if ($resultkenderaan && $resultkenderaan->num_rows > 0) {
                                        while ($rowkenderaan = $resultkenderaan->fetch_assoc()) {
                                            $selectedkenderaan = ($rowJobsheet['kenderaan_id'] == $rowkenderaan['id']) ? 'selected' : '';
                                            echo "<option value='" . htmlspecialchars($rowkenderaan['id']) . "' $selectedkenderaan>" . htmlspecialchars($rowkenderaan['no_pendaftaran']) . ' - ' .  htmlspecialchars($rowkenderaan['catatan']) . "</option>";
                                        }
                                    ?>

                                    <?php
                                    } ?>
                                </select>

                                <span class="input-group-text" id="basic-addon1">Pemandu</span>
                                <select class="form-select" name="pemandu_id[]" required>
                                    <option value="" disabled selected>--Pilih Pemandu--</option>
                                    <?php

                                    $stmt = $conn->prepare("SELECT * FROM `admin` WHERE kumpulan = 'Y'");
                                    $stmt->execute();
                                    $resultpemandu = $stmt->get_result();

                                    if ($resultpemandu && $resultpemandu->num_rows > 0) {
                                        while ($rowpemandu = $resultpemandu->fetch_assoc()) {
                                            $selectedpemandu = ($rowJobsheet['pemandu_id'] == $rowpemandu['id']) ? 'selected' : '';
                                            echo "<option value='" . htmlspecialchars($rowpemandu['id']) . "' $selectedpemandu>" . htmlspecialchars($rowpemandu['nama']) . "</option>";
                                        }
                                    ?>

                                    <?php
                                    } ?>

                                </select>
                                <button type="button" class="btn btn-outline-danger deleteJobsheet" value="<?php echo $rowJobsheet['jobsheet_id']; ?>">Padam</button>

                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>Tiada Jobsheet.</p>";
                    }
                    ?>

                    <div class="modal-footer d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn btn-primary addJobsheet">Tambah Jobsheet</button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success ">Kemaskini</button>
                        </div>
                    </div>


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

        // Attach click event to all buttons with class 'cancelKerja'
        $('.addJobsheet').on('click', function(e) {

            Swal.fire({
                title: "Tambah Jobsheet",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/addJobsheet.php',
                        type: 'POST',
                        data: {
                            tempahan_kerja_id: <?= json_encode($tempahan_kerja_id) ?>, // Ensure proper PHP to JS output
                        },
                        success: function(response) {
                            let res = JSON.parse(response); // Parse the JSON response
                            if (res.success) {
                                window.location.reload();
                            } else {
                                Swal.fire({
                                    title: "Ralat!",
                                    text: res.message || "Ralat berlaku semasa menambah Jobsheet.",
                                    icon: "error"
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Ralat!",
                                text: "Ralat berlaku semasa menambah Jobsheet.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });

        $('.deleteJobsheet').on('click', function(e) {
            let button = $(this);
            let jobsheet_id = button.val(); // Correctly fetching button value

            Swal.fire({
                title: "Padam Jobsheet",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/deleteJobsheet.php',
                        type: 'POST',
                        data: {
                            jobsheet_id: jobsheet_id, // Sending jobsheet_id
                        },
                        success: function(response) {
                            let res = JSON.parse(response);
                            if (res.success) {
                                window.location.reload(); // Reload on success
                            } else {
                                Swal.fire({
                                    title: "Ralat!",
                                    text: res.message || "Ralat berlaku semasa memadam Jobsheet.",
                                    icon: "error"
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Ralat!",
                                text: "Ralat berlaku semasa memadam Jobsheet.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });


        $('#updateJobsheet').on('submit', function(e) {
            e.preventDefault();

            // Serialize form data and make AJAX request
            $.ajax({
                url: 'controller/updateJobsheet.php',
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
                            window.location.href = 'terimaTempahan.php?tempahan_id=<?= $tempahan_id ?>';
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