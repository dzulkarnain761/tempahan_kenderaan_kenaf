<?php

require_once 'databaseModel.php';

class TempahanKerja
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

    // CREATE: Method to insert a new booking (tempahan_kerja)
    public function create($tempahan_id, $nama_kerja)
    {
        $stmt = $this->db->prepare("INSERT INTO tempahan_kerja (tempahan_id, nama_kerja) VALUES (?, ?)");
        $stmt->bind_param("isss", $user_id, $booking_date, $luas_tanah, $catatan);
        return $stmt->execute();
    }

    // READ: Method to get booking by ID
    public function findByTempahanId($tempahan_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tempahan_kerja WHERE tempahan_id = ?");
        $stmt->bind_param("i", $tempahan_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE: Method to update booking details
    public function update($total_harga_anggaran, $total_harga_sebenar, $total_baki, $status)
    {
        $stmt = $this->db->prepare("UPDATE tempahan_kerja SET jam_anggaran = ?, total_harga_sebenar = ?, total_baki = ?, status = ? WHERE tempahan_id = ?");
        $stmt->bind_param("dddis", $total_harga_anggaran, $total_harga_sebenar, $total_baki, $status, $tempahan_id);
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
}
