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
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="tugasan.php">Tugasan</a></li>
                                        <li class="breadcrumb-item active">Tambah Tugasan</li>
                                    </ol>
                                </div>  
                                <h4 class="page-title">Tambah Tugasan</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <form id="addTugasan">
                                        <div class="row mb-3">
                                            <label for="kategori_kenderaan" class="col-3 col-form-label">Kategori Kenderaan</label>
                                            <div class="col-9">
                                                <select class="form-select" name="kategori_kenderaan" id="kategori_kenderaan" required>
                                                    <option value="">Pilih Kategori Kenderaan</option>
                                                    <?php
                                                    require_once '../../Models/Kenderaan.php';
                                                    $kenderaan = new Kenderaan();
                                                    $categories = $kenderaan->getKategoriKenderaan();

                                                    foreach ($categories as $category) {
                                                        echo '<option value="' . $category['kategori'] . '">' . $category['kategori'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nama_kerja" class="col-3 col-form-label">Nama Tugasan</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="nama_kerja" name="nama_kerja" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="harga_per_jam" class="col-3 col-form-label">Harga Per Jam </label>
                                            <div class="col-9">
                                                <input type="number" class="form-control" id="harga_per_jam" name="harga_per_jam" required>
                                            </div>
                                        </div>

                                    
                                        <div class="justify-content-end row">
                                            <div class="col-9">
                                                <button type="submit" onclick="addTugasan()" class="btn btn-info">Tambah Tugasan</button>
                                            </div>
                                        </div>
                                    </form>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->


            <?php include 'partials/footer.php'; ?>

        </div>


    </div>
    <!-- END wrapper -->


    <?php include 'partials/script.php'; ?>

    <script>
        function addTugasan() {
            const form = document.getElementById('addTugasan');

            // Validate required fields
            if (!form.checkValidity()) {
                form.reportValidity(); // This will highlight invalid fields and show default messages
                return; // Stop execution if the form is invalid
            }
            event.preventDefault();
            Swal.fire({
                title: "Tambah Tugasan",
                text: "Adakah anda pasti?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(form);

                    fetch('controller/add/add_tugasan.php', {
                            method: 'POST',
                            body: new URLSearchParams(formData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berjaya',
                                    text: data.message || 'Berjaya Tambah',
                                }).then(() => {
                                    window.location.href = "tugasan.php";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ralat',
                                    text: data.message || 'Ralat tidak diketahui',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ralat',
                                text: 'Ralat memproses respons pelayan',
                            });
                        });
                }
            });
        }
    </script>

</body>

</html>