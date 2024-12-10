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
                                <!-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Tempahan</li>
                                        </ol>
                                    </div> -->
                                <h4 class="page-title">Kenderaan</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <a href="kenderaan_add.php" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Tambah Kenderaan</a>
                                        </div>
                                        
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No Aset</th>
                                                    <th>No Pendaftaran</th>
                                                    <th>Kategori Kenderaan</th>
                                                    <th>Tahun Daftar</th>
                                                    <th>Catatan</th>
                                                    <th class="non-sortable text-center">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                require_once '../../Models/Kenderaan.php';
                                                $kenderaan = new Kenderaan();
                                                $vehicles = $kenderaan->getAllKenderaan();

                                                foreach ($vehicles as $vehicle) { ?>
                                                    <tr>
                                                        <td><?php echo $vehicle['no_aset']; ?></td>
                                                        <td><?php echo $vehicle['no_pendaftaran']; ?></td>
                                                        <td><?php echo $vehicle['kategori_kenderaan']; ?></td>
                                                        <td><?php echo $vehicle['tahun_daftar']; ?></td>
                                                        <td><?php echo $vehicle['catatan']; ?></td>
                                                        
                                                        <td class="table-action text-center">
                                                        <a href="kenderaan_edit.php?kenderaan_id=<?php echo $vehicle['id'] ?>" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                        <button type="button" class="btn btn-danger" onclick="deleteRow(<?php echo $vehicle['id'] ?>)" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"> <i class="mdi mdi-delete"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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
                title: "Padam Kenderaan",
                text: "Adakah anda pasti?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/delete/delete_kenderaan.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `kenderaan_id=${id}`
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
    </script>

</body>

</html>