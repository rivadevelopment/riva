<?php

use Curl\Curl;

// tours search page
$router->get(tours, function() {

    $title = T::tours_search_tours;
    $meta_title = T::tours_search_tours;
    $meta_desc = "";
    $meta_img = "";
    $meta_url = "";
    $meta_author = "";
    $meta = "1";

    $body = views."modules/tours/tours.php";
    include layout;

});

// tours listing page
$router->get($session_langcur.tours.'(.*)', function() {
    $url = explode('/', $_GET['url']);
    $count = count($url);
    if ($count < 8) { echo ""; }

    $language = $url[0];
    $currency = $url[1];
    $city = $url[3];
    $date = $url[4];
    $adults = $url[5];
    $childs = $url[6];

    // seo and meta tags
    $title = "Tours in " .$city;
    $meta_title = "Tours in " .$city;
    $meta_appname = "";
    $meta_desc = "";
    $meta_img = "";
    $meta_url = "";
    $meta_author = "";
    $meta = "1";

    // adding search credentials to session
    $_SESSION['tours_location']=$city;
    $_SESSION['tours_date']=$date;
    $_SESSION['tours_adults']=$adults;
    $_SESSION['tours_childs']=$childs;

    // generate logs
    logs($SearchType = "tours Search");

    // adding search to session
    SEARCH_SESSION($MODULE=T::tours_tours,$CITY=$city);

    $req = new Curl();
     $req->post(api_url . 'api/tour/search?appKey=' . api_key, array(
    'loaction' => $city,
    'start_date' => $date,
    'end_date' => $date,
    // 'c1' => "28fdcf77-82bf-4389-9295-6afdd1828002",
    // 'country' => ""
     ));

    $tours_data = $req->response;
    $nights = 10;

     // dd($tours_data);die();

    $_SESSION['tours_data'] = $tours_data;

    $body = views."modules/tours/listing.php";
    include layout;
});


// tours details page
$router->get($session_langcur.'tour(.*)', function() {
$url = explode('/', $_GET['url']);
$count = count($url);
if ($count < 8) { echo ""; }

$language = $url[0];
$currency = $url[1];
$city = $url[3];
$tour_name = $url[4];
$tour_id = $url[5];
$date = $url[6];
$adults = $url[7];
$childs = $url[8];

$req = new Curl();
// $req->post(root.'tours.json', array(
 $req->post(api_url . 'api/tour/detail?appKey=' . api_key, array(
//$req->post('https://travelapi.co/modules/tours/viator/api/v1/detail', array(
'tour_id' => $tour_id,
'supplier' => "1"
));
if ($req->error) { }
$tour = $req->response;

// dd($tour);die;

    if(empty($tour->tourValidityTo) || $tour->tourValidityTo >= date('Y-m-d H:i').':00'){

        $link = implode(" ",$url);
        // seo and meta tags
        $title = $tour->name;
        $meta_title = $tour->name;
        $meta_appname = "";
        $meta_desc = strip_tags($tour->desc);
        $meta_img = $tour->img[0];
        $meta_url = root.str_replace(' ', '/', $link);
        $meta_author = "RivaTrip";
        $meta = "1";
        logs($SearchType = "tours details");
        $body = views."modules/tours/details.php";
        include layout;

    } else {

        $title = slogan;
        $meta_title = slogan;
        $meta_desc = "";
        $meta_img = "";
        $meta_url = meta_url;
        $meta_author = meta_author;
        $meta = "1";
        $body = views."timeout_tour.php";
        include layout;
    }

                        

});

/// Booking tours

$router->post('tours/booking', function() {
$tour = json_decode(base64_decode($_POST['payload']));

// seo and meta tags
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
// dd($profile_data);
} else {}

 // dd($_POST);
 // dd($tour);
 // exit;

logs($SearchType = "tours booking");

$body = views."modules/tours/booking.php";
include layout;

});

