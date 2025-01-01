<?php

require_once 'Database.php';

class Jobsheet
{
    private $jobsheet_id;
    private $tempahan_id;
    private $tempahan_kerja_id;
    private $pemandu_id;
    private $kenderaan_id;
    private $tarikh_kerja_dijalankan;
    private $jam;
    private $minit;
    private $harga;
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function totalJobsheetByKerja($tempahan_kerja_id)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM jobsheet WHERE tempahan_kerja_id = ?");
        $stmt->bind_param("i", $tempahan_kerja_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    public function findByTempahanId($tempahan_id)
    {
        $stmt = $this->db->prepare("SELECT j.*, tk.nama_kerja, a.nama AS nama_pemandu, k.no_pendaftaran FROM jobsheet j LEFT JOIN tempahan_kerja tk ON j.tempahan_kerja_id = tk.tempahan_kerja_id LEFT JOIN admin a ON j.pemandu_id = a.id LEFT JOIN kenderaan k ON j.kenderaan_id = k.id WHERE j.tempahan_id = ?");
        $stmt->bind_param("i", $tempahan_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function findById($jobsheet_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM jobsheet WHERE jobsheet_id = ?");
        $stmt->bind_param("i", $jobsheet_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function findByKerjaId($tempahan_kerja_id)
    {
        $result = $this->db->query("SELECT * FROM jobsheet WHERE tempahan_kerja_id = '$tempahan_kerja_id'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getAllbyPemanduId($pemandu_id,$status_jobsheet)
    {
        $result = $this->db->query("SELECT * FROM jobsheet j LEFT JOIN tempahan t ON j.tempahan_id = t.tempahan_id LEFT JOIN penyewa p ON p.id = t.penyewa_id WHERE pemandu_id = '$pemandu_id' AND status_jobsheet = '$status_jobsheet'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createJobsheet($tempahan_id, $tempahan_kerja_id)
    {
        $stmt = $this->db->prepare("INSERT INTO jobsheet (tempahan_id, tempahan_kerja_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $tempahan_id, $tempahan_kerja_id);
        return $stmt->execute();
    }


    public function isUnfinishedJobsheetExist($tempahan_id)
    {
        // Prepare the SQL query to check for the specific status
        $stmt = $this->db->prepare("SELECT status_jobsheet FROM jobsheet WHERE status_jobsheet = 'dijalankan' AND tempahan_id = ?");
        $stmt->bind_param("i", $tempahan_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there's at least one result
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function fetchDetail($jobsheet_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM jobsheet j LEFT JOIN tempahan t ON t.tempahan_id = j.tempahan_id LEFT JOIN tempahan_kerja tk ON tk.tempahan_kerja_id = j.tempahan_kerja_id LEFT JOIN kenderaan k ON k.id = j.kenderaan_id LEFT JOIN penyewa p ON p.id = t.penyewa_id WHERE jobsheet_id = ?");
        $stmt->bind_param("i", $jobsheet_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Getters and Setters for each property can be added here
}
