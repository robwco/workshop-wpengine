jQuery(document).ready(function($){
	//if a popup div dom exists 
	ZtlPluginUser.initialize();
	//console.log('numOfVisits: '+ZtlPluginUser.data.numOfVisits);
	
	if ($('#ztl-plugin-popup').length > 0) {
		
		var ZtlPluginPopup = ZtlPluginPopup || {
		};
		
		//optinSettings is set somewhere in wp_footer action
		var wait = optinSettings.time_to_popup * 1000;
		setTimeout(function(){
			ZtlPluginPopup.timeout = (ZtlPluginPopup.timeout > wait) ? ZtlPluginPopup.timeout - wait : 100;
			ZtlPluginPopupRun();
		}, wait);

		function ZtlPluginPopupRun(){
			
			var showPopup = false;
			
			var numTimesPitched = ZtlPluginUser.data.numTimesPitched;
			var numOfVisits = ZtlPluginUser.data.numOfVisits;
			if (numOfVisits >= optinSettings.page_delay && numTimesPitched == 0) {
				showPopup = true;
			}
			
			var today = new Date();
			//var today = ZtlPluginUser.daysToDate(6);
			//ZtlPluginUser.printTimeStamp('today', today);
			
			
			if (!showPopup) {
				if (numTimesPitched > 0) {
					var lastPitch = ZtlPluginUser.data.lastPitchDate;
					var days = ZtlPluginUser.daysBetween(lastPitch, today);
										
					if (days >= optinSettings.timeout_in_days) {
						showPopup = true;
					}
				}
			}
					
			if (showPopup) {
				ZtlPluginUser.data.numTimesPitched++;
				ZtlPluginUser.data.lastPitchDate = today;
				ZtlPluginUser.cookie.write();
				
				$.fancybox('#ztl-plugin-popup', {
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
			            var slug = optinSettings.slug;
			            var optinFormID = optinSettings.id;

		                jQuery('.ztl-optin-form').each(function(){
		                    var hiddenInputType = jQuery(this).find('input[name=type]').val();
		                    if (hiddenInputType == "popup") {
		                        jQuery.get("?logView="+slug+"&id="+optinFormID+"&type=popup&uid="+$.now());
		                    }
		                });
					},
					afterShow: function(e){
						var optinForm = $('#ztl-plugin-popup');
						optinForm.show();	
									
						var calculatedHeight = optinForm.height();
						optinForm.removeAttr('style');
						
						this.height = calculatedHeight;
					}
				});
			}
		}
	}
});