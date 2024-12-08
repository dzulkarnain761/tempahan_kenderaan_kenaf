<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']);
    $sebab_ditolak = $_POST['sebab_ditolak'];

    $status = 'ditolak';

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Prepare and execute the first statement
        $sql1 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ?, sebab_ditolak = ? WHERE tempahan_id = ?");
        $sql1->bind_param("sssi", $status, $status, $sebab_ditolak, $tempahan_id); // Change to "ssi" since $id is an integer

        if (!$sql1->execute()) {
            throw new Exception("Kemaskini tempahan gagal: " . $sql1->error);
        }
        $sql1->close();

        // Commit the transaction
        $conn->commit();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    } finally {
        // Close the connection
        $conn->close();
    }
}
