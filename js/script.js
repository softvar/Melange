$counter = 0;
$current_class = 'm_1';
$hover_class = 'm_1';
$last_visit = 0;

var $root = $(document.documentElement),
    $window = $(window);

var browserCSSPrefix = "",
	animationEndEvent = "animationend";

var windowWidth = 0,
    windowHeight = 0;
    



$(document).ready(function()
{
  
  
  $('#mustache_picker').addClass( 'initialized' );

		// Helpers
	if($.browser.webkit) 
	{
		browserCSSPrefix = "-webkit-";
		animationEndEvent = "webkitAnimationEnd";
	}
	else if($.browser.mozilla)
	browserCSSPrefix = "-moz-";
	else if($.browser.opera)
	browserCSSPrefix = "-o-";
	
	windowWidth = $root.width(),
    windowHeight = $root.height(),
    $style = $("<style/>").appendTo("head"),
    
  
  
  manage_scroller();
	
	initLocalStorage( );
	
	onMoustacheHover();
	onMoustachePicked( );
	onlistOut( );
	
	//onFanionClick();
	//onClose();
	
	onMustachePickExpand();
	
	
	 // API Ref: http://api.dribbble/players/:id/shots
    $.jribbble.getShotsByPlayerId('salleedesign', function (playerShots) {
        $.each(playerShots.shots, function (i, shot) {
        
        	 $('#dribbbleshots').append( '<a target="_blank" href="' + shot.url + '"><span><img src="' + shot.image_teaser_url + '"alt="' + shot.title + '"></span></a>');
        	 
        	 
        });
            
   
    }, {page: 1, per_page: 3});

});


function initLocalStorage()
{
	if (typeof(localStorage) == 'undefined' ) 
	{
	}
	
	else 
	{
		
		var locals = localStorage.getItem("moustache_choice");
		
		if( locals == null )
		{
			window.setTimeout(function()
			{
				expandMe();
			}, 200);
		}
		else
		{
			var newsTimer = localStorage.getItem("visited_last_24h");		
			if( newsTimer == null )
			{
				$last_visit = new Date().getTime();
				setTimerStorage( );
			}
			else
			{
			  if( locals == "m_10" || locals == "m_11" || locals == "m_12" )
			  {
			    locals = "m_1"
			  }
			  
				var elapsed = new Date().getTime() - newsTimer;
				$last_visit = new Date().getTime();
				setTimerStorage( );
				var day = 60 * 60 * 1000;
				if( elapsed > 20 * day )
				{
				  window.setTimeout(function()
				  {
				  	expandMe();
				  }, 200);
				}
			}
			
			// Pick the right mustache and higlight it
			$('#mustache_picker ul').find( '.'+$current_class ).removeClass( 'selected' );
			$current_class = locals;
			$hover_class = locals;
			
			$('#mustache_picker ul').find( '.'+$current_class ).addClass( 'selected' );
			
			setMoustacheLogo( );
		}
	}
}

function setLocalStorage()
{
	try 
	{
		localStorage.setItem("moustache_choice", $current_class); //saves to the database, "key", "value"
	}
	catch (e) 
	{
	 	if (e == QUOTA_EXCEEDED_ERR) 
	 	{
	 		 alert('Quota exceeded!'); //data wasn't successfully saved due to quota exceed so throw an error
		}
	}
}

function setTimerStorage()
{
	try 
	{
		localStorage.setItem("visited_last_24h", $last_visit); //saves to the database, "key", "value"
	}
	catch (e) 
	{
	 	if (e == QUOTA_EXCEEDED_ERR) 
	 	{
	 		 alert('Quota exceeded!'); //data wasn't successfully saved due to quota exceed so throw an error
		}
	}
}

function onMoustacheHover( )
{
	$('#mustache_picker ul li a').hover( function()
	{
		
		tmp = $( this ).attr('class');
		if( tmp != 'collapse_arrow')
		{
			$('#mustache_on_logo').removeClass( ).addClass( tmp );
			$hover_class = tmp;
		}
		
	});
}

function onlistOut( )
{
	$('#mustache_picker ul li a').hover( function()
	{
	},
	function()
	{
		setMoustacheLogo();
	});
}

function setMoustacheLogo()
{
	$('#mustache_on_logo').removeClass( ).addClass( $current_class );
}

function onMoustachePicked()
{
	$('#mustache_picker li a').click( function()
	{
		if( tmp != 'collapse_arrow')
		{
			$('#mustache_picker ul li a').removeClass( 'selected' );
			$( this ).addClass( 'selected' );
		
			$current_class = $hover_class;
			setLocalStorage();
			setMoustacheLogo();
			collapseMe();
		}
		return false;
	});
}


function onMustachePickExpand( )
{
	$('#selected_tache').click(function()
 	{
 	  expandMe();
		return false;
	});
	
	$('#mustache_picker .expand_arrow').click(function()
 	{
 	  expandMe();
		return false;	
	});
	
	$('#mustache_picker ul .collapse_arrow').click(function()
 	{
		collapseMe();
		return false;	
	});
}

function expandMe()
{
  $('#branding .logo_text h1').addClass( 'expandme' );
  $('#mustache_picker').addClass( 'expandme' );
}

function collapseMe()
{
  $('#branding .logo_text h1').removeClass( 'expandme' );
  $('#mustache_picker').removeClass( 'expandme' );
}


function manage_scroller()
{
    jQuery('.scroller').click(function() 
    {
           var clicked = jQuery(this).attr("href");
           var destination = jQuery(clicked).offset().top;
           jQuery("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination}, 500 );
           return false;
    });
}


