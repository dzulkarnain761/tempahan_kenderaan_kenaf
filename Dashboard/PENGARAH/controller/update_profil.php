<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

if (isset($_POST['staff_id']) && isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['contact_no'])) {
    
    $staff_id = intval($_POST['staff_id']); 
    $nama = $_POST['nama']; 
    $email = $_POST['email']; 
    $contact_no = $_POST['contact_no']; 
    
    // Prepare and execute the SQL statement to update the admin table
    $sql = "UPDATE `admin` SET nama = ?, email = ?, contact_no = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("sssi", $nama, $email, $contact_no, $staff_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error']);
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

// Close the connection
$conn->close();
?>
