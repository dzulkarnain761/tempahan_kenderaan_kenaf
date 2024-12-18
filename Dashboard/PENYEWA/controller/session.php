<?php

session_start();

if (!isset($_SESSION["id"])) {
    header("Location: ../../login.php");
    exit();
}

$user_name = $_SESSION['nama_pengguna'];

// Split the name by space and take the first part
$first_name = explode(' ', $user_name)[0];

?>