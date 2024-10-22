<?php

$id = $_SESSION["id"];
if ($stmt = $conn->prepare("SELECT email, nama, no_kp, contact_no FROM admin WHERE id = ?")) {
    $stmt->bind_param("i", $id); // Bind the $id as an integer parameter
    $stmt->execute();
    $stmt->bind_result($email, $nama, $no_kp, $contact_no);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

?>