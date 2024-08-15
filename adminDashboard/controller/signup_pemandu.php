<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['nama_pemandu'];
    $nokp = $_POST['no_kp'];
    $contact = $_POST['no_tel'];
    $email = $_POST['email_pemandu'];
    $kategori_lesen = $_POST['kategori_lesen'];
    $tarikh_tamat_lesen = $_POST['tarikh_tamat_lesen'];
    $status_pemandu = $_POST['status_pemandu'];
    $password = $_POST['kata_laluan'];
    $confirmPass = $_POST['sahkan_kata_laluan'];


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
    $checkSql = $conn->prepare("SELECT * FROM pemandu WHERE no_kp = ?");
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

    // Prepare an SQL statement for execution
    $sql = $conn->prepare("INSERT INTO pemandu (nama, no_kp, contact_no, email, kategori_lesen, tarikh_tamat_lesen, status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind variables to the prepared statement as parameters
    $sql->bind_param("ssssssss", $fullname, $nokp, $contact, $email, $kategori_lesen, $tarikh_tamat_lesen, $status_pemandu, $hashed_password);


    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sql->close();
    $conn->close();
}
