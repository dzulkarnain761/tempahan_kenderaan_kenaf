<?php
include 'connection.php';


$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select tugasan_traktor with pagination
$sqltugasan = "SELECT * FROM `tugasan` LIMIT $limit OFFSET $offset";
$resulttugasan = mysqli_query($conn, $sqltugasan);

// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total FROM `tugasan`";
$resultTotal = mysqli_query($conn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$total = $rowTotal['total'];
$totalPages = ceil($total / $limit);

$tugasanData = [];
while ($row = mysqli_fetch_assoc($resulttugasan)) {
    $tugasanData[] = $row;
}

$response = [
    'data' => $tugasanData,
    'totalPages' => $totalPages,
    'currentPage' => $page
];

echo json_encode($response);
