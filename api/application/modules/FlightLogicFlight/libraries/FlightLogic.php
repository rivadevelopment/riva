<?php
class FlightLogic {
    public function __construct() {
        // Constructor logic
    }

    public function search_flight($data) {
        
        ini_set('max_execution_time', 0);
        $url = "https://travelnext.works/api/aeroVE5/availability";
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT,500);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

        $result = curl_exec($curl);
        curl_close($curl);
        
        return $result;

        // $json = '{
//     "AirSearchResponse": {
//         "session_id": "MTY4NjA3OTczM18zOTQxNjA=",
//         "AirSearchResult": {
//             "FareItineraries": [{
//                 "FareItinerary": {
//                     "DirectionInd": "Return",
//                     "AirItineraryFareInfo": {
//                         "DivideInPartyIndicator": "false",
//                         "FareSourceCode": "aUpXemlMZ29YbTBNeldxNDhrUjNVak16M3hpbkwyaWhyL1o5RHdKOWZzdVdxKzlSd0VpZ0pYdzdOWFVSblBuRVkwVUFkSkhpQzBQMDNhTnJlQ3hJTExLSngyejc5MFIyMlR4emZvakxaNGYyZXRIcloyRlhNdjduOEI5NWYwQk9QMGpLeXllMXRYSnF6SHpva3p5dktRPT0=",
//                         "FareInfos": [],
//                         "FareType": "Public",
//                         "ResultIndex": "",
//                         "IsRefundable": "Yes",
//                         "ItinTotalFares": {
//                             "BaseFare": {
//                                 "Amount": "117.34",
//                                 "CurrencyCode": "USD",
//                                 "DecimalPlaces": "2"
//                             },
//                             "EquivFare": {
//                                 "Amount": "117.34",
//                                 "CurrencyCode": "USD",
//                                 "DecimalPlaces": "2"
//                             },
//                             "ServiceTax": {
//                                 "Amount": "0.00",
//                                 "CurrencyCode": "USD",
//                                 "DecimalPlaces": "2"
//                             },
//                             "TotalTax": {
//                                 "Amount": "122.02",
//                                 "CurrencyCode": "USD",
//                                 "DecimalPlaces": "2"
//                             },
//                             "TotalFare": {
//                                 "Amount": "239.36",
//                                 "CurrencyCode": "USD",
//                                 "DecimalPlaces": "2"
//                             }
//                         },
//                         "FareBreakdown": [{
//                             "FareBasisCode": "",
//                             "Baggage": ["1PC", "1PC", "1PC", "1PC"],
//                             "CabinBaggage": ["7KG", "7KG", "7KG", "7KG"],
//                             "PassengerFare": {
//                                 "BaseFare": {
//                                     "Amount": "117.34",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 },
//                                 "EquivFare": {
//                                     "Amount": "117.34",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 },
//                                 "ServiceTax": {
//                                     "Amount": "0.00",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 },
//                                 "Surcharges": {
//                                     "Amount": "0.00",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 },
//                                 "Taxes": [{
//                                     "TaxCode": "AE4",
//                                     "Amount": "20.43",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "F62",
//                                     "Amount": "9.54",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "TP",
//                                     "Amount": "1.37",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "ZR2",
//                                     "Amount": "1.37",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "RG3",
//                                     "Amount": "17.51",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "SP",
//                                     "Amount": "7.00",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "YD",
//                                     "Amount": "9.80",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "E3",
//                                     "Amount": "2.13",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "E32",
//                                     "Amount": "2.13",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "E32",
//                                     "Amount": "2.13",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "IO",
//                                     "Amount": "14.69",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "E3",
//                                     "Amount": "2.13",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "IO",
//                                     "Amount": "14.69",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "ZR",
//                                     "Amount": "1.37",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "YRF",
//                                     "Amount": "6.81",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "YRF",
//                                     "Amount": "6.81",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "GST",
//                                     "Amount": "2.11",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }],
//                                 "TotalFare": {
//                                     "Amount": "239.36",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }
//                             },
//                             "PassengerTypeQuantity": {
//                                 "Code": "ADT",
//                                 "Quantity": 1
//                             },
//                             "PenaltyDetails": {
//                                 "Currency": "USD",
//                                 "RefundAllowed": true,
//                                 "RefundPenaltyAmount": "93.42",
//                                 "ChangeAllowed": true,
//                                 "ChangePenaltyAmount": "66.76"
//                             }
//                         }],
//                         "SplitItinerary": false
//                     },
//                     "OriginDestinationOptions": [{
//                         "OriginDestinationOption": [{
//                             "FlightSegment": {
//                                 "ArrivalAirportLocationCode": "JED",
//                                 "ArrivalDateTime": "2023-06-09T16:35:00",
//                                 "CabinClassCode": "Y",
//                                 "CabinClassText": "",
//                                 "DepartureAirportLocationCode": "DXB",
//                                 "DepartureDateTime": "2023-06-09T14:25:00",
//                                 "Eticket": true,
//                                 "JourneyDuration": "190",
//                                 "FlightNumber": "569",
//                                 "MarketingAirlineCode": "SV",
//                                 "MarketingAirlineName": "Saudi Arabian Airlines",
//                                 "MarriageGroup": "",
//                                 "MealCode": "",
//                                 "OperatingAirline": {
//                                     "Code": "SV",
//                                     "Name": "Saudi Arabian Airlines",
//                                     "Equipment": "320",
//                                     "FlightNumber": "569"
//                                 }
//                             },
//                             "ResBookDesigCode": "",
//                             "ResBookDesigText": "",
//                             "SeatsRemaining": {
//                                 "BelowMinimum": false,
//                                 "Number": 4
//                             },
//                             "StopQuantity": 0,
//                             "StopQuantityInfo": {
//                                 "ArrivalDateTime": "",
//                                 "DepartureDateTime": "",
//                                 "Duration": "",
//                                 "LocationCode": ""
//                             }
//                         }, {
//                             "FlightSegment": {
//                                 "ArrivalAirportLocationCode": "LHE",
//                                 "ArrivalDateTime": "2023-06-10T10:00:00",
//                                 "CabinClassCode": "Y",
//                                 "CabinClassText": "",
//                                 "DepartureAirportLocationCode": "JED",
//                                 "DepartureDateTime": "2023-06-10T02:55:00",
//                                 "Eticket": true,
//                                 "JourneyDuration": "305",
//                                 "FlightNumber": "734",
//                                 "MarketingAirlineCode": "SV",
//                                 "MarketingAirlineName": "Saudi Arabian Airlines",
//                                 "MarriageGroup": "",
//                                 "MealCode": "",
//                                 "OperatingAirline": {
//                                     "Code": "SV",
//                                     "Name": "Saudi Arabian Airlines",
//                                     "Equipment": "777",
//                                     "FlightNumber": "734"
//                                 }
//                             },
//                             "ResBookDesigCode": "",
//                             "ResBookDesigText": "",
//                             "SeatsRemaining": {
//                                 "BelowMinimum": false,
//                                 "Number": 4
//                             },
//                             "StopQuantity": 0,
//                             "StopQuantityInfo": {
//                                 "ArrivalDateTime": "",
//                                 "DepartureDateTime": "",
//                                 "Duration": "",
//                                 "LocationCode": ""
//                             }
//                         }],
//                         "TotalStops": 1
//                     }, {
//                         "OriginDestinationOption": [{
//                             "FlightSegment": {
//                                 "ArrivalAirportLocationCode": "RUH",
//                                 "ArrivalDateTime": "2023-06-11T23:20:00",
//                                 "CabinClassCode": "Y",
//                                 "CabinClassText": "",
//                                 "DepartureAirportLocationCode": "LHE",
//                                 "DepartureDateTime": "2023-06-11T20:50:00",
//                                 "Eticket": true,
//                                 "JourneyDuration": "270",
//                                 "FlightNumber": "737",
//                                 "MarketingAirlineCode": "SV",
//                                 "MarketingAirlineName": "Saudi Arabian Airlines",
//                                 "MarriageGroup": "",
//                                 "MealCode": "",
//                                 "OperatingAirline": {
//                                     "Code": "SV",
//                                     "Name": "Saudi Arabian Airlines",
//                                     "Equipment": "777",
//                                     "FlightNumber": "737"
//                                 }
//                             },
//                             "ResBookDesigCode": "",
//                             "ResBookDesigText": "",
//                             "SeatsRemaining": {
//                                 "BelowMinimum": false,
//                                 "Number": 4
//                             },
//                             "StopQuantity": 0,
//                             "StopQuantityInfo": {
//                                 "ArrivalDateTime": "",
//                                 "DepartureDateTime": "",
//                                 "Duration": "",
//                                 "LocationCode": ""
//                             }
//                         }, {
//                             "FlightSegment": {
//                                 "ArrivalAirportLocationCode": "DXB",
//                                 "ArrivalDateTime": "2023-06-12T12:00:00",
//                                 "CabinClassCode": "Y",
//                                 "CabinClassText": "",
//                                 "DepartureAirportLocationCode": "RUH",
//                                 "DepartureDateTime": "2023-06-12T09:00:00",
//                                 "Eticket": true,
//                                 "JourneyDuration": "120",
//                                 "FlightNumber": "596",
//                                 "MarketingAirlineCode": "SV",
//                                 "MarketingAirlineName": "Saudi Arabian Airlines",
//                                 "MarriageGroup": "",
//                                 "MealCode": "",
//                                 "OperatingAirline": {
//                                     "Code": "SV",
//                                     "Name": "Saudi Arabian Airlines",
//                                     "Equipment": "320",
//                                     "FlightNumber": "596"
//                                 }
//                             },
//                             "ResBookDesigCode": "",
//                             "ResBookDesigText": "",
//                             "SeatsRemaining": {
//                                 "BelowMinimum": false,
//                                 "Number": 4
//                             },
//                             "StopQuantity": 0,
//                             "StopQuantityInfo": {
//                                 "ArrivalDateTime": "",
//                                 "DepartureDateTime": "",
//                                 "Duration": "",
//                                 "LocationCode": ""
//                             }
//                         }],
//                         "TotalStops": 1
//                     }],
//                     "IsPassportMandatory": null,
//                     "SequenceNumber": "",
//                     "TicketType": "eTicket",
//                     "ValidatingAirlineCode": "SV"
//                 }
//             }, {"FareItinerary": {
//                     "DirectionInd": "Return",
//                     "AirItineraryFareInfo": {
//                         "DivideInPartyIndicator": "false",
//                         "FareSourceCode": "aUpXemlMZ29YbTBNeldxNDhrUjNVak16M3hpbkwyaWhyL1o5RHdKOWZzdVdxKzlSd0VpZ0pYdzdOWFVSblBuRVkwVUFkSkhpQzBQMDNhTnJlQ3hJTExLSngyejc5MFIyMlR4emZvakxaNGYyZXRIcloyRlhNdjduOEI5NWYwQk9QMGpLeXllMXRYSnF6SHpva3p5dktRPT0=",
//                         "FareInfos": [],
//                         "FareType": "Public",
//                         "ResultIndex": "",
//                         "IsRefundable": "Yes",
//                         "ItinTotalFares": {
//                             "BaseFare": {
//                                 "Amount": "117.34",
//                                 "CurrencyCode": "USD",
//                                 "DecimalPlaces": "2"
//                             },
//                             "EquivFare": {
//                                 "Amount": "117.34",
//                                 "CurrencyCode": "USD",
//                                 "DecimalPlaces": "2"
//                             },
//                             "ServiceTax": {
//                                 "Amount": "0.00",
//                                 "CurrencyCode": "USD",
//                                 "DecimalPlaces": "2"
//                             },
//                             "TotalTax": {
//                                 "Amount": "122.02",
//                                 "CurrencyCode": "USD",
//                                 "DecimalPlaces": "2"
//                             },
//                             "TotalFare": {
//                                 "Amount": "239.36",
//                                 "CurrencyCode": "USD",
//                                 "DecimalPlaces": "2"
//                             }
//                         },
//                         "FareBreakdown": [{
//                             "FareBasisCode": "",
//                             "Baggage": ["1PC", "1PC", "1PC", "1PC"],
//                             "CabinBaggage": ["7KG", "7KG", "7KG", "7KG"],
//                             "PassengerFare": {
//                                 "BaseFare": {
//                                     "Amount": "117.34",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 },
//                                 "EquivFare": {
//                                     "Amount": "117.34",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 },
//                                 "ServiceTax": {
//                                     "Amount": "0.00",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 },
//                                 "Surcharges": {
//                                     "Amount": "0.00",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 },
//                                 "Taxes": [{
//                                     "TaxCode": "AE4",
//                                     "Amount": "20.43",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "F62",
//                                     "Amount": "9.54",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "TP",
//                                     "Amount": "1.37",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "ZR2",
//                                     "Amount": "1.37",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "RG3",
//                                     "Amount": "17.51",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "SP",
//                                     "Amount": "7.00",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "YD",
//                                     "Amount": "9.80",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "E3",
//                                     "Amount": "2.13",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "E32",
//                                     "Amount": "2.13",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "E32",
//                                     "Amount": "2.13",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "IO",
//                                     "Amount": "14.69",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "E3",
//                                     "Amount": "2.13",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "IO",
//                                     "Amount": "14.69",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "ZR",
//                                     "Amount": "1.37",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "YRF",
//                                     "Amount": "6.81",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "YRF",
//                                     "Amount": "6.81",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }, {
//                                     "TaxCode": "GST",
//                                     "Amount": "2.11",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }],
//                                 "TotalFare": {
//                                     "Amount": "239.36",
//                                     "CurrencyCode": "USD",
//                                     "DecimalPlaces": "2"
//                                 }
//                             },
//                             "PassengerTypeQuantity": {
//                                 "Code": "ADT",
//                                 "Quantity": 1
//                             },
//                             "PenaltyDetails": {
//                                 "Currency": "USD",
//                                 "RefundAllowed": true,
//                                 "RefundPenaltyAmount": "93.42",
//                                 "ChangeAllowed": true,
//                                 "ChangePenaltyAmount": "66.76"
//                             }
//                         }],
//                         "SplitItinerary": false
//                     },
//                     "OriginDestinationOptions": [{
//                         "OriginDestinationOption": [{
//                             "FlightSegment": {
//                                 "ArrivalAirportLocationCode": "JED",
//                                 "ArrivalDateTime": "2023-06-09T16:35:00",
//                                 "CabinClassCode": "Y",
//                                 "CabinClassText": "",
//                                 "DepartureAirportLocationCode": "DXB",
//                                 "DepartureDateTime": "2023-06-09T14:25:00",
//                                 "Eticket": true,
//                                 "JourneyDuration": "190",
//                                 "FlightNumber": "569",
//                                 "MarketingAirlineCode": "SV",
//                                 "MarketingAirlineName": "Saudi Arabian Airlines",
//                                 "MarriageGroup": "",
//                                 "MealCode": "",
//                                 "OperatingAirline": {
//                                     "Code": "SV",
//                                     "Name": "Saudi Arabian Airlines",
//                                     "Equipment": "320",
//                                     "FlightNumber": "569"
//                                 }
//                             },
//                             "ResBookDesigCode": "",
//                             "ResBookDesigText": "",
//                             "SeatsRemaining": {
//                                 "BelowMinimum": false,
//                                 "Number": 4
//                             },
//                             "StopQuantity": 0,
//                             "StopQuantityInfo": {
//                                 "ArrivalDateTime": "",
//                                 "DepartureDateTime": "",
//                                 "Duration": "",
//                                 "LocationCode": ""
//                             }
//                         }, {
//                             "FlightSegment": {
//                                 "ArrivalAirportLocationCode": "LHE",
//                                 "ArrivalDateTime": "2023-06-10T10:00:00",
//                                 "CabinClassCode": "Y",
//                                 "CabinClassText": "",
//                                 "DepartureAirportLocationCode": "JED",
//                                 "DepartureDateTime": "2023-06-10T02:55:00",
//                                 "Eticket": true,
//                                 "JourneyDuration": "305",
//                                 "FlightNumber": "734",
//                                 "MarketingAirlineCode": "SV",
//                                 "MarketingAirlineName": "Saudi Arabian Airlines",
//                                 "MarriageGroup": "",
//                                 "MealCode": "",
//                                 "OperatingAirline": {
//                                     "Code": "SV",
//                                     "Name": "Saudi Arabian Airlines",
//                                     "Equipment": "777",
//                                     "FlightNumber": "734"
//                                 }
//                             },
//                             "ResBookDesigCode": "",
//                             "ResBookDesigText": "",
//                             "SeatsRemaining": {
//                                 "BelowMinimum": false,
//                                 "Number": 4
//                             },
//                             "StopQuantity": 0,
//                             "StopQuantityInfo": {
//                                 "ArrivalDateTime": "",
//                                 "DepartureDateTime": "",
//                                 "Duration": "",
//                                 "LocationCode": ""
//                             }
//                         }],
//                         "TotalStops": 1
//                     }, {
//                         "OriginDestinationOption": [{
//                             "FlightSegment": {
//                                 "ArrivalAirportLocationCode": "RUH",
//                                 "ArrivalDateTime": "2023-06-11T23:20:00",
//                                 "CabinClassCode": "Y",
//                                 "CabinClassText": "",
//                                 "DepartureAirportLocationCode": "LHE",
//                                 "DepartureDateTime": "2023-06-11T20:50:00",
//                                 "Eticket": true,
//                                 "JourneyDuration": "270",
//                                 "FlightNumber": "737",
//                                 "MarketingAirlineCode": "SV",
//                                 "MarketingAirlineName": "Saudi Arabian Airlines",
//                                 "MarriageGroup": "",
//                                 "MealCode": "",
//                                 "OperatingAirline": {
//                                     "Code": "SV",
//                                     "Name": "Saudi Arabian Airlines",
//                                     "Equipment": "777",
//                                     "FlightNumber": "737"
//                                 }
//                             },
//                             "ResBookDesigCode": "",
//                             "ResBookDesigText": "",
//                             "SeatsRemaining": {
//                                 "BelowMinimum": false,
//                                 "Number": 4
//                             },
//                             "StopQuantity": 0,
//                             "StopQuantityInfo": {
//                                 "ArrivalDateTime": "",
//                                 "DepartureDateTime": "",
//                                 "Duration": "",
//                                 "LocationCode": ""
//                             }
//                         }, {
//                             "FlightSegment": {
//                                 "ArrivalAirportLocationCode": "DXB",
//                                 "ArrivalDateTime": "2023-06-12T12:00:00",
//                                 "CabinClassCode": "Y",
//                                 "CabinClassText": "",
//                                 "DepartureAirportLocationCode": "RUH",
//                                 "DepartureDateTime": "2023-06-12T09:00:00",
//                                 "Eticket": true,
//                                 "JourneyDuration": "120",
//                                 "FlightNumber": "596",
//                                 "MarketingAirlineCode": "SV",
//                                 "MarketingAirlineName": "Saudi Arabian Airlines",
//                                 "MarriageGroup": "",
//                                 "MealCode": "",
//                                 "OperatingAirline": {
//                                     "Code": "SV",
//                                     "Name": "Saudi Arabian Airlines",
//                                     "Equipment": "320",
//                                     "FlightNumber": "596"
//                                 }
//                             },
//                             "ResBookDesigCode": "",
//                             "ResBookDesigText": "",
//                             "SeatsRemaining": {
//                                 "BelowMinimum": false,
//                                 "Number": 4
//                             },
//                             "StopQuantity": 0,
//                             "StopQuantityInfo": {
//                                 "ArrivalDateTime": "",
//                                 "DepartureDateTime": "",
//                                 "Duration": "",
//                                 "LocationCode": ""
//                             }
//                         }],
//                         "TotalStops": 1
//                     }],
//                     "IsPassportMandatory": null,
//                     "SequenceNumber": "",
//                     "TicketType": "eTicket",
//                     "ValidatingAirlineCode": "SV"
//                 }
//             }]
//         }
//     }
// }';

// return $json;
    }
}
