<?php

require_once '../../../Models/Database.php';

try {
    $conn = Database::getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and sanitize inputs
        $jobsheet_id = filter_input(INPUT_POST, 'jobsheet_id', FILTER_VALIDATE_INT);
        $kenderaan_id = filter_input(INPUT_POST, 'kenderaan_id', FILTER_VALIDATE_INT);
        $pemandu_id = filter_input(INPUT_POST, 'pemandu_id', FILTER_VALIDATE_INT);

        // Check for required fields
        if ($jobsheet_id === false || $kenderaan_id === false || $pemandu_id === false) {
            echo json_encode(["success" => false, "message" => "Input tidak sah atau kosong."]);
            exit;
        }

        // Prepare the SQL update query
        $updateQuery = "UPDATE `jobsheet` SET kenderaan_id = ?, pemandu_id = ?, status_jobsheet = 'dijalankan' WHERE jobsheet_id = ?";
        $stmt = $conn->prepare($updateQuery);

        if ($stmt === false) {
            throw new Exception("Penyediaan penyataan gagal: " . $conn->error);
        }

        $stmt->bind_param('iii', $kenderaan_id, $pemandu_id, $jobsheet_id);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Berjaya Kemaskini Jobsheet"]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal Kemaskini Jobsheet: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Kaedah permintaan tidak sah."]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Ralat: " . $e->getMessage()]);
} finally {
    // Ensure the database connection is closed
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
