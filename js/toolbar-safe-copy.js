function Toolbar(surface) {
	
this.iBytesUploaded = 0;
this.iBytesTotal = 0;
this.iPreviousBytesLoaded = 0;
this.iMaxFilesize = 3048576; // 3MB
this.oTimer = 0;
this.sResultFileSize = '';
this.imagePath = null;

this.toggleBinder();	
this.surfaceObject = surface;	
this.clickBinder();
this.modalBinder();
this.uploadBinder();
document.getElementById('switch-icon').value= -1;
	
}




Toolbar.prototype.toggleBinder = function() {
	
	$("#toolbar-icon").click(function(){
	
	if(document.getElementById('switch-icon').value==1)
	{
		document.getElementById('switch-icon').src = "./images/switch-off.png";
		document.getElementById('switch-icon').value = -1;
		
	}
	else
	{
		document.getElementById('switch-icon').src = "./images/switch-on.png";
		document.getElementById('switch-icon').value= 1;
	}
	
	
	$("#vertical-list").fadeToggle("10");
			  });
	
}

Toolbar.prototype.modalBinder = function () {
	
 
 	$('#modal-profile').css('top',"200px");
 	$('#modal-profile').css('left',$('#img').offset().left+50+"px");
 
 
    $('#modal-close-profile, #modal-lightsout').click(function() {
        $('#modal-profile').fadeOut("slow");
        $('#modal-lightsout').fadeOut("slow");
    });
	
	
}





Toolbar.prototype.clickBinder = function() {
	
		document.getElementById("a").onclick = $.proxy(function(){ this.createA(this.surfaceObject);},this);
		document.getElementById("p").onclick = $.proxy(function(){ this.createP(this.surfaceObject);},this);
		document.getElementById("aside").onclick=$.proxy(function(){ this.createAside(this.surfaceObject);},this);
		document.getElementById("section").onclick = $.proxy(function(){ this.createSection(this.surfaceObject);},this);
		//document.getElementById("text").onclick = $.proxy(function(){ this.createText(this.surfaceObject);},this);

		document.getElementById("img").onclick = $.proxy(function(){ this.createImage(this.surfaceObject);},this);
	
}

Toolbar.prototype.createA = function(surf) {
	
	
	surf.createObject('a',{href:"#"});

}

Toolbar.prototype.createP = function(surf) {
	
	
	surf.createObject('p');

}

Toolbar.prototype.createAside = function(surf) {
	
	
	surf.createObject('aside');

}

Toolbar.prototype.createSection = function(surf) {
	
	
	surf.createObject('section');

}

Toolbar.prototype.createText = function(surf) {
	
	
	surf.createObject('input',{type:"text"});

}




Toolbar.prototype.refreshModal = function() {
	
    document.getElementById('upload_response').style.display = 'none';
    document.getElementById('error').style.display = 'none';
    document.getElementById('error2').style.display = 'none';
    document.getElementById('abort').style.display = 'none';
    document.getElementById('warnsize').style.display = 'none';
	
    document.getElementById('progress_percent').style.display = 'none';
    document.getElementById('progress').style.display = 'none';
    document.getElementById('filesize').style.display = 'none';
    document.getElementById('remaining').style.display = 'none';
	
    document.getElementById('fileinfo').style.display = 'none';
    
    document.getElementById('speed').style.display = 'none';
    document.getElementById('remaining').style.display = 'none';
	document.getElementById('drop_text').style.display = 'block';
	document.getElementById('b_transfered').style.display = 'none';
	if(document.getElementById('prev'))
	$('#prev').remove();
	
}




Toolbar.prototype.createImage = function(surf) {
	
	
$('#modal-profile').fadeIn("slow");
 $('#modal-lightsout').fadeTo("slow", .9);	
 this.refreshModal();
	
	
}

