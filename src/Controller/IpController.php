<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\ipValidator;
use Anax\Models\geoApi;


// use Anax\Controller\IpValidator;

/**
 * Controllerclass for IP validation
 */
class IpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * rendering index page for user to type ip address
     */
    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "Validera IP-adress";
        $userIP = [$_SERVER['REMOTE_ADDR']];

        $page->add("ip/index", $userIP);
        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * ip validation function - using the model ipValidator
     * for better testing move page rendering out of function
     */
    public function validateIpAction()
    {
        $page = $this->di->get("page");
        $ipAdress = $_GET["ipAdress"];

        // $validator = new ipValidator();
        // $data = $validator->validateIp($ipAdress);
        //
        // $location = new geoApi();
        // $data2 = $location->findGeoLocation($ipAdress);

        $validator = new ipValidator();
        $location = new geoApi();

        $data = [
            "valid" => $validator->validateIp($ipAdress)["res"],
            "domain" => $validator->validateIp($ipAdress)["domain"] ?? null,
            "location" => $location->findGeoLocation($ipAdress) ?? null
        ];

        // SHOULD WORK??
        // $data = [
        //     "ipValidate" => $validator->validateIp($ipAdress);
        //     "geoLocation" => $location->findGeoLocation($ipAdress);
        // ]

        $title = "Resultat";
        $page->add("ip/result", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
