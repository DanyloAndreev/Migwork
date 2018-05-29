<?php
session_start();

ini_set('display_errors','On');
require_once ('../controller/database.class.php');
require_once ('../controller/collector.class.php');
require_once ('../controller/selectRequest.class.php');
require_once ('../controller/login.class.php');

if(isset($_SESSION['email']))
{
	$params['email'] = $_SESSION['email'];
	$params['pass'] = $_SESSION['pass'];
}

$collector = new Collector($params);//передаем введенные данные в Collector
//var_dump($collector->where());
$login = new Login($collector->where());//передаем параметры в класс авторизации
if($login->login())
{
	$_SESSION = $login->userDbData()[0];
	header("Location: main.php");
}
else echo '.i.';
