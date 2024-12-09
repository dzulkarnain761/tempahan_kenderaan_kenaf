<?php

require_once '../../../../Models/Database.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kumpulan = $_POST['kumpulan'];
    $nokp = $_POST['no_kp'];
    $nama_staff = $_POST['nama_staff'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];

    // Convert name to uppercase
    $fullname = strtoupper(trim($nama_staff));

    // Validate No KP
    if (empty($nokp) || !ctype_digit($nokp) || strlen($nokp) < 12) {
        
        echo json_encode(["success" => false, "message" => "Sila pastikan No Kad Pengenalan Adalah Betul."]);
        exit();
    }

    // Validate Contact No
    if (empty($contact_no) || !ctype_digit($contact_no)) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Telefon Adalah Betul."]);
        exit();
    }
   

    // Check if No KP already exists
    $checkSql = $conn->prepare("SELECT id FROM admin WHERE no_kp = ?");
    if ($checkSql === false) {
        echo json_encode(["success" => false, "message" => "Penyataan SQL gagal disediakan."]);
        exit();
    }
    $checkSql->bind_param("s", $nokp);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "No Kad Pengenalan Sudah Didaftar."]);
        $checkSql->close();
        exit();
    }

    $checkSql->close();

    // Generate a password using the last 4 digits of No KP
    $password = substr($nokp, -4);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $sql = $conn->prepare("INSERT INTO admin (nama, no_kp, contact_no, email, kumpulan, password) VALUES (?, ?, ?, ?, ?, ?)");
    if ($sql === false) {
        echo json_encode(["success" => false, "message" => "Penyataan SQL gagal disediakan."]);
        exit();
    }
    $sql->bind_param("ssssss", $fullname, $nokp, $contact_no, $email, $kumpulan, $hashed_password);

    if ($sql->execute()) {
        echo json_encode(["success" => true, "message" => "Pendaftaran berjaya."]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sql->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Permintaan tidak sah."]);
}
?>
