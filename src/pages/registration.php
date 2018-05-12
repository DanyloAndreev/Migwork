<?php
session_start();
ini_set('display_errors','off');
include_once '../controller/config.php';
include_once '../controller/insertRequest.class.php';
include_once '../controller/config.php';
include_once '../controller/database.class.php';


require_once '../controller/collector.class.php';
require_once ('../tpl/meta.tpl');
require_once ('../tpl/header.tpl');

require_once ('../controller/template.class.php');
$template = new Template($paramsCountry, $paramsPosition, $paramsEarn, $search);//параметры из конфига
echo $template->out(); // вывод параметров из БД

require_once ('../tpl/footer.tpl');
require_once ('../tpl/end.tpl');

if(isset($_POST['submit_registration']))
{
    $form = array_merge($_SESSION, $_POST);//данные с предыдущей формы + данные с текущей формы
    $collector = new Collector($form);//передаем введенные данные в Collector
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
		$structure = '../media/img/'.$dbReg->lastInsertId().'';//создаем папку для изображений пользователя
		if (!mkdir($structure, 0777, true))
		{
		    die('Не удалось создать директории...');
		}
		else
		{
			copy($_FILES['user_foto']['tmp_name'], '../media/img/'.$dbReg->lastInsertId().'/'.$dbReg->lastInsertId().'_original.jpg');//копируем фото в папку пользователя
		}
		
		$dbReg->endTransaction();
		// $_SESSION['pass'] = md5($_SESSION['pass']);
		$_SESSION['pass_confirm'] = null;
		echo '<script>window.location = "../pages/main.php"</script>';
	}
	else
	{
		$dbReg->cancelTransaction();
		echo 'Что то пошло не так!, '.$insertRequest->values()[3];
		exit();
	}
}