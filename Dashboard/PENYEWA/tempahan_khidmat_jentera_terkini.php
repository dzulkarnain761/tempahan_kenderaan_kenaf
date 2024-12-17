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

                                <h4 class="page-title">TEMPAHAN KHIDMAT JENTERA - TERKINI</h4>
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
                                                    <th>Tarikh & Masa Tempahan</th>
                                                    <th>Lokasi Tanah</th>
                                                    <th>Luas Tanah</th>
                                                    <th>Tugasan</th>
                                                    <th>Catatan</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="non-sortable text-center">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $penyewa_id = $_SESSION['id'];
                                                require_once '../../Models/Tempahan.php';
                                                $tempahan = new Tempahan();
                                                $bookings = $tempahan->displayKhidmatJenteraTerkiniPenyewa($penyewa_id);

                                                foreach ($bookings as $booking) { ?>
                                                    <tr>

                                                        <td><?php echo date('d/m/Y, g:i A', strtotime($booking['created_at'])); ?></td>
                                                        <td><?php echo $booking['lokasi_tanah'] ?></td>
                                                        <td><?php echo $booking['luas_tanah'] ?></td>
                                                        <td>
                                                            <?php
                                                            require_once '../../Models/Kerja.php';
                                                            $kerja = new Kerja();
                                                            $works = $kerja->findByTempahanId($booking['tempahan_id']);
                                                            $count = 1;

                                                            foreach ($works as $work) {
                                                                // Output the string directly in HTML
                                                            ?>
                                                                <?= $count . '. ' . $work['nama_kerja'] . '<br>' ?>
                                                            <?php
                                                                $count++;
                                                            }
                                                            ?>
                                                        </td>


                                                        <td><?php echo $booking['catatan'] ?? 'Tiada Catatan' ?></td>
                                                        <?php

                                                        switch ($booking['status_bayaran']) {
                                                            case 'dalam pengesahan':
                                                                $badgecolor = 'secondary';
                                                                break;
                                                            case 'belum bayar';
                                                                $badgecolor = 'danger';
                                                                break;
                                                            case 'bayaran diproses';
                                                                $badgecolor = 'primary';
                                                                break;
                                                            case 'selesai bayaran';
                                                                $badgecolor = 'success';
                                                                break;
                                                            case 'selesai';
                                                                $badgecolor = 'success';
                                                                break;
                                                            case 'refund';
                                                                $badgecolor = 'warning';
                                                                break;
                                                            case 'bayaran tambahan';
                                                                $badgecolor = 'danger';
                                                                break;
                                                            default:
                                                                $badgecolor = 'danger';
                                                                break;
                                                        }

                                                        ?>
                                                        <td class="text-center"><?php
                                                                                echo '<span class="badge bg-' . $badgecolor . '">' . strtoupper($booking['status_bayaran']) . '</span>';
                                                                                ?></td>
                                                        <td class="table-action text-center">


                                                            <?php
                                                            $tempahan_id = htmlspecialchars($booking['tempahan_id']); // Sanitize input
                                                            require_once '../../Models/Quotation.php';
                                                            $quotation = new Quotation();
                                                            $bayaran_muka = $quotation->checkQuotationExist($tempahan_id, 'bayaran muka');

                                                            if ($bayaran_muka) { ?>
                                                                <a href="../../Controller/pdf/getPDF_quotation_firstpayment.php?quotation_id=<?php echo urlencode($bayaran_muka['quotation_id']); ?>&tempahan_id=<?php echo urlencode($tempahan_id); ?>" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Lihat Sebut Harga" class="btn btn-secondary" target="_blank">
                                                                    <i class="mdi mdi-file"></i>
                                                                </a>

                                                                <button onclick="bayarMuka(<?php echo $tempahan_id ?>)"
                                                                    class="btn btn-success"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="Bayar">
                                                                    <i class="mdi mdi-check"></i>
                                                                </button>
                                                            <?php }
                                                            ?>

                                                            <a href="butiran_tempahan.php?tempahan_id=<?php echo $booking['tempahan_id']; ?>"
                                                                class="btn btn-primary"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Lihat Butiran Tempahan">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                            <?php

                                                            if ($booking['status_bayaran'] == 'dalam pengesahan' || $booking['status_bayaran'] == 'belum bayar') { ?>
                                                                <button class="btn btn-danger" onclick="batalTempahan(<?php echo $booking['tempahan_id'] ?>)" data-bs-toggle="tooltip" data-bs-placement="top" title="Batal Tempahan"><i class="mdi mdi-delete"></i></button>
                                                            <?php } ?>

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
        function batalTempahan(tempahan_id) {
            Swal.fire({
                title: "Adakah anda pasti?",
                text: "Tempahan ini akan ditolak",
                icon: "warning",
                input: 'textarea',
                inputLabel: 'Sebab Penolakan',
                inputPlaceholder: 'Sila masukkan sebab batal',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Sila masukkan sebab batal!'
                    }
                },
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Batal Tempahan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('controller/cancel_tempahan.php', {
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
                                    window.location.href = 'tempahan_khidmat_jentera_terkini.php';
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

        function bayarMuka(tempahan_id) {
            Swal.fire({
                title: 'Pilih Kaedah Pembayaran',
                html: `
                <input type="radio" class="btn-check" name="options-base" id="option5" autocomplete="off" checked>
<label class="btn" for="option5">Checked</label>

<input type="radio" class="btn-check" name="options-base" id="option6" autocomplete="off">
<label class="btn" for="option6">Radio</label>



<input type="radio" class="btn-check" name="options-base" id="option8" autocomplete="off">
<label class="btn" for="option8">Radio</label>
            `,
                confirmButtonText: 'Teruskan',
                preConfirm: () => {
                    const selectedMethod = document.querySelector('input[name="paymentMethod"]:checked');
                    if (!selectedMethod) {
                        Swal.showValidationMessage('Sila pilih kaedah pembayaran!');
                        return false;
                    }
                    return selectedMethod.value;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const paymentMethod = result.value;
                    if (paymentMethod === 'cash') {
                        Swal.fire(
                            'Bayar Tunai',
                            'Anda telah memilih untuk membayar secara tunai.',
                            'success'
                        );
                        console.log('Cash payment for Tempahan ID:', tempahan_id);
                    } else if (paymentMethod === 'fpx') {
                        Swal.fire(
                            'Bayar FPX',
                            'Anda akan diteruskan ke halaman pembayaran FPX.',
                            'info'
                        );
                        console.log('FPX payment for Tempahan ID:', tempahan_id);
                        window.location.href = `/fpx-payment?tempahan_id=${tempahan_id}`;
                    }
                }
            });
        }
    </script>

</body>

</html>