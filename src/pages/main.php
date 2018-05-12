<?php
session_start();
include_once '../controller/config.php';
include_once '../controller/database.class.php';
require_once '../controller/collector.class.php';
include_once '../controller/selectRequest.class.php';
/*Проверка наличия записи в БД по email и pass*/
$db = DataBase::getDB();
$collector = new Collector($_SESSION);

$order = TBL_ORDER;
$limit = TBL_LIMIT;
$selectRequest = new selectRequest($table, $params = [], $collector->where(), $order, $limit);

$db->beginTransaction();
$db->query($selectRequest->single());
foreach ($collector->where() as $key => $value)
    {
        $par[] = $key;
        $val[] = $value;
    }
    for ($i = 1; $i < count($par); $i++)
    {
        $db->bind(':'.$par[$i], $val[$i]);
    }
        
$row = $db->resultset();
print_r($row);
$db->endTransaction();


require_once ('../tpl/meta.tpl');
require_once ('../tpl/header_main.tpl');
require_once ('../tpl/main.tpl');
require_once ('../tpl/avatar.tpl');
require_once ('../tpl/mainEnd.tpl');

require_once ('../tpl/end.tpl');
