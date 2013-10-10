<?php
session_start();	

require 'oAuthInterface.php';
?>

<html>
<head>
	<title>fb check </title>
	
</head>
<body>



<?php
$oAuth = new oAuthLogin();

if($oAuth->isLoggedIn() == 1)
{
	
	
	echo "<a href=\"".$oAuth->getLogoutUrl()."\">log-out</a>";
	
	
}
else {
	
	
	echo "<a href=\"".$oAuth->getFacebookLoginUrl()."\"><img src=\"./images/fb.png\"></a>";
	echo "    ";
	echo "<a href=\"".$oAuth->getGoogleLoginUrl()."\"><img src=\"./images/google.png\"></a>";
	
	
	
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1)
{
	
	
	$userData = $oAuth->getUserData();
	echo $userData['email']."~~".$userData['name']."~~~"."<img src=\"".$userData['img']."\">"."~~~".$userData['id'];	
}

?>

</body>