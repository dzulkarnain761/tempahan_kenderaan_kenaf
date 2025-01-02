<?php
include 'controller/session.php';
require_once '../../Models/Kenderaan.php';

?>
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

                                <h4 class="page-title">Kategori Kenderaan</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $kenderaan = new Kenderaan();
                                    $kategori_kenderaan = $kenderaan->getKategoriKenderaan();

                                    foreach ($kategori_kenderaan as $kategori) { ?>

                                        <div class="input-group mb-3" style="max-width: 450px;">
                                            <input type="text" class="form-control " value="<?php echo $kategori['kategori']; ?>" readonly>
                                            <button type="button" class="btn btn-danger" onclick="deleteRow(<?php echo $kategori['id']; ?>)">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    <?php }  ?>

                                    <button class="btn btn-primary" onclick="addRow()">Tambah Kategori</button>

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
        function deleteRow(id) {
            Swal.fire({
                title: "Padam Kategori",
                text: "Adakah anda pasti?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/delete/delete_kategori_kenderaan.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `kategori_id=${id}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berjaya',
                                    text: data.success || 'Berjaya Padam',
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ralat',
                                    text: data.error || 'Ralat tidak diketahui',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error); // Debugging
                            Swal.fire({
                                icon: 'error',
                                title: 'Ralat',
                                text: 'Ralat memproses respons pelayan',
                            });
                        });
                }
            });
        }

        function addRow() {
            Swal.fire({
                
                icon: "warning",
                input: 'text',
                inputLabel: 'Nama Kategori',
                inputPlaceholder: 'Sila masukkan nama kategori',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Sila masukkan nama kategori!'
                    }
                },
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Tambah",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/add/add_kategori_kenderaan.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `kategori=${encodeURIComponent(result.value)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Berjaya",
                                    text: "Kategori Ditambah",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal",
                                    text: data.message || "Ralat tidak diketahui",
                                    icon: "error"
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: "Ralat",
                                text: "Ralat memproses respons pelayan",
                                icon: "error"
                            });
                        });
                }
            });
        }
    </script>

</body>

</html>