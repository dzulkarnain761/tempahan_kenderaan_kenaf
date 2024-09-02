<?php
include 'connection.php';


$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select kenderaan_traktor with pagination
$sqlkenderaan = "SELECT * FROM `kenderaan` LIMIT $limit OFFSET $offset";
$resultkenderaan = mysqli_query($conn, $sqlkenderaan);

// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total FROM `kenderaan`";
$resultTotal = mysqli_query($conn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$total = $rowTotal['total'];
$totalPages = ceil($total / $limit);

$kenderaanData = [];
while ($row = mysqli_fetch_assoc($resultkenderaan)) {
    $kenderaanData[] = $row;
}

$response = [
    'data' => $kenderaanData,
    'totalPages' => $totalPages,
    'currentPage' => $page
];

echo json_encode($response);
