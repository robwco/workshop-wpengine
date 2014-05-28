<?php

// ------------- Theme Customizer  ------------- //
 
add_action( 'customize_register', 'okay_theme_customizer_register' );

function okay_theme_customizer_register($wp_customize) {
	
	class Okay_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}
	
	//Verb Style Options

	$wp_customize->add_section( 'okay_theme_customizer_basic', array(
		'title' => __( 'Verb Styling', 'okay' ),
		'priority' => 100
	) );
	
	//Logo Image
	$wp_customize->add_setting( 'okay_theme_customizer_logo', array(
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'okay_theme_customizer_logo', array(
		'label' => __( 'Logo Upload', 'okay' ),
		'section' => 'okay_theme_customizer_basic',
		'settings' => 'okay_theme_customizer_logo'
	) ) );
	
	//Accent Color
	$wp_customize->add_setting( 'okay_theme_customizer_accent', array(
		'default' => $options['of_colorpicker']['std']
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'okay_theme_customizer_accent', array(
		'label'   => __( 'Accent Color', 'okay' ),
		'section' => 'okay_theme_customizer_basic',
		'settings'   => 'okay_theme_customizer_accent'
	) ) );
	
	//Block Titles
	$wp_customize->add_setting( 'okay_theme_customizer_blocks_title', array(
        'default' => '',
    ) );
 
    $wp_customize->add_control( 'okay_theme_customizer_blocks_title', array(
        'label'   => 'Blocks Title',
        'section' => 'okay_theme_customizer_basic',
        'type'    => 'text',
    ) );
    
    $wp_customize->add_setting( 'okay_theme_customizer_blocks_subtitle', array(
        'default' => '',
    ) );
 
    $wp_customize->add_control( 'okay_theme_customizer_blocks_subtitle', array(
        'label'   => 'Blocks Subtitle',
        'section' => 'okay_theme_customizer_basic',
        'type'    => 'text',
    ) );
    
    //Custom CSS
	$wp_customize->add_setting( 'okay_theme_customizer_css', array(
        'default' => '',
    ) );
    
    $wp_customize->add_control( new Okay_Customize_Textarea_Control( $wp_customize, 'okay_theme_customizer_css', array(
	    'label'   => 'Custom CSS',
	    'section' => 'okay_theme_customizer_basic',
	    'settings'   => 'okay_theme_customizer_css',
	) ) );
	
}