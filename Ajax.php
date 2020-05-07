<?php

require_once 'Config.php';
require_once 'libs/Time.php';
require_once 'libs/Core.php';

$page = ROOT::NVLA($_GET, 'page', 'chat');

$model = 'models'.DIRECTORY_SEPARATOR.''.ucfirst(strtolower($page)).'Sql.php';
if(!file_exists($model))
{
    echo 'Model-File '.$model.' is not found!';
    die();
}

require_once $model;

$modelClass = ucfirst(strtolower($page)).'Sql';
if(!class_exists($modelClass))
{
    echo 'Class '.$modelClass.' is not found!';
    die();
}

$base = new $modelClass();
$action = ROOT::NVLA($_REQUEST, 'action', null);

if(!method_exists($base, $action))
{
    echo 'Method '.$action.' is not found!';
    die();
}

$base->$action($_REQUEST);

?>