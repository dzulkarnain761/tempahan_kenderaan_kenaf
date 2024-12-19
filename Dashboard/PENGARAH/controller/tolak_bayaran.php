<?php

require_once '../../../Models/Database.php';
require_once '../../../Models/Quotation.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']); // Ensure $id is an integer
    $quotation_id = intval($_POST['quotation_id']);

    $quotation = new Quotation();
    $quotation_detail = $quotation->getDetail($quotation_id);

    $jenis_pembayaran = $quotation_detail['jenis_pembayaran'];

    $status_tempahan = 'bayaran penyewa';
    if($jenis_pembayaran === 'bayaran muka'){
        $status_bayaran = 'belum bayar';
    }else{
        $status_bayaran = 'bayaran tambahan';
    }
    
    $status_quotation = 'belum bayar';

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Prepare and execute the first statement
        $sql1 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $sql1->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id); // Change to "ssi" since $id is an integer

        if (!$sql1->execute()) {
            throw new Exception("Kemaskini tempahan gagal: " . $sql1->error);
        }
        $sql1->close();

        $sql2 = $conn->prepare("UPDATE quotation SET status = ? WHERE quotation_id = ?");
        $sql2->bind_param("si", $status_quotation, $quotation_id); // Change to "ssi" since $id is an integer

        if (!$sql2->execute()) {
            throw new Exception("Kemaskini tempahan gagal: " . $sql2->error);
        }
        $sql2->close();

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
?>
