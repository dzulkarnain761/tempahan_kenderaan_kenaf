<?php

include 'connection.php';

if (isset($_POST['tempahan_kerja_id'])) {

    $pemandu_ids = $_POST['pemandu_id'];
    $kenderaan_ids = $_POST['kenderaan_id'];
    $jobsheet_ids = $_POST['jobsheet_id'];
    $tempahan_kerja_id = $_POST['tempahan_kerja_id'];

    // Prepare the SQL statement for updating jobsheet
    $sqlJobsheet = $conn->prepare("UPDATE `jobsheet` SET `kenderaan_id`= ?, `pemandu_id`= ?, `status_jobsheet` = ? WHERE `jobsheet_id` = ? AND `status_jobsheet` NOT IN ('selesai','dijalankan')");

    if ($sqlJobsheet === false) {
        echo json_encode(["success" => false, "message" => "Failed to prepare statement."]);
        $conn->close();
        exit();
    }

    $status_jobsheet = 'dalam proses';

    // Loop through the pemandu_ids, kenderaan_ids, and jobsheet_ids arrays
    foreach ($pemandu_ids as $index => $pemandu_id) {
        $kenderaan_id = $kenderaan_ids[$index]; // Get the corresponding kenderaan_id
        $jobsheet_id = $jobsheet_ids[$index];   // Get the corresponding jobsheet_id

        // Bind the parameters (i = integer, s = string)
        $sqlJobsheet->bind_param("iisi", $kenderaan_id, $pemandu_id, $status_jobsheet, $jobsheet_id);
        // Execute the query
        if (!$sqlJobsheet->execute()) {
            echo json_encode(["success" => false, "message" => "Gagal mendaftar kerja."]);
            $sqlJobsheet->close();
            $conn->close();
            exit();
        }
    }

    // Close the jobsheet statement after the loop
    $sqlJobsheet->close();

    $status_tempahan_kerja = 'dijalankan';

    // Prepare the SQL statement for updating tempahan_kerja
    $sqlTempahanKerja = $conn->prepare("UPDATE `tempahan_kerja` SET `status_kerja` = ? WHERE `tempahan_kerja_id` = ?");

    if ($sqlTempahanKerja === false) {
        echo json_encode(["success" => false, "message" => "Failed to prepare tempahan kerja statement."]);
        $conn->close();
        exit();
    }


    // Bind the parameters for the update
    $sqlTempahanKerja->bind_param("si", $status_tempahan_kerja, $tempahan_kerja_id);

    // Execute the query
    if (!$sqlTempahanKerja->execute()) {
        echo json_encode(["success" => false, "message" => "Gagal mengemaskini tempahan kerja."]);
        $sqlTempahanKerja->close();
        $conn->close();
        exit();
    }

    // Close the tempahan kerja statement
    $sqlTempahanKerja->close();

    // Return success response
    echo json_encode(["success" => true, "message" => "Kerja berjaya didaftarkan."]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

// Close the database connection
$conn->close();
