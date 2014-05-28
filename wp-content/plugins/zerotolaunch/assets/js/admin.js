var ZTL = ZTL || {
	// checkbox is a jquery wrapped checkbox and element is a jquery
	// wrapped element to show and hide when the checkbox is checked/unchecked

	linkDisplayToCheckbox: function(checkbox, element, options) {
		var inverse = false;

		if (options && options.inverse) {
			inverse = options.inverse
		}

		checkbox.on("change", function (event) {
			element.toggle(checkbox[0].checked ^ inverse);
		});
	},

	custom_file_frame: null,

	// basically the poor man's tabs since jquery tabs don't quite work with how WP
	// styles its tabs. Ideally we'd not need this, or could wrap the jquery ui tabs code.
	tabs: function(containerSelector, selectCallback) {
		var container = jQuery(containerSelector),
			tabs = container.find('.nav-tab-wrapper a'),
			selectedTab = container.find('.nav-tab-wrapper .nav-tab-active'),
			tabContent = container.find('.tab-content');

		tabContent.not('.tab-content-active').hide();

		tabs.on('click', function(event) {
			event.preventDefault();

			selectedTab = jQuery(this);

			tabs.removeClass("nav-tab-active");

			selectedTab.addClass("nav-tab-active");

			if (selectCallback) {
				selectCallback(container, tabs, selectedTab);
			} else {
				tabContent.hide();

				if (selectedTab.length > 0) {
					jQuery(selectedTab[0].getAttribute('href')).show();
				}
			}
		});
	},

	slugify: function(title) {
		var slug = jQuery.trim(title.toLowerCase().replace(/[^a-z0-9\s_-]+/g, ''));

		return slug.replace(/\s+/g, ' ').replace(/\s/g, '-');
	},

	// From http://www.lenslider.com/articles/wordpress-3-5-media-uploader-tips-on-using-it-within-plugins/
	promptMediaSelection: function(selector, selectCallback, options) {
		if (options == undefined) {
			options = {};
		}

		jQuery(document).on('click', selector, function (event) {
			event.preventDefault();

			//If the frame already exists, reopen it
			if (typeof(custom_file_frame) !== "undefined") {
				custom_file_frame.close();
			}

			//Create WP media frame.
			custom_file_frame = wp.media.frames.customHeader = wp.media({
				//Title of media manager frame
				title: options['title'] || "Select an image",
				library: {
					type: options['type'] || 'image'
				},
				button: {
					//Button text
					text: options['button_text'] || "Use selected image"
				},
				//Do not allow multiple files, if you want multiple, set true
				multiple: false
			});

			//callback for selected image
			custom_file_frame.on('select', function () {
				var attachment = custom_file_frame.state().get('selection').first().toJSON();

				selectCallback(attachment);

				// refresh our max-width to be 100% so that the new image is not distorted.
				$(selector).css('max-width', '100%');

				//do something with attachment variable, for example attachment.filename
				//Object:
				//attachment.alt - image alt
				//attachment.author - author id
				//attachment.caption
				//attachment.dateFormatted - date of image uploaded
				//attachment.description
				//attachment.editLink - edit link of media
				//attachment.filename
				//attachment.height
				//attachment.icon - don't know WTF?))
				//attachment.id - id of attachment
				//attachment.link - public link of attachment, for example ""http://site.com/?attachment_id=115""
				//attachment.menuOrder
				//attachment.mime - mime type, for example image/jpeg"
				//attachment.name - name of attachment file, for example "my-image"
				//attachment.status - usual is "inherit"
				//attachment.subtype - "jpeg" if is "jpg"
				//attachment.title
				//attachment.type - "image"
				//attachment.uploadedTo
				//attachment.url - http url of image, for example "http://site.com/wp-content/uploads/2012/12/my-image.jpg"
				//attachment.width
			});

			//Open modal
			custom_file_frame.open();
		});
	}

}

jQuery(function ($) {
	// Add confirm befor deleting dialogs to forms with the ".ztl-confirm-delete" class.
	// A "data-name" attribute should be on the form to indicate what the user should be prompted for?
	// For example, data-name="Optin 1" would display something like 'Are you sure that you want to delete "Optin 1"?'
	$('form.ztl-confirm-delete').on('submit', function (e) {
		var formName = e.delegateTarget.getAttribute('data-name');

		if (window.confirm('Are you sure that you want to delete "' + formName + '"')) {
			// since we confirmed via JS, no need to confirm via the server
			e.delegateTarget.action = e.delegateTarget.action.replace("confirm_delete", "delete");
		} else {
			// stop the submittal
			return false;
		}
	});

	
});
