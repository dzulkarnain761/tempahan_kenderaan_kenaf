<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']);

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Retrieve total deposit
        $sqlTempahan = "SELECT total_baki FROM tempahan WHERE tempahan_id = ?";
        $stmtTempahan = $conn->prepare($sqlTempahan);
        $stmtTempahan->bind_param("i", $tempahan_id);
        $stmtTempahan->execute();
        $resultTempahan = $stmtTempahan->get_result();

        if ($rowTempahan = $resultTempahan->fetch_assoc()) {
            $jumlah_bayaran = abs($rowTempahan['total_baki']); // Ensure positive value
        } else {
            throw new Exception("Tempahan tidak dijumpai");
        }
        $stmtTempahan->close();

        $jenis_pembayaran = 'refund';
        $cara_bayar = 'fpx';

        $reference_number = 'KJR' . str_pad($tempahan_id, 5, '0', STR_PAD_LEFT);


        // Prepare the FPX payment insertion query
        $sqlFPX = $conn->prepare("INSERT INTO `payment`
        (`rsp_appln_id`, `rsp_org_id`, `rsp_orderid`, `rsp_amount`, `rsp_trxstatus`, `rsp_stcode`, `rsp_bankid`, `rsp_bankname`, `rsp_fpxid`, `rsp_fpxorderno`, `type`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind the actual parameters
        $rsp_appln_id = 'ETJ'; // Example application ID
        $rsp_org_id = 'LKTN'; // Example organization ID
        $rsp_orderid = $reference_number; // Example order ID
        $rsp_amount = $jumlah_bayaran; // Amount from quotation
        $rsp_trxstatus = 'SUCCESSFUL'; // Example transaction status
        $rsp_stcode = '00'; // Example status code (success)
        $rsp_bankid = 'MB2U0227'; // Maybank bank ID
        $rsp_bankname = 'Maybank'; // Bank name
        $rsp_fpxid = 'FPX123456'; // Example FPX ID
        $rsp_fpxorderno = 'FPXORD987654'; // Example FPX order number
        $type = 0; // Example type

        $sqlFPX->bind_param(
            "sssdsissssi",
            $rsp_appln_id,
            $rsp_org_id,
            $rsp_orderid,
            $rsp_amount,
            $rsp_trxstatus,
            $rsp_stcode,
            $rsp_bankid,
            $rsp_bankname,
            $rsp_fpxid,
            $rsp_fpxorderno,
            $type
        );

        // Execute the query
        if (!$sqlFPX->execute()) {
            throw new Exception("Kemaskini pembayaran gagal: " . $sqlFPX->error);
        }

        $sqlFPX->close();

        $sqlResit = $conn->prepare("INSERT INTO resit_pembayaran (tempahan_id, jenis_pembayaran, jumlah, cara_bayar, nombor_rujukan) VALUES (?, ?, ?, ?, ?)");
        $sqlResit->bind_param("isdss", $tempahan_id, $jenis_pembayaran, $jumlah_bayaran, $cara_bayar, $reference_number);

        if (!$sqlResit->execute()) {
            throw new Exception("Resit gagal: " . $sqlResit->error);
        }
        $sqlResit->close();

        $status_tempahan = 'selesai';
        $status_bayaran = 'selesai';

        // Update tempahan status
        $sql1 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $sql1->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);

        if (!$sql1->execute()) {
            throw new Exception("Kemaskini tempahan gagal: " . $sql1->error);
        }
        $sql1->close();


        // Commit the transaction
        $conn->commit();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    } finally {
        // Close the connection
        $conn->close();
    }
}
