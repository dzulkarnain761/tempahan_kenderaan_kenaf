<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

if (isset($_POST['jobsheet_id'])) { // Corrected to 'jobsheet_id'
    $jobsheet_id = intval($_POST['jobsheet_id']); 
    
    // Prepare and execute the SQL statement to delete the jobsheet
    $sql = "DELETE FROM `jobsheet` WHERE jobsheet_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $jobsheet_id); // Corrected the binding to jobsheet_id

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
?>
