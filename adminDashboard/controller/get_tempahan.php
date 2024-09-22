<?php
include 'connection.php';

session_start();
$pemandu_id = $_SESSION['id'];

$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select pemandu with pagination
$sqlTempahan = "SELECT t.lokasi_kerja, t.luas_tanah, p.nama, tk.*
                                        FROM tempahan t
                                        LEFT JOIN penyewa p ON p.id = t.penyewa_id
                                        LEFT JOIN tempahan_kerja tk ON tk.tempahan_id = t.tempahan_id
                                        WHERE tk.status_kerja = 'dijalankan' AND tk.pemandu_id = $pemandu_id
                LIMIT $limit OFFSET $offset";
$resultTempahan = mysqli_query($conn, $sqlTempahan);

// Initialize an array to store the fetched data
$TempahanData = [];

if (mysqli_num_rows($resultTempahan) > 0) {
    while ($row = mysqli_fetch_assoc($resultTempahan)) {
        $TempahanData[] = $row; // Add each row to the array
    }
}

// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total FROM tempahan t
                                        LEFT JOIN penyewa p ON p.id = t.penyewa_id
                                        LEFT JOIN tempahan_kerja tk ON tk.tempahan_id = t.tempahan_id
                                        WHERE tk.status_kerja = 'dijalankan' AND tk.pemandu_id = $pemandu_id";
$resultTotal = mysqli_query($conn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$total = $rowTotal['total'];
$totalPages = ceil($total / $limit);

// Prepare the response
$response = [
    'data' => $TempahanData,
    'totalPages' => $totalPages,
    'currentPage' => $page
];

echo json_encode($response);
