<?php
include 'connection.php';

session_start();

$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select pemandu with pagination
$sqlTempahan = "SELECT t.tempahan_id, t.tarikh_kerja, p.nama,t.total_harga_anggaran, t.total_harga_sebenar,t.total_baki 
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                WHERE t.status_tempahan = 'refund kewangan'
                LIMIT $limit OFFSET $offset";
$resultTempahan = mysqli_query($conn, $sqlTempahan);

// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total 
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                WHERE t.status_tempahan = 'refund kewangan'";
$resultTotal = mysqli_query($conn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$total = $rowTotal['total'];
$totalPages = ceil($total / $limit);

$TempahanData = [];
while ($row = mysqli_fetch_assoc($resultTempahan)) {
    $tempahanId = $row['tempahan_id'];

    // Fetch related 'tempahan_kerja' data
    $sqlKerja = "SELECT * FROM tempahan_kerja WHERE tempahan_id = $tempahanId";
    $resultKerja = mysqli_query($conn, $sqlKerja);

    $kerjaData = [];
    while ($rowKerja = mysqli_fetch_assoc($resultKerja)) {
        $kerjaData[] = $rowKerja;
    }

    // Add 'kerja' data to the current tempahan
    $row['kerja'] = $kerjaData;

    // Add the tempahan record to the data array
    $TempahanData[] = $row;
}

$response = [
    'data' => $TempahanData,
    'totalPages' => $totalPages,
    'currentPage' => $page
];

echo json_encode($response);