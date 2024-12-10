<?php

require_once '../../../../Models/Database.php';
$conn = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect POST data
    $kenderaan_id = $_POST['kenderaan_id'];
    $kategori_kenderaan = $_POST['kategori_kenderaan'];
    $no_aset = $_POST['no_aset'];
    $no_pendaftaran = strtoupper($_POST['no_pendaftaran']); // Convert to uppercase
    $tahun_daftar = $_POST['tahun_daftar'];
    $catatan = $_POST['catatan'];

    // Check if the registration number already exists for another vehicle
    $checkSql = $conn->prepare("SELECT * FROM kenderaan WHERE id != ? AND no_pendaftaran = ?");
    $checkSql->bind_param("ss", $kenderaan_id, $no_pendaftaran);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "No Pendaftaran Sudah Didaftar"]);
        $checkSql->close();
        $conn->close();
        exit();
    }

    $checkSql->close();

    // Update the vehicle in the database
    $sql = $conn->prepare("UPDATE kenderaan SET kategori_kenderaan = ?, no_aset = ?, no_pendaftaran = ?, tahun_daftar = ?, catatan = ? WHERE id = ?");
    $sql->bind_param("ssssss", $kategori_kenderaan, $no_aset, $no_pendaftaran, $tahun_daftar, $catatan, $kenderaan_id);

    if ($sql->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal: " . $sql->error]);
    }

    $sql->close();
    $conn->close();
}
