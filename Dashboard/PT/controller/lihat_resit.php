<?


// Ensure error reporting is on for debugging (can be removed in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Base directory where the receipts are stored
$base_path = '../../bukti_resit/';

// Retrieve the path parameter from the URL
if (isset($_GET['path'])) {
    $resit_path = $base_path . basename($_GET['path']); // Use basename to prevent directory traversal attacks

    // Check if the file exists
    if (file_exists($resit_path)) {
        // Output the receipt file
        header('Content-Type: application/pdf'); // Assume the receipt is a PDF
        header('Content-Disposition: inline; filename="' . basename($resit_path) . '"');
        readfile($resit_path);
        exit;
    } else {
        // File not found
        echo 'Tiada Resit';
        exit;
    }
} else {
    // No path parameter provided
    echo 'Tiada Resit';
    exit;
}


?>