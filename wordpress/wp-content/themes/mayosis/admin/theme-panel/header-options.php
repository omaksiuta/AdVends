<?php

function mayosis_header_sections( $wp_customize ) {
     /**
     * Add Panel
     */
     $wp_customize->add_panel( 'mayosis_header', array(
      'priority'    => 2,
      'title'       => __( 'Header', 'mayosis' ),
      'description' => __( 'mayosis Header', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'main_header', array(
      'title'       => __( 'Main header', 'mayosis' ),
      'priority'    => 20,
      'panel'       => 'mayosis_header',
      'description' => __( 'Change site header options', 'mayosis' ),
     ) );
    
      $wp_customize->add_section( 'top_header', array(
      'title'       => __( 'Top header', 'mayosis' ),
      'priority'    => 30,
      'panel'       => 'mayosis_header',
      'description' => __( 'Change Top header options', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'header_style', array(
      'title'       => __( 'Header Options', 'mayosis' ),
      'priority'    => 40,
      'panel'       => 'mayosis_header',
      'description' => __( 'Change Header Style options', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'logo', array(
      'title'       => __( 'Logo', 'mayosis' ),
      'priority'    => 50,
      'panel'       => 'mayosis_header',
      'description' => __( 'Change Logo options', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'favicon', array(
      'title'       => __( 'Favicon', 'mayosis' ),
      'priority'    => 60,
      'panel'       => 'mayosis_header',
      'description' => __( 'Upload Favicon', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'sticky_header', array(
      'title'       => __( 'Sticky Header', 'mayosis' ),
      'priority'    => 70,
      'panel'       => 'mayosis_header',
      'description' => __( 'Sticky Header Options', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'breadcrumb', array(
      'title'       => __( 'Breadcrumb', 'mayosis' ),
      'priority'    => 80,
      'panel'       => 'mayosis_header',
      'description' => __( 'Breadcrumb Options', 'mayosis' ),
     ) );
     
     $wp_customize->add_section( 'social_link', array(
      'title'       => __( 'Social', 'mayosis' ),
      'priority'    => 90,
      'panel'       => 'mayosis_header',
      'description' => __( 'Social Links', 'mayosis' ),
     ) );
    
    }
    add_action( 'customize_register', 'mayosis_header_sections' );
    
        function mayosis_header_fields( $fields ) {
            $fields[] = array(
                'type'        => 'radio-image',
            	'settings'    => 'header_layout_type',
            	'label'       => esc_html__( 'Layout Type', 'mayosis' ),
            	'section'     => 'main_header',
            	'default'     => 'one',
            	'priority'    => 10,
            	'choices'     => array(
            		'one'   => get_template_directory_uri() . '/images/Header-1.png',
            		'two' => get_template_directory_uri() . '/images/Header-2.png',
            		'three'  => get_template_directory_uri() . '/images/Header-3.png',
            	),
                );
                 $fields[] = array(
                     'type'        => 'radio-buttonset',
                    	'settings'    => 'logo_hide',
                    	'label'       => __( 'Main Logo', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'  => esc_attr__( 'Show', 'mayosis' ),
                    		'off' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    	'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'one',
                                ),
                            ),
                     );
                $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'menu_position',
                    	'label'       => __( 'Menu Position', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'left',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'left'   => esc_attr__( 'Left', 'mayosis' ),
                    		'right' => esc_attr__( 'Right', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'one',
                                ),
                            ),
                    );
                    
                     $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'left_option',
                    	'label'       => __( 'Select Left Side Option', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'menu',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'none'   => esc_attr__( 'None', 'mayosis' ),
                    		'menu' => esc_attr__( 'Menu', 'mayosis' ),
                    		'hamburger' => esc_attr__( 'Hamburger', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'two',
                                ),
                            ),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'right_option',
                    	'label'       => __( 'Select Right Side Option', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'menu',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'none'   => esc_attr__( 'None', 'mayosis' ),
                    		'menu' => esc_attr__( 'Menu', 'mayosis' ),
                    		'hamburger' => esc_attr__( 'Hamburger', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'two',
                                ),
                            ),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'left_menu_position',
                    	'label'       => __( 'Left Menu Position', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'left',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'left'   => esc_attr__( 'Left', 'mayosis' ),
                    		'right' => esc_attr__( 'Right', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'two',
                                ),
                            ),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'right_menu_position',
                    	'label'       => __( 'Right Menu Position', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'right',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'left'   => esc_attr__( 'Left', 'mayosis' ),
                    		'right' => esc_attr__( 'Right', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'two',
                                ),
                            ),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'right_side_option_menu',
                    	'label'       => __( 'Right Side Option menu', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Enable', 'mayosis' ),
                    		'off' => esc_attr__( 'Disable', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'two',
                                ),
                            ),
                    );
                    
                    $fields[] = array(
                        'type'        => 'image',
                    	'settings'    => 'sidebar_logo_icon',
                    	'label'       => esc_attr__( 'Sidebar Logo Icon Upload', 'mayosis' ),
                    	'description' => esc_attr__( 'Recommanded Size 40x40px', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => '',
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'three',
                                ),
                            ),
                        );
                        
                        $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'default_side_menu',
                    	'label'       => __( 'Default Side Menu', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'expanded',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'collapse'   => esc_attr__( 'Collapsed', 'mayosis' ),
                    		'expanded' => esc_attr__( 'Expanded', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'three',
                                ),
                            ),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'search_cartmenu',
                    	'label'       => __( 'Search & Cart Menu', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Enable', 'mayosis' ),
                    		'off' => esc_attr__( 'Disable', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'three',
                                ),
                            ),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'secondary_header',
                    	'label'       => __( 'Secondary Header', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Enable', 'mayosis' ),
                    		'off' => esc_attr__( 'Disable', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'three',
                                ),
                            ),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'collapse_button',
                    	'label'       => __( 'Collapse Button', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Show', 'mayosis' ),
                    		'off' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'three',
                                ),
                            ),
                    );
                    
                     $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'icon_in_expanded',
                    	'label'       => __( 'Icon in Expanded Mode', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Show', 'mayosis' ),
                    		'off' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'three',
                                ),
                            ),
                    );
                    
                     $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'text_in_collapsed',
                    	'label'       => __( 'Text in Collapsed Mode', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Show', 'mayosis' ),
                    		'off' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    		'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'three',
                                ),
                            ),
                    );
                    
                     $fields[] = array(
                       'type'        => 'slider',
                    	'settings'    => 'collapse_bar_width',
                    	'label'       => esc_attr__( 'Collapsed bar Width', 'mayosis' ),
                    	'section'     => 'main_header',
                    	'default'     => 80,
                    	'choices'     => array(
                    		'min'  => 40,
                    		'max'  => 100,
                    		'step' =>5,
                    	),
                    	
                    	'required'    => array(
                        array(
                            'setting'  => 'header_layout_type',
                            'operator' => '==',
                            'value'    => 'three',
                                ),
                            ),
                       );
                       
                       $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'top_header_show',
                    	'label'       => __( 'Top Header', 'mayosis' ),
                    	'section'     => 'top_header',
                    	'default'     => 'off',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Show', 'mayosis' ),
                    		'off' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'top_header_height',
                    	'label'       => esc_attr__( 'Header Height', 'mayosis' ),
                    	'description' => esc_attr__( 'Change top header height', 'mayosis' ),
                    	'section'     => 'top_header',
                    	'default'     => '40px',
                    );
                    
                     $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'top_left_element',
                    	'label'       => __( 'Select Left Header Element', 'mayosis' ),
                    	'section'     => 'top_header',
                    	'default'     => 'social',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'logo'   => esc_attr__( 'Logo', 'mayosis' ),
                    		'menu' => esc_attr__( 'Menu', 'mayosis' ),
                    		'social' => esc_attr__( 'Social', 'mayosis' ),
                    		'menuicon' => esc_attr__( 'Menu With Cart', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'top_right_element',
                    	'label'       => __( 'Select Right Header Element', 'mayosis' ),
                    	'section'     => 'top_header',
                    	'default'     => 'menu',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'logo'   => esc_attr__( 'Logo', 'mayosis' ),
                    		'menu' => esc_attr__( 'Menu', 'mayosis' ),
                    		'social' => esc_attr__( 'Social', 'mayosis' ),
                    		'menuicon' => esc_attr__( 'Menu With Cart', 'mayosis' ),
                    	),
                    );
                    
                     $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'top_cart',
                    	'label'       => __( 'Top Cart', 'mayosis' ),
                    	'section'     => 'top_header',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Show', 'mayosis' ),
                    		'off' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'top_login',
                    	'label'       => __( 'Top Login/Logout', 'mayosis' ),
                    	'section'     => 'top_header',
                    	'default'     => 'on',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Show', 'mayosis' ),
                    		'off' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'top_icon_size',
                    	'label'       => esc_attr__( 'Top Header Menu Icons Font Size', 'mayosis' ),
                    	'description' => esc_attr__( 'Change Top Header Menu Icons Font Size', 'mayosis' ),
                    	'section'     => 'top_header',
                    	'default'     => '12px',
                    );
                    $fields[] = array(
                        'type'        => 'sortable',
                    	'settings'    => 'header_layout_manager',
                    	'label'       => __( 'Header Layout Manager', 'mayosis' ),
                    	'section'     => 'header_style',
                    	'default'     => array(
                    		'cart',
                    		'search',
                    		'login'
                    	),
                    	'choices'     => array(
                    		'search' => esc_attr__( 'Search', 'mayosis' ),
                    		'cart' => esc_attr__( 'Cart', 'mayosis' ),
                    		'login' => esc_attr__( 'Login', 'mayosis' ),
                    	),
                    	'priority'    => 10,
                        );
                    
                    $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'main_header_height',
                    	'label'       => esc_attr__( 'Header Height', 'mayosis' ),
                    	'description' => esc_attr__( 'Change main header height', 'mayosis' ),
                    	'section'     => 'header_style',
                    	'default'     => '80px',
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimensions',
                    	'settings'    => 'main_header_padding',
                    	'label'       => esc_attr__( 'Header Padding', 'mayosis' ),
                    	'description' => esc_attr__( 'Change main header Padding', 'mayosis' ),
                    	'section'     => 'header_style',
                    	'default'     => array(
                			'padding-top'    => '0px',
                			'padding-bottom' => '0px',
                			'padding-left'   => '0px',
                			'padding-right'  => '0px',
                		),
                    );
                    $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'header_icon_size',
                    	'label'       => esc_attr__( 'Header Icon Size', 'mayosis' ),
                    	'description' => esc_attr__( 'Change Header Icon Size', 'mayosis' ),
                    	'section'     => 'header_style',
                    	'default'     => '13px',
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'header_transparency',
                    	'label'       => __( 'Header Transparency', 'mayosis' ),
                    	'section'     => 'header_style',
                    	'default'     => 'transparent',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'normal'   => esc_attr__( 'Normal', 'mayosis' ),
                    		'transparent' => esc_attr__( 'Transparent', 'mayosis' ),
                    	),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-image',
                	'settings'    => 'cart_style',
                	'label'       => esc_html__( 'Cart Style', 'mayosis' ),
                	'section'     => 'header_style',
                	'default'     => 'one',
                	'priority'    => 10,
                	'choices'     => array(
                		'one'   => get_template_directory_uri() . '/images/cart-style-1.png',
                		'two' => get_template_directory_uri() . '/images/cart-style-2.png',
                	),
                    );
                    
                    $fields[] = array(
                    'type'        => 'radio-image',
                	'settings'    => 'search_style',
                	'label'       => esc_html__( 'Search Style', 'mayosis' ),
                	'section'     => 'header_style',
                	'default'     => 'one',
                	'priority'    => 10,
                	'choices'     => array(
                		'one'   => get_template_directory_uri() . '/images/search-style-1.png',
                		'two' => get_template_directory_uri() . '/images/search-style-2.png',
                	),
                    );
                    
                
                    $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'search_behaviour',
                    	'label'       => __( 'Search Beahviour', 'mayosis' ),
                    	'section'     => 'header_style',
                    	'default'     => 'dropdown',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'dropdown'   => esc_attr__( 'Dropdown', 'mayosis' ),
                    		'collapse' => esc_attr__( 'Collapse', 'mayosis' ),
                    		'fullscreen' => esc_attr__( 'Fullscreen Overlay', 'mayosis' ),
                    	),
                    	'required'    => array(
                        array(
                            'setting'  => 'search_style',
                            'operator' => '==',
                            'value'    => 'one',
                                ),
                            ),
                    );
                    
                     $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'login_logout_bg_remove',
                    	'label'       => __( 'Login/Logout Button Background Remove', 'mayosis' ),
                    	'section'     => 'header_style',
                    	'default'     => 'notremove',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'remove'   => esc_attr__( 'On', 'mayosis' ),
                    		'notremove' => esc_attr__( 'Off', 'mayosis' ),
                    	),
                    );
                    
                     $fields[] = array(
                        'type'     => 'text',
                    	'settings' => 'login_text',
                    	'label'    => __( 'Login Button Text', 'mayosis' ),
                    	'section'  => 'header_style',
                    	'default'  => esc_attr__( 'Login', 'mayosis' ),
                    	'priority' => 10,
                         );
                         
                          $fields[] = array(
                        'type'     => 'text',
                    	'settings' => 'logout_text',
                    	'label'    => __( 'Logout Button Text', 'mayosis' ),
                    	'section'  => 'header_style',
                    	'default'  => esc_attr__( 'Logout', 'mayosis' ),
                    	'priority' => 10,
                         );
                         
                         $fields[] = array(
                        'type'     => 'text',
                    	'settings' => 'login_url',
                    	'label'    => __( 'Login Link', 'mayosis' ),
                    	'section'  => 'header_style',
                    	'default'  => esc_attr__( 'http://demo.com/login', 'mayosis' ),
                    	'priority' => 10,
                         );
                         
                         $fields[] = array(
                    'type'        => 'radio-buttonset',
                    	'settings'    => 'menu-icon-main',
                    	'label'       => __( 'Menu Icon', 'mayosis' ),
                    	'section'     => 'header_style',
                    	'default'     => 'hide',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'show'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    
                    );
                        
                        $fields[] = array(
                        'type'        => 'image',
                    	'settings'    => 'main_logo',
                    	'label'       => esc_attr__( 'Logo', 'mayosis' ),
                    	'description' => esc_attr__( 'Recommanded Height 40px', 'mayosis' ),
                    	'section'     => 'logo',
                    	'default'     => get_template_directory_uri() . '/images/logo.png',
                        );
                        
                        $fields[] = array(
                        'type'        => 'image',
                    	'settings'    => 'sticky_logo',
                    	'label'       => esc_attr__( 'Sticky Logo', 'mayosis' ),
                    	'description' => esc_attr__( 'Recommanded Height 40px', 'mayosis' ),
                    	'section'     => 'logo',
                    	'default'     => get_template_directory_uri() . '/images/logo.png',
                        );
                        
                        $fields[] = array(
                        'type'        => 'dimension',
                    	'settings'    => 'logo_height',
                    	'label'       => esc_attr__( 'Logo height', 'mayosis' ),
                    	'description' => esc_attr__( 'Add logo height', 'mayosis' ),
                    	'section'     => 'logo',
                    	'default'     => '40px',
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimensions',
                    	'settings'    => 'Logo Margin',
                    	'label'       => esc_attr__( 'Logo Margin', 'mayosis' ),
                    	'description' => esc_attr__( 'Change Logo margin', 'mayosis' ),
                    	'section'     => 'logo',
                    	'default'     => array(
                			'margin-top'    => '0px',
                			'margin-bottom' => '0px',
                			'margin-left'   => '0px',
                			'margin-right'  => '0px',
                		),
                    );
                    
                     $fields[] = array(
                        'type'        => 'image',
                    	'settings'    => 'favicon-upload',
                    	'label'       => esc_attr__( 'Favicon', 'mayosis' ),
                    	'description' => esc_attr__( 'Recommanded 80 X 80px', 'mayosis' ),
                    	'section'     => 'favicon',
                    	'default'     => get_template_directory_uri() . '/images/fav.png',
                        );
                        
                        $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'sticky_hide',
                    	'label'       => __( 'Sticky Header', 'mayosis' ),
                    	'section'     => 'sticky_header',
                    	'default'     => 'hide',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Show', 'mayosis' ),
                    		'hide' => esc_attr__( 'Hide', 'mayosis' ),
                    	),
                    );
                    
                     $fields[] = array(
                        'type'        => 'radio-buttonset',
                    	'settings'    => 'smart_sticky',
                    	'label'       => __( 'Smart Sticky ', 'mayosis' ),
                    	'section'     => 'sticky_header',
                    	'default'     => 'hide',
                    	'priority'    => 10,
                    	'choices'     => array(
                    		'on'   => esc_attr__( 'Enable', 'mayosis' ),
                    		'hide' => esc_attr__( 'Disable', 'mayosis' ),
                    	),
                    	'required'    => array(
                        array(
                            'setting'  => 'top_header_show',
                            'operator' => '==',
                            'value'    => 'off',
                                ),
                            ),
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimensions',
                    	'settings'    => 'page_padding',
                    	'label'       => esc_attr__( 'Page Breadcrumb Padding', 'mayosis' ),
                    	'description' => esc_attr__( 'Change Breadcrumb Padding', 'mayosis' ),
                    	'section'     => 'breadcrumb',
                    	'default'     => array(
                			'padding-top'    => '180px',
                			'padding-bottom' => '120px',
                			'padding-left'   => '0px',
                			'padding-right'  => '0px',
                		),
                    );
                    
                    $fields[] = array(
                        'type'        => 'dimensions',
                    	'settings'    => 'product_padding',
                    	'label'       => esc_attr__( 'Product/Blog Breadcrumb Padding', 'mayosis' ),
                    	'description' => esc_attr__( 'Change Breadcrumb Padding', 'mayosis' ),
                    	'section'     => 'breadcrumb',
                    	'default'     => array(
                			'padding-top'    => '180px',
                			'padding-bottom' => '120px',
                			'padding-left'   => '0px',
                			'padding-right'  => '0px',
                		),
                    );
                     $fields[] = array(
                         'type'        => 'repeater',
                        	'label'       => esc_attr__( 'Social Icon', 'mayosis' ),
                        	'section'     => 'social_link',
                        	'priority'    => 10,
                        	'row_label' => array(
                        		'type' => 'text',
                        		'value' => esc_attr__('Social Item', 'mayosis' ),
                        	),
                        	'settings'    => 'social_icons_repeat',
                        	'default'     => array(
                        		array(
                        			'link_icon' => esc_attr__( 'Facebook', 'mayosis' ),
                        			'link_url'  => 'https://facebook.com',
                        		),
                        		array(
                        			'link_text' => esc_attr__( 'Twitter', 'mayosis' ),
                        			'link_url'  => 'https://twitter.com',
                        		),
                        	),
                        	'fields' => array(
                        		'link_icon' => array(
                        			'type'        => 'select',
                        			'label'       => esc_attr__( 'Icon', 'mayosis' ),
                        			'default'     => '',
                        			'choices'     => array(
                                    	'fa-facebook-f' => esc_attr__( 'Facebook', 'mayosis' ),
                                    	
                                    	'fa-twitter' => esc_attr__( 'Twitter', 'mayosis' ),
                                    	
                                    	'fa-instagram' => esc_attr__( 'Instagram', 'mayosis' ),
                                    	
                                    	'fa-google-plus-g' => esc_attr__( 'Google Plus', 'mayosis' ),
                                    	
                                    	'fa-linkedin-in' => esc_attr__( 'Linked In', 'mayosis' ),
                                    	
                                    	'fa-youtube' => esc_attr__( 'Youtube', 'mayosis' ),
                                    	
                                    	'fa-vk' => esc_attr__( 'vK', 'mayosis' ),
                                    	
                                    	'fa-pinterest-p' => esc_attr__( 'Pinterest', 'mayosis' ),
                                    	
                                    	'fa-dribbble' => esc_attr__( 'Dribbble', 'mayosis' ),
                                    	
                                    	'fa-behance' => esc_attr__( 'Behance', 'mayosis' ),
                                    	
                                    	'fa-flickr' => esc_attr__( 'Flickr', 'mayosis' ),
                                    	),
                        		),
                        		'link_url' => array(
                        			'type'        => 'text',
                        			'label'       => esc_attr__( 'Link URL', 'mayosis' ),
                        			'default'     => '',
                        		),
                        	)
                         );
              return $fields;
    }
    add_filter( 'kirki/fields', 'mayosis_header_fields' );
     ?>
