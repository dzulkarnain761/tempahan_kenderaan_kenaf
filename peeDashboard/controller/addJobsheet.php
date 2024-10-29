<?php

include 'connection.php';

if (isset($_POST['tempahan_kerja_id'])) {
    $tempahan_kerja_id = intval($_POST['tempahan_kerja_id']); 
    $tempahan_id = intval($_POST['tempahan_id']); 
    
    // Prepare and execute the SQL statement to update the kerja status
    $sql = "INSERT INTO `jobsheet`(`tempahan_kerja_id`, `tempahan_id`) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $tempahan_kerja_id,$tempahan_id);

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