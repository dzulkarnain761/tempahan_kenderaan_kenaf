<?php
require_once '../../Models/Database.php';
$conn = Database::getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nokp']) && !empty($_POST['kataLaluan']) && !empty($_POST['confirmPass'])) {
        
        $nokp = $_POST['nokp'];
        $password = $_POST['kataLaluan'];
        $confirmPass = $_POST['confirmPass'];

        if ($password !== $confirmPass) {
            echo json_encode(["success" => false, "message" => "Sila pastikan Kata Laluan Anda."]);
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to update the password
        $sqlLogin = "UPDATE pengguna SET password = ? WHERE no_kp = ?";
        $stmt = $conn->prepare($sqlLogin);
        
        if ($stmt) {
            $stmt->bind_param('ss', $hashed_password, $nokp);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Kata Laluan Berjaya Ditukar."]);
            } else {
                echo json_encode(["success" => false, "message" => "Kata Laluan Gagal Ditukar."]);
            }
            
            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "SQL error: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Semua medan adalah diperlukan."]);
    }
}

$conn->close();
?>
