<?php session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: ../../login.php');
    exit;
}

// Optional: Check if the user has the right role for the page
if ($_SESSION['kumpulan'] != 'E') {
    echo "Access denied.";
    exit;
}

$user_name = $_SESSION['nama_pengguna'];

// Split the name by space and take the first part
$first_name = explode(' ', $user_name)[0];

?>