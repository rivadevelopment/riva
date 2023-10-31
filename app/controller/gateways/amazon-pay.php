<?php

//header('Access-Control-Allow-Origin: *');

// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST');
// header("Access-Control-Allow-Headers: X-Requested-With");

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS");
// header("Access-Control-Allow-Headers: Authorization,Origin,X-Requested-With,Content-Type,Accept,Referrer");



use Curl\Curl;
$router->post('payment/amazon_cc_reponse', function() {
    
   
     
   //  dd($_POST);
     
   // $feas =  $_SESSION;
  //  $rrr = "amazzzzoooooooon".$feas['amazon_pay_data'];
//      dd($feas);
   //  dd($_SESSION);
     //die;
     
    // dd($_SESSION['payload']);
     
    // dd($_SESSION['amazon_pay_data']);
     
    
     $postData = $_SESSION['amazon_pay_data'];
     
    // dd($postData);
     
    // dd($_SESSION);
    // die;
     
     $payload = json_decode(base64_decode($postData['payload']));
     
      //$postData = $_SESSION['tt'];
      
     // $payload =  json_decode(base64_decode($_SESSION['tt']));
    
  //  print_r("111111------eeeeeee");
    
    // dd($_SESSION);
    // exit();
   
    // dd($payload->name); die;
    $response['APDdate'] = $_POST;
  //  dd($response['APDdate']);
  //  dd(api_url);
    //$_SESSION['amazon_pay_data'] = $_POST;
//    dd($postData);
 //   dd($_POST); 
   // exit();
   
//   dd($_SESSION['user_id']);die;
   
      //  print_r("2222");
  
  if($response['APDdate']['response_code'] == '14000' || $response['APDdate']['status'] == '14') {
     
      //    print_r("333");
         
     // dd("Just a moment, we are issuing your invoice");
     
      function user_id()
    { if (isset($_SESSION['user_login']) == true) {
        return $_SESSION['user_id'];} else { return "0";}
    } $user_id = user_id();
    
    $booking_data = $payload;
     //dd('$_SESSION'. $_SESSION);
    // dd('$_POST'. $_POST);
//     dd('$postData'. $postData);
//dd($_SESSION);
     
     // print_r("444");
     
    if($booking_data->booking_type == 'hotels'){
        
        $booking_data = $postData;
        
      //  $payload1233 = json_decode(base64_decode($postData['payment_gateway_data']));
        
        //  dd(1);
        //   dd($payload1233);

        if(isset($_SESSION['ages']) && !empty($_SESSION['ages'])){
        $ch_ages = $_SESSION['ages'];
        }else{
            $ch_ages = '';
        }
        
        //   dd(2);

        $rom[] = array(
        'room_name'=>$payload->room_type,
        'room_price'=>number_format($payload->room_price,2),
        'room_qaunitity'=>$payload->room_quantity,
        'room_extrabed_price'=>0,
        'room_extrabed'=>0,
        'room_actual_price'=>number_format($payload->real_price,2)
        );
        
        //  dd(3);
         
         $guest = $booking_data['firstname_1'].$booking_data['lastname_1'];
         
        //  dd('gest'.$guest);
        
        //  dd('hotel_id'. $payload->hotel_id);
        //  dd('stars'. $payload->hotel_stars);
        //  dd('total_price' . $payload->total_price);
        //  dd('checkin' . $payload->checkin);
        //  dd('checkout' . $payload->checkout);
        //  dd('adults' . $payload->adults);
        //  dd('childs' . $payload->childs);
        //  dd('transaction_id'. $_POST['fort_id']);
        //  dd('transaction_status' . 'CLOSED');
        //  dd('child_ages'. $ch_ages);
        //  dd('deposit' . $payload->deposit_amount);
        //  dd('tax'. $payload->total_tax);
        // dd('firstname'. $booking_data['firstname']);
        // dd('lastname'. $booking_data['lastname']);
        // dd('email' . $booking_data['email']);
        //  dd('address' . $booking_data['address']);
        //  dd('phone' . $booking_data['phone']);
        //  dd('supplier' . $payload->supplier);
        //  dd('curr_code' . $payload->currency);
        //  dd('tax_type' . $payload->tax);
        //  dd('hotel_name' . $payload->hotel_name);
        //  dd('nights' . $payload->nights);
        //  dd('loaction' . $payload->city_name);
        //  dd('hotel_img' . $payload->hotel_img);
        //  dd('rooms' . json_encode($rom));
        //  dd('deposit_type' . $payload->deposit_type);
        //  dd('user_id' . $user_id);
        //  dd('payment_gateway' . $booking_data['payment_gateway']);
        //  dd('latitude' . $payload->latitude);
        //  dd('longitude' . $payload->longitude);
        //  dd('booking_key' . $payload->bookingKey);
        //  dd('children_ages' . $payload->children_ages);
        //  dd('real_price' . $payload->real_price);
        //  dd('guest' . $guest);
        // // extra fields
        //  dd('room_id' . $payload->room_id);
        //  dd('roomscount' . $payload->room_quantity);
        //  dd('city_code' . $payload->city_code);
        //  dd('country_code' . $payload->country_code);
        //  dd('nationality' . $payload->nationality);
        //  dd("hotel_phone" . $payload->hotel_phone);
        //  dd("hotel_email". $payload->hotel_email);
        //  dd("hotel_website". $payload->hotel_website);
        //  dd("hotel_city_code" . $payload->city_code);
        //  dd("hotel_nationality" . $payload->nationality);
        //  dd("hotel_country_code" . $payload->country_code);
        //  dd("booking_from" . 'Web App');
        //  dd("supplier_name". $payload->supplier_name);
         
        //  dd('5555');
         
         //'transaction_id' => $captured['id'],
         //   'transaction_status' => $captured['status'],
         
        
        //save booking data in db
        $req = new Curl();
        $req->post(api_url . 'api/hotel/book?appKey=' . api_key, array(
        'hotel_id' => $payload->hotel_id,
        'stars' => $payload->hotel_stars,
        'total_price' => $payload->total_price,
        'checkin' => $payload->checkin,
        'checkout' => $payload->checkout,
        'adults' => $payload->adults,
        'childs' => $payload->childs,
        'transaction_id' => $_POST['fort_id'],
        'transaction_status' => 'CLOSED',
        'child_ages' => $ch_ages,
        'deposit' => $payload->deposit_amount,
        'tax' => $payload->total_tax,
        'firstname' => $booking_data['firstname'],
        'lastname' => $booking_data['lastname'],
        'email' => $booking_data['email'],
        'address' => $booking_data['address'],
        'phone' => $booking_data['phone'],
        'supplier' => $payload->supplier,
        'curr_code' => $payload->currency,
        'tax_type' => $payload->tax,
        'hotel_name' => $payload->hotel_name,
        'nights' => $payload->nights,
        'loaction' => $payload->city_name,
        'hotel_img' => $payload->hotel_img,
        'rooms' => json_encode($rom),
        'deposit_type' => $payload->deposit_type,
        'user_id' => $user_id,
        'payment_gateway' => $booking_data['payment_gateway'],
        'latitude' => $payload->latitude,
        'longitude' => $payload->longitude,
        'booking_key' => $payload->bookingKey,
        'children_ages' => $payload->children_ages,
        'real_price' => $payload->real_price,
        'guest' => $guest, //$booking_data->guest,
        // extra fields
        'room_id' => $payload->room_id,
        'roomscount' => $payload->room_quantity,
        'city_code' => $payload->city_code,
        'country_code' => $booking_data['country_code'],
        'nationality' => $booking_data['nationality'],
        'hotel_phone' => $payload->hotel_phone,
        'hotel_email' => $payload->hotel_email,
        'hotel_website' => $payload->hotel_website,
        'hotel_city_code' => $payload->city_code,
        'hotel_nationality' => $payload->nationality,
        'hotel_country_code' => $payload->country_code,
        'booking_from' => 'Web App',
        'supplier_name' => $payload->supplier_name,
        'invoice_url' => root . 'hotels/booking/invoice/',
        'price_type' => '0',
        'room_adult_price' => '',
        'room_child_price' => '',
        ));
        
         //dd(4);
        //
        if ($req->response == true) {
            
            //dd($req->response);
        $invoice_url =  root . 'hotels/booking/invoice/' . $req->response->sessid . '/' . $req->response->id;
            header('Location: ' .$invoice_url);
              
        } else { echo "Booking Error Please Try Again."; }
        
        
    // end data save in db
    } else if($booking_data->booking_type == 'tours') {   ///////////////////////////////////// tours check 
    
        
  //  dd("555");   
    
        $adult_travellers = $payload->adult_travellers;
        $child_travellers = $payload->child_travellers;
        $infant_travellers = $payload->infant_travellers;
        
       

        $adult = [];
        for ($i = 1; $i <= $adult_travellers; $i++) {
            $adult[$i] = array(
                'title'=>$postData["adult_title_".$i],
                'first_name'=>$postData["adult_firstname_".$i],
                'last_name'=>$postData["adult_lastname_".$i],
                'age'=>'',
                );
        }


 // dd("555----222222222");
 
        $child = [];
        for ($x = 1; $x <= $child_travellers; $x++) {
            $child[$x] = array(
                'title'=>'mr',
                'first_name'=>$postData["child_firstname_".$x],
                'last_name'=>$postData["child_lastname_".$x],
                'age'=>$postData["child_age_".$x],
                );
        }

        $infant = [];
        for ($z = 1; $z <= $infant_travellers; $z++) {
            $infant[$z] = array(
                        'title'=>$postData["infant_title_".$z],
                        'first_name'=>$postData["infant_firstname_".$z],
                        'last_name'=>$postData["infant_lastname_".$z],
                        'age'=>'',
                        );
        }

        $array_traveller = array_merge($adult,$child,$infant);
        $guest = json_encode($array_traveller);
        
        
        // dd("555----33333eeeeeeeee");


        
        //calculate checkout date with add tour days in checkin
        $date = explode('-',$payload->tour_date);
        $checkout = ($date[0] + $payload->tourDays).'-'.$date[1].'-'.$date[2];
            // save tour data
            // final booking post request
            
           // dd("666666----33333eeeeeeeee");
       
            
            
        $req = new Curl();
        
       //  dd("777777----33333eeeeeeeee");

        
        $req->post(api_url . 'api/tour/book?appKey=' . api_key, array(
        'tour_id' => $payload->tour_id,
        'name' => $payload->name,
        'tour_type' => $payload->tour_type,
        'location' => $payload->location,
        'img' => json_encode($payload->img),
        'checkin' => $payload->tour_date,
        'checkout' => $checkout,
        'desc' => $payload->desc,
        'price' => $payload->price,
        'transaction_id' => $_POST['fort_id'],
        'transaction_status' => 'CLOSED',
        'booking_status' => 'confirmed',
        'booking_payment_status' => 'paid',
        'actual_price' => $payload->actual_price,
        'b2c_price_adult' => $payload->b2c_price_adult,
        'b2b_price_adult' => $payload->b2b_price_adult,
        'b2e_price_adult' => $payload->b2e_price_adult,
        'b2c_price_child' => $payload->b2c_price_child,
        'b2b_price_child' => $payload->b2b_price_child,
        'b2e_price_child' => $payload->b2e_price_child,
        'b2c_price_infant' => $payload->b2c_price_infant,
        'b2b_price_infant' => $payload->b2b_price_infant,
        'b2e_price_infant' => $payload->b2e_price_infant,
        'b2c_markup' => $payload->b2c_markup,
        'b2b_markup' => $payload->b2b_markup,
        'b2e_markup' => $payload->b2e_markup,
        'service_fee' => $payload->service_fee,
        'adult_price' => $payload->adult_price,
        'child_price' => $payload->child_price,
        'infant_price' => $payload->infant_price,
        'maxAdults' => $payload->maxAdults,
        'maxChild' => $payload->maxChild,
        'maxInfant' => $payload->maxInfant,
        'rating' => $payload->rating,
        'longitude' => $payload->longitude,
        'latitude' => $payload->latitude,
        'redirect' => $payload->redirect,
        'inclusions' => $payload->inclusions,
        'exclusions' => $payload->exclusions,
        'currencycode' => $payload->currencycode,
        // outside data
        'user_id' => $user_id,
        'guest' => $guest,
        "booking_from" => 'Web App',
        "price_type" => '0',
        // 
        'duration' => $payload->duration,
        'policy' => $payload->policy,
        'max_travellers' => $payload->max_travellers,
        'departure_time' => $payload->departure_time,
        'departure_point' => $payload->departure_point,
        'taxType' => $payload->taxType,
        'taxValue' => $payload->total_tax,
        'supplier' => $payload->supplier,
        'firstname' => $postData['firstname'],
        'lastname' => $postData['lastname'],
        'email' => $postData['email'],
        'address' => $postData['address'],
        'phone' => $postData['phone'],
        'adults' => $payload->adult_travellers,
        'childs' => $payload->child_travellers,
        'infants' => $payload->infant_travellers,
        'travellers' => $payload->travellers,
        'payment_gateway' => $postData['payment_gateway'],
        'country_code' => $postData['country_code'],
        'nationality' => $postData['nationality'],
        "invoice_url" => root . 'tours/booking/invoice/', 
        ));

       if ($req->response == true) {

             $invoice_url =  root . 'tours/booking/invoice/' . $req->response->sessid . '/' . $req->response->id;
             $url_path = $invoice_url;
    
             echo '<script>window.location = "'.$url_path.'";</script>';
             echo 'window.location.replace('+$url_path+');';
            
        } else {  echo "Booking Error Please Try Again."; }

        logs($SearchType = "Tour Book ");
        // end tour data save in db

    } else {


          //  dd("Just a moment, we are issuing your invoice"); die;

         // for flight booking
            $route = (array)$payload;
            $routes = json_encode($route);
            
            $booking_data = $postData;
            

            
           // dd($postData); die; /// traveller /// prices ///
            
           // $booking_data= (array)$booking_data;
           //dd($prices);die;
             //dd($booking_data); die;
            
            
            $traveller = json_decode(base64_decode($booking_data['traveller']));
            $prices = json_decode(base64_decode($booking_data['prices']));
            // dd($prices); die;
        
            // $traveller = json_decode(base64_decode($booking_data->traveller));
            // $prices = json_decode(base64_decode($booking_data->prices));
            $travellers = $traveller->adults + $traveller->childs + $traveller->infants;
            
            dd($postData); die;
            
            
            $adult_travellers = $traveller->adults;
            $child_travellers = $traveller->childs;
            $infant_travellers =$traveller->infants;
           
    
            $adult = [];
            for ($i = 1; $i <= $adult_travellers; $i++) {
                $adult[$i] = array(
                    'title'=>$postData["adult_title_".$i],
                    'first_name'=>$postData["adult_firstname_".$i],
                    'last_name'=>$postData["adult_lastname_".$i],
                    'age'=>'',
                    );
            }
    
    
     // dd("555----222222222");
     
            $child = [];
            for ($x = 1; $x <= $child_travellers; $x++) {
                $child[$x] = array(
                    'title'=>'mr',
                    'first_name'=>$postData["child_firstname_".$x],
                    'last_name'=>$postData["child_lastname_".$x],
                    'age'=>$postData["child_age_".$x],
                    );
            }
    
            $infant = [];
            for ($z = 1; $z <= $infant_travellers; $z++) {
                $infant[$z] = array(
                            'title'=>$postData["infant_title_".$z],
                            'first_name'=>$postData["infant_firstname_".$z],
                            'last_name'=>$postData["infant_lastname_".$z],
                            'age'=>'',
                            );
            }
    
            $array_traveller = array_merge($adult,$child,$infant);
            $guest = json_encode($array_traveller);
                
               dd($guest); 
            
            
            
            
           
            
            // save in db
            $flight_no = ($route[0][0]->departure_flight_no)? $route[0][0]->departure_flight_no: 123;
            
            // dd($prices->total); die;
            
             
             $arrayTT = array(
            'flight_id'=>$flight_no,
            'total_price'=>$prices->total,
            'adults'=>$traveller->adults,
            'childs'=>$traveller->childs,
            'infants'=>$traveller->infants,
            'deposit'=>'50',
            'tax'=>'45',
            'firstname' => $booking_data['firstname'],
            'lastname' => $booking_data['lastname'],
            'email' => $booking_data['email'],
            'address' => $booking_data['address'],
            'phone' => $booking_data['phone'],
            'transaction_id' => $_POST['fort_id'],
            'transaction_status' => 'CLOSED',
            'booking_status' => 'confirmed',
            'booking_payment_status' => 'paid',
            'supplier'=>$prices->supplier,
            'curr_code'=>$prices->currency, //// 
            'deposit_type'=>'percentage',
             'flights_data'=>$routes,
             'user_id' => $user_id,
             'payment_gateway' => $booking_data['payment_gateway'],
            'booking_key' => '',
            //'guest' => $booking_data['guest'],
            'supplier_name' => $prices->total,
            'nationality' => $booking_data['nationality'],
            'booking_from' => 'web',
            'flight_type' => $prices->flight_type,
            'invoice_url' => root . 'flights/booking/invoice/'
            ); 
            
            
             dd($arrayTT); die;
            
            $req = new Curl();
            $req->post(api_url.'api/flight/book?appKey='.api_key, array(
            'flight_id'=>$flight_no,
            'total_price'=>$prices->total,
            'adults'=>$traveller->adults,
            'childs'=>$traveller->childs,
            'infants'=>$traveller->infants,
            'deposit'=>'50',
            'tax'=>'45',
            'firstname' => $booking_data['firstname'],
            'lastname' => $booking_data['lastname'],
            'email' => $booking_data['email'],
            'address' => $booking_data['address'],
            'phone' => $booking_data['phone'],
            'transaction_id' => $captured['id'],
            'transaction_status' => $captured['status'],
            'supplier'=>$prices->supplier,
            'curr_code'=>$prices->currency, //// 
            'deposit_type'=>'percentage',
            'flights_data'=>$routes,
            'user_id' => $user_id,
            'payment_gateway' => $booking_data['payment_gateway'],
            'booking_key' => '',
            'guest' => $booking_data['guest'],
            'supplier_name' => $prices->total,
            'nationality' => $booking_data['nationality'],
            'booking_from' => 'web',
            'flight_type' => $prices->flight_type,
            "invoice_url" => root . 'flights/booking/invoice/'
            ));
            
            
            
            
            
            dd($booking_data['firstname']); die;
            
            dd($prices); die;
            
            if ($req->response == true) {
            header('Location: ' . root . 'flights/booking/invoice/' . $req->response->sessid . '/' . $req->response->id);
            } else { echo "Booking Error Please Try Again."; }
            // generate logs
            logs($SearchType = "Flights Book ");
            // end for flight booking
        
    }
    
  } else {

            $tour = $payload;
            $booking_type = $payload->booking_type;
            
        if($booking_type == 'tours'){
     
            $title = "Booking ". $tour->name;
            $meta_title = "Booking ". $tour->name;
            $meta_appname = "";
            $meta_desc = "";
            $meta_img = "";
            $meta_url = "";
            $meta_author = "RivaTrip";
            $meta = "1";

            // user session check
            if (isset($_SESSION['user_login']) == true) {
                // dd('hello');die;
            $req = new Curl();
            $req->post(api_url . 'api/login/get_profile?appKey=' . api_key, array('id' => $_SESSION['user_id'], ));
            $profile = json_decode($req->response);
            $profile_data = $profile->response;
            } else {}
             
            $_POST['date'] = $tour->tour_date;
            $_POST['adults'] = $tour->adult_travellers;
            $_POST['childs'] = $tour->child_travellers;
            $_POST['infants'] = $tour->infant_travellers;
            
            
        }   else if($booking_type == 'hotels'){
            
           //  = $booking_data;
            $booking_data = $payload;
            
            $title = "Hotel Booking";
            $meta_title = "Hotel Booking";
            $meta_appname = "";
            $meta_desc = "";
            $meta_img = "";
            $meta_url = "";
            $meta_author = "RivaTrip";
            $meta = "1";

            if(isset($payload->room_quantity) && !empty($payload->room_quantity)){
                $rooms_quatity = $payload->room_quantity;
            }else{
                $rooms_quatity = 1;
            }

            $cin = strtotime($booking_data->checkin);
            $cout = strtotime($booking_data->checkout);
            $nights = $cout - $cin;

            // user session check
            if (isset($_SESSION['user_login']) == true) {
                $req = new Curl();
                $req->post(api_url . 'api/login/get_profile?appKey=' . api_key, array('id' => $_SESSION['user_id'], ));
                $profile = json_decode($req->response);
                $profile_data = $profile->response;
            } else {}
    
        } else {
            
             // for flights

            $routes = (array)$booking_data;
            $traveller = json_decode(base64_decode($all_data['flight_traveller']));
            $prices = json_decode(base64_decode($all_data['flight_prices']));

            $title = "Flight Booking";
            $meta_title = "Flight Booking";
            $meta_appname = "Flight Booking";
            $meta_desc = "";
            $meta_img = "";
            $meta_url = "";
            $meta_author = "";
            $meta = "1";

            // user session check
            if (isset($_SESSION['user_login']) == true) {
            $req = new Curl();
            $req->post(api_url . 'api/login/get_profile?appKey=' . api_key, array('id' => $_SESSION['user_id'], ));
            $profile = json_decode($req->response);
            $profile_data = $profile->response;
            } else {}
          // for flights end
            
        }
            $_SESSION['flash'] = $response['APDdate']['response_message']; //'Something went wrong, your transaction has been failed.';
            //issue in below lines
            $booking_type = $payload->booking_type;
            $body = views."modules/".$booking_type."/booking.php";
            include layout; 
  }
  
});


