<?php

namespace Anax\Models;

class WheatherApi extends GeoApi
{
    /**
     * model class for a 7 day wheather forecast for a position
     * using the wheather api 'openweather'
     *
     */

    public function __construct()
    {
        $this->forecast = [];
    }

    public function checkArgument($search)
    {
        if (strpos($search, ",") == true) {
            $split = explode(",", $search);
            return $this->comingWheather($split[0], $split[1]);
        } else {
            // if ip-address: find coordinates in GeoApi model
            $res = $this->findGeoLocation($search);
            if ($res["longitude"] !== "-") {
                return $this->comingWheather($res["latitude"], $res["longitude"]);
            } else {
                return "Felaktig söksträng, försök igen.";
            }
        }
    }

    public function comingWheather($latitude, $longitude)
    {
        global $di;

        if ($latitude < 90 && $latitude > -90 && $longitude < 180 && $longitude > -180) {
            // get the api key
            $config = $di->get("configuration")->load("api_keys.php");
            $apiKey = $config["config"]["openWheather"]["apiKey"];
            $exclude = "current,minutely,hourly,alerts";

            // make curl api call with location and api key
            $ch1 = curl_init('https://api.openweathermap.org/data/2.5/onecall?lat='.$latitude.'&lon='.$longitude.'&exclude='.$exclude.'&units=metric&lang=sv&appid='.$apiKey.'');
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

            $json = curl_exec($ch1);
            curl_close($ch1);

            $result = json_decode($json, true);

            $sevenDays = $result["daily"];

            foreach ($sevenDays as $value) {
                $current = [
                    "date" => gmdate("Y-m-d", $value["dt"]),
                    "temp" => $value["temp"]["min"] . " - " . $value["temp"]["max"],
                    "description" => $value["weather"][0]["description"]
                ];
                $this->forecast[] = $current;
            }
        } else {
            $this->forecast = "Ogiltiga koordinater, försök igen.";
        }
        return $this->forecast;
    }
}
