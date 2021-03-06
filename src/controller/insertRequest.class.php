<?php
include_once 'database.class.php';

class InsertRequest
{
    private $params;
    private $values;
    private $table;

    //получить в аргумент массив(первый аргумент имя столбца в таблице + значение, второй таблица + имя таблицы
    public function __construct($input, $table)
    {
        foreach ($input as $key => $value)
        {
            $this->params[] = $key;
            $this->values[] = $value;
        }
        foreach ($table as $value)
        {
            $this->table = $value;
        }
    }

    public function request()
    {
        //массив параметров в строку
        $params = implode(", ", $this->params);

        //подготовка VALUES
        $preValues = '';
        for ($i = 0; $i < count($this->params); $i++)
        {
            $preValues .= ':' . $this->params[$i] . ', ';
        }

        return 'INSERT INTO '.$this->table.' '.'('.$params.')'
            .' VALUES '.'('.substr(trim($preValues), 0, -1).')' . '';
    }

    public function params()
    {
        return $this->params;
    }

     public function values()
    {
        return $this->values;
    }
}