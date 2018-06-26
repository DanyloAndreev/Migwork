<?php
ob_start();
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

if(isset($_POST['login_submit']))
{
	$params['email'] = $_POST['email'];
	$params['pass'] = $_POST['pass'];
}

$collector = new Collector($params);//передаем введенные данные в Collector
//var_dump($collector->where());
$login = new Login($collector->where());//передаем параметры в класс авторизации
if($login->login())
{
	$_SESSION['loggedUser'] = $login->userDbData()[0];
    header('Location: ../pages/main.php');
}
ob_end_flush();