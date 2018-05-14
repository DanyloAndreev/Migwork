<?php
session_start();

ini_set('display_errors','On');
include_once '../controller/config.php';
include_once '../controller/database.class.php';
require_once '../controller/collector.class.php';
include_once '../controller/selectRequest.class.php';
include_once '../controller/template.class.php';

/*В $_SESSION все данные с БД о пользователе с соответствующим логином и паролем*/


require_once ('../tpl/meta.tpl');
require_once ('../tpl/header_main.tpl');
require_once ('../tpl/main.tpl');

/*Аватар с диска по id*/
$template = new TemplateHandler();
echo $template->showInfoBlock($_SESSION, $paramsCountry, $paramsEarn, $paramsPosition);

require_once ('../tpl/mainEnd.tpl');

require_once ('../tpl/end.tpl');
