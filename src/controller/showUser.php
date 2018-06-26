<?php
require_once 'database.class.php';

class showUser
{
    private $db;
    private $result;

    public function __construct()
    {
        $this->db = DataBase::getDB();
    }

    public function getUserById($id)
    {
        $usersRequest = "SELECT * FROM Users WHERE id=$id";
        $this->db->query($usersRequest);
        $this->result = $this->db->single();
    }

    public function out()
    {
        return $this->result;
    }
}