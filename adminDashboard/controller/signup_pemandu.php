<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // $kumpulan = $_POST['kumpulan'];
    $noKp = $_POST['noKp'];
    $fullName = $_POST['namaStaf'];
    $contact = $_POST['noTelefon'];
    $password = $_POST['kataLaluan'];
    $confirmPass = $_POST['sahkanKataLaluan'];


    $fullname = strtoupper($fullname);

    if (empty($nokp) || !ctype_digit($nokp)) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Kad Pengenalan Anda."]);
        exit();
    }

    if (empty($contact) || !ctype_digit($contact)) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Telefon Anda."]);
        exit();
    }

    if ($password !== $confirmPass) {
        echo json_encode(["success" => false, "message" => "Sila pastikan Kata Laluan Anda."]);
        exit();
    }

    // Check if nokp already exists in the database using prepared statement
    $checkSql = $conn->prepare("SELECT * FROM pengguna WHERE no_kp = ?");
    $checkSql->bind_param("s", $nokp);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "No Kad Pengenalan Sudah Didaftar"]);
        $checkSql->close();
        exit();
    }

    $checkSql->close();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database using prepared statement
    $sql = $conn->prepare("INSERT INTO pengguna (nama, no_kp, contact_no, kumpulan, password) VALUES (?, ?, ?, ?, ?)");
    $kumpulan = 'Y';
    $sql->bind_param("sssss", $fullname, $nokp, $contact, $kumpulan, $hashed_password);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sql->close();
    $conn->close();
}
