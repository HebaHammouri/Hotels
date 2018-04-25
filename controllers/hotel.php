<?php

class Hotel extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $HotelsArray = $this->getHotelsList();
        $this->view->render('header',['title'=>'Hotels']);
        $this->view->render('hotel/hotel',['offers'=>$HotelsArray]);
        $this->view->render('footer',[]);
    }

    /**
     * Get hotel list
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
            $offers = json_decode($result);
            return $offers->offers;

        } catch (Exception $e) {
            return null;
        }
    }

}