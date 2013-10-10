<?php
	

require './base_sdk/facebook.php';
require_once './base_sdk/apiClient.php';
require_once './base_sdk/contrib/apiOauth2Service.php';
ob_start();



class oAuthLogin 
{
	
	
	private $facebook;
	private $google;
	private $goauth;
	private $twitter;
	private $user;
	private $status = 0;
	private $user_profile = null;   
	private $_hostname = null;
	private $_request_url = null;
	private $_username = null;
	private $_useremailid = null;
	private $_user_dp = null;
	private $logged_in = -1;
	private $logoutUrl = null;
	private $googleloginUrl = null;
	private $facebookLoginUrl = null;
	
	
	
	 			
	function __construct() 
	{
		include 'oauth_config.php';
		$this->setLogOutUrl();
		$this->facebook = new Facebook(array(
			'appId'  => $apiData['facebook']['appId'],
	  	  	'secret' => $apiData['facebook']['secret'],
			));
		
		
		
		$this->google  = new apiClient();
		$this->google->setApplicationName("Cyber Slick");
		$this->google->setClientId($apiData['google']['clientId']);
		$this->google->setClientSecret($apiData['google']['clientSecret']);
		$this->google->setRedirectUri($apiData['google']['redirectUrl']);
		$this->google->setDeveloperKey($apiData['google']['developerKey']);
		
			
			
		$this->checkEstablishedSession();
	
	}
	public function setLogOutUrl () 
	{
	include 'oauth_config.php';
	$this->logoutUrl = 'http://'.$_path.'/logout.php';
	
	
	
	}
	public function fbSessionManager() 
	{
		$enail1 = null;
		$this->user = $this->facebook->getUser(); 		// fetches the status
		if($this->user)
			
		
	  try {
			    
		    $this->user_profile = $this->facebook->api('/me');
			
			
		  } catch (FacebookApiException $e) {
		    $this->printError($e);
		    $user = null;}
			catch (OAuthException $e) 
			{
					    header('location:'.'http://'.$_path.'/logout.php');
		    }
			catch (Exception $e) 
			{
				unset($_SESSION['logged_in']);
						header('location:'.'http://'.$_path.'/logout.php');
		    }
			
	
	
	if($this->user_profile !=null)
		{
			include 'oauth_config.php';
  			  $_SESSION['oauth_vendor'] = "facebook";
  		  	  $_SESSION['logged_in'] = 1;
  		  	  $_SESSION['oauth_token'] = $this->facebook->getAccessToken();
			   $_SESSION['user_name']=$this->user_profile["name"];
			  $this->status = 1; // logged in using facebook
			  $this->logged_in  = 1;
			  
			$url = $this->facebook->getLogoutUrl(array('next' =>'http://'.$_path.'/logout.php'));
			$this->logoutUrl = $url;
			//$this->printFbLogOutButton($url);
			//$this->printFbUserData($this->user_profile);
			
				
		}	
			
		
	}
	
	public function googleSessionManager() 
	{
		include 'oauth_config.php';
		$this->goauth = new apiOauth2Service($this->google);
		
		if (isset($_GET['code'])) {
			
		  try 
		  {$this->google->authenticate();
		  }
		  catch (Exception $e) 
		  {
				    header('location:'.'http://'.$_path.'/logout.php');
	       }
		  
		  
		  $_SESSION['token'] = $this->google->getAccessToken();
		  $to =  json_decode($this->google->getAccessToken());
		 
				  
		  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		  ob_flush();
		}

		if (isset($_SESSION['token'])) {
			
		 $this->google->setAccessToken($_SESSION['token']);
		}

		if (isset($_REQUEST['logout'])) {
		  unset($_SESSION['token']);
		  $this->google->revokeToken();
		}

		if ($this->google->getAccessToken()) {
		  $user = $this->goauth->userinfo->get();
		  
		 
		  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
		  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
		  $usr = filter_var($user['name'], FILTER_VALIDATE_URL);
		  $personMarkup = "$email<div><img src='$img?sz=50'></div>";
		  //echo $email;
		  
		  
		  
		  $_SESSION['oauth_vendor'] = "google";
		  $_SESSION['logged_in'] = 1;
		  $_SESSION['oauth_token'] = $this->google->getAccessToken();
		   $_SESSION['user_name']=$user['name'];
		  $this->logged_in = 1;
		  
		  $this->status = 2;
		 // $this->printGOAuthData($personMarkup);
		  // The access token may have been updated lazily.
		  $_SESSION['token'] = $this->google->getAccessToken();
		  //echo "     ";
		  //echo "<a class='logout' href=\""."http://".$_path."/logout.php"."\">google Logout</a>";
		  $this->logoutUrl = 'http://'.$_path.'/logout.php';
		
		} 
		
		
		
		
	}
	
	public function checkEstablishedSession() 
	{
		
		$this->fbSessionManager();
		
		
		
		if($this->status ==0)
			$this->googleSessionManager();
		
		 if($this->status == 0)
		{
			$url = $this->facebook->getLoginUrl(array('scope' => 'email'));
			$this->facebookLoginUrl = $url;
			//$this->printFbLoginButton($url);
			$url = $this->google->createAuthUrl();
			$this->googleLoginUrl = $url;
			//$this->printGoogleLoginButton($url);
			
			
		}
		
	}
	
	public function printError($e)
	{
		echo "<h3 id=\"exception\">".$e."</h3>";
		
	}
	
	public function isLoggedIn() {
		
		return $this->logged_in;
		
	}
	
	public function getLogoutUrl() {
		
		return $this->logoutUrl;
		
	}
	
	public function getFacebookLoginUrl() {
		
		return $this->facebookLoginUrl;
		
	}
	
	public function getGoogleLoginUrl() {
		
		return $this->googleLoginUrl;
		
	}
	
	
	
	
	
	
	public function getUserData()
	{
		if($this->status == 1)
		{
			$userData =  array();
			$userData['img'] = "https://graph.facebook.com/".$this->user."/picture";
			$userData['name'] = $this->user_profile["name"];
			$userData['email'] = $this->user_profile["email"];
			$userData['id'] = $this->user_profile["id"];
			return $userData;
			
			
		}
		
		else if($this->status ==2)
		{
			
			$user = $this->goauth->userinfo->get();
			$userData =  array();
			
  		 
  		 	 $img = $user['picture'];
  			 $userData['img'] = $img.'?sz=50';
			 $userData['name'] = $user['name'];
			 $userData['email'] = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
			 $userData['id'] = $user['id'];
			
			return $userData;
			
			
		}
			
	}
	
	
}

?>