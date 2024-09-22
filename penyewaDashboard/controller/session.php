<?php

session_start();

if (!isset($_SESSION["id"])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_SESSION["kumpulan"])) {
    header("Location: ../controller/auth/routeAdmin.php");
    exit();
}



?>