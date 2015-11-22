<?php

require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );
require_once( ABSPATH . WPINC . '/class-wp-customize-manager.php' );

add_action ('admin_menu', 'cookie_admin');
function cookie_admin() {
    // add the Customize link to the admin menu
    add_theme_page( 'FI Customize', 'FI Customize', 'edit_theme_options', 'customize.php' );
}

class FI_Customize_Textarea_Control extends WP_Customize_Control {
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

add_action('customize_register', 'fi_theme_customize');
function fi_theme_customize($wp_customize) {
 
    $wp_customize->add_section( 'company_settings', array(
        'title'          => 'Company Info',
        'priority'       => 35,
    ) );
 
    $wp_customize->add_setting( 'tagline', array(
        'default'        => 'default_value',
    ) );
 
    $wp_customize->add_control( 'tagline', array(
        'label'   => 'Tagline',
        'section' => 'company_settings',
        'type'    => 'text',
    ) );
 
    $wp_customize->add_setting( 'some_other_setting', array(
        'default'        => '#ff0000',
    ) );
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'some_other_setting', array(
        'label'   => 'Color Setting',
        'section' => 'company_settings',
        'settings'   => 'some_other_setting',
    ) ) );
    
    
    // Address info
    $wp_customize->add_setting( 'company_address', array(
        'default'        => 'Address details...',
    ) );

    $wp_customize->add_control( new FI_Customize_Textarea_Control( $wp_customize, 'company_address', array(
        'label'   => 'Address',
        'section' => 'company_settings',
        'settings'   => 'company_address',
    ) ) );
    
    
 
}







