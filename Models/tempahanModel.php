<?php

require_once 'databaseModel.php';

class Tempahan
{
    // Define properties that map to table columns
    private $id;
    private $user_id;
    private $service_id;
    private $booking_date;
    private $status;
    private $total_harga_anggaran;
    private $total_harga_sebenar;
    private $total_baki;

    // Store the database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // CREATE: Method to insert a new booking (tempahan)
    public function create($user_id, $booking_date, $luas_tanah, $catatan)
    {
        $stmt = $this->db->prepare("INSERT INTO tempahan (penyewa_id, tarikh_kerja, luas_tanah, catatan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $booking_date, $luas_tanah, $catatan);
        return $stmt->execute();
    }

    // READ: Method to get booking by ID
    public function findByTempahanId($tempahan_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tempahan WHERE tempahan_id = ?");
        $stmt->bind_param("i", $tempahan_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE: Method to update booking details
    public function update($tempahan_id, $total_harga_anggaran, $total_harga_sebenar, $total_baki, $status)
    {
        $stmt = $this->db->prepare("UPDATE tempahan SET total_harga_anggaran = ?, total_harga_sebenar = ?, total_baki = ?, status = ? WHERE tempahan_id = ?");
        $stmt->bind_param("dddis", $total_harga_anggaran, $total_harga_sebenar, $total_baki, $status, $tempahan_id);
        return $stmt->execute();
    }

    // DELETE: Method to delete a booking by ID
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tempahan WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Method to get all bookings
    public function all()
    {
        $result = $this->db->query("SELECT * FROM tempahan");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Additional method: Find bookings by user ID
    public function findByUserId($user_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tempahan WHERE penyewa_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
