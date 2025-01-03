<?php

require_once 'Account.php';

class Penyewa extends Account
{

    private $alamat;
    private $nama_bank;
    private $no_bank;
    
    // CREATE: Method to insert a new user
    public function create($nama, $no_kp, $contact_no, $alamat, $nama_bank, $no_bank, $password)
    {
        $stmt = $this->db->prepare("INSERT INTO penyewa (nama, no_kp, contact_no, alamat, nama_bank, no_bank, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nama, $no_kp, $contact_no, $alamat, $nama_bank, $no_bank, $password);
        return $stmt->execute();
    }

    
    public function update($id, $nama, $no_kp, $contact_no, $alamat, $nama_bank, $no_bank, $password)
    {
        $stmt = $this->db->prepare("UPDATE penyewa SET nama = ?, no_kp = ?, contact_no = ?, alamat = ?, nama_bank = ?, no_bank = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $nama, $no_kp, $contact_no, $alamat, $nama_bank, $no_bank, $password, $id);
        return $stmt->execute();
    }

    // DELETE: Method to delete a user by ID
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM penyewa WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Method to get all users
    public function all()
    {
        $result = $this->db->query("SELECT * FROM penyewa");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM penyewa WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function isBankInfoExist($penyewa_id)
    {
        $stmt = $this->db->prepare("SELECT nama_bank, no_bank FROM penyewa WHERE id = ?");
        $stmt->bind_param("i", $penyewa_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return !empty($row['nama_bank']) && !empty($row['no_bank']);
        }
        return false;
    }
}
