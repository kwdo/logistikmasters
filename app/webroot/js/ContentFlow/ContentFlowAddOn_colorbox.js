/*  ContentFlowAddOn_DEFAULT, version 3.0 
 *  (c) 2008 - 2010 Sebastian Kutsch
 *  <http://www.jacksasylum.eu/ContentFlow/>
 *
 *  This file is distributed under the terms of the MIT license.
 *  (see http://www.jacksasylum.eu/ContentFlow/LICENSE)
 */
 
new ContentFlowAddOn ('colorbox', {
    init: function() {
    	 	var colorboxBaseDir = this.scriptpath+"colorbox/";
        	var colorboxCSSBaseDir = colorboxBaseDir+"example2/";
        	var colorboxImageBaseDir = colorboxBaseDir+"/example2/images/";
       		this.addScript(colorboxBaseDir+"jquery.colorbox-min.js");
        	this.addStylesheet(colorboxCSSBaseDir+"colorbox.css");
    },
    ContentFlowConf: {
	    onclickActiveItem: function (item) {
            var url;
			if (url = item.content.getAttribute('href')) {
	            $.colorbox({ 
					href : url
				});
			}
        }
    }
});
