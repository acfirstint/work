<?php
/**
 * Plugin Name:       FI Theme Settings
 * Plugin URI:        https://cookie.co.uk
 * Description:       Add custom settings to a Wordpress theme
 * Version:           0.4.1
 * Author:            Cookie
 * Author URI:        http://cookie.co.uk
 * Text Domain:       theme-settings
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /ac
 * GitHub Plugin URI: https://github.com/fi/theme-settings
 */
/**
 * https://wordpress.org/support/topic/manage_options-role-not-working-as-expected?replies=1#post-7514618
 */

class FI_Theme_Settings {

    function __construct() {
        add_action('admin_menu', array(&$this, 'fi_create_menu'));
        add_action('admin_init', array(&$this, 'fi_admin_init'));
       
    }
    
    public function fi_create_menu() {
        //add_menu_page($page_title, $menu_title, $capability, $menu_slug);
        add_menu_page('FI Theme Settings', 'FI Theme Settings', 'manage_options', 'fi-theme-settings', array($this, 'fi_file_path'), '
            dashicons-awards', 10);
        
    }
    
    public function fi_file_path() {
       /* if( !current_user_can('manage_opitons') ){
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }*/
        
        $screen = get_current_screen();
        if ( strpos( $screen->base, 'fi-theme-settings' ) !== false ) {
                include( dirname(__FILE__) . '/includes/fi-options.php' );
        }
        else {
                include( dirname(__FILE__) . '/includes/fi-options.php' );
        }
    }
    
    
    
   function fi_admin_init()
   {
        register_setting( 'theme_options', 'theme_options', array($this, 'theme_options_validate') );
        add_settings_section('plugin_main', 'Main Settings', array($this, 'plugin_section_text'), 'plugin');
        add_settings_field('plugin_text_string', 'Company Name:', array($this, 'fi_company_name_string'), 'plugin', 'plugin_main');
        
   }
   
   
   function theme_options_validate($input) {
       $options = get_option('theme_options');
        $options['company_name'] = trim($input['company_name']);
        if(!preg_match('/^[a-z0-9]{32}$/i', $options['company_name'])) {
            $options['company_name'] = '';
        }
        return $options;
   }
   
   
   function plugin_section_text() {
       echo "<p>Company Information</p>";
   }
   /**
    * 
    */
   function fi_company_name_string() {
      $options = get_option('theme_options');
      echo "<input id='fi_setting_string' name='theme_options[company_name]'  size='40' type='text' value='{$options['company_name']}'>";
   }
    

}

new FI_Theme_Settings();


