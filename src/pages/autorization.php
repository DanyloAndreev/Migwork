<?php
session_start();

ini_set('display_errors','Off');
require_once ('../controller/database.class.php');
require_once ('../controller/collector.class.php');
require_once ('../controller/selectRequest.class.php');
require_once ('../controller/login.class.php');


$collector = new Collector($_POST);//передаем введенные данные в Collector

$login = new Login($collector->where());//передаем параметры в класс авторизации
if($login->login())
{
	header("Location: main.php");
}
