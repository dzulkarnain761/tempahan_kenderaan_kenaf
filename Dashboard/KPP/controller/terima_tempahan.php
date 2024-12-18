<?php


require_once '../../../Models/Tempahan.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']);
    $status_tempahan = 'bayaran penyewa';
    $status_bayaran = 'belum bayar';

    $tempahan = new Tempahan();
    
    if (!$tempahan->changeBothStatus($status_tempahan, $status_bayaran, $tempahan_id)) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan gagal"]);
        exit;
    }

    echo json_encode(["success" => true, "tempahan_id" => $tempahan_id]);
}
