<?php


require_once 'Database.php';
class Account
{
    protected $id;
    protected $nama;
    protected $email;
    protected $no_kp;
    protected $password;
    protected $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    
}


