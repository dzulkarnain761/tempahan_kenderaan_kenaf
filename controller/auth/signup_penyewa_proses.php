<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    //   die("Connection failed: " . mysqli_connect_error());
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nokp = $_POST['nokp'];
    $fullname = $_POST['fullname'];
    $contact = $_POST['contactno'];
    $password = $_POST['kataLaluan'];
    $confirmPass = $_POST['confirmPass'];

    $fullname = strtoupper($fullname);

    if (empty($nokp) || !ctype_digit($nokp)) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Kad Pengenalan Anda."]);
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
    $group = 'X'; // Define the group value
    $sql->bind_param("sssss", $fullname, $nokp, $contact, $group, $hashed_password);

    if ($sql->execute() === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
    }

    $sql->close();
    $conn->close();
}

?>