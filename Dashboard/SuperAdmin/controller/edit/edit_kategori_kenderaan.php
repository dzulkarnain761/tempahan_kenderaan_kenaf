<?php

include '../connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $kategori_kenderaan = $_POST['kategori_kenderaan'];

    // Update the user in the database using a prepared statement
    $sql = $conn->prepare("UPDATE kategori_kenderaan SET kategori= ? WHERE id = ?");
    $sql->bind_param("ss", $kategori_kenderaan, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal: " . $sql->error]);
    }

    $sql->close();
    $conn->close();
}
