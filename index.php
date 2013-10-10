<?php
session_start();
require 'oAuthInterface.php';
$oAuth = new oAuthLogin();
?>
<!DOCTYPE html>

<html>
		
<head>
	<title>design-room</title>
	<link rel="stylesheet" type="text/css" href="./styles/index.css">
	<script src="./js/jquery-old.js"></script>
	<script type="text/javascript">

	// to delete user files

	window.onbeforeunload = function() {

$.ajax({
    	url:"/logout.php",
    	type:"POST",
    	data: {auto : 'yes'}
    	async:false, // so browser waits till xhr completed
    	success:function() {
      	alert("bye!");
    	}
		});

	}



	/*	$(window).unload(function() {
  		$.ajax({
    	url:"/logout.php",
    	type:"POST",
    	data: {auto : 'yes'}
    	async:false, // so browser waits till xhr completed
    	success:function() {
      	alert("bye!");
    	}
		});
		});

*/



	</script>
</head>

<body>

<div class="header">

		
		<div id="userinfo">
		<?php
		if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in']==1))
		{
		if(isset($_SESSION['oauth_vendor']) && (($_SESSION['oauth_vendor']=='facebook') || ($_SESSION['oauth_vendor']=='google')))
		{
		$userData = $oAuth->getUserData();
		echo "<img  src=\"".$userData['img']."\"  width=\"30px\" height=\"30px\"style=\"margin-left:-1112px;position:absolute; top:10px;\">";
		
	    /*****  Folder creation   ********/
  
	    if(!is_dir("./user_content/".$_SESSION['user_name']))
	    {
  	
	  	mkdir("./user_content/".$_SESSION['user_name'], 0700);
	  	copy("images/browsers/safari.png", "./user_content/".$_SESSION['user_name']."/safari.png");
	
	
	    }
	    
  	    /****************/
		
		}
		echo "<div style=\"font-family:arial;font-color:#333;font-size:1.1em;\">Welcome "  .$_SESSION['user_name'];
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo " <a href=\"".$oAuth->getLogoutUrl()."\">Logout</a></div>"; //$oAuth->getLogoutUrl()
		//echo "<a href=\"".$oAuth->getLogoutUrl()."\">log-out</a>";
	
		}
				
		?>
		</div>
		
</div>


<div class="intro">

<h2>Design room </h2> is open source web page designer tool , built on HTML5 , CSS3 and Javascript and uses PHP for authentication and
file download purposes.It allows user to design and tweak every possible css property to change look and feel of the element.
This is beta version and supports &lt;p&gt;,&lt;aside&gt;,&lt;img&gt;,&lt;div&gt; tags.User can insert text and images give it various styling options.
The canvas provides drag and drop capabilities and dynamic repositioning of elements.Elements can be resized dynamically using
size extenders , appended at bottom right of elements.Elements can also be removed from canvas by dragging them to the trash can.
Ajax image uploader provided with Design room is also drag and drop bases,just drop the images you want to upload , and they will on 
canvas in no time.Design room generates the code at backend for the design you created.Any time user can view the source code by clicking in status bar at top.
Code will be formatted and syntax highlighted(using jquery libraries).Also , code can be downloaded at any time.Since , this is beta version, your
code will not be stored on the servers, so download it before logging out or closing browser tab.For initial testing ,safari image is placed, on the canvas
.Go ahead , give it a try.</br></br>

<h3>Login to enter the design room ------------> </h3>
</br>

</div>
	   
	   <!--login box-->
	   
	   <div class="login-box">
			<p style="font-size:1.2em;font-weight:bold;font-family:Impact">Login</p>
	   <?php
			
			//if(!(isset($_SESSION['logged_in']) && ($_SESSION['logged_in']==1))) :
			if(!($oAuth->isLoggedIn() == 1)&& !(isset($_SESSION['logged_in'])))
			{
			echo "</br>";
			echo "<a href=\"".$oAuth->getFacebookLoginUrl()."\"><img src=\"./images/fb.png\"></a>";
			echo "</br></br>";
			echo "<a href=\"".$oAuth->getGoogleLoginUrl()."\"><img src=\"./images/google.png\"></a>";
			echo "</br></br>";
	        
			}
			else
			{ 
			if(isset($_SESSION['oauth_vendor']) && (($_SESSION['oauth_vendor']=='facebook') || ($_SESSION['oauth_vendor']=='google')))
			{
			$userData = $oAuth->getUserData();
			echo "<span style=\"color:#888; font-weight:bold;font-family:Tahoma;\">Welcome "  .$_SESSION['user_name'] . "</span>";
			echo "</br></br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;<img  src=\"".$userData['img']."\  width=\"30px\" height=\"30px\" style=\"margin-left:1px; top:10px;\">";
			echo "</br>";
			echo "<p style=\"color:#222; font-weight:bold;\"> You can now  access our Design-Room page for Alpha preview.</p>";
			echo "</br>";
			echo " <a href=\"design-room.php\"><input type=\"button\" class=\"b-awesome\" value=\"Design-Room\"/></a></span>";
			}
		}
			
			
			?>
	   
		</div>
	
</body>
</html>




