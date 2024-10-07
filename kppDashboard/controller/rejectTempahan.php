<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $status = 'ditolak';

    // Prepare and execute the first statement
    $sql1 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
    $sql1->bind_param("sss", $status, $status, $id);

    if (!$sql1->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sql1->error]);
        $sql1->close();
        $conn->close();
        exit;
    }
    $sql1->close();

    // Prepare and execute the second statement
    $sql2 = $conn->prepare("UPDATE tempahan_kerja SET status_kerja = ? WHERE tempahan_id = ?");
    $sql2->bind_param("ss", $status, $id);

    if (!$sql2->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan_kerja gagal: " . $sql2->error]);
        $sql2->close();
        $conn->close();
        exit;
    }
    $sql2->close();

    // Retrieve tempahan_kerja_id where tempahan_id matches and put it in an array
    $sql3 = $conn->prepare("SELECT tempahan_kerja_id FROM tempahan_kerja WHERE tempahan_id = ?");
    $sql3->bind_param("s", $id);

    if (!$sql3->execute()) {
        echo json_encode(["success" => false, "message" => "Gagal mendapatkan tempahan_kerja_id: " . $sql3->error]);
        $sql3->close();
        $conn->close();
        exit;
    }

    $result = $sql3->get_result();
    $tempahan_kerja_ids = [];
    while ($row = $result->fetch_assoc()) {
        $tempahan_kerja_ids[] = $row['tempahan_kerja_id'];
    }
    $sql3->close();

    // Check if any tempahan_kerja_ids were retrieved
    if (count($tempahan_kerja_ids) > 0) {
        // Convert array to a comma-separated string for the SQL query
        $ids_placeholder = implode(",", array_fill(0, count($tempahan_kerja_ids), '?'));

        // Prepare and execute the delete for the jobsheet table
        $sql4 = $conn->prepare("DELETE FROM jobsheet WHERE tempahan_kerja_id IN ($ids_placeholder)");

        // Create an array with only the tempahan_kerja_ids
        $types = str_repeat('s', count($tempahan_kerja_ids)); // for the IDs
        $sql4->bind_param($types, ...$tempahan_kerja_ids);

        if (!$sql4->execute()) {
            echo json_encode(["success" => false, "message" => "Padam jobsheet gagal: " . $sql4->error]);
            $sql4->close();
            $conn->close();
            exit;
        }
        $sql4->close();
    }

    $conn->close();
    echo json_encode(["success" => true]);
}

?>
