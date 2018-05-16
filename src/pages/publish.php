<?php
session_start();

ini_set('display_errors','On');

include_once '../controller/insertRequest.class.php';
require_once '../controller/collector.class.php';



if (isset($_POST['submit_addPost']))
{
	$table = array('table' => 'posts');

	$_POST['id_user'] = $_SESSION['id'];

	$collector = new Collector($_POST);
	$collector->setParams();
	
	$insertRequest = new InsertRequest($collector->params(), $table);

	$db = DataBase::getDB();

	$db->beginTransaction();
	$db->query($insertRequest->request());

	for ($i = 0; $i < count($insertRequest->params()); $i++)
	{
	    $db->bind(':'.$insertRequest->params()[$i], $insertRequest->values()[$i]);
	}

	if($db->execute())
	{
		if(!empty($_FILES['postImg']['tmp_name']))
		{
			copy($_FILES['postImg']['tmp_name'], '../media/img/'.$_SESSION['id'].'/'.$db->lastInsertId().'_post.jpg');
		}
	}
	else
	{
		$db->cancelTransaction();
		echo 'Что то пошло не так!';
		exit();
	}

	$db->endTransaction();
}


require_once ('../tpl/meta.tpl');
require_once ('../tpl/header_main.tpl');
require_once ('../tpl/main.tpl');

require_once ('../tpl/mainAddPost.tpl');



require_once ('../tpl/mainEnd.tpl');



require_once ('../tpl/end.tpl');
