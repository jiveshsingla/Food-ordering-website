<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('1017789243728-s86hk09hutemn37ajv0oo4qubflrkrk0.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('gru1Fe7EBGK3jJmrp_qQXbh5');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/SpiceShuttle/res_signup_option.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?> 