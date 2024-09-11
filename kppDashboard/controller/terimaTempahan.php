<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $status = 'belum bayar';
    
    // First query to update the 'tempahan' table
    $sql = $conn->prepare("UPDATE tempahan SET status = ? WHERE tempahan_id = ?");
    $sql->bind_param("ss", $status, $id);

    // Execute the first query and check if successful
    if ($sql->execute() === TRUE) {
        // Second query to update the 'tempahan_kerja' table
        $sql = $conn->prepare("UPDATE tempahan_kerja SET status_kerja = ? WHERE tempahan_id = ?");
        $sql->bind_param("ss", $status, $id);

        // Execute the second query and check if successful
        if ($sql->execute() === TRUE) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Kemaskini tempahan_kerja gagal: " . $sql->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sql->error]);
    }

    $sql->close();
    $conn->close();
}
?>
