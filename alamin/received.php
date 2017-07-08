<?php

header("Content-Type:application/json");
$rawinput=file_get_contents('php://input');
//print_r($rawinput);
$array = json_decode($rawinput,true);
//echo $array['accesInfo']['servciekey'];
$input = json_encode($array,true);
echo $input;

?>