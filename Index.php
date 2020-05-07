<?php

require_once 'Config.php';
require_once 'libs/Core.php';

$page = ROOT::NVLA($_GET, 'page', 'chat');

$file = 'pages'.DIRECTORY_SEPARATOR.''.ucfirst(strtolower($page)).'.php';
if(!file_exists($file))
{
    echo 'File '.$file.' is not found!';
    die();
}

require_once $file;

?>