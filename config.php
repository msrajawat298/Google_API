<?php
	session_start();
	require_once "vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("1053384134970-06ce1ter4anufuhv80c3ngqooqqu8i2f.apps.googleusercontent.com");
	$gClient->setClientSecret("UW5T7Ng7mURzk_dhgZa81Bgn");
	$gClient->setApplicationName("MSRAJAWAT298");
	$gClient->setRedirectUri("http://localhost/Google_API/g-callback.php");
	$gClient->setScopes(array('email', 'https://www.googleapis.com/auth/plus.login'));
	//$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");	
	// $gClient->addScope("email");
	// $gClient->addScope("profile");
	$con = new mysqli('localhost', 'root','' ,'test');
	    if ($con->connect_error) {
	    	die("Connection failed: " . $con->connect_error);
		}	
?>