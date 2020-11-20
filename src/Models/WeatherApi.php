<?php

namespace Anax\Models;

class WeatherApi extends GeoApi
{
    /**
     * model class for a 7 day weather forecast for a position
     * using the weather api 'openweather'
     *
     */

    public function __construct()
    {
        $this->forecast = [];
        $this->coordinates = [];
        $this->location = [];
    }

    public function checkArgument($search)
    {
        if (strpos($search, ",") == true) {
            $split = explode(",", $search);
            $this->coordinates = [$split[0], $split[1]];
            return $this->comingWeather($split[0], $split[1]);
        } else {
            // if ip-address: find coordinates in GeoApi model
            $res = $this->findGeoLocation($search);
            if ($res["longitude"] !== "-") {
                $this->coordinates = [$res["latitude"], $res["longitude"]];
                return $this->comingWeather($res["latitude"], $res["longitude"]);
            } else {
                return "Felaktig söksträng, försök igen.";
            }
        }
    }

    public function getLocation()
    {
        if (!empty($this->coordinates)) {
            $ch2 = curl_init('https://nominatim.openstreetmap.org/reverse?format=geocodejson&lat='.$this->coordinates[0].'&lon='.$this->coordinates[1].'');

            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch2, CURLOPT_REFERER, $_SERVER["HTTP_REFERER"]);

            $json = curl_exec($ch2);
            curl_close($ch2);

            $result = json_decode($json, true);

            $this->location = [
                    $result["features"][0]["properties"]["geocoding"]["city"] ?? "odefinierad",
                    $result["features"][0]["properties"]["geocoding"]["country"] ?? " odefinierad"
                ];

            return $this->location;
        }
    }

    public function comingWeather($latitude, $longitude)
    {
        global $di;

        if ($latitude < 90 && $latitude > -90 && $longitude < 180 && $longitude > -180) {
            // get the api key
            $config = $di->get("configuration")->load("api_keys.php");
            $apiKey = $config["config"]["openWeather"]["apiKey"];
            $exclude = "current,minutely,hourly,alerts";

            // make curl api call with location and api key
            $ch1 = curl_init('https://api.openweathermap.org/data/2.5/onecall?lat='.$latitude.'&lon='.$longitude.'&cnt={}&exclude='.$exclude.'&units=metric&lang=sv&appid='.$apiKey.'');
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
            $this->coordinates = [];
        }
        return $this->forecast;
    }

    public function getCoordinates()
    {
        return $this->coordinates;
    }
}
