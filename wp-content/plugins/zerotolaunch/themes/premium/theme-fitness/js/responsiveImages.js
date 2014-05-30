/**
 * Simple jQuery plugin to handle responsive images.
 */
(function(window, document, $, undefined){
	$.fn.responsiveImages = function (options) {

		var settings = $.extend({
				parent: null
			}, options );

		var resize_repsonsive_image = function() {
			var $img = $(this);

			$img.css({
				'minHeight' : 0,
				'maxHeight' : 'none',
				'minWidth' : 0,
				'maxWidth' : 'none'
			});
			
			if (settings['parent'] === null) {
				var win_width = $(window).width(),
					win_height = $(window).height();
			} else {
				var win_width = $img.parents(settings['parent']).width(),
					win_height = $img.parents(settings['parent']).height();
			};

			var img_width = $img.attr('width');
			var img_height = $img.attr('height');

			if (img_width === undefined || img_height === undefined) {
				$img.css({
					left : '',
					top: '',
					width: '',
					height: ''
				});

				img_width = $img.width();
				img_height = $img.height();
			}

			var img_dimensions_ratio = img_height / img_width;

			if ( win_height / win_width > img_dimensions_ratio ) {
				$img.height(win_height).width(win_height / img_dimensions_ratio);
			} else {
				$img.width(win_width).height(win_width * img_dimensions_ratio);
			}

			$img.css({
				'left': (win_width - $img.width()) / 2,
				'top':  (win_height - $img.height() ) /2
			});
		}

		var images = this;
		$(window).on('resize load', function () {
			images.each(resize_repsonsive_image);
		});
		return this.each(resize_repsonsive_image);
	}

})(window, document, jQuery);