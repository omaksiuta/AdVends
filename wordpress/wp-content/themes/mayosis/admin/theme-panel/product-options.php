<?php

function mayosis_product_sections( $wp_customize ) {
     /**
     * Add Panel
     */
     $wp_customize->add_panel( 'mayosis_product', array(
      'priority'    => 3,
      'title'       => __( 'Product Options', 'mayosis' ),
      'description' => __( 'mayosis Product', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'product_options', array(
      'title'       => __( 'Grid Options', 'mayosis' ),
      'priority'    => 20,
      'panel'       => 'mayosis_product',
      'description' => __( 'Change site Product options', 'mayosis' ),
     ) );
     
      $wp_customize->add_section( 'product_more', array(
      'title'       => __( 'Other Options', 'mayosis' ),
      'priority'    => 20,
      'panel'       => 'mayosis_product',
      'description' => __( 'Change site Product options', 'mayosis' ),
     ) );
    
    }
    add_action( 'customize_register', 'mayosis_product_sections' );
    
        function mayosis_product_fields( $fields ) {
                     $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'product_grid_system',
                    	'label'       => __( 'Product Grid System', 'mayosis' ),
                    	'section'     => 'product_options',
                    	'default'     => 'one',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'one'   => esc_attr__( 'Normal', 'mayosis' ),
                    		'two' => esc_attr__( 'Masonary', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'product_grid_options',
                    	'label'       => __( 'Product Grid Options', 'mayosis' ),
                    	'section'     => 'product_options',
                    	'default'     => 'one',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'one'   => esc_attr__( 'With Meta', 'mayosis' ),
                    		'two' => esc_attr__( 'Without Meta', 'mayosis' ),
                    	),
                    	'required'    => array(
                                array(
                                    'setting'  => 'product_grid_system',
                                    'operator' => '==',
                                    'value'    => 'one',
                                ),
                                
                            ),
                    );
                    
                    $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'product_hover_top',
                    	'label'       => __( 'Hover Top Elements', 'mayosis' ),
                    	'section'     => 'product_options',
                    	'default'     => 'cart',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'none'   => esc_attr__( 'None', 'mayosis' ),
                    		'cart' => esc_attr__( 'Add to Cart', 'mayosis' ),
                    		'share' => esc_attr__( 'Share', 'mayosis' ),
                    		'sales' => esc_attr__( 'Sales and Download', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'product_hover_bottom',
                    	'label'       => __( 'Hover Bottom Elements', 'mayosis' ),
                    	'section'     => 'product_options',
                    	'default'     => 'share',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'none'   => esc_attr__( 'None', 'mayosis' ),
                    		'cart' => esc_attr__( 'Add to Cart', 'mayosis' ),
                    		'share' => esc_attr__( 'Share', 'mayosis' ),
                    		'sales' => esc_attr__( 'Sales and Download', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'product_meta_options',
                    	'label'       => __( 'Meta Options', 'mayosis' ),
                    	'section'     => 'product_options',
                    	'default'     => 'vendorcat',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'none'   => esc_attr__( 'None', 'mayosis' ),
                    		'vendor' => esc_attr__( 'Vendor', 'mayosis' ),
                    		'category' => esc_attr__( 'Category', 'mayosis' ),
                    		'vendorcat' => esc_attr__( 'Vendor and Category', 'mayosis' ),
                    		'sales' => esc_attr__( 'Sales and Download', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'product_pricing_options',
                    	'label'       => __( 'Pricing Options', 'mayosis' ),
                    	'section'     => 'product_options',
                    	'default'     => 'price',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'none'   => esc_attr__( 'None', 'mayosis' ),
                    		'price' => esc_attr__( 'Price', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'product_free_options',
                    	'label'       => __( 'Free Pricing Options', 'mayosis' ),
                    	'section'     => 'product_options',
                    	'default'     => 'custom',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'none'   => esc_attr__( '$0.00', 'mayosis' ),
                    		'custom' => esc_attr__( 'Custom Text', 'mayosis' ),
                    	),
                    	'required'    => array(
                                array(
                                    'setting'  => 'product_pricing_options',
                                    'operator' => '==',
                                    'value'    => 'price',
                                ),
                                
                            ),
                    );
                     $fields[] = array(
                         'type'     => 'text',
                    	'settings' => 'free_text',
                    	'label'    => __( 'Custom Text', 'mayosis' ),
                    	'section'  => 'product_options',
                    	'default'  => esc_attr__( 'FREE', 'mayosis' ),
                    	'priority' => 10,
                    	'required'    => array(
                                array(
                                    'setting'  => 'product_free_options',
                                    'operator' => '==',
                                    'value'    => 'custom',
                                ),
                                
                            ),
                         );
                         
                          $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'variable_pricing_options',
                    	'label'       => __( 'Variable Pricing Options', 'mayosis' ),
                    	'section'     => 'product_options',
                    	'default'     => 'default',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'default'   => esc_attr__( 'Default', 'mayosis' ),
                    		'popup' => esc_attr__( 'Popup', 'mayosis' ),
                    	),

                    );
                    
                      
                    
                    $fields[] = array(
                         'type'     => 'text',
                    	'settings' => 'live_preview_text',
                    	'label'    => __( 'Live Preview Text', 'mayosis' ),
                    	'section'  => 'product_more',
                    	'default'  => esc_attr__( 'Live Preview', 'mayosis' ),
                    	'priority' => 10,
                         );
                         
                         $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'product_bottom_buttons',
                    	'label'       => __( 'Product Bottom Buttons', 'mayosis' ),
                    	'section'     => 'product_more',
                    	'default'     => 'show',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'show'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),

                    );
                    
                    $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'product_bottom_extratext',
                    	'label'       => __( 'Product Bottom Buttons Text & Count', 'mayosis' ),
                    	'section'     => 'product_more',
                    	'default'     => 'show',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'show'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),

                    );
                    
                    $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'product_bottom_social_share',
                    	'label'       => __( 'Product Bottom Social Share', 'mayosis' ),
                    	'section'     => 'product_more',
                    	'default'     => 'show',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'show'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                        'type'        => 'select',
                    	'settings'    => 'product_bottom_tags',
                    	'label'       => __( 'Product Tags', 'mayosis' ),
                    	'section'     => 'product_more',
                    	'default'     => 'hide',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'show'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),

                    );
                    
                    $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'product_gallery_type',
                    	'label'       => __( 'Product Gallery Layout Type', 'mayosis' ),
                    	'section'     => 'product_more',
                    	'default'     => 'one',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'one'   => esc_attr__( 'Bottom Thumb', 'mayosis' ),
                    		'two' => esc_attr__( 'Side Thumb', 'mayosis' ),
                    		'three' => esc_attr__( 'Without Thumb', 'mayosis' ),
                    		'four' => esc_attr__( 'Carousel', 'mayosis' ),
                    	),
                    );
                   
            return $fields;
    }
    add_filter( 'kirki/fields', 'mayosis_product_fields' );
     ?>
