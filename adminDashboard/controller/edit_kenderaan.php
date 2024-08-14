<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $kategori_kenderaan = $_POST['kategori_kenderaan'];
    $no_pendaftaran_kenderaan = $_POST['no_pendaftaran_kenderaan'];
    $tahun_daftar = $_POST['tahun_daftar'];
    $mula_cukai_jalan = $_POST['mula_cukai_jalan'];
    $tamat_cukai_jalan = $_POST['tamat_cukai_jalan'];
    $negeri_penempatan = $_POST['negeri_penempatan'];
    $kawasan_penempatan = $_POST['kawasan_penempatan'];
    $status_kenderaan = $_POST['status_kenderaan'];

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
    $sql = $conn->prepare("UPDATE kenderaan SET kategori = ?, no_pendaftaran = ?, tahun_daftar = ?, mula_cukai_jalan = ?, tamat_cukai_jalan = ?, negeri_penempatan = ?, kawasan_penempatan = ?, status = ? WHERE id = ?");
    $sql->bind_param("sssssssss", $kategori_kenderaan, $no_pendaftaran_kenderaan, $tahun_daftar, $mula_cukai_jalan, $tamat_cukai_jalan, $negeri, $kawasan_penempatan, $status_kenderaan, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal: " . $sql->error]);
    }

    $sql->close();
    $conn->close();
}
