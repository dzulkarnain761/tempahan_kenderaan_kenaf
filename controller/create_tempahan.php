<?php

include 'db-connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Insert into table tempahan
    $id = $_POST['id'];
    $tarikh_kerja = $_POST['tarikh_kerja'];
    $negeri = $_POST['negeri'];
    $lokasi_kerja = $_POST['lokasi_kerja'];
    $keluasan_tanah = $_POST['keluasan_tanah'];
    $catatan = $_POST['catatan'];
    $status = "Dalam Pengesahan"; 

    $sqlTempahan = $conn->prepare("INSERT INTO tempahan (`penyewa_id`, `tarikh_kerja`, `negeri`, `lokasi`, `hektar`, `catatan`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sqlTempahan->bind_param("sssssss", $id, $tarikh_kerja, $negeri, $lokasi_kerja, $keluasan_tanah, $catatan, $status);

    if ($sqlTempahan->execute()) {
        // Get the last inserted ID from tempahan table
        $tempahan_id = $conn->insert_id;

        // Insert into table tempahan_kerja
        $kerja = $_POST['kerja'];

        $sqlKerja = $conn->prepare("INSERT INTO tempahan_kerja (`tempahan_id`, `nama_kerja`) VALUES (?, ?)");
        $sqlKerja->bind_param("ss", $tempahan_id, $nama_kerja);

        foreach ($kerja as $nama_kerja) {
            if (!$sqlKerja->execute()) {
                echo json_encode(["success" => false, "message" => "Gagal mendaftar kerja."]);
                $sqlKerja->close();
                $sqlTempahan->close();
                $conn->close();
                exit();
            }
        }

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sqlKerja->close();
    $sqlTempahan->close();
    $conn->close();
}