<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']);

    // Prepare the SELECT query to fetch cara_bayar
    $sqlTempahan = $conn->prepare("SELECT cara_bayar FROM resit_pembayaran WHERE tempahan_id = ? AND jenis_pembayaran = 'bayaran penuh'");
    $sqlTempahan->bind_param("i", $tempahan_id);
    $sqlTempahan->execute();
    $sqlTempahan->bind_result($cara_bayar);
    $sqlTempahan->fetch();
    $sqlTempahan->close();

    // Check the result of cara_bayar
    if ($cara_bayar == 'fpx') {
        $status_tempahan = 'pengesahan jobsheet';
        $status_bayaran = 'selesai bayaran';

        // Prepare the UPDATE query
        $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $sqlUpdateTempahan->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);

        if (!$sqlUpdateTempahan->execute()) {
            echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error]);
            $sqlUpdateTempahan->close();
            $conn->close();
            exit;
        }
        $sqlUpdateTempahan->close();
    } else {
        $status_tempahan = 'penjanaan resit';

        // Prepare the UPDATE query for non-FPX payments
        $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ? WHERE tempahan_id = ?");
        $sqlUpdateTempahan->bind_param("si", $status_tempahan, $tempahan_id);

        if (!$sqlUpdateTempahan->execute()) {
            echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error]);
            $sqlUpdateTempahan->close();
            $conn->close();
            exit;
        }
        $sqlUpdateTempahan->close();
    }

    // Close the connection and return success message
    $conn->close();
    echo json_encode(["success" => true, "message" => "Berjaya"]);
}
