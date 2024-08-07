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

    $staffID = $_POST['staffIdEdit'];
    $fullname = $_POST['fullnameEdit'];
    $nokp = $_POST['nokpEdit'];
    $contact = $_POST['contactnoEdit'];

    $nokplength = strlen($nokp);
    $contactlength = strlen($contact);


    if (empty($nokp) || empty($fullname) || empty($contact)) {
        echo json_encode(["success" => false, "message" => "fullname : " . $fullname . "nokp: " . $nokp . "contact: " . $contact]);
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



        // Insert the user into the database using prepared statement
        $sql = $conn->prepare("UPDATE pengguna SET nama = ?, no_kp = ?, contact_no = ? WHERE id = ?");
        $sql->bind_param("sssi", $fullname, $nokp, $contact, $staffID);


        if ($sql->execute() === TRUE) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
    }
}
$conn->close();
