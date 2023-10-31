<?php

use Curl\Curl;

$router->post('payment/tabby_api', function () {


    $payload = json_decode(base64_decode($_POST['payload']));
    
   // dd($payload); die;
    
    $flight_prices = '';
    $flight_traveller = '';
    //Tabby full passengers name array 
    $passengerstabby = [];
    //////////////apply condition for multiple form data 
    if(isset($payload->booking_type) && $payload->booking_type=='tours'){
          
          $adult_travellers = $payload->adult_travellers;
          $child_travellers = $payload->child_travellers;
          $infant_travellers = $payload->infant_travellers; 
          $adult = [];
          for ($i = 1; $i <= $adult_travellers; $i++) {
            $adult[$i] = array(
                'title'=>$_POST["adult_title_".$i],
                'first_name'=>$_POST["adult_firstname_".$i],
                'last_name'=>$_POST["adult_lastname_".$i],
                'age'=>'',
                );
           array_push($passengerstabby,"'".$_POST["adult_firstname_".$i].' '.$_POST["adult_lastname_".$i]."'");
          }

          $child = [];
          for ($x = 1; $x <= $child_travellers; $x++) {
             $child[$x] = array(
                'title'=>'mr',
                'first_name'=>$_POST["child_firstname_".$x],
                'last_name'=>$_POST["child_lastname_".$x],
                'age'=>$_POST["child_age_".$x],
                );
            array_push($passengerstabby,"'".$_POST["child_firstname_".$x].' '.$_POST["child_lastname_".$x]."'");
          }

          $infant = [];
          for ($z = 1; $z <= $infant_travellers; $z++) {
             $infant[$z] = array(
                        'title'=>$_POST["infant_title_".$z],
                        'first_name'=>$_POST["infant_firstname_".$z],
                        'last_name'=>$_POST["infant_lastname_".$z],
                        'age'=>'',
                        );
                
                 array_push($passengerstabby,"'".$_POST["infant_firstname_".$z].' '.$_POST["infant_lastname_".$z]."'");
          }

        $data = array_merge($adult,$child,$infant);
        // this data for tabby api
        $booking_type = $payload->booking_type;
        $id = $payload->tour_id;
        $name = $payload->name;
        $addressLocation = $payload->location;
        $currency = $payload->currencycode; 
        $total_price = $payload->total_price;
        $city_name = $payload->location;
        $booking_type = $payload->booking_type;
        // 
    } elseif(isset($payload->booking_type) && $payload->booking_type=='hotels'){              ///// hotels ////// 

//dd($payload); die;

        $adult_travellers = $payload->adult_travellers;
        $child_travellers = $payload->child_travellers;
        $data = [];
         for ($i = 1; $i <= $adult_travellers; $i++) {
            array_push($data, (object) array(
                'title'=>$_POST["title_".$i],
                'first_name'=>$_POST["firstname_".$i],
                'last_name'=>$_POST["lastname_".$i],
                'age'=>'',
                ));

            array_push($passengerstabby,"'".$_POST["firstname_".$i].' '.$_POST["lastname_".$i]."'");
          }

          for ($x = 1; $x <= $child_travellers; $x++) {
            array_push($data, (object) array(
                'title'=>'mr',
                'first_name'=>$_POST["firstname_".$x],
                'last_name'=>$_POST["lastname_".$x],
                'age'=>$_POST["child_age_".$x],
                ));

            array_push($passengerstabby,"'".$_POST["firstname_".$x].' '.$_POST["lastname_".$x]."'");
          }

        // this data for tabby api
        $booking_type = $payload->booking_type;
        $id = $payload->hotel_id;
        $name = $payload->hotel_name;
        $addressLocation = $payload->hotel_address;
        $currency = $payload->currency; 
        $total_price = str_replace(',','',$payload->total_price);
        $city_name = $payload->city_name;
        $booking_type = $payload->booking_type;

    } else {

        // for flights
        $payload = (array) json_decode(base64_decode($_POST['payload']));
        // $routes = json_encode($payload);
        // dd($payload);die;
        $traveller = json_decode(base64_decode($_POST['traveller']));
        $prices = json_decode(base64_decode($_POST['prices']));
        $travellers = $traveller->adults + $traveller->childs + $traveller->infants;
        //Tabby full passengers name array 
        $passengerstabby = [];
        ////////////// 
        /*adults*/
        $data = [];
        for ($i = 1; $i <= $traveller->adults; $i++) {
            array_push($data, (object) array(
            'traveller_type'=>$_POST["traveller_type_".$i],
            'title'=>$_POST["title_".$i],
            'first_name'=>$_POST["firstname_".$i],
            'last_name'=>$_POST["lastname_".$i],
            'nationality'=>$_POST["nationality_".$i],
            'dob_day'=>$_POST["dob_day_".$i],
            'dob_month'=>$_POST["dob_month_".$i],
            'dob_year'=>$_POST["dob_year_".$i],
            'passport'=>$_POST["passport_".$i],
            'passport_day'=>$_POST["passport_day_".$i],
            'passport_month'=>$_POST["passport_month_".$i],
            'passport_year'=>$_POST["passport_year_".$i],
            'passport_issuance_day'=>$_POST["passport_issuance_day_".$i],
            'passport_issuance_month'=>$_POST["passport_issuance_month_".$i],
            'passport_issuance_year'=>$_POST["passport_issuance_year_".$i]
            ));

            array_push($passengerstabby,"'".$_POST["firstname_".$i].' '.$_POST["lastname_".$i]."'");
        }


        /*childs*/
        for ($x = 1; $x <= $traveller->childs; $x++) {
        $adults = $traveller->adults;
        array_push($data, (object) array(
        'traveller_type'=>$_POST["traveller_type_".$x+$adults],
        'title'=>$_POST["title_".$x+$adults],
        'first_name'=>$_POST["firstname_".$x+$adults],
        'last_name'=>$_POST["lastname_".$x+$adults],
        'nationality'=>$_POST["nationality_".$x+$adults],
        'dob_day'=>$_POST["dob_day_".$x+$adults],
        'dob_month'=>$_POST["dob_month_".$x+$adults],
        'dob_year'=>$_POST["dob_year_".$x+$adults],
        'passport'=>$_POST["passport_".$x+$adults],
        'passport_day'=>$_POST["passport_day_".$x+$adults],
        'passport_month'=>$_POST["passport_month_".$x+$adults],
        'passport_year'=>$_POST["passport_year_".$x+$adults],
        'passport_issuance_day'=>$_POST["passport_issuance_day_".$x+$adults],
        'passport_issuance_month'=>$_POST["passport_issuance_month_".$x+$adults],
        'passport_issuance_year'=>$_POST["passport_issuance_year_".$x+$adults],
        ));

        array_push($passengerstabby,"'".$_POST["firstname_".$x].' '.$_POST["lastname_".$x]."'");

        }

        /*infants*/
        for ($b = 1; $b <= $traveller->infants; $b++) {
        $a = $traveller->childs+$traveller->adults;
        array_push($data, (object) array(
        'traveller_type'=>$_POST["traveller_type_".$b+$a],
        'title'=>$_POST["title_".$b+$a],
        'first_name'=>$_POST["firstname_".$b+$a],
        'last_name'=>$_POST["lastname_".$b+$a],
        'nationality'=>$_POST["nationality_".$b+$a],
        'dob_day'=>$_POST["dob_day_".$b+$a],
        'dob_month'=>$_POST["dob_month_".$b+$a],
        'dob_year'=>$_POST["dob_year_".$b+$a],
        'passport'=>$_POST["passport_".$b+$a],
        'passport_day'=>$_POST["passport_day_".$b+$a],
        'passport_month'=>$_POST["passport_month_".$b+$a],
        'passport_year'=>$_POST["passport_year_".$b+$a],
        'passport_issuance_day'=>$_POST["passport_issuance_day_".$b+$a],
        'passport_issuance_month'=>$_POST["passport_issuance_month_".$b+$a],
        'passport_issuance_year'=>$_POST["passport_issuance_year_".$b+$a],
        ));

        array_push($passengerstabby,"'".$_POST["firstname_".$b].' '.$_POST["lastname_".$b]."'");
        }
        
        // this data for tabby api
        $booking_type = $payload['booking_type'];
        $id = $payload[0][0]->departure_flight_no;
        $name = $payload[0][0]->airline_name;
        $addressLocation = $payload[0][0]->departure_airport;
        $currency = $prices->currency;
        $total_price = str_replace(',','',$prices->total);
        $city_name = $payload[0][0]->departure_airport;
        $flight_prices = $_POST['prices'];
        $flight_traveller = $_POST['traveller'];
        // end for flight
    }
    
    //end if else  
    $tabbyPassengersResult = implode(", ", $passengerstabby);
    $guest = json_encode($data);
    // dd($guest);die;
    //data get from payment_method page
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

    //booking data array
    $booking = ['firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'address'=>$address,'phone'=>$phone
                ,'payment_gateway'=>$payment_gateway,'country_code'=>$country_code,'nationality'=>$nationality,'guest'=>$guest,'booking_type'=>$booking_type
                ,'flight_prices'=>$flight_prices,'flight_traveller'=>$flight_traveller];

    $book= base64_encode(json_encode($booking));
        // price
        $total_price = round((float)$total_price);
        // $total_price = str_replace(',','',$total_price);
        // dd($total_price);die;
       $lang = $_SESSION['session_lang'];
       
       //////////////******* Payment Gateway Data ***************/////////////////////////////
        // $gatewayData = json_decode(base64_decode($_POST['payment_gateway_data']));
        // $publicKey = $gatewayData->c1;
        // $privateKey = $gatewayData->c2;
        // $action = $gatewayData->dev ? $gatewayData->dev_endpoint : $gatewayData->pro_endpoint;
       ////////////////////////////////////////////////////////////////////////////////////////
       
       // tabby api
        $url = "https://api.tabby.ai/api/v2/checkout";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $header = array(
            "Content-type: application/json",
            "Authorization: Bearer pk_test_9acdc318-2a70-4003-a021-0b4668b517f8"
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $data = <<<html
        {
  "payment": {
    "amount": "$total_price",
    "currency": "$currency",
    "description": "booking for $booking_type",
    "buyer": {
      "phone": "$phone",
      "email": "$email",
      "name": "$fullname",
      "dob": "1988-08-24"
    },
    "shipping_address": {
      "city": "$city_name",
      "address": "$address",
      "zip": "40401"
    },
    "order": {
      "tax_amount": "0.00",
      "shipping_amount": "0.00",
      "discount_amount": "0.00",
      "updated_at": "2019-08-24T14:15:22Z",
      "reference_id": "$id",
      "items": [
        {
          "title": "$name",
          "description": "booking for $booking_type",
          "quantity": 1,
          "unit_price": "$total_price.00",
          "discount_amount": "0.00",
          "reference_id": "$id",
          "image_url": "http://example.com",
          "product_url": "http://example.com",
          "gender": "Male",
          "category": "$booking_type",
          "color": "string",
          "product_material": "string",
          "size_type": "string",
          "size": "$book",
          "brand": "$pay"
        }
      ]
    },
    "buyer_history": {
      "registered_since": "2019-08-24T14:15:22Z",
      "loyalty_level": 0,
      "wishlist_count": 0,
      "is_social_networks_connected": true,
      "is_phone_number_verified": true,
      "is_email_verified": true
    },
    "order_history": [
      {
        "purchased_at": "2019-08-24T14:15:22Z",
        "amount": "0.00",
        "payment_method": "card",
        "status": "new",
        "buyer": {
          "phone": "string",
          "email": "abc@xyz.com",
          "name": "string",
          "dob": "2019-08-24"
        },
        "shipping_address": {
          "city": "string",
          "address": "string",
          "zip": "string"
        },
        "items": [
        {
          "title": "$name",
          "description": "booking for tour",
          "quantity": 1,
          "unit_price": "$total_price",
          "discount_amount": "0.00",
          "reference_id": "$id",
          "image_url": "http://example.com",
          "product_url": "http://example.com",
          "ordered": 0,
          "captured": 0,
          "shipped": 0,
          "refunded": 0,
          "gender": "Male",
          "category": "$booking_type",
          "color": "string",
          "product_material": "string",
          "size_type": "string",
          "size": "$book",
          "brand": "$pay"
        }
       ]
      }
    ],
    "meta": {
      "order_id": null,
      "customer": null
    },
    "attachment": {
      "body": "{\"flight_reservation_details\": {\"pnr\": \"TR$id\",\"itinerary\": [$addressLocation],\"insurance\": [Null],\"passengers\": [$tabbyPassengersResult],\"affiliate_name\": \"$name\"}}",
      "content_type": "application/vnd.tabby.v1+json"
    }
  },
  "lang": "$lang",
  "merchant_code": "RVT",
  "merchant_urls": {
    "success": "http://dev.rivatrip.com/payment/tabby-payment",
    "cancel": "http://dev.rivatrip.com/payment/booking",
    "failure": "http://dev.rivatrip.com/payment/booking"
  }
}
html;
        // dd($data);die;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        // for debug only
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
       
        // return $resp;
        $data = json_decode($resp, true);
        // dd($data);die;
        
       // $empty = $data['configuration']['products']['installments']['is_available'];
       
       $empty = $data['configuration']['available_products'];
        if($empty){

            $powerdata = $data['configuration']['available_products']['installments'];
            $url = $powerdata[0]['web_url'];

        } else{

            $url = '';
        }
        
        
        
        
        //$is_email_verified = $data['payment']['buyer_history']['is_email_verified'];
        $available_products = $data['configuration']['available_products'];
        
        if (!empty($available_products)) {
            $tabby_status = 'allowed';
        } else {
            $tabby_status = 'not allowed';
        }
        
        
        $total_payment = $data['payment']['amount'];
        $currency = $data['configuration']['currency'];
        //// create records in db status unpaid
        
        //$arr_data = array('web_url'=>$url,'is_email_verified'=>$is_email_verified, 'total_payment'=>$total_payment, 'currency'=>$currency);
        
        $arr_data = array('web_url'=>$url,'available_products'=>$tabby_status, 'total_payment'=>$total_payment, 'currency'=>$currency);

        echo json_encode($arr_data);
        curl_close($curl);
});

/////////////////////////////////////////////////////////////////

$router->get('payment/tabby-payment', function() {

    $paymentid = $_GET['payment_id'];
    $url = "https://api.tabby.ai/api/v2/payments/".$paymentid;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $header = array(
            "Accept: application/json",
            "Authorization: Bearer sk_test_c29ebc06-d133-4956-8c9a-229738c67713" 
        );
     curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
     $resp = curl_exec($curl);
     curl_close($curl);
     $data = json_decode($resp, true);
     // dd($data);die;
     if($data['status']=='AUTHORIZED'){

        $orderId = $data['order']['reference_id'];
        $amount = $data['amount'];
        $created_at = $data['created_at'];
        $status = $data['status'];
        $transactionId = $data['order']['reference_id'];
        $title_item = $data['order']['items'][0]['title'];
        $payload = json_decode(base64_decode($data['order']['items'][0]['brand']));
        $booking_data = json_decode(base64_decode($data['order']['items'][0]['size']));
        // 
        $_SESSION['mail_data'] = array_merge((array)$payload, (array)$booking_data);
        //
        $data_mail =  $_SESSION['mail_data'];
        //
        // $req = new Curl();
        // $req->post(api_url.'api/email/globalmail?appKey='.api_key, array(
        //     'name'=>$data_mail['firstname'].' '.$data_mail['lastname'],
        //     'email'=>'payment@rivatrip.com',
        //     'body'=>'send mail by ak',
        //     'subject'=>'Tabby Payment Email',
        //     'cc_mail'=>'info@rivatrip.com'
        // ));
        
  //////////////////// Webhooks feras webhoks ///////////////////////////////

//         $url = "https://api.tabby.ai/api/v1/webhooks";
//         $curl = curl_init($url);
        
//         curl_setopt($curl,CURLOPT_URL,$url);
//         curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

//         $header = array(
//             "Content-type: application/json",
//             "X-Merchant-Code: RVT",
//             "Authorization: Bearer sk_test_c29ebc06-d133-4956-8c9a-229738c67713"
//         );
//         curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        
        
//      $webhook = <<<html
//       {
//             "id":  "string",
//             "url": "https://rivatrip.com/payment/webhooks",
//             "is_test": true,
//             "header": 
//             {
//                 "title": "string",
//                 "value": "string"
//             }

//         }
// html;

//         curl_setopt($curl,CURLOPT_RETURNTRANSFER,$webhook);
//         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
//         $resp = curl_exec($curl);
//         $webhooks = json_decode($resp, true);
         
//         $req = new Curl();
//         $req->post(api_url.'api/email/globalmail?appKey='.api_key, array(
//             'name'=>'feras abusharkh',
//             'email'=>'payment@rivatrip.com',
//             'body'=>'Webhoook  =====>   '.$resp.'  payment for ---   '.$paymentid,
//             'subject'=>'Tabby Payment Webhook',
//             'cc_mail'=>'info@rivatrip.com'
//         ));
        


//////////////End Feras Webhook ///////////////////


////////////// start webhooks tabby api /////////////////////////


//         $url = "https://api.tabby.ai/api/v1/webhooks";
//         $curl = curl_init($url);
//         curl_setopt($curl, CURLOPT_URL, $url);
//         curl_setopt($curl, CURLOPT_POST, true);
//         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//         $header = array(
//             "Content-type: application/json",
//             "X-Merchant-Code: RVT",
//             "Authorization: Bearer sk_test_c29ebc06-d133-4956-8c9a-229738c67713"
//         );
//         curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

//         $webhook = <<<html
//                 {
//                  "url": "https://rivatrip.com/payment/webhooks",
//                 "is_test": true,
//                  "header": {
//                 "title": "string",
//                 "value": "string"
//                 }
//         }
// html;

        
//         curl_setopt($curl, CURLOPT_POSTFIELDS, $webhook);
//         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//         $resp = curl_exec($curl);
//         $webhooks = json_decode($resp, true);
        
         
//         $req = new Curl();
//         $req->post(api_url.'api/email/globalmail?appKey='.api_key, array(
//             'name'=>'feras abusharkh',
//             'email'=>'payment@rivatrip.com',
//             'body'=>'Webhoook  =====>   '.$resp,
//             'subject'=>'Tabby Payment Webhook',
//             'cc_mail'=>'info@rivatrip.com'
//         ));
        
//////////////////////// End Ihsan webhooks ///////////////////////        
        
        // dd($webhooks);die;
        // webhooks end
        


        // capture payment tabby api
        $today = date('d/m/Y');
        $url = "https://api.tabby.ai/api/v1/payments/".$data['id']."/captures";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $header = array(
            "Content-type: application/json",
            "Authorization: Bearer sk_test_c29ebc06-d133-4956-8c9a-229738c67713"
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $data = <<<html
        {
        "amount": "$amount",
        "tax_amount": "0.00",
        "shipping_amount": "0.00",
        "discount_amount": "0.00",
        "created_at": "$today",
        "items": [
        {
        "title": "$title_item",
        "description": "string",
        "quantity": 1,
        "unit_price": "$amount",
        "discount_amount": "0.00",
        "reference_id": "$orderId",
        "image_url": "string",
        "product_url": "string",
        "gender": "Male",
        "category": "tour",
        "color": "string",
        "product_material": "string",
        "size_type": "string",
        "size": "string",
        "brand": "string"
        }
        ]
        }
html;
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        $captured = json_decode($resp, true);
        // end captured
        
if (!empty($captured['id']) && $captured['status'] = 'CLOSED') {
    


        function user_id()
        { if (isset($_SESSION['user_login']) == true) {
            return $_SESSION['user_id'];} else { return "0";}
        } $user_id = user_id();
        
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
            
            
           //  dd($payload); die;  //// Feras Abusharkh
            
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
            'transaction_id' => $captured['id'],
            'transaction_status' => $captured['status'],
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
            
           // dd($req->response); die;
            
            //
            if ($req->response == true) {
            $invoice_url =  root . 'hotels/booking/invoice/' . $req->response->sessid . '/' . $req->response->id;
                header('Location: ' .$invoice_url);
                  
            } else { echo "Booking Error Please Try Again."; }
        // end data save in db
        } else if($booking_data->booking_type == 'tours') {

//dd($payload); die;

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
            'transaction_id' => $captured['id'],
            'transaction_status' => $captured['status'],
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
            'guest' => $booking_data->guest,
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
            'firstname' => $booking_data->firstname,
            'lastname' => $booking_data->lastname,
            'email' => $booking_data->email,
            'address' => $booking_data->address,
            'phone' => $booking_data->phone,
            'adults' => $payload->adult_travellers,
            'childs' => $payload->child_travellers,
            'infants' => $payload->infant_travellers,
            'travellers' => $payload->travellers,
            'payment_gateway' => $booking_data->payment_gateway,
            'country_code' => $booking_data->country_code,
            'nationality' => $booking_data->nationality,
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
            
            
            //dd($_POST['payload']); die;
            
            //dd('success payment'); die;
            
            // for flight booking

           // $_GET['payment_id']
            
            //dd($_POST[]); die;
            
             //$payload = (array) json_decode(base64_decode($_POST['payload']));
            // $traveller = json_decode(base64_decode($_POST['traveller']));
            // $prices = json_decode(base64_decode($_POST['prices']));

            $route = (array)$payload;
            $routes = json_encode($route);
            $traveller = json_decode(base64_decode($booking_data->flight_traveller));
            $prices = json_decode(base64_decode($booking_data->flight_prices));
            $travellers = $traveller->adults + $traveller->childs + $traveller->infants;
          
            
            //dd($route); die;
            
           
            // save in db
            $flight_no = ($route[0][0]->departure_flight_no)? $route[0][0]->departure_flight_no: 123;
            
            //dd($flight_no); die;
            
            
          //  $priceTotale = round(($prices->total*.95),2);
          
            $orginalprice = ($prices->oneway_adult_price+$prices->oneway_child_price+$prices->oneway_infant_price);
            $TaxPrice = round(($orginalprice*0.05),2);

            $req = new Curl();
            $req->post(api_url.'api/flight/book?appKey='.api_key, array(
            'flight_id'=>$flight_no,
            'total_price'=>$prices->total,
            'adults'=>$traveller->adults,
            'childs'=>$traveller->childs,
            'infants'=>$traveller->infants,
            'deposit'=>'100',
            'tax'=>$TaxPrice,
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
            'supplier_name' => $prices->supplier,
            'nationality' => $booking_data->nationality,
            'booking_from' => 'web',
            'flight_type' => $prices->flight_type,
            "invoice_url" => root . 'flights/booking/invoice/',
            //'session_id' =>  $prices->session_id,
            //'session_id' =>  $prices->session_id,
            ));
            
            dd($req->response); die;

            if ($req->response == true) {
                 $invoice_url =  root . 'flights/booking/invoice/' . $req->response->sessid . '/' . $req->response->id;
                 header('Location: ' . root . 'flights/booking/invoice/' . $req->response->sessid . '/' . $req->response->id);
            } else { echo "Booking Error Please Try Again."; }
            // generate logs
            logs($SearchType = "Flights Book ");
            // end for flight booking
        }
        
} else {
    dd('Not Authorized, Something went wrong'); die;
}
        
        
     //////////////////////// Register Webhooks ///////////////////////////////////////
     
//         $url = "https://api.tabby.ai/api/v1/webhooks";
//         $curl = curl_init($url);
//         curl_setopt($curl, CURLOPT_URL, $url);
//         curl_setopt($curl, CURLOPT_POST, true);
//         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//         $header = array(
//             "Content-type: application/json",
//             "X-Merchant-Code: RVT",
//             "Authorization: Bearer sk_test_c29ebc06-d133-4956-8c9a-229738c67713"
//         );
//         curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

//         $webhook = <<<html
//                 {
//                  "url": "https://rivatrip.com/payment/webhooks",
//                  "is_test": true,
//                  "header": {
//                  "title": "string",
//                  "value": "string"
//                  }
//              }
// html;

//         curl_setopt($curl, CURLOPT_POSTFIELDS, $webhook);
//         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//         $resp = curl_exec($curl);
//         $webhooks = json_decode($resp, true);


        // $req = new Curl();
        // $req->post(api_url.'api/email/globalmail?appKey='.api_key, array(
        //     'name'=>$booking_data->firstname.' '.$booking_data->lastname,
        //     'email'=>'payment@rivatrip.com',
        //     'body'=>'Webhoook  =====>   '.$resp.'  payment for ---   '.$paymentid,
        //     'subject'=>'Tabby Payment Webhook Registration',
        // ));
     
  
    ///////////////////////// End Register //////////////////////////////////////
        
        
        
     } 
     

});

/////////////////////////////////////////////////////////////////////////////////////////////////

//failure or cancel tabby request
$router->get('payment/booking', function() {

// dd('Not Authorized'); die;

    $paymentid = $_GET['payment_id'];
    // dd($paymentid);die;
     $url = "https://api.tabby.ai/api/v2/payments/".$paymentid;
        //
     $curl = curl_init($url);
     curl_setopt($curl, CURLOPT_URL, $url);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     $header = array(
            "Accept: application/json",
            "Authorization: Bearer sk_test_c29ebc06-d133-4956-8c9a-229738c67713"
        );
     curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
     $resp = curl_exec($curl);
     curl_close($curl);
     $data = json_decode($resp, true);
     
        $booking_data = json_decode(base64_decode($data['order']['items'][0]['brand']));
        $all_data = json_decode(base64_decode($data['order']['items'][0]['size']));
        $booking_type = $all_data->booking_type;
        // dd($booking_data->adult_travellers);die;
        if($booking_type == 'tours'){
            // seo and meta tags

            $tour = $booking_data;
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
            $req = new Curl();
            $req->post(api_url . 'api/login/get_profile?appKey=' . api_key, array('id' => $_SESSION['user_id'], ));
            $profile = json_decode($req->response);
            $profile_data = $profile->response;
            } else {}
             
            $_POST['date'] = $tour->tour_date;
            $_POST['adults'] = $tour->adult_travellers;
            $_POST['childs'] = $tour->child_travellers;
            $_POST['infants'] = $tour->infant_travellers;
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
        
            // generate logs
            logs($SearchType = $booking_type." Booking");
            // payload from listting page encrypted with base64
            $_SESSION['flash'] = 'Something went wrong, your transaction has been failed.';
            $body = views."modules/".$booking_type."/booking.php";
            include layout;
  
});


//////////////////////////////////////////////////////////////////////////////////////////

$router->get('payment/webhooks', function() {


// $response = $_POST;


//     $req = new Curl();
//         $req->post(api_url.'api/email/globalmail?appKey='.api_key, array(
//             'name'=>'ferasdddd',
//             'email'=>'payment@rivatrip.com',
//             'body'=>'Webhoook  =====>   '.$response,
//             'subject'=>'Tabby Payment Webhook Registration',
//         ));
        
//      echo '200'; 


    $url = "https://api.tabby.ai/api/v1/webhooks";
    $curl = curl_init($url);
    
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

    $header = array(
        "Content-type: application/json",
        "X-Merchant-Code: RVT",
        "Authorization: Bearer sk_79113d51-8d96-4db5-a2aa-46ea0ef23080",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        
     $webhook = <<<html
      {
            "id":  "string",
            "url": "http://dev.rivatrip.com/payment/webhooks",
            "is_test": true,
            "header": 
            {
                "title": "string",
                "value": "string"
            }

        }
html;

    curl_setopt($curl,CURLOPT_RETURNTRANSFER,$webhook);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $resp = curl_exec($curl);
    
    echo $resp; 

});


?>