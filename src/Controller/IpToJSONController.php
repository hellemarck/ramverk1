<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\ipValidator;

/**
 * Controllerclass for the JSON-return of IP validation
 */
class IpToJSONController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * validation of ip address, returning json response
     * using the model class ipValidator
     */
    public function validateIpApiAction()
    {
        $ipAdress = $_GET["ipAdress"];

        $validator = new ipValidator();
        $data = $validator->validateIp($ipAdress);

        // rendering the result as json
        return [[
            "valid" => $data["res"],
            "domain" => $data["domain"] ?? null
        ]];
    }
}
