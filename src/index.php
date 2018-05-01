<?php require_once ('/controller/database.class.php');?>
<?php require_once ('/controller/collector.class.php');?>
<?php require_once ('/controller/selectRequest.class.php');?>
<?php require_once ('/controller/login.class.php');?>
<?php require_once ('/tpl/meta.tpl');?>
<?php require_once ('/tpl/header.tpl');?>
<?php require_once ('/tpl/greeting.tpl')?>
<?php require_once ('/tpl/footer.tpl')?>
<?php require_once ('/tpl/end.tpl')?>

<?php


$collector = new Collector($_POST);
$login = new Login($collector->where());
$login->login();