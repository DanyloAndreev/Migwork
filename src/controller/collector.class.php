<?php

/*
 * Собирает и обрабатывает пользовательские данные с форм
 */
class Collector
{
    private $where;
    private $params;
   
    public function __construct($form)
    {
        /*формирует WHERE для SQL-запроса для авторизации*/
        $this->where['condition'] = '=';//email = email
        $this->where['email'] = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        
        if (is_string($form['pass']))
        {
            $this->where['pass'] = md5(trim(strip_tags));
        }
        
        /*параметры для INSERT из формы регистрации*/
        $this->params['email'] = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);//Validate email
        
        //validate name
        $this->params['name'] = $this->validate($form['name']);//validate name
        
        //validate surname
        $this->params['surname'] = $this->validate($form['surname']);//validate surname
        
        //validate password
        if($this->validate($form['pass']) === $this->validate($form['pass_confirm']))
        {
            $this->params['pass'] = md5($this->validate($form['pass']));
        }
        
        //validate date
        $this->params['birthday'] = $this->validate(str_replace("-","", $form['birthday']));
        
    }
    
    public function where()
    {
        return $this->where;
    }
    
    public function params()
    {
        return $this->params;
    }
    
    private function validate($input)
    {
        if(!empty($input) && is_string($input))
        {
            return trim(strip_tags(stripslashes($input)));
        }
        else
        {
            return false;
        }
    }
 }