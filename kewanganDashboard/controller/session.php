<?php

session_start();

if (!isset($_SESSION["kumpulan"]) || $_SESSION["kumpulan"] !== 'G') {
    header("Location: ../login.php");
    exit();
}

?>