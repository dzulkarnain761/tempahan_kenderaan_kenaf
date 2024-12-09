<?php

require_once '../../../../Models/Database.php';
$conn = Database::getConnection();


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $no_aset = $_POST['no_aset'];
    $kategori_kenderaan = $_POST['kategori_kenderaan'];
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
    $checkSql = $conn->prepare("SELECT * FROM kenderaan WHERE no_pendaftaran = ?");
    $checkSql->bind_param("s", $no_pendaftaran_kenderaan);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "No Pendaftaran Sudah Didaftar"]);
        $checkSql->close();
        exit();
    }

    $checkSql->close();

    // Insert the user into the database using prepared statement
    $sql = $conn->prepare("INSERT INTO kenderaan (kategori_kenderaan, no_aset, no_pendaftaran, tahun_daftar, negeri_penempatan, kawasan_penempatan, catatan) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $sql->bind_param("sssssss",$kategori_kenderaan, $no_aset, $no_pendaftaran_kenderaan, $tahun_daftar, $negeri, $kawasan_penempatan, $catatan);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sql->close();
    $conn->close();
}
