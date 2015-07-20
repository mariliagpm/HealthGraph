<?php
error_reporting(E_ERROR);
define('YAMLPATH', 'C:\xampp\htdocs\yaml-master');

define('RUNKEEPERAPIPATH', 'C:\xampp\htdocs\runkeeperAPI-master');

define('CONFIGPATH', 'C:\xampp\htdocs\runkeeperAPI-master\config');

require(YAMLPATH.'/lib/sfYamlParser.php');

require(RUNKEEPERAPIPATH.'\lib\runkeeperAPI.class.php');


/* API initialization */
$rkAPI = new runkeeperAPI(
		CONFIGPATH.'\rk-api.sample.yml'	/* api_conf_file */
);
	
		
if ($rkAPI->api_created == false) {
	echo 'error '.$rkAPI->api_last_error; /* api creation problem */
	exit();
}


if ($_GET['code']) {
	$auth_code = $_GET['code'];
	if ($rkAPI->getRunkeeperToken($auth_code) == false) {
		echo $rkAPI->api_last_error; /* get access token problem */
		exit();
	}
	else {

		/* Do a "Read" request on "Profile" interface => return all fields available for this Interface */
		$rkProfile = $rkAPI->doRunkeeperRequest('Profile','Read');
		print_r($rkProfile);
		
	
		/* Do a "Read" request on "Settings" interface => return all fields available for this Interface */
		$rkSettings = $rkAPI->doRunkeeperRequest('Settings','Read');
		print_r($rkSettings);

		
		$fields = json_decode('{"uri":"/fitnessActivities/595230772"}');
		$rkCreateActivity = $rkAPI->doRunkeeperRequest('FitnessActivity','Delete /fitnessActivities/595230772',$fields);
		if ($rkCreateActivity) {
			print_r($rkCreateActivity);
		}
		else {
			echo $rkAPI->api_last_error;
			print_r($rkAPI->request_log);
		}
		
		
		/* Do a "Read" request on "FitnessActivityFeed" interface => return all fields available for this Interface or false if request fails */
		$rkActivities = $rkAPI->doRunkeeperRequest('FitnessActivityFeed','Read');
		if ($rkUpdateActivity) {
			print_r($rkUpdateActivity);
		}
		else {
			echo $rkAPI->api_last_error;
			print_r($rkAPI->request_log);
		}

	
		
		echo "<pre>";
if ($rkActivities) {
	print_r($rkActivities);
}
else {
	echo $rkAPI->api_last_error;
	print_r($rkAPI->request_log);
}
echo "</pre>";

		
	}
}

