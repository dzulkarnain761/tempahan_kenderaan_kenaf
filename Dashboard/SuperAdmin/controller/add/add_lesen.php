<?php

include '../connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kategori = $_POST['kategori'];
    $penerangan = $_POST['penerangan'];


    // Check if nokp already exists in the database using prepared statement
    $checkSql = $conn->prepare("SELECT * FROM kategori_lesen WHERE kategori = ?");
    $checkSql->bind_param("s", $kategori);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Kategori Sudah Didaftar"]);
        $checkSql->close();
        exit();
    }

    $checkSql->close();

    
    // Insert the user into the database using prepared statement
    $sql = $conn->prepare("INSERT INTO kategori_lesen (kategori, description) VALUES (?, ?)");

    $sql->bind_param("ss", $kategori, $penerangan);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sql->close();
    $conn->close();
}
