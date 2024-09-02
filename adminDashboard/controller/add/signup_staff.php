<?php

include '../connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kumpulan = $_POST['kumpulan'];
    $nokp = $_POST['no_kp'];
    $fullname = $_POST['nama_staf'];
    $email = $_POST['email_staff'];
    $contact = $_POST['no_telefon'];
    $negeri_penempatan = $_POST['negeri_penempatan'];

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
    $checkSql = $conn->prepare("SELECT * FROM admin WHERE no_kp = ?");
    $checkSql->bind_param("s", $nokp);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "No Kad Pengenalan Sudah Didaftar"]);
        $checkSql->close();
        exit();
    }

    $checkSql->close();

    $password = substr($nokp, -4);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database using prepared statement
    $sql = $conn->prepare("INSERT INTO admin (nama, no_kp, contact_no, email, kumpulan, negeri, password) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $sql->bind_param("sssssss", $fullname, $nokp, $contact, $email, $kumpulan, $negeri_penempatan, $hashed_password);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sql->close();
    $conn->close();
}
