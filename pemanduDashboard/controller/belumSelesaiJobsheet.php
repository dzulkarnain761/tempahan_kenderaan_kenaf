<?php
include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $jobsheet_id = $_POST['jobsheet_id'];
    $tarikh_kerja = $_POST['tarikh_kerja'];
    $masa_mula = $_POST['masa_mula'];
    $masa_akhir = $_POST['masa_akhir'];
    $jumlah_jam = $_POST['jumlah_jam'];
    $jumlah_bayaran = $_POST['jumlah_bayaran'];
    $catatan = $_POST['catatan'];
    $status_jobsheet = 'selesai';
   
    // Ensure the number of hours does not exceed 6
    if ($jumlah_jam > 6) {
        echo json_encode(["success" => false, "message" => "Sila pastikan anda pilih waktu yang betul (tidak melebihi 6 jam)."]);
        exit;
    }

    // Step 1: Get the tempahan_id of the current tempahan_kerja
    $sql1 = $conn->prepare("SELECT tempahan_kerja_id FROM jobsheet WHERE jobsheet_id = ?");
    $sql1->bind_param("s", $jobsheet_id);
    $sql1->execute();
    $sql1->bind_result($tempahan_kerja_id);
    $sql1->fetch();
    $sql1->close();
    

    // Step 2: Update the current jobsheet
    $sql2 = $conn->prepare("UPDATE jobsheet SET status_jobsheet = ?, tarikh_kerja_dijalankan = ?, masa_mula_odometer = ?, masa_akhir_odometer = ?, jam = ?, harga = ?, catatan = ? WHERE jobsheet_id = ?");
    $sql2->bind_param("ssssddss", $status_jobsheet,$tarikh_kerja, $masa_mula, $masa_akhir, $jumlah_jam, $jumlah_bayaran, $catatan, $jobsheet_id);

    if (!$sql2->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan_kerja gagal: " . $sql2->error]);
        $sql2->close();
        $conn->close();
        exit;
    }
    $sql2->close();

    // Step 3: Update the related tempahan_kerja
    $status_kerja = 'belum selesai';
    $sql3 = $conn->prepare("UPDATE tempahan_kerja SET status_kerja = ? WHERE tempahan_kerja_id = ?");
    $sql3->bind_param("ss", $status_kerja, $tempahan_kerja_id);

    if (!$sql3->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini tempahan_kerja gagal: " . $sql3->error]);
        $sql3->close();
        exit;
    }
    $sql3->close();

    // Close the connection
    $conn->close();

    // Return success response
    echo json_encode(["success" => true, "message" => "Jobsheet dan tempahan_kerja berjaya dikemaskini.", "jobsheet_id" => $jobsheet_id, "tempahan_kerja_id" => $tempahan_kerja_id]);
}
?>
