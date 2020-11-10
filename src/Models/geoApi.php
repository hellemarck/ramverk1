<?php

namespace Anax\Models;


class geoApi extends ipValidator
{
    /**
     * model class for finding coordinates matching the ip adress
     * used by IpController and IpToJSONController
     * using the geolocation api 'ipstack'
     */
    public function findGeoLocation($ip)
    {
        global $di;

        // get the secret api key
        $config = $di->get("configuration")->load("geo_api.php");
        $apiKey = $config["config"]["ipStack"]["apiKey"];

        // make curl api call with ip address and api key
        $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$apiKey.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);

        /**
         * decode the json result
         * for usage in both view and rest-api controller
         */
        $result = json_decode($json, true);

        return $data = [
            "city" => $result['city'] ?? "-",
            "country_name" => $result['country_name'] ?? "-",
            "longitude" => $result['longitude'] ?? "-",
            "latitude" => $result['latitude'] ?? "-"
        ];
    }
}
