<?php

/*
 * Собирает и обрабатывает пользовательские данные с форм
 */
class Collector
{
    private $where;
   
    public function __construct($form)
    {
        //формирует WHERE для SQL-запроса
        $this->where['condition'] = '=';//email = email
        $this->where['email'] = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        
        if (is_string($form['pass']))
        {
            $this->where['pass'] = md5($form['pass']);
        }
    }
    
    public function where()
    {
        return $this->where;
    }
    
 }