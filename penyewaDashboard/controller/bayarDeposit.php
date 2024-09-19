<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($_POST['id']);
    $status = 'deposit diproses';

    // Retrieve total deposit
    $sqlTempahan = "SELECT total_deposit FROM tempahan WHERE tempahan_id = $id";
    $resultTempahan = mysqli_query($conn, $sqlTempahan);
    $rowTempahan = mysqli_fetch_assoc($resultTempahan);

    if (!$rowTempahan) {
        echo json_encode(["success" => false, "message" => "Tempahan tidak dijumpai"]);
        $conn->close();
        exit;
    }

    $total_deposit = $rowTempahan['total_deposit'];
    $jenis_pembayaran = 'deposit';
    $cara_pembayaran = 'online banking';

    // Prepare and execute the first statement for resit_pembayaran
    $sqlResit = $conn->prepare("INSERT INTO resit_pembayaran(tempahan_id, jenis_pembayaran, jumlah, cara_pembayaran) VALUES (?, ?, ?, ?)");
    $sqlResit->bind_param("isds", $id, $jenis_pembayaran, $total_deposit, $cara_pembayaran);

    if (!$sqlResit->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini resit gagal: " . $sqlResit->error]);
        $sqlResit->close();
        $conn->close();
        exit;
    }
    $sqlResit->close();

    // Prepare and execute the update for tempahan status
    $sql1 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
    $sql1->bind_param("ssi", $status, $status, $id);

    if (!$sql1->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sql1->error]);
        $sql1->close();
        $conn->close();
        exit;
    }
    $sql1->close();

    $conn->close();
    echo json_encode(["success" => true, "id" => $id]);
}
?>
