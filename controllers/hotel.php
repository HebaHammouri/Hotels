<?php

class Hotel extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $HotelsArray = $this->getHotelsList();

        $this->view->render('header',['title'=>'Hotels']);
        $this->view->render('hotel/hotel',['offers'=>$HotelsArray]);
        $this->view->render('footer',[]);
    }

    /**
     * Get hotels offers list
     */
    private function getHotelsList()
    {
        try {
            $Url = "https://offersvc.expedia.com/offers/v2/getOffers?scenario=deal-finder&page=foo&uid=foo&productType=Hotel";
            $response = $this->sendRequest($Url);
            $response = json_decode($response);

            return $response->offers;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Send http request and return the response for a given URL
     */
    private function sendRequest($Url)
    {
        try{
            $request = curl_init($Url);
            curl_setopt($request, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($request);
            curl_close($request);

            return $result;
        } catch (Exception $e){
            return null;
        }

    }

}