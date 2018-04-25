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
            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            die($result);

        } catch (Exception $e) {

        }
    }
    
}