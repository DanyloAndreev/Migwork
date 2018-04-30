<?php
include_once 'database.class.php';
include_once 'selectRequest.class.php';

class Login
{
    private $select;
    private $db;
    private $table;
    
    public function __construct()
    {
        $this->table = 'users';
        $this->db = DataBase::getDB();
        $this->select = new selectRequest($this->table, $params, $where, $order, $limit);       
    }
    
    public function Login ($email, $pass)
    {
       if(!empty($email) && !empty($pass))
       {
           
       }
        else
        {
            echo 'Please enter email and password';
        }
     
    }
}
