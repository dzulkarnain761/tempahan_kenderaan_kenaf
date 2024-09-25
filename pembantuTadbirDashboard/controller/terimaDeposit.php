<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($_POST['id']);

    // Retrieve total deposit and payment method
    $sqlTempahan = "SELECT cara_bayaran, total_deposit FROM tempahan WHERE tempahan_id = ?";
    $stmtTempahan = $conn->prepare($sqlTempahan);
    $stmtTempahan->bind_param("i", $id);
    $stmtTempahan->execute();
    $resultTempahan = $stmtTempahan->get_result();

    if ($rowTempahan = $resultTempahan->fetch_assoc()) {
        $cara_bayaran = $rowTempahan['cara_bayaran'];
        $total_deposit = $rowTempahan['total_deposit'];
    } else {
        // Tempahan not found
        echo json_encode(["success" => false, "message" => "Tempahan tidak dijumpai"]);
        $stmtTempahan->close();
        $conn->close();
        exit;
    }
    $stmtTempahan->close();

    // Insert into resit_pembayaran only if cara_bayaran is 'tunai'
    if ($cara_bayaran == 'tunai') {
        $sqlResit = $conn->prepare("INSERT INTO resit_pembayaran (tempahan_id, jenis_pembayaran, jumlah, cara_pembayaran) VALUES (?, ?, ?, ?)");
        $jenis_pembayaran = 'deposit'; // Payment type is deposit
        $sqlResit->bind_param("isds", $id, $jenis_pembayaran, $total_deposit, $cara_bayaran);

        if (!$sqlResit->execute()) {
            echo json_encode(["success" => false, "message" => "Kemaskini resit gagal: " . $sqlResit->error]);
            $sqlResit->close();
            $conn->close();
            exit;
        }
        $sqlResit->close();
    }

    // Update tempahan status and payment status
    $status_tempahan = 'pengesahan pemandu';
    $status_bayaran = 'deposit selesai';

    $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
    $sqlUpdateTempahan->bind_param("ssi", $status_tempahan, $status_bayaran, $id);

    if (!$sqlUpdateTempahan->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error]);
        $sqlUpdateTempahan->close();
        $conn->close();
        exit;
    }
    $sqlUpdateTempahan->close();

    // Close the connection and return success message
    $conn->close();
    echo json_encode(["success" => true, "message" => "Deposit berjaya diproses", "id" => $id]);
}
