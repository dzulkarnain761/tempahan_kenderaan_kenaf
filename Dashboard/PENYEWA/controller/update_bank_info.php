<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

if (isset($_POST['penyewa_id']) && isset($_POST['nama_bank']) && isset($_POST['no_bank'])) {
    
    $penyewa_id = intval($_POST['penyewa_id']); 
    $nama_bank = $_POST['nama_bank']; 
    
    $no_bank = $_POST['no_bank']; 
    
    // Prepare and execute the SQL statement to update the admin table
    $sql = "UPDATE `penyewa` SET nama_bank = ?, no_bank = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ssi", $nama_bank, $no_bank, $penyewa_id);

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
