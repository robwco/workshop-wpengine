jQuery( document ).ready( function($)  {

	var $slider = $('#slider-slides'),
		$slide  = $slider.children('.slide');
				
	// Fix for sortable jumping "bug"
	function adjustContainerHeight() {

		$slider.height('auto').height( $('#slider-slides').height() );

	}
	adjustContainerHeight();	

	// Add tabs
	function enableTabs() {

		$('.slider-slide-tabs').tabs({
			selected : 0,
			show     : function( event, ui ) {
				adjustContainerHeight();
			}
		});

	}
	enableTabs(); 
	
	//Color Picker
	function colorPickerInit() {
 
		$colorpicker_inputs = jQuery('input.popup-colorpicker');
	
		$colorpicker_inputs.each(
			function(){
				var $input = jQuery(this);
				var sIdSelector = "#" + jQuery(this).attr('id') + "picker";
				
				//alert(sIdSelector);
				
				var oFarb = jQuery.farbtastic(
						sIdSelector,
						function( color ){
		
							$input.css({
								backgroundColor: color,
								color: oFarb.hsl[2] > 0.5 ? '#000' : '#fff'
						}).val( color );
		
		
						if( oFarb.bound == true ){
							$input.change();
						}else{
							oFarb.bound = true;
						}
					}
				);
				oFarb.setColor( $input.val() );
		
			}
		);
		
		$colorpicker_inputs.each(function(e){
			jQuery(this).next('.farb-popup').hide();
		});
		
		$colorpicker_inputs.live('focus',function(e){
			jQuery(this).next('.farb-popup').show();
			
			jQuery(this).parents('.farb-popup').css({
				position : 'relative',
				zIndex : '9999'
			})
			
			jQuery('#slider-slides .slider-slide-tabs .tabs-content').css({overflow:'visible'});
		
		});
		
		$colorpicker_inputs.live('blur',function(e){
			jQuery(this).next('.farb-popup').hide();
		
			jQuery(this).parents('.farb-popup').css({
				zIndex : '0'
			})
		
		});
	    
	}
	colorPickerInit();
	   
	//Update Image thumb with input
	/*function updateSliderImage(){
	
 		$slide.( 'img.img-preview').attr('src', $slide.('input[type="text"]').val() );
 	
	}
	updateSliderImage();*/
	
	var c = $('.slide').last().attr('data-slide');
		
	// Add slide
	$('#add-slider-slide').click(function( e ) {

		$slider.height('auto');
 			  		     
		var $cloneElem = $slider.children('.slide').last().clone();

		$cloneElem.removeClass('closed')
				  .children('.inside').show().end()
				  .find('.button-type').hide().end()
				  .find('.button-type.text').show().end()
 				  .find('select').val('').end()
				  .find('input[type=text]').val('').end()
				  .find('textarea').val('').end()
				  .find('img.img-preview').attr('src','').end()
				  .attr('id', 'slide_'+(++c) ).attr('data-slide', (c) )
				  .find('input.popup-colorpicker').attr('id', (c) ).end()
				  .find('div.color-picker').attr('id', (c)+'picker' ).end()
 				  .insertAfter( $slider.children('.slide').last() );

		enableTabs();
		adjustContainerHeight();
		colorPickerInit();	
		
		e.preventDefault();
	});

	// Delete slide
	$slider.on('click', '.remove-slide', function( e ) {

		if( $slider.children('.slide').length == 1 ) {

			alert('You need to have at least 1 slide!');

		} else {

			$(this).parents('.slide').remove();
			adjustContainerHeight();
		}

		e.preventDefault();
	});

	// Sortable slides
	$slider.sortable({
		handle      : 'h3.hndle',
		placeholder : 'sortable-placeholder',
		sort        : function( event, ui ) {
			$('.sortable-placeholder').height( $(this).find('.ui-sortable-helper').height() );
		},
		tolerance   :'pointer'
	});

	// Toggle slide with header click
	$slider.on('click','.hndle',  function() {

		$(this).siblings('.inside').toggle().end().parent().toggleClass('closed');

		adjustContainerHeight();

	});

	// Toggle slide with arrow click
	$slider.on('click','.handlediv', function() {

		$(this).siblings('.hndle').trigger('click');

	});

	// Upload image
	$slider.on('click', '.upload-image',  function( e ){

		var $this   = $(this),
 			data    = $('input[name="slider-meta-info"]').val().split('|'),
			postId  = data[0],
			fieldId = data[1],
			tbframeInterval;

		// Open Thickbox
		tb_show('', 'media-upload.php?post_id='+postId+'&field_id='+fieldId+'&type=image&TB_iframe=true&width=670&height=600');

		// Change button label, once it exist
		tbframeInterval = setInterval(function() {

			$('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');

		}, 1000);

		// Send img url
		window.send_to_editor = function(html) {

			clearInterval( tbframeInterval );

			var imgUrl = $('img', html).attr('src');

			$this.siblings('input[type="text"]').val( imgUrl );
			
			tb_remove();
			
			/** Delay the processing of the image link until thickbox has closed */
			var timeout = setTimeout(function() {
				$this.siblings('.preview-image').children( 'img.img-preview').attr('src', $this.siblings('input[type="text"]').val() );
			}, 1500); // End timeout function
   
		};

		e.preventDefault();
		
			
	});
 	    
});


