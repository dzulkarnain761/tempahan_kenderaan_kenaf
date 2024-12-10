<?php

require_once '../../../../Models/Database.php';
$conn = Database::getConnection();

// Periksa jika borang dihantar
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Dapatkan data dari permintaan POST
    $no_aset = $_POST['no_aset'];
    $kategori_kenderaan = $_POST['kategori_kenderaan'];
    $no_pendaftaran = strtoupper($_POST['no_pendaftaran']); // Tukar kepada huruf besar
    $tahun_daftar = $_POST['tahun_daftar'];
    $catatan = $_POST['catatan'];

    // Semak jika no_pendaftaran sudah wujud dalam pangkalan data menggunakan prepared statement
    $checkSql = $conn->prepare("SELECT * FROM kenderaan WHERE no_pendaftaran = ?");
    if ($checkSql === false) {
        echo json_encode(["success" => false, "message" => "Ralat menyediakan pernyataan semakan."]);
        exit();
    }
    $checkSql->bind_param("s", $no_pendaftaran);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "No Pendaftaran Sudah Didaftar"]);
        $checkSql->close();
        $conn->close();
        exit();
    }
    $checkSql->close();

    // Masukkan rekod ke dalam pangkalan data menggunakan prepared statement
    $sql = $conn->prepare("INSERT INTO kenderaan (kategori_kenderaan, no_aset, no_pendaftaran, tahun_daftar, catatan) VALUES (?, ?, ?, ?, ?)");
    if ($sql === false) {
        echo json_encode(["success" => false, "message" => "Ralat menyediakan pernyataan SQL untuk kemasukan."]);
        exit();
    }
    $sql->bind_param("sssss", $kategori_kenderaan, $no_aset, $no_pendaftaran, $tahun_daftar, $catatan);

    if ($sql->execute()) {
        echo json_encode(["success" => true, "message" => "Kenderaan berjaya didaftarkan."]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sql->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Permintaan tidak sah."]);
}
