<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $jobsheet_id = intval($_POST['jobsheet_id']);
    $kenderaan_id = intval($_POST['kenderaan_id']);
    $pemandu_id = intval($_POST['pemandu_id']);
    $tempahan_id = intval($_POST['tempahan_id']);
    $tempahan_kerja_id = intval($_POST['tempahan_kerja_id']);

    // Prepare the SQL update query
    $updateQuery = "UPDATE `jobsheet` SET kenderaan_id = ?, pemandu_id = ?, status_jobsheet = 'dijalankan' WHERE jobsheet_id = ?";
    $stmt = $conn->prepare($updateQuery);

    if ($stmt === false) {
        $_SESSION['error_message'] = "Failed to prepare the SQL query.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $stmt->bind_param('iii', $kenderaan_id, $pemandu_id, $jobsheet_id);

    // Execute the query and set session messages
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Berjaya Kemaskini Pemandu dan Kenderaan";
        $stmt->close();
        $conn->close(); // Close the database connection
        header("Location: ../pengesahan_jobsheet.php?tempahan_id=$tempahan_id&tempahan_kerja_id=$tempahan_kerja_id");
        exit();
    } else {
        $_SESSION['error_message'] = "Gagal Kemaskini: " . $stmt->error;
        $stmt->close();
        $conn->close(); // Close the database connection
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
} else {
    $_SESSION['error_message'] = "Invalid request method";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Close the database connection
$conn->close();
