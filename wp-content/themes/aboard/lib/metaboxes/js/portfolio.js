/*-----------------------------------------------------------------------------------

 	Custom JS - All back-end jQuery 
 	
 	http://goo.gl/fc9GP
 	
	Portfolio Custom Fields Hide/Show
/*----------------------------------------------------------------------------------*/
 
jQuery(document).ready(function() {

    var portfolioTypeTrigger = jQuery('#_radium_portfolio_type'),
    
        portfolioImage = jQuery('#portfolio-images'),
        portfolioVideo = jQuery('#portfolio-video'),
        portfolioAudio = jQuery('#portfolio-audio');
        
        currentType = portfolioTypeTrigger.val();
        
    radiumSwitchPortfolio(currentType);

    portfolioTypeTrigger.change( function() {
    
       currentType = jQuery(this).val();
       radiumSwitchPortfolio(currentType);
       
    });
    
    function radiumSwitchPortfolio(currentType) {
    
        if( currentType === 'audio' ) {
            radiumHideAllPortfolio(portfolioAudio);
        } else if( currentType === 'video' ) {
            radiumHideAllPortfolio(portfolioVideo);
        } else {
            radiumHideAllPortfolio(portfolioImage);
        }
        
    }
    
    function radiumHideAllPortfolio(notThisOne) {
    
		portfolioImage.css('display', 'none');
		portfolioVideo.css('display', 'none');
		portfolioAudio.css('display', 'none');
		notThisOne.css('display', 'block');
		
	}

});