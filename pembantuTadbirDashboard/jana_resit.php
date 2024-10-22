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
    <link href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="custom-container">
        <?php
        include 'partials/navigation.php';
        ?>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <?php include 'partials/name_display.php'; ?>
            </div>
            <?php
            include 'controller/connection.php';

            // Get the ID from the URL query string
            $tempahan_id = $_GET['tempahan_id'];

            // Query to get the necessary details
            $sqlTempahan = "SELECT t.tempahan_id,t.lokasi_kerja,t.luas_tanah,t.status_tempahan, t.tarikh_kerja, p.nama, r.jenis_pembayaran, r.cara_bayar,r.nombor_rujukan
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                LEFT JOIN resit_pembayaran r ON r.tempahan_id = t.tempahan_id
                WHERE t.tempahan_id = $tempahan_id";

            // Execute the query
            $result = $conn->query($sqlTempahan);

            // Fetch the data into an associative array
            if ($result->num_rows > 0) {
                $tempahan = $result->fetch_assoc();
            } else {
                echo "No records found.";
                $tempahan = [];
            }

            $pathback = $tempahan['status_tempahan'] == 'penjanaan resit' ? 'tempahan_resit.php' : 'sejarahTempahan.php';
            ?>

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $pathback ?>">Senarai Tempahan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jana Resit</li>
                </ol>
            </nav>



            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Butiran Tempahan</h2>
                </div>

                <div class="mb-3">
                    <label for="namaPenyewa" class="form-label">Tempahan ID :</label>
                    <input type="text" class="form-control" id="namaPenyewa" value="<?php echo $tempahan['tempahan_id'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">Nama Penyewa :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['nama'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">Lokasi Kerja :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['lokasi_kerja'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">Luas Tanah (Hektar) :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['luas_tanah'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">Cara Bayaran :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['cara_bayar'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="tarikhKerja" class="form-label">Jenis Pembayaran :</label>
                    <input type="text" class="form-control" id="tarikhKerja" value="<?php echo $tempahan['jenis_pembayaran'] ?>" readonly>
                </div>




            </div>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Butiran Kerja</h2>
                </div>

                <?php
                // Prepare the first statement to get total_harga_anggaran and total_harga_sebenar
                $sql1 = $conn->prepare("SELECT total_harga_anggaran, total_harga_sebenar FROM tempahan WHERE tempahan_id = ?");
                $sql1->bind_param("s", $tempahan_id);
                $sql1->execute();
                $sql1->bind_result($total_harga_anggaran, $total_harga_sebenar);
                $sql1->fetch(); // Fetch the result

                // Close the first statement
                $sql1->close();

                // Prepare the second statement for tempahan_kerja
                $sqlkerja = $conn->prepare("SELECT * FROM tempahan_kerja WHERE tempahan_id = ?");
                $sqlkerja->bind_param("s", $tempahan_id);
                $sqlkerja->execute();
                $result = $sqlkerja->get_result(); // Get the result set from the prepared statement

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                ?>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Nama Kerja</span>
                            <input type="text" class="form-control" id="namaPenyewa" value="<?php echo htmlspecialchars($row['nama_kerja']); ?>" readonly>
                            <span class="input-group-text">Tarikh Kerja</span>
                            <input type="text" class="form-control" id="namaPenyewa" value="<?php echo htmlspecialchars($row['tarikh_kerja_cadangan']); ?>" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Jam </span>
                            <input type="number" class="form-control input_hours" value="<?php echo htmlspecialchars($row['jam_anggaran']); ?>" readonly>
                            <span class="input-group-text">Minit </span>
                            <input type="text" class="form-control output_price" value="<?php echo htmlspecialchars($row['minit_anggaran']); ?>" readonly>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Harga </span>
                            <input type="number" class="form-control input_hours" value="<?php echo htmlspecialchars($row['harga_anggaran']); ?>" readonly>
                        </div><br>

                <?php

                    }
                } else {
                    echo "<p>No work found for this order.</p>";
                }
                ?>

                <div class="input-group mb-2 align-self-end">
                    <span class="input-group-text">Total Harga (RM)</span>
                    <input type="text" class="form-control output_price" value="<?php echo $total_harga_anggaran ?? '0'; ?>" readonly>
                </div><br>
                <?php if ($tempahan['status_tempahan'] == 'penjanaan resit') { ?>
                    <form method="post" enctype="multipart/form-data" id="janaResitForm">
                        <input type="hidden" name="tempahan_id" value="<?php echo $tempahan_id ?>">
                        <div class="mb-3">
                            <label for="tarikhKerja" class="form-label">Bukti Resit : </label>
                            <input type="file" class="form-control" name="gambar_resit" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-primary" onclick="window.open('controller/getPDF_quotation_fullpayment.php?tempahan_id=<?= $tempahan_id ?>', '_blank')">Lihat Sebut Harga</button>
                            </div>
                            <div>

                                <button type="submit" class="btn btn-success janaResit">Jana Resit</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>

        </div>
    </div>


    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
    <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        $(document).ready(function() {

            $(document).on('submit', '#janaResitForm', function(e) {
                e.preventDefault(); // Prevent default form submission

                Swal.fire({
                    title: "Jana Resit",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create FormData object to handle the form submission with file
                        var formData = new FormData(this);

                        $.ajax({
                            url: 'controller/janaResit.php',
                            type: 'POST',
                            data: formData, // Send FormData
                            processData: false, // Don't process the files
                            contentType: false, // Set content type to false as jQuery will tell the server its multipart/form-data
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: res.message,
                                    }).then(() => {
                                        window.location.href = 'tempahan_resit.php';
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
                                    text: 'Something went wrong!',
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