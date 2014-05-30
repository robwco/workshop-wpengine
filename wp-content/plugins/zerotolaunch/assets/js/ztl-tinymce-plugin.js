(function() {
	tinymce.create('tinymce.plugins.AddYourOptin', {
		init : function(ed, url) {
			ed.addButton('addyouroptin', {
				title : 'addyouroptin.addoptin',
				image : url+'/tinymce-icon.gif',
				onclick : function() {
						// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'My Gallery Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=test' );
					}
			});
			
			ed.onNodeChange.add(function(ed, cm, n) {
                if (ed.nodeName == 'A')
             	cm.setActive('link', true);
            });
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	tinymce.PluginManager.add('addyouroptin', tinymce.plugins.AddYourOptin);

	// executes this when the DOM is ready
	jQuery(function(){
	// creates a form to be displayed everytime the button is clicked
	// you should achieve this using AJAX instead of direct html code like this
	jquery(responce).find('#testID').click(function() {
		console.log('test');
		tb_remove();
	});

	

	
	});

	// executes this when the DOM is ready
	function addShortcode(){
		
		alert('hello!');
	
	}
	//var shortcode = '[shorcodes are super sweet]';

	// inserts the shortcode into the active editor
	//tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
})();
