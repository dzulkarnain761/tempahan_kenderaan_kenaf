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
                                <h4 class="page-title">Tempahan</h4>
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
                                                    <th>Nama Penyewa</th>
                                                    <th>Tarikh & Masa Tempahan</th>
                                                    <th>Tarikh Kerja Dipilih</th>
                                                    <th>Status</th>
                                                    <th class="non-sortable">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                require_once '../../Models/Tempahan.php';
                                                $tempahan = new Tempahan();
                                                $bookings = $tempahan->getAllWithStatusTempahan('pengesahan kpp');

                                                foreach ($bookings as $booking) { ?>
                                                    <tr>
                                                        <td><?php
                                                            require_once '../../Models/Penyewa.php';
                                                            $penyewa = new User();
                                                            $user = $penyewa->findById($booking['penyewa_id']);
                                                            echo $user['nama'];
                                                            ?></td>
                                                        <td><?php echo $booking['created_at']; ?></td>
                                                        <td><?php echo $booking['tarikh_kerja']; ?></td>
                                                        <td><?php echo $booking['status_tempahan']; ?></td>
                                                        <td class="table-action">
                                                            <a href="../../Controller/pdf/getPDF_quotation_fullpayment.php?tempahan_id=<?php echo $booking['tempahan_id']; ?>" target="_blank" class="action-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Sebut Harga"> <i class="mdi mdi-eye"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Terima Tempahan" onclick="terimaTempahan(<?php echo $booking['tempahan_id']; ?>)"> <i class="mdi mdi-check"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Tolak Tempahan" onclick="rejectTempahan(<?php echo $booking['tempahan_id']; ?>)"> <i class="mdi mdi-close"></i></a>
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
        function terimaTempahan(id) {
            Swal.fire({
                title: "Adakah anda pasti?",
                text: "Tempahan ini akan diterima",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6", 
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, terima tempahan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/terima_tempahan.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `tempahan_id=${id}`
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

        function rejectTempahan(id) {
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
                            body: `tempahan_id=${id}&sebab_ditolak=${encodeURIComponent(result.value)}`
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