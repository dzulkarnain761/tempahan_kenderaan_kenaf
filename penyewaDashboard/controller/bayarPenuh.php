<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Safely handle input
    $tempahan_id = intval($_POST['tempahan_id']);
    $cara_bayar = $_POST['cara_bayaran'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Retrieve total deposit
        $sqlTempahan = "SELECT total_harga_anggaran FROM tempahan WHERE tempahan_id = ?";
        $stmtTempahan = $conn->prepare($sqlTempahan);
        $stmtTempahan->bind_param("i", $tempahan_id);
        $stmtTempahan->execute();
        $resultTempahan = $stmtTempahan->get_result();

        if ($rowTempahan = $resultTempahan->fetch_assoc()) {
            $jumlah_bayaran = $rowTempahan['total_harga_anggaran'];
        } else {
            throw new Exception("Tempahan tidak dijumpai");
        }
        $stmtTempahan->close();

        $jenis_pembayaran = 'bayaran penuh';

        if ($cara_bayar == 'fpx') {
            // Sample FPX payment data
            $fpx_id_transaksi = 'TX123456';
            $fpx_id_bank = 'B001';
            $fpx_nama_bank = 'Maybank';
            $fpx_nama_pembeli = 'Ali Bin Ahmad';
            $fpx_akaun_bank_pembeli = '123456789';
            $fpx_waktu_transaksi = '2024-10-20 10:00:00';
            $fpx_tandatangan = 'abc123def';
            $fpx_kod_respon = '00';
            $nombor_rujukan = 'FPXTX1029384756';
            $alamat_ip = '192.168.0.1';
            $catatan = 'Payment successful';

            // Insert into pembayaran_fpx
            $sqlFPX = $conn->prepare("INSERT INTO fpx_payments (fpx_id_transaksi, fpx_id_bank, fpx_nama_bank, fpx_nama_pembeli, fpx_akaun_bank_pembeli, fpx_masa_transaksi, fpx_tandatangan, fpx_kod_respon, nombor_rujukan, alamat_ip, catatan, jumlah_bayaran) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $sqlFPX->bind_param("sssssssssssd", $fpx_id_transaksi, $fpx_id_bank, $fpx_nama_bank, $fpx_nama_pembeli, $fpx_akaun_bank_pembeli, $fpx_waktu_transaksi, $fpx_tandatangan, $fpx_kod_respon, $nombor_rujukan, $alamat_ip, $catatan, $jumlah_bayaran);
            if (!$sqlFPX->execute()) {
                throw new Exception("FPX gagal: " . $sqlFPX->error);
            }
            $sqlFPX->close();

            // Only generate resit when the FPX response code is '00'
            if ($fpx_kod_respon == '00') {
                $status_resit = 'pengesahan';
                $sqlResit = $conn->prepare("INSERT INTO resit_pembayaran (tempahan_id, jenis_pembayaran, jumlah, cara_bayar, nombor_rujukan, status_resit) VALUES (?, ?, ?, ?, ?, ?)");
                $sqlResit->bind_param("isdsss", $tempahan_id, $jenis_pembayaran, $jumlah_bayaran, $cara_bayar, $nombor_rujukan, $status_resit);
            }
        } else {
            $status_resit = 'pengesahan';
            $sqlResit = $conn->prepare("INSERT INTO resit_pembayaran (tempahan_id, jenis_pembayaran, jumlah, cara_bayar, status_resit) VALUES (?, ?, ?, ?, ?)");
            $sqlResit->bind_param("isdss", $tempahan_id, $jenis_pembayaran, $jumlah_bayaran, $cara_bayar, $status_resit);
        }

        if (!$sqlResit->execute()) {
            throw new Exception("Resit pembayaran gagal: " . $sqlResit->error);
        }
        $sqlResit->close();

        // Update tempahan status
        $status_tempahan = 'pengesahan pt';
        $status_bayaran = 'bayaran diproses';
        $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $sqlUpdateTempahan->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);

        if (!$sqlUpdateTempahan->execute()) {
            throw new Exception("Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error);
        }
        $sqlUpdateTempahan->close();

        // Commit transaction
        $conn->commit();

        // Return success message
        if ($cara_bayar == 'fpx') {
            echo json_encode(['success' => true, 'message' => 'Bayaran Akan Diproses']);
        } else {
            echo json_encode(['success' => true, 'message' => 'Sila Hadir Ke Kaunter LKTN untuk Pengesahan Bayaran']);
        }

    } catch (Exception $e) {
        // Rollback transaction if any error occurs
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }

    // Close the connection
    $conn->close();
}

