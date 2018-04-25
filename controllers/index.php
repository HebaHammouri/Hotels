<?php

class Index extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $URL = "https://offersvc.expedia.com/offers/v2/getOffers?scenario=deal-finder&page=foo&uid=foo&productType=Hotel";
        $this->getHotels($URL);
        $this->view->render('header',['title'=>'Home Page']);
        $this->view->render('index/index',['default'=>'This is the main page welcome!']);
        $this->view->render('footer',[]);
    }

    private function getHotels($URL)
    {
        try {
            $oResponse = Httpful\Request::get($URL)
                ->expectsJson()
                ->send();

           dump($oResponse);die();

        } catch (Exception $e) {

        }
    }
    
}