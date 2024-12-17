<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

if (isset($_POST['tempahan_kerja_id'])) {
    $tempahan_kerja_id = intval($_POST['tempahan_kerja_id']);
    $tempahan_id = intval($_POST['tempahan_id']);

    // Kira jumlah kerja yang tinggal
    $sql3 = $conn->prepare("SELECT COUNT(*) FROM tempahan_kerja WHERE tempahan_id = ?");
    if ($sql3) {
        $sql3->bind_param("i", $tempahan_id);
        $sql3->execute();
        $sql3->bind_result($remaining_kerja);
        $sql3->fetch();
        $sql3->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyediakan kenyataan untuk mengira kerja yang tinggal']);
        exit;
    }

    // Semak jika kerja yang tinggal hanya satu
    if ($remaining_kerja == 1) {
        echo json_encode(['success' => false, 'message' => 'Sila batal tempahan jika ingin membatalkan semua kerja']);
        exit;
    }

    try {
        // Sediakan dan jalankan SQL untuk menghapuskan kerja
        $sql = "DELETE FROM `tempahan_kerja` WHERE `tempahan_kerja_id` = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $tempahan_kerja_id);
            if (!$stmt->execute()) {
                throw new Exception('Gagal untuk membatalkan kerja: ' . $stmt->error);
            }
            $stmt->close();
            echo json_encode(['success' => true, 'message' => 'Kerja berjaya dibatalkan']);
        } else {
            throw new Exception('Gagal menyediakan kenyataan untuk membatalkan kerja: ' . $conn->error);
        }
    } catch (Exception $e) {
        // Rollback jika berlaku ralat
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } finally {
        // Tutup sambungan
        $conn->close();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Input tidak sah']);
    $conn->close();
}
