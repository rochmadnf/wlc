<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$url = 'your-device-name';

$headers = [
  'X-M2M-Origin' => 'your-access-key',
  'Content-Type' => 'application/json;ty=4',
  'Accept' => 'application/json'
];

$client = new Client();

$response = $client->get($url, ['headers' => $headers])->getBody()->getContents();
$data = json_decode($response, TRUE);
$data1 = json_decode($data['m2m:cin']['con'], TRUE);
$waterLevel = "";

foreach ($data1 as $d) {
  $waterLevel .= $d . "-";
}
echo $waterLevel;
