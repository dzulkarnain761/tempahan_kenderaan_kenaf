<?php

require_once '../../Models/Database.php';
$conn = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nokp = trim($_POST['nokp']);
    $fullname = trim($_POST['fullname']);
    $contact = trim($_POST['contactno']);
    $alamat = trim($_POST['alamat']);

    // Convert fullname to uppercase
    $fullname = strtoupper($fullname);

    // Validation
    if (empty($nokp) || !ctype_digit($nokp) || strlen($nokp) !== 12) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Kad Pengenalan Anda adalah 12 digit."]);
        exit();
    }

    if (empty($fullname)) {
        echo json_encode(["success" => false, "message" => "Nama penuh diperlukan."]);
        exit();
    }

    if (empty($contact) || !ctype_digit($contact) || strlen($contact) < 10 || strlen($contact) > 15) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Telefon adalah antara 10 hingga 15 digit."]);
        exit();
    }

    if (empty($alamat)) {
        echo json_encode(["success" => false, "message" => "Alamat diperlukan."]);
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
