<?php

include 'connection.php';

if (isset($_POST['id'])) {
    $kerjaId = intval($_POST['id']); // Get the kerja ID from POST data

    // Prepare and execute the SQL statement to update the kerja status
    $sql = "UPDATE `tempahan_kerja` SET `status_kerja` = 'cancelled' WHERE `tempahan_kerja_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kerjaId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();