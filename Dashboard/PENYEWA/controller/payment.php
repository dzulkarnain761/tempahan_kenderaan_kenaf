<?php

require_once '../../../PHPMailer/src/PHPMailer.php';
require_once '../../../PHPMailer/src/SMTP.php';
require_once '../../../PHPMailer/src/Exception.php';
require_once '../../../send_email.php';

require_once '../../../Models/Database.php';
require_once '../../../Models/Tempahan.php';
require_once '../../../Models/Quotation.php';
require_once '../../../Models/Admin.php';
$conn = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Safely handle input
    $quotation_id = intval($_POST['quotation_id']);
    $cara_bayar = $_POST['payment_method'];

    // Start transaction
    $conn->begin_transaction();

    try {

        $quotation = new Quotation();
        $quotations = $quotation->getDetail($quotation_id);

        $total_bayaran = $quotations['total'];
        $reference_number = $quotations['reference_number'];
        $jenis_pembayaran = $quotations['jenis_pembayaran'];
        $tempahan_id = $quotations['tempahan_id'];

        $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $sqlUpdateTempahan->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);

        $sqlUpdateQuotation = $conn->prepare("UPDATE quotation SET status = ? WHERE quotation_id = ?");
        $sqlUpdateQuotation->bind_param("si", $status_quotation, $quotation_id);

        if ($cara_bayar == 'fpx') {

            // Prepare the FPX payment insertion query
            // $sqlFPX = $conn->prepare("INSERT INTO `payment`
            //     (`rsp_appln_id`, `rsp_org_id`, `rsp_orderid`, `rsp_amount`, `rsp_trxstatus`, `rsp_stcode`, `rsp_bankid`, `rsp_bankname`, `rsp_fpxid`, `rsp_fpxorderno`, `type`)
            //     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Bind the actual parameters
            $rsp_appln_id = 'ETJ'; // Example application ID
            // $rsp_org_id = 'LKTN'; // Example organization ID
            $rsp_orderid = 'Z' . $reference_number; // Example order ID
            $rsp_amount = intval($total_bayaran); // Amount from quotation
            $return_url = 'https://apps.lktn.gov.my/ejentera/Dashboard/PENYEWA/tempahan_khidmat_jentera.php';

            $rsp_trxstatus = 'SUCCESSFUL'; // Example transaction status
            $rsp_stcode = '00'; // Example status code (success)
            $rsp_bankid = 'MB2U0227'; // Maybank bank ID
            $rsp_bankname = 'Maybank'; // Bank name
            $rsp_fpxid = 'FPX123456'; // Example FPX ID
            $rsp_fpxorderno = 'FPXORD987654'; // Example FPX order number
            $type = 01; // Example type


                echo '<form id="paymentForm" action="https://e-payment_lktn.gov.my/v4/req2pay_tempahan.php" method="POST">
                <input type="hidden" name="req_appid" value="' . $rsp_appln_id . '">
                <input type="hidden" name="req_orderid" value="' . $rsp_orderid . '">
                <input type="hidden" name="req_amount" value="' . $rsp_amount . '">
                <input type="hidden" name="req_rt_url" value="' . $return_url . '">
            </form>';

            // Optionally, auto-submit the form
            echo '<script>document.getElementById("paymentForm").submit();</script>';

            // $sqlFPX->bind_param(
            //     "sssdsissssi",
            //     $rsp_appln_id,
            //     $rsp_org_id,
            //     $rsp_orderid,
            //     $rsp_amount,
            //     $rsp_trxstatus,
            //     $rsp_stcode,
            //     $rsp_bankid,
            //     $rsp_bankname,
            //     $rsp_fpxid,
            //     $rsp_fpxorderno,
            //     $type
            // );

            // Execute the query
            // if (!$sqlFPX->execute()) {
            //     throw new Exception("Kemaskini pembayaran gagal: " . $sqlFPX->error);
            // }

            // $sqlFPX->close();

            // Proceed with receipt and tempahan updates if FPX is successful
            // $fpx_kod_respon = '00'; // Mock response (replace with actual FPX response logic)
            // if ($fpx_kod_respon == '00') {

            //     $status_quotation = 'selesai';

            //     $sqlResit = $conn->prepare("INSERT INTO resit_pembayaran 
            //         (tempahan_id, jenis_pembayaran, jumlah, cara_bayar, nombor_rujukan) 
            //         VALUES (?, ?, ?, ?, ?)");
            //     $sqlResit->bind_param("isdss", $tempahan_id, $jenis_pembayaran, $total_bayaran, $cara_bayar, 'Z0000001');

            //     if ($jenis_pembayaran == 'bayaran muka') {
            //         $status_tempahan = 'pengesahan jobsheet';
            //         $status_bayaran = 'selesai bayaran';
            //     } else if ($jenis_pembayaran == 'bayaran tambahan') {
            //         $status_tempahan = 'selesai';
            //         $status_bayaran = 'selesai';
            //     }


            //     if (!$sqlUpdateQuotation->execute()) {
            //         throw new Exception("Kemaskini quotation gagal: " . $sqlUpdateQuotation->error);
            //     }
            //     $sqlUpdateQuotation->close();

            //     if (!$sqlUpdateTempahan->execute()) {
            //         throw new Exception("Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error);
            //     }
            //     $sqlUpdateTempahan->close();

            //     if (!$sqlResit->execute()) {
            //         throw new Exception("Resit pembayaran gagal: " . $sqlResit->error);
            //     }
            //     $sqlResit->close();


            //     // send emai to PEE
            //     $kumpulan = 'D';
            //     $adminModel = new Admin();
            //     $admins = $adminModel->getAdminbyKumpulan($kumpulan);

            //     $recipients = array_filter(array_map(function ($admin) {
            //         return $admin['email'] ?? '';
            //     }, $admins)); // Filter out empty emails

            //     $subject = 'LKTN eTempahan Jentera';
            //     $body = "<h2>eTempahan Jentera</h2>
            //                 <p>1 Tempahan Baru</p>
            //                 <p>Sila log masuk ke <a href='https://apps.lktn.gov.my/ejentera/Dashboard/PEE/jobsheet.php'>eJentera</a> untuk melihat tempahan baru.</p>";
            //     $fromEmail = 'dzulkarnain761@gmail.com';

            //     $result = sendEmail($subject, $body, $recipients, $fromEmail);

            //     if ($result !== true) {
            //         throw new Exception("Failed to send email: " . $result);
            //     }
            // }
        } else {

            //send email to PT
            $kumpulan = 'F';
            $adminModel = new Admin();
            $admins = $adminModel->getAdminbyKumpulan($kumpulan);

            $recipients = array_filter(array_map(function ($admin) {
                return $admin['email'] ?? '';
            }, $admins)); // Filter out empty emails

            $subject = 'LKTN eTempahan Jentera';
            $body = "<h2>eTempahan Jentera</h2>
                            <p>1 Bayaran Diterima</p>
                            <p>Sila log masuk ke <a href='https://apps.lktn.gov.my/ejentera/Dashbord/PT/terima_tunai.php'>eJentera</a> untuk melihat tempahan baru.</p>";
            $fromEmail = 'dzulkarnain761@gmail.com';

            $result = sendEmail($subject, $body, $recipients, $fromEmail);

            if ($result !== true) {
                throw new Exception("Failed to send email: " . $result);
            }


            $status_quotation = 'pengesahan';
            if (!$sqlUpdateQuotation->execute()) {
                throw new Exception("Kemaskini quotation gagal: " . $sqlUpdateQuotation->error);
            }
            $sqlUpdateQuotation->close();

            $status_tempahan = 'pengesahan pt';
            $status_bayaran = 'bayaran diproses';
            if (!$sqlUpdateTempahan->execute()) {
                throw new Exception("Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error);
            }
            $sqlUpdateTempahan->close();
        }

        $conn->commit();

        // Return success message
        if ($cara_bayar == 'fpx') {
            echo json_encode(['success' => true, 'message' => 'Bayaran Selesai. Sila Cetak Resit Pembayaran']);
        } else {
            echo json_encode(['success' => true, 'message' => 'Sila Hadir Ke Kaunter LKTN untuk Pengesahan Bayaran']);
        }
    } catch (Exception $e) {
        // Rollback transaction if any error occurs
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }

    $conn->close();
}
