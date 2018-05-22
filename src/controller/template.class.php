<?php
/*Обработчик всех шаблонов, с подстановкой данных из БД*/
include_once 'database.class.php';

class TemplateHandler
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
	private $resultCountry;


	public function __construct()
	{
		$this->db = DataBase::getDB();
		
	}

	/*Вывод select на странице регистрации из БД*/
	public function selectRegData($paramsCountry, $paramsPosition = [], $paramsEarn = [])
	{
		$this->tpl = file_get_contents('../tpl/registration.tpl');
		$this->requestCountry = "SELECT $paramsCountry[0], $paramsCountry[1] FROM $paramsCountry[2] ORDER BY $paramsCountry[0] ASC";
		$this->requestPosition = "SELECT $paramsPosition[0], $paramsPosition[1] FROM $paramsPosition[2] ORDER BY $paramsPosition[0] ASC";
		$this->requestEarn = "SELECT $paramsEarn[0], $paramsEarn[1] FROM $paramsEarn[2] ORDER BY $paramsEarn[0] ASC";
		$this->search = array(
			'%optionNativeCountry%',
			'%optionWorkAt%',
			'%optionPosition%',
			'%optionEarn%'
			);
		//для страны
		$this->db->query($this->requestCountry);
		$this->resultCountry = $this->db->resultset();//получаем данные из БД
		//для профессий
		$this->db->query($this->requestPosition);
		$resultPosition = $this->db->resultset();
		//для "Зарабатываю"
		$this->db->query($this->requestEarn);
		$resultEarn = $this->db->resultset();

		foreach ($this->resultCountry as $val)
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

		$this->content = str_replace($this->search, $replace, $this->tpl);//заменяем в шаблоне
	}

	public function showInfoBlock($session, $paramsCountry, $paramsEarn, $paramsPosition)
	{
		$tpl = file_get_contents('../tpl/mainInfoBlock.tpl');

		//данные о стране происхождения пользователя
		$nativeCountry = "SELECT $paramsCountry[0], $paramsCountry[1] FROM $paramsCountry[2] WHERE country_id=$session[native_country] ORDER BY $paramsCountry[0] ASC";
		$this->db->query($nativeCountry);
		$resultNativeCountry = $this->db->resultset();//получаем данные из БД
		//данные о стране работы пользователя
		$workAt = "SELECT $paramsCountry[0], $paramsCountry[1] FROM $paramsCountry[2] WHERE country_id=$session[work_at] ORDER BY $paramsCountry[0] ASC";
		$this->db->query($workAt);
		$resultWorkAt = $this->db->resultset();//получаем данные из БД
		//данные о заработке пользователя
		$earn = "SELECT $paramsEarn[0], $paramsEarn[1] FROM $paramsEarn[2] WHERE id=$session[earn] ORDER BY $paramsEarn[0] ASC";
		$this->db->query($earn);
		$resultEarn = $this->db->resultset();//получаем данные из БД
		//данные о професси пользователя
		$position = "SELECT $paramsPosition[0], $paramsPosition[1] FROM $paramsPosition[2] WHERE prof_id=$session[position] ORDER BY $paramsPosition[0] ASC";
		$this->db->query($position);
		$resultPosition = $this->db->resultset();//получаем данные из БД

		$search = array(
			'%avatar%',
			'%surname%',
			'%name%',
			'%email%',
			'%tel%',
			'%birthday%',
			'%native_country%',
			'%work_at%',
			'%earn%',
			'%position%');
		$replace = array(
			'../media/img/'.$session['id'].'/'.$session['id'].'_original.jpg',
			$session['surname'],
			$session['name'],
			$session['email'],
			$session['tel'],
			$session['birthday'],
			$resultNativeCountry[0][title_ru],
			$resultWorkAt[0][title_ru],
			$resultEarn[0][amount],
			$resultPosition[0][prof_name]);
		$result = str_replace($search, $replace, $tpl);

		return $result;
	}

	public function showPost($session)
	{
		$tpl = file_get_contents('../tpl/mainPost.tpl');

		$postsRequest = "SELECT * FROM POSTS WHERE id_user=$session[id]";
		$this->db->query($postsRequest);
		$resultPosts = $this->db->resultset();
		
		
		for($i = 0; $i < count($resultPosts); $i++)
		{
				$search = array(
					'%postDate%',
					'%postImg%',
					'%postText%',
					'%postLike%',
					'%postComments%',
					'%postPublisher%',
					'%postPublisherAva%');

				$replace = array(
					$resultPosts[$i]['time'],
					'../media/img/'.$resultPosts[$i]['id_user'].'/'.$resultPosts[$i]['id'].'_post.jpg',
					$resultPosts[$i]['text'],
					$resultPosts[$i]['post_like'],
					$resultPosts[$i]['comments'],
					$session['name'].' '.$session['surname'],
					'../media/img/'.$resultPosts[$i]['id_user'].'/'.$resultPosts[$i]['id_user'].'_original.jpg');
				
				$result[$i] = str_replace($search, $replace, $tpl);
		}

		$this->content = $result;
	}

	public function out()
	{
		return $this->content;
	}
}


