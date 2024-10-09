<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($_POST['id']); // Ensure $id is an integer
    $status = 'ditolak';

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Prepare and execute the first statement
        $sql1 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $sql1->bind_param("ssi", $status, $status, $id); // Change to "ssi" since $id is an integer

        if (!$sql1->execute()) {
            throw new Exception("Kemaskini tempahan gagal: " . $sql1->error);
        }
        $sql1->close();

        // Prepare and execute the second statement
        $sql2 = $conn->prepare("UPDATE tempahan_kerja SET status_kerja = ? WHERE tempahan_id = ?");
        $sql2->bind_param("si", $status, $id); // Change to "si" since $id is an integer

        if (!$sql2->execute()) {
            throw new Exception("Kemaskini tempahan_kerja gagal: " . $sql2->error);
        }
        $sql2->close();

        // Prepare and execute the third statement
        $sql3 = $conn->prepare("DELETE FROM jobsheet WHERE tempahan_id = ?");
        $sql3->bind_param("i", $id); // Change to "i" since $id is an integer

        if (!$sql3->execute()) {
            throw new Exception("Penghapusan jobsheet gagal: " . $sql3->error);
        }
        $sql3->close();

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
?>
