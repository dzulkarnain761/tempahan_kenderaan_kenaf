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
        // Step 4.1: Calculate the total for tempahan_kerja and get the total deposit from tempahan
        $sqlTempahan = $conn->prepare("SELECT total_deposit FROM tempahan WHERE tempahan_id = ?");
        $sqlTempahan->bind_param("s", $tempahan_id);
        $sqlTempahan->execute();
        $sqlTempahan->bind_result($total_deposit);
        $sqlTempahan->fetch();
        $sqlTempahan->close();

        $sqlKerja = $conn->prepare("SELECT SUM(jumlah_bayaran) as total_harga_sebenar FROM tempahan_kerja WHERE tempahan_id = ?");
        $sqlKerja->bind_param("s", $tempahan_id);
        $sqlKerja->execute();
        $sqlKerja->bind_result($total_harga_sebenar);
        $sqlKerja->fetch();
        $sqlKerja->close();

        // Step 4.2: Calculate total_baki
        $total_baki = $total_harga_sebenar - $total_deposit;

        // Step 4.3: Update the tempahan table
        $sql4 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ?, total_harga_sebenar = ?, total_baki = ? WHERE tempahan_id = ?");
        $status_tempahan = 'kerja selesai';
        $status_bayaran = ($total_baki > 0) ? 'belum bayar' : 'selesai';  // Adjust payment status based on balance
        $sql4->bind_param("ssdds", $status_tempahan, $status_bayaran, $total_harga_sebenar, $total_baki, $tempahan_id);

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
