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
        $contact_no = $userDetails['contact_no'];
    } else {
        echo json_encode(["success" => false, "message" => "Nama atau Nombor Telefon tidak dijumpai."]);
        exit();
    }
} else {
    echo json_encode(["success" => false, "message" => "No Kad Pengenalan tidak dijumpai dalam sesi."]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $no_kp = $_POST['no_kp'];
    $contact_no = $_POST['contact_no'];

    // Validate input (you can add more validation here)
    if (empty($nama) || empty($no_kp) || empty($contact_no)) {
        echo json_encode(["success" => false, "message" => "Sila isi semua medan."]);
        exit();
    }

    // Update the user information
    $sql = "UPDATE penyewa SET nama = ?, contact_no = ? WHERE no_kp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $nama, $contact_no, $no_kp);

    if ($stmt->execute()) {
        $_SESSION['nama_pengguna'] = $nama; // Update session data if necessary
        echo json_encode(["success" => true, "message" => "Maklumat Berjaya Dikemaskini."]);
    } else {
        echo json_encode(["success" => false, "message" => "Maklumat Gagal Dikemaskini."]);
    }

    $stmt->close();
}

$conn->close(); // Close connection at the end

?>
