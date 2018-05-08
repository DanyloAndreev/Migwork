<?php
include_once 'database.class.php';

class Template
{
	private $db;
	private $tpl;
	private $requestCountry;
	private $requestPosition;
	private $requestEarn;
	private $content;
	private $prepareCountry;
	private $preparePosition;
	private $prepareEarn;
	private $search;
	private $paramsCountry;
	private $paramsPosition;
	private $paramsEarn;


	public function __construct($paramsCountry, $paramsPosition, $paramsEarn, $search)
	{
		$this->db = DataBase::getDB();
		$this->tpl = file_get_contents('../tpl/registration.tpl');
		$this->paramsCountry = $paramsCountry;
		$this->paramsPosition = $paramsPosition;
		$this->paramsEarn = $paramsEarn;
		$this->search = $search;
	}

	private function data()
	{
		$paramsCountry = $this->paramsCountry;
		$paramsPosition = $this->paramsPosition;
		$paramsEarn = $this->paramsEarn;
		$search = $this->search;
		$this->requestCountry = "SELECT $paramsCountry[0], $paramsCountry[1] FROM $paramsCountry[2] ORDER BY $paramsCountry[0] ASC";
		$this->requestPosition = "SELECT $paramsPosition[0], $paramsPosition[1] FROM $paramsPosition[2] ORDER BY $paramsPosition[0] ASC";
		$this->requestEarn = "SELECT $paramsEarn[0], $paramsEarn[1] FROM $paramsEarn[2] ORDER BY $paramsEarn[0] ASC";
		$this->search = $search;
		//для страны
		$this->db->query($this->requestCountry);
		$resultCountry = $this->db->resultset();//получаем данные из БД
		//для профессий
		$this->db->query($this->requestPosition);
		$resultPosition = $this->db->resultset();
		//для "Зарабатываю"
		$this->db->query($this->requestEarn);
		$resultEarn = $this->db->resultset();

		foreach ($resultCountry as $val)
		{
			$arr[$val['country_id']] = $val['title_ru'];	
		}

		foreach ($resultPosition as $val)
		{
			$arrPos[$val['prof_id']] = $val['prof_name'];	
		}

		foreach ($resultEarn as $val)
		{
			$arrEarn[$val['id']] = $val['amount'];	
		}

		for($i = 1; $i < count($arr)-1; $i++)
		{
			$this->prepareCountry .= '<option value="'.$i.'">'.$arr[$i].'</option>';//строка замены
		}

		for($i = 1; $i < count($arrPos); $i++)
		{
			$this->preparePosition .= '<option value="'.$i.'">'.$arrPos[$i].'</option>';//строка замены
		}

		for($i = 1; $i < count($arrEarn); $i++)
		{
			$this->prepareEarn .= '<option value="'.$i.'">'.$arrEarn[$i].'</option>';//строка замены
		}
		
		$replace = array(
			$this->prepareCountry,
			$this->prepareCountry,
			$this->preparePosition,
			$this->prepareEarn
		);

		return $this->content = str_replace($this->search, $replace, $this->tpl);//заменяем в шаблоне
	}

	public function out()
	{
		return $this->data();
		
	}
}


