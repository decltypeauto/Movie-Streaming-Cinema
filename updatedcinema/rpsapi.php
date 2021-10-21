<?php
header("Content-Type: application/json; charset=UTF-8");

ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 0);
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.cookie_lifetime', 0);

require_once 'app/core/Config.php';
require_once 'app/controllers/UtilController.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/ApiController.php';

$API = new ApiController;

// Check data
if (empty($_GET['user']) || empty($_GET['pass']) || empty($_GET['hwid']) || empty($_GET['key'])) {
	
	$response = array('status' => 'failed', 'error' => 'Missing arguments');

} else {

	$username = $_GET['user'];
	$passwordHash = $_GET['pass'];
	$hwidHash = $_GET['hwid'];
	$key = $_GET['key'];

	if (API_KEY === $key) {

		// decode
		$password = $passwordHash;
		$hwid = base64_decode($hwidHash);
		
		$response = $API->getUserAPI($username, $password, $hwid);

	} else {

		$response = array('status' => 'failed', 'error' => 'Invalid API key');
		
	}

}

echo (json_encode($response));
