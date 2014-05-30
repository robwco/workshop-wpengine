<script type='text/javascript' src='/wp-admin/load-scripts.php?c=1&amp;load%5B%5D=jquery-core,jquery-migrate,utils,editor,plupload,plupload-html5,plupload-flash,plupload-silverlight,plupload-html4,json2,jquery-&amp;load%5B%5D=ui-core,jquery-ui-widget,jquery-ui-mouse,jquery-ui-sortable&amp;ver=3.8.3'></script>
<script type='text/javascript' src='/wp-content/plugins/zerotolaunch/assets/js/admin.js?ver=3.8.3'></script>
<script type='text/javascript' src='/wp-content/plugins/zerotolaunch/assets/js/ckeditor/ckeditor.js?ver=3.8.3'></script>
<script type='text/javascript' src='/wp-content/plugins/zerotolaunch/assets/js/moveit.js?ver=3.8.3'></script>
<script type='text/javascript' src='/wp-content/plugins/zerotolaunch/assets/js/admin-popup-preview.js?ver=3.8.3'></script>
<script src="/wp-content/plugins/zerotolaunch/assets/js/ckeditor/adapters/jquery.js"></script>
<script>

jQuery(function ($) {


	// Add the New Buttons and functionality for our "Add Image" button
	// --------------------------------------------------------
	CKEDITOR.plugins.add('newplugin', {
		init: function (editor) {
			var pluginName = 'newplugin';
			editor.ui.addButton('Newplugin',
				{
					label: 'Insert Image',
					command: 'InsertImage',
					icon: '/wp-content/plugins/zerotolaunch/assets/js/ckeditor/skins/moono/' + 'icons.png',
					iconOffset: -360
				});
			var cmd = editor.addCommand('InsertImage', { exec: function(e){

				var id = 'img' + new Date().getTime();
				e.insertHtml('<img data-toggle="editable" src="/wp-content/plugins/zerotolaunch/assets/images/placeholder_240x160.png" id="'+ id +'" />');
				$('#'+id).click();
			} });
		}
	});
	CKEDITOR.config.allowedContent = true
	CKEDITOR.config.extraPlugins = 'newplugin';
	CKEDITOR.config.removePlugins = 'image';

	// Function for recursing through and adding the CKEditor with the correct defaults
	// --------------------------------------------------------
	function attachCKEditor($el){
		var offset = $('#lpeditor').offset();
		$el.ckeditor({
			toolbar: [["Bold", "Italic", "Underline", "Strike", "-", "NumberedList","BulletedList","-","Outdent","Indent","Blockquote","CreateDiv", 'Newplugin']]
		});
	}
	attachCKEditor($('div[data-toggle="editableContent"]'));

	// Start the Delay media selector for replacing images, making sure that
	// Jquery is ready and loaded on both the parent and iframe
	// --------------------------------------------------------
	parent.delayMediaSelector();

	/**
	 * Get the HTML content from the editor and return as an object
	 *
	 */
	function getEditorContent(){
		return {
			header: CKEDITOR.instances['ZTLContentHeader'].getData(),
			body: CKEDITOR.instances['ZTLContentBody'].getData(),
			footer: CKEDITOR.instances['ZTLContentFooter'].getData(),
			logo_url: $('#ZTLContentLogo').attr('src')
		};
	}

	/**
	 * Set the HTML content of the editor from the given object
	 * @param editorContent
	 */
	function setEditorContent(editorContent){

		CKEDITOR.instances['ZTLContentHeader'].setData(editorContent.header);
		CKEDITOR.instances['ZTLContentBody'].setData(editorContent.body);
		CKEDITOR.instances['ZTLContentFooter'].setData(editorContent.footer);
		$('#ZTLContentLogo').attr('src', editorContent.logo_url);
	}

	/**
	 * Switch out which optin form in showing
	 * @param optinId
	 */
	function setOptinForm(optinId){
		if(optinId != 0){
			$("#ZTLOptinForm").load('?page=ztl-optin-page-settings&action=render_optin&id=' + optinId);
		}
	}

	// Attach the Get/Set commands to the parent div so that they can access
	// --------------------------------------------------------
	parent.getIframeEditorContent = getEditorContent;
	parent.setIframeEditorContent = setEditorContent;
	parent.setIframeOptinForm = setOptinForm;


	$('li.error').val(function() {

	});
});
</script>