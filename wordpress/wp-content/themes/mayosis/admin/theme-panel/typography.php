<?php

function mayosis_typography_sections( $wp_customize ) {
     /**
     * Add Panel
     */
     $wp_customize->add_panel( 'mayosis_typgraphy', array(
      'priority'    => 7,
      'title'       => __( 'Typography', 'mayosis' ),
      'description' => __( 'mayosis Typography', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'general_typo', array(
      'title'       => __( 'Body Typography', 'mayosis' ),
      'priority'    => 40,
      'panel'       => 'mayosis_typgraphy',
      'description' => __( 'Change site typogrpahy options', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'headings_typo', array(
      'title'       => __( 'Headings Typography', 'mayosis' ),
      'priority'    => 50,
      'panel'       => 'mayosis_typgraphy',
      'description' => __( 'Change site headings typogrpahy options', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'menu_typo', array(
      'title'       => __( 'Menu Typography', 'mayosis' ),
      'priority'    => 50,
      'panel'       => 'mayosis_typgraphy',
      'description' => __( 'Change site headings menu typogrpahy options', 'mayosis' ),
     ) );
}
    add_action( 'customize_register', 'mayosis_typography_sections' );
    
      function mayosis_typo_fields( $fields ) {
           $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'body_typography',
            	'label'       => esc_attr__( 'Body Typography', 'mayosis' ),
            	'section'     => 'general_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'font-size'      => '16px',
            		'line-height'    => '25px',
            		'variant'        => '400',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => 'body,table tbody tr td,table thead tr th, table tfoot tr td',
                		),
                		),

               );
               
                $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'breadcrumb_typography',
            	'label'       => esc_attr__( 'Page Breadcrumb Title Typography', 'mayosis' ),
            	'section'     => 'general_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => '900',
            		'font-size'      => '36px',
            		'line-height'    => '45px',
            		'letter-spacing'    => '-0.75',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => 'h2.page_title_single',
                		),
                		),
               );
               
                $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'product_title_typography',
            	'label'       => esc_attr__( 'Product/Blog Breadcrumb Title Typography', 'mayosis' ),
            	'section'     => 'general_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => '900',
            		'font-size'      => '36px',
            		'line-height'    => '45px',
            		'letter-spacing'    => '-0.75',
            		
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
                    'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => 'h1.single-post-title',
                		),
                		),
               );
               
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'h1_typography',
            	'label'       => esc_attr__( 'H1 Typography', 'mayosis' ),
            	'section'     => 'headings_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => '900',
            		'font-size'      => '36px',
            		'line-height'    => '45px',
            		'letter-spacing'    => '-0.75',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => 'h1',
                		),
                		),
               );
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'h2_typography',
            	'label'       => esc_attr__( 'H2 Typography', 'mayosis' ),
            	'section'     => 'headings_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => '900',
            		'font-size'      => '30px',
            		'line-height'    => '42px',
            		'letter-spacing'    => '-0.5',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => 'h2',
                		),
                		),
            	
               );
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'h3_typography',
            	'label'       => esc_attr__( 'H3 Typography', 'mayosis' ),
            	'section'     => 'headings_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => '900',
            		'font-size'      => '24px',
            		'line-height'    => '36px',
            		'letter-spacing'    => '0',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
                
            'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => 'h3',
                		),
                		),
               );
               
                $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'h4_typography',
            	'label'       => esc_attr__( 'H4 Typography', 'mayosis' ),
            	'section'     => 'headings_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => '900',
            		'font-size'      => '19px',
            		'line-height'    => '30px',
            		'letter-spacing'    => '0',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
                
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => 'h4',
                		),
                		),
               );
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'h5_typography',
            	'label'       => esc_attr__( 'H5 Typography', 'mayosis' ),
            	'section'     => 'headings_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => '900',
            		'font-size'      => '16px',
            		'line-height'    => '24px',
            		'letter-spacing'    => '0',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => 'h5',
                		),
                		),
               );
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'h6_typography',
            	'label'       => esc_attr__( 'H6 Typography', 'mayosis' ),
            	'section'     => 'headings_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => '900',
            		'font-size'      => '14px',
            		'line-height'    => '24px',
            		'letter-spacing'    => '.5',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => 'h6',
                		),
                		),
               );
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'main_menu_typography',
            	'label'       => esc_attr__( 'Main Menu', 'mayosis' ),
            	'section'     => 'menu_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => 'regular',
            		'font-size'      => '16px',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => '#mayosis-menu > ul > li > a,.main-header ul li.cart-style-one a.cart-button,.search-dropdown-main a,.menu-item a,.cart-style-two .cart-button',
                		),
                		),
               );
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'sub_menu_typography',
            	'label'       => esc_attr__( 'Sub Menu', 'mayosis' ),
            	'section'     => 'menu_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => 'regular',
            		'font-size'      => '16px',
            		'line-height'    => '30px',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	
            'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => '#mayosis-menu ul ul',
                		),
                		),
               );
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'top_menu_typography',
            	'label'       => esc_attr__( 'Top Menu', 'mayosis' ),
            	'section'     => 'menu_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => 'regular',
            		'font-size'      => '14px',
            		'line-height'    => '14px',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	 'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => '#top-main-menu > ul > li > a ,.top-header #cart-menu li a',
                		),
                		),
               );
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'top_submenu_typography',
            	'label'       => esc_attr__( 'Top Sub Menu', 'mayosis' ),
            	'section'     => 'menu_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => 'regular',
            		'font-size'      => '14px',
            		'line-height'    => '20px',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => ' #top-main-menu ul ul a',
                		),
                		),
               );
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'mobile_menu_typography',
            	'label'       => esc_attr__( 'Mobile Menu', 'mayosis' ),
            	'section'     => 'menu_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => 'regular',
            		'font-size'      => '14px',
            		'line-height'    => '20px',
            		
            	),
            	'priority'    => 10,
            	
            	'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
            	
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => '#sidebar-wrapper .navbar-nav > li > a, #sidebar-wrapper #mega-menu-wrap-main-menu #mega-menu-main-menu > li.mega-menu-item > a.mega-menu-link',
                		),
                		),
               );
               
               $fields[] = array(
               'type'        => 'typography',
            	'settings'    => 'mobile_submenu_typography',
            	'label'       => esc_attr__( 'Mobile Sub Menu', 'mayosis' ),
            	'section'     => 'menu_typo',
            	'default'     => array(
            		'font-family'    => 'Lato',
            		'variant'        => 'regular',
            		'font-size'      => '14px',
            		'line-height'    => '20px',
            		
            	),
            	'priority'    => 10,
            	
            'choices' => array(
                	'fonts' => array(
                		'google' => array( 'popularity', 60 ),
                	),
                ),
                
            	'transport' => 'auto',
                	'output'    => array(
                		array(
                			'element' => '#sidebar-wrapper .dropdown-menu > li > a',
                		),
                		),
               );
           return $fields;
    }
    add_filter( 'kirki/fields', 'mayosis_typo_fields' );
     ?>
