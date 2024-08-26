<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the staff ID from the POST request
    $tugasanId = $_POST['id'];

    // Check if the ID is valid
    if (empty($tugasanId) || !is_numeric($tugasanId)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid ID', 'id' => $tugasanId]);
        exit;
    }

    // Prepare the SQL statement
    $sql = "DELETE FROM tugasan_traktor WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to prepare statement']);
        exit;
    }

    // Bind the parameter and execute the statement
    $stmt->bind_param('i', $tugasanId);
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Staff member deleted successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete staff member']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}
?>
