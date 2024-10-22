<?php

session_start();

if (!isset($_SESSION["kumpulan"]) || $_SESSION["kumpulan"] !== 'E') {
    header("Location: ../login.php");
    exit();
}

?>