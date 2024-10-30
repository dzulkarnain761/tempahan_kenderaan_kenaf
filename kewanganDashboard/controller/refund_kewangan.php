<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']);

    // Start the transaction
    $conn->begin_transaction();

    $status_tempahan = 'selesai';
    $status_bayaran = 'selesai';

    try {
        // Prepare and execute the first statement
        $sql1 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $sql1->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id); 

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
