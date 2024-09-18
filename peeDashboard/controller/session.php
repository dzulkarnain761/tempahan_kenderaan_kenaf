<?php

session_start();

if (!isset($_SESSION["kumpulan"]) || $_SESSION["kumpulan"] !== 'D') {
    header("Location: ../login.php");
    exit();
}

?>