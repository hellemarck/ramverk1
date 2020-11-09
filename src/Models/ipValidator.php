<?php

namespace Anax\Models;


class ipValidator
{
    /**
     * model class for ip validation
     * used by IpController and IpToJSONController
     */
    public function validateIp($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $res = "$ip är en giltig IP4-adress.";
            $domain = "Domänen är: " . gethostbyaddr($ip);
        } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $res = "$ip är en giltig IP6-adress.";
            $domain = "Domänen är: " . gethostbyaddr($ip);
        } else {
            $res = "Ip-adressen $ip är inte giltig";
        }

        // returning the result to controller to send to view
        $data = [
            "res" => $res,
            "domain" => $domain ?? null
        ];

        return $data;
    }
}
