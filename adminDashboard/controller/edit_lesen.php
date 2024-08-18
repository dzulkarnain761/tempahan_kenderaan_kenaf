<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $description = $_POST['penerangan'];
  

    // Check if nokp already exists in the database using prepared statement
    $checkSql = $conn->prepare("SELECT * FROM kategori_lesen WHERE kategori != ? AND id = ?");
    $checkSql->bind_param("ss", $kategori,$id);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Kategori Sudah Didaftar"]);
        $checkSql->close();
        exit();
    }

    $checkSql->close();

    // Update the user in the database using a prepared statement
    $sql = $conn->prepare("UPDATE kategori_lesen SET kategori = ?, description = ? WHERE id = ?");
    $sql->bind_param("sss", $kategori, $description, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Kemaskini gagal: " . $sql->error]);
    }

    $sql->close();
    $conn->close();
}
