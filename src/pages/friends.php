<?php
ob_start();
session_start();

ini_set('display_errors','0');

require_once '../controller/template.class.php';
require_once '../controller/showUser.php';


require_once ('../tpl/meta.tpl');
require_once ('../tpl/header_main.tpl');
require_once ('../tpl/friendsStart.tpl');

$template = new TemplateHandler();
$template->showUsers();

for ($i = 0; $i < count($template->out()); $i++) {
    echo $template->out()[$i];
}

if (isset($_GET['id']))
{
    $showUser = new showUser();
    $showUser->getUserById($_GET['id']);
    $_SESSION['showUser'] = $showUser->out();

    if ($_SESSION['loggedUser']['id'] == $_GET['id'])
    {
        header('Location: ../pages/main.php');
    }
    else
    {
        header('Location: ../pages/mainUser.php');
    }
}
echo '<br><br>';
echo '<br><br>';

require_once ('../tpl/mainEnd.tpl');

require_once ('../tpl/end.tpl');
ob_end_flush();