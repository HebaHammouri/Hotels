<?php

class Index extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $HotelsArray = $this->getHotelsList();
        $this->view->render('header',['title'=>'Home Page']);
        $this->view->render('index/index',['default'=>'This is the main page welcome!']);
        $this->view->render('footer',[]);
    }

    /**
     * Get hotels list
     */
    private function getHotelsList()
    {
        try {
            $URL = "https://offersvc.expedia.com/offers/v2/getOffers?scenario=deal-finder&page=foo&uid=foo&productType=Hotel";
            $request = curl_init($URL);
            curl_setopt($request, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($request);
            curl_close($request);
            return $result;

        } catch (Exception $e) {
            return null;
        }
    }
    
}