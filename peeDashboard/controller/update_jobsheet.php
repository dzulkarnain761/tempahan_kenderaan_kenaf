<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $jobsheet_id = intval($_POST['jobsheet_id']);
    $kenderaan_id = intval($_POST['kenderaan_id']);
    $pemandu_id = intval($_POST['pemandu_id']);

    // Prepare the SQL update query
    $updateQuery = "UPDATE `jobsheet` SET kenderaan_id = ?, pemandu_id = ?, status_jobsheet = 'dijalankan' WHERE jobsheet_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('iii', $kenderaan_id, $pemandu_id, $jobsheet_id);
    
    // Execute the query and check if successful
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Berjaya Kemaskini Pemandu dan Kenderaan"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal Kemaskini"]);
    }
    
    $stmt->close(); // Close the statement

} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

// Close the database connection
$conn->close();

?>
