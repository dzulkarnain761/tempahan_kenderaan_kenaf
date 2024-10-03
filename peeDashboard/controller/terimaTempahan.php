<?php
// Include database connection
include 'connection.php'; // Adjust path as needed

$response = array('success' => false, 'message' => ''); // Default response

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $tempahan_kerja_id = $_POST['tempahan_kerja_id'];
    $input_date = $_POST['input_date'];
    $input_hours = $_POST['input_hours'];
    $input_price = $_POST['input_price'];
    $kenderaan_id = $_POST['kenderaan_id']; // This will now be a 2D array
    $pemandu_id = $_POST['pemandu_id']; // This will also be a 2D array
    $tempahan_id = htmlspecialchars($_POST['tempahan_id']); // Retrieve and sanitize tempahan_id

    // Validate input hours
    foreach ($input_hours as $hours) {
        if ($hours < 0.5) {
            $response['message'] = 'Sila masukkan nilai jam yang sah (minimum 0.5 jam).';
            echo json_encode($response);
            exit; // Stop execution if invalid input is found
        }
    }

    // Prepare the update query for `tempahan_kerja`
    $updateKerjaQuery = "UPDATE tempahan_kerja SET jam_anggaran = ?, harga_anggaran = ?, tarikh_kerja_cadangan = ? WHERE tempahan_kerja_id = ?";
    $stmtKerja = $conn->prepare($updateKerjaQuery);

    // Prepare the insert query for `jobsheet`
    $insertJobsheetQuery = "INSERT INTO jobsheet (tempahan_kerja_id, pemandu_id, kenderaan_id) VALUES (?, ?, ?)";
    $stmtJobsheet = $conn->prepare($insertJobsheetQuery);

    if ($stmtKerja && $stmtJobsheet) {
        $success = true;
        $total_harga_anggaran = 0;

        // Iterate over each entry for `tempahan_kerja`
        foreach ($tempahan_kerja_id as $index => $value) {
            $hours = htmlspecialchars($input_hours[$index]);
            $price = htmlspecialchars($input_price[$index]);
            $date = htmlspecialchars($input_date[$index]);
            $total_harga_anggaran += $price;

            // Update `tempahan_kerja`
            $stmtKerja->bind_param('dssi', $hours, $price, $date, $value);
            if (!$stmtKerja->execute()) {
                $success = false;
                $response['message'] = "Error updating record: " . $stmtKerja->error;
                break; // Exit loop if error occurs
            }

            // Insert multiple `jobsheet` entries for this `tempahan_kerja_id`
            foreach ($kenderaan_id[$index] as $jobIndex => $kend_id) {
                $pem_id = htmlspecialchars($pemandu_id[$index][$jobIndex]); // Access corresponding pemandu_id

                // Insert into `jobsheet`
                $stmtJobsheet->bind_param('iii', $value, $pem_id, $kend_id);
                if (!$stmtJobsheet->execute()) {
                    $success = false;
                    $response['message'] = "Error inserting jobsheet: " . $stmtJobsheet->error;
                    break 2; // Exit both loops if error occurs
                }
            }
        }

        if ($success) {
            // Calculate deposit (50% of total price)
            $total_deposit = $total_harga_anggaran / 2;

            // Update the `tempahan` table with the new status and pricing
            $updateTempahanQuery = "UPDATE tempahan SET status_tempahan = ?, total_harga_anggaran = ?, total_deposit = ? WHERE tempahan_id = ?";
            $stmtTempahan = $conn->prepare($updateTempahanQuery);
            if ($stmtTempahan) {
                $status = 'pengesahan kpp'; // Set the status
                $stmtTempahan->bind_param('sddi', $status, $total_harga_anggaran, $total_deposit, $tempahan_id);

                // Execute the statement for `tempahan`
                if ($stmtTempahan->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Kemaskini berjaya.';
                } else {
                    $response['message'] = "Error updating tempahan: " . $stmtTempahan->error;
                }
                $stmtTempahan->close();
            } else {
                $response['message'] = "Error preparing tempahan update statement: " . $conn->error;
            }
        }
    } else {
        $response['message'] = "Error preparing SQL statements: " . $conn->error;
    }

    // Close the prepared statements
    $stmtKerja->close();
    $stmtJobsheet->close();
    // Close the database connection
    $conn->close();
} else {
    $response['message'] = 'Invalid request method';
}

// Return JSON response
echo json_encode($response);
?>
