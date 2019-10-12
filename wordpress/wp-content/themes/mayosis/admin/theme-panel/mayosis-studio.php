<?php
function mayosis_studio_panels_sections( $wp_customize ) {
     /**
     * Add Panel
     */
     $wp_customize->add_panel( 'mayosis_studio', array(
      'priority'    => 1,
      'title'       => __( 'Styles', 'mayosis' ),
      'description' => __( 'mayosis Colors Options', 'mayosis' ),
      
      
     ) );
     
     $wp_customize->add_section( 'common_color', array(
      'title'       => __( 'Common Style', 'mayosis' ),
      'priority'    => 20,
      'panel'       => 'mayosis_studio',
      'description' => __( 'Set Site Common Styles', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'header_color', array(
      'title'       => __( 'Header Color', 'mayosis' ),
      'priority'    => 30,
      'panel'       => 'mayosis_studio',
      'description' => __( 'Set Site Header Colors', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'footer_color', array(
      'title'       => __( 'Footer Color', 'mayosis' ),
      'priority'    => 40,
      'panel'       => 'mayosis_studio',
      'description' => __( 'Set Site Footer Colors', 'mayosis' ),
     ) );
     
      $wp_customize->add_section( 'product_color', array(
      'title'       => __( 'Product/Blog Color', 'mayosis' ),
      'priority'    => 50,
      'panel'       => 'mayosis_studio',
      'description' => __( 'Set Site Product/Blog Colors', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'widget_color', array(
      'title'       => __( 'Widget Color', 'mayosis' ),
      'priority'    => 60,
      'panel'       => 'mayosis_studio',
      'description' => __( 'Set Site Widget Colors', 'mayosis' ),
     ) );
     
      $wp_customize->add_section( 'composer_color', array(
      'title'       => __( 'Page Builder Color', 'mayosis' ),
      'priority'    => 70,
      'panel'       => 'mayosis_studio',
      'description' => __( 'Set page builder button Colors', 'mayosis' ),
     ) );
    }
    add_action( 'customize_register', 'mayosis_studio_panels_sections' );

    
    function mayosis_studio_fields( $fields ) {
        $fields[] = array(
          'type'        => 'radio-buttonset',
        	'settings'    => 'rtl_mode',
        	'label'       => __( 'Site Direction', 'mayosis' ),
        	'section'     => 'common_color',
        	'default'     => 'off',
        	'priority'    => 10,
        	'choices'     => array(
        	    'off' => esc_attr__( 'LTR', 'mayosis' ),
        		'on'  => esc_attr__( 'RTL', 'mayosis' ),
        		
        	),
         );
         
      $fields[] = array(
      'type'        => 'color',
      'settings'     => 'mayosis_body_color',
      'label'       => __( 'Body Color', 'mayosis' ),
      'description' => __( 'Main Site Backgrounnd Color', 'mayosis' ),
      'section'     => 'common_color',
      'priority'    => 10,
      'default'     => '#ffffff',
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
        $fields[] = array(
      'type'        => 'color',
      'settings'     => 'mayosis_secondary_color',
      'label'       => __( 'Secondary Background Color', 'mayosis' ),
      'description' => __( 'Change Secondary Backgrounnd Color', 'mayosis' ),
      'section'     => 'common_color',
      'priority'    => 10,
      'default'     => '#f0f1f2',
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
    $fields[] = array(
      'type'        => 'color',
      'settings'     => 'accent_color',
      'label'       => __( 'Accent Color', 'mayosis' ),
      'description' => __( 'Whole Site Main Color', 'mayosis' ),
      'section'     => 'common_color',
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
      
      $fields[] = array(
      'type'        => 'color',
      'settings'     => 'accent_color_text',
      'label'       => __( 'Accent Text Color', 'mayosis' ),
      'description' => __( 'Accent above text color', 'mayosis' ),
      'section'     => 'common_color',
      'priority'    => 10,
      'default'     => '#ffffff', 
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
      
      $fields[] = array(
      'type'        => 'color',
      'settings'     => 'secondary_accent_color',
      'label'       => __( 'Secondary Accent  Color', 'mayosis' ),
      'description' => __( 'Change secondary accent color', 'mayosis' ),
      'section'     => 'common_color',
      'priority'    => 10,
      'default'     => '#282837', 
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
      
      $fields[] = array(
      'type'        => 'color',
      'settings'     => 'secondary_accent_color_text',
      'label'       => __( 'Secondary Accent Text Color', 'mayosis' ),
      'description' => __( 'Secondary accent above text color', 'mayosis' ),
      'section'     => 'common_color',
      'priority'    => 10,
      'default'     => '#ffffff', 
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
      
      $fields[] = array(
      'type'        => 'color',
      'settings'     => 'regular_text_color',
      'label'       => __( 'Regular Text Color', 'mayosis' ),
      'description' => __( 'Change regular text color', 'mayosis' ),
      'section'     => 'common_color',
      'priority'    => 10,
      'default'     => '#28375a', 
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
      $fields[] = array(
          'type'        => 'radio-buttonset',
        	'settings'    => 'form_field_type',
        	'label'       => __( 'Form Field Type', 'mayosis' ),
        	'section'     => 'common_color',
        	'default'     => 'solid',
        	'priority'    => 10,
        	'choices'     => array(
        		'solid'  => esc_attr__( 'Solid', 'mayosis' ),
        		'border' => esc_attr__( 'Border', 'mayosis' ),
        	),
         );
        
        $fields[] = array(
            'type'        => 'dimension',
        	'settings'    => 'global_border_thikness',
        	'label'       => esc_attr__( 'Border Thickness', 'mayosis' ),
        	'description' => esc_attr__( 'Add Main Site Form Border Thickness', 'mayosis' ),
        	'section'     => 'common_color',
        	'default'     => '2px',
        	'required'    => array(
            array(
                'setting'  => 'form_field_type',
                'operator' => '==',
                'value'    => 'border',
            ),
        ),
        
            );
        
        $fields[] = array(
      'type'        => 'color',
      'settings'     => 'visited_link_color',
      'label'       => __( 'Visited Link Color', 'mayosis' ),
      'description' => __( 'Change visited link color', 'mayosis' ),
      'section'     => 'common_color',
      'priority'    => 10,
      'default'     => '#b2478f', 
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
      
      $fields[] = array(
          'type'        => 'radio-buttonset',
        	'settings'    => 'loader_website',
        	'label'       => __( 'Website Loader', 'mayosis' ),
        	'section'     => 'common_color',
        	'default'     => 'show',
        	'priority'    => 10,
        	'choices'     => array(
        		'show'  => esc_attr__( 'Show', 'mayosis' ),
        		'hide' => esc_attr__( 'Hide', 'mayosis' ),
        	),
         );
         
         $fields[] = array(
          'type'        => 'multicolor',
            'settings'    => 'loader_gradient',
            'label'       => esc_attr__( 'Loader gradient', 'mayosis' ),
            'section'     => 'common_color',
            'priority'    => 10,
            'required'    => array(
            array(
                'setting'  => 'loader_website',
                'operator' => '==',
                'value'    => 'show',
            ),
        ),
            'choices'     => array(
                'color1'    => esc_attr__( 'Form', 'mayosis' ),
                'color2'   => esc_attr__( 'To', 'mayosis' ),
            ),
            'default'     => array(
                'color1'    => '#1e73be',
                'color2'   => '#00897e',
            ),
          );
      
      //header color
      
      $fields[] = array(
          'type'        => 'radio-buttonset',
        	'settings'    => 'header_bg_type',
        	'label'       => __( 'Header Background Type', 'mayosis' ),
        	'section'     => 'header_color',
        	'default'     => 'color',
        	'priority'    => 10,
        	'choices'     => array(
        		'color'  => esc_attr__( 'Color', 'mayosis' ),
        		'gradient' => esc_attr__( 'Gradient', 'mayosis' ),
        		'image' => esc_attr__( 'Image', 'mayosis' ),
        	),
         );
         
         $fields[] = array(
      'type'        => 'color',
      'settings'     => 'header_background',
      'label'       => __( 'Main Header Background Color', 'mayosis' ),
      'description' => __( 'Set main header background color', 'mayosis' ),
      'section'     => 'header_color',
      'priority'    => 10,
      'default'     => '#ffffff', 
      'required'    => array(
            array(
                'setting'  => 'header_bg_type',
                'operator' => '==',
                'value'    => 'color',
            ),
        ),
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
      $fields[] = array(
          'type'        => 'multicolor',
            'settings'    => 'header_gradient',
            'label'       => esc_attr__( 'Header gradient', 'mayosis' ),
            'section'     => 'header_color',
            'priority'    => 10,
            'required'    => array(
            array(
                'setting'  => 'header_bg_type',
                'operator' => '==',
                'value'    => 'gradient',
            ),
        ),
            'choices'     => array(
                'color1'    => esc_attr__( 'Form', 'mayosis' ),
                'color2'   => esc_attr__( 'To', 'mayosis' ),
            ),
            'default'     => array(
                'color1'    => '#1e73be',
                'color2'   => '#00897e',
            ),
          );
           $fields[] = array(
               'type'        => 'image',
            	'settings'    => 'header_bg_image',
            	'label'       => esc_attr__( 'Header Background Image', 'mayosis' ),
            	'description' => esc_attr__( 'Upload header background image', 'mayosis' ),
            	'section'     => 'header_color',
            	'required'    => array(
            array(
                'setting'  => 'header_bg_type',
                'operator' => '==',
                'value'    => 'image',
                    ),
                ),
            	'default'     => '',
               );
               
                $fields[] = array(
              'type'        => 'color',
              'settings'     => 'header_transparent_background',
              'label'       => __( 'Transparent Header Background Color', 'mayosis' ),
              'description' => __( 'Only For Header 1 & 2', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => 'rgba(255,255,255,0)', 
               'choices' => array(
                        'alpha' => true,
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
              
              $fields[] = array(
              'type'        => 'color',
              'settings'     => 'header_accent_color',
              'label'       => __( 'Header Accent Color', 'mayosis' ),
              'description' => __( 'Change Accent Color', 'mayosis' ),
              'section'     => 'header_color',
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
              
              $fields[] = array(
              'type'        => 'color',
              'settings'     => 'header_accent_text_color',
              'label'       => __( 'Header Accent Text Color', 'mayosis' ),
              'description' => __( 'Change Accent Text Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
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
              
              $fields[] = array(
              'type'        => 'color',
              'settings'     => 'main_nav_text',
              'label'       => __( 'Main Navigation Text Color', 'mayosis' ),
              'description' => __( 'Change navigation text Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
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
              
               $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'menu_hover_type',
                    	'label'       => __( 'Menu Hover Type', 'mayosis' ),
                    	'section'     => 'header_color',
                    	'default'     => 'opacity',
                    	'priority'    => 10,
                    	'multiple'    => 1,
                    	'choices'     => array(
                    		'color' => esc_attr__( 'Color', 'mayosis' ),
                    		'opacity' => esc_attr__( 'Opacity', 'mayosis' ),
                    		'underline' => esc_attr__( 'Underline', 'mayosis' ),
                    		'dotted' => esc_attr__( 'Dotted', 'mayosis' ),
                    	),
                                        );
                                        
              
               $fields[] = array(
              'type'        => 'color',
              'settings'     => 'main_nav_text_hover',
              'label'       => __( 'Main Navigation Text Hover Color', 'mayosis' ),
              'description' => __( 'Change navigation text hover Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#28375a', 
              'required'    => array(
                                array(
                                    'setting'  => 'menu_hover_type',
                                    'operator' => '==',
                                    'value'    => 'color',
                                ),
                            ),
                            
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
              
              $fields[] = array(
              'type'        => 'color',
              'settings'     => 'sub_nav_bg',
              'label'       => __( 'Sub Navigation Background Color', 'mayosis' ),
              'description' => __( 'Change navigation bg Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#1e1e2d', 
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
              
               $fields[] = array(
              'type'        => 'color',
              'settings'     => 'sub_nav_text',
              'label'       => __( 'Sub Navigation Text Color', 'mayosis' ),
              'description' => __( 'Change navigation text Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
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
              
              $fields[] = array(
              'type'        => 'color',
              'settings'     => 'top_header_bg',
              'label'       => __( 'Top Header Background Color', 'mayosis' ),
              'description' => __( 'Change top header bg Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
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
              
              $fields[] = array(
              'type'        => 'color',
              'settings'     => 'top_header_text',
              'label'       => __( 'To Header Text Color', 'mayosis' ),
              'description' => __( 'Change top header text Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#28375a', 
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
              
              $fields[] = array(
              'type'        => 'color',
              'settings'     => 'top_header_menu',
              'label'       => __( 'Top Header Menu Text Color', 'mayosis' ),
              'description' => __( 'Change top header menu text Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#28375a', 
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
              
              $fields[] = array(
              'type'        => 'color',
              'settings'     => 'top_header_sub_menu',
              'label'       => __( 'Top Header Sub Menu Text Color', 'mayosis' ),
              'description' => __( 'Change top header sub menu text Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
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
              
               $fields[] = array(
              'type'        => 'color',
              'settings'     => 'top_sub_menu_bg',
              'label'       => __( 'Top Header Sub Menu Background Color', 'mayosis' ),
              'description' => __( 'Change top header sub menu background Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#1e1e2d', 
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
              
               $fields[] = array(
              'type'        => 'color',
              'settings'     => 'mobile_header_icons_color',
              'label'       => __( 'Mobile Header Icons Color', 'mayosis' ),
              'description' => __( 'Change mobile Header Icons color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
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
              
               $fields[] = array(
              'type'        => 'color',
              'settings'     => 'mobile_menu_text',
              'label'       => __( 'Mobile Menu Text Color', 'mayosis' ),
              'description' => __( 'Change mobile menu text color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
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
              
               $fields[] = array(
          'type'        => 'radio-buttonset',
        	'settings'    => 'header_form_type',
        	'label'       => __( 'Form Field Type', 'mayosis' ),
        	'section'     => 'header_color',
        	'default'     => 'solid',
        	'priority'    => 10,
        	'choices'     => array(
        		'solid'  => esc_attr__( 'Solid', 'mayosis' ),
        		'border' => esc_attr__( 'Border', 'mayosis' ),
        	),
         );
         
    $fields[] = array(
      'type'        => 'color',
      'settings'     => 'header_form_field_bg',
      'label'       => __( 'Form Field Color', 'mayosis' ),
      'description' => __( 'Change Form Field Color', 'mayosis' ),
      'section'     => 'header_color',
      'priority'    => 10,
      'default'     => '#edeff2', 
      'required'    => array(
            array(
                'setting'  => 'header_form_type',
                'operator' => '==',
                'value'    => 'solid',
            ),
        ),
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
      
      $fields[] = array(
      'type'        => 'color',
      'settings'     => 'header_form_border',
      'label'       => __( 'Form Field Border Color', 'mayosis' ),
      'description' => __( 'Change form field border color', 'mayosis' ),
      'section'     => 'header_color',
      'priority'    => 10,
      'default'     => '#1e1e2d', 
      'required'    => array(
            array(
                'setting'  => 'header_form_type',
                'operator' => '==',
                'value'    => 'border',
            ),
        ),
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
      
      
      
      $fields[] = array(
            'type'        => 'dimension',
        	'settings'    => 'header_border_thikness',
        	'label'       => esc_attr__( 'Border Thickness', 'mayosis' ),
        	'description' => esc_attr__( 'Add header form border thickness', 'mayosis' ),
        	'section'     => 'header_color',
        	'default'     => '2px',
        	'required'    => array(
            array(
                'setting'  => 'header_form_type',
                'operator' => '==',
                'value'    => 'border',
            ),
        ),
        
            );
            
             $fields[] = array(
              'type'        => 'color',
              'settings'     => 'header_buttonbg_color',
              'label'       => __( 'Header Button Background Color', 'mayosis' ),
              'description' => __( 'Change Header Button Background Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => 'rgba(0,0,0,.0)', 
               'choices' => array(
                   'alpha' => true,
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
              
               $fields[] = array(
              'type'        => 'color',
              'settings'     => 'header_buttonborder_color',
              'label'       => __( 'Header Button Border Color', 'mayosis' ),
              'description' => __( 'Change Header Button Border Color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => 'rgba(255,255,255,0.25)', 
               'choices' => array(
                   'alpha' => true,
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
              
               $fields[] = array(
              'type'        => 'color',
              'settings'     => 'header_button_text',
              'label'       => __( 'Header Button Text Color', 'mayosis' ),
              'description' => __( 'Change sticky header text color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
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
              
            $fields[] = array(
              'type'        => 'color',
              'settings'     => 'sticky_header_bg',
              'label'       => __( 'Sticky Header Background Color', 'mayosis' ),
              'description' => __( 'Change sticky header background color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
               'choices' => array(
                   'alpha' => true,
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
              
               $fields[] = array(
              'type'        => 'color',
              'settings'     => 'sticky_header_text',
              'label'       => __( 'Sticky Header Text Color', 'mayosis' ),
              'description' => __( 'Change sticky header text color', 'mayosis' ),
              'section'     => 'header_color',
              'priority'    => 10,
              'default'     => '#28375a', 
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
              $fields[] = array(
          'type'        => 'radio-buttonset',
        	'settings'    => 'footer_bg_type',
        	'label'       => __( 'Footer Background Type', 'mayosis' ),
        	'section'     => 'footer_color',
        	'default'     => 'color',
        	'priority'    => 10,
        	'choices'     => array(
        		'color'  => esc_attr__( 'Color', 'mayosis' ),
        		'gradient' => esc_attr__( 'Gradient', 'mayosis' ),
        		'image' => esc_attr__( 'Image', 'mayosis' ),
        	),
         );
         
         $fields[] = array(
      'type'        => 'color',
      'settings'     => 'footer_background',
      'label'       => __( 'Footer Background Color', 'mayosis' ),
      'description' => __( 'Set footer background color', 'mayosis' ),
      'section'     => 'footer_color',
      'priority'    => 10,
      'default'     => '#ffffff', 
      'required'    => array(
            array(
                'setting'  => 'footer_bg_type',
                'operator' => '==',
                'value'    => 'color',
            ),
        ),
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
      $fields[] = array(
          'type'        => 'multicolor',
            'settings'    => 'footer_gradient',
            'label'       => esc_attr__( 'Footer gradient', 'mayosis' ),
            'section'     => 'footer_color',
            'priority'    => 10,
            'required'    => array(
            array(
                'setting'  => 'footer_bg_type',
                'operator' => '==',
                'value'    => 'gradient',
            ),
        ),
            'choices'     => array(
                'color1'    => esc_attr__( 'Form', 'mayosis' ),
                'color2'   => esc_attr__( 'To', 'mayosis' ),
            ),
            'default'     => array(
                'color1'    => '#1e73be',
                'color2'   => '#00897e',
            ),
          );
           $fields[] = array(
               'type'        => 'image',
            	'settings'    => 'footer_bg_image',
            	'label'       => esc_attr__( 'Footer Background Image', 'mayosis' ),
            	'description' => esc_attr__( 'Upload footer background image', 'mayosis' ),
            	'section'     => 'footer_color',
            	'required'    => array(
            array(
                'setting'  => 'footer_bg_type',
                'operator' => '==',
                'value'    => 'image',
                    ),
                ),
            	'default'     => '',
               );
               
               $fields[] = array(
               'type'        => 'image',
            	'settings'    => 'footer_overlay_image',
            	'label'       => esc_attr__( 'Footer Overlay Image', 'mayosis' ),
            	'description' => esc_attr__( 'Upload footer background image', 'mayosis' ),
            	'section'     => 'footer_color',
            	'default'     => '',
               );
               $fields[] = array(
                  'type'        => 'color',
                  'settings'     => 'footer_text',
                  'label'       => __( 'Footer text Color', 'mayosis' ),
                  'description' => __( 'Set footer text color', 'mayosis' ),
                  'section'     => 'footer_color',
                  'priority'    => 10,
                  'default'     => '#ffffff', 
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
                  
                  $fields[] = array(
                  'type'        => 'color',
                  'settings'     => 'copyright_backgroud',
                  'label'       => __( 'Copyright Background Color', 'mayosis' ),
                  'description' => __( 'Set Copyright Background Color', 'mayosis' ),
                  'section'     => 'footer_color',
                  'priority'    => 10,
                  'default'     => '#282837', 
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
                  
                  $fields[] = array(
                  'type'        => 'color',
                  'settings'     => 'copyright_text',
                  'label'       => __( 'Copyright Text Color', 'mayosis' ),
                  'description' => __( 'Set copyright text Color', 'mayosis' ),
                  'section'     => 'footer_color',
                  'priority'    => 10,
                  'default'     => '#d8ddef', 
                   'choices' => array(
                            'palettes' => array(
                                '#28375a',
                                '#282837',
                                '#5a00f0',
                                '#d8ddef',
                                '#c44d58',
                                '#ecca2e',
                                '#bada55',
                            ),
                        ),
                  );
        $fields[] = array(
          'type'        => 'radio-buttonset',
        	'settings'    => 'footer_field_type',
        	'label'       => __( 'Form Field Type', 'mayosis' ),
        	'section'     => 'footer_color',
        	'default'     => 'solid',
        	'priority'    => 10,
        	'choices'     => array(
        		'solid'  => esc_attr__( 'Solid', 'mayosis' ),
        		'border' => esc_attr__( 'Border', 'mayosis' ),
        	),
         );
         
    $fields[] = array(
      'type'        => 'color',
      'settings'     => 'footer_field_color',
      'label'       => __( 'Form Field Color', 'mayosis' ),
      'description' => __( 'Change Form Field Color', 'mayosis' ),
      'section'     => 'footer_color',
      'priority'    => 10,
      'default'     => '#edeff2', 
      'required'    => array(
            array(
                'setting'  => 'footer_field_type',
                'operator' => '==',
                'value'    => 'solid',
            ),
        ),
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
      $fields[] = array(
      'type'        => 'color',
      'settings'     => 'footer_border_color',
      'label'       => __( 'Form Border Color', 'mayosis' ),
      'description' => __( 'Change Form border Color', 'mayosis' ),
      'section'     => 'footer_color',
      'priority'    => 10,
      'default'     => '#282837', 
      'required'    => array(
            array(
                'setting'  => 'footer_field_type',
                'operator' => '==',
                'value'    => 'border',
            ),
        ),
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
        $fields[] = array(
            'type'        => 'dimension',
        	'settings'    => 'footer_border_thikness',
        	'label'       => esc_attr__( 'Border Thickness', 'mayosis' ),
        	'description' => esc_attr__( 'Add Main Site Form Border Thickness', 'mayosis' ),
        	'section'     => 'footer_color',
        	'default'     => '2px',
        	'required'    => array(
            array(
                'setting'  => 'footer_field_type',
                'operator' => '==',
                'value'    => 'border',
            ),
        ),
        
          );     
          
         
              
               $fields[] = array(
              'type'        => 'color',
              'settings'     => 'product_breadcrumb_text',
              'label'       => __( 'Breadcrumb Text Color', 'mayosis' ),
              'description' => __( 'Set Breadcrumb Text Color', 'mayosis' ),
              'section'     => 'product_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
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
      
      $fields[] = array(
              'type'        => 'color',
              'settings'     => 'product_thumb_hover',
              'label'       => __( 'Thumbnail Hover Background', 'mayosis' ),
              'description' => __( 'Set Thumbnail Hover Background', 'mayosis' ),
              'section'     => 'product_color',
              'priority'    => 10,
              'default'     => '#282837', 
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
       $fields[] = array(
           'type'        => 'slider',
        	'settings'    => 'thumb_hover_opacity',
        	'label'       => esc_attr__( 'Thumbnail Hover Opacity', 'mayosis' ),
        	'section'     => 'product_color',
        	'default'     => .3,
        	'choices'     => array(
        		'min'  => 0,
        		'max'  => 1,
        		'step' =>.1,
        	),
           );
           
            $fields[] = array(
              'type'        => 'color',
              'settings'     => 'product_thumb_hover_text',
              'label'       => __( 'Thumbnail Hover Text Color', 'mayosis' ),
              'description' => __( 'Set Thumbnail Hover Text Color', 'mayosis' ),
              'section'     => 'product_color',
              'priority'    => 10,
              'default'     => '#ffffff', 
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
      
      $fields[] = array(
              'type'        => 'color',
              'settings'     => 'product_label',
              'label'       => __( 'Product Label Color', 'mayosis' ),
              'description' => __( 'Set Product Label Color', 'mayosis' ),
              'section'     => 'product_color',
              'priority'    => 10,
              'default'     => '#e6174b', 
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
        
      $fields[] = array(
              'type'        => 'color',
              'settings'     => 'product_label_edge',
              'label'       => __( 'Product Label Edge Color', 'mayosis' ),
              'description' => __( 'Set Product Label Edge Color', 'mayosis' ),
              'section'     => 'product_color',
              'priority'    => 10,
              'default'     => '#b71338', 
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
     
         
       $fields[] = array(
          'type'        => 'radio-buttonset',
        	'settings'    => 'wd_bg_type',
        	'label'       => __( 'Title Background Type', 'mayosis' ),
        	'section'     => 'widget_color',
        	'default'     => 'color',
        	'priority'    => 10,
        	'choices'     => array(
        		'color'  => esc_attr__( 'Color', 'mayosis' ),
        		'gradient' => esc_attr__( 'Gradient', 'mayosis' ),
        	),
         );
          $fields[] = array(
          'type'        => 'multicolor',
            'settings'    => 'wd_title_gradient',
            'label'       => esc_attr__( 'Widget gradient', 'mayosis' ),
            'section'     => 'widget_color',
            'priority'    => 10,
            'required'    => array(
            array(
                'setting'  => 'wd_bg_type',
                'operator' => '==',
                'value'    => 'gradient',
            ),
        ),
            'choices'     => array(
                'color1'    => esc_attr__( 'Form', 'mayosis' ),
                'color2'   => esc_attr__( 'To', 'mayosis' ),
            ),
            'default'     => array(
                'color1'    => '#1e73be',
                'color2'   => '#00897e',
            ),
          );
        
         $fields[] = array(
          'type'        => 'color',
          'settings'     => 'wd_title_bg',
          'label'       => __( 'Title Background Color', 'mayosis' ),
          'description' => __( 'Set Title Background color', 'mayosis' ),
          'section'     => 'widget_color',
          'priority'    => 10,
          'default'     => '#1e0046', 
          'required'    => array(
                array(
                    'setting'  => 'wd_bg_type',
                    'operator' => '==',
                    'value'    => 'color',
                ),
            ),
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
      
       
          
           $fields[] = array(
          'type'        => 'color',
          'settings'     => 'wd_title_text',
          'label'       => __( 'Title Color', 'mayosis' ),
          'description' => __( 'Set Title color', 'mayosis' ),
          'section'     => 'widget_color',
          'priority'    => 10,
          'default'     => '#ffffff', 
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
      
      $fields[] = array(
          'type'        => 'color',
          'settings'     => 'wd_field_text',
          'label'       => __( 'Field Text Color', 'mayosis' ),
          'description' => __( 'Set Field Text color', 'mayosis' ),
          'section'     => 'widget_color',
          'priority'    => 10,
          'default'     => '#28375a', 
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
      $fields[] = array(
          'type'        => 'radio-buttonset',
        	'settings'    => 'wd_field_type',
        	'label'       => __( 'Form Field Type', 'mayosis' ),
        	'section'     => 'widget_color',
        	'default'     => 'solid',
        	'priority'    => 10,
        	'choices'     => array(
        		'solid'  => esc_attr__( 'Solid', 'mayosis' ),
        		'border' => esc_attr__( 'Border', 'mayosis' ),
        	),
         );
         
    $fields[] = array(
      'type'        => 'color',
      'settings'     => 'wd_field_color',
      'label'       => __( 'Form Field Color', 'mayosis' ),
      'description' => __( 'Change Form Field Color', 'mayosis' ),
      'section'     => 'widget_color',
      'priority'    => 10,
      'default'     => '#edeff2', 
      'required'    => array(
            array(
                'setting'  => 'wd_field_type',
                'operator' => '==',
                'value'    => 'solid',
            ),
        ),
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
      $fields[] = array(
      'type'        => 'color',
      'settings'     => 'wd_border_color',
      'label'       => __( 'Form Border Color', 'mayosis' ),
      'description' => __( 'Change Form border Color', 'mayosis' ),
      'section'     => 'widget_color',
      'priority'    => 10,
      'default'     => '#282837', 
      'required'    => array(
            array(
                'setting'  => 'wd_field_type',
                'operator' => '==',
                'value'    => 'border',
            ),
        ),
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
        $fields[] = array(
            'type'        => 'dimension',
        	'settings'    => 'wd_border_thikness',
        	'label'       => esc_attr__( 'Border Thickness', 'mayosis' ),
        	'description' => esc_attr__( 'Add Main Site Form Border Thickness', 'mayosis' ),
        	'section'     => 'widget_color',
        	'default'     => '2px',
        	'required'    => array(
            array(
                'setting'  => 'wd_field_type',
                'operator' => '==',
                'value'    => 'border',
            ),
        ),
        
          );     
          
        $fields[] = array(
      'type'        => 'color',
      'settings'     => 'single_button_bg',
      'label'       => __( 'Single Button Background', 'mayosis' ),
      'description' => __( 'Change Button background & Border Color', 'mayosis' ),
      'section'     => 'composer_color',
      'priority'    => 10,
      'default'     => '#282837', 
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
      
        $fields[] = array(
      'type'        => 'color',
      'settings'     => 'dual_button_a',
      'label'       => __( 'Dual Button A Background', 'mayosis' ),
      'description' => __( 'Change Button background & Border Color', 'mayosis' ),
      'section'     => 'composer_color',
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
      
       $fields[] = array(
      'type'        => 'color',
      'settings'     => 'dual_button_b',
      'label'       => __( 'Dual Button B Background', 'mayosis' ),
      'description' => __( 'Change Button background & Border Color', 'mayosis' ),
      'section'     => 'composer_color',
      'priority'    => 10,
      'default'     => '#282837', 
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
      
      $fields[] = array(
      'type'        => 'color',
      'settings'     => 'testimonial_grid_bg',
      'label'       => __( 'Testimonial Grid Background', 'mayosis' ),
      'description' => __( 'Change Testimonial Grid Background', 'mayosis' ),
      'section'     => 'composer_color',
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
      
       $fields[] = array(
      'type'        => 'color',
      'settings'     => 'search_main_color',
      'label'       => __( 'Search Accent Color', 'mayosis' ),
      'description' => __( 'Change Search Main Color', 'mayosis' ),
      'section'     => 'composer_color',
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
       $fields[] = array(
      'type'        => 'color',
      'settings'     => 'search_accent_text_color',
      'label'       => __( 'Search Accent Text  Color', 'mayosis' ),
      'description' => __( 'Change Accent Text  Color', 'mayosis' ),
      'section'     => 'composer_color',
      'priority'    => 10,
      'default'     => '#ffffff', 
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
      
       $fields[] = array(
      'type'        => 'color',
      'settings'     => 'search_main_bg_color',
      'label'       => __( 'Search Main Background Color', 'mayosis' ),
      'description' => __( 'Change Search Main Bg Color', 'mayosis' ),
      'section'     => 'composer_color',
      'priority'    => 10,
      'default'     => '#ffffff', 
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
      
       $fields[] = array(
      'type'        => 'color',
      'settings'     => 'search_main_border_color',
      'label'       => __( 'Search Main Border Color', 'mayosis' ),
      'description' => __( 'Change Search Main Border Color', 'mayosis' ),
      'section'     => 'composer_color',
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
    add_filter( 'kirki/fields', 'mayosis_studio_fields' );
     ?>