$router->post('tours/book', function() {

    $payload = json_decode(base64_decode($_POST['payload']));
    // dd($payload);die;
    function user_id()
    { if (isset($_SESSION['user_login']) == true) {
    return $_SESSION['user_id'];} else { return "0";}
    } $user_id = user_id();
   
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
      }

      $child = [];
      for ($x = 1; $x <= $child_travellers; $x++) {
         $child[$x] = array(
            'title'=>'mr',
            'first_name'=>$_POST["child_firstname_".$x],
            'last_name'=>$_POST["child_lastname_".$x],
            'age'=>$_POST["child_age_".$x],
            );
      }

      $infant = [];
      for ($z = 1; $z <= $infant_travellers; $z++) {
         $infant[$z] = array(
                    'title'=>$_POST["infant_title_".$z],
                    'first_name'=>$_POST["infant_firstname_".$z],
                    'last_name'=>$_POST["infant_lastname_".$z],
                    'age'=>'',
                    );
      }

    $array_traveller = array_merge($adult,$child,$infant);
    $guest = json_encode($array_traveller);
    
    $date = explode('-',$payload->tour_date);
    $checkout = ($date[0] + $payload->tourDays).'-'.$date[1].'-'.$date[2];

    // final booking post request
    $req = new Curl();
    $req->post(api_url . 'api/tour/book?appKey=' . api_key, array(
    'tour_id' => $payload->tour_id,
    'name' => $payload->name,
    'tour_type' => $payload->tour_type,
    'location' => $payload->location,
    'checkin' => $payload->tour_date,
    'checkout' => $checkout,
    'tourDays' => $payload->tourDays,
    'img' => json_encode($payload->img),
    'desc' => $payload->desc,
    'price' => $payload->price,
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
    'taxValue' => $payload->taxValue,
    'supplier' => $payload->supplier,
    'travellers' => $payload->travellers,
    'firstname' => $_POST['firstname'],
    'lastname' => $_POST['lastname'],
    'email' => $_POST['email'],
    'address' => $_POST['address'],
    'phone' => $_POST['phone'],
    'adults' => $_POST['adults'],
    'childs' => $_POST['childs'],
    'infants' => $_POST['infants'],
    'travellers' => $payload->travellers,
    'payment_gateway' => $_POST['payment_gateway'],
    'country_code' => $_POST['country_code'],
    'nationality' => $_POST['nationality'],
    "invoice_url" => root . 'tours/booking/invoice/', 
    ));
  
     // dd($payload);
     // dd($req->response);die;
   
   if ($req->response == true) {

    $invoice_url =  root . 'tours/booking/invoice/' . $req->response->sessid . '/' . $req->response->id;
    header('Location: ' .$invoice_url);
       //  dd($req->response);die;
    } else {  echo "Booking Error Please Try Again."; }

    logs($SearchType = "Tour Book ");

});


// Hotels booking voucher
/* ---------------------------------------------- */
$router->get('tours/booking/invoice/(.*)', function () {
    $url = explode('/', $_GET['url']);

    $req = new Curl();
    $req->get(api_url.'api/tours/booking?appKey='.api_key.'&invoice_id='.$url[3].'&booking_id='.$url[4] );
    // dd($req->response);die;
    $data = json_decode($req->response);
    $booking = $data->response;
    
 
    $title = "Tour Invoice";
    $meta_title = "Tour Invoice";
    $meta_appname = "";
    $meta_desc = "";
    $meta_img = "";
    $meta_url = "";
    $meta_author = "";
    $meta = "1";

    // $json = json_encode($booking);
    // $bytes = file_put_contents("invoice.json", $json);

    $invoice = views . "modules/tours/invoice.php";
    $body = invoice_layout;
    include layout;
});

$router->post('tours/booking/invoice/(.*)', function () {
    
    //tours/invoice/update
    $url = explode('/', $_GET['url']);
    $req = new Curl();
    $req->get(api_url.'api/tours/booking?appKey='.api_key.'&invoice_id='.$url[3].'&booking_id='.$url[4]);

    $data = json_decode($req->response);
    $booking = $data->response;
    // dd($booking);
    // exit();
    
    if($booking && $booking->booking_payment_gateway == 'payment-with-credit-card') {
        if($_POST['response_message'] == 'Success') {
            $req->post(api_url.'api/tours/invoice?appKey='.api_key, array(
            'booking_id' => $url[4],
            'ref_id' => $url[3],
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'payment_gateway' => $booking->booking_payment_gateway,
            'amount_paid' => $booking->total_price,
            'remaining_amount' => "",
            'payment_date' => date("Y-m-d"), //.date(" h:i:s a")
            'txn_id' => $_POST['fort_id'],
            'token' => $_POST['signature'],
            'logs' => '',
            'desc' => $_POST['order_description'],
            ));

            dd($req->response);
            exit();
            dd(json_decode($req->response));
            exit();
            if (json_decode($req->response) == true) {
               header('Location:'.root.'tours/booking/invoice/'.$_POST['merchant_extra1']);
            } else {
               echo "Booking Error Please Try Again."; 
            }
            logs($SearchType = "Tour booking paid " );
    
        } else {
            dd('ISSUE IS HERE');
            exit();
        }
        
    } else {
        $invoice_url =  root . 'tours/booking/invoice/'.$url[3].'/'.$url[4];
        header('Location: ' .$invoice_url);
    }  
});



/* ---------------------------------------------- */
// tours cancellation request
/* ---------------------------------------------- */
$router->post('tours/cancellation', function () {

    // final booking post request
    $req = new Curl();
    $req->post(api_url.'api/tour/cancellation?appKey='.api_key, array(
    'booking_no' => $_POST['booking_no'],
    'booking_id' => $_POST['booking_id'],
    'supplier' => $_POST['supplier'],
    'cancellation_request' => 1
    ));

    // dd($_POST);die;
    if ($req->response == true) {
        header('Location: ' . root . 'tours/booking/invoice/' . $_POST['booking_no'] . '/' . $_POST['booking_id']);
    } else { echo "Booking Error Please Try Again."; }

    // $booking = json_decode($req->response);

    // generate logs
    logs($SearchType = "Tour Cancel Request ID".$_POST['booking_id'] );

});


