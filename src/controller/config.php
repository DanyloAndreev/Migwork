<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "migwork");
define("DB_CHARSET", "utf8");

define("TBL_NAME", "users");
define("TBL_ORDER", array(
    'field' => 'id',
    'direction' => 'ASC'
));
define("TBL_LIMIT", "1");

$paramsCountry = array(
	'country_id',
	'title_ru',
	'Сountries'
	);
$paramsPosition = array(
	'prof_id',
	'prof_name',
	'Professions'
	);
$paramsEarn = array(
	'id',
	'amount',
	'Earn'
	);

$table = array('table' => 'users');
