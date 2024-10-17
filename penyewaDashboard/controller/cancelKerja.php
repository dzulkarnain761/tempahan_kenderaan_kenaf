<?php

include 'connection.php';

if (isset($_POST['id'])) {
    $tempahan_kerja_id = intval($_POST['id']);
    $statusKerja = 'ditolak';

    // Prepare the first SQL statement to get tempahan_id
    $sql4 = $conn->prepare("SELECT tempahan_id FROM tempahan_kerja WHERE tempahan_kerja_id = ?");
    if ($sql4) {
        $sql4->bind_param("i", $tempahan_kerja_id);
        $sql4->execute();
        $sql4->bind_result($tempahan_id);
        $sql4->fetch();
        $sql4->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement for fetching tempahan_id']);
        exit;
    }

    // Prepare the second SQL statement to count remaining kerja
    $sql3 = $conn->prepare("SELECT COUNT(*) FROM tempahan_kerja WHERE tempahan_id = ?");
    if ($sql3) {
        $sql3->bind_param("i", $tempahan_id);
        $sql3->execute();
        $sql3->bind_result($remaining_kerja);
        $sql3->fetch();
        $sql3->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement for counting remaining kerja']);
        exit;
    }

    // Check if remaining kerja is 1
    if ($remaining_kerja == 1) {
        echo json_encode(['success' => false, 'message' => 'Sila Tolak Tempahan Jika Mahu Tolak Semua Kerja']);
        exit;
    }

    try {
        // Prepare and execute the SQL statement to update the kerja status
        $sql = "DELETE FROM `tempahan_kerja` WHERE `tempahan_kerja_id` = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $tempahan_kerja_id);
            if (!$stmt->execute()) {
                throw new Exception('Failed to delete kerja : ' . $stmt->error);
            }
            $stmt->close();
        } else {
            throw new Exception('Failed to prepare statement for updating kerja status: ' . $conn->error);
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } finally {
        // Close the connection
        $conn->close();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    $conn->close();
}
