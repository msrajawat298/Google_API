<?php
	require_once "config.php";

	if (isset($_SESSION['access_token']))
		$gClient->setAccessToken($_SESSION['access_token']);
	else if (isset($_GET['code'])) {

		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		
		$_SESSION['access_token'] = $token;
	} else {
		header('Location: login.php');
		exit();
	}
	//fetch user information//
	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo->get();
	
	//geting user google derive information//
	$drive_service = new Google_Service_Drive($gClient);
	$files_list = $drive_service->files->listFiles(array())->getFiles();
	echo "<pre>";
	print_r($userData);
//	print_r($files_list);
	echo "</pre>";

	if (count($files_list) == 0) {
    	print "No files found.\n";
	} else {
		    foreach ($files_list as $file) {
		        $res['name'] = $file->getName();
		        $res['id'] = $file->getId();
		        $res['img'] = "<img src=".$file->getName().">";
		        $files[] = $res;

		    }
		    echo "<pre>";
    	print_r($files);
	}
	exit;

	$_SESSION['id'] = $userData['id'];
	$_SESSION['email'] = $userData['email'];
	$_SESSION['gender'] = $userData['gender'];
	$_SESSION['picture'] = $userData['picture'];
	$_SESSION['familyName'] = $userData['familyName'];
	$_SESSION['givenName'] = $userData['givenName'];

	 $sql="insert into google_users (clint_id,name,last_name,google_email,gender,picture_link) values
 ('".$userData['id']."','".$userData['givenName']."','".$userData['familyName']."','".$userData['email']."',
 '".$userData['gender']."','".$userData['picture']."')";
	mysqli_query($con,$sql);
	header('Location: index.php');
	exit();
?>