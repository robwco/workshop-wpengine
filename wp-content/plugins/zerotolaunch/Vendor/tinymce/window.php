<?php
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-widget');
wp_enqueue_script('jquery-ui-position');
wp_enqueue_script('jquery');
global $wp_scripts;
global $wpdb;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Choose Opt-in Form</title>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
        <script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo '../wp-content/plugins/zerotolaunch/Vendor/tinymce/optinshortcodetinymce.js'; ?>"></script>
        <base target="_self" />
        <?php wp_print_scripts(); ?>

        <style>
        #optlist { list-style-type: none; margin: 0; padding: 0; }
        #optlist li { float: left; width: 95%; padding: 10px; border-bottom: solid 1px #f2f2f2 ; }
        #optlist li:hover { background: #f2f2f2 ; cursor:pointer;}
        #optlist li img {float: right; }
        </style>
    </head>
    <?php
    $optinForms = $wpdb->get_results('SELECT id , slug, mailing_list_id, name , theme FROM wp_ztl_plugin_optin_forms');
    ?>
    <body id="link">
       
            <table border="0" cellpadding="4" cellspacing="0">
                <tr>
                    <td>
                       <?php

                        echo '<ul id="optList">';
                        foreach ($optinForms as $optin) {
                            echo '<li onClick="insertoptinshortcode(\''. $optin->slug.'\');">' .  $optin->name . '<img src="../wp-content/plugins/zerotolaunch/themes/optin-forms/' . ($optin->theme == 'demo' ? 'gray-blue' : $optin->theme) . '/thumbnail.png" height="75px" alt="Thumbnail" /></li>';
                        }
                        echo '</ul>';
                        ?>
                    </td>
                </tr>
            </table>
    </body>
</html>
