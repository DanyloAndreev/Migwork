<?php
session_start();

if (isset($_POST['submit_greeting']))
{
    $_SESSION = $_POST;
    header("Location: registration.php");
}
require_once '../controller/collector.class.php';
require_once ('../tpl/meta.tpl');
require_once ('../tpl/header.tpl');
require_once ('../tpl/greeting.tpl');
require_once ('../tpl/footer.tpl');
require_once ('../tpl/end.tpl');

$collector = new Collector($_POST);//передаем введенные данные в Collector
$collector->setParams();

