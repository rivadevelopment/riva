<?php
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . 'modules/Api/libraries/REST_Controller.php';

class Tour extends REST_Controller {

    function __construct() {
        // Construct our parent class
        parent :: __construct();
        if(!$this->isValidApiKey){
            $this->response($this->invalidResponse, 400);
        }
        $this->output->set_content_type('application/json');
        $this->load->library('ApiClient');


        $this->load->library('Tours/Tours_lib');
        $this->load->model('Admin/Modules_model');
        $this->load->model('Admin/Locations_model');
    }

    function book_post(){
            // dd($this->post());die;
            $param = array(
                'tour_id' => $this->post('tour_id'),
                'name' => $this->post('name'),
                'tour_type' => $this->post('tour_type'),
                'location' => $this->post('location'),
                'img' => $this->post('img'),
                'booking_checkin' => $this->post('checkin'),
                'booking_checkout' => $this->post('checkout'),
                'desc' => $this->post('desc'),
                'price' => $this->post('price'),
                'transaction_id' => $this->post('transaction_id'),
                'transaction_status' => $this->post('transaction_status'),
                'actual_price' => $this->post('actual_price'),
                'couponid' => 0,
                'b2c_price_adult' => $this->post('b2c_price_adult'),
                'b2b_price_adult' => $this->post('b2b_price_adult'),
                'b2e_price_adult' => $this->post('b2e_price_adult'),
                'b2c_price_child' => $this->post('b2c_price_child'),
                'b2b_price_child' => $this->post('b2b_price_child'),
                'b2e_price_child' => $this->post('b2e_price_child'),
                'b2c_price_infant' => $this->post('b2c_price_infant'),
                'b2b_price_infant' => $this->post('b2b_price_infant'),
                'b2e_price_infant' => $this->post('b2e_price_infant'),
                'b2c_markup' => $this->post('b2c_markup'),
                'b2b_markup' => $this->post('b2b_markup'),
                'b2e_markup' => $this->post('b2e_markup'),
                'adult_price' => $this->post('adult_price'),
                'child_price' =>  $this->post('child_price'),
                'infant_price' =>  $this->post('infant_price'),
                'maxAdults' =>  $this->post('maxAdults'),
                'maxChild' =>  $this->post('maxChild'),
                'maxInfant' =>  $this->post('maxInfant'),
                'endpoint' => site_url()."/api/tours/tourbooking?appKey=".$this->input->get('appKey'),
                'rating' => $this->post('rating'),
                'longitude' => $this->post('longitude'),
                'latitude' => $this->post('latitude'),
                'redirect' => $this->post('redirect'),
                'inclusions' => $this->post('inclusions'),
                'exclusions' => $this->post('exclusions'),
                'currencycode' => $this->post('currencycode'),
                'user_id' => $this->post('user_id'),
                'guest' => $this->post('guest'),
                'booking_from' => $this->post('booking_from'),
                'price_type' => $this->post('price_type'),
                'duration' => $this->post('duration'),
                'policy' => $this->post('policy'),
                'max_travellers' => $this->post('max_travellers'),
                'departure_time' => $this->post('departure_time'),
                'departure_point' => $this->post('departure_point'),
                'taxType' => $this->post('taxType'),
                'taxValue' => $this->post('taxValue'),
                'booking_supplier' => $this->post('supplier'),
                'travellers' => $this->post('travellers'),
                'firstname' => $this->post('firstname'),
                'lastname' => $this->post('lastname'),
                'email' => $this->post('email'),
                'address' => $this->post('address'),
                'phone' => $this->post('phone'),
                'adults' => $this->post('adults'),
                'childs' => $this->post('childs'),
                'infants' => $this->post('infants'),
                'payment_gateway' => $this->post('payment_gateway'),
                'country_code' => $this->post('country_code'),
                'nationality' => $this->post('nationality'),
                'invoice_url' => $this->post('invoice_url'),
                'booking_item'=>'0',
            );

            $tours = new ApiClient();
            $book = $tours->sendRequest('POST', 'search', $param);
            // dd($book);die;
            if(!empty($book)){
                $checkbooking = json_decode($book);
                
                $site_url = $this->post('invoice_url').$checkbooking->response->sessid."/".$checkbooking->response->id;

                 $this->Tours_lib->invoceurlupdate($checkbooking->response->id,$site_url);
                 // print_r($site_url);die;
                $bookingResult = array('response'=>true,'id'=>$checkbooking->response->id,'sessid'=>$checkbooking->response->sessid);
              $this->response($bookingResult);
            }
            
            
            //  $bookingResult = array('response'=>$book);
            //  $this->response($bookingResult);
            
             
            
    }

