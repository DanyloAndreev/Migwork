<?php
session_start();
ini_set('display_errors','Off');
include_once '../controller/config.php';

require_once '../controller/collector.class.php';
require_once ('../tpl/meta.tpl');
require_once ('../tpl/header.tpl');

require_once ('../controller/template.class.php');
$template = new Template($paramsCountry, $paramsPosition, $paramsEarn, $search);
echo $template->out();

require_once ('../tpl/footer.tpl');
require_once ('../tpl/end.tpl');

if(isset($_POST['submit_registration']))
{
    $form = array_merge($_SESSION, $_POST);//данные с предыдущей формы + данные с текущей формы
    $collector = new Collector($form);//передаем введенные данные в Collector
    $collector->setParams();
    print_r($collector->params());
}
