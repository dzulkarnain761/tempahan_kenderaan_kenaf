<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($_POST['id']);
    $status1 = 'pengesahan pemandu';
    $status2 = 'deposit selesai';

    // Prepare and execute the first statement
    $sql1 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
    $sql1->bind_param("ssi", $status1, $status2, $id);

    if (!$sql1->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sql1->error]);
        $sql1->close();
        $conn->close();
        exit;
    }
    $sql1->close();

    // $updateStatusKerja = 'dijalankan';
    // $statusKerja = 'tempahan diproses';

    // // Prepare and execute the second statement
    // $sql2 = $conn->prepare("UPDATE tempahan_kerja SET status_kerja = ? WHERE tempahan_id = ? AND status_kerja = ?");
    // $sql2->bind_param("sis", $updateStatusKerja, $id, $statusKerja);

    // if (!$sql2->execute()) {
    //     echo json_encode(["success" => false, "message" => "Kemaskini tempahan_kerja gagal: " . $sql2->error]);
    //     $sql2->close();
    //     $conn->close();
    //     exit;
    // }
    // $sql2->close();

    $conn->close();
    echo json_encode(["success" => true, "id" => $id]);
}
