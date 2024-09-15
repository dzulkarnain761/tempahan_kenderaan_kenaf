<?php
include 'connection.php';

// Set default limit and page, but allow overriding through GET parameters
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5; // Allow dynamic limit
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

try {
    // Prepared statement to fetch tempahan with status filtering
    $sqlTempahan = "SELECT * FROM tempahan WHERE (status = ? OR status = ?) LIMIT ? OFFSET ?";
    $stmtTempahan = $conn->prepare($sqlTempahan);
    $status1 = 'bayaran deposit';
    $status2 = 'deposit selesai';
    $stmtTempahan->bind_param('ssii', $status1, $status2, $limit, $offset);
    $stmtTempahan->execute();
    $resultTempahan = $stmtTempahan->get_result();

    // Fetch total records for pagination
    $sqlTotal = "SELECT COUNT(*) as total FROM tempahan WHERE status = ?";
    $stmtTotal = $conn->prepare($sqlTotal);
    $stmtTotal->bind_param('s', $status1);
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $rowTotal = $resultTotal->fetch_assoc();
    $total = $rowTotal['total'];
    $totalPages = ceil($total / $limit);

    $TempahanData = [];
    while ($row = $resultTempahan->fetch_assoc()) {
        $tempahanId = $row['tempahan_id'];

        // Prepared statement to fetch related tempahan_kerja
        $sqlKerja = "SELECT * FROM tempahan_kerja WHERE tempahan_id = ? AND (status_kerja = ? OR status_kerja = ?)";
        $stmtKerja = $conn->prepare($sqlKerja);
        $statusKerja1 = 'bayaran deposit';
        $statusKerja2 = 'deposit selesai';
        $stmtKerja->bind_param('iss', $tempahanId, $statusKerja1, $statusKerja2);
        $stmtKerja->execute();
        $resultKerja = $stmtKerja->get_result();

        $kerjaData = [];
        while ($rowKerja = $resultKerja->fetch_assoc()) {
            $kerjaData[] = $rowKerja;
        }

        // Add kerja data to tempahan
        $row['kerja'] = $kerjaData;

        // Add tempahan data to the array
        $TempahanData[] = $row;
    }

    // Prepare response data
    $response = [
        'data' => $TempahanData,
        'totalPages' => $totalPages,
        'currentPage' => $page
    ];

    // Return the response as JSON
    echo json_encode($response);

} catch (Exception $e) {
    // Error handling - log the error message and return a failure response
    error_log($e->getMessage());
    echo json_encode(['error' => 'An error occurred while fetching data.']);
}
?>
