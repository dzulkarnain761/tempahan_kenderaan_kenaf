<?php

include 'connection.php';

if (isset($_POST['id'])) {
    $kerjaId = intval($_POST['id']); // Get the kerja ID from POST data
    $statusKerja = 'ditolak';

    // Prepare and execute the SQL statement to update the kerja status
    $sql = "UPDATE `tempahan_kerja` SET `status_kerja` = ? WHERE `tempahan_kerja_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $statusKerja, $kerjaId);

    if ($stmt->execute()) {
        // Prepare and execute the SQL statement to delete the entry from jobsheet table
        $sqlJobsheet = "DELETE FROM `jobsheet` WHERE `tempahan_kerja_id` = ?";
        $stmtJobsheet = $conn->prepare($sqlJobsheet);
        $stmtJobsheet->bind_param("i", $kerjaId);

        if ($stmtJobsheet->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete jobsheet record']);
        }

        $stmtJobsheet->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update kerja status']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
