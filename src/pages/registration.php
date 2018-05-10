<?php
session_start();
ini_set('display_errors','Off');
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
}

$insertRequest = new InsertRequest($collector->params(), $table);


try
{
	$db = DataBase::getDB();
	$db->beginTransaction();
	$db->query($insertRequest->request());
	for ($i = 0; $i < count($insertRequest->params()); $i++)
	{
	    $db->bind(':'.$insertRequest->params()[$i], $insertRequest->values()[$i]);
	}
	$db->execute();
}
catch (PDOException $e)
{
	$db->cancelTransaction();
	echo 'Что то пошло не так, '.$insertRequest->values()[3]. '  '.$e->getCode();
	exit();
}
$db->endTransaction();
echo 'Успешная регистрация, '.$insertRequest->values()[3];
echo $db->lastInsertId();