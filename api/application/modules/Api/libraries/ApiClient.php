<?php

class ApiClient
{


    public function __construct()
    {

    }

    /**
     * @param string $req_method
     * @param string $service
     * @param array $payload
     * @return mixed|string
     */
    public function sendRequest($req_method = 'GET', $service = '', $payload = [], $_headers = [], $json='')
    {
        $url = $payload['endpoint'];
        unset($payload['endpoint']);
        
     
//   $apiTimeout = 120;        
//   set_time_limit($apiTimeout);

//try {
        $curl = curl_init();
      //  $timeout = 3;
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
       // curl_setopt($curl, CURLOPT_TIMEOUT, 0);
       // curl_setopt($curl, CURLOPT_TIMEOUT, 900); // Increase the timeout to 2 minutes
        //curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,2); // two second timeout
       // curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    
   
        if ($req_method == 'POST') {
              if(!empty($json))
                {
                    $payload = json_encode($payload);
                } 
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        } else {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            $url = $url."?".http_build_query($payload);
        }
        $headers[] = "cache-control: no-cache";
        if (! empty($headers) ) {
            $headers = array_merge($headers, $_headers);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }

        curl_setopt($curl, CURLOPT_URL, $url); 
      // curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload)); // Todo - need to handle

        $response = curl_exec( $curl );
        $err      = curl_error( $curl );

        curl_close( $curl );
       
        // if ($response === null) {
        //     throw new Exception("Failed to parse JSON response");
        // }

        if ( $err ) {
            $response = $err;
        }
        
        
        
// } catch (Exception $e) {
//     // Handle exceptions that might occur during the API call
//     $response = "An error occurred: " . $e->getMessage();
// } 

        return $response;
    }
}