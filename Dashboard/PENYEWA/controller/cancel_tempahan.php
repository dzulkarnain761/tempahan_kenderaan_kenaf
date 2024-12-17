<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']);
    $status = 'dibatalkan';

    // Prepare and execute the first statement
    $sql1 = $conn->prepare("UPDATE tempahan SET status_bayaran = ?, status_tempahan = ? WHERE tempahan_id = ?");
    $sql1->bind_param("ssi", $status, $status, $tempahan_id);

    if (!$sql1->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sql1->error]);
        $sql1->close();
        $conn->close();
        exit;
    }
    $sql1->close();

    $conn->close();
    echo json_encode(["success" => true , "tempahan_id" => $tempahan_id]);
}
?>
