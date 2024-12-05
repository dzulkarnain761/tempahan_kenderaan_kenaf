<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $tempahan_id = intval($_POST['tempahan_id']); 

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Retrieve total_harga_anggaran
        $sqlHargaAnggaran = "
            SELECT total_harga_anggaran
            FROM tempahan
            WHERE tempahan_id = ?
        ";
        $stmt = $conn->prepare($sqlHargaAnggaran);
        $stmt->bind_param('i', $tempahan_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) {
            throw new Exception("Gagal Mendapatkan Harga Anggaran");
        }

        $total_harga_anggaran = $result['total_harga_anggaran'];

        // Calculate the sum of actual costs
        $sqlSums = "
            SELECT SUM(total_harga) AS total_harga 
            FROM tempahan_kerja 
            WHERE tempahan_id = ?
        ";
        $stmt = $conn->prepare($sqlSums);
        $stmt->bind_param('i', $tempahan_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) {
            throw new Exception("Gagal Mendapatkan Jumlah Harga");
        }

        $total_harga_sebenar = $result['total_harga'];
        $total_baki = $total_harga_sebenar - $total_harga_anggaran;

        // Determine status based on the remaining balance
        if ($total_baki == 0) {
            $status_tempahan = 'selesai';
            $status_bayaran = 'selesai';
        } elseif ($total_baki > 0) {
            $status_tempahan = 'bayaran penyewa';
            $status_bayaran = 'bayaran tambahan';
        } else {
            $status_tempahan = 'refund kewangan';
            $status_bayaran = 'refund';
        }

        // Update tempahan table with the actual cost, balance, and status
        $updateTempahan = "
            UPDATE tempahan
            SET total_harga_sebenar = ?, total_baki = ?, status_tempahan = ?, status_bayaran = ?
            WHERE tempahan_id = ?
        ";
        $stmt = $conn->prepare($updateTempahan);
        $stmt->bind_param('ddssi', $total_harga_sebenar, $total_baki, $status_tempahan, $status_bayaran, $tempahan_id);

        if (!$stmt->execute()) {
            throw new Exception("Gagal Kemaskini Tempahan");
        }

        // Commit transaction
        $conn->commit();
        echo json_encode(["success" => true, "message" => "Berjaya Kemaskini Tempahan"]);

    } catch (Exception $e) {
        // Rollback transaction if any query fails
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

// Close the connection
$conn->close();

?>
