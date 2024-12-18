<?php

require_once '../../../Models/Database.php';
require_once '../../../Models/Quotation.php';
$conn = Database::getConnection();

if ($conn === null) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the quotation ID from POST request
    $quotation_id = $_POST['quotation_id'];

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Fetch quotation details
        $quotation = new Quotation();
        $quotation_detail = $quotation->getDetail($quotation_id);

        if (!$quotation_detail) {
            throw new Exception("Quotation detail not found.");
        }

        // Extract variables from the quotation detail
        $jenis_pembayaran = $quotation_detail['jenis_pembayaran'];
        $tempahan_id = $quotation_detail['tempahan_id'];
        $reference_number = $quotation_detail['reference_number'];
        $total_bayaran = $quotation_detail['total'];
        $status_quotation = 'selesai';
        $cara_bayar = 'tunai';

        // Update quotation status
        $sqlUpdateQuotation = $conn->prepare("UPDATE quotation SET status = ? WHERE quotation_id = ?");
        if ($sqlUpdateQuotation === false) {
            throw new Exception("Failed to prepare the query: " . $conn->error);
        }
        $sqlUpdateQuotation->bind_param("si", $status_quotation, $quotation_id);

        if (!$sqlUpdateQuotation->execute()) {
            throw new Exception("Failed to update quotation: " . $sqlUpdateQuotation->error);
        }
        $sqlUpdateQuotation->close();


        //create resit
        $sqlResit = $conn->prepare("INSERT INTO resit_pembayaran 
                    (tempahan_id, jenis_pembayaran, jumlah, cara_bayar, nombor_rujukan) 
                    VALUES (?, ?, ?, ?, ?)");
        $sqlResit->bind_param("isdss", $tempahan_id, $jenis_pembayaran, $total_bayaran, $cara_bayar, $reference_number);

        if (!$sqlResit->execute()) {
            throw new Exception("Resit pembayaran gagal: " . $sqlResit->error);
        }
        $sqlResit->close();

        // Determine tempahan status based on jenis_pembayaran
        if ($jenis_pembayaran === 'bayaran muka') {
            $status_tempahan = 'pengesahan jobsheet';
            $status_bayaran = 'selesai bayaran';
        } elseif ($jenis_pembayaran === 'bayaran tambahan') {
            $status_tempahan = 'selesai';
            $status_bayaran = 'selesai';
        } else {
            throw new Exception("Invalid jenis pembayaran.");
        }

        // Update tempahan status
        $stmt = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        if ($stmt === false) {
            throw new Exception("Failed to prepare tempahan query: " . $conn->error);
        }
        $stmt->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update tempahan: " . $stmt->error);
        }
        $stmt->close();

        // Commit the transaction
        $conn->commit();
        echo json_encode(["success" => true, "message" => "Successfully updated quotation and tempahan."]);
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    } finally {
        // Close the connection
        $conn->close();
    }
}
