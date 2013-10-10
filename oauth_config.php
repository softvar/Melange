<?php
	

/*  host url variables */

$_host = $_SERVER['HTTP_HOST'];
$_request_url = $_SERVER['REQUEST_URI'];
$_path = dirname($_host.$_request_url);



/* Array set of api keys */

$apiData = array(
					
					"facebook" => array("appId" =>"350137395076209" , "secret" => "f9c067ec2ddd523a68c30203274098c3"),
					"google" => array("clientId" => '507080955983.apps.googleusercontent.com' , "clientSecret" =>'aByFa_syiw4tqkte0bwBQhye',
									  "redirectUrl" => 'http://localhost:8888/php_sandbox/design-room/index.php' , "developerKey" => 'AIzaSyBRKs9a_IoJzcucY3SPyQDWsXK4rO0drjI8')


				);
				
		
	
				//echo 'http://'.$_path.'/oAuthtester.php';
				//http://localhost:8888/php_sandbox/melange-php-sdk/oAuthtester.php



?>