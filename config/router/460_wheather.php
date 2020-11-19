<?php
/**
 * route to validate ip
 */
 return [
     "routes" => [
         [
             "info" => "Wheather.",
             "mount" => "wheather",
             "handler" => "\Anax\Controller\WheatherController",
         ],
         [
             "info" => "Wheather JSON format.",
             "mount" => "wheatherApi",
             "handler" => "\Anax\Controller\WheatherRestApiController",
         ],
     ]
 ];
