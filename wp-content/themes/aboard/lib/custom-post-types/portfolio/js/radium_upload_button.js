/*jQuery(document).ready(function() {

	jQuery('#radium_portfolio_upload_images').click(function() {
		window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
			jQuery('#add_image').val(imgurl);
		 tb_remove();
	}
	 
	 tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
	 return false;
	});
	 
}); */


jQuery(document).ready(function() {
	
	jQuery('#radium_portfolio_upload_images').click(function() {
		
	    var tbURL = jQuery('#add_image').attr('href');
	    
	    if(typeof tbURL === 'undefined') {
	        tbURL = jQuery('#content-add_media').attr('href');
	    }
	    
		tb_show('', tbURL);
		return false;
		
	});
 
});
