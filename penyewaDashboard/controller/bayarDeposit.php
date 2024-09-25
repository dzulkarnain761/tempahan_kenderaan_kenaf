<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Safely handle input
    $id = intval($_POST['id']);
    $cara_bayar = $_POST['cara_bayaran'];

    // Retrieve total deposit
    $sqlTempahan = "SELECT total_deposit FROM tempahan WHERE tempahan_id = ?";
    $stmtTempahan = $conn->prepare($sqlTempahan);
    $stmtTempahan->bind_param("i", $id);
    $stmtTempahan->execute();
    $resultTempahan = $stmtTempahan->get_result();

    if ($rowTempahan = $resultTempahan->fetch_assoc()) {
        $total_deposit = $rowTempahan['total_deposit'];
    } else {
        echo json_encode(["success" => false, "message" => "Tempahan tidak dijumpai"]);
        $stmtTempahan->close();
        $conn->close();
        exit;
    }
    $stmtTempahan->close();

    // If the payment method is 'atas talian', insert into resit_pembayaran
    if ($cara_bayar == 'atas talian') {

        // Prepare and execute the first statement for resit_pembayaran
        $sqlResit = $conn->prepare("INSERT INTO resit_pembayaran(tempahan_id, jenis_pembayaran, jumlah, cara_pembayaran) VALUES (?, ?, ?, ?)");
        $jenis_pembayaran = 'deposit'; // Define the jenis_pembayaran
        $sqlResit->bind_param("isds", $id, $jenis_pembayaran, $total_deposit, $cara_bayar);

        if (!$sqlResit->execute()) {
            echo json_encode(["success" => false, "message" => "Kemaskini resit gagal: " . $sqlResit->error]);
            $sqlResit->close();
            $conn->close();
            exit;
        }
        $sqlResit->close();
    }

    // Prepare and execute the update for tempahan status
    $status = 'deposit diproses';
    $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ?, cara_bayaran = ? WHERE tempahan_id = ?");
    $sqlUpdateTempahan->bind_param("sssi", $status, $status, $cara_bayar, $id);

    if (!$sqlUpdateTempahan->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error]);
        $sqlUpdateTempahan->close();
        $conn->close();
        exit;
    }
    $sqlUpdateTempahan->close();

    // Close the connection and return success
    $conn->close();

    if($cara_bayar == 'atas talian'){
        echo json_encode(['success' => true, 'message' => 'Deposit Akan Diproses']);
    }else{
        echo json_encode(['success' => true, 'message' => 'Sila Bayar Deposit Di Kaunter LKTN Sebelum Tarikh Akhir']);
    }
    
}
