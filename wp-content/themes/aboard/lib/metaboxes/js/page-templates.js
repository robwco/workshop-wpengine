/*-----------------------------------------------------------------------------------
	Page Templates Setting Custom Fields Hide/Show
/*----------------------------------------------------------------------------------*/
 
jQuery(document).ready(function() {
 	 
 	jQuery('label[for=page-cpt-settings-hide]').hide();
 	
 	// assign the value to a variable, so you can test to see if it is working
	var selectVal = jQuery('#page_template :selected').val();
	 
	//alert(selectVal);
	 
	if ( ( selectVal == 'page-portfolio.php' ) || ( selectVal == 'page-gallery.php' ) ) {
	 
		jQuery('#page-cpt-settings').show();
	 
	 } else {
	 
	 	jQuery('#page-cpt-settings').hide();
	 	
	 }
	
	jQuery('#page_template').change(function() {
	
	   // assign the value to a variable, so you can test to see if it is working
	    var selectVal = jQuery('#page_template :selected').val();
	    
	    //alert(selectVal);
	    
	    if ( ( selectVal == 'page-portfolio.php' ) || ( selectVal == 'page-gallery.php' ) ) {
	    
 	    	jQuery('#page-cpt-settings').show();
	    
	    } else {
	    
	    	jQuery('#page-cpt-settings').hide();
	    	
	    }
	    
	});


	//modify sidebar link
	jQuery("a[href='themes.php?page=edit.php?post_type=sidebar']").attr('href', 'edit.php?post_type=sidebar') 
});