///////////////////////////////////////////////////////////////////////////////////////////////////////
//*****************************************************************************************************//
///////////////////// Amazon Payment Gateway Direct credit card payment - gateway name ////////////////////
//*****************************************************************************************************//
/////////////////////////////////***************************************************************/////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
$router->post('payment/debit_credit_card_payment', function() {
 
    $payload = json_decode(base64_decode($_POST['payload']));
    $lang = $_SESSION['session_lang'];
    
   // dd($payload->booking_type); die;
    
    //Tabby full passengers name array 
    $passengerstabby = [];
    //////////////apply condition for multiple form data 
    if(isset($payload->booking_type) && $payload->booking_type=='tours'){
        $booking_type = $payload->booking_type;
        $id = $payload->tour_id;
        $name = $payload->name;
        $addressLocation = $payload->location;
        $currency = $payload->currencycode; 
        $total_price = $payload->total_price;
        $city_name = $payload->location;
        $order_description = preg_replace('/[^A-Za-z0-9. -]/', '', trim('tours '.$name));
        
        // $order_description = trim('tours '.$name);

        // 
    } elseif(isset($payload->booking_type) && $payload->booking_type=='hotels'){
        $booking_type = $payload->booking_type;
        $id = $payload->hotel_id;
        $name = $payload->hotel_name;
        $addressLocation = $payload->hotel_address;
        $currency = $payload->currency; 
        $total_price = str_replace(',','',$payload->total_price);
        $city_name = $payload->city_name;
        //$order_description = trim('hotels '.$name);
        $order_description = preg_replace('/[^A-Za-z0-9. -]/', '', trim('hotels '.$name));
    } else {

        // for flights
        $payload = (array) json_decode(base64_decode($_POST['payload']));
        $prices = json_decode(base64_decode($_POST['prices']));
        
        // this data for tabby api
        $booking_type = $payload['booking_type'];
        $id = $payload[0][0]->departure_flight_no;
        $name = $payload[0][0]->airline_name;
        $addressLocation = $payload[0][0]->departure_airport;
        $currency = $prices->currency;
        $total_price = str_replace(',','',$prices->total);
       // $order_description = trim('flights '.$name);
        $order_description = preg_replace('/[^A-Za-z0-9. -]/', '', trim('flights '.$name));
    }
    
    
    
    $fullname = $_POST['firstname'].' '.$_POST['lastname'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $country_code = $_POST['country_code'];
    $nationality = $_POST['nationality'];
    $payment_gateway = $_POST['payment_gateway'];
    $pay = $_POST['payload'];

    // price
    $total_price = round((float)$total_price);
    
    $gatewayData = json_decode(base64_decode($_POST['payment_gateway_data']));
   
    /////////////////////////////////////////////////////////////////////////
    /////////////////////// Test Enviroment signature ///////////////////////
    /////////////////////////////////////////////////////////////////////////
    $access_code = 'JXONDL8f6aptape4sGtd'; 
    $merchant_identifier = '8e600dde';
    $action= 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
    /////////////////////////////////////////////////////////////////////////
    /////////////////////// Test Enviroment signature ///////////////////////
    /////////////////////////////////////////////////////////////////////////
    
    /////////////////////////////////////////////////////////////////////////
    ///////////////////////  Prode signature ///////////////////////
    /////////////////////////////////////////////////////////////////////////
    // $access_code = $gatewayData->c1;
    // $merchant_identifier = $gatewayData->c2;
    // $action = $gatewayData->dev ? $gatewayData->dev_endpoint : $gatewayData->pro_endpoint;
    /////////////////////////////////////////////////////////////////////////
    ///////////////////////  Prode signature ///////////////////////
    /////////////////////////////////////////////////////////////////////////    
    
    
    //form Data 
    $bookingData = json_decode(base64_decode($_POST['payload']));
    $merchant_reference = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 10, 5).'-'.substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 10, 5);
   
   ///Session booking//////////
   
   

          //Session ////////////////
     /////////////////////////////////////////////////////////////////////////
    ///////////////////////  test signature ///////////////////////
    /////////////////////////////////////////////////////////////////////////
        $_SESSION['amazon_pay_data'] = $_POST;
        $_SESSION['ahmad_test_data'] = $_POST['payload'];
   //     dd($_SEESION);
     //   die;
      /////////////////////////////////////////////////////////////////////////
    ///////////////////////  test signature ///////////////////////
    ///////////////////////////////////////////////////////////////////////// 
   
      //Session ////////////////
     /////////////////////////////////////////////////////////////////////////
    ///////////////////////  Prode signature ///////////////////////
    /////////////////////////////////////////////////////////////////////////
     // $_SESSION['amazon_pay_data'] = $_POST;
      /////////////////////////////////////////////////////////////////////////
    ///////////////////////  Prode signature ///////////////////////
    ///////////////////////////////////////////////////////////////////////// 
   
   
   
    
   // $_SESSION['tt'] = $_POST['payload'];
   //Session ////////////////
    
    $ctotal_price = $total_price*100;
    
    // dd($_SESSION['qawsedrfc']);
    
    // dd(http_build_query( $bookingData ));
    // exit();    
    // $unique_sess_id = 'booking-of-'.$bookingData->booking_type.'-id-'.$bookingData->hotel_id.'-by-'.$_POST['email'];
    // $_SESSION[$unique_sess_id] = $_POST['payload'];
    // $_SESSION['ahmad_test_data'] = $_POST['payload'];

    
    //preparing request Data for amazon pay 
    $requestParams = array(
        'command' => 'PURCHASE',
        'access_code' => $access_code,
        'merchant_identifier' => $merchant_identifier,
        'merchant_reference' => $merchant_reference,
        'amount' => $ctotal_price,
        'currency' => $currency,   //'AED',
        'language' => $lang,       //'en',
        'customer_email' => $email,
        'order_description' => $order_description,
        'return_url'=> root .'payment/amazon_cc_reponse',
        );
        
        
        // dd($requestParams);
        // exit();        
        $shaString = '';
        // sort an array by key
        ksort($requestParams);
        foreach ($requestParams as $key => $value) {
            $shaString .= "$key=$value";
        }
        
        // make sure to fill your sha request pass phrase
       
       
        /////////////////////////////////////////////////////////////////////////
        /////////////////////// Prod Enviroment signature ///////////////////////
        /////////////////////////////////////////////////////////////////////////
        // $shaString = "52/GBza5t9Foj8r08G30EX#*" . $shaString . "52/GBza5t9Foj8r08G30EX#*";
        /////////////////////////////////////////////////////////////////////////
        /////////////////////// Prod Enviroment signature ///////////////////////
        /////////////////////////////////////////////////////////////////////////
      
       
        /////////////////////////////////////////////////////////////////////////
        /////////////////////// Test Enviroment signature ///////////////////////
        /////////////////////////////////////////////////////////////////////////
        $shaString = "200qU.mRa6sxDKf27pMLdv+}" . $shaString . "200qU.mRa6sxDKf27pMLdv+}";
        /////////////////////////////////////////////////////////////////////////
        /////////////////////// Test Enviroment signature ///////////////////////
        /////////////////////////////////////////////////////////////////////////
        
        
        $signature = hash("SHA256", $shaString);
        // echo $signature;
        
        // your request signature
        $requestParams['signature'] = $signature;
        
        $redirectUrl = $action;
        echo "<html xmlns='https://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
        echo "<form action='$redirectUrl' method='post' name='frm'>\n";
        foreach ($requestParams as $a => $b) {
            echo "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
        }
        echo "\t<script type='text/javascript'>\n";
        echo "\t\tdocument.frm.submit();\n";
        echo "\t</script>\n";
        echo "</form>\n</body>\n</html>";
        
        
         //$requestParams['signature'] = hash($SHAType, $shaString);

        
    //////// Feras adding //////// 
        
    //   $redirectUrl = $action; 
    //     //open connection
    // $ch = curl_init();

    // //set the url, number of POST vars, POST data
    // //$useragent = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0";
    // //curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    // 'Content-Type: application/json;charset=UTF-8',
    //  //'Accept: application/json, application/*+json',
    //  //'Connection:keep-alive'
    //  ));
    // curl_setopt($ch, CURLOPT_URL, $redirectUrl);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // allow redirects
    // //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
    // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); // The number of seconds to  wait while trying to connect
    // //curl_setopt($ch, CURLOPT_TIMEOUT, Yii::app()->params['apiCallTimeout']); 
    // // timeout in seconds
    // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestParams));

    // $response = curl_exec($ch);
    // dd($response); die;

    // curl_close($ch);
        
        //////// End Feras adding //////// 
});



