<?php
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . 'modules/Api/libraries/REST_Controller.php';
class Flight extends REST_Controller {

    function __construct() {
        // Construct our parent class
        parent :: __construct();

        if(!$this->isValidApiKey){
            $this->response($this->invalidResponse, 400);
        }
        $this->output->set_content_type('application/json');
        $this->load->library('ApiClient');
        $this->load->library('Flights/Flights_lib');
         $this->load->model('Flights/Flights_model');
        //$this->load->library('FlightLogicFlight/FlightLogic');
        $this->load->model('Admin/Modules_model');
       // header('Content-type: application/json');

    }
    
    
    public function search_post(){

        
        //Manaul Flights API Api
        $Flights = $this->App->service('ModuleService')->isActive("Flights");
        
        if ($this->post('type') == 'return') {
            $checktrip = 'round';
        }else{
            $checktrip = 'oneway';
        }
        $currency = $this->post('currency');
        $ccurrencyRate = $this->Flights_model->currencyrate($currency);
        $user_type = $this->post('user_type');
       
        
        ////// Feras ///// 
        // $currency =  $this->Flights_lib->currencycode;
         
       //  dd($currency); die;
        
       // $currency = $this->post('currency');
      // $currency =  $this->Flights_lib->currencycode;
       
      // dd($currency); die;
        
        if ($checktrip == 'round' ) {
            $returndate = date('Y-m-d', strtotime($this->post('return_date')));
            $adults = intval($this->post('adults') ? $this->post('adults') : 1);
            $childrens = intval($this->post('childrens') ? $this->post('childrens') : 0);
            $infants =  intval($this->post('infants') ? $this->post('infants') : 0);
        } else {
            $returndate = "";
            $adults = intval($this->post('adults') ? $this->post('adults') : 1);
            $childrens = intval($this->post('childrens') ? $this->post('childrens') : 0);
            $infants =  intval($this->post('infants') ? $this->post('infants') : 0);
        }
        if ($this->post('class_type') == 'economy') {
            $class = "economy";
        } else if ($this->post('class_type') == 'business') {
            $class = "business";
        } else {
            $class = "Y";
        }
        
        
        
        /*********************** feras edit *************************/
        
       // $currency = $this->post('currency');
        // $data = array(
        //              'ferassssss' => $currency,
        //          );
        //          dd($data); die;
        /*********************** feras edit *************************/
        
       // dd(site_url());

        if($Flights == 1) {
            
            $origin =  ($this->post('origin')) ? strtoupper($this->post('origin')) : "";
            $destination = ($this->post('destination')) ? strtoupper($this->post('destination')) : "";
            $type = $checktrip ? $checktrip : 'oneway';
            $departure_date = date('Y-m-d', strtotime($this->post('departure_date')));
            $return_date = $returndate;
            $class_trip = $class;

            $paylod = $this->post();
            $this->Flights_lib->search_logs($paylod);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL =>  site_url().'api/new_flights/search?appKey='.$this->input->get('appKey').'&from='.$origin.'&to='.$destination.'&departure_date='.$departure_date.'&arrival_date='.$return_date.'&user_type='.$user_type.'&type='.$type.'&cabinclass='.$class_trip.'&adults='.$adults.'&childs='.$childrens.'&infants='.$infants.'&currency='.$currency,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: ci_session=4dd34e644b9cf60f6b6dd035da89da1f5215fc9c'
                ),
            ));

            /*
            $parm = array(
              'booking_id' =>$this->get('booking_id'),
              'invoice_id' =>$this->get('invoice_id'),
              'endpoint' => site_url() . "api/flights/flightinovice?appKey=phptravels",
            );
            $flights = new ApiClient();
            $get_invoice = $flights->sendRequest('POST', 'search', $parm);
            $this->response($get_invoice);
            */
            $res = curl_exec($curl);
            $rep = json_decode($res);
            curl_close($curl);
            //dd($rep); die;  
        }
        
        

        // Multithreading Flights Search Api's
        $Multithreading = $this->App->service('ModuleService')->flightmodules();
        
        

        $array = array();
        $arr_flight_logic = [];
       foreach ($Multithreading as $key=>$value){
         
          $getvalue = $this->Modules_model->getmodulename($value['name']);

          $b2bComm = $getvalue[0]->b2b_markup ?? 0;
          $b2cComm = $getvalue[0]->b2c_markup ?? 0;
          $b2eComm = $getvalue[0]->b2e_markup ?? 0;
          $serviceFeesComm = $getvalue[0]->servicefee ?? 0;
          $serviceFeesAmount = $getvalue[0]->serviceFeesAmount?? 0;

          if(isset($user_type)) { 
              if ($user_type == "agent") {
                  $commPer = ($b2bComm === 0 || $b2bComm === null) ? 2 : $b2bComm;
              //  $commPer = $getvalue[0]->b2b_markup;
               } elseif($user_type == 'admin' || $user_type == 'webadmin') { 
                  $commPer = ($b2eComm === 0 || $b2eComm === null) ? 2 : $b2eComm;
                //$commPer = $getvalue[0]->b2e_markup;
               } elseif($user_type == 'guest' || $user_type == 'customer') { 
                  $commPer = ($b2cComm === 0 || $b2cComm === null) ? 2 : $b2cComm;
                 // $commPer = $getvalue[0]->b2c_markup;   
               } else {
                $commPer = ($b2cComm === 0 || $b2cComm === null) ? 2 : $b2cComm;
               }
          }
          
          $commVal =  ((($commPer+$serviceFeesComm)/100)+1); 
          $olServiceFees = ($ccurrencyRate*$serviceFeesAmount);
          
          //dd($olServiceFees); die;
          
         // dd($commVal); die;

          //$getvalue[0]->servicefee,
          

        // $user_id = $this->session->userdata('user_id');
         
         // dd($user_id); die;
        //$this->post('currency')
         
         //   $this->load->model('Admin/Accounts_model');
            //  echo   $currency = $this->post('currency');

            //  echo   $userid = $this->session->userdata('user_id'); 

            // dd($currency); die;
          
        //   $paylod = $this->post();
        //   dd($paylod); dd;
            
            
        //   if(isset($_SESSION["user_type"])) 
        //         { 
        //             if ($_SESSION["user_type"] == "agent") { 
        //                 $selling_price =  $getvalue[0]->b2b_price;
        //               }
        //             else {
        //               $selling_price = $getvalue[0]->b2c_price;  
        //               }
        //         }      
        //         if (!isset($_SESSION["user_type"])) {
        //          $selling_price =  $item->b2c_price;
        //         }
          
          
        //  $user_type
          
          
         
         // dd($getvalue); dd;
          

          // 13-07-2023 This is Feras Abusharkh code in if condition
           
               
               
               /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/
               /**** airline images ****/
               /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/
              /*  $url = "https://travelnext.works/api/aeroVE5/airline_list";
                 $data = array(
                     'user_id' => $getvalue[0]->c1,
                     'user_password' => $getvalue[0]->c2,
                     'access' => 'Test',
                     'ip_address' => '95.111.200.48',
                     'endpoint' => $url,
                 );
                    
               $header = array();
               $fligts = new ApiClient();
               $response = $fligts->sendRequest('POST', 'search', $data,$header,'json');
               $result = json_decode($response,true);
               
                //"img" => 'http://dev.rivatrip.com/api/uploads/images/flights/airlines/3S.png'
               
               foreach ($result as $item) {
                  // $logo_path = $item['AirLineLogo'];
                  if ($item['AirLineCode'] == 00) {
                    $imageData = file_get_contents($item['AirLineLogo']);

                    $imageUrl = $item['AirLineLogo'];

                    // Fetch the image data from the URL
                    $imageData = file_get_contents($imageUrl);
                    
                    $localPasth = 'http://dev.rivatrip.com/api/uploads/images/flights/airlines/'.$item['AirLineCode'].'gif';
            
                    // Specify the local file path where you want to save the image
                    // Make sure the directory is writable by the web server
                    $localImagePath = $localPasth;
            
                    // Save the image data to the local file
                    $result333 = file_put_contents($localImagePath, $imageData);
                  
                   if ($result333 !== false) {
                        echo 'Image downloaded and saved successfully to ' . $localImagePath;
                    } else {
                        echo 'Failed to download and save the image.';
                    }
                  }
               }
               
               dd($result); die;*/
               /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/
               /**** End airline images ****/
            /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/   

           

            if ($value['name'] == 'FlightsLogicflight'){
              
               $url = "https://travelnext.works/api/aeroVE5/availability";

                if ($this->post('type') == 'return') {
                     $checktripee = 'Return';
                     $org = [array("departureDate" => date('Y-m-d', strtotime($this->post('departure_date'))),
                                   "returnDate" => date('Y-m-d', strtotime($returndate)),
                                    "airportOriginCode" => ($this->post('origin')) ? strtoupper($this->post('origin')) : "",
                                    "airportDestinationCode" => ($this->post('destination')) ? strtoupper($this->post('destination')) : "",
                            )];
                 }else{
                     $checktripee = 'OneWay';
                     $org = [array("departureDate" => date('Y-m-d', strtotime($this->post('departure_date'))),
                                    "airportOriginCode" => ($this->post('origin')) ? strtoupper($this->post('origin')) : "",
                                    "airportDestinationCode" => ($this->post('destination')) ? strtoupper($this->post('destination')) : "",
                            )];
                 } 
                           
               $data = array(
                     'user_id' => $getvalue[0]->c1,
                     'user_password' => $getvalue[0]->c2,
                     'access' => 'Test',
                     'ip_address' => '95.111.200.48',
                     'journeyType' => $checktripee,
                     'OriginDestinationInfo' => $org,
                     'class' => ucfirst($class),
                     'adults' => $adults,
                     'childs' => $childrens,
                     'infants' => $infants,
                     'requiredCurrency' => $currency,
                     'endpoint' => $url,
                  //   'directFlight' => 1,
                     //"separateFare" => 1
                 );
                 
                 
                 // dd('ferasssss'); die;
                 
                 // dd($data); die;
                    
                    
                //      $url = "https://travelnext.works/api/aeroVE5/airline_list";
                     
                //      $data = array(
                //      'user_id' => $getvalue[0]->c1,
                //      'user_password' => $getvalue[0]->c2,
                //      'access' => 'Test',
                //      'ip_address' => '95.111.200.48',
                //       'endpoint' => $url,
                //  );
                 
                       //set_time_limit(120);
                   
                       $header = array();
                       $fligts = new ApiClient();
                       $response = $fligts->sendRequest('POST', 'search', $data,$header,'json');

                       dd('ferasdasdasd'); die;
                      
                       $result = json_decode($response,true);
                       
                   //  dd($result); die;
                       
                    //   $this->response($result); ////  feras Changes 
                       
                      
                       
                       
                       $flightSession_id = $result['AirSearchResponse']['session_id'];
                      // $restructuredArray = array();
                     //  dd($result); die;   
                       
                      foreach ($result['AirSearchResponse']['AirSearchResult']['FareItineraries'] as $item) {
                             $Ticketdesc = '';
                           
                             $breakdown = $item['FareItinerary']['AirItineraryFareInfo']['FareBreakdown'];

                             foreach ($breakdown as $breakdownItem) {
                                 $numberOfBaggage = $breakdownItem['Baggage'][0];
                                 $numberOfBaggageWeight = $breakdownItem['CabinBaggage'][0]; 
                                  if ($breakdownItem['PassengerTypeQuantity']['Code'] == 'ADT') {
                                       $numberofPassenger =  $breakdownItem['PassengerTypeQuantity']['Quantity'];
                                       $adultPrice = $breakdownItem['PassengerFare']['TotalFare']['Amount'];
                                       $aPrice = round((($adultPrice*$commVal)+$olServiceFees),2);
                                       $passengerTy = 'Adult';
                                  } else if ($breakdownItem['PassengerTypeQuantity']['Code'] == 'CHD'){
                                      $numberofPassenger =  $breakdownItem['PassengerTypeQuantity']['Quantity'];
                                      $childPrice = $breakdownItem['PassengerFare']['TotalFare']['Amount'];
                                      $cPrice = round((($childPrice*$commVal)+$olServiceFees),2);
                                      $passengerTy = 'Child';
                                  }else if ($breakdownItem['PassengerTypeQuantity']['Code'] == 'INF'){
                                      $numberofPassenger =  $breakdownItem['PassengerTypeQuantity']['Quantity'];
                                      $INFPrice = $breakdownItem['PassengerFare']['TotalFare']['Amount'];
                                      $iPrice = round((($INFPrice*$commVal)+$olServiceFees),2);
                                      $passengerTy = 'Infant';
                                  }
                               
                               
                                  /************************ ***** ******************************************/
                                  /************************ ***** ******************************************/
                                  /************************ Bags ******************************************/
                                  
                                  $Ticketdesc .= '<p>'. $passengerTy.' - Number of Passenger: '.$numberofPassenger.'</p>';
                                  $Ticketdesc .= '<p class="font-weight-bold">Bags</p>';
                                 // $Ticketdesc .= '<p style=""> Bags </p>';
                                 // $Ticketdesc .= '<p> Number of Baggage:   '. $numberOfBaggage.'</p>';
                                 // $Ticketdesc .= '<p> Baggage Wight:       '. $numberOfBaggageWeight.'</p>';
                                  
                                  ////// Baggage //// 
                                  if ($numberOfBaggage == 'SB') {
                                     $Ticketdesc .= '<p>Baggage: 1</p>'; 
                                  } elseif($numberOfBaggage == '0KG') {
                                      $Ticketdesc .= '<p>Hand Bag</p>'; 
                                  }
                                  else {
                                     $Ticketdesc .= '<p>Baggage: '. $numberOfBaggage.'</p>'; 
                                  }
                                  
                                  ////
                                  
                                  ///// CabinBaggage //// 
                                  if($numberOfBaggageWeight == 'SB'){
                                    $Ticketdesc .= '<p> Baggage: 23KG</p>';  
                                  } elseif($numberOfBaggageWeight == '0') { 
                                    $Ticketdesc .= '<p> Baggage: 7KG</p>';   
                                  }
                                  else {
                                     $Ticketdesc .= '<p> Baggage: '. $numberOfBaggageWeight.'</p>';  
                                  }
                                  
                                  /************************ End Bags ******************************************/
                                  /************************ ***** ******************************************/
                                  /************************ ***** ******************************************/
                                  
                                  
                                //   $Ticketdesc .= '<p>'. $passengerTy.' - Number of Passenger: '.$numberofPassenger.'</p>';
                                //   $Ticketdesc .= '<p> Number of Baggage:   '. $numberOfBaggage.'</p>';
                                //   $Ticketdesc .= '<p> Baggage Wight:       '. $numberOfBaggageWeight.'</p>';
                                  //$Ticketdesc .= '<hr><p> --- Refund Policy ---</p>';
                                 // $Ticketdesc .= '<hr>';
                                  
                                  /************************ ***** ******************************************/
                                  /************************ ***** ******************************************/
                                  /************************ refund ******************************************/
                                  //$Ticketdesc .= '<p>Currney:             '. $breakdownItem['PenaltyDetails']['Currency'].'</p>';
                                  
                                  // $Ticketdesc .= '<hr>';
                                   $Ticketdesc .= '<p class="text-danger font-weight-bold"> Refund Policy </p>';
                                  
                                  if ($breakdownItem['PenaltyDetails']['ChangeAllowed'] == '1' && $breakdownItem['PenaltyDetails']['RefundAllowed'] == '1') {
                                     $Ticketdesc .= '<p style="font-style: italic;">Refundable and changeable ticket</p>';  
                                  }
                                  
                                  if ($breakdownItem['PenaltyDetails']['ChangeAllowed'] == '0' && $breakdownItem['PenaltyDetails']['RefundAllowed'] == '0') {
                                    $Ticketdesc .= '<p>Changing or canceling non-refundable flight tickets</p>';   
                                  }
                                  else {
                                              if ($breakdownItem['PenaltyDetails']['RefundAllowed'] == '1') {
                                                 $Ticketdesc .= '<p style="font-style: italic;">Ticket refundable penalty fees: '.$breakdownItem['PenaltyDetails']['RefundPenaltyAmount'].' '.ucfirst($breakdownItem['PenaltyDetails']['Currency']).'</p>'; 
                                               } else {
                                                 $Ticketdesc .= '<p style="font-style: italic;">Cancellation non-refundable flight tickets</p>';   
                                               }
                                               if ($breakdownItem['PenaltyDetails']['ChangeAllowed'] == '1') {
                                                 $Ticketdesc .= '<p style="font-style: italic;">Ticket changeable penalty fees: '.$breakdownItem['PenaltyDetails']['ChangePenaltyAmount'].' '.ucfirst($breakdownItem['PenaltyDetails']['Currency']).'</p>'; 
                                               } else {
                                                 $Ticketdesc .= '<p style="font-style: italic;">Changing non-refundable flight tickets</p>';   
                                               }
                                  }
                                  
                                $Ticketdesc .= '<hr>';  
                                  
                                //   if ($breakdownItem['PenaltyDetails']['ChangeAllowed'] == '1') {
                                //   $Ticketdesc .= '<p>Ticket Changable:    ';
                                //   $Ticketdesc .=  (($breakdownItem['PenaltyDetails']['ChangeAllowed'] == '1') ? 'Yes' : 'No').'</p>';
                                //   $Ticketdesc .= '<p>Ticket Change Amount: '.$breakdownItem['PenaltyDetails']['ChangePenaltyAmount'].ucwords($breakdownItem['PenaltyDetails']['Currency']).'</p>';  
                                //   }
                                //   if ($breakdownItem['PenaltyDetails']['RefundAllowed'] == '1') {
                                //   $Ticketdesc .= '<p>Refundable:          ';
                                //   $Ticketdesc .=  (($breakdownItem['PenaltyDetails']['RefundAllowed'] == '1') ? 'Yes' : 'No').'</p>';
                                //   $Ticketdesc .= '<p>Refundable Amount:    '.$breakdownItem['PenaltyDetails']['RefundPenaltyAmount'].ucwords($breakdownItem['PenaltyDetails']['Currency']).'</p>';  
                                //   }
                                  /************************ End refund ******************************************/
                                  /************************ ***** ******************************************/
                                  /************************ ***** ******************************************/
                             }
                             
                             
                            
                             
                              $OriginDestinationOptions = $item['FareItinerary']['OriginDestinationOptions'];
                              
                              // dd($OriginDestinationOptions); die;   
                              
                              $two_way["segments"] = array();
                              foreach($OriginDestinationOptions as $destination_origion){
                                    $obj_array = array();
                                    $one_way = array();
                                    $OriginDestinationOption_data = $destination_origion['OriginDestinationOption'];
                                     foreach($OriginDestinationOption_data as $key_t => $flightItem){
                                     
                                               $dateDepature = new DateTime($flightItem['FlightSegment']['DepartureDateTime']);
                                               $timeString = $dateDepature->format('H:i:s');
                                               $dateString = $dateDepature->format('Y-m-d');
                                              
                                               $dateArrive = new DateTime($flightItem['FlightSegment']['ArrivalDateTime']);
                                               $timeArriveString = $dateArrive->format('H:i:s');
                                               $dateArriveString = $dateArrive->format('Y-m-d');
                  
                                             //  $Ticketdesc .=  '<p> --- </p>';
                                             //  $Ticketdesc .=  '<p> --- </p>';
                                              // $Ticketdesc .=  '<hr>';
                                               /*$count = $count+1; 
                                               $Ticketdesc .=  '<p>flight '.$count.'</p>';
                                               $Ticketdesc .= 'flight Number'.$flightItem['FlightSegment']['FlightNumber'].'   Operated by  '.$flightItem['FlightSegment']['OperatingAirline']['Name'];*/
                                               
                                               
                                               //$flightnumberdec = '<hr> flight Number: '.$flightItem['FlightSegment']['FlightNumber'].'   Operated by  '.$flightItem['FlightSegment']['OperatingAirline']['Name'];
                                               $flightnumberdec = $flightItem['FlightSegment']['FlightNumber'].'   Operated by  '.$flightItem['FlightSegment']['OperatingAirline']['Name'];
                                               $departure_flight_no= $flightItem['FlightSegment']['FlightNumber'];
                                            //   $Ticketdesc .= $flightnumberdec;
                                               
                                              
                                                // Restructure each item
                  
                                             /*  $hours = floor($flightItem['FlightSegment']['JourneyDuration'] / 60);
                                               $minutes = $flightItem['FlightSegment']['JourneyDuration'] % 60;
                                               $timeFormatted = sprintf("%02d:%02d", $hours, $minutes);*/
                                               
                                               $fltprice = $item['FareItinerary']['AirItineraryFareInfo']['ItinTotalFares']['TotalFare']['Amount'];
                                               $tPrice = round((($fltprice*$commVal)+$olServiceFees),2);
                                               
                                               $timeFormatted = $flightItem['FlightSegment']['JourneyDuration'];
                                               $flight_image = 'http://dev.rivatrip.com/api/uploads/images/flights/airlines/'.$flightItem['FlightSegment']['MarketingAirlineCode'].'.png';  
                                               
                                               $fareType = $item['FareItinerary']['AirItineraryFareInfo']['FareType']; // New Parameters feras
                                               $IsPassportMandatory = $item['FareItinerary']['IsPassportMandatory']; // New Parameters feras
                                               
                                               
                                               
                                               $obj_logic = (object)[
                                                      "booking_token" =>  $item['FareItinerary']['AirItineraryFareInfo']['FareSourceCode'],
                                                      "img" => $flight_image,  //'http://dev.rivatrip.com/api/uploads/images/flights/airlines/3S.png',
                                                      "departure_flight_no" => $departure_flight_no,
                                                     // "img" => $segment->img,
                                                      "departure_time" => $timeString,
                                                      "departure_date" => $dateString,
                                                      "arrival_time" => $timeArriveString,
                                                      "arrival_date" => $dateArriveString,
                                                      "departure_code" => $flightItem['FlightSegment']['DepartureAirportLocationCode'],
                                                      "departure_airport" => $flightItem['FlightSegment']['DepartureAirportLocationCode'],
                                                      "arrival_code" => $flightItem['FlightSegment']['ArrivalAirportLocationCode'],
                                                      "arrival_airport" => $flightItem['FlightSegment']['ArrivalAirportLocationCode'],
                                                     // "duration_time" => $flightItem['FlightSegment']['JourneyDuration'],
                                                      "duration_time" => $timeFormatted,
                                                      "currency_code" => $currency,
                                                      "price" => $tPrice,
                                                      "adult_price" => $aPrice,
                                                      "child_price" => $cPrice,
                                                      "infant_price" => $iPrice,
                                                     // "url" => '',
                                                      "airline_name" => $flightItem['FlightSegment']['MarketingAirlineName'],
                                                      "class_type" => $flightItem['FlightSegment']['CabinClassText'] ? $flightItem['FlightSegment']['CabinClassText'] : $class,
                                                      "form" => '',
                                                      "form_name" => '',
                                                      "action" => '',
                                                      "type" => $value['name'],
                                                      //"luggage" => '',
                                                      "desc" => $Ticketdesc.$flightnumberdec,
                                                      "session_id" => $flightSession_id,
                                                      "Originalprice" => $fltprice,
                                                      "fareType" => $fareType, // New Parameters feras
                                                      "IsPassportMandatory"=>$IsPassportMandatory, // New Parameters feras
                                                ];
                                               array_push($obj_array, $obj_logic);
                                     }
                                         if($checktrip == 'round'){
                                            $two_way["segments"][] = $obj_array;
                                            
                                        }else{
                                            $one_way["segments"][] = $obj_array;
                                        }
                              }
                              
                              if($checktrip == 'round') {   
                                    array_push($arr_flight_logic, (object)$two_way);
                                }else{
                                    array_push($arr_flight_logic, $one_way);
                                }
                      }
        
              // dd($arr_flight_logic); die; 
            } 
           
           
        


            /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/
            /***************************** Start Amir **************************************/
            /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/
/*
          if($getvalue[0]->name == "FlightsLogicflight"){
                // $airport_name = $this->check_airport_name("DXB");
                
                $logic_trip = "";
                if($checktrip == "round"){
                    $logic_trip = "Return";
                }
                $data_params = '{
                    "user_id": "' . $getvalue[0]->c1 . '",
                    "user_password": "' . $getvalue[0]->c2 . '",
                    "access": "Test",
                    "ip_address": "' . $this->post('ip') . '",
                    "requiredCurrency": "AED",
                    "journeyType": "' . $logic_trip . '",
                    "OriginDestinationInfo": [
                        {
                            "departureDate": "' . date('Y-m-d', strtotime($this->post('departure_date'))) . '",
                            "returnDate": "' . $returndate . '",
                            "airportOriginCode": "' . strtoupper($this->post('origin')) . '",
                            "airportDestinationCode": "' . strtoupper($this->post('destination')) . '"
                        }
                    ],
                    "class": "' . ucfirst($this->post('class_type')) . '",
                    "adults": ' . $this->post('adults') . ',
                    "childs": ' . $this->post('childrens') . ',
                    "infants": ' . $this->post('infants') . '
                }';
                
                $fl = new FlightLogic();
                $response = $fl->search_flight($data_params);
                // $this->response($response); 
                $array_logic = json_decode($response, true);

                // $this->response($array_logic);
                $session_id = $array_logic['AirSearchResponse']['session_id'];
                $josn_arr = $array_logic['AirSearchResponse']['AirSearchResult']['FareItineraries'];
                $checktrip = "round";
                
                foreach ($josn_arr as $val) {
                    $jval = $val['FareItinerary'];
                    $AirItineraryFareInfo = $jval['AirItineraryFareInfo'];
                    $fare_source_code = $AirItineraryFareInfo['FareSourceCode'];
                    // $this->response($fare_source_code); die();
                    $OriginDestinationOptions = $jval['OriginDestinationOptions'];
                    $currancy_code_of_psngr = $AirItineraryFareInfo['ItinTotalFares']['TotalFare']['CurrencyCode'];
                    $total_fare_of_psngr = $AirItineraryFareInfo['ItinTotalFares']['TotalFare']['Amount'];
                    $is_refundable = $AirItineraryFareInfo['IsRefundable'];

                    $two_way["segments"] = array();
                    foreach($OriginDestinationOptions as $destination_origion){
                        
                        $obj_array = array();
                        $one_way = array();
                        $OriginDestinationOption_data = $destination_origion['OriginDestinationOption'];
                        
                        foreach($OriginDestinationOption_data as $key_t => $od_data){
                            $FlightSegment = $od_data['FlightSegment'];
                            
                            $ArrivalDateTime = $FlightSegment['ArrivalDateTime'];
                            $arrival_logic_time = date("h:i A", strtotime($ArrivalDateTime));  
                            $arrival_logic_date = date("d:m-Y", strtotime($ArrivalDateTime));
                            $DepartureDateTime = $FlightSegment['DepartureDateTime'];  
                            $departure_logic_time = date("h:i A", strtotime($DepartureDateTime));  
                            $departure_logic_date = date("d:m-Y", strtotime($DepartureDateTime));
                            $obj_logic = (object)[
                                    "departure_flight_no" => $FlightSegment['FlightNumber'],
                                    "img" => "http://dev.rivatrip.com/api/uploads/images/flights/airlines/3S.png", //static
                                    "departure_time" => $departure_logic_time,
                                    "departure_date" => $departure_logic_date,
                                    "arrival_time" => $arrival_logic_time,
                                    "arrival_date" => $arrival_logic_date,
                                    "departure_code" => $FlightSegment['DepartureAirportLocationCode'],
                                    "departure_airport" => "dubai", //static
                                    "arrival_code" => $FlightSegment['ArrivalAirportLocationCode'],
                                    "arrival_airport" => "Lahore", //static
                                    "duration_time" => $FlightSegment['JourneyDuration'],
                                    "currency_code" => $currancy_code_of_psngr,
                                    "price" => $total_fare_of_psngr, // Confusion
                                    "adult_price" => "32", // Static
                                    "child_price" => "12", // Static
                                    "infant_price" => "22", // Static
                                    "url" => '',
                                    "airline_name" => $FlightSegment['MarketingAirlineName'],
                                    "class_type" => $FlightSegment['CabinClassCode'],
                                    "form" => '',
                                    "form_name" => '',
                                    "action" => 'http://localhost/riva/api/flights/book',
                                    "type" => 'manual', // static
                                    "luggage" => '0', // static
                                    "desc" => '',
                                    "booking_token" => '', // static
                                    "refundable" => $is_refundable,
                                    "session_id" => $session_id,
                                    "fare_source_code" => $fare_source_code,
                                ];
                            array_push($obj_array, $obj_logic);
                                
                        }
                        if($checktrip == 'round'){
                            $two_way["segments"][] = $obj_array;
                            
                        }else{
                            $one_way["segments"][] = $obj_array;
                        }


                        
                    } 
                    
                    if($checktrip == 'round') {   
                        array_push($arr_flight_logic, (object)$two_way);
                    }else{
                        array_push($arr_flight_logic, $one_way);
                    }

                    
                }
                
            }
            
            */
            /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/
            /***************************** End Amir **************************************/
            /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/

         else {
              
              // dd('elseeeeeeee'); 
              
             // new_flights
               
               
             // ******************** //// Original old code//// *************************
                        // $param = array(
                        //     'c1' => $getvalue[0]->c1,
                        //     'c2' => $getvalue[0]->c2,
                        //     'c3' => $getvalue[0]->c3,
                        //     'c4' => $getvalue[0]->c4,
                        //     'c5' => $getvalue[0]->c5,
                        //     'c6' => $getvalue[0]->c6,
                        //     'c7' => $getvalue[0]->c7,
                        //     'c8' => $getvalue[0]->c8,
                        //     'c9' => $getvalue[0]->c9,
                        //     'c10' => $getvalue[0]->c10,
                        //     'origin' => ($this->post('origin')) ? strtoupper($this->post('origin')) : "",
                        //     'destination' => ($this->post('destination')) ? strtoupper($this->post('destination')) : "",
                        //     'triptypename' => $this->post('triptypename') ? $this->post('triptypename') : 'oneway',
                        //     'departure_date' =>date('Y-m-d', strtotime($this->post('departure_date'))),
                        //     'return_date' => $returndate,
                        //     'adults' => $adults,
                        //     'childrens' => $childrens,
                        //     'infants' => $infants,
                        //     'endpoint' => "https://travelapi.co/modules/flights/".strtolower($value['name'])."/api/v1/search",
                        //     'class_trip' => $class,
                        //     'currency' => $this->post('currency'),
                        //     'type' => $checktrip,
                        // );
                        // $fligts = new ApiClient();
                        // $response = $fligts->sendRequest('POST', 'search', $param);
                        // array_push($array,json_decode($response));
                        
                        
               }
       }
      // die; 
       // dd($array); die;
        $json = $array;
        $arr = [];
        
        foreach ($json as $value){
            
          //  dd($value); die;
            
            foreach ($value as $data){
                $return["segments"] = array();
                foreach ($data->segments as $seg ) {
                    $one_array = array();
                    $segments["segments"] = array();
                    foreach ($seg as $segment) {
                        $bj = (object)[
                            "departure_flight_no" => $segment->departure_flight_no,
                            "img" => $segment->img,
                            "departure_time" => $segment->departure_time,
                            "departure_date" => $segment->departure_date,
                            "arrival_time" => $segment->arrival_time,
                            "arrival_date" => $segment->arrival_date,
                            "departure_code" => $segment->departure_code,
                            "departure_airport" => $segment->departure_airport,
                            "arrival_code" => $segment->arrival_code,
                            "arrival_airport" => $segment->arrival_airport,
                            "duration_time" => $segment->duration_time,
                            "currency_code" => $segment->currency_code,
                            "price" => $segment->price,
                            "adult_price" => $segment->adult_price,
                            "child_price" => $segment->child_price,
                            "infant_price" => $segment->infant_price,
                            "url" => '',
                            "airline_name" => $segment->airline_name,
                            "class_type" => $segment->class_type,
                            "form" => $segment->form,
                            "form_name" => '',
                            "action" => '',
                            "type" => $segment->type,
                            "luggage" => '',
                            "desc" => $segment->desc,
                            "booking_token" => $segment->booking_token,
                            "refundable" => '',
                            "Originalprice" => $segment->Originalprice,
                            "fareType" => $segment->fareType, // New Parameters feras
                            "IsPassportMandatory"=>$segment->IsPassportMandatory, // New Parameters feras
                        ];
                        array_push($one_array, $bj);
                    }
                    if($checktrip == 'round'){
                        $return["segments"][] = $one_array;
                          //dd($one_array); die;
                    }else{
                        $segments["segments"][] = $one_array;
                         // dd('22222'); die;
                    }
                }
                if($checktrip == 'round') {
                    array_push($arr, $return);
                }else{
                    array_push($arr, $segments);
                }
            }
        }

        // if(!empty($arr) && !empty($rep)){
        //     $data = array_merge($rep,$arr);
        // }elseif (!empty($arr)){
        //     $data = $arr;
        // }elseif (!empty($rep)){
        //     $data = $rep;
        // }else{
        //     $data = '';
        // }

        if(!empty($arr) && !empty($rep) && !empty($arr_flight_logic)){
            $data = array_merge($rep,$arr,$arr_flight_logic);
        }elseif (!empty($arr) && !empty($arr_flight_logic)){
            $data = array_merge($arr,$arr_flight_logic);
        }elseif (!empty($rep) && !empty($arr_flight_logic)){
            $data = array_merge($rep,$arr_flight_logic);
        }elseif (!empty($arr)){
            $data = $arr;
        }elseif (!empty($rep)){
            $data = $rep;
        }elseif (!empty($arr_flight_logic)){
            $data = $arr_flight_logic;
        }
        else{
            $data = '';
        }
        
      //  dd($data); die;
        

        $this->response($data);
    }
    

    /////////////////
    ////////////////
    /////FEras ///////
    ////////////////
    //////////////
    
        // function convertObjectToArray($object) {
        //     $array = array();
        //     foreach ($object as $key => $value) {
        //         if (is_array($value)) {
        //             $array[$key] = $value;
        //         } elseif (is_object($value)) {
        //             $array[$key] = convertObjectToArray($value);
        //         } else {
        //             $array[$key] = $value;
        //         }
        //     }
        //     return $array;
        // }
       /////////////////
    ////////////////
    /////FEras ///////
    ////////////////
    //////////////
    

    function book_post()
    {
        
        $bookstatus = 0;
        
        if ($this->post('supplier_name') == 'FlightsLogicflight') {
            
             $currency = $this->post('curr_code');
             $countryCode = $this->Flights_model->get_country_phonecode('ARE');
             $areaCode = $this->Flights_model->get_country_areacode('ARE');

             $data = $this->post('flights_data');
             $flightsData = json_decode($data, true);
             $session_id = $flightsData[0][0]['session_id'];
             $fareType = $flightsData[0][0]['fareType'];
             $booking_token = $flightsData[0][0]['booking_token'];
             $IsPassportMandatory = (is_null($flightsData[0][0]['IsPassportMandatory'])) ? false : true;
             $fullName = $this->post('firstname').' '.$this->post('lastname');
             
             $guestDetails = (array)$this->post('guest');
             
             foreach ($guestDetails as $jsonData) {
                    $arrayData = json_decode($jsonData, true);

                    $titleData = [];
                    foreach ($arrayData as $item) {
                     // $ferastraverller .= $item['traveller_type'];

                        $travellerType = $item['traveller_type'];
                        $title = $item['title'];
                        $firstName = $item['first_name'];
                        $lastName = $item['last_name'];
                        $dob = $item['dob_year'] . '-' . $item['dob_month'] . '-' . str_pad($item['dob_day'], 2, '0', STR_PAD_LEFT);
                        $nationality = $this->Flights_model->get_country_iso($item['nationality']);
                        $passportNo = $item['passport'];
                        $passportIssueCountry = $this->Flights_model->get_country_iso($item['nationality']);
                        $passportExpiryDate = $item['passport_year'] . '-' . $item['passport_month'] . '-' . str_pad($item['passport_day'], 2, '0', STR_PAD_LEFT);
                        
                        //////////////////////
                        //////////////////////
                        /////   Dynamic ///////
                        if (!isset($titleData[$travellerType])) {
                            $titleData[$travellerType] = [];
                        }
                        
                         $titleData[$travellerType]['title'][] = $title;
                         $titleData[$travellerType]['firstName'][] = $firstName;
                         $titleData[$travellerType]['lastName'][] = $lastName;
                         $titleData[$travellerType]['dob'][] = $dob;
                         $titleData[$travellerType]['nationality'][] = $nationality;
                         $titleData[$travellerType]['passportNo'][] = $passportNo;
                         $titleData[$travellerType]['passportIssueCountry'][] = $passportIssueCountry;
                         $titleData[$travellerType]['passportExpiryDate'][] = $passportExpiryDate;
                        /////   Dynamic ///////
                        //////////////////////
                        //////////////////////
                    }
                    
                       //////////////////////
                       //////////////////////
                       /////   Dynamic ///////
                        $mergedData = [];
                            foreach ($titleData as $travellerType => $titles) {
                                $mergedData[$travellerType] = [
                                    'title' => $titles['title'],
                                    'firstName' => $titles['firstName'],
                                    'lastName' => $titles['lastName'],
                                    'dob' => $titles['dob'],
                                    'nationality' => $titles['nationality'],
                                    'passportNo' => $titles['passportNo'],
                                    'passportIssueCountry' => $titles['passportIssueCountry'],
                                    'passportExpiryDate' => $titles['passportExpiryDate'],
                                ];
                            }
                            //$jsonRequest = json_encode($mergedData,true);
                        /////   Dynamic ///////
                        //////////////////////
                        //////////////////////
                }
                
                
                if (isset($mergedData['adults'])) {
                        $mergedData['adult'] = $mergedData['adults'];
                        unset($mergedData['adults']);
                    }
            
             $url = 'https://travelnext.works/api/aeroVE5/booking';
             $databook = array(
                            "endpoint" => $url,
                            "flightBookingInfo" => array(
                                "flight_session_id" => $session_id,
                                "fare_source_code" => $booking_token,
                                "IsPassportMandatory" => $IsPassportMandatory,
                                "fareType" => $fareType,
                                "areaCode" => $areaCode,
                                "countryCode" => $countryCode
                            ),
                            "paxInfo" => array(
                                "clientRef" => $this->post('user_id'),
                                "postCode" => "",
                                "customerEmail" => $this->post('email'),
                                "customerPhone" => $this->post('phone'),
                                "bookingNote" => $this->post('address'),
                                "paxDetails" => 
                                    array( $mergedData
                                    )
                            )
                        );
                        
                           // dd($databook); die;
                    
                      $header = array();
                      $fligts = new ApiClient();
                      $responsebook = $fligts->sendRequest('POST', 'search', $databook,$header,'json');
                      
                      $resultbook = json_decode($responsebook,true);
                     // $UniqueID = '';
                      
                      //$this->response($resultbook['BookFlightResponse']['BookFlightResult']['Status']);
                      
                      
                       //$result = json_decode($response,true);
             
                      //$resultbook22 = json_decode($responsebook,true);

                     if (isset($resultbook['BookFlightResponse']) && isset($resultbook['BookFlightResponse']['BookFlightResult'])) {
                            $status = $resultbook['BookFlightResponse']['BookFlightResult']['Status'];
                            
                            if ($status === 'CONFIRMED') {
                               // echo "Booking is confirmed!";
                               $bookstatus = "Booking is confirmed! ".$resultbook['BookFlightResponse']['BookFlightResult']['UniqueID'];
                               $UniqueID = $resultbook['BookFlightResponse']['BookFlightResult']['UniqueID'];
                               
                               
                                 if ($fareType == 'WebFare') {
                                  // order the ticket ////// Feras Abusharkh  
                                    $url = 'https://travelnext.works/api/aeroVE5/ticket_order'; ///// tickets order
                                    $data = array('user_id' => 'rivatours_testAPI',
                                                  'user_password' => 'rivatoursTest@2023',
                                                  'access' => 'Test',
                                                  'ip_address' => '95.111.200.48',
                                                  'UniqueID' => $UniqueID,
                                                  'endpoint' => $url,
                                                 );
                                                    
                                   $header = array();
                                   $fligts = new ApiClient();
                                   $responselcc = $fligts->sendRequest('POST', 'search', $data,$header,'json');
                                   $resultlcc = json_decode($responselcc,true);
                                   $this->response('ferassssssssssssssss');
                                   // $bookstatus .= 'ferasss';
                                  } 
                               
                               
                            } else {
                               // echo "Booking status: " . $status;
                               $bookstatus = "Booking status: " . $status. $resultbook['BookFlightResponse']['BookFlightResult']['Errors'];
                            }
                        } else {
                          //  echo "Invalid response format.";
                            $bookstatus = 'Invalid response format.';
                        }

        } else {
          $bookstatus = 'CONFIRMED';
        }
       // FlightsLogicflight
        
        
      //   $this->response($bookstatus);  
        
      // if($bookstatus == 1) {
      
    //   if ($UniqueID == '') {
    //       $flight_id = $this->post('flight_id');
    //   } else {
    //       $flight_id = $UniqueID;
    //   }
      
                $param = array(
                    'flight_id' => $this->post('flight_id'),
                    'total_price' => $this->post('total_price'),
                    'firstname' => $this->post('firstname'),
                    'lastname' => $this->post('lastname'),
                    'email' => $this->post('email'),
                    'address' => $this->post('address'),
                    'phone' => $this->post('phone'),
                    'flight_type' => $this->post('flight_type'),
                    'booking_adults' => $this->post('adults'),
                    'booking_childs' => $this->post('childs'),
                    'transaction_id' => $this->post('transaction_id'),
                    'transaction_status' => $this->post('transaction_status'),
                    'booking_infants' => $this->post('infants'),
                    'booking_deposit' => $this->post('deposit'),
                    'booking_tax' => $this->post('tax'),
                    'booking_curr_code' => $this->post('curr_code'),
                    'tax_type' => $this->post('tax_type'),
                    'deposit_type' => $this->post('deposit_type'),
                    'booking_supplier' => $this->post('supplier'),
                    'booking_payment_gateway' => $this->post('payment_gateway'),
                    'booking_user_id' => $this->post('user_id'),
                    'flights_data' => $this->post('flights_data'),
                    'endpoint' => site_url() . "/api/flights/flightbooking?appKey=".$this->input->get('appKey'),
                    'booking_key' => $this->post('booking_key'),
                    'guest' => $this->post('guest'),
                    'supplier_name' => $this->post('supplier_name'),
                    'nationality' => $this->post('nationality'),
                    'booking_from' => $this->post('booking_from'),
                    'integration_book_status' => $bookstatus,
                    //'session_id' => $this->post('session_id'),
                    //'booking_' => $this->post('session_id'),
                );
                // $this->response($param); exit;
        
                $flights = new ApiClient();
                $book = $flights->sendRequest('POST', 'search', $param);
                if(!empty($book)){
                    $checkbooking = json_decode($book);
                    $site_url = $this->post('invoice_url').$checkbooking->response->sessid."/".$checkbooking->response->id;
                    $this->Flights_lib->invoceurlupdate($checkbooking->response->id,$site_url);
                  //  $this->response($site_url); // Feras Abusharkh 
                    $bookingResult = array('response'=>true,'id'=>$checkbooking->response->id,'sessid'=>$checkbooking->response->sessid);
                    $this->response($bookingResult); 
                }
      // } // if status    
    }


    function invoice_get(){
    $parm = array(
      'booking_id' =>$this->get('booking_id'),
      'invoice_id' =>$this->get('invoice_id'),
      'endpoint' => site_url() . "api/flights/flightinovice?appKey=phptravels",
    );
        $flights = new ApiClient();
        $get_invoice = $flights->sendRequest('POST', 'search', $parm);
        $this->response($get_invoice);
    }

    function invoicebooking_post(){
        $parm = array(
            'id' => $this->post('booking_id'),
            'invoice_id' => $this->post('invoice_id'),
            'status' => $this->post('status'),
            'payment_gateway' => $this->post('payment_gateway'),
            'amount_paid' => $this->post('amount_paid'),
            'remaining_amount' => $this->post('remaining_amount'),
            'payment_date' => $this->post('payment_date'),
            'txn_id' => $this->post('txn_id'),
            'token' => $this->post('token'),
            'logs' => $this->post('logs'),
            'payment_status' => $this->post('payment_status'),
            'desc' => $this->post('desc'),
            'endpoint' => site_url()."/api/flights/invoicebooking?appKey=".$this->input->get('appKey'),
        );
        $flights = new ApiClient();
        $bookinvoice = $flights->sendRequest('POST', 'search', $parm);
        $this->response($bookinvoice);
    }

    function cancellation_post(){
        $parm = array(
            'id' => $this->post('booking_id'),
            'invoice_id' => $this->post('invoice_id'),
            'booking_cancellation_request' => $this->post('cancellation_request'),
            'endpoint' => site_url()."/api/flights/cancellationbooking?appKey=".$this->input->get('appKey'),
        );
        $flights = new ApiClient();
        $cancelbook = $flights->sendRequest('POST', 'search', $parm);
        $this->response($cancelbook);
    }
    
    
    
