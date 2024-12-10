<?php

include '../Models/Database.php';
$conn = Database::getConnection();
include 'controller/session.php';
include 'controller/get_userdata.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <style>
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <?php include 'partials/header.php'; ?>



    <!-- ***** Jam Harian ***** -->
    <div class="modal-dialog modal-dialog-centered" id="form-jam-harian" >
        <div class="modal-content" style="margin-top: 20px; margin-bottom:25px;">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Sewa Per Jam atau Harian</h5>
            </div>
            <div class="modal-body">

                <form class="createTempahan" method="POST">
                    <div class="mb-3">
                        <label for="tarikh_kerja" class="form-label">Cadangan Tarikh Kerja :</label>
                        <input type="date" class="form-control" id="tarikh_kerja" name="tarikh_kerja" required>
                    </div>
                    <div class="mb-3">
                        <label for="keluasan_tanah" class="form-label">Keluasan Tanah (Hektar) :</label>
                        <input type="number" class="form-control" id="keluasan_tanah" name="keluasan tanah" min="0" step="0.1" placeholder="Masukkan Keluasan Tanah" required>
                    </div>
                    <div class="mb-3">
                        <label for="negeri" class="form-label">Negeri</label>
                        <select id="negeri" class="form-select" name="negeri" required>
                            <option disabled selected value="">--Pilih Negeri--</option>
                            <?php
                            $sqlNegeri = "SELECT * FROM negeri";
                            $resultNegeri = mysqli_query($conn, $sqlNegeri);

                            while ($row = mysqli_fetch_assoc($resultNegeri)) {
                                echo '<option value="' . $row['nama_negeri'] . '">' . $row['nama_negeri'] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Sila pilih negeri penempatan.</div>
                    </div>


                    <div class="mb-3">
                        <label for="lokasi_kerja" class="form-label">Lokasi Kerja :</label>
                        <input type="text" class="form-control" id="lokasi_kerja" name="lokasi_kerja" placeholder="Masukkan lokasi">
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan :</label>
                        <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan">
                    </div>

                    <div class="mb-3">
                        <label for="kerja" class="form-label">Jenis Kerja :</label>
                        <select id="kerja" class="form-select" name="kerja[]" required onchange="showButton()">
                            <option disabled selected value="">--Pilih Jenis Kerja--</option>
                            <?php
                            // Assuming you have a database connection set up as $conn
                            $sqlTugasan = "SELECT * FROM `tugasan` ORDER BY `kategori_kenderaan`, `kerja`";
                            $result = $conn->query($sqlTugasan);

                            $currentCategory = ''; // Variable to track the current category
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Check if the category has changed, if so, close the previous optgroup and start a new one
                                    if ($currentCategory != $row['kategori_kenderaan']) {
                                        if ($currentCategory != '') {
                                            echo '</optgroup>'; // Close the previous optgroup if it's not the first one
                                        }
                                        $currentCategory = $row['kategori_kenderaan'];
                                        echo '<optgroup label="' . htmlspecialchars($currentCategory) . '">';
                                    }

                                    // Output the options within the current category
                                    echo '<option value="' . $row['kerja'] . '">' . $row['kerja'] . ' - RM ' . number_format($row['harga_per_jam'], 2) . '/Jam</option>';
                                }
                                echo '</optgroup>'; // Close the last optgroup
                            } else {
                                echo '<option disabled>No available options</option>';
                            }
                            ?>
                        </select>


                    </div>

                    <div id="additionalSelects"></div>

                    <div class="d-flex mt-3 mb-3">
                        <button id="addButton" class="btn btn-primary me-2" style="display:none;" type="button" onclick="addSelect()">+</button>
                        <button id="removeButton" class="btn btn-danger" style="display:none;" type="button" onclick="removeSelect()">-</button>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Hantar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/animation.js"></script>
    <script src="../assets/js/imagesloaded.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        function showButton() {
            var kerja = document.getElementById("kerja").value;
            var addButton = document.getElementById("addButton");
            if (kerja) {
                addButton.style.display = "inline-block";
            } else {
                addButton.style.display = "none";
            }
        }

        function addSelect() {
            var additionalSelects = document.getElementById("additionalSelects");
            var newSelectDiv = document.createElement("div");
            newSelectDiv.className = "mb-3";
            newSelectDiv.style.marginTop = "10px";

            var newSelect = document.createElement("select");
            newSelect.className = "form-control";
            newSelect.name = "kerja[]";
            newSelect.required = true;

            var defaultOption = document.createElement("option");
            defaultOption.disabled = true;
            defaultOption.selected = true;
            defaultOption.value = "";
            defaultOption.textContent = "Sila Pilih Jenis Kerja";

            newSelect.appendChild(defaultOption);

            <?php
            $result->data_seek(0); // Reset the result pointer to the beginning

            $currentCategory = ''; // Variable to track the current category
            while ($row = $result->fetch_assoc()) {
                // Check if the category has changed, if so, create a new optgroup element
                if ($currentCategory != $row['kategori_kenderaan']) {
                    if ($currentCategory != '') {
                        // Close the previous optgroup
                        echo 'newSelect.appendChild(optgroup);';
                    }
                    $currentCategory = $row['kategori_kenderaan'];

                    // Create a new optgroup
                    echo 'var optgroup = document.createElement("optgroup");';
                    echo 'optgroup.label = "' . htmlspecialchars($currentCategory) . '";';
                }

                // Create the option and add it to the current optgroup
                echo 'var option = document.createElement("option");';
                echo 'option.value = "' . $row['kerja'] . '";';
                echo 'option.textContent = "' . $row['kerja'] . ' - RM ' . number_format($row['harga_per_jam'], 2) . '/Jam";';
                echo 'optgroup.appendChild(option);';
            }
            // Append the last optgroup
            if ($currentCategory != '') {
                echo 'newSelect.appendChild(optgroup);';
            }
            ?>


            newSelectDiv.appendChild(newSelect);
            additionalSelects.appendChild(newSelectDiv);

            document.getElementById("removeButton").style.display = "inline-block";
        }

        function removeSelect() {
            var additionalSelects = document.getElementById("additionalSelects");
            if (additionalSelects.lastChild) {
                additionalSelects.removeChild(additionalSelects.lastChild);
            }

            if (additionalSelects.childElementCount === 0) {
                document.getElementById("removeButton").style.display = "none";
            }
        }



        $('.createTempahan').on('submit', function(e) {
            e.preventDefault();

            // Check if form is valid before making AJAX request
            if (!this.checkValidity()) {
                e.stopPropagation();
                return;
            }

            // Serialize form data and make AJAX request
            $.ajax({
                url: 'controller/create_tempahan.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Penambahan Berjaya',
                        }).then(() => {
                            window.location.href = 'sewaan.php';
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



    </script>

</body>

</html>