///////////////////////////////////////////////////////////////////////////////////////////////////////
//*****************************************************************************************************//
//////////////////////////////// Amazon Payment Gateway credit card installments - gateway name /////////
//*****************************************************************************************************//
/////////////////////////////////***************************************************************/////////
///////////////////////////////////////////////////////////////////////////////////////////////////////

$router->post('payment/debit_credit_card_installments', function() {
   
    $payload = json_decode(base64_decode($_POST['payload']));
    
    $lang = $_SESSION['session_lang'];
    
   // dd($payload->booking_type); die;
    
    //Tabby full passengers name array 
    $passengerstabby = [];
    //////////////apply condition for multiple form data 
    if(isset($payload->booking_type) && $payload->booking_type=='tours'){
        $booking_type = $payload->booking_type;
        $id = $payload->tour_id;
        $name = $payload->name;
        $addressLocation = $payload->location;
        $currency = $payload->currencycode; 
        $total_price = $payload->total_price;
        $city_name = $payload->location;
        // 
    } elseif(isset($payload->booking_type) && $payload->booking_type=='hotels'){
        $booking_type = $payload->booking_type;
        $id = $payload->hotel_id;
        $name = $payload->hotel_name;
        $addressLocation = $payload->hotel_address;
        $currency = $payload->currency; 
        $total_price = str_replace(',','',$payload->total_price);
        $city_name = $payload->city_name;

    } else {

        // for flights
        $payload = (array) json_decode(base64_decode($_POST['payload']));
        $prices = json_decode(base64_decode($_POST['prices']));
        
        // this data for tabby api
        $booking_type = $payload['booking_type'];
        $id = $payload[0][0]->departure_flight_no;
        $name = $payload[0][0]->airline_name;
        $addressLocation = $payload[0][0]->departure_airport;
        $currency = $prices->currency;
        $total_price = str_replace(',','',$prices->total);
    }
    
    
    
    $fullname = $_POST['firstname'].' '.$_POST['lastname'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $country_code = $_POST['country_code'];
    $nationality = $_POST['nationality'];
    $payment_gateway = $_POST['payment_gateway'];
    $pay = $_POST['payload'];

    // price
    $total_price = round((float)$total_price);
    
    $lang = $_SESSION['session_lang'];
    

    $gatewayData = json_decode(base64_decode($_POST['payment_gateway_data']));
   
    /////////////////////////////////////////////////////////////////////////
    /////////////////////// Test Enviroment signature ///////////////////////
    /////////////////////////////////////////////////////////////////////////
    $access_code = 'JXONDL8f6aptape4sGtd'; 
    $merchant_identifier = '8e600dde';
    $action= 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
    /////////////////////////////////////////////////////////////////////////
    /////////////////////// Test Enviroment signature ///////////////////////
    /////////////////////////////////////////////////////////////////////////
    
    /////////////////////////////////////////////////////////////////////////
    ///////////////////////  Prode signature ///////////////////////
    /////////////////////////////////////////////////////////////////////////
    // $access_code = $gatewayData->c1;
    // $merchant_identifier = $gatewayData->c2;
    // $action = $gatewayData->dev ? $gatewayData->dev_endpoint : $gatewayData->pro_endpoint;
    /////////////////////////////////////////////////////////////////////////
    ///////////////////////  Prode signature ///////////////////////
    /////////////////////////////////////////////////////////////////////////    
   
   
    
    //form Data 
    $bookingData = json_decode(base64_decode($_POST['payload']));
    $merchant_reference = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 10, 5).'-'.substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 10, 5);
    $_SESSION['amazon_pay_data'] = $_POST;
    $ctotal_price = $total_price*100;
    
    // dd($_SESSION['qawsedrfc']);
    
    // dd(http_build_query( $bookingData ));
    // exit();    
    // $unique_sess_id = 'booking-of-'.$bookingData->booking_type.'-id-'.$bookingData->hotel_id.'-by-'.$_POST['email'];
    // $_SESSION[$unique_sess_id] = $_POST['payload'];
    // $_SESSION['ahmad_test_data'] = $_POST['payload'];
    
    //preparing request Data for amazon pay 
    $requestParams = array(
        'command' => 'PURCHASE',
        'access_code' => $access_code,
        'merchant_identifier' => $merchant_identifier,
        'merchant_reference' => $merchant_reference,
        'amount' => $ctotal_price,
        'currency' => $currency,   //'AED',
        'language' => $lang,       //'en',
        'customer_email' => $email,
        'installments' => 'STANDALONE',
        'order_description' => 'TEST',
        'return_url'=> root .'payment/amazon_cc_reponse',
        );
        
        
        // dd($requestParams);
        // exit();        
        $shaString = '';
        // sort an array by key
        ksort($requestParams);
        foreach ($requestParams as $key => $value) {
            $shaString .= "$key=$value";
        }
        // make sure to fill your sha request pass phrase
        
        /////////////////////////////////////////////////////////////////////////
        /////////////////////// Prod Enviroment signature ///////////////////////
        /////////////////////////////////////////////////////////////////////////
        //$shaString = "52/GBza5t9Foj8r08G30EX#*" . $shaString . "52/GBza5t9Foj8r08G30EX#*";
        /////////////////////////////////////////////////////////////////////////
        /////////////////////// Prod Enviroment signature ///////////////////////
        /////////////////////////////////////////////////////////////////////////
      
       
        /////////////////////////////////////////////////////////////////////////
        /////////////////////// Test Enviroment signature ///////////////////////
        /////////////////////////////////////////////////////////////////////////
        $shaString = "200qU.mRa6sxDKf27pMLdv+}" . $shaString . "200qU.mRa6sxDKf27pMLdv+}";
        /////////////////////////////////////////////////////////////////////////
        /////////////////////// Test Enviroment signature ///////////////////////
        /////////////////////////////////////////////////////////////////////////
        
        $signature = hash("SHA256", $shaString);
        // echo $signature;
        
        // your request signature
        $requestParams['signature'] = $signature;
        
        
        $redirectUrl = $action;
        echo "<html xmlns='https://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
        echo "<form action='$redirectUrl' method='post' name='frm'>\n";
        foreach ($requestParams as $a => $b) {
            echo "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
        }
        echo "\t<script type='text/javascript'>\n";
        echo "\t\tdocument.frm.submit();\n";
        echo "\t</script>\n";
        echo "</form>\n</body>\n</html>";
        
});



