<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $status = 'ditolak';
    
    // Update the user in the database using a prepared statement
    $sql = $conn->prepare("UPDATE tempahan SET status = ? WHERE id = ?");
    $sql->bind_param("ss", $status, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Kemaskini gagal: " . $sql->error]);
    }

    $sql->close();
    $conn->close();
}
