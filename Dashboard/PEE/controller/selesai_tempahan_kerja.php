<?php

require_once '../../../Models/Database.php';
require_once '../../../Models/Jobsheet.php';

$conn = Database::getConnection();
$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tempahan_id = intval($_POST['tempahan_id']);

    // Validate tempahan_id
    if ($tempahan_id <= 0) {
        echo json_encode(["success" => false, "message" => "Invalid tempahan_id"]);
        exit;
    }

    $jobsheet = new Jobsheet();
    if ($jobsheet->isUnfinishedJobsheetExist($tempahan_id)) {
        echo json_encode(["success" => false, "message" => "Pastikan Semua Jobsheet Selesai"]);
        exit;
    }

    $conn->begin_transaction();

    try {
        // Fetch total_harga_anggaran
        $sqlGetAnggaran = "SELECT total_harga_anggaran FROM tempahan WHERE tempahan_id = ?";
        $result = fetchSingleResult($conn, $sqlGetAnggaran, 'i', [$tempahan_id]);

        if (!$result) throw new Exception("Failed to retrieve total_harga_anggaran");

        $total_harga_anggaran = $result['total_harga_anggaran'];

        // Fetch total_harga
        $sqlGetSums = "SELECT SUM(total_harga) AS total_harga FROM tempahan_kerja WHERE tempahan_id = ?";
        $result = fetchSingleResult($conn, $sqlGetSums, 'i', [$tempahan_id]);

        if (!$result) throw new Exception("Failed to retrieve total_harga");

        $total_harga_sebenar = $result['total_harga'];
        $total_baki = $total_harga_sebenar - $total_harga_anggaran;

        // Determine status
        if ($total_baki == 0) {
            $status_tempahan = 'selesai';
            $status_bayaran = 'selesai';
        } elseif ($total_baki > 0) {
            $status_tempahan = 'bayaran penyewa';
            $status_bayaran = 'bayaran tambahan';

            // Insert into quotation
            $reference_number = 'KJBT' . str_pad($tempahan_id, 5, '0', STR_PAD_LEFT);
            $jenis_pembayaran = 'bayaran tambahan';

            $sqlInsertQuotation = "INSERT INTO quotation (total, reference_number, jenis_pembayaran, tempahan_id) VALUES (?, ?, ?, ?)";
            executeQuery($conn, $sqlInsertQuotation, 'dssi', [$total_baki, $reference_number, $jenis_pembayaran, $tempahan_id]);
        } else {
            $status_tempahan = 'refund kewangan';
            $status_bayaran = 'refund';
        }

        // Update tempahan
        $sqlUpdateTempahan = "
            UPDATE tempahan
            SET total_harga_sebenar = ?, total_baki = ?, status_tempahan = ?, status_bayaran = ?
            WHERE tempahan_id = ?";
        executeQuery($conn, $sqlUpdateTempahan, 'ddssi', [$total_harga_sebenar, $total_baki, $status_tempahan, $status_bayaran, $tempahan_id]);

        // Delete jobsheet
        $sqlDeleteJobsheet = "DELETE FROM jobsheet WHERE tempahan_id = ? AND status_jobsheet = 'pengesahan'";
        executeQuery($conn, $sqlDeleteJobsheet, 'i', [$tempahan_id]);

        $conn->commit();
        echo json_encode(["success" => true, "message" => "Berjaya Kemaskini Tempahan"]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    } finally {
        $conn->close();
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

function fetchSingleResult($conn, $sql, $types, $params) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
}

function executeQuery($conn, $sql, $types, $params) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    if (!$stmt->execute()) {
        throw new Exception("Query Execution Failed");
    }
    $stmt->close();
}