/////////////////////////////////////////////
/////////////////////////////////////////////
///////////////////// Feras /////////////////
////////////////////////////////////////////
///////////////////////////////////////////    
    
/*****************Agregator handling *********************///
     function aggregatorHandling_post(){
    //   $type = 'ferassss'; 
     //  $this->response($type);
          $type = $this->post('type');
         // $this->response($type);

          if ($type == 'FlightsLogicflight'){
              $session_id = $this->post('session_id');
              $booking_token = $this->post('booking_token');
              $price = $this->post('price');
              $url = "https://travelnext.works/api/aeroVE5/revalidate";

              $data = array(
                     'session_id' => $session_id,
                     'fare_source_code' => $booking_token,
                     'endpoint' => $url,
                 );
                    
              $header = array();
              $fligts = new ApiClient();
              $jsonResponse = $fligts->sendRequest('POST', 'search', $data,$header,'json');
              $result = json_decode($jsonResponse,true);
              $isValidValue = $result['AirRevalidateResponse']['AirRevalidateResult']['IsValid'];

              if ($isValidValue == 1) {
                  if (isset($result['AirRevalidateResponse']['AirRevalidateResult']['FareItineraries']['FareItinerary']['AirItineraryFareInfo']['ItinTotalFares']['TotalFare']['Amount'])) {
                      $totalFareAmount = $result['AirRevalidateResponse']['AirRevalidateResult']['FareItineraries']['FareItinerary']['AirItineraryFareInfo']['ItinTotalFares']['TotalFare']['Amount'];
                      if ($totalFareAmount != $price) {
                         $responseArray = "price changed";
                      } else {
                         $responseArray = "correct"; 
                      }

                    } else {
                      $responseArray =  "error";
                    }

                } else {
                  $responseArray = 'error'; 
                }

          } elseif ($type == 'manual')  {
              $responseArray = "manual"; 
          }
          else {
            $responseArray = "error";
          }
           
             $this->response($responseArray);
     }
     
     
     
     
       function aggregatorFareRules_post(){ 
               $type = $this->post('type');
           if ($type == 'FlightsLogicflight'){
               $session_id = $this->post('session_id');
               $booking_token = $this->post('booking_token');
               $url = "https://travelnext.works/api/aeroVE5/fare_rules";

               $data = array(
                     'session_id' => $session_id,
                     'fare_source_code' => $booking_token,
                     'endpoint' => $url,
                 );
                    
               $header = array();
               $fligts = new ApiClient();
               $jsonResponse = $fligts->sendRequest('POST', 'search', $data,$header,'json');
               $result = json_decode($jsonResponse,true);
               $this->response($result);
           }
       }
       
       
       
    //   function aggregatorbook_post(){ 
    //         $result = 'ferassssss';
    //       $this->response($result);
    //         // dd('ferassssss'); die;
    //   }
       
       
     
     
