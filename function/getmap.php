<?php

$country = $_GET['country'];
$address = $_GET['address'];

$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$country";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);
$response_a = json_decode($response);
print_r($response_a);
$lat = $response_a->results[0]->geometry->location->lat;
$long = $response_a->results[0]->geometry->location->lng;

$result = array($lat, $long);
echo json_encode($result);
//AIzaSyCpEZXPEa5iUQfEY-EYuiuyBzIvDhdDovU
?>