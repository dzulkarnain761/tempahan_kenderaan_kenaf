<?php

include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $resit_id = intval($_POST['resit_id']);

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Prepare the SELECT query to fetch cara_bayar and resit_id
        $sqlTempahan = $conn->prepare("SELECT cara_bayar, jenis_pembayaran, tempahan_id FROM resit_pembayaran WHERE resit_id = ?");
        $sqlTempahan->bind_param("i", $resit_id);
        $sqlTempahan->execute();
        $sqlTempahan->bind_result($cara_bayar, $jenis_pembayaran, $tempahan_id);
        $sqlTempahan->fetch();
        $sqlTempahan->close();

        // Check the result of cara_bayar
        if ($cara_bayar == 'fpx') {

            if ($jenis_pembayaran == 'bayaran penuh') {
                $status_tempahan = 'pengesahan jobsheet';
                $status_bayaran = 'selesai bayaran';
            }else{
                $status_tempahan = 'selesai';
                $status_bayaran = 'selesai';
            }

            // Prepare the UPDATE query for tempahan status and status_bayaran
            $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
            $sqlUpdateTempahan->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);

            if (!$sqlUpdateTempahan->execute()) {
                throw new Exception("Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error);
            }
            $sqlUpdateTempahan->close();

            // Update status_resit for FPX payments
            $status_resit = 'selesai';
            $sqlResit = $conn->prepare("UPDATE resit_pembayaran SET status_resit = ? WHERE resit_id = ?");
            $sqlResit->bind_param("si", $status_resit, $resit_id);

            if (!$sqlResit->execute()) {
                throw new Exception("Resit gagal: " . $sqlResit->error);
            }
            $sqlResit->close();
        } else {
            // Update status_tempahan for non-FPX payments
            $status_tempahan = 'penjanaan resit';
            $sqlUpdateTempahan = $conn->prepare("UPDATE tempahan SET status_tempahan = ? WHERE tempahan_id = ?");
            $sqlUpdateTempahan->bind_param("si", $status_tempahan, $tempahan_id);

            if (!$sqlUpdateTempahan->execute()) {
                throw new Exception("Kemaskini tempahan gagal: " . $sqlUpdateTempahan->error);
            }
            $sqlUpdateTempahan->close();
        }

        // Commit the transaction
        $conn->commit();
        echo json_encode(["success" => true, "message" => "Berjaya"]);
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    } finally {
        // Close the connection
        $conn->close();
    }
}