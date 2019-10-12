<?php

function mayosis_footer_sections( $wp_customize ) {
     /**
     * Add Panel
     */
     $wp_customize->add_panel( 'mayosis_footer', array(
      'priority'    => 6,
      'title'       => __( 'Footer', 'mayosis' ),
      'description' => __( 'mayosis Footer', 'mayosis' ),
       'icon' => 'fa fa-dribbble',
     ) );
     
     $wp_customize->add_section( 'main_footer', array(
      'title'       => __( 'Footer Options', 'mayosis' ),
      'priority'    => 40,
      'panel'       => 'mayosis_footer',
      'description' => __( 'Change site footer options', 'mayosis' ),
     ) );
     
}
    add_action( 'customize_register', 'mayosis_footer_sections' );
    
      function mayosis_footer_fields( $fields ) {
         $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'footer_widget_hide',
                    	'label'       => __( 'Footer Widget', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    
                     $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'footer_widget_column',
                    	'label'       => __( 'Footer Widget Column', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => 'five',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'one'   => esc_attr__( 'One', 'mayosis' ),
                    		'two' => esc_attr__( 'Two', 'mayosis' ),
                    		'three' => esc_attr__( 'Three', 'mayosis' ),
                    		'four' => esc_attr__( 'Four', 'mayosis' ),
                    		'five' => esc_attr__( 'Five', 'mayosis' ),
                    		'six' => esc_attr__( 'Six', 'mayosis' ),
                    	),
                    	
                    		'required'    => array(
                        array(
                            'setting'  => 'footer_widget_hide',
                            'operator' => '==',
                            'value'    => 'on',
                        ),
                        
                    ),
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'column_one_width',
                    	'label'       => esc_attr__( 'Column One Width', 'mayosis' ),
                    	'description' => esc_attr__( 'Add Column One Width on %', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => '15%',
                    		'required'    => array(
                        array(
                            'setting'  => 'footer_widget_hide',
                            'operator' => '==',
                            'value'    => 'on',
                        ),
                        
                    ),
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'column_two_width',
                    	'label'       => esc_attr__( 'Column Two Width', 'mayosis' ),
                    	'description' => esc_attr__( 'Add Column Two Width on %', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => '15%',
                    		'required'    => array(
                        array(
                            'setting'  => 'footer_widget_hide',
                            'operator' => '==',
                            'value'    => 'on',
                        ),
                        
                    ),
                    
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'column_three_width',
                    	'label'       => esc_attr__( 'Column Three Width', 'mayosis' ),
                    	'description' => esc_attr__( 'Add Column Three Width on %', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => '15%',
                    		'required'    => array(
                        array(
                            'setting'  => 'footer_widget_hide',
                            'operator' => '==',
                            'value'    => 'on',
                        ),
                        
                    ),
                    	
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'column_four_width',
                    	'label'       => esc_attr__( 'Column Four Width', 'mayosis' ),
                    	'description' => esc_attr__( 'Add Column Four Width on %', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => '15%',
                    		'required'    => array(
                        array(
                            'setting'  => 'footer_widget_hide',
                            'operator' => '==',
                            'value'    => 'on',
                        ),
                        
                    ),
                    	
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'column_five_width',
                    	'label'       => esc_attr__( 'Column Five Width', 'mayosis' ),
                    	'description' => esc_attr__( 'Add Column Five Width on %', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => '15%',
                    		'required'    => array(
                        array(
                            'setting'  => 'footer_widget_hide',
                            'operator' => '==',
                            'value'    => 'on',
                        ),
                        
                    ),
                    	
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'column_six_width',
                    	'label'       => esc_attr__( 'Column Six Width', 'mayosis' ),
                    	'description' => esc_attr__( 'Add Column Six Width on %', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => '15%',
                    		'required'    => array(
                        array(
                            'setting'  => 'footer_widget_hide',
                            'operator' => '==',
                            'value'    => 'on',
                        ),
                        
                    ),
                    
                    );
                    
                    $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'footer_additonal_widget',
                    	'label'       => __( 'Footer Additional Widget', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => 'hide',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'show'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	
                    	),
                    	'required'    => array(
                        array(
                            'setting'  => 'footer_widget_hide',
                            'operator' => '==',
                            'value'    => 'on',
                        ),
                        
                    ),
                    	
                    );
                    
                     $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'copyright_footer',
                    	'label'       => __( 'Copyright Footer', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => 'show',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'show'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	
                    	),
                    	
                    );
                    $fields[] = array(
                        'type'        => 'dimensions',
                    	'settings'    => 'main_footerr_padding',
                    	'label'       => esc_attr__( 'Footer Padding', 'mayosis' ),
                    	'description' => esc_attr__( 'Change Footer Padding', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => array(
                			'padding-top'    => '80px',
                			'padding-bottom' => '70px',
                			'padding-left'   => '0px',
                			'padding-right'  => '0px',
                		),
                    );
                     $fields[] = array(
                        'type'        => 'editor',
                    	'settings'    => 'copyright_text',
                    	'label'       => __( 'Copyright Text', 'mayosis' ),
                    	'section'     => 'main_footer',
                    	'default'     => esc_attr__( 'Copyright 2018 Mayosis Studio, All rights reserved!', 'mayosis' ),
                    	'priority'    => 20,
                    	);
          return $fields;
    }
    add_filter( 'kirki/fields', 'mayosis_footer_fields' );
     ?>
