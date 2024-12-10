<?php

require_once 'Database.php';

class Kumpulan {

    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getKumpulanStaff()
    {
        $result = $this->db->query("SELECT * FROM kumpulan");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getKumpulanPemandu()
    {
        $result = $this->db->query("SELECT * FROM kumpulan WHERE kump_kod = 'Y'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getKumpulanDetail($kumpulan_kod)
    {
        $result = $this->db->query("SELECT kump_desc FROM kumpulan WHERE kump_kod = '$kumpulan_kod'");
        return $result->fetch_assoc();
    }
}



?>