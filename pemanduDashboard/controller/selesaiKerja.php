<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($_POST['id']);
    $status = 'selesai';

    // Prepare and execute the second statement
    $sql2 = $conn->prepare("UPDATE tempahan_kerja SET status_kerja = ?,masa_mula_odometer = ?, masa_akhir_odometer = ?, jumlah_jam = ?, jumlah_bayaran = ? WHERE tempahan_kerja_id = ?");
    $sql2->bind_param("si", $status, $id);

    if (!$sql2->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan_kerja gagal: " . $sql2->error]);
        $sql2->close();
        $conn->close();
        exit;
    }
    $sql2->close();

    $conn->close();
    echo json_encode(["success" => true , "id" => $id]);
}
?>
