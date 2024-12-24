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

            
            // Bind the actual parameters
            $rsp_appln_id = 'ETJ'; // Example application ID
            $rsp_org_id = 'LKTN'; // Example organization ID
            $rsp_orderid = $reference_number; // Example order ID
            $rsp_amount = $total_bayaran; // Amount from quotation


            
            

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
