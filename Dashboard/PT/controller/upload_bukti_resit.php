<?php
require_once '../../../Models/Database.php';
$conn = Database::getConnection();

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

    // Change the image name to '$tempahan_id'
    $new_image_name = $tempahan_id . '_' . $jenis_pembayaran . '.' . strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $target_file = '../../../' . $target_dir . $new_image_name;
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

    // Check file size (limit to 5MB in this case)
    if ($_FILES['gambar_resit']['size'] > 5000000) {
        echo json_encode(['success' => false, 'message' => 'Sorry, your file is too large.']);
        $uploadOk = 0;
    }

    // Allow certain file formats (jpeg, png, jpg, jfif)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif") {
        echo json_encode(['success' => false, 'message' => 'Sorry, only JPG, JPEG, PNG & JFIF files are allowed.']);
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo json_encode(['success' => false, 'message' => 'Sorry, your file was not uploaded.']);
    } else {
        // Start transaction
        $conn->begin_transaction();

        try {
            // Move the uploaded file to the target directory (overwrite if exists)
            if (move_uploaded_file($_FILES['gambar_resit']['tmp_name'], $target_file)) {

                // Update the image path into the database
                $sqlResit = "UPDATE resit_pembayaran 
                             SET bukti_resit_path = '$new_image_name'
                             WHERE resit_id = $resit_id";

                if ($conn->query($sqlResit) === TRUE) {
                    // Commit transaction if successful
                    $conn->commit();
                    echo json_encode(['success' => true, 'message' => 'File uploaded and record updated successfully.']);
                } else {
                    // Rollback if query fails
                    $conn->rollback();
                    echo json_encode(['success' => false, 'message' => 'Database update failed.']);
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
