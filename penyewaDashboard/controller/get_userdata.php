<?php




$user_id = $_SESSION["id"];
if ($stmt = $conn->prepare("SELECT nama, no_kp, contact_no, nama_bank, no_bank, alamat, email FROM penyewa WHERE id = ?")) {
    $stmt->bind_param("i", $user_id); // Bind the $id as an integer parameter
    $stmt->execute();
    $stmt->bind_result($nama, $no_kp, $contact_no,$nama_bank, $no_bank, $alamat, $email);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

?>