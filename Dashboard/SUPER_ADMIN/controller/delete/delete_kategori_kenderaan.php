<?php

require_once '../../../../Models/Database.php';
$conn = Database::getConnection();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the staff ID from the POST request
    $kategoriId = $_POST['kategori_id'];

    // Check if the ID is valid
    if (empty($kategoriId) || !is_numeric($kategoriId)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid ID', 'id' => $kategoriId]);
        exit;
    }

    // Prepare the SQL statement
    $sql = "DELETE FROM kategori_kenderaan WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to prepare statement']);
        exit;
    }

    // Bind the parameter and execute the statement
    $stmt->bind_param('i', $kategoriId);
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Berjaya Padam']);
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
