<?php
require_once '../../Models/Quotation.php';
require_once '../../Models/Database.php';

$conn = Database::getConnection();
// Assign variables from the $_REQUEST superglobal
// $rsp_appln_id = $_REQUEST['rsp_appln_id'] ?? 'EL';
// $rsp_org_id = $_REQUEST['rsp_org_id'] ?? 'LKTN';
// $rsp_orderid = $_REQUEST['rsp_orderid'] ?? 'JKJBP00115';
// $rsp_amount = $_REQUEST['rsp_amount'] ?? 50.00;
// $rsp_trxstatus = $_REQUEST['rsp_trxstatus'] ?? 'UNSUCCESSFUL';
// $rsp_stcode = $_REQUEST['rsp_stcode'] ?? '1F';
// $rsp_bankid = $_REQUEST['rsp_bankid'] ?? 'BCBB0235';
// $rsp_bankname = $_REQUEST['rsp_bankname'] ?? 'CIMB BANK';
// $rsp_fpxid = $_REQUEST['rsp_fpxid'] ?? '2412311008140451';
// $rsp_mode = $_REQUEST['rsp_mode'] ?? 'FPXB2C';
// $rsp_fpxorderno = $_REQUEST['rsp_fpxorderno'] ?? 'Z1241231015971';

$rsp_appln_id = $_REQUEST['rsp_appln_id'] ?? 'FAILED';
$rsp_org_id = $_REQUEST['rsp_org_id'] ?? 'FAILED';
$rsp_orderid = $_REQUEST['rsp_orderid'] ?? 'FAILED';
$rsp_amount = $_REQUEST['rsp_amount'] ?? 0.00;
$rsp_trxstatus = $_REQUEST['rsp_trxstatus'] ?? 'FAILED';
$rsp_stcode = $_REQUEST['rsp_stcode'] ?? 'FAILED';
$rsp_bankid = $_REQUEST['rsp_bankid'] ?? 'FAILED';
$rsp_bankname = $_REQUEST['rsp_bankname'] ?? 'FAILED';
$rsp_fpxid = $_REQUEST['rsp_fpxid'] ?? 'FAILED';
$rsp_mode = $_REQUEST['rsp_mode'] ?? 'FAILED';
$rsp_fpxorderno = $_REQUEST['rsp_fpxorderno'] ?? 'FAILED';

// Determine the status icon and style
$status_icon = $rsp_stcode === '00'
    ? '<i class="mdi mdi-check text-success fs-4"></i>'
    : '<i class="mdi mdi-close-circle text-danger fs-4"></i>';

if ($rsp_stcode === '00') {
    // Start transaction
    $conn->begin_transaction();

    try {
        $quotation = new Quotation();
        $quotations = $quotation->getDetailAfterPayment($rsp_orderid);

        if (!$quotations) {
            throw new Exception("Quotation not found.");
        }

        $jenis_pembayaran = $quotations['jenis_pembayaran'];
        $tempahan_id = $quotations['tempahan_id'];
        $quotation_id = $quotations['quotation_id']; // Add this line to get the quotation_id

        if ($jenis_pembayaran === 'bayaran muka') {
            $status_tempahan = 'pengesahan jobsheet';
            $status_bayaran = 'selesai bayaran';
        } else if ($jenis_pembayaran === 'bayaran tambahan') {
            $status_tempahan = 'selesai';
            $status_bayaran = 'selesai';
        }

        $status_quotation = 'selesai';

        // Prepare statements
        $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $sqlUpdateTempahan->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);

        $sqlUpdateQuotation = $conn->prepare("UPDATE quotation SET status = ? WHERE quotation_id = ?");
        $sqlUpdateQuotation->bind_param("si", $status_quotation, $quotation_id); // Corrected binding

        $cara_bayar = 'fpx';
        $sqlCreateReceipt = $conn->prepare("INSERT INTO resit_pembayaran (tempahan_id, jenis_pembayaran, jumlah, cara_bayar, nombor_rujukan) VALUES (?, ?, ?, ?, ?)");
        $sqlCreateReceipt->bind_param("ssdss", $tempahan_id, $jenis_pembayaran, $rsp_amount, $cara_bayar, $rsp_orderid); // Corrected binding

        $type = 0;
        $sqlInsertPaymentDetail = $conn->prepare("INSERT INTO payment 
            (rsp_appln_id, rsp_org_id, rsp_orderid, rsp_amount, rsp_trxstatus, rsp_stcode, rsp_bankid, rsp_bankname, rsp_fpxid, rsp_fpxorderno)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sqlInsertPaymentDetail->bind_param("sssdssssss", $rsp_appln_id, $rsp_org_id, $rsp_orderid, $rsp_amount, $rsp_trxstatus, $rsp_stcode, $rsp_bankid, $rsp_bankname, $rsp_fpxid, $rsp_fpxorderno);

        // Handle manual payment
        if (!$sqlUpdateQuotation->execute()) {
            throw new Exception("Kemaskini quotation gagal: " . $sqlUpdateQuotation->error);
        }
        $sqlUpdateQuotation->close();

        if (!$sqlUpdateTempahan->execute()) {
            throw new Exception("Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error);
        }
        $sqlUpdateTempahan->close();

        if (!$sqlCreateReceipt->execute()) {
            throw new Exception("Kemaskini resit pembayaran gagal: " . $sqlCreateReceipt->error);
        }
        $sqlCreateReceipt->close();

        if (!$sqlInsertPaymentDetail->execute()) {
            throw new Exception("Kemaskini payment detail gagal: " . $sqlInsertPaymentDetail->error);
        }
        $sqlInsertPaymentDetail->close();

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        // Log the error (could log to a file or error logging system)
        error_log($e->getMessage());
    } finally {
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>eTEMPAHAN JENTERA</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">
    <link href="../../assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="../../assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Payment Receipt</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transaction Details</h5>
                        <table class="table table-bordered mt-3">
                            <tbody>
                                <tr>
                                    <th>Application ID</th>
                                    <td><?= htmlspecialchars($rsp_appln_id) ?></td>
                                </tr>
                                <tr>
                                    <th>Organization ID</th>
                                    <td><?= htmlspecialchars($rsp_org_id) ?></td>
                                </tr>
                                <tr>
                                    <th>Order ID</th>
                                    <td><?= htmlspecialchars($rsp_orderid) ?></td>
                                </tr>
                                <tr>
                                    <th>Amount (RM)</th>
                                    <td><?= htmlspecialchars($rsp_amount) ?></td>
                                </tr>
                                <tr>
                                    <th>Transaction Status</th>
                                    <td><?= htmlspecialchars($rsp_trxstatus) ?> <?= $status_icon ?></td>
                                </tr>

                                <tr>
                                    <th>Bank Name</th>
                                    <td><?= htmlspecialchars($rsp_bankname) ?></td>
                                </tr>
                                <tr>
                                    <th>FPX ID</th>
                                    <td><?= htmlspecialchars($rsp_fpxid) ?></td>
                                </tr>
                                <tr>
                                    <th>Payment Mode</th>
                                    <td><?= htmlspecialchars($rsp_mode) ?></td>
                                </tr>
                                <tr>
                                    <th>FPX Order No</th>
                                    <td><?= htmlspecialchars($rsp_fpxorderno) ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center mt-4">
                            <a href="tempahan_khidmat_jentera_terkini.php" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
