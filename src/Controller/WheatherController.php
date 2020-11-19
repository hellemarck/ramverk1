<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
// use Anax\Models\IpValidator;
use Anax\Models\GeoApi;
use Anax\Models\CurrentIp;
use Anax\Models\WheatherApi;

/**
 * Controllerclass for wheather forecast
 */
class WheatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * rendering index page for user to type ip address or coordinates
     * with current ip-address as default
     */
    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "Väderprognoser";

        $currIp = new CurrentIp();
        $userIP = $currIp->findIp();

        $page->add("wheather/index", $userIP);
        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * 7 day weather forecast - using the models WheatherAPI and GeoApi
     * takes user input as "search" and sends it to model, returns to view
     */
    public function searchAction()
    {
        $page = $this->di->get("page");
        $search = $_GET["location"];

        $wheatherObj = new WheatherApi();
        $forecast = $wheatherObj->checkArgument($search);

        $data = [
            "forecast" => $forecast ?? null,
            "coordinates" => $wheatherObj->getCoordinates() ?? null
        ];

        $title = "Resultat";
        $page->add("wheather/result", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
