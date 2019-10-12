<?php

function mayosis_template_sections( $wp_customize ) {
     /**
     * Add Panel
     */
     $wp_customize->add_panel( 'mayosis_template', array(
      'priority'    => 9,
      'title'       => __( 'Template', 'mayosis' ),
      'description' => __( 'mayosis Template', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'product_template', array(
      'title'       => __( 'Default Product Template', 'mayosis' ),
      'priority'    => 40,
      'panel'       => 'mayosis_template',
      'description' => __( 'Change site Product template options', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'photo_template', array(
      'title'       => __( 'Photo Template', 'mayosis' ),
      'priority'    => 50,
      'panel'       => 'mayosis_template',
      'description' => __( 'Change site Photo template options', 'mayosis' ),
     ) );
     
       $wp_customize->add_section( 'blog_template', array(
      'title'       => __( 'Blog Template', 'mayosis' ),
      'priority'    => 60,
      'panel'       => 'mayosis_template',
      'description' => __( 'Change site Blog template options', 'mayosis' ),
     ) );
     
}
    add_action( 'customize_register', 'mayosis_template_sections' );
    
      function mayosis_template_fields( $fields ) {
           $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'featured_image_visibility',
                    	'label'       => __( 'Featured Image Visibility', 'mayosis' ),
                    	'section'     => 'product_template',
                    	'default'     => 'show',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'show'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    
            $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'featured_image_position',
                    	'label'       => __( 'Featured Image Position', 'mayosis' ),
                    	'section'     => 'product_template',
                    	'default'     => 'left',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'left'   => esc_attr__( 'Left', 'mayosis' ),
                    		'right' => esc_attr__( 'Right', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'product_header_content_position',
                    	'label'       => __( 'Product Header Content Position', 'mayosis' ),
                    	'section'     => 'product_template',
                    	'default'     => 'left',
                    	'priority'    => 10,
                    	'multiple'    => 1,
                    	'choices'     => array(
                    		'left' => esc_attr__( 'Left', 'mayosis' ),
                    		'center' => esc_attr__( 'Center', 'mayosis' ),
                    		'right' => esc_attr__( 'Right', 'mayosis' ),
           
                    	),
                                        );
                    
            $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'background_product',
                    	'label'       => __( 'Background', 'mayosis' ),
                    	'section'     => 'product_template',
                    	'default'     => 'color',
                    	'priority'    => 10,
                    	'multiple'    => 1,
                    	'choices'     => array(
                    		'color' => esc_attr__( 'Color', 'mayosis' ),
                    		'gradient' => esc_attr__( 'Gradient', 'mayosis' ),
                    		'image' => esc_attr__( 'Image', 'mayosis' ),
                    		'featured' => esc_attr__( 'Featured Image', 'mayosis' ),
                    	),
                                        );
                                        
           $fields[] = array(
                  'type'        => 'color',
                  'settings'     => 'product_bg_default',
                  'label'       => __( 'Background Color', 'mayosis' ),
                  'description' => __( 'Change  Backgrounnd Color', 'mayosis' ),
                  'section'     => 'product_template',
                  'priority'    => 10,
                  'default'     => '#460082',
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
                        
                    'required'    => array(
                        array(
                            'setting'  => 'background_product',
                            'operator' => '==',
                            'value'    => 'color',
                        ),
                        ),
                  );
                  
                  $fields[] = array(
                      'type'        => 'multicolor',
                        'settings'    => 'product_gradient_default',
                        'label'       => esc_attr__( 'Product gradient', 'mayosis' ),
                        'section'     => 'product_template',
                        'priority'    => 10,
                        'required'    => array(
                        array(
                            'setting'  => 'background_product',
                            'operator' => '==',
                            'value'    => 'gradient',
                        ),
                    ),
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
                               'type'     => 'text',
                            	'settings' => 'gradient_angle_product',
                            	'label'    => __( 'Angle', 'mayosis' ),
                            	'section'  => 'product_template',
                            	'default'  => esc_attr__( '135', 'mayosis' ),
                            	'priority' => 10,
                            	'required'    => array(
                                array(
                                    'setting'  => 'background_product',
                                    'operator' => '==',
                                    'value'    => 'gradient',
                                ),
                            ),
                               );
                      
                      $fields[] = array(
                          'type'        => 'image',
                        	'settings'    => 'product-main-bg',
                        	'label'       => esc_attr__( 'Image Control (URL)', 'mayosis' ),
                        	'description' => esc_attr__( 'Description Here.', 'mayosis' ),
                        	'section'     => 'product_template',
                        	'required'    => array(
                                array(
                                    'setting'  => 'background_product',
                                    'operator' => '==',
                                    'value'    => 'image',
                                ),
                            ),
                          );
                          
                           $fields[] = array(
                               'type'     => 'text',
                            	'settings' => 'main_product_blur',
                            	'label'    => __( 'Blur Radius', 'mayosis' ),
                            	'section'  => 'product_template',
                            	'default'  => esc_attr__( '5px', 'mayosis' ),
                            	'priority' => 10,
                            	'required'    => array(
                                array(
                                    'setting'  => 'background_product',
                                    'operator' => '==',
                                    'value'    => 'featured',
                                ),
                            ),
                               );
                               
                               
                        $fields[] = array(
                      'type'        => 'color',
                      'settings'     => 'product_ovarlay_main',
                      'label'       => __( 'Overlay Color', 'mayosis' ),
                      'description' => __( 'Change  Overlay Color', 'mayosis' ),
                      'section'     => 'product_template',
                      'priority'    => 10,
                      'default'     => 'rgb(40,40,50,.5)',
                      'choices'     => array(
                        		'alpha' => true,
                        	),
                                                    
                        'required'    => array(
                            array(
                                'setting'  => 'background_product',
                                'operator' => '==',
                                'value'    => 'featured',
                            ),
                            ),
                  );
                  
                  $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'parallax_featured_image',
                    	'label'       => __( 'Featured Image Parallax', 'mayosis' ),
                    	'section'     => 'product_template',
                    	'default'     => 'no',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'yes'   => esc_attr__( 'Yes', 'mayosis' ),
                    		'no' => esc_attr__( 'No', 'mayosis' ),
                    	),
                    	
                    	'required'    => array(
                            array(
                                'setting'  => 'background_product',
                                'operator' => '==',
                                'value'    => 'featured',
                            ),
                            ),
                    );
              
              $fields[] = array(
               'type'        => 'image',
            	'settings'    => 'default_overlay_image_product',
            	'label'       => esc_attr__( 'Product Overlay Image', 'mayosis' ),
            	'description' => esc_attr__( 'Upload product background image', 'mayosis' ),
            	'section'     => 'product_template',
            	'default'     => '',
               );
               
               $fields[] = array(
                        'type'        => 'sortable',
                    	'settings'    => 'product_content_layout_manager',
                    	'label'       => __( 'Product Content Layout Manager', 'mayosis' ),
                    	'section'     => 'product_template',
                    	'default'     => array(
                    		'breadcrumb',
                    		'title',
                    		'category',
                    		'date',
                    		'button'
                    	),
                    	'choices'     => array(
                    		'breadcrumb' => esc_attr__( 'Breadcrumb', 'mayosis' ),
                    		'title' => esc_attr__( 'Title', 'mayosis' ),
                    		'author' => esc_attr__( 'Author', 'mayosis' ),
                    		'category' => esc_attr__( 'Category', 'mayosis' ),
                    		'date' => esc_attr__( 'Date', 'mayosis' ),
                    		'button' => esc_attr__( 'Action Button', 'mayosis' ),
                    	),
                    	'priority'    => 10,
                        );
                        
                        
                    
                     $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'product_gallery_width',
                    	'label'       => __( 'Product Gallery Type', 'mayosis' ),
                    	'section'     => 'product_template',
                    	'default'     => 'two',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'one'   => esc_attr__( 'Full Width', 'mayosis' ),
                    		'two' => esc_attr__( 'With Sidebar', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'product_top_social_share',
                    	'label'       => __( 'Product Top Social Share', 'mayosis' ),
                    	'section'     => 'product_template',
                    	'default'     => 'show',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'show'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    
                $fields[] = array(
                  'type'        => 'color',
                  'settings'     => 'photo_template_bg',
                  'label'       => __( 'Photo Template Bg Color', 'mayosis' ),
                  'description' => __( 'Change  Background Color', 'mayosis' ),
                  'section'     => 'photo_template',
                  'priority'    => 10,
                  'default'     => '#e9ebf7',
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
                    	'settings'    => 'photo_template_view',
                    	'label'       => __( 'Photo Template Layout', 'mayosis' ),
                    	'section'     => 'photo_template',
                    	'default'     => 'fixed',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'fixed'   => esc_attr__( 'Fixed', 'mayosis' ),
                    		'flexible' => esc_attr__( 'Flexible', 'mayosis' ),
                    	),
                    );
                        $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'blog_featured_visibility',
                    	'label'       => __( 'Blog Featured Image Visibility', 'mayosis' ),
                    	'section'     => 'blog_template',
                    	'default'     => 'show',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'show'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    
            $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'featured_position_blog',
                    	'label'       => __( 'Blog Featured Image Position', 'mayosis' ),
                    	'section'     => 'blog_template',
                    	'default'     => 'left',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'left'   => esc_attr__( 'Left', 'mayosis' ),
                    		'right' => esc_attr__( 'Right', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'blog_header_content_position',
                    	'label'       => __( 'Blog Header Content Position', 'mayosis' ),
                    	'section'     => 'blog_template',
                    	'default'     => 'left',
                    	'priority'    => 10,
                    	'multiple'    => 1,
                    	'choices'     => array(
                    		'left' => esc_attr__( 'Left', 'mayosis' ),
                    		'center' => esc_attr__( 'Center', 'mayosis' ),
                    		'right' => esc_attr__( 'Right', 'mayosis' ),
           
                    	),
                                        );
                        
                          $fields[] = array(
          'type'        => 'select',
        	'settings'    => 'blog_bg_type',
        	'label'       => __( 'Blog Breadcrumb Background Type', 'mayosis' ),
        	'section'     => 'blog_template',
        	'default'     => 'gradient',
        	'priority'    => 10,
        	'choices'     => array(
        		'color'  => esc_attr__( 'Color', 'mayosis' ),
        		'gradient' => esc_attr__( 'Gradient', 'mayosis' ),
        		'image' => esc_attr__( 'Image', 'mayosis' ),
        		'featured' => esc_attr__( 'Featured Image', 'mayosis' ),
        	),
         );
         
         $fields[] = array(
          'type'        => 'color',
          'settings'     => 'blog_background',
          'label'       => __( 'Breadcrumb Background Color', 'mayosis' ),
          'description' => __( 'Set Breadcrumb Background color', 'mayosis' ),
          'section'     => 'blog_template',
          'priority'    => 10,
          'default'     => '#282837', 
          'required'    => array(
                array(
                    'setting'  => 'blog_bg_type',
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
            'settings'    => 'blog_gradient',
            'label'       => esc_attr__( 'Breadcrumb gradient', 'mayosis' ),
            'section'     => 'blog_template',
            'priority'    => 10,
            'required'    => array(
            array(
                'setting'  => 'blog_bg_type',
                'operator' => '==',
                'value'    => 'gradient',
            ),
        ),
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
               'type'        => 'image',
            	'settings'    => 'blog_bg_image',
            	'label'       => esc_attr__( 'Breadcrumb Background Image', 'mayosis' ),
            	'description' => esc_attr__( 'Upload Product/Blog background image', 'mayosis' ),
            	'section'     => 'blog_template',
            	'required'    => array(
            array(
                'setting'  => 'blog_bg_type',
                'operator' => '==',
                'value'    => 'image',
                    ),
                ),
            	'default'     => '',
               );
               
               $fields[] = array(
          'type'        => 'radio-buttonset',
        	'settings'    => 'blog_bg_image_repeat',
        	'label'       => __( 'Image Repeat', 'mayosis' ),
        	'section'     => 'blog_template',
        	'default'     => 'repeat',
        	'priority'    => 10,
        	'choices'     => array(
        		'repeat'  => esc_attr__( 'Repeat', 'mayosis' ),
        		'cover' => esc_attr__( 'Cover', 'mayosis' ),
        		
        	),
        	'required'    => array(
            array(
                'setting'  => 'blog_bg_type',
                'operator' => '==',
                'value'    => 'image',
                    ),
                ),
         );
         $fields[] = array(
                               'type'     => 'text',
                            	'settings' => 'main_blog_blur',
                            	'label'    => __( 'Blur Radius', 'mayosis' ),
                            	'section'  => 'blog_template',
                            	'default'  => esc_attr__( '5px', 'mayosis' ),
                            	'priority' => 10,
                            	'required'    => array(
                                array(
                                    'setting'  => 'blog_bg_type',
                                    'operator' => '==',
                                    'value'    => 'featured',
                                ),
                            ),
                               );
                               
                               
                        $fields[] = array(
                      'type'        => 'color',
                      'settings'     => 'blog_ovarlay_main',
                      'label'       => __( 'Overlay Color', 'mayosis' ),
                      'description' => __( 'Change  Overlay Color', 'mayosis' ),
                      'section'     => 'blog_template',
                      'priority'    => 10,
                      'default'     => 'rgb(40,40,50,.5)',
                      'choices'     => array(
                        		'alpha' => true,
                        	),
                                                    
                        'required'    => array(
                            array(
                                'setting'  => 'blog_bg_type',
                                'operator' => '==',
                                'value'    => 'featured',
                            ),
                            ),
                  );
                  
                  $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'parallax_featured_image_blog',
                    	'label'       => __( 'Featured Image Parallax', 'mayosis' ),
                    	'section'     => 'blog_template',
                    	'default'     => 'no',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'yes'   => esc_attr__( 'Yes', 'mayosis' ),
                    		'no' => esc_attr__( 'No', 'mayosis' ),
                    	),
                    	
                    	'required'    => array(
                            array(
                                'setting'  => 'blog_bg_type',
                                'operator' => '==',
                                'value'    => 'featured',
                            ),
                            ),
                    );
              
         $fields[] = array(
               'type'        => 'image',
            	'settings'    => 'blog_overlay_image',
            	'label'       => esc_attr__( 'Blog Overlay Image', 'mayosis' ),
            	'description' => esc_attr__( 'Upload product background image', 'mayosis' ),
            	'section'     => 'blog_template',
            	'default'     => '',
               );
               
                $fields[] = array(
                        'type'        => 'sortable',
                    	'settings'    => 'blog_content_layout_manager',
                    	'label'       => __( 'Blog Content Layout Manager', 'mayosis' ),
                    	'section'     => 'blog_template',
                    	'default'     => array(
                    		'breadcrumb',
                    		'title',
                    		'category',
                    		'date',
                    	),
                    	'choices'     => array(
                    		'breadcrumb' => esc_attr__( 'Breadcrumb', 'mayosis' ),
                    		'title' => esc_attr__( 'Title', 'mayosis' ),
                    		'author' => esc_attr__( 'Author', 'mayosis' ),
                    		'category' => esc_attr__( 'Category', 'mayosis' ),
                    		'date' => esc_attr__( 'Date', 'mayosis' ),
                    	),
                    	'priority'    => 10,
                        );
                        
                         $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'author_single_post',
                    	'label'       => __( 'Blog Author Box In Single Post', 'mayosis' ),
                    	'section'     => 'blog_template',
                    	'default'     => 'hide',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    
                     $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'blog_sidebar_remove',
                    	'label'       => __( 'Blog Sidebar Hide', 'mayosis' ),
                    	'section'     => 'blog_template',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    
                    
                    $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'blog_comment_size',
                    	'label'       => __( 'Blog Comment', 'mayosis' ),
                    	'section'     => 'blog_template',
                    	'default'     => 'two',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'one'   => esc_attr__( 'Full Width', 'mayosis' ),
                    		'two' => esc_attr__( 'With Sidebar', 'mayosis' ),
                    	),
                    );
                    
           return $fields;
    }
    add_filter( 'kirki/fields', 'mayosis_template_fields' );
     ?>
