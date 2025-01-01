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

                                <h4 class="page-title">TEMPAHAN SERVIS JENTERA</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <form id="tempahKhidmatJentera" action="controller/create_servis_jentera.php" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                        <div class="mb-3">
                                            <label for="lokasi_tanah" class="form-label">LOKASI TANAH</label>
                                            <input type="text" id="lokasi_tanah" name="lokasi_tanah" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="luas_tanah" class="form-label">KELUASAN TANAH (HEKTAR)</label>
                                            <input type="text" id="luas_tanah" name="luas_tanah" class="form-control" pattern="^\d*(\.\d{0,2})?$" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="catatan" class="form-label">CATATAN</label>
                                            <textarea id="catatan" name="catatan" class="form-control"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">BILANGAN TUGASAN</label>
                                            <select id="bilangan_tugasan" name="" id="" class="form-select">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>


                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <?php

                                        $penyewa_id = $_SESSION['id'];

                                        require_once '../../Models/Tugasan.php';
                                        $tugasan = new Tugasan();
                                        $tasks = $tugasan->all();

                                        $kerja[] = null;
                                        $harga_per_jam[] = null;
                                        $kategori_kenderaan[] = null;

                                        foreach ($tasks as $task) {
                                            // Assuming $task is an associative array or an object
                                            $kerja = $task['kerja'] ?? $task->kerja ?? null;
                                            $harga_per_jam = $task['harga_per_jam'] ?? $task->harga_per_jam ?? null;
                                            $kategori_kenderaan = $task['kategori_kenderaan'] ?? $task->kategori_kenderaan ?? null;
                                        }
                                        ?>

                                        <div style="overflow-y: auto;">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Nama Tugasan</td>
                                                        <td>Tarikh</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <input type="hidden" name="penyewa_id" value="<?php echo $penyewa_id; ?>">
                        <div class="text-end mb-2">
                            <button type="submit" class="btn btn-primary" id="submitButton">
                                <span class="spinner-border spinner-border-sm d-none" id="loadingSpinner" role="status" aria-hidden="true"></span>
                                <span id="buttonText">Tempah Sekarang</span>
                            </button>

                        </div>

                    </form>

                </div> <!-- container -->

            </div> <!-- content -->


            <?php include 'partials/footer.php'; ?>

        </div>


    </div>
    <!-- END wrapper -->


    <?php include 'partials/script.php'; ?>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var bilanganTugasanInput = document.getElementById('bilangan_tugasan');
            var tableBody = document.querySelector('table tbody');

            // Set default value of bilangan_tugasan to 1
            bilanganTugasanInput.value = 1;

            // Function to generate rows based on the number of tasks
            function generateRows(bilanganTugasan) {
                // Clear any existing rows in the table body
                tableBody.innerHTML = '';

                // Loop to create rows dynamically based on the input value
                for (var i = 0; i < bilanganTugasan; i++) {
                    var row = document.createElement('tr'); // Create a new table row

                    // Create the first cell for the counter
                    var counterCell = document.createElement('td');
                    counterCell.textContent = i + 1; // Set the counter value
                    row.appendChild(counterCell);

                    // Create the second cell for the "Nama Tugasan" dropdown
                    var cell1 = document.createElement('td');
                    var select = document.createElement('select');
                    select.className = 'form-select';
                    select.name = 'tugasan[]';
                    select.required = true; // Make the select input required
                    select.style = 'min-width: 150px';


                    // Add a default "Sila Pilih Tugasan" option
                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Sila Pilih Tugasan';
                    select.appendChild(defaultOption);

                    // Dynamically populate optgroups with PHP data
                    <?php
                    $groupedTasks = [];
                    foreach ($tasks as $task) {
                        $kategori = $task['kategori_kenderaan'] ?? $task->kategori_kenderaan;
                        $kerja = $task['kerja'] ?? $task->kerja;
                        $harga = $task['harga_per_jam'] ?? $task->harga_per_jam;
                        if (!isset($groupedTasks[$kategori])) {
                            $groupedTasks[$kategori] = [];
                        }
                        // Check for duplicates
                        $isDuplicate = false;
                        foreach ($groupedTasks[$kategori] as $existingTask) {
                            if ($existingTask['label'] === "$kerja - $harga/Jam") {
                                $isDuplicate = true;
                                break;
                            }
                        }
                        if (!$isDuplicate) {
                            $groupedTasks[$kategori][] = ['kerja' => $kerja, 'label' => "$kerja - $harga/Jam"];
                        }
                    }
                    ?>

                    <?php foreach ($groupedTasks as $kategori => $tasks): ?>
                        var existingOptGroup = Array.from(select.children).find(
                            (optGroup) => optGroup.label === '<?php echo $kategori; ?>'
                        );

                        var optGroup;
                        if (!existingOptGroup) {
                            optGroup = document.createElement('optgroup');
                            optGroup.label = '<?php echo $kategori; ?>'; // Set category as optgroup label
                        } else {
                            optGroup = existingOptGroup; // Reuse existing optGroup if found
                        }

                        <?php foreach ($tasks as $task): ?>
                            var option = document.createElement('option');
                            option.value = '<?php echo $task["kerja"] ?>'; // Use task kerja as the value
                            option.textContent = '<?php echo $task["label"] ?>'; // Use task label as the display text
                            optGroup.appendChild(option);
                        <?php endforeach; ?>

                        if (!existingOptGroup) {
                            select.appendChild(optGroup); // Add optgroup to the dropdown only if it's new
                        }
                    <?php endforeach; ?>

                    cell1.appendChild(select); // Add the dropdown to the second cell

                    // Create the third cell for "Tarikh"
                    var cell2 = document.createElement('td');
                    var dateInput = document.createElement('input');
                    dateInput.type = 'date';
                    dateInput.className = 'form-control';
                    dateInput.name = 'cadangan_tarikh_kerja[]';
                    dateInput.required = true; // Make the date input required

                    // Prevent selecting previous dates
                    var today = new Date().toISOString().split('T')[0];
                    dateInput.min = today; // Set the minimum date to today

                    cell2.appendChild(dateInput); // Add the date input to the third cell

                    // Append cells to the row
                    row.appendChild(cell1);
                    row.appendChild(cell2);

                    // Append the row to the table body
                    tableBody.appendChild(row);
                }
            }

            // Generate default row on page load
            generateRows(1);

            // Regenerate rows based on input value
            bilanganTugasanInput.addEventListener('input', function() {
                var bilanganTugasan = parseInt(this.value, 10);
                var maxTasks = 5; // Set a reasonable limit for the number of tasks

                if (bilanganTugasan > maxTasks) {
                    alert('The maximum allowed tasks is ' + maxTasks + '.');
                    return; // Exit if the input exceeds the limit
                }

                generateRows(bilanganTugasan);
            });
        });



        document.getElementById('tempahKhidmatJentera').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            const submitButton = document.getElementById('submitButton');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const buttonText = document.getElementById('buttonText');

            // Show loading animation
            submitButton.setAttribute('disabled', 'true');
            loadingSpinner.classList.remove('d-none');
            buttonText.textContent = 'Memproses...';

            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berjaya',
                            text: data.message,
                        }).then(() => {
                            window.location.href = "tempahan_khidmat_jentera_terkini.php";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ralat',
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Kesalahan berlaku semasa menghantar borang. Sila cuba lagi.',
                    });
                })
                .finally(() => {
                    // Hide loading animation and enable button
                    submitButton.removeAttribute('disabled');
                    loadingSpinner.classList.add('d-none');
                    buttonText.textContent = 'Tempah Sekarang';
                });
        });
    </script>


</body>

</html>