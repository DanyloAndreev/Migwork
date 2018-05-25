<?php
session_start();
ini_set('display_errors','off');
require_once '../controller/config.php';
require_once '../controller/insertRequest.class.php';
require_once '../controller/config.php';
require_once '../controller/database.class.php';
require_once '../controller/imgHandler.class.php';


require_once '../controller/collector.class.php';
require_once ('../tpl/meta.tpl');
require_once ('../tpl/header.tpl');


require_once ('../controller/template.class.php');
$template = new TemplateHandler();//параметры из конфига
$template->selectRegData($paramsCountry, $paramsPosition, $paramsEarn);
echo $template->out(); // вывод параметров из БД

require_once ('../tpl/footer.tpl');
require_once ('../tpl/end.tpl');

if(isset($_POST['submit_registration']))
{
    $form = array_merge($_SESSION, $_POST);//данные с предыдущей формы + данные с текущей формы
    $collector = new Collector($form);
    $collector->setParams();

    $insertRequest = new InsertRequest($collector->params(), $table);


	$dbReg = DataBase::getDB();
	$dbReg->beginTransaction();
	$dbReg->query($insertRequest->request());
	for ($i = 0; $i < count($insertRequest->params()); $i++)
	{
	    $dbReg->bind(':'.$insertRequest->params()[$i], $insertRequest->values()[$i]);
	}
	if($dbReg->execute())
	{
		$lastInsertId = $dbReg->lastInsertId();
		$structure = '../media/img/'.$lastInsertId.'';//создаем папку для изображений пользователя
		if (!mkdir($structure, 0777, true))
		{
		    echo 'Не удалось создать директории...';
		}
		else
		{
			$img = new imgHandler($_FILES['postImg']['tmp_name'], 1024, 768);
			$img->newImg();
			copy($_FILES['user_foto']['tmp_name'], '../media/img/'.$lastInsertId.'/'.$lastInsertId.'_original.jpg');//копируем фото в папку пользователя
		}
		
		$dbReg->endTransaction();
		$_SESSION['pass_confirm'] = null;
		$_SESSION['id'] = $lastInsertId;
		echo '<script>window.location = "../pages/main.php"</script>';
	}
	else
	{
		$dbReg->cancelTransaction();
		echo 'Что то пошло не так!, '.$insertRequest->values()[3];
	}
}