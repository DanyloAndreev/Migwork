<?php
require_once '../controller/collector.class.php';
require_once ('../tpl/meta.tpl');
require_once ('../tpl/header.tpl');
require_once ('../tpl/registration.tpl');
require_once ('../tpl/footer.tpl');
require_once ('../tpl/end.tpl');

$collector = new Collector($_POST);//передаем введенные данные в Collector
print_r($collector->params());