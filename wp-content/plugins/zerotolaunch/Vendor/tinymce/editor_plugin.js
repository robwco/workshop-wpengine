(function() {
    tinymce.create('tinymce.plugins.optinshortcode', {
        init: function(ed, url) {

            ed.addCommand('mceoptinshortcode', function() {
                ed.windowManager.open({
// call content via admin-ajax, no need to know the full plugin path
                    file: ajaxurl + '?action=optinshortcode_tinymce',
                    width: 500 + ed.getLang('optinshortcode.delta_width', 0),
                    height: 400 + ed.getLang('optinshortcode.delta_height', 0),
                    inline: 1
                }, {
                    plugin_url: url // Plugin absolute URL
                });
            });

// Register example button
            ed.addButton('optinshortcode', {
                title: 'Optin Shortcodes',
                cmd: 'mceoptinshortcode',
                image: url + '/key_t.png'
            });

// Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('optinshortcode', n.nodeName == 'IMG');
            });
        }
    });

// Register plugin
    tinymce.PluginManager.add('optinshortcode', tinymce.plugins.optinshortcode);
})();

