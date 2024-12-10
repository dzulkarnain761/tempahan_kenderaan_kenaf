<?php

require_once '../../../../Models/Database.php';
$conn = Database::getConnection();


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['tugasan_id'];
    $kategori_kenderaan = $_POST['kategori_kenderaan'];
    $nama_kerja = $_POST['nama_kerja'];
    $harga_per_jam = $_POST['harga_per_jam'];
    

    if (empty($harga_per_jam) || !is_numeric($harga_per_jam)) {
        echo json_encode(["success" => false, "message" => "Pastikan Nombor Sahaja."]);
        exit();
    }
    

    $sql = $conn->prepare("UPDATE tugasan SET kerja = ?, harga_per_jam = ?, kategori_kenderaan = ? WHERE id = ?");

    $sql->bind_param("ssss", $nama_kerja, $harga_per_jam, $kategori_kenderaan, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Kemaskini gagal."]);
    }

    $sql->close();
    $conn->close();
}
