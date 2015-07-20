<?php

require_once '../vendor/autoload.php';

use \HealthGraph\Authorization;
use \HealthGraph\Client;

require_once "../src/HealthGraph/HealthGraphClient.php";

session_start();

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];
}

$client_id = '21cd4b2939534e37a8c6b9cd89bbf1a5';
$client_secret = '784c57860393443b9296978e076e0921';
$redirect_url = 'http://localhost/healthgraph-master/examples/teste2.php';


// Button
$button = Authorization::getAuthorizationButton($client_id, $redirect_url);
echo $button['html'];
