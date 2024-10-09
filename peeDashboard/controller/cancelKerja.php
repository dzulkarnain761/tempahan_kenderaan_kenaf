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
    $sql3 = $conn->prepare("SELECT COUNT(*) FROM tempahan_kerja WHERE tempahan_id = ? AND status_kerja = 'tempahan diproses'");
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

    // Prepare and execute the SQL statement to update the kerja status
    $sql = "UPDATE `tempahan_kerja` SET `status_kerja` = ? WHERE `tempahan_kerja_id` = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("si", $statusKerja, $tempahan_kerja_id);
        if ($stmt->execute()) {
            // Prepare and execute the SQL statement to delete the entry from jobsheet table
            $sqlJobsheet = "DELETE FROM `jobsheet` WHERE `tempahan_kerja_id` = ?";
            $stmtJobsheet = $conn->prepare($sqlJobsheet);
            if ($stmtJobsheet) {
                $stmtJobsheet->bind_param("i", $tempahan_kerja_id);
                if ($stmtJobsheet->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Success to delete jobs record']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to delete jobsheet record']);
                }
                $stmtJobsheet->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to prepare statement for deleting jobsheet record']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update kerja status']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement for updating kerja status']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
