<?php

require_once 'Database.php';

class Kerja
{
    // Define properties that map to table columns
    private $tempahan_kerja_id;
    private $tempahan_id;
    private $nama_kerja;
    private $jam_anggaran;
    private $minit_anggaran;
    private $harga_anggaran;
    private $total_jam;
    private $total_minit;
    private $total_harga;
    private $tarikh_kerja_cadangan;
    private $created_at;
    private $updated_at;

    // Store the database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct()
    {
        $this->db = Database::getConnection();
    }


    // READ: Method to get booking by ID
    public function findByTempahanId($tempahan_id)
    {
        $result = $this->db->query("SELECT * FROM tempahan_kerja WHERE tempahan_id = '$tempahan_id'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // UPDATE: Method to update booking details
    public function updateByKerjaId($jam_anggaran, $minit_anggaran, $harga_anggaran, $tempahan_kerja_id)
    {
        $stmt = $this->db->prepare("UPDATE tempahan_kerja SET jam_anggaran = ?, minit_anggaran = ?, harga_anggaran = ? WHERE tempahan_kerja_id = ?");
        $stmt->bind_param("iidi", $jam_anggaran, $minit_anggaran, $harga_anggaran, $tempahan_kerja_id);
        return $stmt->execute();
    }

    // DELETE: Method to delete a booking by ID
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tempahan_kerja WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Method to get all bookings
    public function all()
    {
        $result = $this->db->query("SELECT * FROM tempahan_kerja");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Additional method: Find bookings by user ID
    public function findByUserId($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tempahan_kerja WHERE penyewa_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function findByTempahanKerjaId($tempahan_kerja_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tempahan_kerja WHERE tempahan_kerja_id = ?");
        $stmt->bind_param("i", $tempahan_kerja_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
