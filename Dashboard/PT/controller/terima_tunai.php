<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']);

    $status_tempahan = 'pengesahan pengarah';

    $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ? WHERE tempahan_id = ?");
    $sqlUpdateTempahan->bind_param("si", $status_tempahan, $tempahan_id);

    if (!$sqlUpdateTempahan->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error]);
        $sqlUpdateTempahan->close();
        $conn->close();
        exit;
    }
    $sqlUpdateTempahan->close();

    // Close the connection and return success message
    $conn->close();
    echo json_encode(["success" => true, "message" => "Berjaya"]);
}