<?php
include 'connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tempahan_id = intval($_POST['tempahan_id']);
    $resit_id = intval($_POST['resit_id']);

    $sqlResit = "SELECT jenis_pembayaran FROM resit_pembayaran WHERE resit_id = ?";
    $stmt = $conn->prepare($sqlResit);
    $stmt->bind_param("i", $resit_id);
    $stmt->execute();
    $stmt->bind_result($jenis_pembayaran);
    $stmt->fetch();
    $stmt->close();


    // Set the target directory where you want to save images
    $target_dir = "bukti_resit/";

    // Get the file details
    $image = $_FILES['gambar_resit']['name'];

    // Change the image name to '$tempahan_id'_bayaran_penuh
    $new_image_name = $tempahan_id . '_' . $jenis_pembayaran . '.' . strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $target_file = '../../' . $target_dir . $new_image_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image type
    $check = getimagesize($_FILES['gambar_resit']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(['success' => false, 'message' => 'File is not an image.']);
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($target_file)) {
        echo json_encode(['success' => false, 'message' => 'Sorry, file already exists.']);
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB in this case)
    if ($_FILES['gambar_resit']['size'] > 5000000) {
        echo json_encode(['success' => false, 'message' => 'Sorry, your file is too large.']);
        $uploadOk = 0;
    }

    // Allow certain file formats (jpeg, png, jpg, gif)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif") {
        echo json_encode(['success' => false, 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo json_encode(['success' => false, 'message' => 'Sorry, your file was not uploaded.']);
    } else {
        // Start transaction
        $conn->begin_transaction();

        try {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['gambar_resit']['tmp_name'], $target_file)) {

                // Update the image path into the database
                $sqlResit = "UPDATE resit_pembayaran 
                             SET bukti_resit_path = '$new_image_name', status_resit = 'selesai'
                             WHERE resit_id = $resit_id";

                if ($conn->query($sqlResit) === TRUE) {

                    // Execute the second query to update 'tempahan'
                    if ($jenis_pembayaran == 'bayaran penuh') {
                        $sqlTempahan = "UPDATE tempahan 
                                    SET status_tempahan = 'pengesahan jobsheet', status_bayaran = 'selesai bayaran' 
                                    WHERE tempahan_id = $tempahan_id";
                    }else{
                        $sqlTempahan = "UPDATE tempahan 
                                    SET status_tempahan = 'selesai', status_bayaran = 'selesai' 
                                    WHERE tempahan_id = $tempahan_id";
                    }

                    if ($conn->query($sqlTempahan) === TRUE) {
                        // Commit the transaction if both queries succeed
                        $conn->commit();
                        echo json_encode(['success' => true, 'message' => 'The file has been uploaded and both updates are successful.']);
                    } else {
                        // Rollback transaction in case of a database error in the second query
                        $conn->rollback();
                        echo json_encode(['success' => false, 'message' => 'Database error in tempahan update: ' . $conn->error]);
                    }
                } else {
                    // Rollback transaction in case of database error in the first query
                    $conn->rollback();
                    echo json_encode(['success' => false, 'message' => 'Database error in resit update: ' . $conn->error]);
                }
            } else {
                // Rollback transaction in case of file upload error
                $conn->rollback();
                echo json_encode(['success' => false, 'message' => 'File upload error.']);
            }
        } catch (Exception $e) {
            // Rollback transaction if any error occurs
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'Transaction failed: ' . $e->getMessage()]);
        }
    }
}

$conn->close();