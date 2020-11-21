<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\WeatherApi;

// use Anax\Models\IpValidator;
// use Anax\Models\GeoApi;

/**
 * Controllerclass for the JSON-return of weather forecast
 */
class WeatherToJSONController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * based on ip address or coordinates for a location
     * returning the forecast for 7 days
     */
    public function searchAction()
    {
        $search = $_GET["location"];
        $type = $this->di->get("request")->getGet("type");

        $weatherObj = $this->di->get("weatherapi");
        $weather = $weatherObj->checkArgument($search, $type);

        $data = [
            "weather" => $weather ?? null,
            "coordinates" => $weatherObj->getCoordinates() ?? null,
            "location" => $weatherObj->getLocation() ?? null
        ];

        json_encode($data, true);

        return [[ $data ]];
    }
}
