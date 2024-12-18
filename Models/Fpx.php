<?php

require_once 'Database.php';

class FPX
{
    
    private $db;

    // Constructor
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findByReferenceNo($reference_no)
    {
        $stmt = $this->db->prepare("SELECT * FROM payment WHERE rsp_orderid = ?");
        $stmt->bind_param("s", $reference_no);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
