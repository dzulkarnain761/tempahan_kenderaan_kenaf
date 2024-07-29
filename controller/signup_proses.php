<?php
include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nokp = $_POST['nokp'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPass'];

    // Basic validation
    if (empty($nokp) || empty($username) || empty($password) || empty($confirmPass)) {
        echo json_encode(["success" => false, "message" => "Sila isi semua maklumat."]);
    } elseif ($password !== $confirmPass) {
        echo json_encode(["success" => false, "message" => "Sila pastikan kata laluan anda."]);
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

            // Insert the user into the database using prepared statement
            $sql = $conn->prepare("INSERT INTO pengguna (no_kp, nama, password) VALUES (?, ?, ?)");
            $sql->bind_param("sss", $nokp, $username, $hashed_password);

            if ($sql->execute() === TRUE) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Error: " . $sql->error]);
            }
        }
    }
}
$conn->close();
?>
