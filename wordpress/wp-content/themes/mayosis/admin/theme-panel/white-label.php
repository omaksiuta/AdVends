<?php

function mayosis_whitelabel_sections( $wp_customize ) {
     /**
     * Add Panel
     */
     $wp_customize->add_panel( 'white_label', array(
      'priority'    => 10,
      'title'       => __( 'White Label', 'mayosis' ),
      'description' => __( 'White Label Logo & info', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'admin_logo_white', array(
      'title'       => __( 'Admin', 'mayosis' ),
      'priority'    => 20,
      'panel'       => 'white_label',
      'description' => __( 'Change site admin white label logo info', 'mayosis' ),
     ) );
    
    }
    add_action( 'customize_register', 'mayosis_whitelabel_sections' );
    
        function mayosis_whitelabel_fields( $fields ) {
             $fields[] = array(
                        'type'        => 'image',
                    	'settings'    => 'admin_logo',
                    	'label'       => esc_attr__( 'Admin Login Logo', 'mayosis' ),
                    	'description' => esc_attr__( 'Recommanded Size 130 x 90px Maximum', 'mayosis' ),
                    	'section'     => 'admin_logo_white',
                    	'default'     => get_template_directory_uri() . '/images/logo.png',
                        );
                        
                $fields[] = array(
          'type'        => 'multicolor',
            'settings'    => 'gradient_admin',
            'label'       => esc_attr__( 'Admin gradient bg', 'mayosis' ),
            'section'     => 'admin_logo_white',
            'priority'    => 10,
            'choices'     => array(
                'color1'    => esc_attr__( 'Form', 'mayosis' ),
                'color2'   => esc_attr__( 'To', 'mayosis' ),
            ),
            'default'     => array(
                'color1'    => '#1e0046',
                'color2'   => '#1e0064',
            ),
          );
          
          $fields[] = array(
      'type'        => 'color',
      'settings'     => 'login_button_admin',
      'label'       => __( 'Login Button Color', 'mayosis' ),
      'description' => __( 'Main Admin Login Button Color', 'mayosis' ),
      'section'     => 'admin_logo_white',
      'priority'    => 10,
      'default'     => '#5a00f0',
      'choices' => array(
                'palettes' => array(
                    '#28375a',
                    '#282837',
                    '#5a00f0',
                    '#ff6b6b',
                    '#c44d58',
                    '#ecca2e',
                    '#bada55',
                ),
            ),
      );
      
              return $fields;
    }
    add_filter( 'kirki/fields', 'mayosis_whitelabel_fields' );
     ?>
