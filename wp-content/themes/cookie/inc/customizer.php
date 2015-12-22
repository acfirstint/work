<?php

    require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );
    require_once( ABSPATH . WPINC . '/class-wp-customize-manager.php' );


    add_action ('admin_menu', 'fi_theme_admin');
    function fi_theme_admin() {
        // add the Customize link to the admin menu
        add_theme_page( 'FI Customize', 'FI Customize', 'edit_theme_options', 'customize.php' );
    }



    class FI_Textarea_Control extends WP_Customize_Control 
    {
        public $type = 'textarea';

        public function render_content() 
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
            <?php
        }
    }
    class FI_Text_Control extends WP_Customize_Control 
    {
        public $type = 'text';

        public function render_content() 
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <input type="<?php echo esc_attr( $this->type ); ?>" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
            <?php
        }
    }
    class FI_Select_Control extends WP_Customize_Control 
    {
        public $type = 'select';

        public function render_content() 
        {
            ?>
            <label>
                    <?php if ( ! empty( $this->label ) ) : ?>
                            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php endif;
                    if ( ! empty( $this->description ) ) : ?>
                            <span class="description customize-control-description"><?php echo $this->description; ?></span>
                    <?php endif; ?>

                    <select <?php $this->link(); ?>>
                            <?php
                            foreach ( $this->choices as $value => $label )
                                    echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
                            ?>
                    </select>
            </label>
            <?php
        }
    }

    add_action('customize_register', 'cookie_customize');
    function cookie_customize($wp_customize) 
    {
        /**
         * Custom theme colours defined here 
         */
        $colors = array();
        $colors[] = array(
            'slug'=>'content_text_color', 
            'default' => '#333',
            'label' => __('Content Text Color', 'First Int')
        );
        $colors[] = array(
            'slug'=>'content_link_color', 
            'default' => '#88C34B',
            'label' => __('Content Link Color', 'First Int')
        );
        foreach( $colors as $color ) {

            $wp_customize->add_setting( $color['slug'], array(
                    'default' => $color['default'],
                    'type' => 'option', 
                    'capability' => 'manage_options'
                )
            );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array(
                    'label' => $color['label'], 
                    'section' => 'colors',
                    'settings' => $color['slug'])
                )
            );
        }

        
        
         /**
         * Custom fonts 
         */
        $wp_customize->add_section( 'fonts', array(
            'title'    => __( 'Fonts' ),
            'priority' => 88,
        ));
       
        $fonts = array();
        $fonts[] = array(
            'slug'=>'body_font_family', 
            'default' => 'Arial',
            'label' => __('Body Font Family', 'First Int')
        );
        $fonts[] = array(
            'slug'=>'footer_font_family', 
            'default' => 'Arial',
            'label' => __('Footer Font Family', 'First Int')
        );
        $fonts[] = array(
            'slug'=>'anchor_font_family', 
            'default' => 'Arial',
            'label' => __('Anchor Font Family', 'First Int')
        );
        foreach( $fonts as $font ) 
        {

            $wp_customize->add_setting( $font['slug'], array(
                    'default' => $font['default'],
                    'type' => 'option', 
                    'capability' => 'manage_options'
                )
            );

            $wp_customize->add_control( new FI_Select_Control( $wp_customize, $font['slug'], array(
                    'label'   => $font['label'],
                    'section' => 'fonts',
                    'type'    => 'select',
                    'settings' => $font['slug'],
                    'choices'    => array(
                        'lato' => 'Lato',
                        'gothic' => 'Gothic',
                        'sans' => 'Sans',
                        )
                
            )));
            
        }

        
        /**
         * Custom control for company details
         * 
         */
        $wp_customize->add_section( 'company', array(
            'title'    => __( 'Company Stuff' ),
            'priority' => 90,
        ));
       
        $wp_customize->add_setting( 'company_address', array(
            'default' => 'Compay address here',
            'type' => 'option', 
        ) );
        
          $wp_customize->add_control( new FI_Textarea_Control( $wp_customize, 'company_address', array(
            'label'   => 'Address Setting',
            'section' => 'company',
            'settings'   => 'company_address',
        ) ) );
          
           
        
        $companies = array();
        $companies[] = array(
            'slug'=>'company_tel', 
            'default' => 'Company tel no...',
            'label' => __('Company Tel No', 'First Int')
        );
        $companies[] = array(
            'slug'=>'company_tag_line', 
            'default' => 'Company tagline...',
            'label' => __('Company Tag Line', 'First Int')
        );
        $companies[] = array(
            'slug'=>'company_name', 
            'default' => 'Company name...',
            'label' => __('Company Name', 'First Int')
        );
        $companies[] = array(
            'slug'=>'company_fax', 
            'default' => 'Fax no...',
            'label' => __('Company Fax #', 'First Int')
        );
        $companies[] = array(
            'slug'=>'google_analytics_code', 
            'default' => 'Analytics code',
            'label' => __('Google Analytics Code', 'First Int')
        );
        $companies[] = array(
            'slug'=>'google_WMT_code', 
            'default' => 'Google WMT code',
            'label' => __('Google Webmaster Code', 'First Int')
        );
        $companies[] = array(
            'slug'=>'facebook_url', 
            'default' => '',
            'label' => __('Facebook URL', 'First Int')
        );
        $companies[] = array(
            'slug'=>'twitter_url', 
            'default' => '',
            'label' => __('Twitter URL', 'First Int')
        );
        $companies[] = array(
            'slug'=>'linkedin_url', 
            'default' => '',
            'label' => __('Linked In URL', 'First Int')
        );
        foreach( $companies as $company ) 
        {
            $wp_customize->add_setting( $company['slug'], array(
                    'default' => $company['default'],
                    'type' => 'option', 
                    'capability' => 'edit_theme_options'
                )
            );

            $wp_customize->add_control( new FI_Text_Control( $wp_customize, $company['slug'], array(
                    'label' => $company['label'], 
                    'section' => 'company',
                    'settings' => $company['slug'],
                    'type' => 'option')

                )
            );
        }
          
          
    
       
        
        
  
        
        

    }



