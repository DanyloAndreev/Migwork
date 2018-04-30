<?php
include_once 'database.class.php';

class insertRequest
{
    private $params;
    private $values;
    private $table;

    //получить в аргумент массив(первая пара имя таблицы, остальные пары имя столбца
    // +значение
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
}

