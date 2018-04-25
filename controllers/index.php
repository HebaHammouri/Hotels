<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->render('header',['title'=>'Home Page']);
        $this->view->render('index/index',['default'=>'This is the main page welcome!']);
        $this->view->render('footer',[]);
    }
    
}