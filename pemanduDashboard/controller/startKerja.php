<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kerja_id = intval($_POST['id']);
    
    $updateStatusKerja = 'dijalankan';

    // Prepare and execute the second statement
    $sql2 = $conn->prepare("UPDATE tempahan_kerja SET status_kerja = ? WHERE tempahan_kerja_id = ? AND status_kerja = 'tempahan diproses'");
    $sql2->bind_param("si", $updateStatusKerja, $kerja_id);

    if (!$sql2->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan_kerja gagal: " . $sql2->error]);
        $sql2->close();
        $conn->close();
        exit;
    }
    $sql2->close();

    $conn->close();
    echo json_encode(["success" => true, "id" => $kerja_id]);
}
