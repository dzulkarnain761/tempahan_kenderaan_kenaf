<?php
// Include database connection
include 'connection.php'; // Adjust path as needed


$response = array('success' => false, 'message' => ''); // Default response

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $kerja_id = $_POST['kerja_id'];
    $kenderaan_id = $_POST['kenderaan_id'];
    $pemandu_id = $_POST['pemandu_id'];
    $input_date = $_POST['input_date'];
    $input_hours = $_POST['input_hours'];
    $input_price = $_POST['input_price'];
    $tempahan_id = $_POST['tempahan_id']; // Retrieve tempahan_id
    $statusKerja = 'diterima';

    // Validate data here (e.g., check if arrays have the same length)

    // Prepare the update query for tempahan_kerja
    $updateKerjaQuery = "UPDATE tempahan_kerja SET kenderaan_id = ?, pemandu_id = ?, jam = ?, harga = ?, status_kerja = ?, tarikh_kerja_cadangan = ? WHERE tempahan_kerja_id = ?";
    $stmt = $conn->prepare($updateKerjaQuery);

    if ($stmt) {
        $success = true;
        // Iterate over each entry and bind parameters
        foreach ($kerja_id as $index => $value) {
            $kenderaan_id_value = htmlspecialchars($kenderaan_id[$index]);
            $pemandu_id_value = htmlspecialchars($pemandu_id[$index]);
            $dates = htmlspecialchars($input_date[$index]);
            $hours = htmlspecialchars($input_hours[$index]);
            $price = htmlspecialchars($input_price[$index]);

            $stmt->bind_param('iiidssi', $kenderaan_id_value, $pemandu_id_value, $hours, $price,$statusKerja, $dates, $value);

            // Execute the statement
            if (!$stmt->execute()) {
                $success = false;
                $response['message'] = "Error updating record: " . $stmt->error;
                break; // Exit loop if error occurs
            }
        }
        // Close the statement
        $stmt->close();

        if ($success) {
            // Prepare the update query for tempahan
            $updateTempahanQuery = "UPDATE tempahan SET status = ? WHERE tempahan_id = ?";
            $stmt = $conn->prepare($updateTempahanQuery);

            if ($stmt) {
                $status = 'diterima'; // Set the status value here as needed
                $stmt->bind_param('si', $status, $tempahan_id);

                // Execute the statement
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Kemaskini Berjaya';
                } else {
                    $response['message'] = "Error updating tempahan: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                $response['message'] = "Error preparing tempahan update statement: " . $conn->error;
            }
        }
    } else {
        $response['message'] = "Error preparing tempahan_kerja update statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    $response['message'] = 'Invalid request method';
}

// Return JSON response
echo json_encode($response);
?>
