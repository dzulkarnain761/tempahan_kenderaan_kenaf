<?php

include 'connection.php';


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $nama_pemandu = $_POST['nama_pemandu'];
    $no_pendaftaran_kenderaan = $_POST['no_pendaftaran_kenderaan'];
    $harga_anggaran = $_POST['harga_anggaran'];

    // Update the user in the database using a prepared statement
    $sql = $conn->prepare("UPDATE tempahan_kerja SET nama_pemandu = ?, no_pendaftaran_kenderaan = ?, harga_anggaran = ? WHERE id = ?");
    $sql->bind_param("ssss", $nama_pemandu, $no_pendaftaran_kenderaan, $harga_anggaran, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Kemaskini gagal: " . $sql->error]);
    }

    $sql->close();
    $conn->close();
}
