<?php

require_once '../../../Models/Database.php';
require_once '../../../Models/Tempahan.php';
require_once '../../../Models/Quotation.php';
require_once '../../../Models/Admin.php';

$conn = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Safely handle input
    $quotation_id = filter_input(INPUT_POST, 'quotation_id', FILTER_VALIDATE_INT);
    $cara_bayar = 'tunai';

    if (!$quotation_id) {
        echo json_encode(['success' => false, 'message' => 'Invalid input provided.']);
        exit;
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        $quotation = new Quotation();
        $quotations = $quotation->getDetail($quotation_id);

        if (!$quotations) {
            throw new Exception("Quotation not found.");
        }

        $total_bayaran = $quotations['total'];
        $reference_number = $quotations['reference_number'];
        $jenis_pembayaran = $quotations['jenis_pembayaran'];
        $tempahan_id = $quotations['tempahan_id'];

        // Prepare statements
        $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $sqlUpdateTempahan->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);

        $sqlUpdateQuotation = $conn->prepare("UPDATE quotation SET status = ? WHERE quotation_id = ?");
        $sqlUpdateQuotation->bind_param("si", $status_quotation, $quotation_id);
  
            // Handle manual payment
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

            echo json_encode([
                'success' => true,
                'message' => 'Sila Hadir Ke Kaunter LKTN untuk Pengesahan Bayaran',
            ]);
        

        // Commit transaction
        $conn->commit();
    } catch (Exception $e) {
        // Rollback transaction if any error occurs
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } finally {
        $conn->close();
    }
}
