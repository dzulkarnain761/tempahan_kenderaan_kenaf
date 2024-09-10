<?php

session_start();

if (!isset($_SESSION["id"])) {
    header("Location: ../login.php");
    exit();
}

$id = $_SESSION["id"];
if ($stmt = $conn->prepare("SELECT nama, no_kp, contact_no FROM penyewa WHERE id = ?")) {
    $stmt->bind_param("i", $id); // Bind the $id as an integer parameter
    $stmt->execute();
    $stmt->bind_result($nama, $no_kp, $contact_no);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

?>