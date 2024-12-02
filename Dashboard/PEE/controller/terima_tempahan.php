<?php
require_once '../../../Models/Database.php';
require_once '../../../Models/Tempahan.php';
require_once '../../../Models/Kerja.php';


$response = array('success' => false, 'message' => ''); // Default response

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $tempahan_kerja_id = $_POST['tempahan_kerja_id'];
    $input_date = $_POST['input_date'];
    $input_hours = $_POST['input_hours'];
    $input_minutes = $_POST['input_minutes'];
    $input_price = $_POST['input_price'];
    $pengesahan_pee = $_POST['pengesahan_pee'];
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
    $conn = Database::getConnection();
    $conn->begin_transaction();
    $success = true;
    $total_harga_anggaran = 0;

    try {
        // Create Kerja instance
        $kerja = new Kerja();

        // Iterate over each entry and update
        foreach ($tempahan_kerja_id as $index => $value) {
            $hours = htmlspecialchars($input_hours[$index]);
            $minutes = htmlspecialchars($input_minutes[$index]);
            $price = htmlspecialchars($input_price[$index]); 
            $total_harga_anggaran += $price; // Calculate total estimated price

            // Update using model method
            if (!$kerja->updateByKerjaId($hours, $minutes, $price, $value)) {
                throw new Exception("Error updating tempahan_kerja");
            }
        }

        // Update tempahan using model method
        $tempahan = new Tempahan();
        $status_tempahan = 'pengesahan kpp';
        
        if (!$tempahan->pengesahanPEE($total_harga_anggaran, $pengesahan_pee, $status_tempahan, $tempahan_id)) {
            throw new Exception("Error updating tempahan");
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
