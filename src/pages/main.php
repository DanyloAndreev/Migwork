<?php
//session_name('log');
session_start();
ini_set('display_errors','0');


require_once '../controller/config.php';
@require_once '../controller/database.class.php';
require_once '../controller/collector.class.php';
require_once '../controller/selectRequest.class.php';
require_once '../controller/template.class.php';
require_once '../controller/showUser.php';

/*В $_SESSION все данные с БД о пользователе с соответствующим логином и паролем*/


require_once ('../tpl/meta.tpl');
require_once ('../tpl/header_main.tpl');
require_once ('../tpl/main.tpl');

/*InfoBlock с БД по id*/
$template = new TemplateHandler();
echo $template->showInfoBlock($_SESSION['loggedUser'], $paramsCountry, $paramsEarn, $paramsPosition);

require_once ('../tpl/mainPublish.tpl');
$template->showPost($_SESSION['loggedUser']);

for ($i = 0; $i < count($template->out()); $i++) {
	echo $template->out()[$i];
}



echo '<br><br>';

require_once ('../tpl/mainEnd.tpl');

require_once ('../tpl/end.tpl');
