function cssEngine() {
	
	
	var cssText = '';
	var domNode = null;
	
	
	
}

cssEngine.prototype.upperCaseOccurence = function (str) {
	
	
var i=0;
var character ='';
while (i <= str.length){
    character = str.charAt(i);
    if (!isNaN(character * 1)){
    	
    }else{
    	if (character == character.toUpperCase()) {
    		return i;
    	}
    	
    }
    i++;
}
	
}

cssEngine.prototype.loadNode = function(node) {
	
	this.domNode = node;
	
}

cssEngine.prototype.getCssText = function() {
	
	
	
	return this.cssText;
}

cssEngine.prototype.refreshCssText = function() {
	
	this.cssText = '';
	
	
}

cssEngine.prototype.isNumber = function(n) 
{
  return !isNaN(parseFloat(n)) && isFinite(n);
}



cssEngine.prototype.prepareCss = function(element) {

	
	
	this.loadNode(element);
	
	var style = this.domNode.style;
	var styleName = '';
	var suffix ='';
	var nodeId = '#'+this.domNode.id;
	
	this.cssText = this.cssText+'\n'+nodeId+'\n{';
	
	var pos = -1;   // position of first uppercase property
	
	/*  iterating over style objects  of its own node     */
	
for (var property in style)
{
    	//pos = -1;
    	
    	
    	
    	
    	if (style.hasOwnProperty(property))
        {
        	
        	if(!style[property])
    		continue;
    		
    		if(this.isNumber(property.substr(0)))
    		continue;
			
			if(property === "cssText")
			continue;
    		
        	pos = this.upperCaseOccurence(property);
        	
        	
        	if(pos)
        	{
	        	
	        	styleName = property.substr(0, pos);
	        	suffix = property.substr(pos,property.length);
	        	alert(suffix.charAt(0).toLowerCase());
	        	suffix = suffix.charAt(0).toLowerCase() + suffix.substr(1);
				
	        	//alert(property+"-"+suffix);
	        	styleName = styleName+'-'+suffix;
	        	
	        	
	        		        	
        	}
        	
        	else
        		{
        		styleName = property;
        		
        		}
        
       // console.log(property+"p");
        this.cssText = this.cssText+'\n\t'+styleName+':'+style[property]+';';
        	
        
        
        }


}

document.write(property.value+"-"+style[property]+"\n");
this.cssText = this.cssText+'\n}';
	
	
}





