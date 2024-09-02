<?php

include '../connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $kumpulan = $_POST['kumpulan'];
    $fullname = $_POST['nama_staf'];
    $contact = $_POST['no_telefon'];
    $email = $_POST['email_staff'];
    $negeri_penempatan = $_POST['negeri_penempatan'];

    $staffID = strlen($id);
    $fullname = strtoupper($fullname);

    // if (empty($nokp) || !ctype_digit($nokp)) {
    //     echo json_encode(["success" => false, "message" => "Sila pastikan No Kad Pengenalan Anda."]);
    //     exit();
    // }

    if (empty($contact) || !ctype_digit($contact)) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Telefon Anda."]);
        exit();
    }

    // Check if nokp already exists in the database using prepared statement
    // $checkSql = $conn->prepare("SELECT * FROM admin WHERE id != ? AND no_kp = ?");
    // $checkSql->bind_param("ss",$id,$nokp);
    // $checkSql->execute();
    // $result = $checkSql->get_result();

    // if ($result->num_rows > 0) {
    //     echo json_encode(["success" => false, "message" => "No Kad Pengenalan Sudah Didaftar"]);
    //     $checkSql->close();
    //     exit();
    // }

    // $checkSql->close();

    // Insert the user into the database using prepared statement
    $sql = $conn->prepare("UPDATE admin SET nama = ?, contact_no = ?,email = ?, kumpulan = ?, negeri = ? WHERE id = ?");
    $sql->bind_param("ssssss", $fullname, $contact, $email, $kumpulan, $negeri_penempatan, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sql->close();
    $conn->close();
}
