<?php

class View {

    function __construct() {

    }

    public function render($name,$data)
    {
        require 'vendor/autoload.php';
        $loader = new Twig_Loader_Filesystem('views');
        $twig = new Twig_Environment($loader, array('cache' => 'tmp'));
        echo $twig->render($name.'.twig', $data);
    }

}