<?php
/*
 * Собирает и обрабатывает пользовательские данные из форм
 */
class Collector
{
    private $where;
    private $params;
    private $form;
   
    public function __construct($form)
    {
        $this->form = $form;
    }
    
    public function setWhere()
    {
        /*формирует WHERE для SQL-запроса для авторизации*/
        $form = $this->form;
        $this->where['condition'] = '=';//email = email
        $this->where['email'] = filter_var($form['email'], FILTER_VALIDATE_EMAIL);
        
        if (is_string($form['pass']))
        {
            $this->where['pass'] = md5(trim(strip_tags($form['pass'])));
        }
    }

    public function setParams()
    {
       /*параметры для INSERT из формы регистрации*/
        $form = $this->form;
        
        //Validate email
        $this->params['email'] = filter_var($form['email'], FILTER_VALIDATE_EMAIL);

        //validate tel        
        if(preg_match("/[0-9]{10}/", $form['tel']))
        {
            $this->params['tel'] = '+38'.$form['tel'];
        }

        //validate password
        if($this->validate($form['pass']) === $this->validate($form['pass_confirm']))
        {
            $this->params['pass'] = md5($this->validate($form['pass']));
        }

        //validate date
        $this->params['birthday'] = $this->validate(str_replace("-","", $form['birthday']));
        
        //validate name
        $this->params['name'] = $this->validate($form['name']);//validate name
        
        //validate surname
        $this->params['surname'] = $this->validate($form['surname']);//validate surname
        
        //validate country
        $this->params['native_country'] = $this->validate($form['native_country']);
        
        //validate country
        $this->params['work_at'] = $this->validate($form['work_at']);

        // validate position
        $this->params['position'] = $this->validate($form['position']);

        //validate Earn
        $this->params['earn'] = $this->validate($form['earn']);

        //validate about
        $this->params['about'] = $this->validate($form['about']);

        //Registration date
        $this->params['reg_date'] = date("Y-m-d H:i:s");
    }
    
    /*Helpful functions*/
    private function validate($input)
    {
        if(!empty($input) && is_string($input))
        {
            return trim(strip_tags(stripslashes(htmlspecialchars($input))));
        }
        else
        {
            return false;
        }
    }
    
    /*return functions*/
    public function where()
    {
        $this->setWhere();
        return $this->where;
    }
    
    public function params()
    {
        return $this->params;
    }
 }