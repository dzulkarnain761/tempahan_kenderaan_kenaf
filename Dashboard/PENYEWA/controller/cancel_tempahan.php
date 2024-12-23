<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']);
    $sebab_ditolak = $_POST['sebab_ditolak'];
    $status = 'dibatalkan';

    // Prepare and execute the first statement
    $sql1 = $conn->prepare("UPDATE tempahan SET status_bayaran = ?, status_tempahan = ?, catatan = ? WHERE tempahan_id = ?");
    $sql1->bind_param("sssi", $status, $status, $sebab_ditolak, $tempahan_id);

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
