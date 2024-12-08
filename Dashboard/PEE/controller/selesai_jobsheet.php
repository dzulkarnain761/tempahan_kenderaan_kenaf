<?php

require_once '../../../Models/Database.php';

$conn = Database::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $jobsheet_id = intval($_POST['jobsheet_id']);
    $tarikh_kerja_dijalankan = $_POST['tarikh_kerja_dijalankan'];
    $jam = intval($_POST['input_hours']);
    $minit = intval($_POST['input_minutes']);
    $harga = floatval($_POST['input_price']);
    $tempahan_id = intval($_POST['tempahan_id']);
    $tempahan_kerja_id = intval($_POST['tempahan_kerja_id']);

    // Validate input fields
    if ($harga == 0.00 || empty($harga)) {
        echo json_encode(["success" => false, "message" => "Pastikan Harga Tidak Kosong"]);
        exit();
    }

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Update jobsheet
        $updateQuery = "UPDATE `jobsheet` SET tarikh_kerja_dijalankan = ?, jam = ?, minit = ?, harga = ?, status_jobsheet = 'selesai' WHERE jobsheet_id = ?";
        $stmt = $conn->prepare($updateQuery);

        if ($stmt === false) {
            throw new Exception("Failed to prepare jobsheet update query.");
        }

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

        if ($stmt === false) {
            throw new Exception("Failed to prepare jobsheet sum query.");
        }

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

        if ($stmt === false) {
            throw new Exception("Failed to prepare tempahan_kerja update query.");
        }

        $stmt->bind_param('iidi', $total_jam, $total_minit, $total_harga, $tempahan_kerja_id);

        if (!$stmt->execute()) {
            throw new Exception("Gagal Kemaskini Tempahan Kerja");
        }

        // Commit transaction
        $conn->commit();
        echo json_encode(["success" => true, "message" => "Berjaya Kemaskini Jobsheet", "tempahan_id" => $tempahan_id, "tempahan_kerja_id" => $tempahan_kerja_id]);
        exit();

    } catch (Exception $e) {
        // Rollback transaction if any query fails
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
        exit();
    } finally {
        // Close the statement if it exists
        if (isset($stmt)) {
            $stmt->close();
        }
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
    exit();
}

// Close the connection
$conn->close();

?>
