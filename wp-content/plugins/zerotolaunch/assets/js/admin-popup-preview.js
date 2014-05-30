var ZTLAdminPopupPreview;

jQuery(function($) {
	ZTLAdminPopupPreview = function(url, popupWrapper) {
		$.ajax(url, {
			data: {
				id: $('#selectOptinForm option:selected').val()
			},
			type: 'GET',
			async : false,
			success: function(e) {
				popupWrapper.html(e);
				$.fancybox('#popup-container', {
					fitToView : false,
					autoSize : false,
					closeClick : false,
					openEffect : 'fade',
					closeEffect : 'none',
					padding : 0,
					margin : 0,
					width: 586,
					height: 380,
					scrolling : 'auto',
					beforeLoad : function() {

					},
					afterShow: function(e){
						var calculatedHeight = popupWrapper.height();
						this.height = calculatedHeight;
					}
				});
			}
		});
	};
});