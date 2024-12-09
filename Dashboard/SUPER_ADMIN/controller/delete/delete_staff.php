<?php

require_once '../../../../Models/Database.php';
$conn = Database::getConnection();

if (isset($_POST['staff_id'])) {
    // Get the staff ID from the POST request
    $staffId = $_POST['staff_id'] ?? null;

    // Validate the staff ID
    if (empty($staffId) || !ctype_digit($staffId)) {
        
        echo json_encode(['error' => 'Invalid ID. Please provide a numeric staff ID.']);
        exit;
    }

    // Prepare the SQL statement for deletion
    $sql = "DELETE FROM admin WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        
        echo json_encode(['error' => 'Failed to prepare the SQL statement.']);
        exit;
    }

    // Bind the parameter and execute the statement
    $stmt->bind_param('i', $staffId);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => 'Staff member deleted successfully.']);
        } else {
           
            echo json_encode(['error' => 'Staff member not found.']);
        }
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete the staff member.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    
    echo json_encode(['error' => 'Invalid request method. Use POST.']);
}
?>
