<?php
include_once 'database.class.php';

class addRow
{
    private $params;
    private $values;

    //получить в аргумент массив(первая пара имя таблицы, остальные пары имя столбца
    // +значение
    public function __construct($input)
    {
        foreach ($input as $key => $value)
        {
            $this->params[] = $key;
            $this->values[] = $value;
        }
    }

    public function request()
    {
        //массив параметров в строку
        $params = implode(", ", $this->params);
        $params = trim(stristr($params,' '));

        //подготовка VALUES
        $preValues = '';
        for ($i = 1; $i < count($this->params); $i++)
        {
            $preValues .= ':' . $this->params[$i] . ', ';
        }

        return 'INSERT INTO '.$this->values[0].' '.'('.$params.')'
            .' VALUES '.'('.substr(trim($preValues), 0, -1).')' . '';
    }
}
