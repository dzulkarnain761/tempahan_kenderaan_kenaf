<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($_POST['id']);
    $status = 'bayaran deposit';

    // Prepare and execute the first statement
    $sql1 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
    $sql1->bind_param("ssi", $status,$status, $id);

    if (!$sql1->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sql1->error]);
        $sql1->close();
        $conn->close();
        exit;
    }
    $sql1->close();

    $conn->close();
    echo json_encode(["success" => true , "id" => $id]);
}
?>
