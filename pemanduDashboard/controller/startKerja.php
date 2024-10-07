<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $jobsheet_id = intval($_POST['jobsheet_id']);
    $updateStatus = 'dijalankan';

    // First query: Get tempahan_kerja_id based on jobsheet_id
    $sql1 = $conn->prepare("SELECT tempahan_kerja_id FROM jobsheet WHERE jobsheet_id = ?");
    $sql1->bind_param("i", $jobsheet_id);
    
    if (!$sql1->execute()) {
        echo json_encode(["success" => false, "message" => "Error fetching tempahan_kerja_id: " . $sql1->error]);
        $sql1->close();
        $conn->close();
        exit;
    }
    
    $result1 = $sql1->get_result();
    $row1 = $result1->fetch_assoc();
    $tempahan_kerja_id = $row1['tempahan_kerja_id'];
    $sql1->close();

    // Second query: Update the jobsheet status
    $sql2 = $conn->prepare("UPDATE jobsheet SET status_jobsheet = ? WHERE jobsheet_id = ?");
    $sql2->bind_param("si", $updateStatus, $jobsheet_id);
    
    if (!$sql2->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini jobsheet gagal: " . $sql2->error]);
        $sql2->close();
        $conn->close();
        exit;
    }
    $sql2->close();

    // Third query: Update tempahan_kerja status
    $statusKerja = 'dijalankan';  // Set status_kerja value
    $sql3 = $conn->prepare("UPDATE tempahan_kerja SET status_kerja = ? WHERE tempahan_kerja_id = ?");
    $sql3->bind_param("si", $statusKerja, $tempahan_kerja_id);

    if (!$sql3->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan_kerja gagal: " . $sql3->error]);
        $sql3->close();
        $conn->close();
        exit;
    }
    $sql3->close();

    // Closing the connection and returning success message
    $conn->close();
    echo json_encode(["success" => true, "id" => $jobsheet_id]);
}