Toolbar.prototype.secondsToTime = function(secs) {
	
	var hr = Math.floor(secs / 3600);
	    var min = Math.floor((secs - (hr * 3600))/60);
	    var sec = Math.floor(secs - (hr * 3600) -  (min * 60));

	    if (hr < 10) {hr = "0" + hr; }
	    if (min < 10) {min = "0" + min;}
	    if (sec < 10) {sec = "0" + sec;}
	    if (hr) {hr = "00";}
	    return hr + ':' + min + ':' + sec;
	
}

Toolbar.prototype.bytesToSize = function(bytes) {
    var sizes = ['Bytes', 'KB', 'MB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
}



Toolbar.prototype.startUploading = function(files) {
    // cleanup all temp states
    this.iPreviousBytesLoaded = 0;
    document.getElementById('upload_response').style.display = 'none';
    document.getElementById('error').style.display = 'none';
    document.getElementById('error2').style.display = 'none';
    document.getElementById('abort').style.display = 'none';
    document.getElementById('warnsize').style.display = 'none';
    document.getElementById('progress_percent').innerHTML = '';
    var oProgress = document.getElementById('progress');
    oProgress.style.display = 'block';
    oProgress.style.width = '0px';

    // get form data for POSTing
    //var vFD = document.getElementById('upload_form').getFormData(); // for FF3
    var vFD = new FormData();
	
	for (var i = 0; i < files.length; i++) {
	  vFD.append('file', files[i]);
	} 

    // create XMLHttpRequest object, adding few event listeners, and POSTing our data
    var oXHR = new XMLHttpRequest();
    oXHR.upload.addEventListener('progress', $.proxy(this.uploadProgress,this), false);
    oXHR.addEventListener('load', $.proxy(this.uploadFinish,this), false);
    oXHR.addEventListener('error', $.proxy(this.uploadError,this), false);
    oXHR.addEventListener('abort', $.proxy(this.uploadAbort,this), false);
    oXHR.open('POST', 'upload.php');
    oXHR.send(vFD);

    // set inner timer
    this.oTimer = setInterval($.proxy(this.doInnerUpdates,this), 300);
}

Toolbar.prototype.doInnerUpdates = function() { // we will use this function to display upload speed
    
    document.getElementById('speed').style.display = 'block';
    document.getElementById('remaining').style.display = 'block';
	
	var iCB = this.iBytesUploaded;
    var iDiff = iCB - this.iPreviousBytesLoaded;

    // if nothing new loaded - exit
    if (iDiff == 0)
        return;

    this.iPreviousBytesLoaded = iCB;
    iDiff = iDiff * 2;
    var iBytesRem = this.iBytesTotal - this.iPreviousBytesLoaded;
    var secondsRemaining = iBytesRem / iDiff;

    // update speed info
    var iSpeed = iDiff.toString() + 'B/s';
    if (iDiff > 1024 * 1024) {
        iSpeed = (Math.round(iDiff * 100/(1024*1024))/100).toString() + 'MB/s';
    } else if (iDiff > 1024) {
        iSpeed =  (Math.round(iDiff * 100/1024)/100).toString() + 'KB/s';
    }

    document.getElementById('speed').innerHTML = iSpeed;
    document.getElementById('remaining').innerHTML = '| ' + this.secondsToTime(secondsRemaining);
}

Toolbar.prototype.uploadProgress = function(e) { // upload process in progress
    if (e.lengthComputable) {
        document.getElementById('b_transfered').style.display = 'block';
		this.iBytesUploaded = e.loaded;
        this.iBytesTotal = e.total;
        var iPercentComplete = Math.round(e.loaded * 100 / e.total);
        var iBytesTransfered = this.bytesToSize(this.iBytesUploaded);

        document.getElementById('progress_percent').innerHTML = iPercentComplete.toString() + '%';
        document.getElementById('progress').style.width = (iPercentComplete * 4).toString() + 'px';
        document.getElementById('b_transfered').innerHTML = iBytesTransfered;
        if (iPercentComplete == 100) {
            var oUploadResponse = document.getElementById('upload_response');
            oUploadResponse.innerHTML = '<h1>Please wait...processing</h1>';
            oUploadResponse.style.display = 'block';
        }
    } else {
        document.getElementById('progress').innerHTML = 'unable to compute';
    }
}

Toolbar.prototype.uploadFinish = function(e) { // upload successfully finished
    var oUploadResponse = document.getElementById('upload_response');
    var response = e.target.responseText.split('$');
	oUploadResponse.innerHTML = response[0];
    oUploadResponse.style.display = 'block';
	
	this.imagePath = response[1];
	 this.surfaceObject.createObject("img",{src:this.imagePath,height:"200px",width:"300px"});
	//alert(this.imagePath);

    document.getElementById('progress_percent').innerHTML = '100%';
    document.getElementById('progress').style.width = '400px';
    document.getElementById('filesize').innerHTML = this.sResultFileSize;
    document.getElementById('remaining').innerHTML = '| 00:00:00';

    clearInterval(this.oTimer);
}

Toolbar.prototype.uploadError = function(e) { // upload error
    document.getElementById('error2').style.display = 'block';
    clearInterval(this.oTimer);
}  

Toolbar.prototype.uploadAbort = function(e) { // upload abort
    document.getElementById('abort').style.display = 'block';
    clearInterval(this.oTimer);
}

Toolbar.prototype.handleDragOver = function(evt) {
	
	
	evt.stopPropagation();
	evt.preventDefault();
	evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.	
	
}

Toolbar.prototype.handleFileSelect = function(evt) {
	
   evt.stopPropagation();
    evt.preventDefault(); 
	
	document.getElementById('upload_response').style.display = 'none';
	document.getElementById('error').style.display = 'none';
    document.getElementById('error2').style.display = 'none';
    document.getElementById('abort').style.display = 'none';
	document.getElementById('warnsize').style.display = 'none';
       
	 document.getElementById('drop_text').style.display = 'none';  
	   
	  
	   

       var files = evt.dataTransfer.files; // FileList object.
	   var oFile = files[0];
       // files is a FileList of File objects. List some properties.
       var output = [];
       for (var i = 0, f; f = files[i]; i++) {
		   if (!f.type.match('image.*')) {
		          
				  document.getElementById('warnsize').style.display = 'block';
				   continue;	
		      }
	   
	   if (oFile.size > this.iMaxFilesize) {
	           document.getElementById('warnsize').style.display = 'block';
	           return;
	       }
	   
		 
	   
	   var reader = new FileReader();

	         // Closure to capture the file information.
	         reader.onload = $.proxy((function(theFile) {
	           return function(e) {
	             // Render thumbnail.
	             var span = document.createElement('span');
	             span.innerHTML = ['<img class="thumb" id="prev" src="', e.target.result,
	                               '" title="', escape(theFile.name), '"/>'].join('');
	             document.getElementById('list').insertBefore(span, null);
			
				 var oImage = document.getElementById('prev');
				 oImage.src = e.target.result;
	                
			
			
				 this.sResultFileSize = this.bytesToSize(oFile.size);
				             document.getElementById('fileinfo').style.display = 'block';
				             document.getElementById('filename').innerHTML = 'Name: ' + oFile.name;
				             document.getElementById('filesize').innerHTML = 'Size: ' + this.sResultFileSize;
				             document.getElementById('filetype').innerHTML = 'Type: ' + oFile.type;
				             document.getElementById('filedim').innerHTML = 'Dimension: ' + oImage.naturalWidth + ' x ' + oImage.naturalHeight;
				         }
				     
			   
			   
			   
			   
	         })(f),this);

	         // Read in the image file as a data URL.
	         reader.readAsDataURL(f);
			 this.startUploading(files);
			
			
			// surf.createObject("img",{src:document.getElementById('path').innerHTML,height:"200px",width:"300px"});
			 
	       }
       
	
	
}


Toolbar.prototype.uploadBinder = function(surf) {
	var dropZone = document.getElementById('dropzone');
	dropZone.addEventListener('dragover', this.handleDragOver, false);
	 
	dropZone.addEventListener('drop', $.proxy(this.handleFileSelect,this), false);	
	

}



