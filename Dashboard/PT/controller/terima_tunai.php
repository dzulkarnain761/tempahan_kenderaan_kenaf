<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']);

    $status_tempahan = 'pengesahan pengarah';

    $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ? WHERE tempahan_id = ?");
    $sqlUpdateTempahan->bind_param("si", $status_tempahan, $tempahan_id);

    if (!$sqlUpdateTempahan->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error]);
        $sqlUpdateTempahan->close();
        $conn->close();
        exit;
    }
    $sqlUpdateTempahan->close();


    // send to PENGARAH
    $kumpulan = 'E';
    $adminModel = new Admin();
    $admins = $adminModel->getAdminbyKumpulan($kumpulan);

    $recipients = array_filter(array_map(function ($admin) {
        return $admin['email'] ?? '';
    }, $admins)); // Filter out empty emails

    $subject = 'LKTN eTempahan Jentera';
    $body = "<h2>eTempahan Jentera</h2>
                <p>1 Tempahan Baru</p>
                <p>Sila log masuk ke <a href='https://apps.lktn.gov.my/ejentera/PENGARAH/tempahan_resit.php'>eJentera</a> untuk melihat tempahan baru.</p>";
    $fromEmail = 'dzulkarnain761@gmail.com';

    $result = sendEmail($subject, $body, $recipients, $fromEmail);

    // Close the connection and return success message
    $conn->close();
    echo json_encode(["success" => true, "message" => "Berjaya"]);
}
