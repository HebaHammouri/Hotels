<?php

require 'config.php';
if(!isset($_GET['url'])){
    $_GET['url'] = 'hotel';
}
function __autoload($class) {
    require LIBS . $class .".php";
}
$bootstrap = new Bootstrap();
$bootstrap->init();