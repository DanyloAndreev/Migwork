<?php
session_start();

var_dump($_SESSION);
ini_set('display_errors','Off');
require_once '../controller/config.php';
require_once '../controller/database.class.php';
require_once '../controller/collector.class.php';
require_once '../controller/selectRequest.class.php';
require_once '../controller/template.class.php';

/*В $_SESSION все данные с БД о пользователе с соответствующим логином и паролем*/


require_once ('../tpl/meta.tpl');
require_once ('../tpl/header_main.tpl');
require_once ('../tpl/main.tpl');

/*InfoBlock с диска по id*/
$template = new TemplateHandler();
echo $template->showInfoBlock($_SESSION, $paramsCountry, $paramsEarn, $paramsPosition);

require_once ('../tpl/mainPublish.tpl');
$template->showPost($_SESSION);



for ($i = 0; $i < count($template->out()); $i++) { 
	echo $template->out()[$i];
}

echo '<br><br>';

require_once ('../tpl/mainEnd.tpl');

require_once ('../tpl/end.tpl');
