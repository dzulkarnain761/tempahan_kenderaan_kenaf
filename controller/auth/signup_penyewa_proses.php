<?php

require_once '../../Models/Database.php';
$conn = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nokp = trim($_POST['no_kp']);
    $fullname = trim($_POST['nama_penuh']);
    $contact = trim($_POST['contact_no']);
    $alamat = trim($_POST['alamat']);
    $email = trim($_POST['email']);

    // Convert fullname to uppercase
    $fullname = strtoupper($fullname);

    // Validation
    if (empty($nokp) || !ctype_digit($nokp) || strlen($nokp) !== 12) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Kad Pengenalan Anda"]);
        exit();
    }

    if (empty($contact) || !ctype_digit($contact) || strlen($contact) < 10 || strlen($contact) > 15) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Telefon adalah antara 10 hingga 13 digit sahaja."]);
        exit();
    }

    // Check if nokp already exists
    $checkSql = $conn->prepare("SELECT no_kp FROM penyewa WHERE no_kp = ?");
    if (!$checkSql) {
        echo json_encode(["success" => false, "message" => "Ralat pada penyataan pangkalan data."]);
        exit();
    }

    $checkSql->bind_param("s", $nokp);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "No Kad Pengenalan sudah didaftar."]);
        $checkSql->close();
        exit();
    }
    $checkSql->close();

    // Generate password
    $password = substr($nokp, -4);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $sql = $conn->prepare("INSERT INTO penyewa (nama, no_kp, contact_no, alamat, password) VALUES (?, ?, ?, ?, ?)");
    if (!$sql) {
        echo json_encode(["success" => false, "message" => "Ralat pada penyataan pangkalan data."]);
        exit();
    }

    $sql->bind_param("sssss", $fullname, $nokp, $contact, $alamat, $hashed_password);

    if ($sql->execute()) {
        echo json_encode(["success" => true, "password" => $password]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal. Sila cuba lagi."]);
    }

    $sql->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Permintaan tidak sah."]);
}

?>
