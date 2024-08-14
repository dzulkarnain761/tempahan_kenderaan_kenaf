<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $fullname = $_POST['nama_pemandu'];
    $nokp = $_POST['no_kp'];
    $contact = $_POST['no_tel'];
    $email = $_POST['email_pemandu'];
    $kategori_lesen = $_POST['kategori_lesen'];
    $tarikh_tamat_lesen = $_POST['tarikh_tamat_lesen'];
    $status_pemandu = $_POST['status_pemandu'];

    $pemanduId = strlen($id);
    
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
    $checkSql = $conn->prepare("SELECT * FROM pemandu WHERE id_pemandu != ? AND no_kp = ?");
    $checkSql->bind_param("ss", $id,$nokp);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "No Kad Pengenalan Sudah Didaftar"]);
        $checkSql->close();
        exit();
    }

    $checkSql->close();

    // Update the user in the database using a prepared statement
    $sql = $conn->prepare("UPDATE pemandu SET nama = ?, no_kp = ?, contact_no = ?, email = ?, kategori_lesen = ?, tarikh_tamat_lesen = ?, status = ? WHERE id_pemandu = ?");
    $sql->bind_param("ssssssss", $fullname, $nokp, $contact, $email, $kategori_lesen, $tarikh_tamat_lesen, $status_pemandu, $id);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal: " . $sql->error]);
    }

    $sql->close();
    $conn->close();
}
