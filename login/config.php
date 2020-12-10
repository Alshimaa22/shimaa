<?php
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration
define('DB_HOST', '166.62.88.2');
define('DB_USERNAME', 'vps1_tafl02');
define('DB_PASSWORD', 'Tf@665544998877');
define('DB_NAME', 'vps1_tafl02');
define('DB_USER_TBL', 'users1');

// Google API configuration
define('GOOGLE_CLIENT_ID', '888838140421-37350837paj9asd2llmnomtkl85m62je.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'Dc85igwJGHFp02-CN3KbUPRs');
define('GOOGLE_REDIRECT_URL', 'http://tafl.azharlink.com/login/log.php');

// Start session
if(!session_id()){
    session_start();
}

// Include Google API client library
require_once 'google-api-php-client/Google_Client.php';
require_once 'google-api-php-client/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('shimaa login');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);