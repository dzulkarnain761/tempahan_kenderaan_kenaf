<?php

include 'connection.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobsheet_id = intval($_POST['jobsheet_id']);
    $tarikh_kerja_dijalankan = $_POST['tarikh_kerja'];
    $jam = intval($_POST['input_hours']);
    $minit = intval($_POST['input_minutes']);
    $harga = floatval($_POST['input_price']);
    $tempahan_kerja_id = intval($_POST['tempahan_kerja_id']); // Assuming tempahan_kerja_id is passed in POST data

    // Validate input fields
    if ($harga == 0.00 || empty($harga)) {
        echo json_encode(["success" => false, "message" => "Pastikan Harga Kosong"]);
        exit; // Stop script execution if validation fails
    }

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Update jobsheet
        $updateQuery = "UPDATE `jobsheet` SET tarikh_kerja_dijalankan = ?, jam = ?, minit = ?, harga = ?, status_jobsheet = 'selesai' WHERE jobsheet_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('siidi', $tarikh_kerja_dijalankan, $jam, $minit, $harga, $jobsheet_id);

        if (!$stmt->execute()) {
            throw new Exception("Gagal Kemaskini Jobsheet");
        }

        // Calculate sums
        $sqlSums = "
            SELECT 
                SUM(jam) AS total_jam, 
                SUM(minit) AS total_minit, 
                SUM(harga) AS total_harga 
            FROM jobsheet 
            WHERE tempahan_kerja_id = ?
        ";
        $stmt = $conn->prepare($sqlSums);
        $stmt->bind_param('i', $tempahan_kerja_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) {
            throw new Exception("Gagal Mendapatkan Jumlah");
        }

        $total_jam = $result['total_jam'];
        $total_minit = $result['total_minit'];
        $total_harga = $result['total_harga'];

        // Convert minutes to hours if total_minit is 60 or more
        if ($total_minit >= 60) {
            $extra_hours = intdiv($total_minit, 60);
            $total_jam += $extra_hours;
            $total_minit %= 60; // Remainder for minutes
        }

        // Update tempahan_kerja
        $updateTempahanKerja = "
            UPDATE tempahan_kerja 
            SET total_jam = ?, total_minit = ?, total_harga = ? 
            WHERE tempahan_kerja_id = ?
        ";
        $stmt = $conn->prepare($updateTempahanKerja);
        $stmt->bind_param('iidi', $total_jam, $total_minit, $total_harga, $tempahan_kerja_id);

        if (!$stmt->execute()) {
            throw new Exception("Gagal Kemaskini Tempahan Kerja");
        }

        // Commit transaction
        $conn->commit();
        echo json_encode(["success" => true, "message" => "Berjaya Kemaskini Jobsheet dan Tempahan Kerja"]);

    } catch (Exception $e) {
        // Rollback transaction if any query fails
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

// Close the connection
$conn->close();

?>
