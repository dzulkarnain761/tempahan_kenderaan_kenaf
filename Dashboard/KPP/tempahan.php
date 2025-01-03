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
                                <h4 class="page-title">Pengesahan Tempahan</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Tempahan ID</th>
                                                    <th>Nama Penyewa</th>
                                                    <th>Tarikh & Masa Tempahan</th>
                                                    
                                                    <th>Tugasan</th>
                                                    <th>Disahkan Oleh</th>
                                                    <th class="non-sortable text-center">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                require_once '../../Models/Quotation.php';
                                                $quotation = new Quotation();
                                                $bookings = $quotation->getByJenisPembayaran('bayaran muka', 'pengesahan kpp');

                                                foreach ($bookings as $booking) { ?>
                                                    <tr>
                                                        <td><?php echo $booking['tempahan_id']; ?></td>
                                                        <td><?php echo $booking['nama']; ?></td>
                                                        <td><?php echo date('d/m/Y, g:i A', strtotime($booking['created_at'])); ?></td>
                                                        
                                                        <td><?php
                                                            require_once '../../Models/Kerja.php';
                                                            $kerja = new Kerja();
                                                            $works = $kerja->findByTempahanId($booking['tempahan_id']);
                                                            $count = 1;

                                                            foreach ($works as $work) {
                                                                echo $count . '. ' . $work['nama_kerja'] . '<br>';
                                                                $count++;
                                                            }
                                                            ?></td>
                                                        <td><?php echo $booking['disahkan_oleh']; ?></td>
                                                        <td class="table-action text-center">
                                                            <a href="../../Controller/pdf/getPDF_quotation_firstpayment.php?quotation_id=<?php echo $booking['quotation_id'] ?>&tempahan_id=<?php echo $booking['tempahan_id']; ?>" target="_blank" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Sebut Harga"> <i class="mdi mdi-eye"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Terima Tempahan" onclick="terimaTempahan(<?php echo $booking['tempahan_id']; ?>)"> <i class="mdi mdi-check"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Tolak Tempahan" onclick="rejectTempahan(<?php echo $booking['tempahan_id']; ?>)"> <i class="mdi mdi-close"></i></a>
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

        <?php include 'partials/right-sidemenu.php'; ?>
    </div>
    <!-- END wrapper -->


    <?php include 'partials/script.php'; ?>

    <script>
        function terimaTempahan(tempahan_id) {
            Swal.fire({
                title: "Terima Tempahan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Terima",
                cancelButtonText: "Tidak"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/terima_tempahan.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `tempahan_id=${tempahan_id}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Berjaya",
                                    text: "Tempahan telah diterima",
                                    icon: "success"
                                }).then(() => {
                                    window.location.href = 'tempahan.php';
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

        function rejectTempahan(tempahan_id) {
            Swal.fire({
                title: "Adakah anda pasti?",
                text: "Tempahan ini akan ditolak",
                icon: "warning",
                input: 'textarea',
                inputLabel: 'Sebab Penolakan',
                inputPlaceholder: 'Sila masukkan sebab penolakan',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Sila masukkan sebab penolakan!'
                    }
                },
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, tolak tempahan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/reject_tempahan.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `tempahan_id=${tempahan_id}&sebab_ditolak=${encodeURIComponent(result.value)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Berjaya",
                                    text: "Tempahan telah ditolak",
                                    icon: "success"
                                }).then(() => {
                                    window.location.href = 'tempahan.php';
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