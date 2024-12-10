<?php

require_once 'Database.php';

class Tugasan
{
    // Properties
    private $nama_kerja;
    private $harga_per_jam;
    private $kategori_kenderaan;
    private $db;

    // Constructor
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Create new tugasan
    public function create($nama_kerja, $harga_per_jam, $kategori_kenderaan)
    {
        $stmt = $this->db->prepare("INSERT INTO tugasan (nama_kerja, harga_per_jam, kategori_kenderaan) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $nama_kerja, $harga_per_jam, $kategori_kenderaan);
        return $stmt->execute();
    }

    // Get tugasan by ID
    public function getRateByName($nama_kerja)
    {
        $stmt = $this->db->prepare("SELECT harga_per_jam FROM tugasan WHERE kerja = ?");
        $stmt->bind_param("s", $nama_kerja);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function findById($tugasan_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tugasan WHERE id = ?");
        $stmt->bind_param("i", $tugasan_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }



    public function getCategoryByName($nama_kerja)
    {
        $stmt = $this->db->prepare("SELECT kategori_kenderaan FROM tugasan WHERE kerja = ?");
        $stmt->bind_param("s", $nama_kerja);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Get all tugasan
    public function all()
    {
        $result = $this->db->query("SELECT * FROM tugasan");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update tugasan
    public function update($id, $nama_kerja, $harga_per_jam, $kategori_kenderaan)
    {
        $stmt = $this->db->prepare("UPDATE tugasan SET nama_kerja = ?, harga_per_jam = ?, kategori_kenderaan = ? WHERE id = ?");
        $stmt->bind_param("sdsi", $nama_kerja, $harga_per_jam, $kategori_kenderaan, $id);
        return $stmt->execute();
    }

    // Delete tugasan
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tugasan WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Method to get the total number of tugasan
    public function getTotalTugasan()
    {
        $result = $this->db->query("SELECT COUNT(*) AS total_tugasan FROM tugasan");
        $row = $result->fetch_assoc();
        return $row['total_tugasan'];
    }
}
