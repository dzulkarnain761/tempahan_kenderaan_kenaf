<?php

require_once 'Database.php';

class Quotation {

    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getByJenisPembayaran($jenis_pembayaran, $status_tempahan)
    {
        $result = $this->db->query("SELECT * FROM quotation q LEFT JOIN tempahan t ON t.tempahan_id = q.tempahan_id LEFT JOIN penyewa p ON p.id = t.penyewa_id WHERE jenis_pembayaran = '$jenis_pembayaran' AND status_tempahan = '$status_tempahan'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getDetail($quotation_id)
    {
        $result = $this->db->query("SELECT * FROM quotation WHERE quotation_id = '$quotation_id'");
        return $result->fetch_assoc();
    }

    public function checkQuotationExist($tempahan_id, $jenis_pembayaran)
{
    $stmt = $this->db->prepare("SELECT * FROM quotation WHERE tempahan_id = ? AND jenis_pembayaran = ?");
    $stmt->bind_param("ss", $tempahan_id, $jenis_pembayaran);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

 
}

?>