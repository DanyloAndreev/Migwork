<?php
session_start();

if(isset($_POST['login_submit']))
{
	header("Location: autorization.php");
}

if (isset($_POST['submit_greeting']))
{
	if($_POST['pass'] == $_POST['pass_confirm'])
	{
    $_SESSION = $_POST;
    header("Location: registration.php");
	}
	//else echo 'Пароли не совпадают';
}
require_once '../controller/collector.class.php';
require_once ('../tpl/meta.tpl');
require_once ('../tpl/header.tpl');
require_once ('../tpl/greeting.tpl');
require_once ('../tpl/footer.tpl');
require_once ('../tpl/end.tpl');

$collector = new Collector($_POST);//передаем введенные данные в Collector
$collector->setParams();

