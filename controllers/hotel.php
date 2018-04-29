<?php

class Hotel extends Controller {

    private $url;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->url = "https://offersvc.expedia.com/offers/v2/getOffers?scenario=deal-finder&page=foo&uid=foo&productType=Hotel";

        die();
        $this->getFilterData();
        $HotelsArray = $this->getHotelsList();
        $this->view->render('header',['title'=>'Hotels']);
        $this->view->render('index/index',['offers'=>$HotelsArray]);
        $this->view->render('hotel/hotel',['offers'=>$HotelsArray]);
        $this->view->render('footer',[]);
    }

    private function getFilterData()
    {
        $this->destinationFilter();
        $this->startDateFilter();
        $this->endDateFilter();
        $this->lengthOfStayFilter();
        $this->rateFilter();
    }

    /**
     * Filter result based on destination city
     */
    private function destinationFilter()
    {
        //Check for valid destination must be added
        if(isset($_POST["destination"]) && is_string($_POST["destination"])){
            $this->url = $this->url ."&destinationName=". $_POST["destination"];
        }
    }

    /**
     * Filter result based on trip start date
     */
    private function startDateFilter()
    {
        if(isset($_POST["start-date"])&& $this->isValidDate($_POST["start-date"])){
            $this->url = $this->url ."&minTripStartDate=". $_POST["start-date"];
        }
    }

    /**
     * Filter result based on trip end date
     */
    private function endDateFilter()
    {
        if(isset($_POST["end-date"]) && $this->isValidDate($_POST["end-date"])){
            $this->url = $this->url ."&maxTripStartDate=". $_POST["end-date"];
        }
    }

    /**
     * Filter result based on Length of stay
     */
    private function lengthOfStayFilter()
    {
        if(isset($_POST["length-of-stay"]) && is_int($_POST["length-of-stay"])){
            $this->url = $this->url ."&lengthOfStay=". $_POST["length-of-stay"];
        }
    }

    /**
     * Filter result based on hotel min star rate
     */
    private function rateFilter()
    {
        if(isset($_POST["rate"]) && is_int($_POST["rate"])){
            $this->url = $this->url ."&minStarRating=". $_POST["rate"];
        }
    }

    /**
     * Validate date
     */
    private function isValidDate($date)
    {
        if(preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $date, $matches))
        {
            if(checkdate($matches[2], $matches[3], $matches[1]))
            {
                return true;
            }
        }
    }

    /**
     * Get hotels offers list
     */
    private function getHotelsList()
    {
        try {
            $response = $this->sendRequest();
            $response = json_decode($response);

            return $response->offers;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Send http request and return the response for a given URL
     */
    private function sendRequest()
    {
        try{
            $request = curl_init($this->url);
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