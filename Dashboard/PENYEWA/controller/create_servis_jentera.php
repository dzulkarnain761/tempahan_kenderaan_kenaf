<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert into table tempahan
        $penyewa_id = $_POST['penyewa_id'];
        $lokasi_tanah = $_POST['lokasi_tanah'];
        $luas_tanah = $_POST['luas_tanah'];
        $catatan = $_POST['catatan'];

        // Prepare the query for inserting into tempahan table
        $sqlTempahan = $conn->prepare("INSERT INTO tempahan (`penyewa_id`, `lokasi_tanah`, `luas_tanah`, `catatan`) VALUES (?, ?, ?, ?)");
        if (!$sqlTempahan) {
            throw new Exception("Failed to prepare statement for tempahan: " . $conn->error);
        }

        $sqlTempahan->bind_param("isss", $penyewa_id, $lokasi_tanah, $luas_tanah, $catatan);

        if (!$sqlTempahan->execute()) {
            throw new Exception("Failed to execute tempahan query: " . $sqlTempahan->error);
        }

        // Get the last inserted ID from tempahan table
        $tempahan_id = $conn->insert_id;

        // Prepare the second query
        $sqlKerja = $conn->prepare("INSERT INTO tempahan_kerja (`tempahan_id`, `nama_kerja`, `cadangan_tarikh_kerja`) VALUES (?, ?, ?)");
        if (!$sqlKerja) {
            throw new Exception("Failed to prepare statement for kerja: " . $conn->error);
        }

        $tugasans = $_POST['tugasan'];
        $cadangan_tarikh_kerja = $_POST['cadangan_tarikh_kerja'];

        if (!is_array($tugasans) || !is_array($cadangan_tarikh_kerja) || count($tugasans) !== count($cadangan_tarikh_kerja)) {
            throw new Exception("Invalid input: 'tugasan' and 'cadangan_tarikh_kerja' must be arrays of the same length.");
        }

        // Loop through the tugasans and corresponding dates
        for ($i = 0; $i < count($tugasans); $i++) {
            $nama_kerja = $tugasans[$i];
            $tarikh_kerja = $cadangan_tarikh_kerja[$i];

            $sqlKerja->bind_param("iss", $tempahan_id, $nama_kerja, $tarikh_kerja);

            if (!$sqlKerja->execute()) {
                throw new Exception("Failed to execute kerja query: " . $sqlKerja->error);
            }
        }

        // Commit the transaction
        $conn->commit();

        echo json_encode(["success" => true]);

        $sqlKerja->close(); // Close after loop
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();

        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }

    $sqlTempahan->close();
    $conn->close();
}

?>
