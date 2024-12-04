<?php

require_once 'Database.php';

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


    public function getHarga($harga, $tempahan_id)
    {
        $stmt = $this->db->prepare("SELECT '$harga' FROM tempahan WHERE tempahan_id = ?");
        $stmt->bind_param("i", $tempahan_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE: Method to update booking details
    public function pengesahanPEE($total_harga_anggaran, $disahkan_oleh, $status_tempahan, $tempahan_id)
    {
        $stmt = $this->db->prepare("UPDATE tempahan SET total_harga_anggaran = ?, disahkan_oleh = ?, status_tempahan = ? WHERE tempahan_id = ?");
        $stmt->bind_param("sisi", $total_harga_anggaran, $disahkan_oleh, $status_tempahan, $tempahan_id);
        return $stmt->execute();
    }

    public function changeBothStatus($status_tempahan, $status_bayaran, $tempahan_id)
    {
        $stmt = $this->db->prepare("UPDATE tempahan SET status_tempahan = ?, status_bayaran = ? WHERE tempahan_id = ?");
        $stmt->bind_param("ssi", $status_tempahan, $status_bayaran, $tempahan_id);
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

    public function getAllWithStatusTempahan($status_tempahan)
    {
        $result = $this->db->query("SELECT * FROM tempahan t LEFT JOIN penyewa p ON p.id = t.penyewa_id WHERE status_tempahan = '$status_tempahan'");
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

    public function getAllResitWithStatusTempahan($status_tempahan)
    {
        $result = $this->db->query("SELECT t.tempahan_id, t.tarikh_kerja, p.nama, r.jenis_pembayaran, r.cara_bayar, r.status_resit, r.resit_id
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                LEFT JOIN resit_pembayaran r ON r.tempahan_id = t.tempahan_id
                WHERE t.status_tempahan = '$status_tempahan' AND r.status_resit != 'selesai'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
