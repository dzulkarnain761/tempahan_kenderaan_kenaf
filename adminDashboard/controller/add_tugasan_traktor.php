<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_kerja = $_POST['nama_kerja'];
    $kadar_per_jam = $_POST['kadar_per_jam'];
    

    if (empty($kadar_per_jam) || !is_numeric($kadar_per_jam)) {
        echo json_encode(["success" => false, "message" => "Pastikan Nombor Sahaja."]);
        exit();
    }

    // Insert the user into the database using prepared statement
    $sql = $conn->prepare("INSERT INTO tugasan_traktor (kerja, harga_per_jam) VALUES (?, ?)");

    $sql->bind_param("ss", $nama_kerja, $kadar_per_jam);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Penambahan gagal."]);
    }

    $sql->close();
    $conn->close();
}
