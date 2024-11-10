<?php
include 'connection.php';

session_start();

$negeri = $_SESSION['negeri'];

$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select pemandu with pagination
$sqlTempahan = "SELECT t.tempahan_id, t.tarikh_kerja, p.nama, r.jenis_pembayaran, r.cara_bayar,r.resit_id
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                LEFT JOIN resit_pembayaran r ON r.tempahan_id = t.tempahan_id
                WHERE r.status_resit = 'selesai' AND r.jenis_pembayaran != 'refund'
                LIMIT $limit OFFSET $offset";
$resultTempahan = mysqli_query($conn, $sqlTempahan);

// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total 
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                LEFT JOIN resit_pembayaran r ON r.tempahan_id = t.tempahan_id
                WHERE r.status_resit = 'selesai' AND r.jenis_pembayaran != 'refund'";
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