    //Aggregate Feature
    public function search_post(){
        //Manaul Tour Search API
        $Tours = $this->App->service('ModuleService')->isActive("Tours");
        $manaultour = $this->App->service('ModuleService')->getmodulesdata("Tours");
       if($Tours == 1){
           $loc_id = $this->Locations_model->getLocationDet($this->post('loaction'));
           $param = array(
               'endpoint' => site_url().'api/tours/search?appKey='.$this->input->get('appKey'),
               'city' => $loc_id
           );

           $tours = new ApiClient();
           $response = $tours->sendRequest('POST', 'search', $param);
           $re = json_decode($response);
           $arry = array();

           $b2c_markup = $manaultour[0]->b2c_markup;
           $b2b_markup = $manaultour[0]->b2b_markup;
           $b2e_markup = $manaultour[0]->b2e_markup;
           $servicefee = $manaultour[0]->servicefee;

           foreach ($re->response as $index => $data) {

               $price = round($data->price);
               $b2c_price = ($b2c_markup / 100) * $price;
               $b2b_price = ($b2b_markup / 100) * $price;
               $b2e_price = ($b2e_markup / 100) * $price;
               array_push($arry, (object)[
                   'tour_id' =>$data->tour_id,
                   'name' => $data->name,
                   'location' => $data->location,
                   'img' => $data->img,
                   'desc' => strip_tags($data->desc),
                   'price' => round($data->price),
                   'actual_price' => $data->price,
                   'b2c_price' => round($price + $b2c_price),
                   'b2b_price' => round($price + $b2b_price),
                   'b2e_price' => round($price + $b2e_price),
                   'b2c_markup' => $b2c_markup,
                   'b2b_markup' => $b2b_markup,
                   'b2e_markup' => $b2e_markup,
                   'service_fee' => $servicefee,
                   'duration' => $data->duration,
                   'rating' => $data->rating,
                   'redirected' => $data->redirected,
                   'supplier' => $data->supplier,
                   'latitude' => $data->latitude,
                   'longitude' => $data->longitude,
                   'currency_code' => $data->currency_code

               ]);

           }
       }


        // Multithreading Tours Search Api's
        $Multithreading = $this->App->service('ModuleService')->tourmodules();
        $array = array();
        foreach ($Multithreading as $key=>$value){
            $getvalue = $this->Modules_model->getmodulename($value['name']);
            $param = array(
                'c1' => $getvalue[0]->c1,
                'c2' => $getvalue[0]->c2,
                'c3' => $getvalue[0]->c3,
                'c4' => $getvalue[0]->c4,
                'c5' => $getvalue[0]->c5,
                'c6' => $getvalue[0]->c6,
                'c7' => $getvalue[0]->c7,
                'c8' => $getvalue[0]->c8,
                'c9' => $getvalue[0]->c9,
                'c10' => $getvalue[0]->c10,
                'b2c_markup' => $getvalue[0]->b2c_markup,
                'b2b_markup' => $getvalue[0]->b2b_markup,
                'b2e_markup' => $getvalue[0]->b2e_markup,
                'desposit' => $getvalue[0]->desposit,
                'tax' => $getvalue[0]->tax,
                'service_fee' => $getvalue[0]->servicefee,
                'supplier_id'=> $getvalue[0]->id,
                'checkin' => ($this->post('checkin')) ? strtoupper($this->post('checkin')) : "",
                'checkout' => ($this->post('checkout')) ? strtoupper($this->post('checkout')) : "",
                'loaction' => ($this->post('loaction')) ? strtoupper($this->post('loaction')) : "",
                'country' => ($this->post('country')) ? strtoupper($this->post('country')) : "",
                'endpoint' => "https://travelapi.co/modules/tours/".strtolower($value['name'])."/api/v1/search",
            );
            $tours = new ApiClient();
            $response = $tours->sendRequest('POST', 'search', $param);
            array_push($array,json_decode($response));
        }
        $json = $array;
        $arr = [];
        foreach ($json as $key=>$value){
            foreach ($value as $num=>$data){
                array_push($arr, (object)[
                    'tour_id' =>$data->tour_id,
                    'name' => $data->name,
                    'location' => $data->location,
                    'img' => $data->img,
                    'desc' => strip_tags($data->desc),
                    'price' => round($data->price),
                    'actual_price' => $data->price,
                    'b2c_price' => $data->b2c_price,
                    'b2b_price' => $data->b2b_price,
                    'b2e_price' => $data->b2e_price,
                    'b2c_markup' => $data->b2c_markup,
                    'b2b_markup' => $data->b2b_markup,
                    'b2e_markup' => $data->b2e_markup,
                    'service_fee' => $data->service_fee,
                    'duration' => $data->duration,
                    'rating' => $data->rating,
                    'redirected' => $data->redirected,
                    'supplier' => $data->supplier,
                    'latitude' => '',
                    'longitude' => '',
                    'currency_code' => $data->currency_code
                ]);
            }
        }
        if(!empty($arr) && !empty($arry)){
            $data = array_merge($arry,$arr);
        }elseif (!empty($arr)){
            $data = $arr;
        }elseif (!empty($arry)){
            $data = $arry;
        }else{
            $data = '';
        }

        $this->response($data);
    }

