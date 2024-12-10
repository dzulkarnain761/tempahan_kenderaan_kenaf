<?php

require_once 'Account.php';

class Admin extends Account
{

    private $kumpulan;
    private $negeri;
    
    // CREATE: Method to insert a new user
    public function create($nama, $no_kp, $contact_no, $kumpulan, $negeri, $password)
    {
        $stmt = $this->db->prepare("INSERT INTO admin (nama, no_kp, contact_no, kumpulan, negeri, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nama, $no_kp, $contact_no, $kumpulan, $negeri, $password);
        return $stmt->execute();
    }

    // READ: Method to get user by ID
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // UPDATE: Method to update user details
    public function update($id, $nama, $no_kp, $contact_no, $kumpulan, $negeri, $password)
    {
        $stmt = $this->db->prepare("UPDATE admin SET nama = ?, no_kp = ?, contact_no = ?, kumpulan = ?, negeri = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $nama, $no_kp, $contact_no, $kumpulan, $negeri, $password, $id);
        return $stmt->execute();
    }

    // DELETE: Method to delete a user by ID
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM admin WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Method to get all users
    public function getAdmin()
    {
        $result = $this->db->query("SELECT * FROM admin");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to get all users
    public function getPEE()
    {
        $result = $this->db->query("SELECT * FROM admin WHERE kumpulan = 'D'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to get all users
    public function getPemandu()
    {
        $result = $this->db->query("SELECT * FROM admin WHERE kumpulan = 'Y'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to get total row
    public function getTotalStaff()
    {
        $result = $this->db->query("SELECT COUNT(*) as total FROM admin");
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