/////////////////////////////////////////////
/////////////////////////////////////////////
///////////////////// Feras /////////////////
////////////////////////////////////////////
///////////////////////////////////////////     
    
    

/*flight booking*/
function booking_post(){
    $travelers_information = array();
    $booking_id = $this->post('booking_id');
    $check = $this->Flights_lib->get_booking($booking_id);
    if ($check) {
    $booking_guest_info = json_decode($check->booking_guest_info);
    $guests = [];
    foreach ($booking_guest_info as $key) {
    if ($key->title == 'Mr') {$gender = 'MALE';}else{$gender = 'FEMALE';}
array_push($guests,array(
    "traveler_type"=> $key->traveller_type,
    "title"=> $key->title,
    "first_name"=> $key->first_name,
    "last_name"=> $key->last_name,
    "dateofBirth"=> date('Y-m-d', strtotime($key->dob_year.'-'.$key->dob_month.'-'.$key->dob_day)),
    "gender"=> $gender,
    "email"=> $check->accounts_email,
    "calling_code"=> 34,
    "number"=> $check->ai_mobile,
    "documentType"=> "PASSPORT",
    "birthPlace"=> "Madrid",
    "issuanceLocation"=> "Madrid",
    "issuanceDate"=> date('Y-m-d', strtotime($key->passport_issuance_year.'-'.$key->passport_issuance_month.'-'.$key->passport_issuance_day)),
    "expiryDate"=> date('Y-m-d', strtotime($key->passport_year.'-'.$key->passport_month.'-'.$key->passport_day)),
    "issuanceCountry"=> "ES",
    "validityCountry"=> "ES",
    "nationality"=> "ES",
    "holder"=> true
));
}
    $travelers_information[] = array(
    "first_name"=> $check->ai_first_name,
    "last_name"=> $check->ai_last_name,
    "companyName"=> "PHPTRAVELS",
    "countryCallingCode"=> 34,
    "number"=> $check->ai_mobile,
    "emailAddress"=> $check->accounts_email,
    "address"=> "70 Crown Street, LONDON",
    "postalCode"=> "28014",
    "cityName"=> 'Madrid',
    "countryCode"=> 'ES',
    "traveler_information"=>$guests
);
    $routes = json_decode($check->routes)[0][0]->form;
    $travelers_information = $travelers_information;
    $c1 = 'client_credentials';
    $c2 = 'B9wRGKqW9KitLGURs3hF3KEGlsOSs2rr';
    $c3 = 'sMiP1tjGFDDyeTyD';

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/modules/flights/amadeus/api/v1/booking',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
        'flights_data' => json_encode($routes),
        'guest' => json_encode($travelers_information),
        'c1'=> $c1,
        'c2' => $c2,
        'c3' => $c3
    ),
    CURLOPT_HTTPHEADER => array(
    'Cookie: ci_session=f9iaugefmm4r5gpq8jnconavvii48vu7'
    ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $this->response($response);
    }else{
        $this->response(array('msg'=>'booking data not found!'));
    }

    }
}