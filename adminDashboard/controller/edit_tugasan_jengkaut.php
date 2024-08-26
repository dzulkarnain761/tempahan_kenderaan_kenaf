<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['tugasan_id'];
    $nama_kerja = $_POST['nama_kerja'];
    $kadar_per_jam = $_POST['kadar_per_jam'];
    

    if (empty($kadar_per_jam) || !is_numeric($kadar_per_jam)) {
        echo json_encode(["success" => false, "message" => "Pastikan Nombor Sahaja."]);
        exit();
    }
    

    $sql = $conn->prepare("UPDATE tugasan_jengkaut SET kerja = ?, harga_per_jam = ? WHERE id = ?");

    $sql->bind_param("sss", $nama_kerja, $kadar_per_jam, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Kemaskini gagal."]);
    }

    $sql->close();
    $conn->close();
}
