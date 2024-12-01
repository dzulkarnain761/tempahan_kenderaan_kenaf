<?php

require_once 'Database.php';

class Kenderaan {
    private $db;
    private $no_aset;
    private $no_pendaftaran; 
    private $kategori_kenderaan;
    private $tahun_daftar;
    private $negeri_penempatan;
    private $kawasan_penempatan;
    private $catatan;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // CREATE: Method to insert a new vehicle
    public function create($no_aset, $no_pendaftaran, $kategori_kenderaan, $tahun_daftar, $negeri_penempatan, $kawasan_penempatan, $catatan) {
        $stmt = $this->db->prepare("INSERT INTO kenderaan (no_aset, no_pendaftaran, kategori_kenderaan, tahun_daftar, negeri_penempatan, kawasan_penempatan, catatan) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $no_aset, $no_pendaftaran, $kategori_kenderaan, $tahun_daftar, $negeri_penempatan, $kawasan_penempatan, $catatan);
        return $stmt->execute();
    }

    // READ: Method to get vehicle by ID
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kenderaan WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE: Method to update vehicle details
    public function update($id, $no_aset, $no_pendaftaran, $kategori_kenderaan, $tahun_daftar, $negeri_penempatan, $kawasan_penempatan, $catatan) {
        $stmt = $this->db->prepare("UPDATE kenderaan SET no_aset = ?, no_pendaftaran = ?, kategori_kenderaan = ?, tahun_daftar = ?, negeri_penempatan = ?, kawasan_penempatan = ?, catatan = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $no_aset, $no_pendaftaran, $kategori_kenderaan, $tahun_daftar, $negeri_penempatan, $kawasan_penempatan, $catatan, $id);
        return $stmt->execute();
    }

    // DELETE: Method to delete a vehicle
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM kenderaan WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Method to get all vehicles
    public function getAllKenderaan() {
        $result = $this->db->query("SELECT * FROM kenderaan");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
