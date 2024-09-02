<?php

include 'db-connect.php';

session_start();

if (!isset($_SESSION["pengguna_id"]) ) {
    header("Location: login.php");
    exit();
}

// Function to get the user's name and contact number by no_kp
function getUserDetailsById($conn, $no_kp) {
    $sql = "SELECT nama, contact_no FROM penyewa WHERE no_kp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $no_kp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Return an associative array with the user's details
    } else {
        return null;
    }
}

// Automatically detect no_kp from the session
if (isset($_SESSION['pengguna_id'])) {
    $no_kp = $_SESSION['pengguna_id'];
    $userDetails = getUserDetailsById($conn, $no_kp);

    if ($userDetails) {
        $nama = $userDetails['nama'];
    } else {
        echo json_encode(["success" => false, "message" => "Nama tidak dijumpai."]);
        exit();
    }
} else {
    echo json_encode(["success" => false, "message" => "No Kad Pengenalan tidak dijumpai dalam sesi."]);
    exit();
}

$conn->close(); // Close connection at the end
?>