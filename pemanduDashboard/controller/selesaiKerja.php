<?php
include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['tempahan_kerja_id'];
    $status = 'selesai';
    $masa_mula = $_POST['masa_mula'];
    $masa_akhir = $_POST['masa_akhir'];
    $jumlah_jam = $_POST['jumlah_jam'];
    $jumlah_bayaran = $_POST['jumlah_bayaran'];

    // Step 1: Get the tempahan_id of the current tempahan_kerja
    $sql1 = $conn->prepare("SELECT tempahan_id FROM tempahan_kerja WHERE tempahan_kerja_id = ?");
    $sql1->bind_param("s", $id);
    $sql1->execute();
    $sql1->bind_result($tempahan_id);
    $sql1->fetch();
    $sql1->close();

    // Step 2: Update the current tempahan_kerja
    $sql2 = $conn->prepare("UPDATE tempahan_kerja SET status_kerja = ?, masa_mula_odometer = ?, masa_akhir_odometer = ?, jumlah_jam = ?, jumlah_bayaran = ? WHERE tempahan_kerja_id = ?");
    $sql2->bind_param("sssdds", $status, $masa_mula, $masa_akhir, $jumlah_jam, $jumlah_bayaran, $id);

    if (!$sql2->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan_kerja gagal: " . $sql2->error]);
        $sql2->close();
        $conn->close();
        exit;
    }
    $sql2->close();

    // Step 3: Check if all tempahan_kerja with the same tempahan_id have the status 'selesai'
    $sql3 = $conn->prepare("SELECT COUNT(*) FROM tempahan_kerja WHERE tempahan_id = ? AND status_kerja != 'selesai'");
    $sql3->bind_param("s", $tempahan_id);
    $sql3->execute();
    $sql3->bind_result($remaining_jobs);
    $sql3->fetch();
    $sql3->close();

    // Step 4: If all tempahan_kerja are 'selesai', update the tempahan table
    if ($remaining_jobs == 0) {
        $sql4 = $conn->prepare("UPDATE tempahan SET status = ? WHERE tempahan_id = ?");
        $selesai_status = 'selesai';
        $sql4->bind_param("si", $selesai_status, $tempahan_id);
        if (!$sql4->execute()) {
            echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sql4->error]);
            $sql4->close();
            $conn->close();
            exit;
        }
        $sql4->close();
    }

    $conn->close();
    echo json_encode(["success" => true, "id" => $id]);
}
?>
