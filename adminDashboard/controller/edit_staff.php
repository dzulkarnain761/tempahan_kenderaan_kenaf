<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $kumpulan = $_POST['kumpulan'];
    $nokp = $_POST['no_kp'];
    $fullname = $_POST['nama_staf'];
    $contact = $_POST['no_telefon'];

    $staffID = strlen($id);
    $fullname = strtoupper($fullname);

    if (empty($nokp) || !ctype_digit($nokp)) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Kad Pengenalan Anda."]);
        exit();
    }

    if (empty($contact) || !ctype_digit($contact)) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Telefon Anda."]);
        exit();
    }

    // Check if nokp already exists in the database using prepared statement
    // $checkSql = $conn->prepare("SELECT * FROM pengguna WHERE no_kp = ?");
    // $checkSql->bind_param("s", $nokp);
    // $checkSql->execute();
    // $result = $checkSql->get_result();

    // if ($result->num_rows > 0) {
    //     echo json_encode(["success" => false, "message" => "No Kad Pengenalan Sudah Didaftar"]);
    //     $checkSql->close();
    //     exit();
    // }

    // $checkSql->close();

    // Insert the user into the database using prepared statement
    $sql = $conn->prepare("UPDATE pengguna SET nama = ?, no_kp = ?, contact_no = ?, kumpulan = ? WHERE id = ?");
    $sql->bind_param("sssss", $fullname, $nokp, $contact, $kumpulan, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sql->close();
    $conn->close();
}
