<?php

require_once 'databaseModel.php';

class Resit
{
    // Define properties that map to table columns
    private $resit_id;
    private $tempahan_id;
    private $jenis_pembayaran;
    private $jumlah;
    private $cara_bayaran;
    private $nombor_rujukan;
    private $bukti_resit_path;
    private $status_resit;
    private $created_at;

    // Store the database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // CREATE: Method to insert a new receipt
    public function create($tempahan_id, $jenis_pembayaran, $jumlah, $cara_bayaran, $status_resit)
    {
        $stmt = $this->db->prepare("INSERT INTO resit_pembayaran (tempahan_id, jenis_pembayaran, bukti_resit_path, status_resit) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isiss", $tempahan_id, $jenis_pembayaran, $jumlah, $cara_bayaran, $status_resit);
        return $stmt->execute();
    }

    // READ: Method to get receipt by ID
    public function findByResitId($resit_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM resit_pembayaran WHERE resit_id = ?");
        $stmt->bind_param("i", $resit_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE: Method to update receipt details
    public function update($resit_id, $nombor_rujukan, $bukti_resit_path, $status_resit)
    {
        $stmt = $this->db->prepare("UPDATE resit_pembayaran SET nombor_rujukan = ?, bukti_resit_path = ?, status_resit = ? WHERE resit_id = ?");
        $stmt->bind_param("sissi", $nombor_rujukan, $bukti_resit_path, $status_resit, $resit_id);
        return $stmt->execute();
    }

    // DELETE: Method to delete a receipt by ID
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM resit_pembayaran WHERE resit_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Method to get all receipts
    public function all()
    {
        $result = $this->db->query("SELECT * FROM resit_pembayaran");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Additional method: Find receipts by Tempahan ID
    public function findByTempahanId($tempahan_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM resit_pembayaran WHERE tempahan_id = ?");
        $stmt->bind_param("i", $tempahan_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
