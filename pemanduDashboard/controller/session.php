<?php

session_start();

if (!isset($_SESSION["kumpulan"]) || $_SESSION["kumpulan"] !== 'Y') {
    header("Location: ../login.php");
    exit();
}

?>