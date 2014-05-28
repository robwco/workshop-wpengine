jQuery(function($) {

	$( '.content .post' ).find( 'iframe' ).wrap( '<div class="video" />' );

	// Mobile
	var $bioImage = $( '.container .home-main' ).find( 'img:first' );
	$bioImage.clone().addClass('mobile').insertAfter( '.home-main h4' );

	$(document).on('focusin', '.field, input:text, textarea', function() {
		if(this.title==this.value) {
			this.value = '';
		}
		$(this).parents('.gfield').find('.gfield_label').hide();
	}).on('focusout', '.field, input:text, textarea', function(){
		if(this.value=='') {
			this.value = this.title;
			$(this).parents('.gfield').find('.gfield_label').show();
		}
	});
	
	$('.field, input:text, textarea').each(function() {
		if(this.value!='') {
			$(this).parents('.gfield').find('.gfield_label').hide();
		}
	});

	$('.banner .bg').responsiveImages({
		parent: '.banner'
	});
	
	$('.nav-toggle').on('click touchstart' , function(event) {

		$('.navigation').toggleClass('open');

		event.preventDefault();
	});

});