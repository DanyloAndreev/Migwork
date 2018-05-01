<?php
include_once 'database.class.php';

class selectRequest
{
    private $table;
    private $params;
    private $values;
    private $where;
    private $whereValue;
    private $order;
    private $orderValue;
    private $limit;

    public function __construct($table, $params, $where, $order, $limit)
    {
        $this->table = $table;
        foreach ($params as $key => $value)
        {
            $this->params[] = $key;
            $this->values[] = $value;
        }
        foreach ($where as $key => $value)
        {
            $this->where[] = $key;
            $this->whereValue[] = $value;
        }
        foreach ($order as $key => $value)
        {
            $this->order[] = $key;
            $this->orderValue[] = $value;
        }
        $this->limit = $limit;
    }

    public function single()
    {
        if(count($this->params) == 0)
        {
            $params = '*';
        }
        else
        {
            $params = implode(", ", $this->params);
        }

        //подготовка VALUES
        $preValues = '';
        for ($i = 0; $i < count($this->params); $i++)
        {
            $preValues .= ':' . $this->params[$i] . ', ';
        }

        //подготовка WHERE
        $preWhere = '';
        for ($i = 1; $i < count($this->where); $i++)
        {
            $preWhere .= $this->where[$i].' '.$this->whereValue[0].' :'.$this->where[$i].' AND '
            ;
        }
        $preWhere = substr($preWhere, 0, -4);

        //подготовка ORDER BY
        $preOrder = $this->orderValue[0].' '.$this->orderValue[1];

        return 'SELECT '.$params.' FROM '.$this->table.' WHERE '.$preWhere.
            ' ORDER BY '.$preOrder.' LIMIT '.$this->limit;
    }
}