/*-----------------------------------------------------------------------------------
	Slider Settings Fields Hide/Show
/*---------------------------------------------------------------------------------- */

 jQuery(document).ready(function() {
  	 
 	// assign the value to a variable, so you can test to see if it is working
 	 var selectVal = jQuery('#_radium_slider_type :selected').val();
  	 
//alert(selectVal);
	 	 jQuery('#slide-content .slide-wysiwyg, #slide-content .video-embed, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_hide_content, ._radium_content_carousel_pt, ._radium_refineslider_controls, ._radium_refineslider_transition, ._radium_slidershow_speed, ._radium_slideranimation_speed, ._radium_nivoslidershow_speed, ._radium_nivoslideranimation_speed, ._radium_nivoslider_transition').hide();
	
  //accordion
 	 if ( selectVal == 'accordion' ) {
 	 
 	 	jQuery('.slide-nav-tab, .style-tab, slide-content .slide-wysiwyg, #slide-content .video-embed, ._radium_slider_autoplay, ._radium_slider_width,  div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_hide_content').hide();
 	    		
 	    jQuery ('#slide-content .slide-title, #slide-content .rwmb-image-url').show();
 	         	 	
 	 }
 	 
 	  //content-carousel
 	 if ( selectVal == 'content-carousel' ) {
 	 
 	 	jQuery('.slide-nav-tab, .style-tab, #slide-content .slide-title, #slide-content .slide-wysiwyg, #slide-content .video-embed, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slider_intervals, div._radium_slider_bgincrements, div._radium_refineslider_transition, div._radium_refineslider_controls').hide();
			jQuery (' ._radium_content_carousel_pt').show();
 	 	
 	 }
 	 
 	  //featured-content
 	 if ( selectVal == 'featured-content' ) {
 	 
		jQuery(' #slider-slides, #add-slider-slide, ._radium_slider_slides h2, ._radium_slideranimation_speed, ._radium_nivoslider_transition, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slider_intervals, div._radium_slider_bgincrements, div._radium_refineslider_transition, div._radium_refineslider_controls').hide();
 	 	jQuery (' ._radium_content_carousel_pt').show();
 	 	
 	 }
 	 
 	 //Flexislider
 	if ( selectVal == 'flexslider' ) {
 	
 	 	jQuery('#slide-content .slide-wysiwyg, .slide-button-tab, #slide-content .video-embed, div._radium_slider_autoplay, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slidershow_speed, div._radium_slideranimation_speed').show();
 	 	
 	   	jQuery('div._radium_slider_intervals, div._radium_slider_bgincrements, div._radium_refineslider_controls, div._radium_refineslider_transition').hide();
 		
 	}
 	
  	//Nivoslider
  	else if ( selectVal == 'nivoslider' ) {
  	
  	 	jQuery('.slide-nav-tab, .style-tab, #slide-content .slide-title, #slide-content .rwmb-image-url, #slide-content .slide-wysiwyg, #slide-content .video-embed, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_hide_content').hide();
  		
  		jQuery ('#slide-content .rwmb-image-url, ._radium_nivoslidershow_speed, ._radium_nivoslideranimation_speed, ._radium_nivoslider_transition').show();
  	}
  	 
 	//metroslider
	else if ( selectVal == 'metroslider' ) {
	
	 	jQuery(' #slide-content .slide-title, #slide-content .rwmb-image-url, #slide-content .video-embed, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slidershow_speed, div._radium_slideranimation_speed, div._radium_refineslider_transition, div._radium_refineslider_controls').hide();
	 	
		jQuery('#slide-content .slide-wysiwyg, #slider-slides .style-tab, #slider-slides .slide-nav-tab, #slide-content .slide-wysiwyg, div._radium_slider_controls, div._radium_slider_intervals').show();
			
	}   
	
	//radiumflex
	else if ( selectVal == 'radiumflex' ) {
	
		jQuery('.slide-nav-tab, .slide-style-tab, #slide-style .bg-settings .bg-image, #slide-style .preview-image, #slide-style .bg-settings .uploaded-image, #slide-style .bg-settings .upload-image, #slide-style .rwmb-input, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slidershow_speed, div._radium_slideranimation_speed, div._radium_refineslider_transition, div._radium_refineslider_controls').hide();

		jQuery('#slide-content .slide-wysiwyg, #slider-slides .style-tab,  #slide-style .rwmb-input.bgcolorpicker, #slide-style .rwmb-input.bgcolorpicker label, div._radium_slider_intervals, div._radium_slider_bgincrements').show();
		
	}   
	  
	 //RefineSlider
	 else if ( selectVal == 'refineslide' ) {
	 
	  	jQuery('.slide-nav-tab, .style-tab, #slide-content .slide-title, #slide-content .rwmb-image-url, #slide-content .slide-wysiwyg, #slide-content .video-embed, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slider_intervals').hide();
	 	jQuery ('._radium_refineslider_controls, ._radium_refineslider_transition, ._radium_slidershow_speed, ._radium_slideranimation_speed, ._radium_slider_autoplay').show();
	 	
	 } 

	 	
 	jQuery('select#_radium_slider_type').change(function() {
 	
 	   // assign the value to a variable, so you can test to see if it is working
 	    var selectVal = jQuery('#_radium_slider_type :selected').val();
  	    
 	    //alert(selectVal);
 	 	 jQuery('#slide-content .slide-wysiwyg, #slide-content .video-embed, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_hide_content, ._radium_content_carousel_pt, ._radium_refineslider_controls, ._radium_refineslider_transition, ._radium_slidershow_speed, ._radium_slideranimation_speed, ._radium_nivoslidershow_speed, ._radium_nivoslideranimation_speed, ._radium_nivoslider_transition').hide();
 	
      //accordion
     	 if ( selectVal == 'accordion' ) {
     	 
     	 	jQuery('.slide-nav-tab, .style-tab, slide-content .slide-wysiwyg, #slide-content .video-embed, ._radium_slider_autoplay, ._radium_slider_width,  div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_hide_content').hide();
     	    		
     	    jQuery ('#slide-content .slide-title, #slide-content .rwmb-image-url').show();
     	         	 	
     	 }
     	 
     	  //content-carousel
     	 if ( selectVal == 'content-carousel' ) {
     	 
     	 	jQuery('.slide-nav-tab, .style-tab, #slide-content .slide-title, #slide-content .slide-wysiwyg, #slide-content .video-embed, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slider_intervals, div._radium_slider_bgincrements, div._radium_refineslider_transition, div._radium_refineslider_controls').hide();
   			jQuery (' ._radium_content_carousel_pt').show();
     	 	
     	 }
     	 
     	  //featured-content
     	 if ( selectVal == 'featured-content' ) {
     	 
    		jQuery(' #slider-slides, #add-slider-slide, ._radium_slider_slides h2, ._radium_slideranimation_speed, ._radium_nivoslider_transition, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slider_intervals, div._radium_slider_bgincrements, div._radium_refineslider_transition, div._radium_refineslider_controls').hide();
     	 	jQuery (' ._radium_content_carousel_pt').show();
     	 	
     	 }
     	 
     	 //Flexislider
     	if ( selectVal == 'flexslider' ) {
     	
     	 	jQuery('#slide-content .slide-wysiwyg, .slide-button-tab, #slide-content .video-embed, div._radium_slider_autoplay, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slidershow_speed, div._radium_slideranimation_speed').show();
     	 	
     	   	jQuery('div._radium_slider_intervals, div._radium_slider_bgincrements, div._radium_refineslider_controls, div._radium_refineslider_transition').hide();
     		
     	}
     	
      	//Nivoslider
      	else if ( selectVal == 'nivoslider' ) {
      	
      	 	jQuery('.slide-nav-tab, .style-tab, #slide-content .slide-title, #slide-content .rwmb-image-url, #slide-content .slide-wysiwyg, #slide-content .video-embed, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_hide_content').hide();
      		
      		jQuery ('#slide-content .rwmb-image-url, ._radium_nivoslidershow_speed, ._radium_nivoslideranimation_speed, ._radium_nivoslider_transition').show();
      	}
      	 
     	//metroslider
    	else if ( selectVal == 'metroslider' ) {
    	
    	 	jQuery(' #slide-content .slide-title, #slide-content .rwmb-image-url, #slide-content .video-embed, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slidershow_speed, div._radium_slideranimation_speed, div._radium_refineslider_transition, div._radium_refineslider_controls').hide();
    	 	
    		jQuery('#slide-content .slide-wysiwyg, #slider-slides .style-tab, #slider-slides .slide-nav-tab, #slide-content .slide-wysiwyg, div._radium_slider_controls, div._radium_slider_intervals').show();
    			
    	}   
    	
    	//radiumflex
    	else if ( selectVal == 'radiumflex' ) {
    	
    		jQuery('.slide-nav-tab, .slide-style-tab, #slide-style .bg-settings .bg-image, #slide-style .preview-image, #slide-style .bg-settings .uploaded-image, #slide-style .bg-settings .upload-image, #slide-style .rwmb-input, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slidershow_speed, div._radium_slideranimation_speed, div._radium_refineslider_transition, div._radium_refineslider_controls').hide();
    
    		jQuery('#slide-content .slide-wysiwyg, #slider-slides .style-tab,  #slide-style .rwmb-input.bgcolorpicker, #slide-style .rwmb-input.bgcolorpicker label, div._radium_slider_intervals, div._radium_slider_bgincrements').show();
    		
    	}   
    	  
    	 //RefineSlider
    	 else if ( selectVal == 'refineslide' ) {
    	 
    	  	jQuery('.slide-nav-tab, .style-tab, #slide-content .slide-title, #slide-content .rwmb-image-url, #slide-content .slide-wysiwyg, #slide-content .video-embed, div._radium_slider_transition, div._radium_slider_pause_on_hover, div._radium_slider_controls, div._radium_slider_hide_content, div._radium_slider_intervals').hide();
    	 	jQuery ('._radium_refineslider_controls, ._radium_refineslider_transition, ._radium_slidershow_speed, ._radium_slideranimation_speed, ._radium_slider_autoplay').show();
    	 	
    	 } 
    		  	
 	});
 
 });