     function cancellation_post(){
         // dd($this->post());die;
         $parm = array(
             'id' => $this->post('booking_id'),
             'ref_id' => $this->post('ref_id'),
             'supplier' => $this->post('supplier'),
             'booking_cancellation_request' => $this->post('cancellation_request'),
             'endpoint' => site_url()."/api/tours/cancellationbooking?appKey=".$this->input->get('appKey'),
         );
         $tours = new ApiClient();
         $cancelbook = $tours->sendRequest('POST', 'search', $parm);
         $this->response($cancelbook);
     }


    function detail_post(){ // Feras details get info
        if($this->post('supplier') == 1){
            $manaultours = $this->App->service('ModuleService')->getmodulesdata("Tours");
            $param = array(
                'endpoint' => site_url()."api/tours/details?appKey=".$this->input->get('appKey')."&id=".$this->post('tour_id'),
            );

            //var_dump(site_url()."api/tours/details?appKey=".$this->input->get('appKey')."&id=".$this->post('tour_id'));
            $tourdet = new ApiClient();
            $manaul = $tourdet->sendRequest('GET', 'search', $param);
            // dd($manaul);die;
            $manaultour = json_decode($manaul);
          //  error_reporting(-1);
        //ini_set('display_errors', 1);
            $b2c_markup = $manaultours[0]->b2c_markup;
            $b2b_markup = $manaultours[0]->b2b_markup;
            $b2e_markup = $manaultours[0]->b2e_markup;
            $servicefee = $manaultours[0]->servicefee;

//var_dump($manaultour->response->tour);
            // add by ak
            $perAdultPrice = str_replace(',','',$manaultour->response->tour->perAdultPrice);
            $price = round((float)$perAdultPrice);
            
            $b2c_price = ((float)$b2c_markup / 100) * (float)$price;
            $b2b_price = ((float)$b2b_markup / 100) * (float)$price;
            $b2e_price = ((float)$b2e_markup / 100) * (float)$price;

            $perChildPrice = str_replace(',','',$manaultour->response->tour->perChildPrice);
            $price_chlid = round((float)$perChildPrice);
            $b2c_price_chlid = ((float)$b2c_markup / 100) * $price_chlid;
            $b2b_price_chlid = ((float)$b2b_markup / 100) * $price_chlid;
            $b2e_price_chlid = ((float)$b2e_markup / 100) * $price_chlid;
            $perInfantPrice = str_replace(',','',$manaultour->response->tour->perInfantPrice);
            // end add by ak
            $price_infant = round((float)$perInfantPrice);
            $b2c_price_infant = ((float)$b2c_markup / 100) * $price_infant;
            $b2b_price_infant = ((float)$b2b_markup / 100) * $price_infant;
            $b2e_price_infant = ((float)$b2e_markup / 100) * $price_infant;


            $img = [];
            foreach ($manaultour->response->tour->sliderImages as $photo){
                $img[] = $photo->fullImage;
            }

            $inclusions = [];
            foreach ($manaultour->response->tour->inclusions as $inclusion){
                $inclusions[] = $inclusion->name;
            }

            $exclusions = [];
            foreach ($manaultour->response->tour->exclusions as $exclusion){
                $exclusions[] = $exclusion->name;
            }
            // dd(strip_tags($manaultour->response->tour->desc));die;
            $array = array(
                'tour_id' => $manaultour->response->tour->id,
                'name' => $manaultour->response->tour->title,
                'tour_type' => '',
                'location' => $manaultour->response->tour->location,
                'img' => $img,
                'desc' => $manaultour->response->tour->desc,
                'price' => $price,
                'actual_price' => $perAdultPrice,
                'b2c_price_adult' => round($perAdultPrice + $b2c_price),
                'b2b_price_adult' => round($perAdultPrice + $b2b_price),
                'b2e_price_adult' => round($perAdultPrice + $b2e_price),
                'b2c_price_child' => round($perChildPrice + $b2c_price_chlid),
                'b2b_price_child' => round($perChildPrice + $b2b_price_chlid),
                'b2e_price_child' => round($perChildPrice + $b2e_price_chlid),
                'b2c_price_infant' => round($perInfantPrice + $b2c_price_infant),
                'b2b_price_infant' => round($perInfantPrice + $b2b_price_infant),
                'b2e_price_infant' => round($perInfantPrice + $b2e_price_infant),
                'b2c_markup' => $b2c_markup,
                'b2b_markup' =>  $b2b_markup,
                'b2e_markup' => $b2e_markup,
                'service_fee' => $servicefee,
                'adult_price' => $perAdultPrice,
                'child_price' => $perChildPrice,
                'infant_price' => $perInfantPrice,
                'maxAdults' => $manaultour->response->tour->maxAdults,
                'maxChild' => $manaultour->response->tour->maxChild,
                'maxInfant' => $manaultour->response->tour->maxInfant,
                'rating' => $manaultour->response->tour->starsCount,
                'longitude' => $manaultour->response->tour->longitude,
                'latitude' => $manaultour->response->tour->latitude,
                'redirect' => '',
                'inclusions' => $inclusions,
                'exclusions' => $exclusions,
                'currencycode' => $manaultour->response->tour->currCode,
                'duration' => '',
                'tourDays' => $manaultour->response->tour->tourDays,
                'tourValidityFrom' => $manaultour->response->tour->tourValidityFrom,
                'tourValidityTo' => $manaultour->response->tour->tourValidityTo,
                'policy' => $manaultour->response->tour->policy,
                'max_travellers' => '',
                'departure_time' => '',
                'departure_point' => '',
                'taxType' =>  $manaultour->response->tour->taxType,
                'taxValue' =>  $manaultour->response->tour->taxValue,
                'supplier' =>$this->post('supplier')
            );
            $this->response($array);
        }

        // Multithreading Hotels Details Api's
        if($this->post('supplier') != 1) {
            $getvalue = $this->Modules_model->getmodule_id($this->post('supplier'));
            $param = array(
                'tour_id' => $this->post('tour_id'),
                'c1' => $getvalue[0]->c1,
                'supplier_id' => $this->post('supplier'),
                'b2c_markup' => $getvalue[0]->b2c_markup,
                'b2b_markup' => $getvalue[0]->b2b_markup,
                'b2e_markup' => $getvalue[0]->b2e_markup,
                'desposit' => $getvalue[0]->desposit,
                'tax' => $getvalue[0]->tax,
                'service_fee' => $getvalue[0]->servicefee,
                'endpoint' => "https://travelapi.co/modules/tours/".strtolower($getvalue[0]->name)."/api/v1/detail",
            );
            $tours = new ApiClient();
            $toursapi = $tours->sendRequest('POST', 'search', $param);

            if(!empty($toursapi)){
                $this->response($toursapi);
            }
        }
    }

}
