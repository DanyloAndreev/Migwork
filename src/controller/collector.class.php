<?php

class Collector
{
    private $params;
   
    public function __construct($form)
    {
        $this->params['email'] = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        
        if (is_string($form['pass']))
        {
            $this->params['pass'] = $form['pass'];
        }
    }
    
    public function params()
    {
        return $this->params;
    }
 }