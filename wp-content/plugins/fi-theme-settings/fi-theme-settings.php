<?php
/**
 * Plugin Name:       AC Theme Settings
 * Plugin URI:        https://cookie.co.uk
 * Description:       Add custom settings to a Wordpress theme
 * Version:           0.4.1
 * Author:            M32 Websites
 * Author URI:        https://cookie.co.uk
 * Text Domain:       theme-settings
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /ac
 * GitHub Plugin URI: https://github.com/fi/theme-settings
 */

/**
 * http://www.sitepoint.com/wordpress-options-panel/
 */


class FI_theme_settings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'AC Theme Settings', 
            'manage_options', 
            'fi-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'fi_theme_options' );
        ?>
        <div class="wrap">
            <h2>First Internet Theme Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'fi_theme_option_group' );   
                do_settings_sections( 'fi-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'fi_theme_option_group', // Option group
            'fi_theme_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'fi-setting-admin' // Page
        );  

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'fi-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'title', 
            'Title', 
            array( $this, 'title_callback' ), 
            'fi-setting-admin', 
            'setting_section_id'
        );  
        
        add_settings_field(
            'company_name', 
            'Company Name', 
            array( $this, 'company_name_callback' ), 
            'fi-setting-admin', 
            'setting_section_id'
        );      
        add_settings_field(
            'company_phone', 
            'Company Phone', 
            array( $this, 'company_phone_callback' ), 
            'fi-setting-admin', 
            'setting_section_id'
        );      
        add_settings_field(
            'company_lat', 
            'Company Latitude', 
            array( $this, 'company_latitude_callback' ), 
            'fi-setting-admin', 
            'setting_section_id'
        );      
        add_settings_field(
            'company_long', 
            'Company Longitude', 
            array( $this, 'company_longitude_callback' ), 
            'fi-setting-admin', 
            'setting_section_id'
        );      
        add_settings_field(
            'has_sidebar', 
            'Template Has Sidebar', 
            array( $this, 'template_sidebar_callback' ), 
            'fi-setting-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );
        
        if( isset( $input['company_name'] ) )
            $new_input['company_name'] = sanitize_text_field( $input['company_name'] );
        
        if( isset( $input['company_phone'] ) )
            $new_input['company_phone'] = sanitize_text_field( $input['company_phone'] );
        
        if( isset( $input['company_lat'] ) )
            $new_input['company_lat'] = sanitize_text_field( $input['company_lat'] );
        
        if( isset( $input['company_long'] ) )
            $new_input['company_long'] = sanitize_text_field( $input['company_long'] );
        
        if( isset( $input['has_sidebar'] ) )
            $new_input['has_sidebar'] = sanitize_text_field( $input['has_sidebar'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="fi_theme_options[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="fi_theme_options[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }
    
    public function company_name_callback()
    {
        printf(
            '<input type="text" id="company_name" name="fi_theme_options[company_name]" value="%s" />',
            isset( $this->options['company_name'] ) ? esc_attr( $this->options['company_name']) : ''
        );
    }
    
    public function company_phone_callback()
    {
        printf(
            '<input type="text" id="company_phone" name="fi_theme_options[company_phone]" value="%s" />',
            isset( $this->options['company_phone'] ) ? esc_attr( $this->options['company_phone']) : ''
        );
    }
    
    public function company_latitude_callback()
    {
        printf(
            '<input type="text" id="company_lat" name="fi_theme_options[company_lat]" value="%s" />',
            isset( $this->options['company_lat'] ) ? esc_attr( $this->options['company_lat']) : ''
        );
    }
    public function company_longitude_callback()
    {
        printf(
            '<input type="text" id="company_long" name="fi_theme_options[company_long]" value="%s" />',
            isset( $this->options['company_long'] ) ? esc_attr( $this->options['company_long']) : ''
        );
    }
    
 
    
    public function template_sidebar_callback()
    {
       // $value = isset( $this->options['has_sidebar'] ) ? esc_attr( $this->options['has_sidebar']) : '';
        print '<input type="radio" id="has-sidebar_y" name="fi_theme_options[has_sidebar]" value="1" '.checked( $this->options['has_sidebar'], 1, false ).' /> Yes';
        print '<input type="radio" id="has-sidebar_n" name="fi_theme_options[has_sidebar]" value="0" '. checked( $this->options['has_sidebar'], 0, false ).' /> No';
    }
    
    
    
    
}

if( is_admin() )
    $my_settings_page = new FI_theme_settings();

