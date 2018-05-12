<?php
/*
 * Сверка логина и пароля с БД
 */
include_once 'database.class.php';
include_once 'selectRequest.class.php';
include_once 'config.php';

class Login
{
    private $select;
    private $db;
    private $table = TBL_NAME;
    private $params = array();
    private $order = TBL_ORDER;
    private $limit = TBL_LIMIT;
    private $where;
    
    public function __construct($where)
    {
        //Принимает параметр WHERE из класса Collector
        $this->db = DataBase::getDB();
        $this->where = $where;       
    }
    
    public function Request ()
    {
        //отдает параметры SQL-запроса в SelecRequest класс, возвращает сфомированный запрос
        $this->select = new selectRequest($this->table, $this->params, $this->where, $this->order, $this->limit);
        return $this->select->single();
    }
    
    public function Login()
    {
        //отправляет сформированный запрос в класс db для подготовки 
        $this->db->query($this->request());
        
        foreach ($this->where as $key => $value)
        {
            $par[] = $key;
            $val[] = $value;
        }
        
        //связывает параметр с заданным значением
        for ($i = 1; $i < count($par); $i++)
        {
            $this->db->bind(':'.$par[$i], $val[$i]);
        }
        
        $row = $this->db->resultset();//возвращает в виде ассоциативного массива
        
        if (count($row) > 0)
        {
            // echo 'Добро пожаловать на Migwork, '.$row[0]['name'];
            return true;
        }
        else
        {
            echo 'Логин или пароль неверные!';
            return false;
        }
    }
}
