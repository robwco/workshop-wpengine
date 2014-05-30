<form id="searchform" class="searchform" method="get" action="<?php echo get_home_url(); ?>">
    
    <div class="clearfix default_searchform">
    
        <input type="text" name="s" class="s" onblur="if (this.value == '') {this.value = '<?php _e('Type and hit enter...','radium'); ?>';}" 
        
        onfocus="if (this.value == '<?php _e('Type and hit enter...','radium'); ?>') {this.value = '';}" value="<?php _e('Type and hit enter...','radium'); ?>" />
    
        <button type="submit" class="button">
        	<span><?php _e('Submit', 'radium'); ?></span>
        </button>
    
    </div><!-- END .default_searchform -->
    
    <?php do_action('radium_search_form'); ?>

</form><!-- END #searchform -->

