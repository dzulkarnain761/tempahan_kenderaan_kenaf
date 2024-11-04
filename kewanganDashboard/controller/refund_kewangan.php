<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tempahan_id = intval($_POST['tempahan_id']);

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Retrieve total deposit
        $sqlTempahan = "SELECT total_baki FROM tempahan WHERE tempahan_id = ?";
        $stmtTempahan = $conn->prepare($sqlTempahan);
        $stmtTempahan->bind_param("i", $tempahan_id);
        $stmtTempahan->execute();
        $resultTempahan = $stmtTempahan->get_result();

        if ($rowTempahan = $resultTempahan->fetch_assoc()) {
            $jumlah_bayaran = abs($rowTempahan['total_baki']); // Ensure positive value
        } else {
            throw new Exception("Tempahan tidak dijumpai");
        }
        $stmtTempahan->close();

        $jenis_pembayaran = 'refund';
        $cara_bayar = 'fpx';

        // Sample FPX payment data
        $fpx_id_transaksi = 'FPXTK' . str_pad($tempahan_id, 5, '0', STR_PAD_LEFT);
        $fpx_id_bank = 'B002';
        $fpx_nama_bank = 'Bank Islam';
        $fpx_nama_pembeli = 'LKTN';
        $fpx_akaun_bank_pembeli = '987654321';
        $fpx_tandatangan = 'xyz789';
        $fpx_kod_respon = '00';
        $nombor_rujukan = 'TKR' . str_pad($tempahan_id, 5, '0', STR_PAD_LEFT);
        $alamat_ip = $_SERVER['REMOTE_ADDR'];
        $catatan = 'Payment successful';

        // Insert into fpx_payments
        $sqlFPX = $conn->prepare("INSERT INTO fpx_payments (fpx_id_transaksi, fpx_id_bank, fpx_nama_bank, fpx_nama_pembeli, fpx_akaun_bank_pembeli, fpx_tandatangan, fpx_kod_respon, nombor_rujukan, alamat_ip, catatan, jumlah_bayaran) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sqlFPX->bind_param("ssssssssssd", $fpx_id_transaksi, $fpx_id_bank, $fpx_nama_bank, $fpx_nama_pembeli, $fpx_akaun_bank_pembeli, $fpx_tandatangan, $fpx_kod_respon, $nombor_rujukan, $alamat_ip, $catatan, $jumlah_bayaran);

        if (!$sqlFPX->execute()) {
            throw new Exception("FPX gagal: " . $sqlFPX->error);
        }
        $sqlFPX->close();

        // Only generate receipt if the FPX response code is '00'
        if ($fpx_kod_respon == '00') {
            $status_resit = 'selesai';
            $sqlResit = $conn->prepare("INSERT INTO resit_pembayaran (tempahan_id, jenis_pembayaran, jumlah, cara_bayar, nombor_rujukan, status_resit) VALUES (?, ?, ?, ?, ?, ?)");
            $sqlResit->bind_param("isdsss", $tempahan_id, $jenis_pembayaran, $jumlah_bayaran, $cara_bayar, $nombor_rujukan, $status_resit);

            if (!$sqlResit->execute()) {
                throw new Exception("Resit gagal: " . $sqlResit->error);
            }
            $sqlResit->close();

            $status_tempahan = 'selesai';
            $status_bayaran = 'selesai';

            // Update tempahan status
            $sql1 = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
            $sql1->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);

            if (!$sql1->execute()) {
                throw new Exception("Kemaskini tempahan gagal: " . $sql1->error);
            }
            $sql1->close();
        }

        // Commit the transaction
        $conn->commit();
        echo json_encode(["success" => true]);

    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    } finally {
        // Close the connection
        $conn->close();
    }
}
