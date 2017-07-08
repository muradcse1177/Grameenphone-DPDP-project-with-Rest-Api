<?php
header("Content-Type:application/json");
$rawinput=file_get_contents('php://input')
$input = json_decode($rawinput,true);
//print_r($input);
print_r($input["statusInfo"]["errorInfo"]["errorCode"]);
//save input data to txt file
file_put_contents('dpdp/'.date('Y-m-d-H-i-s').'.'.rand(100000,999999).'.txt', $rawinput);
