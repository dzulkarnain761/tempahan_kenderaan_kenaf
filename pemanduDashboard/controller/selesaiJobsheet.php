<?php
include 'connection.php';

function handleQueryError($conn, $sql, $message) {
    if (!$sql->execute()) {
        // Rollback the transaction if there is an error
        $conn->rollback();
        echo json_encode(["success" => false, "message" => "$message: " . $sql->error]);
        $sql->close();
        exit;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $jobsheet_id = $_POST['jobsheet_id'];
    $tarikh_kerja = $_POST['tarikh_kerja'];
    $masa_mula = $_POST['masa_mula'];
    $masa_akhir = $_POST['masa_akhir'];
    $jumlah_jam = $_POST['jumlah_jam'];
    $jumlah_bayaran = $_POST['jumlah_bayaran'];
    $status_jobsheet = 'selesai';

    if ($jumlah_jam > 6) {
        echo json_encode(["success" => false, "message" => "Sila Pastikan Anda Pilih Waktu yang Betul (Tidak Melebihi 6 Jam)"]);
        exit;
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // Step 1: Get the tempahan_kerja_id and tempahan_id of the current jobsheet
        $sql1 = $conn->prepare("SELECT tempahan_kerja_id, tempahan_id FROM jobsheet WHERE jobsheet_id = ?");
        $sql1->bind_param("s", $jobsheet_id);
        $sql1->execute();
        $sql1->bind_result($tempahan_kerja_id, $tempahan_id);
        $sql1->fetch();
        $sql1->close();

        // Step 2: Update the current jobsheet
        $sql2 = $conn->prepare("UPDATE jobsheet SET status_jobsheet = ?, tarikh_kerja_dijalankan = ?, masa_mula_odometer = ?, masa_akhir_odometer = ?, jam = ?, harga = ? WHERE jobsheet_id = ?");
        $sql2->bind_param("ssdddds", $status_jobsheet, $tarikh_kerja, $masa_mula, $masa_akhir, $jumlah_jam, $jumlah_bayaran, $jobsheet_id);
        handleQueryError($conn, $sql2, "Kemaskini jobsheet gagal");
        $sql2->close();

        // Step 3: Check if all jobsheets with the same tempahan_kerja_id have the status 'selesai'
        $sql3 = $conn->prepare("SELECT COUNT(*) FROM jobsheet WHERE tempahan_kerja_id = ? AND status_jobsheet NOT IN ('selesai','dalam pengesahan')");
        $sql3->bind_param("s", $tempahan_kerja_id);
        $sql3->execute();
        $sql3->bind_result($remaining_jobs);
        $sql3->fetch();
        $sql3->close();

        if ($remaining_jobs == 0) {
            // Combined query to sum hours and price
            $sqlSum = $conn->prepare("SELECT SUM(jam) as total_jam_kerja, SUM(harga) as total_harga_kerja FROM jobsheet WHERE tempahan_kerja_id = ?");
            $sqlSum->bind_param("s", $tempahan_kerja_id);
            $sqlSum->execute();
            $sqlSum->bind_result($total_jam_kerja, $total_harga_kerja);
            $sqlSum->fetch();
            $sqlSum->close();
            $status_kerja = 'selesai';

            // Update the total hours and price in tempahan_kerja
            $sqlUpdateTempahanKerja = $conn->prepare("UPDATE tempahan_kerja SET total_jam = ?, total_harga = ?, status_kerja = ? WHERE tempahan_kerja_id = ?");
            $sqlUpdateTempahanKerja->bind_param("ddss", $total_jam_kerja, $total_harga_kerja, $status_kerja, $tempahan_kerja_id);
            handleQueryError($conn, $sqlUpdateTempahanKerja, "Kemaskini tempahan_kerja gagal");
            $sqlUpdateTempahanKerja->close();

            // Check if all tasks with the same tempahan_id have the status 'selesai'
            $sql4 = $conn->prepare("SELECT COUNT(*) FROM tempahan_kerja WHERE tempahan_id = ? AND status_kerja NOT IN ('selesai','dibatalkan','ditolak','belum selesai','tempahan diproses')");
            $sql4->bind_param("s", $tempahan_id);
            $sql4->execute();
            $sql4->bind_result($remaining_task);
            $sql4->fetch();
            $sql4->close();

            if ($remaining_task == 0) {
                // Sum all total_harga in tempahan_kerja and update tempahan
                $sqlHargaKerja = $conn->prepare("SELECT SUM(total_harga) as total_harga_tempahan FROM tempahan_kerja WHERE tempahan_id = ?");
                $sqlHargaKerja->bind_param("s", $tempahan_id);
                $sqlHargaKerja->execute();
                $sqlHargaKerja->bind_result($total_harga_sebenar);
                $sqlHargaKerja->fetch();
                $sqlHargaKerja->close();

                // Fetch deposit from tempahan
                $sqlTempahan = $conn->prepare("SELECT total_deposit FROM tempahan WHERE tempahan_id = ?");
                $sqlTempahan->bind_param("s", $tempahan_id);
                $sqlTempahan->execute();
                $sqlTempahan->bind_result($total_deposit);
                $sqlTempahan->fetch();
                $sqlTempahan->close();

                // Calculate the remaining balance
                $total_baki = $total_harga_sebenar - $total_deposit;

                // Update tempahan with status and remaining balance
                $sql5 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ?, total_harga_sebenar = ?, total_baki = ? WHERE tempahan_id = ?");
                $status_tempahan = 'kerja selesai';
                if ($total_baki == 0) {
                    $status_bayaran = 'selesai';
                } else {
                    $status_bayaran = ($total_baki > 0) ? 'belum bayar' : 'bayaran balik';
                }
                $sql5->bind_param("ssdds", $status_tempahan, $status_bayaran, $total_harga_sebenar, $total_baki, $tempahan_id);
                handleQueryError($conn, $sql5, "Kemaskini tempahan gagal");
                $sql5->close();
            }
        }

        // Commit the transaction if all queries are successful
        $conn->commit();
        echo json_encode(["success" => true, "message" => "Kemaskini berjaya"]);

    } catch (Exception $e) {
        // Rollback the transaction in case of any error
        $conn->rollback();
        echo json_encode(["success" => false, "message" => "Terdapat masalah: " . $e->getMessage()]);
    }
}

$conn->close();
?>
