<?php
// Include database connection

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

$response = array('success' => false, 'message' => ''); // Default response

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $tempahan_kerja_id = $_POST['tempahan_kerja_id'];
    $input_date = $_POST['input_date'];
    $input_hours = $_POST['input_hours'];
    $input_minutes = $_POST['input_minutes'];
    $input_price = $_POST['input_price'];
    $pengesahan_pee = $_POST['disahkan_oleh'];
    $tempahan_id = $_POST['tempahan_id']; // Retrieve tempahan_id

    // Validate that all input hours and prices are valid
    foreach ($input_price as $price) {
        if ($price == 0) {
            $response['message'] = 'Sila Masukkan Harga';
            echo json_encode($response);
            exit; // Stop execution if invalid input is found
        }
    }

    // Begin transaction
    $conn->begin_transaction();
    $success = true;
    $total_harga_anggaran = 0;

    try {
        // Prepare the update query for tempahan_kerja
        $updateKerjaQuery = "UPDATE tempahan_kerja SET jam_anggaran = ?, minit_anggaran = ?, harga_anggaran = ?, tarikh_kerja_cadangan = ? WHERE tempahan_kerja_id = ?";
        $stmt = $conn->prepare($updateKerjaQuery);

        if ($stmt) {
            // Iterate over each entry and bind parameters
            foreach ($tempahan_kerja_id as $index => $value) {
                $dates = htmlspecialchars($input_date[$index]);
                $hours = htmlspecialchars($input_hours[$index]);
                $minutes = htmlspecialchars($input_minutes[$index]);
                $price = htmlspecialchars($input_price[$index]);
                $total_harga_anggaran += $price; // Calculate total estimated price

                $stmt->bind_param('iidsi', $hours, $minutes, $price, $dates, $value);

                // Execute the statement
                if (!$stmt->execute()) {
                    throw new Exception("Error updating tempahan_kerja: " . $stmt->error);
                }
            }
            $stmt->close();
        } else {
            throw new Exception("Error preparing tempahan_kerja update statement: " . $conn->error);
        }

        // Prepare the update query for tempahan
        $updateTempahanQuery = "UPDATE tempahan SET total_harga_anggaran = ?, status_tempahan = ?, disahkan_oleh = ? WHERE tempahan_id = ?";
        $stmt = $conn->prepare($updateTempahanQuery);
        $status_tempahan = 'pengesahan kpp';

        if ($stmt) {
            $stmt->bind_param('dssi', $total_harga_anggaran, $status_tempahan, $pengesahan_pee, $tempahan_id);

            // Execute the statement
            if (!$stmt->execute()) {
                throw new Exception("Error updating tempahan: " . $stmt->error);
            }
            $stmt->close();
        } else {
            throw new Exception("Error preparing tempahan update statement: " . $conn->error);
        }

        // Commit the transaction if no errors
        $conn->commit();
        $response['success'] = true;
        $response['message'] = 'Kemaskini Berjaya';

    } catch (Exception $e) {
        // Rollback the transaction if any errors occur
        $conn->rollback();
        $response['message'] = $e->getMessage();
    }

    // Close the database connection
    $conn->close();
} else {
    $response['message'] = 'Invalid request method';
}

// Return JSON response
echo json_encode($response);
