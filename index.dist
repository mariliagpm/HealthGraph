<?php

require_once '../vendor/autoload.php';

use \HealthGraph\Authorization;
use \HealthGraph\Client;
session_start();

if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];

}

$client_id = '21cd4b2939534e37a8c6b9cd89bbf1a5';
$client_secret = '784c57860393443b9296978e076e0921';
$redirect_url = 'http://localhost/healthgraph/';

if (isset($_GET['code'])) {
  // user accepted access
  echo"oi";
  $token = Authorization::authorize($_GET['code'], $client_id, $client_secret, $redirect_url);
  if ($token) {
    $_SESSION['token'] = $token;
  }
  header("Location: $redirect_url");
}
elseif (isset($_GET['error'])) {
  // user denied access
  $button = Authorization::getAuthorizationButton($client_id, $redirect_url);
  echo $button['html'];
  echo '<h2>Denied</h2>';
}
elseif (isset($_GET['revoke'])) {
  // user wants to disconnect
  $auth = new Authorization();
  if ($auth->deauthorize($token['access_token'])) {
    unset($_SESSION['token']);
  }
  header("Location: $redirect_url");
}
elseif (!isset($token)) {
  // user is not connected
  $button = Authorization::getAuthorizationButton($client_id, $redirect_url);
  echo $button['html'];
 
}
else {
  // user is already connected
  echo "<a href='$redirect_url?revoke'>Disconnect</a>";

  $hgc = Client::factory(array(
      'access_token' => $token['access_token'],
      'token_type' => $token['token_type'],
  ));

  try {
    $profile = $hgc->getProfile()->getAll();
    var_dump($profile);
  }
  catch (Exception $e) {
    throw new Exception($e);
  }
$command = $hgc->getCommand('NewFitnessActivity', array(
    "type" => "Running",
    "start_time" => "Sat, 1 Jan 2011 00:00:00",
    "duration" => 600,
    "total_distance" => 1000,
    "notes" => "Ran 1000 meters in 600 seconds"
));
$result = $command->execute();
  $cmd = $hgc->getFitnessActivities();
  $activities = $hgc->getIterator('getFitnessActivities')->setLimit(7);
  $counter = 0;
  foreach ($activities as $activity) {
    var_dump($activity);
    $counter++;
  }
  var_dump($activities);
}
