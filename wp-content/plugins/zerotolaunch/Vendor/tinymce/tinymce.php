<?php
/**
 * add_themedelta_button
 *
 * @package themedelta
 * @title TinyMCE V3 Button Integration (for WP2.5 and higher)
 *
 *
 * @access public
 */
class add_optinshortcode_button {

    var $pluginname = 'optinshortcode';
    var $path = '';
    var $internalVersion = 200;
    /**
     * add_themedelta_button::add_themedelta_button()
     * the constructor
     *
     * @return void
     */
    function add_optinshortcode_button() {
        // Set path to editor_plugin.js
        $this->path =  ZTL_PLUGIN_PATH . '/Vendor/tinymce/';

        // Modify the version when tinyMCE plugins are changed.
        add_filter('tiny_mce_version', array(&$this, 'change_tinymce_version'));

        // init process for button control
        add_action('init', array(&$this, 'addbuttons'));
    }

    /**
     * add_themedelta_button::addbuttons()
     *
     * @return void
     */
    function addbuttons() {
        // Don't bother doing this stuff if the current user lacks permissions
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
            return;
        // Check for themedelta capability
        // if ( !current_user_can('themedelta Use TinyMCE') )
        // return;
        // Add only in Rich Editor mode
        if (get_user_option('rich_editing') == 'true') {

            // add the button for wp2.5 in a new way
            add_filter("mce_external_plugins", array(&$this, 'add_tinymce_plugin'), 5);
            add_filter('mce_buttons', array(&$this, 'register_button'), 5);
        }
    }

    /**
     * add_themedelta_button::register_button()
     * used to insert button in wordpress 2.5x editor
     *
     * @return $buttons
     */
    function register_button($buttons) {
        array_push($buttons, 'separator', $this->pluginname);
        return $buttons;
    }

    /**
     * add_themedelta_button::add_tinymce_plugin()
     * Load the TinyMCE plugin : editor_plugin.js
     *
     * @return $plugin_array
     */
    function add_tinymce_plugin($plugin_array) {
        $plugin_array[$this->pluginname] = plugins_url('/editor_plugin.js', __FILE__);
        return $plugin_array;
    }

    /**
     * add_themedelta_button::change_tinymce_version()
     * A different version will rebuild the cache
     *
     * @return $versio
     */
    function change_tinymce_version($version) {
        $version = $version + $this->internalVersion;
        return $version;
    }
}

// Call it now
$tinymce_button = new add_optinshortcode_button();
?>