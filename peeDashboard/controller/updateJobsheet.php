<?php

include 'connection.php';

if (isset($_POST['tempahan_kerja_id'])) {
    
    $pemandu_ids = $_POST['pemandu_id'];
    $kenderaan_ids = $_POST['kenderaan_id'];
    $jobsheet_ids = $_POST['jobsheet_id']; 

    // Prepare the SQL statement
    $sqlJobsheet = $conn->prepare("UPDATE `jobsheet` SET `kenderaan_id`= ?, `pemandu_id`= ?, status_jobsheet = ? WHERE `jobsheet_id` = ?");

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

        // Bind the parameters (i = integer)
        $sqlJobsheet->bind_param("iisi", $kenderaan_id, $pemandu_id, $status_jobsheet, $jobsheet_id );
        // Execute the query
        if (!$sqlJobsheet->execute()) {
            echo json_encode(["success" => false, "message" => "Gagal mendaftar kerja."]);
            $sqlJobsheet->close();
            $conn->close();
            exit();
        }
    }

    // Close the statement after the loop
    $sqlJobsheet->close();
    
    echo json_encode(["success" => true, "message" => "Kerja berjaya didaftarkan."]);

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
