<?php

require 'config.php';
if(!isset($_GET['url'])){
    $_GET['url'] = 'index';
}
function __autoload($class) {
    require LIBS . $class .".php";
}
$bootstrap = new Bootstrap();
$bootstrap->init();