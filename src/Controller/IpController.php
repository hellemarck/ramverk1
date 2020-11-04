<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Anax\Controller\IpValidator;


class IpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "Validera IP-adress";

        $page->add("ip/index");
        return $page->render([
            "title" => $title,
        ]);
    }

    public function validateIpAction()
    {
        $page = $this->di->get("page");
        $ipAdress = $_GET["ipAdress"];

        if (filter_var($ipAdress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $res = "$ipAdress är en giltig IP4-adress.";
            $domain = "Domänen är: " . gethostbyaddr($ipAdress);
        } elseif (filter_var($ipAdress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $res = "$ipAdress är en giltig IP6-adress.";
            $domain = "Domänen är: " . gethostbyaddr($ipAdress);
        } else {
            $res = "Ip-adressen $ipAdress är inte giltig";
        }

        $data = [
            "res" => $res,
            "domain" => $domain ?? null
        ];

        $title = "Resultat";
        $page->add("ip/result", $data);
        return $page->render([
            "title" => $title,
        ]);
    }
}
