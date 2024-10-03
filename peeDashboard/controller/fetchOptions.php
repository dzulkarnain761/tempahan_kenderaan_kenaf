<?php
// Assuming you have already established a database connection
require 'connection.php'; // Include your database connection

// Check if the 'type' parameter is set in the request
if (isset($_GET['type'])) {
    $type = $_GET['type'];

    // Prepare the response based on the type
    if ($type === 'kenderaan') {
        // Fetch Kenderaan options
        $sql = "SELECT id, no_pendaftaran, catatan FROM kenderaan";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . htmlspecialchars($row['id']) . '">' 
                    . htmlspecialchars($row['no_pendaftaran']) . ' - ' 
                    . htmlspecialchars($row['catatan']) . '</option>';
            }
        } else {
            echo '<option value="" disabled>No kenderaan found</option>';
        }

    } elseif ($type === 'pemandu') {
        // Fetch Pemandu options
        $sql = "SELECT id, nama FROM admin WHERE kumpulan = 'Y'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . htmlspecialchars($row['id']) . '">' 
                    . htmlspecialchars($row['nama']) . '</option>';
            }
        } else {
            echo '<option value="" disabled>No pemandu found</option>';
        }

    } else {
        echo '<option value="" disabled>Invalid type</option>';
    }
} else {
    echo '<option value="" disabled>Type not set</option>';
}

// Close the database connection
mysqli_close($conn);
?>
