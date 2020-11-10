<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\ipValidator;
use Anax\Models\geoApi;

/**
 * Controllerclass for the JSON-return of IP validation
 */
class IpToJSONController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * validation of ip address and finding location based on ip
     * using the api models ipValidator and geoApi
     */
    public function validateIpApiAction()
    {
        $ipAdress = $_GET["ipAdress"];

        $validator = new ipValidator();
        $location = new geoApi();

        $data = [
            "valid" => $validator->validateIp($ipAdress)["res"],
            "domain" => $validator->validateIp($ipAdress)["domain"] ?? null,
            "location" => $location->findGeoLocation($ipAdress) ?? null
        ];

        json_encode($data, true);

        // rendering the result as formatted json
        return [[ $data ]];
    }
}
