<?php
include 'connection.php';

$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select pemandu with pagination
$sqlTempahan = "SELECT t.lokasi_kerja,t.luas_tanah, p.nama, tk.*
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                LEFT JOIN tempahan_kerja tk ON tk.tempahan_id = t.tempahan_id
                WHERE tk.status_kerja = 'sedang berjalan'
                LIMIT $limit OFFSET $offset";
$resultTempahan = mysqli_query($conn, $sqlTempahan);

// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                LEFT JOIN tempahan_kerja tk ON tk.tempahan_id = t.tempahan_id
                WHERE tk.status_kerja = 'sedang berjalan'";
$resultTotal = mysqli_query($conn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$total = $rowTotal['total'];
$totalPages = ceil($total / $limit);


$response = [
    'data' => $TempahanData,
    'totalPages' => $totalPages,
    'currentPage' => $page
];

echo json_encode($response);
