<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resit_id = intval($_POST['resit_id']);

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Fetch details from resit_pembayaran
        $stmt = $conn->prepare("SELECT cara_bayar, jenis_pembayaran, tempahan_id FROM resit_pembayaran WHERE resit_id = ?");
        $stmt->bind_param("i", $resit_id);
        $stmt->execute();
        $stmt->bind_result($cara_bayar, $jenis_pembayaran, $tempahan_id);
        if (!$stmt->fetch()) {
            throw new Exception("Resit tidak wujud.");
        }
        $stmt->close();

        // Update status_resit
        $status_resit = 'selesai';
        $stmt = $conn->prepare("UPDATE resit_pembayaran SET status_resit = ? WHERE resit_id = ?");
        $stmt->bind_param("si", $status_resit, $resit_id);
        if (!$stmt->execute()) {
            throw new Exception("Gagal mengemaskini resit: " . $stmt->error);
        }
        $stmt->close();

        // Determine tempahan status
        if ($jenis_pembayaran === 'bayaran penuh') {
            $status_tempahan = 'pengesahan jobsheet';
            $status_bayaran = 'selesai bayaran';
        } elseif ($jenis_pembayaran === 'bayaran tambahan') {
            $status_tempahan = 'selesai';
            $status_bayaran = 'selesai';
        } else {
            throw new Exception("Jenis pembayaran tidak sah.");
        }

        // Update tempahan
        $stmt = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $stmt->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);
        if (!$stmt->execute()) {
            throw new Exception("Gagal mengemaskini tempahan: " . $stmt->error);
        }
        $stmt->close();

        // Commit the transaction
        $conn->commit();
        echo json_encode(["success" => true, "message" => "Berjaya"]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    } finally {
        $conn->close();
    }
}
