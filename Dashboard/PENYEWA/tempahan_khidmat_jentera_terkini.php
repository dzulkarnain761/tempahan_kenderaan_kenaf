<?php include 'controller/session.php';

$penyewa_id = $_SESSION['id'];
require_once '../../Models/Tempahan.php';
require_once '../../Models/Kerja.php';
require_once '../../Models/Quotation.php';
require_once '../../Models/Resit.php';
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
                                            <?php
                                            $tempahan = new Tempahan();
                                            $bookings = $tempahan->displayKhidmatJenteraTerkiniPenyewa($penyewa_id);
                                            ?>
                                            <tbody>
                                                <?php foreach ($bookings as $booking): ?>
                                                    <tr>
                                                        <td><?php echo date('d/m/Y, g:i A', strtotime($booking['created_at'])); ?></td>
                                                        <td><?php echo htmlspecialchars($booking['lokasi_tanah']); ?></td>
                                                        <td><?php echo htmlspecialchars($booking['luas_tanah']); ?></td>
                                                        <td>
                                                            <?php
                                                            $kerja = new Kerja();
                                                            $works = $kerja->findByTempahanId($booking['tempahan_id']);
                                                            foreach ($works as $index => $work) {
                                                                echo htmlspecialchars(($index + 1) . '. ' . $work['nama_kerja']) . '<br>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($booking['catatan'] ?? 'Tiada Catatan'); ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            $badgeColors = [
                                                                'dalam pengesahan' => 'secondary',
                                                                'belum bayar' => 'danger',
                                                                'bayaran diproses' => 'primary',
                                                                'selesai bayaran' => 'success',
                                                                'selesai' => 'success',
                                                                'refund' => 'warning',
                                                                'bayaran tambahan' => 'danger'
                                                            ];
                                                            $badgeColor = $badgeColors[$booking['status_bayaran']] ?? 'danger';
                                                            echo '<span class="badge bg-' . $badgeColor . '">' . strtoupper(htmlspecialchars($booking['status_bayaran'])) . '</span>';
                                                            ?>
                                                        </td>
                                                        <td class="table-action text-center">
                                                            <?php
                                                            $tempahan_id = htmlspecialchars($booking['tempahan_id']);
                                                            $quotation = new Quotation();

                                                            $quotation_bayaran_muka = $quotation->checkQuotationExist($tempahan_id, 'bayaran muka');
                                                            $quotation_bayaran_tambahan = $quotation->checkQuotationExist($tempahan_id, 'bayaran tambahan');

                                                            $resit = new Resit();
                                                            $resit_bayaran_muka = $resit->checkResitExist($tempahan_id, 'bayaran muka');

                                                            if ($booking['status_bayaran'] === 'belum bayar' && $quotation_bayaran_muka): ?>
                                                                <a href="../../Controller/pdf/getPDF_quotation_firstpayment.php?quotation_id=<?php echo urlencode($quotation_bayaran_muka['quotation_id']); ?>&tempahan_id=<?php echo urlencode($tempahan_id); ?>"
                                                                    class="btn btn-secondary" target="_blank" data-bs-toggle="tooltip" title="Lihat Sebut Harga">
                                                                    <i class="mdi mdi-file"></i>
                                                                </a>
                                                                <button onclick="payment('<?php echo htmlspecialchars($quotation_bayaran_muka['quotation_id']); ?>')"
                                                                    class="btn btn-success" data-bs-toggle="tooltip" title="Bayar">
                                                                    <i class="mdi mdi-check"></i>
                                                                </button>
                                                            <?php endif; ?>

                                                            <?php if ($booking['status_bayaran'] === 'bayaran tambahan' && $quotation_bayaran_tambahan): ?>
                                                                <a href="../../Controller/pdf/getPDF_quotation_extrapayment.php?quotation_id=<?php echo urlencode($quotation_bayaran_tambahan['quotation_id']); ?>&tempahan_id=<?php echo urlencode($tempahan_id); ?>"
                                                                    class="btn btn-secondary" target="_blank" data-bs-toggle="tooltip" title="Lihat Sebut Harga Tambahan">
                                                                    <i class="mdi mdi-file"></i>
                                                                </a>
                                                                <button onclick="payment('<?php echo htmlspecialchars($quotation_bayaran_tambahan['quotation_id']); ?>')"
                                                                    class="btn btn-success" data-bs-toggle="tooltip" title="Bayar Tambahan">
                                                                    <i class="mdi mdi-check"></i>
                                                                </button>
                                                            <?php endif; ?>

                                                            <?php if ($booking['status_bayaran'] === 'selesai bayaran' && $resit_bayaran_muka): ?>
                                                                <a href="../../Controller/pdf/getPDF_resit.php?resit_id=<?php echo urlencode($resit_bayaran_muka['resit_id']); ?>"
                                                                    class="btn btn-secondary" target="_blank" data-bs-toggle="tooltip" title="Lihat Resit Bayaran">
                                                                    <i class="mdi mdi-file"></i>
                                                                </a>
                                                            <?php endif; ?>

                                                            <a href="butiran_tempahan.php?tempahan_id=<?php echo $tempahan_id; ?>"
                                                                class="btn btn-primary" data-bs-toggle="tooltip" title="Lihat Butiran Tempahan">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>

                                                            <?php if (in_array($booking['status_bayaran'], ['dalam pengesahan', 'belum bayar'])): ?>
                                                                <button onclick="batalTempahan('<?php echo $tempahan_id; ?>')"
                                                                    class="btn btn-danger" data-bs-toggle="tooltip" title="Batal Tempahan">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
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

        function payment(quotation_id) {
            Swal.fire({
                title: 'Pilih Kaedah Pembayaran',
                html: `
            <select id="payment_method" class="form-select">
                <option value="" disabled selected>Sila Pilih Kaedah Pembayaran</option>
                <option value="tunai">TUNAI</option>
                <option value="fpx">FPX</option>
            </select>
        `,
                confirmButtonText: 'Teruskan',
                preConfirm: () => {
                    const selectedMethod = document.getElementById('payment_method').value;
                    if (!selectedMethod) {
                        Swal.showValidationMessage('Sila pilih kaedah pembayaran!');
                        return false;
                    }
                    return selectedMethod;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const paymentMethod = result.value;

                    // Send payment request to the server
                    fetch('controller/payment.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `quotation_id=${quotation_id}&payment_method=${paymentMethod}`
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Berjaya!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Ralat!',
                                    text: data.message,
                                    icon: 'error',
                                    confirmButtonText: 'Cuba Lagi'
                                });
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            Swal.fire('Ralat!', 'Terdapat masalah dengan pembayaran.', 'error');
                        });
                }
            });
        }
    </script>

</body>

</html>