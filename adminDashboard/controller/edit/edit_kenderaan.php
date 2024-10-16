<?php

include '../connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $kategori_kenderaan = $_POST['kategori_kenderaan'];
    $no_aset = $_POST['no_aset'];
    $no_pendaftaran_kenderaan = $_POST['no_pendaftaran_kenderaan'];
    $tahun_daftar = $_POST['tahun_daftar'];
    $negeri_penempatan = $_POST['negeri_penempatan'];
    $kawasan_penempatan = $_POST['kawasan_penempatan'];
    $catatan = $_POST['catatan'];


    $sqlNegeri = "SELECT * FROM negeri WHERE id_negeri = $negeri_penempatan";
    $resultNegeri = mysqli_query($conn, $sqlNegeri);
    $rowNegeri = mysqli_fetch_assoc($resultNegeri);

    $negeri = $rowNegeri['nama_negeri'];

    
    $no_pendaftaran_kenderaan = strtoupper($no_pendaftaran_kenderaan);

    // Check if nokp already exists in the database using prepared statement
    $checkSql = $conn->prepare("SELECT * FROM kenderaan WHERE id != ? AND no_pendaftaran = ?");
    $checkSql->bind_param("ss",$id, $no_pendaftaran_kenderaan);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "No Pendaftaran Sudah Didaftar"]);
        $checkSql->close();
        exit();
    }

    $checkSql->close();

    // Update the user in the database using a prepared statement
    $sql = $conn->prepare("UPDATE kenderaan SET kategori_kenderaan = ?, no_aset = ?, no_pendaftaran = ?, tahun_daftar = ?,  negeri_penempatan = ?, kawasan_penempatan = ?, catatan = ? WHERE id = ?");
    $sql->bind_param("ssssssss", $kategori_kenderaan, $no_aset, $no_pendaftaran_kenderaan, $tahun_daftar, $negeri, $kawasan_penempatan, $catatan, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal: " . $sql->error]);
    }

    $sql->close();
    $conn->close();
}
