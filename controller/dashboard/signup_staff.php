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
    $kumpulan = $_POST['kumpulan'];
    $nokp = $_POST['nokp'];
    $fullname = $_POST['fullname'];
    $contact = $_POST['contactno'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPass'];

    $nokplength = strlen($nokp);
    $contactlength = strlen($contact);


    if (empty($nokp) || empty($fullname) || empty($contact) || empty($password) || empty($confirmPass)) {
        echo json_encode(["success" => false, "message" => "Sila Isi Semua Maklumat."]);
    } elseif ($password !== $confirmPass) {
        echo json_encode(["success" => false, "message" => "Sila pastikan Kata Laluan Anda."]);
    } elseif ($nokplength < 14) {
        echo json_encode(["success" => false, "message" => "Sila Pastikan No Kad Pengenalan"]);
    } elseif ($contactlength < 11) {
        echo json_encode(["success" => false, "message" => "Sila Pastikan No Telefon Anda"]);
    } else {
        // Check if nokp already exists in the database using prepared statement
        $checkSql = $conn->prepare("SELECT * FROM pengguna WHERE no_kp = ?");
        $checkSql->bind_param("s", $nokp);
        $checkSql->execute();
        $result = $checkSql->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(["success" => false, "message" => "No Kad Pengenalan Sudah Didaftar"]);
        } else {

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $email = '';
            // Insert the user into the database using prepared statement
            $sql = $conn->prepare("INSERT INTO pengguna (nama, no_kp, email, contact_no, kumpulan, password) VALUES (?, ?, ?, ?, ?, ?)");
            $sql->bind_param("ssssss", $fullname, $nokp, $email, $contact, $kumpulan, $hashed_password);

            if ($sql->execute() === TRUE) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false]);
            }
        }
    }
}
$conn->close();