///////////////////////////////////////////////////////////////////////////////////////////////////////
//*****************************************************************************************************//
//////////////////////////////// Book transaction /////////
//*****************************************************************************************************//
/////////////////////////////////***************************************************************/////////
///////////////////////////////////////////////////////////////////////////////////////////////////////

$router->post('payment/AMbook', function() {
   // dd('save data'); die;
    
    
       function user_id()
    { if (isset($_SESSION['user_login']) == true) {
        return $_SESSION['user_id'];} else { return "0";}
    } $user_id = user_id();
    $booking_data = $payload;
    if($booking_data->booking_type == 'hotels'){

        if(isset($_SESSION['ages']) && !empty($_SESSION['ages'])){
        $ch_ages = $_SESSION['ages'];
        }else{
            $ch_ages = '';
        }

        $rom[] = array(
        'room_name'=>$payload->room_type,
        'room_price'=>number_format($payload->room_price,2),
        'room_qaunitity'=>$payload->room_quantity,
        'room_extrabed_price'=>0,
        'room_extrabed'=>0,
        'room_actual_price'=>number_format($payload->real_price,2)
        );
        //save booking data in db
        $req = new Curl();
        $req->post(api_url . 'api/hotel/book?appKey=' . api_key, array(
        'hotel_id' => $payload->hotel_id,
        'stars' => $payload->hotel_stars,
        'total_price' => $payload->total_price,
        'checkin' => $payload->checkin,
        'checkout' => $payload->checkout,
        'adults' => $payload->adults,
        'childs' => $payload->childs,
        'transaction_id' => $_POST['fort_id'],
        'transaction_status' => 'CLOSED',
        'child_ages' => $ch_ages,
        'deposit' => $payload->deposit_amount,
        'tax' => $payload->total_tax,
        'firstname' => $booking_data->firstname,
        'lastname' => $booking_data->lastname,
        'email' => $booking_data->email,
        'address' => $booking_data->address,
        'phone' => $booking_data->phone,
        'supplier' => $payload->supplier,
        'curr_code' => $payload->currency,
        'tax_type' => $payload->tax,
        'hotel_name' => $payload->hotel_name,
        'nights' => $payload->nights,
        'loaction' => $payload->city_name,
        'hotel_img' => $payload->hotel_img,
        'rooms' => json_encode($rom),
        'deposit_type' => $payload->deposit_type,
        'user_id' => $user_id,
        'payment_gateway' => $booking_data->payment_gateway,
        'latitude' => $payload->latitude,
        'longitude' => $payload->longitude,
        'booking_key' => $payload->bookingKey,
        'children_ages' => $payload->children_ages,
        'real_price' => $payload->real_price,
        'guest' => $booking_data->guest,
        // extra fields
        'room_id' => $payload->room_id,
        'roomscount' => $payload->room_quantity,
        'city_code' => $payload->city_code,
        'country_code' => $booking_data->country_code,
        'nationality' => $booking_data->nationality,
        "hotel_phone" => $payload->hotel_phone,
        "hotel_email" => $payload->hotel_email,
        "hotel_website" => $payload->hotel_website,
        "hotel_city_code" => $payload->city_code,
        "hotel_nationality" => $payload->nationality,
        "hotel_country_code" => $payload->country_code,
        "booking_from" => 'Web App',
        "supplier_name" => $payload->supplier_name,
        "invoice_url" => root . 'hotels/booking/invoice/',
        "price_type" => '0',
        "room_adult_price" => '',
        "room_child_price" => '',
        ));
        //
        if ($req->response == true) {
        $invoice_url =  root . 'hotels/booking/invoice/' . $req->response->sessid . '/' . $req->response->id;
            header('Location: ' .$invoice_url);
              
        } else { echo "Booking Error Please Try Again."; }
    // end data save in db
    } else if($booking_data->booking_type == 'tours') {
        $adult_travellers = $payload->adult_travellers;
        $child_travellers = $payload->child_travellers;
        $infant_travellers = $payload->infant_travellers;
        

        $adult = [];
        for ($i = 1; $i <= $adult_travellers; $i++) {
            $adult[$i] = array(
                'title'=>$postData["adult_title_".$i],
                'first_name'=>$postData["adult_firstname_".$i],
                'last_name'=>$postData["adult_lastname_".$i],
                'age'=>'',
                );
        }

        $child = [];
        for ($x = 1; $x <= $child_travellers; $x++) {
            $child[$x] = array(
                'title'=>'mr',
                'first_name'=>$postData["child_firstname_".$x],
                'last_name'=>$postData["child_lastname_".$x],
                'age'=>$postData["child_age_".$x],
                );
        }

        $infant = [];
        for ($z = 1; $z <= $infant_travellers; $z++) {
            $infant[$z] = array(
                        'title'=>$postData["infant_title_".$z],
                        'first_name'=>$postData["infant_firstname_".$z],
                        'last_name'=>$postData["infant_lastname_".$z],
                        'age'=>'',
                        );
        }

        $array_traveller = array_merge($adult,$child,$infant);
        $guest = json_encode($array_traveller);
        
        //calculate checkout date with add tour days in checkin
        $date = explode('-',$payload->tour_date);
        $checkout = ($date[0] + $payload->tourDays).'-'.$date[1].'-'.$date[2];
            // save tour data
            // final booking post request
        $req = new Curl();
        $req->post(api_url . 'api/tour/book?appKey=' . api_key, array(
        'tour_id' => $payload->tour_id,
        'name' => $payload->name,
        'tour_type' => $payload->tour_type,
        'location' => $payload->location,
        'img' => json_encode($payload->img),
        'checkin' => $payload->tour_date,
        'checkout' => $checkout,
        'desc' => $payload->desc,
        'price' => $payload->price,
        'transaction_id' => $_POST['fort_id'],
        'transaction_status' => 'CLOSED',
        'booking_status' => 'confirmed',
        'booking_payment_status' => 'paid',
        'actual_price' => $payload->actual_price,
        'b2c_price_adult' => $payload->b2c_price_adult,
        'b2b_price_adult' => $payload->b2b_price_adult,
        'b2e_price_adult' => $payload->b2e_price_adult,
        'b2c_price_child' => $payload->b2c_price_child,
        'b2b_price_child' => $payload->b2b_price_child,
        'b2e_price_child' => $payload->b2e_price_child,
        'b2c_price_infant' => $payload->b2c_price_infant,
        'b2b_price_infant' => $payload->b2b_price_infant,
        'b2e_price_infant' => $payload->b2e_price_infant,
        'b2c_markup' => $payload->b2c_markup,
        'b2b_markup' => $payload->b2b_markup,
        'b2e_markup' => $payload->b2e_markup,
        'service_fee' => $payload->service_fee,
        'adult_price' => $payload->adult_price,
        'child_price' => $payload->child_price,
        'infant_price' => $payload->infant_price,
        'maxAdults' => $payload->maxAdults,
        'maxChild' => $payload->maxChild,
        'maxInfant' => $payload->maxInfant,
        'rating' => $payload->rating,
        'longitude' => $payload->longitude,
        'latitude' => $payload->latitude,
        'redirect' => $payload->redirect,
        'inclusions' => $payload->inclusions,
        'exclusions' => $payload->exclusions,
        'currencycode' => $payload->currencycode,
        // outside data
        'user_id' => $user_id,
        'guest' => $guest,
        "booking_from" => 'Web App',
        "price_type" => '0',
        // 
        'duration' => $payload->duration,
        'policy' => $payload->policy,
        'max_travellers' => $payload->max_travellers,
        'departure_time' => $payload->departure_time,
        'departure_point' => $payload->departure_point,
        'taxType' => $payload->taxType,
        'taxValue' => $payload->total_tax,
        'supplier' => $payload->supplier,
        'firstname' => $postData['firstname'],
        'lastname' => $postData['lastname'],
        'email' => $postData['email'],
        'address' => $postData['address'],
        'phone' => $postData['phone'],
        'adults' => $payload->adult_travellers,
        'childs' => $payload->child_travellers,
        'infants' => $payload->infant_travellers,
        'travellers' => $payload->travellers,
        'payment_gateway' => $postData['payment_gateway'],
        'country_code' => $postData['country_code'],
        'nationality' => $postData['nationality'],
        "invoice_url" => root . 'tours/booking/invoice/', 
        ));
      
       if ($req->response == true) {

        $invoice_url =  root . 'tours/booking/invoice/' . $req->response->sessid . '/' . $req->response->id;
        header('Location: ' .$invoice_url);
           //  dd($req->response);die;
        } else {  echo "Booking Error Please Try Again."; }

        logs($SearchType = "Tour Book ");
        // end tour data save in db

    } else {
        // for flight booking
        $route = (array)$payload;
        $routes = json_encode($route);
        $traveller = json_decode(base64_decode($booking_data->flight_traveller));
        $prices = json_decode(base64_decode($booking_data->flight_prices));
        $travellers = $traveller->adults + $traveller->childs + $traveller->infants;
        // save in db
        $flight_no = ($route[0][0]->departure_flight_no)? $route[0][0]->departure_flight_no: 123;
        $req = new Curl();
        $req->post(api_url.'api/flight/book?appKey='.api_key, array(

        'flight_id'=>$flight_no,
        'total_price'=>$prices->total,
        'adults'=>$traveller->adults,
        'childs'=>$traveller->childs,
        'infants'=>$traveller->infants,
        'deposit'=>'50',
        'tax'=>'45',
        'firstname' => $booking_data->firstname,
        'lastname' => $booking_data->lastname,
        'email' => $booking_data->email,
        'address' => $booking_data->address,
        'phone' => $booking_data->phone,
        'transaction_id' => $captured['id'],
        'transaction_status' => $captured['status'],
        'supplier'=>$prices->supplier,
        'curr_code'=>$prices->currency,
        'deposit_type'=>'percentage',
        'flights_data'=>$routes,
        'user_id' => $user_id,
        'payment_gateway' => $booking_data->payment_gateway,
        'booking_key' => '',
        'guest' => $booking_data->guest,
        'supplier_name' => $prices->total,
        'nationality' => $booking_data->nationality,
        'booking_from' => 'web',
        'flight_type' => $prices->flight_type,
        "invoice_url" => root . 'flights/booking/invoice/'

        ));

        if ($req->response == true) {
        header('Location: ' . root . 'flights/booking/invoice/' . $req->response->sessid . '/' . $req->response->id);
        } else { echo "Booking Error Please Try Again."; }
        // generate logs
        logs($SearchType = "Flights Book ");
        // end for flight booking
    }
    
});  

