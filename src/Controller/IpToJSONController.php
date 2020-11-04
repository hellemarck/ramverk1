<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;


class IpToJSONController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function validateIpApiAction()
    {
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

        return [[
            "valid" => $res,
            "domain" => $domain ?? null
        ]];
    }
}
