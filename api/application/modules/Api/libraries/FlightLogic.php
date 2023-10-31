<?php
class FlightLogic
{
    public function __construct()
    {
        
    }

    
    public function search_flight($data)
    {   
        
        $url = "https://travelnext.works/api/aeroVE5/availability";
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

        $result = curl_exec($curl);
        curl_close($curl);
        
        return $result;    
        
    }
}