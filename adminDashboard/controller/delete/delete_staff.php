<?php

include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the staff ID from the POST request
    $staffId = $_POST['id'];

    // Check if the ID is valid
    if (empty($staffId) || !is_numeric($staffId)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid ID']);
        exit;
    }

    // Prepare the SQL statement
    $sql = "DELETE FROM admin WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to prepare statement']);
        exit;
    }

    // Bind the parameter and execute the statement
    $stmt->bind_param('i', $staffId);
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