///////////////////////////////////////////////////////////////////////////////////////////////////////
//*****************************************************************************************************//
//////////////////////////////// Amazon Payment Gateway Request Cancel /////////
//*****************************************************************************************************//
/////////////////////////////////***************************************************************/////////
///////////////////////////////////////////////////////////////////////////////////////////////////////

//failure or cancel request
$router->post('payment/AMPbookingCancel', function() {
    
$paymentDate = $_POST['paymentDate'];
$payload = $_POST['payload'];

 $booking_type = $payload['booking_type'];
        // dd($booking_data->adult_travellers);die;
        if($booking_type == 'tours'){
            // seo and meta tags

            $tour = $booking_data;
            $title = "Booking ". $tour['name'];
            $meta_title = "Booking ". $tour['name'];
            $meta_appname = "";
            $meta_desc = "";
            $meta_img = "";
            $meta_url = "";
            $meta_author = "RivaTrip";
            $meta = "1";

            // user session check
            if (isset($_SESSION['user_login']) == true) {
            $req = new Curl();
            $req->post(api_url . 'api/login/get_profile?appKey=' . api_key, array('id' => $_SESSION['user_id'], ));
            $profile = json_decode($req->response);
            $profile_data = $profile->response;
            } else {}
             
            $_POST['date'] = $tour['tour_date'];
            $_POST['adults'] = $tour['adult_travellers'];
            $_POST['childs'] = $tour['child_travellers'];
            $_POST['infants'] = $tour['infant_travellers'];
            // $_POST['payload'] = $data['order']['items'][0]['brand'];

        } else if($booking_type == 'hotels'){
            // start
            $payload = $booking_data;
            $booking_data = $booking_data;
            // 
            $title = "Hotel Booking";
            $meta_title = "Hotel Booking";
            $meta_appname = "";
            $meta_desc = "";
            $meta_img = "";
            $meta_url = "";
            $meta_author = "";
            $meta = "1";

            if(isset($payload['room_quantity']) && !empty($payload['room_quantity'])){
                $rooms_quatity = $payload['room_quantity'];
            }else{
                $rooms_quatity = 1;
            }

            $cin = strtotime($booking_data['checkin']);
            $cout = strtotime($booking_data['checkout']);
            $nights = $cout - $cin;

            // user session check
            if (isset($_SESSION['user_login']) == true) {
                $req = new Curl();
                $req->post(api_url . 'api/login/get_profile?appKey=' . api_key, array('id' => $_SESSION['user_id'], ));
                $profile = json_decode($req->response);
                $profile_data = $profile->response;
                // dd($profile_data);
            } else {}
            // end

        } else {

            // for flights
            $routes = (array)$booking_data;
            // dd($all_data);die;
            $traveller = json_decode(base64_decode($all_data->flight_traveller));
            $prices = json_decode(base64_decode($all_data->flight_prices));
            // $routes = json_encode($route);

            $title = "Flight Booking";
            $meta_title = "Flight Booking";
            $meta_appname = "Flight Booking";
            $meta_desc = "";
            $meta_img = "";
            $meta_url = "";
            $meta_author = "";
            $meta = "1";

            // user session check
            if (isset($_SESSION['user_login']) == true) {
            $req = new Curl();
            $req->post(api_url . 'api/login/get_profile?appKey=' . api_key, array('id' => $_SESSION['user_id'], ));
            $profile = json_decode($req->response); 
            $profile_data = $profile->response;
            // dd($profile_data);
            
            
            } else {}
          // for flights end
        }
        //dd('ddsd');
            // generate logs
         //   logs($SearchType = $booking_type." Booking");
            // payload from listting page encrypted with base64
            $_SESSION['flash'] = 'Something went wrong, your transaction has been failed.';
            $body = views."modules/".$booking_type."/booking.php";
            include layout;


 });


// $router->get('payment/amazon_cc_reponse', function() {
//   // $response['APDdate'] = $_GET;  
//   dd('something went wrong,  If the payment diducted from you, please refer to your email to get your invoice. 
//         In case you did not receive the invoice, please contact us via email: support@rivatrip.com'); die; 
   
// });   
    
