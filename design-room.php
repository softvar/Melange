<?php
session_start();
require 'oAuthInterface.php';
$oAuth = new oAuthLogin();
if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in']==1)) 
{
?>


<!DOCTYPE html>
<head>

<title>design-room</title>



<link rel="stylesheet" type="text/css" href="./styles/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="./styles/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="./styles/main-style.css"/>
<link rel="stylesheet" type="text/css" href="./styles/propertybox.css"/>
<link rel="stylesheet" type="text/css" href="./styles/chardin.css"/>

<link rel="stylesheet" type="text/css" href="./themes/theme.css">

<script src="./js/modernizr.js"></script>
<script src="./js/jquery-old.js"></script>
<script src="./js/jquery.transit.js"></script>
<script src="./js/jquery-ui-1.js"></script>
<script src="./js/colorpicker.js"></script>
<script src="./js/propertybox.js"></script>
<script src="./js/toolbar.js"></script>
<script src="./js/SurfaceDND.js"></script>
<script src="./js/css-engine.js"></script>
<script src="./js/clean.js"></script>
<script src="./js/rainbow.js"></script>
<script src="./js/html.js"></script>
<script src="./js/generic.js"></script>
<script src="./js/chardin.js"></script>

<!--<script src="./js/dnd.js"></script> -->

<script type="text/javascript" >



 $(document).ready(function() {
	 
     
  $('body').chardinJs();	 
 
 var surface = new Surface();
 surface.eventBinder();
 surface.createObject("img",{src:"images/browsers/safari.png",height:"200px",width:"300px"});
 var toolbar = new Toolbar(surface);
 var dustbin = new Dustbin();
 //dustbin.eventBinder();
 // loading bar
 $('#design-room').hide();
 
  $('body').append('<div id="dim"><div id="v-align"><div class="circle"></div><div class="circle1"></div></div></div>');
		
 		$('#dim').delay(2000).fadeOut('slow', function() {
 		$('#design-room').fadeIn('fast'); 
  });
 
  
  headingBinder();


  $("#chtog").click(function(){

  	$('body').data('chardinJs').toggle();

  });
  
 });


 function headingBinder() {
 	
     document.getElementById("main-header").onclick = function() {
  		 
   	 
		 if(document.getElementById('main-header').style.marginTop =="0px")
		 {
		 	
	      	  $("#main-header").animate({
	      	          marginTop: "-70px"
	      	      }, 1000);
		}
		 
		else 
		{
	      	  $("#main-header").animate({
	      	          marginTop: "0px"
	      	      }, 1000);
	    }
	  }
	}
 
</script>
</head>


<body>
	
	<div id="design-room">
<div id="modal-profile">

    <a id="modal-close-profile" title="Close profile window" href="#"><img src="./images/close.png" alt="Close profile window" /></a>
    
    <div id="dropzone" >
		<span id="drop_text">Drop files here</span>
	
							<div id="fileinfo">
		                        <div id="filename"></div>
		                        <div id="filesize"></div>
		                        <div id="filetype"></div>
		                        <div id="filedim"></div>
		                    </div>
		                    <div id="error">You should select valid image files only!</div>
		                    <div id="error2">An error occurred while uploading the file</div>
		                    <div id="abort">The upload has been canceled by the user or the browser dropped the connection</div>
		                    <div id="warnsize">Your file is very big. We can't accept it. Please select more small file</div>

		                    <div id="progress_info">
		                        <div id="progress"></div>
		                        <div id="progress_percent">&nbsp;</div>
		                        <div class="clear_both"></div>
		                        <div>
		                            <div id="speed">&nbsp;</div>
		                            <div id="remaining">&nbsp;</div>
		                            <div id="b_transfered">&nbsp;</div>
		                            <div class="clear_both"></div>
		                        </div>
		                        <div id="upload_response"></div>
							</div> 
	 
	 
	<output id="list"></output> 
  </div>
    </div>

	<div id="code-profile">

	    <a id="code-close-profile" title="Close profile window" href="#"><img src="./images/close.png" alt="Close profile window" /></a>
		
	</div>
    
   <div id="modal-lightsout"></div>
    
    
    
    
    
    

<div style="overflow:hidden;">

<header id="main-header">
          <div class="wrap">
               <div id="back-arrow">
               <a href="index.php"><img src="./images/left.png" id="left"></a>
               </div>
               
			   <?php
		if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in']==1))
		{
		if(isset($_SESSION['oauth_vendor']) && (($_SESSION['oauth_vendor']=='facebook') || ($_SESSION['oauth_vendor']=='google')))
		{
		$userData = $oAuth->getUserData();
		echo "<img  style=\" float:left; margin-right:10px; position:absolute; margin-left:-195px; top:-10px; \"  src=\"".$userData['img']."\"   ";
		
		}
		echo "&nbsp;";
		echo "<span id=\"styl\">Welcome  &nbsp;".$_SESSION['user_name']."</span>";
		echo "&nbsp;";
		//echo " <a href=\"".$oAuth->getLogoutUrl()."\"><input type=\"button\" id=\"user\" value=\"Log Out\"/></a></span>";
		//echo "<a href=\"".$oAuth->getLogoutUrl()."\">log-out</a>";
	
		}
		
		?>
			   
               
               
              <!-- <button id="mybutton">settings</button> -->
               <div id="info">
               <section >
			   <?php
               if(isset($_SESSION['oauth_vendor']) && (($_SESSION['oauth_vendor']=='facebook') || ($_SESSION['oauth_vendor']=='google')))
		{
		$userData = $oAuth->getUserData();
		echo $userData['email'];
		
		}
		?>
               </section>
               
               

               &nbsp; &nbsp;
	               &nbsp; &nbsp;
               <img src="./images/cogs.png" id="cogs" data-intro="view source code" data-position="left"> &nbsp;&nbsp; <img src="./images/download-32.png" id="download"data-intro="download your code" data-position="right" > &nbsp;&nbsp;<span style="color:#27c6f4;font-family:'Arial Narrow';">Alpha</span>
               &nbsp;&nbsp; <span id="chtog" style="font-color:#fff;font-size:1.9em;font-family:times;margin-top:-5px;padding:3px;" data-intro="toggle help" data-position="bottom"><i> i</i> </span>
               </div>
          </div>
     </header>
	



<section id="toolbar">

<div id="toolbar-icon">
<img id="switch-icon" src="./images/switch-off.png" data-intro="html markuplement set" data-position="right">
</div>

<div id="vertical-list">
<div class="button-set">	


<div  class='button' id="a" style="float:left;">&lt;a&gt;</div>
<div class='button' id="p">&lt;p&gt;</div>
<br>
	
</div>

<div class="button-set">

	<div class='button'id="aside" style="float:left;">&lt;as&gt;</div>
<div  class='button'id="div">&lt;di&gt;</div>
</div>

<div class="button-set">

	<div class='button' id="section">&lt;se&gt;</div>
	<div class='button' id="img">img</div>
	
		
</div>	


</div>

<div id="trash">
<img id="dustbin" src="./images/trash-empty.png" data-intro="trashcan :delete elements by dragging over it " data-position="right">
</div>

</section>





<section id="surface" data-intro="canvas" data-position="top">
	
<!--<aside id="dragme" draggable="true">Hey there ,move me !
</aside>-->

</section>


<!--<section id="trash">
<img id="dustbin" src="./images/trashcan.png">
</section> -->


<!--  property box -->

<div class="cssbox" id="cssbox" data-intro="property pane : style your elements using tools from here" data-position="left"	>
<div id="lock">
<img src="./images/lock.png" id="lock-img">
</div>
	<h2><center>
		Properties
		</h2>
		
	<!--Text Property Division starts here-->
	<div id="textproperties"> 
		
		<!--	<div class="Property" id="canvas-color">
			Canvas-Background-color :
		</div><center>
		<div class="PropertyContent" id="canvas-background-color">
			
		<input type="button" id="canvas-bgcolor-changer" style="background-color:#000000; border:thin solid white;height:50px;width:50px;margin-left:5px;">
		<input type="button" class="propbutton" id="no-color" value="remove bgcolor">	
		</div>
		</center>
		-->
		
		
		
		
		<div Class="Property" id="font">
			  Font :
			</div>
			<div class="PropertyContent" id="FontContent">
			
			<center>
			<input type="button" class="propbutton" id="FontInc" value="Size++">
			<input type="button" class="propbutton" id="Fontdec" value="Size--">
			<br>
			<input type="button" class="propbutton" id="Bold" value="B">
			<input type="button" class="propbutton" id="Italic" value="I" >
			<input type="button" class="propbutton" id="Underline" value="U">
			<input type="button" class="propbutton" id="Overline" value="O" >
			<input type="button" class="propbutton" id="Linethrough" value="T">
			<br>
			</center>
			Font Color:
			<br><center>
			<div class="color-section" id="color-section">
				<input type="button" id="color-changer" style="background-color:#000000; border:thin solid white;height:50px;width:50px;margin-left:5px;">	
					</div>
			</center>
			Font Face:<br>
			<select id="SelectFontFace">
				<option>academy engraved let</option>
				<option>algerian</option>
				<option>amaze</option>
				<option>arial</option>
				<option>arial black</option>
				<option>balthazar</option>
				<option>bankgothic lt bt</option>
				<option>bart</option>
				<option>bimini</option>
				<option>comic sans ms</option>
				<option>book antiqua</option>
				<option>bookman old style</option>
				<option>braggadocio</option>
				<option>britannic bold</option>
				<option>brush script mt</option>
				<option>century gothic</option>
				<option>century schoolbook</option>
				<option>chasm</option>
				<option>chicago</option>
				<option>colonna mt</option>
				<option>comic sans ms</option>
				<option>commercialscript bt</option>
				<option>coolsville</option>
				<option>courier</option>
				<option>courier new</option>
				<option>cursive</option>
				<option>dayton</option>
				<option>desdemona</option>
				<option>fantasy</option>
				<option>flat brush</option>
				<option>footlight mt light</option>
				<option>futurablack bt</option>
				<option>futuralight bt</option>
				<option>garamond</option>
				<option>gaze</option>
				<option>geneva</option>
				<option>georgia</option>
				<option>geotype tt</option>
				<option>helterskelter</option>
				<option>helvetica</option>
				<option>herman</option>
				<option>highlight let</option>
				<option>impact</option>
				<option>jester</option>
				<option>joan</option>
				<option>john handy let</option>
				<option>jokerman let</option>
				<option>kelt</option>
				<option>kids</option>
				<option>kino mt</option>
				<option>la bamba let</option>
				<option>lithograph</option>
				<option>lucida console</option>
				<option>map symbols</option>
				<option>marlett</option>
				<option>matteroffact</option>
				<option>matisse itc</option>
				<option>matura mt script capitals</option>
				<option>mekanik let</option>
				<option>monaco</option>
				<option>monospace</option>
				<option>monotype sorts</option>
				<option>ms linedraw</option>
				<option>new york</option>
				<option>olddreadfulno7 bt</option>
				<option>orange let</option>
				<option>palatino</option>
				<option>playbill</option>
				<option>pump demi bold let</option>
				<option>puppylike</option>
				<option>roland</option>
				<option>sans-serif</option>
				<option>scripts</option>
				<option>scruff let</option>
				<option>serif</option>
				<option>short hand</option>
				<option>signs normal</option>
				<option>simplex</option>
				<option>simpson</option>
				<option>stylus bt</option>
				<option>superfrench</option>
				<option>surfer</option>
				<option>swis721 bt</option>
				<option>swis721 blkoul bt</option>
				<option>symap</option>
				<option>symbol</option>
				<option>tahoma</option>
				<option>technic</option>
				<option>tempus sans itc</option>
				<option>terk</option>
				<option>times</option>
				<option selected="selected">times new roman</option>
				<option>trebuchet ms</option>
				<option>trendy</option>
				<option>txt</option>
				<option>verdana</option>
				<option>victorian let</option>
				<option>vineta bt</option>
				<option>vivian</option>
				<option>webdings</option>
				<option>wingdings</option>
				<option>western</option>
				<option>westminster</option>
				<option>westwood let</option>
				<option>wide latin</option>
				<option>zapfellipt bt</option>
				  
				  
			</select>
			<input type="button" class="propbutton" id="fontface" value="Set Font">  
			</div>
			
			<div Class="Property" id="bg-color">
				Background-color :
			</div><center>
			<div class="PropertyContent" id="background-color">
			
			<input type="button" id="bgcolor-changer" style="background-color:#000000; border:thin solid white;height:50px;width:50px;margin-left:5px;">
			
			</div>
			</center>
			
			<div Class="Property" id="textPreview">
				Text :
			</div>
			<div class="PropertyContent" id="textContent">
			<p id="text-preview" contenteditable="true" style="overflow:scroll; height:200px; width:250px;border:1px solid #bbbbbb;"></p>
			<center>
			<input type="button" class="propbutton" id="text-update" value="update">			
			</div>
			</center>
			
			
			
			
			
			<div Class="Property" id="Alignment">
				Alignment :
			</div><center>
			<div class="PropertyContent" id="AlignmentContent">
				<input type="button" class="propbutton" id="Left" value="Left">
				<input type="button" class="propbutton" id="Center" value="Center">
				<input type="button" class="propbutton" id="Right" value="Right"><br>
				<input type="button" class="propbutton" id="Whitespace" value="Whitespace">
				<input type="button" class="propbutton" id="Linebreak" value="Linebreak">
			</div></center>

			<div Class="Property" id="Spacing">
				Spacing :
			</div><center>
			<div class="PropertyContent" id="SpacingContent">
				Line :
				<input type="button" class="propbutton" id="LineInc" value="Increase">
				<input type="button" class="propbutton" id="LineDec" value="Decrease">
				<br>
				Letter :
				<input type="button" class="propbutton" id="LetterInc" value="Increase">
				<input type="button" class="propbutton" id="LetterDec" value="Decrease">
				<br>
				Word :
				<input type="button" class="propbutton" id="WordInc" value="Increase">
				<input type="button" class="propbutton" id="WordDec" value="Decrease">
			</div></center>

			<div class="Property" id="TextTransform">
			Text Tranformation :
			</div><center>
			<div class="PropertyContent" id="TextTransformContent">
				<input type="button" class="propbutton" id="uppercase" value="Uppercase">
				<input type="button" class="propbutton" id="lowercase" value="Lowercase" ><br>
				<input type="button" class="propbutton" id="capitalize" value="Capitalize">
				<input type="button" class="propbutton" id="normal" value="normal">
			</div></center>

			<div class="Property" id="TextIndentation">
			Text Indentation :
			</div>
			<div class="PropertyContent" id="TextIndentationContent">
<center>
				<input type="button" class="propbutton" id="TextIndentInc" value="Increase">
				<input type="button" class="propbutton" id="TextIndentDec" value="Decrease"><br>

			</div></center>

			<div class="Property" id="TextDirection">
			Text Direction :
			</div>
			<div class="PropertyContent" id="TextDirectionContent">
			<center>
				<input type="button" class="propbutton" id="Right-Left" value="Right-Left">
				<input type="button" class="propbutton" id="Left-Right" value="Left-Right"><br>
			</center>
			</div>

			<div class="Property" id="TextMargin">
			Margin :
			</div>
			<center>
			<div class="PropertyContent" id="TextMarginContent">
				Left:-
				<input type="button" class="propbutton" id="TextMarginLeftInc" value="Increase">
				<input type="button" class="propbutton" id="TextMarginLeftDec" value="Decrease">
				<br>
				Right:-
				<input type="button" class="propbutton" id="TextMarginRightInc" value="Increase">
				<input type="button" class="propbutton" id="TextMarginRightDec" value="Decrease">
				<br>
				Top:-
				<input type="button" class="propbutton" id="TextMarginTopInc" value="Increase">
				<input type="button" class="propbutton" id="TextMarginTopDec" value="Decrease">
				<br>
				Bottom:-
				<input type="button" class="propbutton" id="TextMarginBottomInc" value="Increase">
				<input type="button" class="propbutton" id="TextMarginBottomDec" value="Decrease">
				<br>
			</div>
			
			<div class="Property" id="TextPadding">
			Padding :
			</div>
			<div class="PropertyContent" id="TextPaddingContent">
				Left:-
				<input type="button" class="propbutton" id="TextPaddingLeftInc" value="Increase">
				<input type="button" class="propbutton" id="TextPaddingLeftDec" value="Decrease">
				<br>
				Right:-
				<input type="button" class="propbutton" id="TextPaddingRightInc" value="Increase">
				<input type="button" class="propbutton" id="TextPaddingRightDec" value="Decrease">
				<br>
				Top:-
				<input type="button" class="propbutton" id="TextPaddingTopInc" value="Increase">
				<input type="button" class="propbutton" id="TextPaddingTopDec" value="Decrease">
				<br>
				Bottom:-
				<input type="button" class="propbutton" id="TextPaddingBottomInc" value="Increase">
				<input type="button" class="propbutton" id="TextPaddingBottomDec" value="Decrease">
				<br>
			</div>

			<div class="Property" id="Shadow">
			Font Shadow :
			</div>
			<div class="PropertyContent" id="ShadowContent">
				<input type="button" class="propbutton" id="AddShadow" value="Addshadow">
				<input type="button" class="propbutton" id="RemoveShadow" value="Removeshadow">
			</div>
			
			
			<div Class="Property" id="TextBorder">
				Border :
			</div>
			<div class="PropertyContent" id="TextBorderContent">
				
				<input type="button" id="text-border-color" style="background-color:#000000; border:thin solid white;height:50px;width:50px;margin-left:5px;">
				&nbsp; &nbsp;
				
				<select id="text-border-style">
				
				<option>none</option>
				<option>hidden</option>
				<option>dotted</option>
				<option>dashed</option>
				<option>solid</option>
				<option>double</option>
				<option>groove</option>
				<option>ridge</option>
				<option>inset</option>
				<option>outset</option>
				</select>
				<br><br>
				<input type="range" id="text-border-width" min="1" max="20" width="100px" value="0">
				<br>
				
				
				<input type="button" class="propbutton" id="text-border" value="set">
				
				
				</div>
			</center>
			</br>
			
			<input type="button" class="propbutton" id="Reset" value="Reset Text">
		
	</div>
	<!--Text Property Division ends here-->
	
	<!--Image Property Division Starts here-->
	<div id="imageproperties"> 
		
		
		
		
		
		
		<div Class="Property" id="ImageAlignment">
				Alignment :
			</div>
			<div class="PropertyContent" id="ImageAlignmentContent">
			<center>
				<input type="button" class="propbutton" id="ImageLeft" value="Left">
				<input type="button" class="propbutton" id="ImageMiddle" value="Middle">
				<input type="button" class="propbutton" id="ImageRight" value="Right"><br>
				<input type="button" class="propbutton" id="ImageTop" value="Top">
				<input type="button" class="propbutton" id="ImageBottom" value="Bottom">
			</center>
			</div>
		
			<div Class="Property" id="ImageSize">
				Size :
			</div>
			<div class="PropertyContent" id="ImageSizeContent">
			<center>
				<input type="button" class="propbutton" id="ImageHeightInc" value="Height++">
				<input type="button" class="propbutton" id="ImageWidthInc" value="Width++"><br>
				<input type="button" class="propbutton" id="ImageHeightDec" value="Height--">
				<input type="button" class="propbutton" id="ImageWidthDec" value="Width--">
			</center>
			</div>
			
			<div Class="Property" id="ImageSpace">
				Spacing :
			</div>
			<div class="PropertyContent" id="ImageSpaceContent">
				<center>
				<input type="button" class="propbutton" id="ImageHSpaceInc" value="H-Space ++">
				<input type="button" class="propbutton" id="ImageVSpaceInc" value="V-Space ++"><br>
				<input type="button" class="propbutton" id="ImageHSpaceDec" value="H-Space --">
				<input type="button" class="propbutton" id="ImageVSpaceDec" value="V-Space --">
			</div>
			
			
			
			<div Class="Property" id="ImageBorder">
				Border :
			</div>
			<div class="PropertyContent" id="ImageBorderContent">
				
				<input type="button" id="border-color" style="background-color:#000000; border:thin solid white;height:50px;width:50px;margin-left:5px;">
				&nbsp; &nbsp;
				
				<select id="image-border-style">
				
				<option>none</option>
				<option>hidden</option>
				<option>dotted</option>
				<option>dashed</option>
				<option>solid</option>
				<option>double</option>
				<option>groove</option>
				<option>ridge</option>
				<option>inset</option>
				<option>outset</option>
				</select>
				<br><br>
				<input type="range" id="image-border-width" min="1" max="20" width="100px" value="0">
				<br>
				
				
				<input type="button" class="propbutton" id="image-border" value="set">
				
				
							</div>
	</div>
	<!--Image properties end here-->
	
	
</div> <!--cssbox division ends here-->
<input type="hidden" id="dummy" name="hidden" value="#000000">


<footer id="page-footer">

<section>
copyright &copy; Melange 2012
</section>


</footer>


</div>
</div>
</body>
</html>
<?php

}
else
{
header('Location:Front.php#loginbox');
}
?>