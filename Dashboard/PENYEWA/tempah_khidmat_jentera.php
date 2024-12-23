<?php include 'controller/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
	
<style>
button {
    background-color: #00FF7F;
    color: white;
    padding: 10px 20px;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #00C970;
}	
	
</style>

<?php include 'partials/head.php'; ?>

<body style="background-image: url(../../assets/images/logo/auth-bg1.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;" class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
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

                                <h4 style="color: white"; class="page-title">BORANG TEMPAHAN PERKHIDMATAN JENTERA</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <form id="tempahKhidmatJentera" action="controller/create_servis_jentera.php" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="card custom-card">
									<div class="card-body custom-card-body">
										<font color="red">Perhatian : Sila isikan maklumat bertanda <strong>*</strong></font>
										<div class="mb-3">
											<label for="lokasi_tanah" class="form-label black-text">LOKASI TANAH <font color="red"><strong>*</strong></font></label>
											<input type="text" placeholder="Masukkan lokasi tanah..." id="lokasi_tanah" name="lokasi_tanah" class="form-control" required>
										</div>
										<div class="mb-3">
											<label for="luas_tanah" class="form-label black-text">KELUASAN TANAH (HEKTAR) <font color="red"><strong>*</strong></font></label>
											<input type="number" placeholder="Masukkan keluasan tanah..." id="luas_tanah" name="luas_tanah" class="form-control" required>
										</div>
										<div class="mb-3">
											<label for="catatan" class="form-label black-text">CATATAN</label>
											<textarea id="catatan" placeholder="Masukkan catatan..." name="catatan" class="form-control"></textarea>
										</div>
										<div class="mb-3">
											<label for="bilangan_tugasan" class="form-label black-text">BILANGAN TUGASAN <font color="red"><strong>*</strong></font></label>
											<select id="bilangan_tugasan" name="" class="form-select">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
										</div>
									</div> <!-- end card-body-->
								</div> <!-- end card-->

							<style>
							.custom-card {
								background-color: rgba(255, 255, 255, 0.8); /* Warna putih with transparency */
								border: 1px solid #ddd; 
								border-radius: 8px; 
								box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow  */
							}

							.custom-card-body {
								background-color: transparent; /* Bahagian dalam card transparent */
							}
								
								.black-text {
									color: #172c6b; 
								}
								
								 thead td {
									color: #172c6b;
									font-weight: bold; 
								}
							</style>

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                               <div class="card custom-card">
									<div class="card-body custom-card-body">

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

                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Nama Tugasan <font color="red"><strong>*</strong></font></td>
                                                    <td>Cadangan Tarikh <font color="red"><strong>*</strong></font></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>



                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <input type="hidden" name="penyewa_id" value="<?php echo $penyewa_id; ?>">
                        <div class="text-end mb-2">
                            <button class="gradient-button">HANTAR TEMPAHAN</button>
                        </div>

<style>
.gradient-button {
    background: linear-gradient(45deg, #98FB91, #08B118); /* Gradient */
    border: none;
    color: #000;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px; 
    transition: background 0.3s ease;
}

.gradient-button:hover {
    background: linear-gradient(45deg, #08B118, #98FB91); /*  bila hover */
}
</style>
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

            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Success - Show a success message and redirect
                        Swal.fire({
                            icon: 'success',
                            title: 'Berjaya',
                            text: data.message,
                        }).then(() => {
                            window.location.href = "tempahan_khidmat_jentera_terkini.php";
                        });
                    } else {
                        // Failure - Show an error message
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
                });
        });
    </script>


</body>

</html>