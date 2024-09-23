<?php

include 'connection.php';

if (isset($_POST['id'])) {
    $kerjaId = intval($_POST['id']); // Get the kerja ID from POST data
    $statusKerja = 'dibatalkan';

    // Step 1: Get the tempahan_id of the current tempahan_kerja
    $sql1 = $conn->prepare("SELECT tempahan_id FROM tempahan_kerja WHERE tempahan_kerja_id = ?");
    $sql1->bind_param("i", $kerjaId); // Change to 'i' since kerjaId is an integer
    $sql1->execute();
    $sql1->bind_result($tempahan_id);
    $sql1->fetch();
    $sql1->close();

    // Step 2: Update the current tempahan_kerja
    $sql2 = $conn->prepare("UPDATE tempahan_kerja SET status_kerja = ? WHERE tempahan_kerja_id = ?");
    $sql2->bind_param("si", $statusKerja, $kerjaId);

    if (!$sql2->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan_kerja gagal: " . $sql2->error]);
        $sql2->close();
        $conn->close();
        exit;
    }
    $sql2->close();

    // Step 3: Check if all tempahan_kerja with the same tempahan_id have the status ditolak or dibatalkan
    $sql3 = $conn->prepare("SELECT COUNT(*) FROM tempahan_kerja WHERE tempahan_id = ? AND (status_kerja != 'dibatalkan' AND status_kerja != 'ditolak')");
    $sql3->bind_param("i", $tempahan_id); // Change to 'i' since tempahan_id is expected to be an integer
    $sql3->execute();
    $sql3->bind_result($remaining_jobs);
    $sql3->fetch();
    $sql3->close();

    // Step 4: If all tempahan_kerja are 'selesai', update the tempahan table
    if ($remaining_jobs == 0) {
        // Step 4.3: Update the tempahan table
        $sql4 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $status = 'dibatalkan';
        
        $sql4->bind_param("ssi", $status,$status, $tempahan_id); // Change to 'i' for tempahan_id

        if (!$sql4->execute()) {
            echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sql4->error]);
            $sql4->close();
            $conn->close();
            exit;
        }
        $sql4->close();
    }

    $conn->close();
    echo json_encode(["success" => true, "id" => $kerjaId]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
