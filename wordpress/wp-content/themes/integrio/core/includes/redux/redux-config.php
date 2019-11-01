<?php
    
    if ( !class_exists( 'Integrio_Core' ) ) { return; } 

    if (!function_exists('integrio_get_preset')) {
        function integrio_get_preset() {
            $custom_preset = get_option('integrio_set_preset');
            $presets = function_exists('integrio_default_preset') ? integrio_default_preset() : '';

            $out = array();
            $i = 1;
            if(is_array($presets)){
                foreach ($presets as $key => $value) {
                    if($key != 'img'){
                        $out[$key] = $key;
                        $i++;                        
                    }
                }            
            }
            if(is_array($custom_preset)){
                foreach ( $custom_preset as $preset_id => $preset) :
                    if($preset_id != 'default' && $preset_id != 'img'){
                        $out[$preset_id] = $preset_id;
                    }
                endforeach;             
            }
            return $out;
        }
    }

    if (!function_exists('integrio_redux_get_custom_menu')) {
        function integrio_redux_get_custom_menu() {
            $taxonomies = array();

            $menus = get_terms('nav_menu');
            foreach ($menus as $key => $value) {
                $taxonomies[$value->name] = $value->name;
            }
            return $taxonomies;   
        }
    }  

    // This is theme option name where all the Redux data is stored.
    $theme_slug = 'integrio_set';
    
    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */
    $theme = wp_get_theme(); 
    
    $args = array(
        'opt_name'             => $theme_slug,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'integrio' ),
        'page_title'           => esc_html__( 'Theme Options', 'integrio' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
         // Show the panel pages on the admin bar
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_priority'        => 3,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'wgl-dashboard-panel',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => 'dashicons-admin-generic',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'wgl-theme-options-panel',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
         // Shows the Import/Export panel when not used as a field.
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
    );


    Redux::setArgs( $theme_slug, $args );

    // -> START Basic Fields
    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'General', 'integrio' ),
        'id'               => 'general',        
        'icon'             => 'el el-cog',
        'fields'           => array(
            array(
                'id'       => 'use_minify',
                'type'     => 'switch',
                'title'    => esc_html__( 'Use minify css/js files', 'integrio' ),
                'desc'     => esc_html__( 'Recommended for site load speed.', 'integrio' ),
            ),
            array(
                'id'       => 'preloder_settings',
                'type'     => 'section',
                'title'    => esc_html__( 'Preloader Settings', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader On/Off', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'preloader_background',
                'type'     => 'color',
                'title'    => esc_html__( 'Preloader Background', 'integrio' ),
                'subtitle' => esc_html__( 'Set Preloader Background', 'integrio' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'required' => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'preloader_color_1',
                'type'     => 'color',
                'title'    => esc_html__( 'Preloader Color', 'integrio' ),
                'default'  => '#f57479',
                'transparent' => false,
                'required' => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'preloader_settings-end',
                'type'     => 'section',
                'indent'   => false,
            ),
            array(
                'id'       => 'search_settings',
                'type'     => 'section',
                'title'    => esc_html__( 'Search Settings', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'search_style',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Choose your search style.', 'integrio' ),
                'options'  => array(
                    'standard' => esc_html__( 'Standard', 'integrio' ),
                    'alt' => esc_html__( 'Alternative', 'integrio' ),
                ),
                'default'  => 'standard'
            ),
             array(
                'id'       => 'search_settings-end',
                'type'     => 'section',
                'indent'   => false,
            ),
            array(
                'id'       => 'scroll_up_settings',
                'type'     => 'section',
                'title'    => esc_html__( 'Scroll Up Button Settings', 'integrio' ),
                'indent'   => true,
            ),
			array(
				'id'       => 'scroll_up',
				'type'     => 'switch',
				'title'    => esc_html__( 'Button On/Off', 'integrio' ),
				'default'  => true,
			),
			array(
				'id'       => 'scroll_up_arrow_color',
				'type'     => 'color', 
				'title'    => esc_html__( 'Button Arrow Color', 'integrio' ),
				'default'  => '#ffffff',
				'transparent' => false,
				'required' => array( 'scroll_up', '=', '1' ),
			),
			array(
				'id'       => 'scroll_up_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Button Background Color', 'integrio' ),
				'default'  => '#0c5adb',
				'transparent' => false,
				'required' => array( 'scroll_up', '=', '1' ),
			),
			array(
				'id'       => 'scroll_up_settings-end',
				'type'     => 'section', 
				'indent'   => false,
			),
		),
	));

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Custom JS', 'integrio' ),
        'id'               => 'editors-option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'custom_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom JS', 'integrio' ),
                'subtitle' => esc_html__( 'Paste your JS code here.', 'integrio' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => ''
            ),
            array(
                'id'       => 'header_custom_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom JS', 'integrio' ),
                'subtitle' => esc_html__( 'Code to be added inside HEAD tag', 'integrio' ),
                'mode'     => 'html',
                'theme'    => 'chrome',
                'default'  => ''
            ),
        ),
    ) );

    // -> START Basic Fields
    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Header', 'integrio' ),
        'id'               => 'header_section',        
    ) );

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Logo', 'integrio' ),
        'id'               => 'logo',
        'subsection'       => true,        
        'fields'           => array(
            array(
                'id'       => 'header_logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Header Logo', 'integrio' ),
            ),
            array(
                'id'       => 'logo_height_custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Logo Height', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'             => 'logo_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Set Logo Height' , 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => 100 ),
                'required' => array( 'logo_height_custom', '=', '1' ),
            ),
            array(
                'id'       => 'logo_sticky',
                'type'     => 'media',
                'title'    => esc_html__( 'Sticky Logo', 'integrio' ),
            ),
            array(
                'id'       => 'sticky_logo_height_custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Sticky Logo Height', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'             => 'sticky_logo_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Set Sticky Logo Height' , 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => '' ),
                'required' => array(
                    array( 'sticky_logo_height_custom', '=', '1' ),
                ),
            ),
            array(
                'id'      => 'logo_mobile',
                'type'    => 'media',
                'title'   => esc_html__( 'Mobile Logo', 'integrio' ),
            ),
            array(
                'id'      => 'mobile_logo_height_custom',
                'type'    => 'switch',
                'title'   => esc_html__( 'Enable Mobile Logo Height', 'integrio' ),
                'default' => false,
            ),
            array(
                'id'             => 'mobile_logo_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Set Mobile Logo Height' , 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => '' ),
                'required' => array(
                    array( 'mobile_logo_height_custom', '=', '1' ),
                ),
            ),
        )
    ) );

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Header Builder', 'integrio' ),
        'id'               => 'header-customize',
        'subsection'       => true,        
        'fields'           => array(            
            array(
                'id'       => 'header_def_js_preset',
                'type'     => 'select',
                'title'    => esc_html__( 'Header default preset', 'integrio' ),
                'default'  => '',
                'select2'  => array('allowClear' => false),
                'options'  => integrio_get_preset(),
                'desc'     => esc_html__( 'Please choose preset to use this in all Pages. 
                    You also can choose for every page your custom header present in page\'s option select(page metabox).', 'integrio' ),
            ),            
            array(
                'id'       => 'opt-js-preset',
                'type'     => 'custom_preset',
                'title'    => esc_html__( 'Custom Preset', 'integrio' ),
            ),    
            array(
                'id'       => 'bottom_header_layout',
                'type'     => 'custom_header_builder',
                'title'    => esc_html__( 'Header Builder', 'integrio' ),
                'compiler' => 'true',
                'full_width' => true,
                'options'  => array(
                    'items' => array(
                        'html1' => array( 'title' => esc_html__( 'HTML 1', 'integrio' ), 'settings' => true) ,
                        'html2' => array( 'title' => esc_html__( 'HTML 2', 'integrio' ), 'settings' => true) ,
                        'html3' => array( 'title' => esc_html__( 'HTML 3', 'integrio' ), 'settings' => true) ,
                        'html4' => array( 'title' => esc_html__( 'HTML 4', 'integrio' ), 'settings' => true) ,
                        'html5' => array( 'title' => esc_html__( 'HTML 5', 'integrio' ), 'settings' => true) ,
                        'html6' => array( 'title' => esc_html__( 'HTML 6', 'integrio' ), 'settings' => true) ,     
                        'html7' => array( 'title' => esc_html__( 'HTML 7', 'integrio' ), 'settings' => true) ,     
                        'html8' => array( 'title' => esc_html__( 'HTML 8', 'integrio' ), 'settings' => true) ,     
                        'wpml'  => array( 'title' => esc_html__( 'WPML', 'integrio' ), 'settings' => false) ,
                        'delimiter1'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'delimiter2'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'delimiter3'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'delimiter4'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'delimiter5'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'delimiter6'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'spacer3'  =>  array( 'title' => esc_html__( 'Spacer 2', 'integrio' ), 'settings' => true) ,
                        'spacer3'  =>  array( 'title' => esc_html__( 'Spacer 3', 'integrio' ), 'settings' => true) ,
                        'spacer4'  =>  array( 'title' => esc_html__( 'Spacer 4', 'integrio' ), 'settings' => true) ,
                        'spacer5'  =>  array( 'title' => esc_html__( 'Spacer 5', 'integrio' ), 'settings' => true) ,
                        'spacer6'  =>  array( 'title' => esc_html__( 'Spacer 6', 'integrio' ), 'settings' => true) ,
                        'spacer7'  =>  array( 'title' => esc_html__( 'Spacer 7', 'integrio' ), 'settings' => true) ,
                        'spacer8'  =>  array( 'title' => esc_html__( 'Spacer 8', 'integrio' ), 'settings' => true) ,
                        'button1'  =>  array( 'title' => esc_html__( 'Button', 'integrio' ), 'settings' => true) ,
                        'button2'  =>  array( 'title' => esc_html__( 'Button', 'integrio' ), 'settings' => true) ,
                        'cart'     =>  array( 'title' => esc_html__( 'Cart', 'integrio' ), 'settings' => false) ,
                        'login'     =>  array( 'title' => esc_html__( 'Login', 'integrio' ), 'settings' => false) ,
                        'wishlist'     =>  array( 'title' => esc_html__( 'Wishlist', 'integrio' ), 'settings' => false) ,
                        'spacer1'  =>  array( 'title' => esc_html__( 'Spacer 1', 'integrio' ), 'settings' => true) ,
                        'side_panel' => array( 'title' => esc_html__( 'Side Panel', 'integrio' ), 'settings' => false) ,
                    ), 
                    'Top Left area'   => array(),
                    'Top Center area' => array(),
                    'Top Right area'  => array(),                     
                    'Middle Left area' => array(
                        'logo' => array( 'title' => esc_html__( 'Logo', 'integrio' ), 'settings' => false),
                        'spacer2'  =>  array( 'title' => esc_html__( 'Spacer 2', 'integrio' ), 'settings' => true) ,
                        'menu' => array( 'title' => esc_html__( 'Menu', 'integrio' ), 'settings' => false),
                    ),
                    'Middle Center area' => array(),
                    'Middle Right area'  => array(
                        'item_search'  =>  array( 'title' => esc_html__( 'Search', 'integrio' ), 'settings' => false) ,
                    ),                    
                    'Bottom Left  area'  => array(),
                    'Bottom Center area' => array(),
                    'Bottom Right area'  => array(),
                ),
                'default' => array(
                    'items' => array(
                        'html1' => array( 'title' => esc_html__( 'HTML 1', 'integrio' ), 'settings' => true) ,
                        'html2' => array( 'title' => esc_html__( 'HTML 2', 'integrio' ), 'settings' => true) ,
                        'html3' => array( 'title' => esc_html__( 'HTML 3', 'integrio' ), 'settings' => true) ,
                        'html4' => array( 'title' => esc_html__( 'HTML 4', 'integrio' ), 'settings' => true) ,
                        'html5' => array( 'title' => esc_html__( 'HTML 5', 'integrio' ), 'settings' => true) ,
                        'html6' => array( 'title' => esc_html__( 'HTML 6', 'integrio' ), 'settings' => true) ,              
                        'html7' => array( 'title' => esc_html__( 'HTML 7', 'integrio' ), 'settings' => true) ,              
                        'html8' => array( 'title' => esc_html__( 'HTML 8', 'integrio' ), 'settings' => true) ,              
                        'wpml'  => array( 'title' => esc_html__( 'WPML', 'integrio' ), 'settings' => false) ,
                        'delimiter1'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'delimiter2'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'delimiter3'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'delimiter4'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'delimiter5'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,
                        'delimiter6'  =>  array( 'title' => esc_html__( '|', 'integrio' ), 'settings' => true) ,                    
                        'spacer3'  =>  array( 'title' => esc_html__( 'Spacer 2', 'integrio' ), 'settings' => true) ,
                        'spacer3'  =>  array( 'title' => esc_html__( 'Spacer 3', 'integrio' ), 'settings' => true) ,
                        'spacer4'  =>  array( 'title' => esc_html__( 'Spacer 4', 'integrio' ), 'settings' => true) ,
                        'spacer5'  =>  array( 'title' => esc_html__( 'Spacer 5', 'integrio' ), 'settings' => true) ,
                        'spacer6'  =>  array( 'title' => esc_html__( 'Spacer 6', 'integrio' ), 'settings' => true) ,
                        'spacer7'  =>  array( 'title' => esc_html__( 'Spacer 7', 'integrio' ), 'settings' => true) ,
                        'spacer8'  =>  array( 'title' => esc_html__( 'Spacer 8', 'integrio' ), 'settings' => true) ,
                        'button1'  =>  array( 'title' => esc_html__( 'Button', 'integrio' ), 'settings' => true) ,
                        'button2'  =>  array( 'title' => esc_html__( 'Button', 'integrio' ), 'settings' => true) ,
                        'cart'     =>  array( 'title' => esc_html__( 'Cart', 'integrio' ), 'settings' => false) ,                        
                        'login'     =>  array( 'title' => esc_html__( 'Login', 'integrio' ), 'settings' => false) ,                        
                        'wishlist'     =>  array( 'title' => esc_html__( 'Wishlist', 'integrio' ), 'settings' => false) ,                        
                        'spacer1'  =>  array( 'title' => esc_html__( 'Spacer 1', 'integrio' ), 'settings' => true) ,
                        'side_panel' => array( 'title' => esc_html__( 'Side Panel', 'integrio' ), 'settings' => false) ,
                        
                    ), 
                    'Top Left area' => array(),
                    'Top Center area' => array(),
                    'Top Right  area' => array(),                     
                    'Middle Left  area' => array(
                        'logo' => array( 'title' => esc_html__( 'Logo', 'integrio' ), 'settings' => false),
                    ),
                    'Middle Center  area' => array(
                        'menu' => array( 'title' => esc_html__( 'Menu', 'integrio' ), 'settings' => false),
                    ),
                    'Middle Right  area' => array(
                        'item_search'  =>  array( 'title' => esc_html__( 'Search', 'integrio' ), 'settings' => false) ,
                    ),                    
                    'Bottom Left area' => array(),
                    'Bottom Center area' => array(),
                    'Bottom Right area' => array(),
                ),
            ),   
            array(
                'id'             => 'bottom_header_spacer1',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 1 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 )
            ),            
            array(
                'id'             => 'bottom_header_spacer2',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 2 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 110 )
            ),            
            array(
                'id'             => 'bottom_header_spacer3',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 3 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 )
            ),            
            array(
                'id'             => 'bottom_header_spacer4',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 4 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 )
            ),
            array(
                'id'             => 'bottom_header_spacer5',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 5 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 )
            ),
            array(
                'id'             => 'bottom_header_spacer6',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 6 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 )
            ),
            array(
                'id'             => 'bottom_header_spacer7',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 7 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 )
            ),
            array(
                'id'             => 'bottom_header_spacer8',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 8 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 )
            ),
            array(
                'id'             => 'bottom_header_delimiter1_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Height', 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => 100 )
            ),            
            array(
                'id'             => 'bottom_header_delimiter1_width',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 1 )
            ),
            array(
                'id'       => 'bottom_header_delimiter1_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'bottom_header_delimiter1_margin',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'margin',
                'all'      => false,
                'bottom'   => false,
                'top'      => false,
                'left'     => true,
                'right'    => true,
                'title'    => esc_html__( 'Delimiter Spacing', 'integrio' ),
                'default'  => array(
                    'margin-left' => '30', 
                    'margin-right' => '30',                            
                )
            ), 
            array(
                'id'      => 'bottom_header_delimiter1_sticky_custom',
                'type'    => 'switch',
                'title'   => esc_html__( 'Customize Sticky Delimiter', 'integrio' ),
                'default' => false,
            ),
            array(
                'id'       => 'bottom_header_delimiter1_sticky_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'bottom_header_delimiter1_sticky_custom', '=', '1' ),
                ),
            ),
            array(
                'id'             => 'bottom_header_delimiter2_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Height', 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => 100 )
            ),
            array(
                'id'             => 'bottom_header_delimiter2_width',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 1 )
            ),  
            array(
                'id'       => 'bottom_header_delimiter2_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'bottom_header_delimiter2_margin',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'margin',
                'all'      => false,
                'bottom'   => false,
                'top'      => false,
                'left'     => true,
                'right'    => true,
                'title'    => esc_html__( 'Delimiter Spacing', 'integrio' ),
                'default'  => array(
                    'margin-left' => '30', 
                    'margin-right' => '30',                            
                )
            ), 
            array(
                'id'       => 'bottom_header_delimiter2_sticky_custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Customize Sticky Delimiter', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'bottom_header_delimiter2_sticky_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'bottom_header_delimiter2_sticky_custom', '=', '1' ),
                ),
            ),            
            array(
                'id'             => 'bottom_header_delimiter3_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Height', 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => 100 )
            ),            
            array(
                'id'             => 'bottom_header_delimiter3_width',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 1 )
            ),  
            array(
                'id'       => 'bottom_header_delimiter3_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'bottom_header_delimiter3_margin',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'margin',
                'all'      => false,
                'bottom'   => false,
                'top'      => false,
                'left'     => true,
                'right'    => true,
                'title'    => esc_html__( 'Delimiter Spacing', 'integrio' ),
                'default'  => array(
                    'margin-left' => '30', 
                    'margin-right' => '30',                            
                )
            ),    
            array(
                'id'       => 'bottom_header_delimiter3_sticky_custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Customize Sticky Delimiter', 'integrio' ),
                'default'  => false,
            ),            
            array(
                'id'       => 'bottom_header_delimiter3_sticky_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'bottom_header_delimiter3_sticky_custom', '=', '1' ),
                ),
            ),         
            array(
                'id'             => 'bottom_header_delimiter4_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Height', 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => 100 )
            ),            
            array(
                'id'             => 'bottom_header_delimiter4_width',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 1 )
            ),  
            array(
                'id'       => 'bottom_header_delimiter4_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'bottom_header_delimiter4_margin',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'margin',
                'all'      => false,
                'bottom'   => false,
                'top'      => false,
                'left'     => true,
                'right'    => true,
                'title'    => esc_html__( 'Delimiter Spacing', 'integrio' ),
                'default'  => array(
                    'margin-left' => '30', 
                    'margin-right' => '30',                            
                )
            ),
            array(
                'id'       => 'bottom_header_delimiter4_sticky_custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Customize Sticky Delimiter', 'integrio' ),
                'default'  => false,
            ),            
            array(
                'id'       => 'bottom_header_delimiter4_sticky_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'bottom_header_delimiter4_sticky_custom', '=', '1' ),
                ),
            ),             
            array(
                'id'             => 'bottom_header_delimiter5_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Height', 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => 100 )
            ),            
            array(
                'id'             => 'bottom_header_delimiter5_width',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 1 )
            ),  
            array(
                'id'       => 'bottom_header_delimiter5_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'bottom_header_delimiter5_margin',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'margin',
                'all'      => false,
                'bottom'   => false,
                'top'      => false,
                'left'     => true,
                'right'    => true,
                'title'    => esc_html__( 'Delimiter Spacing', 'integrio' ),
                'default'  => array(
                    'margin-left' => '30', 
                    'margin-right' => '30',                            
                )
            ), 
            array(
                'id'       => 'bottom_header_delimiter5_sticky_custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Customize Sticky Delimiter', 'integrio' ),
                'default'  => false,
            ),            
            array(
                'id'       => 'bottom_header_delimiter5_sticky_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'bottom_header_delimiter5_sticky_custom', '=', '1' ),
                ),
            ),            
            array(
                'id'             => 'bottom_header_delimiter6_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Height', 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => 100 )
            ),            
            array(
                'id'             => 'bottom_header_delimiter6_width',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Delimiter Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 1 )
            ),  
            array(
                'id'       => 'bottom_header_delimiter6_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'bottom_header_delimiter6_margin',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'margin',
                'all'      => false,
                'bottom'   => false,
                'top'      => false,
                'left'     => true,
                'right'    => true,
                'title'    => esc_html__( 'Delimiter Spacing', 'integrio' ),
                'default'  => array(
                    'margin-left' => '30', 
                    'margin-right' => '30',                            
                )
            ),
            array(
                'id'       => 'bottom_header_delimiter6_sticky_custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Customize Sticky Delimiter', 'integrio' ),
                'default'  => false,
            ),            
            array(
                'id'       => 'bottom_header_delimiter6_sticky_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Delimiter Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_delimiter6_sticky_custom', '=', '1' ),
            ), 
            array(
                'id'      => 'bottom_header_button1_title',
                'type'    => 'text',
                'title'   => esc_html__( 'Button Text', 'integrio' ),
                'default' => esc_html__( 'Get Ticket', 'integrio' ),
            ),            
            array(
                'id'      => 'bottom_header_button1_link',
                'type'    => 'text',
                'title'   => esc_html__( 'Link', 'integrio' )
            ), 
            array(
                'id'      => 'bottom_header_button1_target',
                'type'    => 'switch',
                'title'   => esc_html__( 'Open link in a new tab', 'integrio' ),
                'default' => true,
            ),
            array(
                'id'      => 'bottom_header_button1_size',
                'type'    => 'select',
                'title'   => esc_html__( 'Button Size', 'integrio' ),
                'options' => array(
                    's' => esc_html__( 'Small', 'integrio' ),
                    'm' => esc_html__( 'Medium', 'integrio' ),
                    'l' => esc_html__( 'Large', 'integrio' ),
                    'xl' => esc_html__( 'Extra Large', 'integrio' ),
                    
                ),
                'default' => 's'
            ),  
            array(
                'id'      => 'bottom_header_button1_custom',
                'type'    => 'switch',
                'title'   => esc_html__( 'Customize Button', 'integrio' ),
                'default' => false,
            ),            
            array(
                'id'      => 'bottom_header_button1_color_txt',
                'type'    => 'color_rgba',
                'title'   => esc_html__( 'Text Color', 'integrio' ),
                'default' => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button1_hover_color_txt',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Hover Text Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom', '=', '1' ),
            ),            
            array(
                'id'       => 'bottom_header_button1_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button1_hover_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Hover Background Color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom', '=', '1' ),
            ),            
            array(
                'id'       => 'bottom_header_button1_border',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button1_hover_border',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Hover Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom', '=', '1' ),
            ),
            array(
                'id'       => 'bottom_header_button1_custom_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Customize Sticky Button', 'integrio' ),
                'default'  => false,
            ),              
            array(
                'id'       => 'bottom_header_button1_color_txt_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Text Color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom_sticky', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button1_hover_color_txt_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Hover Text Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom_sticky', '=', '1' ),
            ),            
            array(
                'id'       => 'bottom_header_button1_bg_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Background Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom_sticky', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button1_hover_bg_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Hover Background Color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom_sticky', '=', '1' ),
            ),            
            array(
                'id'       => 'bottom_header_button1_border_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom_sticky', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button1_hover_border_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Hover Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button1_custom_sticky', '=', '1' ),
            ),
            array(
                'id'      => 'bottom_header_button2_title',
                'type'    => 'text',
                'title'   => esc_html__( 'Button Text', 'integrio' ),
                'default' => esc_html__( 'Get Ticket', 'integrio' ),
            ),             
            array(
                'id'      => 'bottom_header_button2_link',
                'type'    => 'text',
                'title'   => esc_html__( 'Link', 'integrio' )
            ), 
            array(
                'id'      => 'bottom_header_button2_target',
                'type'    => 'switch',
                'title'   => esc_html__( 'Open link in a new tab', 'integrio' ),
                'default' => true,
            ),
            array(
                'id'      => 'bottom_header_button2_size',
                'type'    => 'select',
                'title'   => esc_html__( 'Button Size', 'integrio' ),
                'options' => array(
                    's' => esc_html__( 'Small', 'integrio' ),
                    'm' => esc_html__( 'Medium', 'integrio' ),
                    'l' => esc_html__( 'Large', 'integrio' ),
                    'xl' => esc_html__( 'Extra Large', 'integrio' ),
                ),
                'default'  => 'm'
            ),  
            array(
                'id'      => 'bottom_header_button2_custom',
                'type'    => 'switch',
                'title'   => esc_html__( 'Customize Button', 'integrio' ),
                'default' => false,
            ),            
            array(
                'id'      => 'bottom_header_button2_color_txt',
                'type'    => 'color_rgba',
                'title'   => esc_html__( 'Text Color', 'integrio' ),
                'default' => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button2_hover_color_txt',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Hover Text Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom', '=', '1' ),
            ),            
            array(
                'id'       => 'bottom_header_button2_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button2_hover_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Hover Background Color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom', '=', '1' ),
            ),            
            array(
                'id'       => 'bottom_header_button2_border',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button2_hover_border',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Hover Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom', '=', '1' ),
            ),
            array(
                'id'       => 'bottom_header_button2_custom_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Customize Sticky Button', 'integrio' ),
                'default'  => false,
            ),              
            array(
                'id'       => 'bottom_header_button2_color_txt_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Text Color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom_sticky', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button2_hover_color_txt_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Hover Text Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom_sticky', '=', '1' ),
            ),            
            array(
                'id'       => 'bottom_header_button2_bg_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Background Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom_sticky', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button2_hover_bg_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Hover Background Color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom_sticky', '=', '1' ),
            ),            
            array(
                'id'       => 'bottom_header_button2_border_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom_sticky', '=', '1' ),
            ),           
            array(
                'id'       => 'bottom_header_button2_hover_border_sticky',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Hover Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'bottom_header_button2_custom_sticky', '=', '1' ),
            ),            
            array(
                'id'      => 'bottom_header_bar_html1_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 1 Editor', 'integrio' ),
                'default' => '',
            ),
            array(
                'id'      => 'bottom_header_bar_html2_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 2 Editor', 'integrio' ),
                'default' => '',
            ),            
            array(
                'id'      => 'bottom_header_bar_html3_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 3 Editor', 'integrio' ),
                'default' => '',
            ),
            array(
                'id'      => 'bottom_header_bar_html4_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 4 Editor', 'integrio' ),
                'default' => '',
            ),            array(
                'id'      => 'bottom_header_bar_html5_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 5 Editor', 'integrio' ),
                'default' => '',
            ),
            array(
                'id'      => 'bottom_header_bar_html6_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 6 Editor', 'integrio' ),
                'default' => '',
            ),            
            array(
                'id'      => 'bottom_header_bar_html7_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 7 Editor', 'integrio' ),
                'default' => '',
            ),            
            array(
                'id'      => 'bottom_header_bar_html8_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 8 Editor', 'integrio' ),
                'default' => '',
            ),                        
            array(
                'id'       => 'header_top-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Top Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_top_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Top Header', 'integrio' ),
                'subtitle' => esc_html__( 'Set header content in full width top layout', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'             => 'header_top_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Top Height', 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => 40 )
            ),
            array(
                'id'       => 'header_top_background_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Header Top Background Image', 'integrio' ),
            ),
            array(
                'id'       => 'header_top_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Top Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_top_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Top Text Color', 'integrio' ),
                'subtitle' => esc_html__( 'Set Top header text color', 'integrio' ),
                'default'  => array(
                    'color' => '#fefefe',
                    'alpha' => '.5',
                    'rgba'  => 'rgba(254,254,254,0.5)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_top_bottom_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Header Top Bottom Border', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'             => 'header_top_border_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Header Top Border Width' , 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '1',
                ),
                'required' => array(
                    array( 'header_top_bottom_border', '=', '1' )
                ),
            ),
            array(
                'id'       => 'header_top_bottom_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Top Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,0.2)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'header_top_bottom_border', '=', '1' ),
                ), 
            ),
            array(
                'id'     => 'header_top-end',
                'type'   => 'section',
                'indent' => false, 
            ),               
            array(
                'id'       => 'header_middle-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Middle Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_middle_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Middle Header', 'integrio' ),
                'subtitle' => esc_html__( 'Set header content in full width middle layout', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'             => 'header_middle_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Middle Height', 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 110,
                )
            ),
            array(
                'id'       => 'header_middle_background_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Header Middle Background Image', 'integrio' ),
            ),
            array(
                'id'       => 'header_middle_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Middle Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_middle_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Middle Text Color', 'integrio' ),
                'subtitle' => esc_html__( 'Set Middle header text color', 'integrio' ),
                'default'  => array(
                    'color' => '#292929',
                    'alpha' => '1',
                    'rgba'  => 'rgba(41,41,41,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_middle_bottom_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Header Middle Bottom Border', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'             => 'header_middle_border_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Header Middle Border Width' , 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '1',
                ),
                'required' => array(
                    array( 'header_middle_bottom_border', '=', '1' )
                ),
            ),
            array(
                'id'       => 'header_middle_bottom_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Middle Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,0.2)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'header_middle_bottom_border', '=', '1' ),
                ), 
            ),
            array(
                'id'     => 'header_middle-end',
                'type'   => 'section',
                'indent' => false, 
            ),            

            array(
                'id'       => 'header_bottom-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Bottom Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_bottom_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Bottom Header', 'integrio' ),
                'subtitle' => esc_html__( 'Set header content in full width bottom layout', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'             => 'header_bottom_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Bottom Height', 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 100,
                )
            ),
            array(
                'id'       => 'header_bottom_background_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Header Bottom Background Image', 'integrio' ),
            ),
            array(
                'id'       => 'header_bottom_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Bottom Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_bottom_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Bottom Text Color', 'integrio' ),
                'subtitle' => esc_html__( 'Set Bottom header text color', 'integrio' ),
                'default'  => array(
                    'color' => '#fefefe',
                    'alpha' => '.5',
                    'rgba'  => 'rgba(254,254,254,0.5)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_bottom_bottom_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Header Bottom Border', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'             => 'header_bottom_border_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Header Bottom Border Width' , 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '1',
                ),
                'required' => array(
                    array( 'header_bottom_bottom_border', '=', '1' )
                ),
            ),
            array(
                'id'       => 'header_bottom_bottom_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Bottom Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,0.2)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'header_bottom_bottom_border', '=', '1' ),
                ), 
            ),
            array(
                'id'     => 'header_bottom-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-top-left-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Top Left Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_top_left_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'left'
            ),            
            array(
                'id'       => 'header_column_top_left_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_top_left_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-top-left-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-top-center-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Top Center Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_top_center_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'left'
            ),            
            array(
                'id'       => 'header_column_top_center_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_top_center_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-top-center-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-top-center-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Top Center Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_top_center_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'left'
            ),            
            array(
                'id'       => 'header_column_top_center_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_top_center_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-top-center-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-top-right-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Top Right Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_top_right_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'right'
            ),            
            array(
                'id'       => 'header_column_top_right_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_top_right_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-top-right-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-middle-left-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Middle Left Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_middle_left_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'left'
            ),            
            array(
                'id'       => 'header_column_middle_left_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_middle_left_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-middle-left-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-middle-center-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Middle Center Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_middle_center_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'left'
            ),            
            array(
                'id'       => 'header_column_middle_center_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_middle_center_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-middle-center-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-middle-center-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Middle Center Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_middle_center_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'left'
            ),            
            array(
                'id'       => 'header_column_middle_center_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_middle_center_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-middle-center-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-middle-right-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Middle Right Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_middle_right_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'right'
            ),            
            array(
                'id'       => 'header_column_middle_right_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_middle_right_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-middle-right-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-bottom-left-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Bottom Left Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_bottom_left_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'left'
            ),            
            array(
                'id'       => 'header_column_bottom_left_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_bottom_left_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-bottom-left-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-bottom-center-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Middle Center Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_bottom_center_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'left'
            ),            
            array(
                'id'       => 'header_column_bottom_center_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_bottom_center_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-bottom-center-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-bottom-center-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Bottom Center Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_bottom_center_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'left'
            ),            
            array(
                'id'       => 'header_column_bottom_center_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_bottom_center_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-bottom-center-end',
                'type'   => 'section',
                'indent' => false, 
            ),            
            array(
                'id'       => 'header_column-bottom-right-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Bottom Right Column Options', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_column_bottom_right_horz',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Horizontal Align', 'integrio' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'right'
            ),            
            array(
                'id'       => 'header_column_bottom_right_vert',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Vertical Align', 'integrio' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'integrio' ),
                    'middle' => esc_html__( 'Middle', 'integrio' ),
                    'bottom' => esc_html__( 'Bottom', 'integrio' ),
                ),
                'default'  => 'middle'
            ),            
            array(
                'id'       => 'header_column_bottom_right_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display', 'integrio' ),
                'options'  => array(
                    'normal' => esc_html__( 'Normal', 'integrio' ),
                    'grow' => esc_html__( 'Grow', 'integrio' ),
                ),
                'default'  => 'normal'
            ),
            array(
                'id'     => 'header_column-bottom-right-end',
                'type'   => 'section',
                'indent' => false, 
            ),
            array(
                'id'       => 'header_row_settings-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Settings', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_shadow',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Bottom Shadow', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'header_on_bg',
                'type'     => 'switch',
                'title'    => esc_html__( 'Over content', 'integrio' ),
                'subtitle' => esc_html__( 'Set Header preset to display over content.', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'lavalamp_active',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Lavalamp Marker', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'sub_menu_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sub Menu Background', 'integrio' ),
                'subtitle' => esc_html__( 'Set sub menu background color', 'integrio' ),
                'default'  => array(
                    'color' => '#2d2d2d',
                    'alpha' => '1',
                    'rgba'  => 'rgba(45,45,45,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'sub_menu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Sub Menu Text Color', 'integrio' ),
                'subtitle' => esc_html__( 'Set sub menu header text color', 'integrio' ),
                'default'  => '#ffffff',
                'transparent' => false,
            ),
            array(
                'id'        => 'header_mobile_queris',
                'type'      => 'slider',
                'title'     => esc_html__( 'Mobile Header resolution breakpoint', 'integrio'),
                "default"   => 1200,
                "min"       => 1,
                "step"      => 1,
                "max"       => 1700,
                'display_value' => 'text',
                'required' => array( 'mobile_header', '=', '1' ),
            ),
            array(
                'id'     => 'header_row_settings-end',
                'type'   => 'section',
                'indent' => false, 
            ),
        )

    ) );

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Header Sticky', 'integrio' ),
        'id'               => 'header_builder_sticky',
        'subsection'       => true,        
        'fields'           => array(            
            array(
                'id'       => 'header_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Header', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'header_sticky-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Sticky Settings', 'integrio' ),
                'indent'   => true,
                'required' => array( 'header_sticky', '=', '1' ),
            ),            
            array(
                'id'       => 'header_sticky_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Sticky Header Text Color', 'integrio' ),
                'subtitle' => esc_html__( 'Set sticky header text color', 'integrio' ),
                'default'  => '#313131',
                'transparent' => false,
            ),
            array(
                'id'       => 'header_sticky_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Header Background', 'integrio' ),
                'subtitle' => esc_html__( 'Set sticky header background color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1.0',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'             => 'header_sticky_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Sticky Header Height', 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 100,
                )
            ),
            array(
                'id'       => 'header_sticky_style',
                'type'     => 'select',
                'title'    => esc_html__( 'Choose your sticky style.', 'integrio' ),
                'options'  => array(
                    'standard' => esc_html__( 'Show when scroll', 'integrio' ),
                    'scroll_up' => esc_html__( 'Show when scroll up', 'integrio' ),
                ),
                'default'  => 'standard'
            ),
            array(
                'id'       => 'header_sticky_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Bottom Border On/Off', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'             => 'header_sticky_border_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Bottom Border Width' , 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '1',
                ),
                'required' => array(
                    array( 'header_sticky_border', '=', '1' )
                ),
            ),
            array(
                'id'       => 'header_sticky_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Bottom Border Color', 'integrio' ),
                'default'  => array(
                    'color' => '#525252',
                    'alpha' => '1',
                    'rgba'  => 'rgba(82, 82, 82, 1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'header_sticky_border', '=', '1' )
                ), 
            ),
            array(
                'id'       => 'header_sticky_shadow',
                'type'     => 'switch',
                'title'    => esc_html__( 'Bottom Shadow On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'sticky_header',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom Sticky Header ', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'sticky_header_layout',
                'type'     => 'sorter',
                'title'    => esc_html__( 'Sticky Header Order', 'integrio' ),
                'desc'     => esc_html__( 'Organize the layout of the sticky header', 'integrio' ),
                'compiler' => 'true',
                'full_width'    => true,
                'options'  => array(
                    'items'  => array(
                        'html1' => esc_html__( 'HTML 1', 'integrio' ),
                        'html2' => esc_html__( 'HTML 2', 'integrio' ),                        
                        'html3' => esc_html__( 'HTML 3', 'integrio' ),
                        'html4' => esc_html__( 'HTML 4', 'integrio' ),                        
                        'html5' => esc_html__( 'HTML 5', 'integrio' ),
                        'html6' => esc_html__( 'HTML 6', 'integrio' ),
                        'item_search' => esc_html__( 'Search', 'integrio' ),
                        'wpml'        => esc_html__( 'WPML', 'integrio' ),
                        'delimiter1'  => esc_html__( '|', 'integrio' ),
                        'delimiter2'  => esc_html__( '|', 'integrio' ),
                        'delimiter3'  => esc_html__( '|', 'integrio' ),
                        'delimiter4'  => esc_html__( '|', 'integrio' ),
                        'delimiter5'  => esc_html__( '|', 'integrio' ),
                        'delimiter6'  => esc_html__( '|', 'integrio' ),
                        'side_panel'  => esc_html__( 'Side Panel', 'integrio' ),
                        'cart'        => esc_html__( 'Cart', 'integrio' ),
                        'login'       => esc_html__( 'Login', 'integrio' ),
                        'wishlist'    => esc_html__( 'Wishlist', 'integrio' ),
                        'spacer1' => esc_html__( 'Spacer 1', 'integrio' ),
                        'spacer2' => esc_html__( 'Spacer 2', 'integrio' ),
                        'spacer3' => esc_html__( 'Spacer 3', 'integrio' ),
                        'spacer4' => esc_html__( 'Spacer 4', 'integrio' ),
                        'spacer5' => esc_html__( 'Spacer 5', 'integrio' ),
                        'spacer6' => esc_html__( 'Spacer 6', 'integrio' ),
                    ),
                    'Left align side' => array(
                        'logo' => esc_html__( 'Logo', 'integrio' ),
                    ),
                    'Center align side' => array(),
                    'Right align side' => array(
                        'menu' => esc_html__( 'Menu', 'integrio' ),
                    ),
                ),                
                'default'  => array(
                    'items'  => array(
                        'html1' => esc_html__( 'HTML 1', 'integrio' ),
                        'html2' => esc_html__( 'HTML 2', 'integrio' ),                        
                        'html3' => esc_html__( 'HTML 3', 'integrio' ),
                        'html4' => esc_html__( 'HTML 4', 'integrio' ),                        
                        'html5' => esc_html__( 'HTML 5', 'integrio' ),
                        'html6' => esc_html__( 'HTML 6', 'integrio' ),
                        'item_search' => esc_html__( 'Search', 'integrio' ),
                        'wpml'        => esc_html__( 'WPML', 'integrio' ),
                        'delimiter1'  => esc_html__( '|', 'integrio' ),
                        'delimiter2'  => esc_html__( '|', 'integrio' ),
                        'delimiter3'  => esc_html__( '|', 'integrio' ),
                        'delimiter4'  => esc_html__( '|', 'integrio' ),
                        'delimiter5'  => esc_html__( '|', 'integrio' ),
                        'delimiter6'  => esc_html__( '|', 'integrio' ),
                        'spacer1' => esc_html__( 'Spacer 1', 'integrio' ),
                        'spacer2' => esc_html__( 'Spacer 2', 'integrio' ),
                        'spacer3' => esc_html__( 'Spacer 3', 'integrio' ),
                        'spacer4' => esc_html__( 'Spacer 4', 'integrio' ),
                        'spacer5' => esc_html__( 'Spacer 5', 'integrio' ),
                        'spacer6' => esc_html__( 'Spacer 6', 'integrio' ),
                        'side_panel' => esc_html__( 'Side Panel', 'integrio' ),
                        'cart' => esc_html__( 'Cart', 'integrio' ),
                        'login' => esc_html__( 'Login', 'integrio' ),
                        'wishlist' => esc_html__( 'Wishlist', 'integrio' ),
                    ),
                    'Left align side' => array(
                        'logo' => esc_html__( 'Logo', 'integrio' ),
                    ),
                    'Center align side' => array(),
                    'Right align side' => array(
                        'menu' => esc_html__( 'Menu', 'integrio' ),
                    ),
                ),
                'required' => array( 'sticky_header', '=', '1' ),
            ),
            array(
                'id'       => 'header_custom_sticky_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Sticky Header', 'integrio' ),
                'default'  => false,
                'required' => array( 'sticky_header', '=', '1' ),
            ),
            array(
                'id'      => 'sticky_header_bar_html1_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 1 Editor', 'integrio' ),
                'default' => '',
                'required' => array( 'sticky_header', '=', '1' ),
            ),
            array(
                'id'      => 'sticky_header_bar_html2_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 2 Editor', 'integrio' ),
                'default' => '',
                'required' => array( 'sticky_header', '=', '1' ),
            ),             
            array(
                'id'      => 'sticky_header_bar_html3_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 3 Editor', 'integrio' ),
                'default' => '',
                'required' => array( 'sticky_header', '=', '1' ),
            ),
            array(
                'id'      => 'sticky_header_bar_html4_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 4 Editor', 'integrio' ),
                'default' => '',
                'required' => array( 'sticky_header', '=', '1' ),
            ),             
            array(
                'id'      => 'sticky_header_bar_html5_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 5 Editor', 'integrio' ),
                'default' => '',
                'required' => array( 'sticky_header', '=', '1' ),
            ),
            array(
                'id'      => 'sticky_header_bar_html6_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 6 Editor', 'integrio' ),
                'default' => '',
                'required' => array( 'sticky_header', '=', '1' ),
            ),
            array(
                'id'             => 'sticky_header_spacer1',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 1 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 ),
                'required'       => array( 'sticky_header', '=', '1' ),
            ),            
            array(
                'id'             => 'sticky_header_spacer2',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 2 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 ),
                'required'       => array( 'sticky_header', '=', '1' ),
            ),            
            array(
                'id'             => 'sticky_header_spacer3',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 3 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 ),
                'required'       => array( 'sticky_header', '=', '1' ),
            ),            
            array(
                'id'             => 'sticky_header_spacer4',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 4 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 ),
                'required'       => array( 'sticky_header', '=', '1' ),
            ),            
            array(
                'id'             => 'sticky_header_spacer5',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 5 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 ),
                'required'       => array( 'sticky_header', '=', '1' ),
            ),            
            array(
                'id'             => 'sticky_header_spacer6',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 6 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array( 'width' => 25 ),
                'required'       => array( 'sticky_header', '=', '1' ),
            ),  
            array(
                'id'     => 'header_sticky-end',
                'type'   => 'section',
                'indent' => false, 
                'required' => array( 'header_sticky', '=', '1' ),
            ),
        )
    ) );    
    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Header Mobile', 'integrio' ),
        'id'               => 'header_builder_mobile',
        'subsection'       => true,        
        'fields'           => array(
            array(
                'id'       => 'mobile_header',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom Mobile Header ', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'mobile_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Mobile Header Background', 'integrio' ),
                'subtitle' => esc_html__( 'Set mobile header background color', 'integrio' ),
                'default'  => array(
                    'color' => '#313131',
                    'alpha' => '1',
                    'rgba'  => 'rgba(49,49,49, 1)'
                ),
                'mode'     => 'background',
                'required' => array( 'mobile_header', '=', '1' ),
            ),
            array(
                'id'       => 'mobile_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Mobile Header Text Color', 'integrio' ),
                'subtitle' => esc_html__( 'Set mobile header text color', 'integrio' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'required' => array( 'mobile_header', '=', '1' ),
            ),
            array(
                'id'       => 'mobile_sub_menu_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Mobile Sub Menu Background', 'integrio' ),
                'subtitle' => esc_html__( 'Set sub menu background color', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'mobile_header', '=', '1' ),
            ),
            array(
                'id'       => 'mobile_sub_menu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Mobile Sub Menu Text Color', 'integrio' ),
                'subtitle' => esc_html__( 'Set sub menu header text color', 'integrio' ),
                'default'  => '#414141',
                'transparent' => false,
                'required' => array( 'mobile_header', '=', '1' ),
            ),   
            array(
                'id'             => 'header_mobile_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Mobile Height' , 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '100',
                ),
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ), 
            array(
                'id'       => 'mobile_over_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Mobile Over Content', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'mobile_menu',
                'type'     => 'select',
                'title'    => esc_html__( 'Mobile Menu', 'stoni' ),
                'select2'  => array('allowClear' => false),
                'options'  => integrio_redux_get_custom_menu(), 
            ), 
            array(
                'id'       => 'mobile_header_layout',
                'type'     => 'sorter',
                'title'    => esc_html__( 'Mobile Header Order', 'integrio' ),
                'desc'     => esc_html__( 'Organize the layout of the mobile header', 'integrio' ),
                'compiler' => 'true',
                'full_width' => true,
                'options'  => array(
                    'items'  => array(
                        'html1' => esc_html__( 'HTML 1', 'integrio' ),
                        'html2' => esc_html__( 'HTML 2', 'integrio' ),                        
                        'html3' => esc_html__( 'HTML 3', 'integrio' ),
                        'html4' => esc_html__( 'HTML 4', 'integrio' ),                        
                        'html5' => esc_html__( 'HTML 5', 'integrio' ),
                        'html6' => esc_html__( 'HTML 6', 'integrio' ),
                        'wpml'  => esc_html__( 'WPML', 'integrio' ),
                        'spacer1' => esc_html__( 'Spacer 1', 'integrio' ),
                        'spacer2' => esc_html__( 'Spacer 2', 'integrio' ),
                        'spacer3' => esc_html__( 'Spacer 3', 'integrio' ),
                        'spacer4' => esc_html__( 'Spacer 4', 'integrio' ),
                        'spacer5' => esc_html__( 'Spacer 5', 'integrio' ),
                        'spacer6' => esc_html__( 'Spacer 6', 'integrio' ),
                        'side_panel' =>  esc_html__( 'Side Panel', 'integrio' ),
                        'cart'        =>  esc_html__( 'Cart', 'integrio' ),
                        'login'        =>  esc_html__( 'Login', 'integrio' ),
                        'wishlist'        =>  esc_html__( 'Wishlist', 'integrio' ),
                    ),
                    'Left align side' => array(
                        'menu' => esc_html__( 'Menu', 'integrio' ),
                    ),
                    'Center align side' => array(
                        'logo' => esc_html__( 'Logo', 'integrio' ),
                    ),
                    'Right align side' => array(
                        'item_search'  =>  esc_html__( 'Search', 'integrio' ),
                    ),
                ),        
                'default'  => array(
                    'items'  => array(
                        'html1' => esc_html__( 'HTML 1', 'integrio' ),
                        'html2' => esc_html__( 'HTML 2', 'integrio' ),                        
                        'html3' => esc_html__( 'HTML 3', 'integrio' ),
                        'html4' => esc_html__( 'HTML 4', 'integrio' ),                        
                        'html5' => esc_html__( 'HTML 5', 'integrio' ),
                        'html6' => esc_html__( 'HTML 6', 'integrio' ),
                        'wpml'  => esc_html__( 'WPML', 'integrio' ),
                        'spacer1'  =>  esc_html__( 'Spacer 1', 'integrio' ),
                        'spacer2'  =>  esc_html__( 'Spacer 2', 'integrio' ),
                        'spacer3'  =>  esc_html__( 'Spacer 3', 'integrio' ),
                        'spacer4'  =>  esc_html__( 'Spacer 4', 'integrio' ),
                        'spacer5'  =>  esc_html__( 'Spacer 5', 'integrio' ),
                        'spacer6'  =>  esc_html__( 'Spacer 6', 'integrio' ),
                        'side_panel' =>  esc_html__( 'Side Panel', 'integrio' ),
                        'cart'       =>  esc_html__( 'Cart', 'integrio' ),
                        'login'       =>  esc_html__( 'Login', 'integrio' ),
                        'wishlist'    =>  esc_html__( 'Wishlist', 'integrio' ),
                    ),
                    'Left align side' => array(
                        'menu' => esc_html__( 'Menu', 'integrio' ),
                    ),
                    'Center align side' => array(
                        'logo' => esc_html__( 'Logo', 'integrio' ),
                    ),
                    'Right align side' => array(
                        'item_search'  =>  esc_html__( 'Search', 'integrio' ),
                    ),
                ),
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'mobile_header_bar_html1_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 1 Editor', 'integrio' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'mobile_header_bar_html2_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 2 Editor', 'integrio' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),              
            array(
                'id'      => 'mobile_header_bar_html3_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 3 Editor', 'integrio' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'mobile_header_bar_html4_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 4 Editor', 'integrio' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),             
            array(
                'id'      => 'mobile_header_bar_html5_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 5 Editor', 'integrio' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'mobile_header_bar_html6_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 6 Editor', 'integrio' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),
            array(
                'id'             => 'mobile_header_spacer1',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 1 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                ),
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),            
            array(
                'id'             => 'mobile_header_spacer2',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 2 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                ),
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),            
            array(
                'id'             => 'mobile_header_spacer3',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 3 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                ),
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),            
            array(
                'id'             => 'mobile_header_spacer4',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 4 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                ),
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),            
            array(
                'id'             => 'mobile_header_spacer5',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 5 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                ),
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),            
            array(
                'id'             => 'mobile_header_spacer6',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Spacer 6 Width', 'integrio' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                ),
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),   
        )
    ) );

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Page Title', 'integrio' ),
        'id'               => 'page_title',
    ));

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Settings', 'integrio' ),
        'id'               => 'page_title_settings',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'page_title_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Title Switch', 'integrio' ),
                'default'  => true,
            ),
			array(
				'id'       => 'page_title-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Page Title Settings', 'integrio' ),
				'indent'   => true,
				'required' => array( 'page_title_switch', '=', '1' ),
			),
            array(
                'id'       => 'page_title_bg_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Use Background?', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'            => 'page_title_bg_image',
                'type'          => 'background',
                'title'         => esc_html__( 'Background', 'integrio' ),
                'preview'       => false,
                'preview_media' => true,
                'background-color' => true,
                'transparent'   => false,
                'default'       => array(
                    'background-image'      => '',
                    'background-repeat'     => 'no-repeat',
                    'background-size'       => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position'   => 'center bottom',
                    'background-color'      => '#14081f',
                ),
				'required' => array( 'page_title_bg_switch', '=', true ),
            ),
            array(
                'id'      => 'page_title_height',
                'type'    => 'dimensions',
                'units'   => false, 
                'units_extended' => false,
                'title'   => esc_html__( 'Height', 'integrio' ),
                'height'  => true,
                'width'   => false,
                'default' => array( 'height' => 440 ),
                'required' => array( 'page_title_bg_switch', '=', true ),
            ),
			array(
				'id'      => 'page_title_padding',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Paddings Top/Bottom', 'integrio' ),
				'mode'    => 'padding',
				'all'     => false,
				'bottom'  => true,
				'top'     => true,
				'left'    => false,
				'right'   => false,
				'default' => array(
					'padding-top'    => '97',
					'padding-bottom' => '100',
				),
			),
			array(
				'id'      => 'page_title_margin',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Margin Bottom', 'integrio' ),
				'mode'    => 'margin',
				'all'     => false,
				'bottom'  => true,
				'top'     => false,
				'left'    => false,
				'right'   => false,
				'default' => array( 'margin-bottom' => '40' ),
			),
			array(
				'id'      => 'page_title_align',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Title Alignment', 'integrio' ),
				'options' => array(
					'left'   => 'Left',
					'center' => 'Center',
					'right'  => 'Right'
				 ), 
				'default' => 'left',
			),
			array(
                'id'      => 'page_title_breadcrumbs_switch',
                'type'    => 'switch',
                'title'   => esc_html__( 'Breadcrumbs On/Off', 'integrio' ),
                'default' => true,
            ),
            array(
                'id'      => 'page_title_breadcrumbs_block_switch',
                'type'    => 'switch',
                'title'   => esc_html__( 'Breadcrumbs Block On/Off', 'integrio' ),
                'default' => false,
                'required' => array( 'page_title_breadcrumbs_switch', '=', true ),
            ),
            array(
				'id'      => 'page_title_breadcrumbs_align',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Breadcrumbs Alignment', 'integrio' ),
				'options' => array(
					'left'   => 'Left',
					'center' => 'Center',
					'right'  => 'Right'
				 ), 
				'default' => 'left',
				'required' => array( 'page_title_breadcrumbs_block_switch', '=', true ),
			),
            array(
                'id'      => 'page_title_parallax',
                'type'    => 'switch',
                'title'   => esc_html__( 'Parallax Switch', 'integrio' ),
                'default' => false,
            ),
            array(
                'id'       => 'page_title_parallax_speed',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Parallax Speed', 'integrio' ),
                'default'  => '0.3',
                'min'      => '-5',
                'step'     => '0.1',
                'max'      => '5',
                'required' => array( 'page_title_parallax', '=', '1' ),
            ),
            array(
                'id'     => 'page_title-end',
                'type'   => 'section',
                'indent' => false, 
                'required' => array( 'page_title_switch', '=', '1' ),
            ),
            
        )
    ) );

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Typography', 'integrio' ),
        'id'               => 'page_title_typography',
        'subsection'       => true,        
        'fields'           => array(
            array(
                'id'          => 'page_title_font',
                'type'        => 'custom_typography',
                'title'       => esc_html__( 'Page Title Font', 'integrio' ),
                'font-size'   => true,
                'google'      => false,
                'font-weight' => false,
                'font-family' => false,
                'font-style'  => false,
                'color'       => true,
                'line-height' => true,
                'font-backup' => false,
                'text-align'  => false,
                'all_styles'  => false,
                'default'     => array(
                    'font-size'   => '42px',
                    'line-height' => '52px',
                    'color'       => '#fefefe',
                ),
            ),
            array(
                'id'          => 'page_title_breadcrumbs_font',
                'type'        => 'custom_typography',
                'title'       => esc_html__( 'Page Title Breadcrumbs Font', 'integrio' ),
                'font-size'   => true,
                'google'      => false,
                'font-weight' => false,
                'font-family' => false,
                'font-style'  => false,
                'color'       => true,
                'line-height' => true,
                'font-backup' => false,
                'text-align'  => false,
                'all_styles'  => false,
                'default'     => array(
                    'font-size'   => '16px',
                    'color'       => '#ffffff',
                    'line-height' => '24px',
                ),
            ),
        )
    ) );

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Responsive', 'integrio' ),
        'id'               => 'page_title_responsive',
        'subsection'       => true,        
        'fields'           => array(
            array(
                'id'       => 'page_title_resp_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Responsive Layout On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'        => 'page_title_resp_resolution',
                'type'      => 'slider',
                'title'     => esc_html__('Screen breakpoint', 'integrio'),
                "default"   => 768,
                "min"       => 1,
                "step"      => 1,
                "max"       => 1700,
                'display_value' => 'text',
                'required' => array( 'page_title_resp_switch', '=', '1' ),
            ),
            array(
                'id'        => 'page_title_resp_height',
                'type'      => 'dimensions',
                'units'     => false, 
                'units_extended' => false,
                'title'     => esc_html__( 'Height', 'integrio' ),
                'height'    => true,
                'width'     => false,
                'default'   => array(
                    'height' => 230,
                ),
                'required' => array( 'page_title_resp_switch', '=', '1' ),
            ),
            array(
                'id'       => 'page_title_resp_padding',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'bottom'   => true,
                'top'      => true,
                'left'     => false,
                'right'    => false,
                'title'    => esc_html__( 'Paddings Top/Bottom', 'integrio' ),
                'default'  => array(
                    'padding-top' => '15',              
                    'padding-bottom' => '40',
                ),
                'required' => array( 'page_title_resp_switch', '=', '1' ),
            ),
            array(
                'id'          => 'page_title_resp_font',
                'type'        => 'custom_typography',
                'title'       => esc_html__( 'Page Title Font', 'integrio' ),
                'font-size'   => true,
                'google'      => false,
                'font-weight' => false,
                'font-family' => false,
                'font-style'  => false,
                'color'       => true,
                'line-height' => true,
                'font-backup' => false,
                'text-align'  => false,
                'all_styles'  => false,
                'default'     => array(
                    'font-size'   => '42px',
                    'line-height' => '60px',
                    'color'       => '#ffffff',
                ),
                'required' => array( 'page_title_resp_switch', '=', '1' ),
            ),            
            array(
                'id'       => 'page_title_resp_breadcrumbs_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumbs On/Off', 'integrio' ),
                'default'  => true,
                'required' => array( 'page_title_resp_switch', '=', '1' ),
            ),
            array(
                'id'          => 'page_title_resp_breadcrumbs_font',
                'type'        => 'custom_typography',
                'title'       => esc_html__( 'Page Title Breadcrumbs Font', 'integrio' ),
                'font-size'   => true,
                'google'      => false,
                'font-weight' => false,
                'font-family' => false,
                'font-style'  => false,
                'color'       => true,
                'line-height' => true,
                'font-backup' => false,
                'text-align'  => false,
                'all_styles'  => false,
                'default'     => array(
                    'font-size'   => '14px',
                    'color'       => '#ffffff',
                    'line-height' => '24px',
                ),
                'required' => array( 'page_title_resp_breadcrumbs_switch', '=', '1' ),
            ),

        )
    ) );

    // -> START Footer Options
    Redux::setSection( $theme_slug, array(
        'title' => esc_html__( 'Footer', 'integrio' ),
        'id'    => 'footer',        
    ) ); 

    Redux::setSection( $theme_slug, array(
        'title'      => esc_html__( 'Settings', 'integrio' ),
        'id'         => 'footer_settings',
        'subsection' => true,        
        'fields'     => array(
            array(
                'id'       => 'footer_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'footer-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Settings', 'integrio' ),
                'indent'   => true,
                'required' => array( 'footer_switch', '=', '1' ),
            ),            
            array(
                'id'        => 'footer_add_wave',
                'type'      => 'switch',
                'title'     => esc_html__( 'Add Wave', 'integrio' ),
                'default'   => false,
                 'required' => array( 'footer_switch', '=', '1' ),
            ),           
            array(
                'id'             => 'footer_wave_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Set Wave Height' , 'integrio' ),
                'height'         => true,
                'width'          => false,
                'default'        => array( 'height' => 158 ),
                'required'       => array( 'footer_add_wave', '=', '1' ),
            ), 
            array(
                'id'       => 'footer_content_type',
                'type'     => 'select',
                'title'    => esc_html__( 'Content Type', 'integrio' ),
                'options'  => array(
                    'widgets' => 'Get Widgets',
                    'pages' => 'Get Pages'
                ),
                'default'  => 'widgets'
            ),
            array(
                'id'       => 'footer_page_select',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Select', 'integrio' ),
                'data'  => 'posts',
                'args'  => array(
                    'post_type'      => 'footer',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ),
                'required' => array( 'footer_content_type', '=', 'pages' )
            ),
            array(
                'id'       => 'widget_columns',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Columns', 'integrio' ),
                'options' => array(
                    '1' => '1', 
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                 ), 
                'default' => '4',
                'required' => array( 'footer_content_type', '=', 'widgets' )
            ),
            array(
                'id'       => 'widget_columns_2',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Columns Layout', 'integrio' ),
                'options'  => array(
                    '6-6' => array(
                        'alt' => '50-50',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/50-50.png'
                    ),
                    '3-9' => array(
                        'alt' => '25-75',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/25-75.png'
                    ),
                    '9-3' => array(
                        'alt' => '75-25',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/75-25.png'
                    ),
                    '4-8' => array(
                        'alt' => '33-66',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/33-66.png'
                    ),
                    '8-4' => array(
                        'alt' => '66-33',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/66-33.png'
                    )
                ),
                'default'  => '6-6',
                'required' => array( 'widget_columns', '=', '2' ),
            ),
            array(
                'id'       => 'widget_columns_3',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Columns Layout', 'integrio' ),
                'options'  => array(
                    '4-4-4' => array(
                        'alt' => '33-33-33',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/33-33-33.png'
                    ),
                    '3-3-6' => array(
                        'alt' => '25-25-50',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/25-25-50.png'
                    ),
                    '3-6-3' => array(
                        'alt' => '25-50-25',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/25-50-25.png'
                    ),
                    '6-3-3' => array(
                        'alt' => '50-25-25',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/50-25-25.png'
                    ),
                ),
                'default'  => '4-4-4',
                'required' => array( 'widget_columns', '=', '3' ),
            ),
            array(
                'id'       => 'footer_spacing',
                'type'     => 'spacing',
                'output'   => array( '.wgl-footer' ),
                'mode'     => 'padding',
                'units'    => 'px',
                'all'      => false,
                'title'    => esc_html__( 'Paddings', 'integrio' ),
                'default'  => array(
                    'padding-top'    => '90px',
                    'padding-right'  => '0px',
                    'padding-bottom' => '10px',
                    'padding-left'   => '0px'
                )
            ),
            array(
                'id'       => 'footer_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'footer_content_type', '=', 'widgets' )
            ),
            array(
                'id'     => 'footer-end',
                'type'   => 'section',
                'indent' => false, 
                'required' => array( 'footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'footer-start-styles',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Styling', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'footer_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview'  => false,
                'title'    => esc_html__( 'Background Image', 'integrio' ),
                'default'  => array(
                    'background-repeat'     => 'repeat',
                    'background-size'       => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position'   => 'center center',
                )
            ),
            array(
                'id'       => 'footer_align',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Content Align', 'integrio'),
                'options'  => array(
                    'left'   => 'Left', 
                    'center' => 'Center',
                    'right'  => 'Right'
                 ), 
                'default'  => 'center',
                'required' => array( 'footer_content_type', '=', 'widgets' )
            ),
            array(
                'id'       => 'footer_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Background Color', 'integrio' ),
                'default'  => '#f8f7f6',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_heading_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Headings color', 'integrio' ),
                'default'  => '#161616',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Content color', 'integrio' ),
                'default'  => '#414141',
                'transparent' => false
            ),
            array(
                'id'     => 'footer-end-styles',
                'type'   => 'section',
                'indent' => false, 
            ),
        )
    ) );

    // -> START Copyright Options
    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Copyright', 'integrio' ),
        'id'               => 'copyright',        
    ) );

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Settings', 'integrio' ),
        'id'               => 'copyright-settings',
        'subsection'       => true,        
        'fields'           => array(
            array(
                'id'       => 'copyright_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Copyright On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'copyright-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Copyright Settings', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'      => 'copyright_editor',
                'type'    => 'editor',
                'title'   => esc_html__( 'Editor', 'integrio' ),
                'default' => '<p>Copyright © 2019 Integrio by WebGeniusLab. All Rights Reserved</p>',
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 2,
                    'teeny'         => false,
                    'quicktags'     => true,
                ),
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'integrio' ),
                'default'  => '#96a1b6',
                'transparent' => false,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Background Color', 'integrio' ),
                'default'  => '#f8f7f6',
                'transparent' => false,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_spacing',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'left'     => false,
                'right'     => false,
                'all'      => false,
                'title'    => esc_html__( 'Paddings', 'integrio' ),
                'default'  => array(
                    'padding-top'    => '20',
                    'padding-bottom' => '20',
                ),
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'     => 'copyright-end',
                'type'   => 'section',
                'indent' => false, 
                'required' => array( 'footer_switch', '=', '1' ),
            ),
        )
    ));

    // -> START Blog Options
    Redux::setSection( $theme_slug, array(
        'title' => esc_html__( 'Blog', 'integrio' ),
        'id'    => 'blog-option',        
        'icon'  => 'el-icon-th',
    ) );

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Archive', 'integrio' ),
        'id'               => 'blog-list-option',
        'subsection'       => true,        
        'fields'           => array(
            array(
                'id'       => 'post_archive_page_title_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview'  => false,
                'title'    => esc_html__( 'Archive Page Title Background Image', 'integrio' ),
                'default'  => array(
                    'background-repeat'     => 'repeat',
                    'background-size'       => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position'   => 'center center',
                    'background-color'      => '#1e73be',
                )
            ),
            array(
                'id'       => 'blog_list_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog Archive Sidebar Layout', 'integrio' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'blog_list_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Archive Sidebar', 'integrio' ),
                'data'     => 'sidebars',
                'required' => array( 'blog_list_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'blog_list_sidebar_def_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Blog Archive Sidebar Width', 'integrio' ),
                'options'  => array(          
                    '9' => '25%',
                    '8' => '33%',
                ),
                'default'  => '9',
                'required' => array( 'blog_list_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'blog_list_sidebar_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Blog Archive Sticky Sidebar On?', 'integrio' ),
                'default'  => false,
                'required' => array( 'blog_list_sidebar_layout', '!=', 'none' ),
            ),         
            array(
                'id'       => 'blog_list_sidebar_gap',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Archive Sidebar Side Gap', 'integrio' ),
                'options'  => array(
                    'def' => esc_html__( 'Default', 'integrio' ),
                    '0' => '0',     
                    '15' => '15',     
                    '20' => '20',     
                    '25' => '25',     
                    '30' => '30',     
                    '35' => '35',     
                    '40' => '40',     
                    '45' => '45',     
                    '50' => '50',     
                ),
                'default'  => '30',
                'required' => array( 'blog_list_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'blog_list_columns',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Columns in Archive', 'integrio'),
                'options' => array(
                    '12' => 'One', 
                    '6' => 'Two', 
                    '4' => 'Three',
                    '3' => 'Four'
                 ), 
                'default' => '12'
            ),
            array(
                'id'       => 'blog_list_likes',
                'type'     => 'switch',
                'title'    => esc_html__( 'Likes On/Off', 'integrio' ),
                'default'  => false,
            ),            
            array(
                'id'       => 'blog_list_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Share On/Off', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_hide_media',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide Media?', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_hide_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide Title?', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_hide_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide Content?', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_post_listing_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cut Off Text in Blog Listing', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_letter_count',
                'type'     => 'text',
                'title'    => esc_html__( 'Number of character to show after trim.', 'integrio'),
                'default'  => '85',
                'required' => array( 'blog_post_listing_content', '=', true ),
            ),
            array(
                'id'       => 'blog_list_read_more',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide Read More Button?', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide all post-meta?', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_meta_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta author?', 'integrio' ),
                'default'  => false,
                'required' => array( 'blog_list_meta', '=', false ),
            ),
            array(
                'id'       => 'blog_list_meta_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta comments?', 'integrio' ),
                'default'  => false,
                'required' => array( 'blog_list_meta', '=', false ),
            ),
            array(
                'id'       => 'blog_list_meta_categories',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta categories?', 'integrio' ),
                'default'  => false,
                'required' => array( 'blog_list_meta', '=', false ),
            ),
            array(
                'id'       => 'blog_list_meta_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta date?', 'integrio' ),
                'default'  => false,
                'required' => array( 'blog_list_meta', '=', false ),
            ),
        )
    ));

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Single', 'integrio' ),
        'id'               => 'blog-single-option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'blog_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Blog Post Title On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'post_single_page_title_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Single Page Title Text', 'integrio' ),
                'default'  => esc_html__( 'Blog', 'integrio' ),
                'required' => array( 'blog_title_conditional', '=', true ),
            ),  
            array(
                'id'       => 'post_single_page_title_bg_image',
                'type'     => 'background',
                'preview'  => false,
                'preview_media' => true,
                'background-color' => false,
                'title'    => esc_html__( 'Single Page Title Background Image', 'integrio' ),
                'default'  => array(
                    'background-repeat'     => 'repeat',
                    'background-size'       => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position'   => 'center center',
                    'background-color'      => '#2d2d2d',
                )
            ),
            array(
                'id'       => 'single_type_layout',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Blog Single Type', 'integrio' ),
                'options'  => array(
                    '1' => esc_html__( 'Title First', 'integrio' ),
                    '2' => esc_html__( 'Image First', 'integrio' ),
                    '3' => esc_html__( 'Overlay Image', 'integrio' )
                ),
                'default'  => '3'
            ), 
            array(
                'id'       => 'single_padding_layout_3',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                'all'      => false,
                'bottom'   => true,
                'top'      => true,
                'left'     => false,
                'right'    => false,
                'title'    => esc_html__( 'Page Title Padding', 'integrio' ),
                'default'  => array(
                    'padding-top' => '105px',              
                    'padding-bottom' => '105px',
                ),
                'required' => array( 'single_type_layout', '=', '3' ),
            ),
            array(
                'id'       => 'featured_image_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Featured Image', 'integrio' ),
                'options'  => array(
                    'default' => esc_html__( 'Default', 'integrio' ),
                    'off' => esc_html__( 'Off', 'integrio' ),
                    'replace' => esc_html__( 'Replace', 'integrio' )
                ),
                'default'  => 'default'
            ), 
            array(
                'id'       => 'featured_image_replace',
                'type'     => 'media',
                'title'    => esc_html__( 'Featured Image Replace', 'integrio' ),
                'required' => array( 'featured_image_type', '=', 'replace' ),
            ),
            array(
                'id'       => 'single_apply_animation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Apply Animation?', 'integrio' ),
                'default'  => true,
                'required' => array( 'single_type_layout', '=', '3' ),
            ),           
            array(
                'id'       => 'single_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog Single Sidebar Layout', 'integrio' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    )
                ),
                'default'  => 'right'
            ),
            array(
                'id'       => 'single_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Single Sidebar', 'integrio' ),
                'data'     => 'sidebars',
                'required' => array( 'single_sidebar_layout', '!=', 'none' ),
                'default'  =>  'sidebar_main-sidebar',
            ),  
            array(
                'id'       => 'single_sidebar_def_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Blog Single Sidebar Width', 'integrio' ),
                'options'  => array(
                    '9' => '25%',
                    '8' => '33%',
                ),
                'default'  => '9',
                'required' => array( 'single_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'single_sidebar_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Blog Single Sticky Sidebar On?', 'integrio' ),
                'default'  => true,
                'required' => array( 'single_sidebar_layout', '!=', 'none' ),
            ),         
            array(
                'id'       => 'single_sidebar_gap',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Single Sidebar Side Gap', 'integrio' ), 
                'options'  => array(
                    'def' => esc_html__( 'Default', 'integrio' ),
                    '0'  => '0',     
                    '15' => '15',     
                    '20' => '20',     
                    '25' => '25',     
                    '30' => '30',     
                    '35' => '35',     
                    '40' => '40',     
                    '45' => '45',     
                    '50' => '50',     
                ),
                'default'  => 'def',
                'required' => array( 'single_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'single_related_posts',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Posts', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'single_likes',
                'type'     => 'switch',
                'title'    => esc_html__( 'Likes On/Off', 'integrio' ),
                'default'  => false,
            ),            
            array(
                'id'       => 'single_views',
                'type'     => 'switch',
                'title'    => esc_html__( 'Views On/Off', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'single_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Share On/Off', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'single_author_info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Author Info On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'single_meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide all post-meta?', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'single_meta_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta author?', 'integrio' ),
                'default'  => false,
                'required' => array( 'single_meta', '=', false ),
            ),
            array(
                'id'       => 'single_meta_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta comments?', 'integrio' ),
                'default'  => true,
                'required' => array( 'single_meta', '=', false ),
            ),
            array(
                'id'       => 'single_meta_categories',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta categories?', 'integrio' ),
                'default'  => false,
                'required' => array( 'single_meta', '=', false ),
            ),
            array(
                'id'       => 'single_meta_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta date?', 'integrio' ),
                'default'  => false,
                'required' => array( 'single_meta', '=', false ),
            ),
            array(
                'id'       => 'single_meta_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide tags?', 'integrio' ),
                'default'  => false,
            ),
            
        )
    ) );     
    
    // -> START Portfolio Options
    Redux::setSection( $theme_slug, array(
        'title' => esc_html__( 'Portfolio', 'integrio' ),
        'id'    => 'portfolio-option',        
        'icon'  => 'el-icon-th',
    ) );

    Redux::setSection( $theme_slug, array(
        'title'      => esc_html__( 'Archive', 'integrio' ),
        'id'         => 'portfolio-list-option',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'portfolio_archive_page_title_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview'  => false,
                'title'    => esc_html__( 'Archive Page Title Background Image', 'integrio' ),
                'default'  => array(
                    'background-repeat'     => 'repeat',
                    'background-size'       => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position'   => 'center center',
                    'background-color'      => '#2d2d2d',
                )
            ),
            array(
                'id'       => 'portfolio_list_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Portfolio Archive Sidebar Layout', 'integrio' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'portfolio_list_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Portfolio Archive Sidebar', 'integrio' ),
                'data'     => 'sidebars',
                'required' => array( 'portfolio_list_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'portfolio_list_columns',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Columns in Archive', 'integrio'),
                'options' => array(
                    '1' => 'One', 
                    '2' => 'Two', 
                    '3' => 'Three',
                    '4' => 'Four'
                 ), 
                'default' => '3'
            ),
            array(
                'id'       => 'portfolio_slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Portfolio Slug', 'integrio' ),
                'default'  => 'portfolio',
            ),  
            array(
                'id'       => 'portfolio_list_show_filter',
                'type'     => 'switch',
                'title'    => esc_html__( 'Filter On/Off', 'integrio' ),
                'default'  => false,
            ),

            array(
                'id'       => 'portfolio_list_filter_cats',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_html__( 'Select Categories', 'integrio' ), 
                'data'     => 'terms',
                'args'     => array('taxonomies'=>'portfolio-category'),
                'required' => array( 'portfolio_list_show_filter', '=', '1' ),
            ),

            array(
                'id'       => 'portfolio_list_show_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Title On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'portfolio_list_show_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Content On/Off', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'portfolio_list_show_cat',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories On/Off', 'integrio' ),
                'default'  => true,
            ),
        )
    ) );

	Redux::setSection( $theme_slug, array(
		'title'            => esc_html__( 'Single', 'integrio' ),
		'id'               => 'portfolio-single-option',
		'subsection'       => true,
		'fields'           => array(
			array(
				'id'       => 'portfolio_single_post_title-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Post Title Settings', 'integrio' ),
				'indent'   => true,
			),
			array(
				'id'       => 'portfolio_title_conditional',
				'type'     => 'switch',
				'title'    => esc_html__( 'Use Custom Post Title?', 'integrio' ),
				'default'  => false,
			),
			array(
			    'id'       => 'portfolio_single_page_title_text',
			    'type'     => 'text',
			    'title'    => esc_html__( 'Custom Post Title', 'integrio' ),
			    'default'  => esc_html__( '', 'integrio' ),
			    'required' => array( 'portfolio_title_conditional', '=', true ),
			), 
			array(
				'id'      => 'portfolio_single_title_align',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Title Alignment', 'integrio' ),
				'options' => array(
					'left'   => esc_html__( 'Left', 'integrio' ),
					'center' => esc_html__( 'Center', 'integrio' ),
					'right'  => esc_html__( 'Right', 'integrio' ),
				),
				'default' => 'left',
			),
			array(
				'id'      => 'portfolio_single_breadcrumbs_align',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Title Breadcrumbs Alignment', 'integrio' ),
				'options' => array(
					'left'   => esc_html__( 'Left', 'integrio' ),
					'center' => esc_html__( 'Center', 'integrio' ),
					'right'  => esc_html__( 'Right', 'integrio' ),
				),
				'default' => 'right',
			),
			array(
				'id'      => 'portfolio_single_title_bg_switch',
				'type'    => 'switch',
				'title'   => esc_html__( 'Use Background?', 'integrio' ),
				'default' => true,
			),
			array(
				'id'      => 'portfolio_single_page_title_bg_image',
				'type'    => 'background',
				'title'   => esc_html__( 'Background', 'integrio' ),
				'preview' => false,
				'preview_media' => true,
				'background-color' => true,
				'transparent' => false,
				'default' => array(
					'background-repeat'     => 'repeat',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
					'background-position'   => 'center center',
					'background-color'      => '#2d2d2d',
				),
				'required' => array( 'portfolio_single_title_bg_switch', '=', true ),
			),
			array(
				'id'      => 'portfolio_single_page_title_padding',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Paddings Top/Bottom', 'integrio' ),
				'mode'    => 'padding',
				'all'     => false,
				'bottom'  => true,
				'top'     => true,
				'left'    => false,
				'right'   => false,
				'default' => array(
					'padding-top'    => '170',
					'padding-bottom' => '100',
				),
			),
			array(
				'id'      => 'portfolio_single_page_title_margin',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Margin Bottom', 'integrio' ),
				'mode'    => 'margin',
				'all'     => false,
				'bottom'  => true,
				'top'     => false,
				'left'    => false,
				'right'   => false,
				'default' => array( 'margin-bottom' => '40' ),
			),
			array(
				'id'     => 'portfolio_single_post_title-end',
				'type'   => 'section',
				'indent' => false,
			),
            array(
                'id'      => 'portfolio_single_type_layout',
                'type'    => 'button_set',
                'title'   => esc_html__( 'Portfolio Single Type', 'integrio' ),
                'options' => array(
                    '1' => esc_html__( 'Title First', 'integrio' ),
                    '2' => esc_html__( 'Image First', 'integrio' ),
                    '3' => esc_html__( 'Overlay Image', 'integrio' ),
                    '4' => esc_html__( 'Overlay Image with Info', 'integrio' ),
                ),
                'default' => '2',
            ),
            array(
                'id'      => 'portfolio_single_align',
                'type'    => 'button_set',
                'title'   => esc_html__( 'Content Alignment', 'integrio' ),
                'options' => array(
                    'left' => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'left',
            ),
            array(
                'id'      => 'portfolio_single_padding',
                'type'    => 'spacing',
                'mode'    => 'padding',
                'all'     => false,
                'bottom'  => true,
                'top'     => true,
                'left'    => false,
                'right'   => false,
                'title'   => esc_html__( 'Portfolio Single Padding', 'integrio' ),
                'default' => array(
                    'padding-top'    => '165px',              
                    'padding-bottom' => '165px',
                ),
                'required' => array(
                    array( 'portfolio_single_type_layout', '!=', '1' ),
                    array( 'portfolio_single_type_layout', '!=', '2' ),
                ),
            ),
            array(
                'id'       => 'portfolio_parallax',
                'type'     => 'switch',
                'title'    => esc_html__( 'Add Portfolio Parallax', 'integrio' ),
                'default'  => false,
                'required' => array(
                    array( 'portfolio_single_type_layout', '!=', '1' ),
                    array( 'portfolio_single_type_layout', '!=', '2' ),
                ),
            ),
            array(
                'id'       => 'portfolio_parallax_speed',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Parallax Speed', 'integrio' ),
                'default'  => '0.3',
                'min'      => '-5',
                'step'     => '0.1',
                'max'      => '5',
                'required' => array( 'portfolio_parallax', '=', '1' ),
            ),
            array(
                'id'       => 'portfolio_single_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Portfolio Single Sidebar Layout', 'integrio' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'portfolio_single_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Portfolio Single Sidebar', 'integrio' ),
                'data'     => 'sidebars',
                'required' => array( 'portfolio_single_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'portfolio_single_sidebar_def_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Portfolio Single Sidebar Width', 'integrio' ),
                'options'  => array(
                    '9' => '25%',
                    '8' => '33%',
                ),
                'default'  => '8',
                'required' => array( 'portfolio_single_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'portfolio_single_sidebar_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Single Sticky Sidebar On?', 'integrio' ),
                'default'  => false,
                'required' => array( 'portfolio_single_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'portfolio_single_sidebar_gap',
                'type'     => 'select',
                'title'    => esc_html__( 'Portfolio Single Sidebar Side Gap', 'integrio' ),
                'options'  => array(
                    'def' => esc_html__( 'Default', 'integrio' ),
                    '0'  => '0',
                    '15' => '15',
                    '20' => '20',
                    '25' => '25',
                    '30' => '30',
                    '35' => '35',
                    '40' => '40',
                    '45' => '45',
                    '50' => '50',
                ),
                'default'  => 'def',
                'required' => array( 'portfolio_single_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'portfolio_above_content_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tags On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'portfolio_above_content_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Share On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'portfolio_single_meta_likes',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post-meta likes On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id' => 'portfolio_single_meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide all post-meta?', 'integrio' ),
                'default'  => false,
            ),
            array(
                'id'       => 'portfolio_single_meta_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post-meta author On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'portfolio_single_meta', '=', false ),
            ),
            array(
                'id'       => 'portfolio_single_meta_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post-meta comments On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'portfolio_single_meta', '=', false ),
            ),
            array(
                'id'       => 'portfolio_single_meta_categories',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post-meta categories On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'portfolio_single_meta', '=', false ),
            ),
            array(
                'id'       => 'portfolio_single_meta_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post-meta date On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'portfolio_single_meta', '=', false ),
            ),
        )
    ) );   

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Related Posts', 'integrio' ),
        'id'               => 'portfolio-related-option',
        'subsection'       => true,        
        'fields'           => array(
            array(
                'id'       => 'portfolio_related_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Posts On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'pf_title_r',
                'type'     => 'text',
                'title'    => esc_html__( 'Title', 'integrio' ),
                'default'  => esc_html__( 'Related Portfolio', 'integrio' ),
                'required' => array( 'portfolio_related_switch', '=', '1' ),
            ), 
            array(
                'id'       => 'pf_carousel_r',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display items carousel for this portfolio post', 'integrio' ),
                'default'  => true,
                'required' => array( 'portfolio_related_switch', '=', '1' ),
            ),
            array(
                'id'       => 'pf_column_r',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Related Columns', 'integrio'),
                'options'  => array(
                    '2' => 'Two', 
                    '3' => 'Three',
                    '4' => 'Four'
                ), 
                'default'  => '3',
                'required' => array( 'portfolio_related_switch', '=', '1' ),
            ),
            array(
                'id'       => 'pf_number_r',
                'type'     => 'text',
                'title'    => esc_html__( 'Number of Related Items', 'integrio' ),
                'default'  => '3',
                'required' => array( 'portfolio_related_switch', '=', '1' ),
            ), 
        )
    ) ); 

    // -> START Team Options
    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Team', 'integrio' ),
        'id'               => 'team-option',        
        'icon'             => 'el-icon-th',
        'fields'           => array(
            array(
                'id'       => 'team_slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Team Slug', 'integrio' ),
                'default'  => 'team',
            ), 
            array(
                'id'       => 'team_single_page_title_bg_image',
                'type'     => 'background',
                'preview' => false,
                'preview_media' => true,
                'background-color' => false,
                'title'    => esc_html__( 'Single Page Title Background Image', 'integrio' ),
                'default'  => array(
                    'background-repeat'     => 'repeat',
                    'background-size'       => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position'   => 'center center',
                    'background-color'      => '#2d2d2d',
                )
            ),          
        )
    ) ); 

    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Single', 'integrio' ),
        'id'               => 'team-single-option',
        'subsection'       => true,        
        'fields'           => array(
            array(
                'id'       => 'team_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Team Post Title On/Off', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'team_single_page_title_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Single Page Title Text', 'integrio' ),
                'default'  => esc_html__( 'Team', 'integrio' ),
                'required' => array( 'team_title_conditional', '=', true ),
            ), 
        )
    ) );   

	// -> START Page 404 Options
	Redux::setSection( $theme_slug, array(
		'title'            => esc_html__( 'Page 404', 'integrio' ),
		'id'               => '404-option',
		'icon'             => 'el-icon-th',
		'fields'           => array(
			array(
				'id'       => '404_post_title-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Page Title Settings', 'integrio' ),
				'indent'   => true,
			),
			array(
				'id'       => '404_custom_title_switch',
				'type'     => 'switch',
				'title'    => esc_html__( 'Use Custom Page Title?', 'integrio' ),
				'default'  => false,
			),
			array(
				'id'       => '404_page_title_text',
				'type'     => 'text',
				'title'    => esc_html__( 'Custom Page Title', 'integrio' ),
				'default'  => esc_html__( '', 'integrio' ),
				'required' => array( '404_custom_title_switch', '=', true ),
			),

			array(
				'id'      => '404_title_bg_switch',
				'type'    => 'switch',
				'title'   => esc_html__( 'Use Background?', 'integrio' ),
				'default' => true,
			),
			array(
				'id'       => '404_page_title_bg_image',
				'type'     => 'background',
				'preview'  => false,
				'preview_media' => true,
				'background-color' => true,
				'transparent' => false,
				'title'    => esc_html__( 'Background', 'integrio' ),
				'default'  => array(
					'background-repeat'     => 'repeat',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
					'background-position'   => 'center center',
					'background-color'      => '#2d2d2d',
				),
				'required' => array( '404_title_bg_switch', '=', true ),
			),
			array(
				'id'      => '404_page_title_padding',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Paddings Top/Bottom', 'integrio' ),
				'mode'    => 'padding',
				'all'     => false,
				'bottom'  => true,
				'top'     => true,
				'left'    => false,
				'right'   => false,
				'default' => array(
					'padding-top'    => '35',
					'padding-bottom' => '0',
				),
			),
			array(
				'id'      => '404_page_title_margin',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Margin Bottom', 'integrio' ),
				'mode'    => 'margin',
				'all'     => false,
				'bottom'  => true,
				'top'     => false,
				'left'    => false,
				'right'   => false,
				'default' => array( 'margin-bottom' => '0' ),
			),
			array(
				'id'     => '404_post_title-end',
				'type'   => 'section',
				'indent' => false,
			),
		)
	) ); 

	// -> START Side Panel Options
    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Side Panel', 'integrio' ),
        'id'               => 'side_panel',
        'icon'             => 'el-icon-th',
        'fields'           => array(
            array(
                'id'       => 'side_panel_text_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Text Color', 'integrio' ),
                'default'  => array(
                    'color' => '#313538',
                    'alpha' => '1',
                    'rgba'  => 'rgba(96,101,104,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'side_panel_bg',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background', 'integrio' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'side_panel_text_alignment',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Text Align', 'integrio' ),
                'options'  => array(
                    'left'   => esc_html__( 'Left', 'integrio' ),
                    'center' => esc_html__( 'Center', 'integrio' ),
                    'right'  => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'center'
            ),
            array(
                'id'       => 'side_panel_width',
                'type'     => 'dimensions',
                'units'    => false, 
                'units_extended' => false,
                'title'    => esc_html__( 'Width', 'integrio' ),
                'height'   => false,
                'width'    => true,
                'default'  => array(
                    'width' => 480,
                )
            ),
            array(
                'id'       => 'side_panel_position',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Position', 'integrio' ),
                'options'  => array(
                    'left'  => esc_html__( 'Left', 'integrio' ),
                    'right' => esc_html__( 'Right', 'integrio' ),
                ),
                'default'  => 'right'
            ),
        )
    ) );

    // -> START Layout Options
    Redux::setSection( $theme_slug, array(
        'title'  => esc_html__( 'Sidebars', 'integrio' ),
        'id'     => 'layout_options',
        'icon'   => 'el el-braille',
        'fields' => array(
            array(
                'id'       => 'sidebars', 
                'type'     => 'multi_text',
                'validate' => 'no_html',
                'add_text' => esc_html__( 'Add Sidebar', 'integrio' ),
                'title'    => esc_html__( 'Register Sidebars', 'integrio' ),
                'default'  => array('Main Sidebar'),
            ),
            array(
                'id'       => 'sidebars-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Sidebar Page Settings', 'integrio' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'page_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Page Sidebar Layout', 'integrio' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'page_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Sidebar', 'integrio' ),
                'data'     => 'sidebars',
                'required' => array( 'page_sidebar_layout', '!=', 'none' ),
            ),          
            array(
                'id'       => 'page_sidebar_def_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Page Sidebar Width', 'integrio' ),
                'options'  => array(
                    '9' => '25%',
                    '8' => '33%',     
                ),
                'default'  => '9',
                'required' => array( 'page_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'page_sidebar_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Sidebar On?', 'integrio' ),
                'default'  => false,
                'required' => array( 'page_sidebar_layout', '!=', 'none' ),
            ),         
            array(
                'id'       => 'page_sidebar_gap',
                'type'     => 'select',
                'title'    => esc_html__( 'Sidebar Side Gap', 'integrio' ),
                'options'  => array(
                    'def' => esc_html__( 'Default', 'integrio' ),
                    '0'  => '0',     
                    '15' => '15',     
                    '20' => '20',     
                    '25' => '25',     
                    '30' => '30',     
                    '35' => '35',     
                    '40' => '40',     
                    '45' => '45',     
                    '50' => '50',     
                ),
                'default'  => '30',
                'required' => array( 'page_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'     => 'sidebars-end',
                'type'   => 'section',
                'indent' => false,
            ),
        )
    ) );

        // -> START Social Share Options
    Redux::setSection( $theme_slug, array(
        'title'  => esc_html__( 'Social Shares', 'integrio' ),
        'id'     => 'soc_shares',        
        'icon'   => 'el el-share-alt',
        'fields' => array(         
            array(
                'id'       => 'show_soc_icon_page',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Social Share on Pages On/Off', 'integrio' ),
                'default'  => false,
            ),    
            array(
                'id'       => 'soc_icon_style',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Choose your share style.', 'integrio' ),
                'options'  => array(
                    'standard' => esc_html__( 'Standard', 'integrio' ),
                    'hovered' => esc_html__( 'Hovered', 'integrio' ),
                ),
                'default'  => 'standard',
                'required' => array( 'show_soc_icon_page', '=', '1' ),
            ), 
            array(
                'id'       => 'soc_icon_position',
                'type'     => 'switch',
                'title'    => esc_html__( 'Fixed Position On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'show_soc_icon_page', '=', '1' ),
            ),
            array(
                'id'       => 'soc_icon_offset',
                'type'     => 'spacing',
                'mode'     => 'margin',
                'all'      => false,
                'bottom'   => true,
                'top'      => false,
                'left'     => false,
                'right'    => false,
                'title'    => esc_html__( 'Offset Top', 'integrio' ),
                'desc'     => esc_html__( 'Measurement units defined as "percents" while position fixed is enabled, and as "pixels" while position is off.', 'integrio' ),
                'default'  => array(
                    'margin-bottom' => '40%',          
                ),
                'required' => array( 'show_soc_icon_page', '=', '1' ),
            ),    
            array(
                'id'       => 'soc_icon_facebook',
                'type'     => 'switch',
                'title'    => esc_html__( 'Facebook Share On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'show_soc_icon_page', '=', '1' ),
            ),            
            array(
                'id'       => 'soc_icon_twitter',
                'type'     => 'switch',
                'title'    => esc_html__( 'Twitter Share On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'show_soc_icon_page', '=', '1' ),
            ),            
            array(
                'id'       => 'soc_icon_linkedin',
                'type'     => 'switch',
                'title'    => esc_html__( 'Linkedin Share On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'show_soc_icon_page', '=', '1' ),
            ),            
            array(
                'id'       => 'soc_icon_pinterest',
                'type'     => 'switch',
                'title'    => esc_html__( 'Pinterest Share On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'show_soc_icon_page', '=', '1' ),
            ),             
            array(
                'id'       => 'soc_icon_tumblr',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tumblr Share On/Off', 'integrio' ),
                'default'  => false,
                'required' => array( 'show_soc_icon_page', '=', '1' ),
            ),                       
        )
    ) );   

    // -> START Styling Options
    Redux::setSection( $theme_slug, array(
        'title'            => esc_html__( 'Color Options', 'integrio' ),
        'id'               => 'color_options_color',
        'icon'             => 'el-icon-tint',     
        'fields'           => array(
            array(
                'id'        => 'theme-custom-color',
                'type'      => 'color',
                'title'     => esc_html__( 'General Theme Color', 'integrio' ),
                'transparent' => false,
                'default'   => '#0c5adb',
                'validate'  => 'color',
            ),
            array(
                'id'       => 'use-gradient',
                'type'     => 'switch',
                'title'    => esc_html__( 'Use Theme Gradient?', 'integrio' ),
                'default'  => true,
            ),
            array(
                'id'       => 'theme-gradient',
                'type'     => 'color_gradient',
                'title'    => esc_html__('Theme Gradient', 'integrio' ),
                'validate' => 'color',
                'default'  => array(
                    'from' => '#0c1bae',
                    'to'   => '#3486fe',
                ),
                'required' => array( 'use-gradient', '=', '1' ),
            ),
            array(
                'id'        => 'body-background-color',
                'type'      => 'color',
                'title'     => esc_html__( 'Body Background Color', 'integrio' ),
                'transparent' => false,
                'default'   => '#ffffff',
                'validate'  => 'color',
            ), 
        )
    ));

    // Start Typography config
    Redux::setSection( $theme_slug, array(
        'title' => esc_html__( 'Typography', 'integrio' ),
        'id'    => 'Typography',
        'icon'  => 'el-icon-font', // Icon for section      
    ) );

    $typography = array();
    $main_typography = array(
        array(
            'id'          => 'main-font',
            'title'       => esc_html__( 'Content Font', 'integrio' ),
            'color'       => true,
            'line-height' => true,
            'font-size'   => true,
            'subsets'     => false,
            'all_styles'  => true,
            'font-weight-multi' => true,
            'defs' => array(
                'font-size'   => '16px',
                'line-height' => '30px',
                'color'       => '#616161',
                'font-family' => 'Open Sans',
                'font-weight' => '400',
                'font-weight-multi' => '600,700',
            ),
        ),
        array(
            'id'          => 'header-font',
            'title'       => esc_html__( 'Headings Main Settings', 'integrio' ),
            'font-size'   => false,
            'line-height' => false,
            'color'       => true,
            'subsets'     => false,
            'all_styles'  => true,
            'font-weight-multi' => true,
            'defs' => array(
                'color'       => '#232323',
                'google'      => true,
                'font-family' => 'Muli',
                'font-weight' => '900',
                'font-weight-multi' => '300,400,500,600,700',
            ),
        ),
    );
    foreach ($main_typography as $key => $value) {
        array_push($typography , array(
            'id'          => $value['id'],
            'type'        => 'custom_typography',
            'title'       => $value['title'], 
            'color'       => $value['color'],
            'line-height' => $value['line-height'],
            'font-size'   => $value['font-size'],
            'subsets'     => $value['subsets'],
            'all_styles'  => $value['all_styles'],
            'font-weight-multi' => isset($value['font-weight-multi']) ? $value['font-weight-multi'] : '',
            'subtitle'    => isset($value['subtitle']) ? $value['subtitle'] : '',
            'google'      => true,
            'font-style'  => true,
            'font-backup' => false,
            'text-align'  => false,
            'default'     => $value['defs'],
        ));
    }
    Redux::setSection( $theme_slug, array(
        'title'       => esc_html__( 'Main Content', 'integrio' ),
        'id'          => 'main_typography',
        //'icon' => 'el-icon-font', // Icon for section 
        'subsection'  => true,
        'fields'      => $typography
    ) );

    // Start menu typography
    $menu_typography = array(
        array(
            'id'          => 'menu-font',
            'title'       => esc_html__( 'Menu Font', 'integrio' ),
            'color'       => false,
            'line-height' => true,
            'font-size'   => true,
            'subsets'     => true,
            'defs' => array(
                'font-family' => 'Muli',
                'google'      => true,
                'font-size'   => '17px',
                'font-weight' => '600',
                'line-height' => '32px'
            ),
        ),
        array(
            'id'          => 'sub-menu-font',
            'title'       => esc_html__( 'Submenu Font', 'integrio' ),
            'color'       => false,
            'line-height' => true,
            'font-size'   => true,
            'subsets'     => true,
            'defs' => array(
                'font-family' => 'Muli',
                'google'      => true,
                'font-size'   => '16px',
                'font-weight' => '400',
                'line-height' => '30px'
            ),
        ),
    );
    $menu_typography_array = array();
    foreach ($menu_typography as $key => $value) {
        array_push($menu_typography_array , array(
            'id'          => $value['id'],
            'type'        => 'custom_typography',
            'title'       => $value['title'],
            'color'       => $value['color'],
            'line-height' => $value['line-height'],
            'font-size'   => $value['font-size'],
            'subsets'     => $value['subsets'],
            'google'      => true,
            'font-style'  => true,
            'font-backup' => false,
            'text-align'  => false,
            'all_styles'  => false,
            'default'     => $value['defs'],
        ));
    }
    Redux::setSection( $theme_slug, array(
        'title'      => esc_html__( 'Menu', 'integrio' ),
        'id'         => 'main_menu_typography',
        //'icon' => 'el-icon-font', // Icon for section 
        'subsection' => true,
        'fields'     => $menu_typography_array
    ) );
    // End menu Typography

    // Start headings typography
    $headings = array(
        array(
            'id'    => 'header-h1',
            'title' => esc_html__( 'H1', 'integrio' ),
            'defs'  => array(
                'font-family' => 'Muli',
                'font-size'   => '48px',
                'line-height' => '52px',
                'font-weight' => '900',
            ),
        ),
        array(
            'id' => 'header-h2',
            'title' => esc_html__( 'H2', 'integrio' ),
            'defs' => array(
                'font-family' => 'Muli',
                'font-size'   => '42px',
                'line-height' => '48px',
                'font-weight' => '900',
            ),
        ),
        array(
            'id' => 'header-h3',
            'title' => esc_html__( 'H3', 'integrio' ),
            'defs' => array(
                'font-family' => 'Muli',
                'font-weight' => '900',
                'font-size'   => '36px',
                'line-height' => '46px',
            ),
        ),
        array(
            'id' => 'header-h4',
            'title' => esc_html__( 'H4', 'integrio' ),
            'defs' => array(
                'font-family' => 'Muli',
                'font-size'   => '30px',
                'line-height' => '38px',
                'font-weight' => '900',
            ),
        ),
        array(
            'id' => 'header-h5',
            'title' => esc_html__( 'H5', 'integrio' ),
            'defs' => array(
                'font-family' => 'Muli',
                'font-size'   => '24px',
                'line-height' => '29px',
                'font-weight' => '700'
            ),
        ),
        array(
            'id' => 'header-h6',
            'title' => esc_html__( 'H6', 'integrio' ),
            'defs' => array(
                'font-family' => 'Muli',
                'font-size'   => '20px',
                'line-height' => '24px',
                'font-weight' => '700',
            ),
        ),
    );
    $headings_array = array();
    foreach ($headings as $key => $heading) {
        array_push($headings_array , array(
            'id' => $heading['id'],
            'type' => 'custom_typography',
            'title' => $heading['title'],
            'google' => true,
            'font-backup' => false,
            'font-size' => true,
            'line-height' => true,
            'color' => false,
            'word-spacing' => false,
            'letter-spacing' => true,
            'text-align' => false,
            'text-transform' => true,
            'default' => $heading['defs'],
        ));
    }

    // Typogrophy section
    Redux::setSection( $theme_slug, array(
        'title'      => esc_html__( 'Headings', 'integrio' ),
        'id'         => 'main_headings_typography',
        //'icon' => 'el-icon-font', // Icon for section 
        'subsection' => true,
        'fields'     => $headings_array
    ) );
    // End Typography config

	if ( class_exists( 'WooCommerce' ) )  {
        Redux::setSection( $theme_slug, array(
            'title'            => esc_html__('Shop', 'integrio' ),
            'id'               => 'shop-option',            
            'icon' => 'el-icon-shopping-cart',
            'fields'           => array(                                                        
            )
        ) );
        Redux::setSection( $theme_slug, array(
            'title'            => esc_html__( 'Catalog', 'integrio' ),
            'id'               => 'shop-catalog-option',
            'subsection'       => true,            
            'fields'           => array(
                array(
                    'id'       => 'shop_catalog_page_title_bg_image',
                    'type'     => 'background',
                    'preview'  => false,
                    'preview_media' => true,
                    'background-color' => false,
                    'title'    => esc_html__( 'Catalog Page Title Background Image', 'integrio' ),
                    'default'  => array(
                        'background-repeat'     => 'repeat',
                        'background-size'       => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position'   => 'center center',
                        'background-color'      => '#1e73be',
                    )
                ), 
                array(
                    'id'       => 'shop_catalog_sidebar_layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Shop Catalog Sidebar Layout', 'integrio' ),
                    'options'  => array(
                        'none' => array(
                            'alt' => 'None',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                        ),
                        'left' => array(
                            'alt' => 'Left',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                        ),
                        'right' => array(
                            'alt' => 'Right',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                        )
                    ),
                    'default'  => 'left'
                ),
                array(
                    'id'       => 'shop_catalog_sidebar_def',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Shop Catalog Sidebar', 'integrio' ),
                    'data'     => 'sidebars',
                    'required' => array( 'shop_catalog_sidebar_layout', '!=', 'none' ),
                ),  
                array(
                    'id'       => 'shop_catalog_sidebar_def_width',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Shop Sidebar Width', 'integrio' ),
                    'options'  => array(
                        '9' => '25%',
                        '8' => '33%',             
                    ),
                    'default'  => '9',
                    'required' => array( 'shop_catalog_sidebar_layout', '!=', 'none' ),
                ), 
                array(
                    'id'       => 'shop_sidebar_sticky',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Sticky Sidebar On?', 'integrio' ),
                    'default'  => false,
                    'required' => array( 'shop_catalog_sidebar_layout', '!=', 'none' ),
                ),         
                array(
                    'id'       => 'shop_sidebar_gap',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Sidebar Side Gap', 'integrio' ),
                    'options'  => array(
                        'def' => esc_html__( 'Default', 'integrio' ),
                        '0'  => '0',     
                        '15' => '15',     
                        '20' => '20',     
                        '25' => '25',     
                        '30' => '30',     
                        '35' => '35',     
                        '40' => '40',     
                        '45' => '45',     
                        '50' => '50',     
                    ),
                    'default'  => 'def',
                    'required' => array( 'shop_catalog_sidebar_layout', '!=', 'none' ),
                ),
                array(
                    'id'       => 'shop_layout',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Shop Layout', 'integrio' ),
                    'options'  => array(
                        'grid' => esc_html__( 'Grid', 'integrio' ),
                        'list' => esc_html__( 'List', 'integrio' ),
                    ),
                    'default'  => 'grid',
                ),
                array(
                    'id'       => 'shop_column',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Shop Column', 'integrio' ),
                    'options'  => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ),
                    'default'  => '3',
                    'required' => array( 'shop_layout', '=', 'grid' ),
                ),
	            array(
	                'id'      => 'added_to_cart_text',
	                'type'    => 'text',
	                'title'   => esc_html__( 'Product added to cart text', 'integrio' ),
	                'default' => esc_html__( 'Product was added to cart successfully', 'integrio' ),
	            ),   
                array(
                    'id'       => 'shop_products_per_page',
                    'type'     => 'spinner',
                    'title'    => esc_html__('Products per page', 'integrio'),
                    'default'  => '12',
                    'min'      => '1',
                    'step'     => '1',
                    'max'      => '100',
                ),  
                array(
                    'id'       => 'use_animation_shop',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Use Animation Shop?', 'integrio' ),
                    'default'  => true,
                ), 
                array(
                    'id'      => 'shop_catalog_animation_style',
                    'type'    => 'select',
                    'select2' => array('allowClear' => false),
                    'title'   => esc_html__( 'Animation Style', 'integrio' ),
                    'options' => array(
                        'fade-in'      => esc_html__( 'Fade In', 'integrio'),
                        'slide-top'    => esc_html__( 'Slide Top', 'integrio'),
                        'slide-bottom' => esc_html__( 'Slide Bottom', 'integrio'),
                        'slide-left'   => esc_html__( 'Slide Left', 'integrio'),
                        'slide-right'  => esc_html__( 'Slide Right', 'integrio'),
                        'zoom'         => esc_html__( 'Zoom', 'integrio'),
                    ),
                    'default'  => 'slide-left',
                    'required' => array( 'use_animation_shop', '=', true ),
                ),
            )
            
        ) );
		Redux::setSection( $theme_slug, array(
			'title'      => esc_html__( 'Single', 'integrio' ),
			'id'         => 'shop-single-option',
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'shop_single_post_title-start',
					'type'     => 'section',
					'title'    => esc_html__( 'Post Title Settings', 'integrio' ),
					'indent'   => true,
				),
				array(
					'id'      => 'shop_title_conditional',
					'type'    => 'switch',
					'title'   => esc_html__( 'Use Custom Post Title?', 'integrio' ),
					'default' => true,
				),
				array(
					'id'       => 'shop_single_page_title_text',
					'type'     => 'text',
					'title'    => esc_html__( 'Custom Post Title', 'integrio' ),
					'default'  => esc_html__( '', 'integrio' ),
					'required' => array( 'shop_title_conditional', '=', true ),
				),
				array(
					'id'      => 'shop_single_title_align',
					'type'    => 'button_set',
					'title'   => esc_html__( 'Title Alignment', 'integrio' ),
					'options' => array(
						'left'   => esc_html__( 'Left', 'integrio' ),
						'center' => esc_html__( 'Center', 'integrio' ),
						'right'  => esc_html__( 'Right', 'integrio' ),
					),
					'default' => 'left',
				),
				array(
					'id'      => 'shop_single_breadcrumbs_align',
					'type'    => 'button_set',
					'title'   => esc_html__( 'Title Breadcrumbs Alignment', 'integrio' ),
					'options' => array(
						'left'   => esc_html__( 'Left', 'integrio' ),
						'center' => esc_html__( 'Center', 'integrio' ),
						'right'  => esc_html__( 'Right', 'integrio' ),
					),
					'default' => 'left',
				),
				array(
					'id'      => 'shop_single_title_bg_switch',
					'type'    => 'switch',
					'title'   => esc_html__( 'Use Background?', 'integrio' ),
					'default' => true,
				),
				array(
					'id'      => 'shop_single_page_title_bg_image',
					'type'    => 'background',
					'title'   => esc_html__( 'Background', 'integrio' ),
					'preview' => false,
					'preview_media' => true,
					'background-color' => true,
					'transparent' => false,
					'default' => array(
						'background-repeat'     => 'repeat',
						'background-size'       => 'cover',
						'background-attachment' => 'scroll',
						'background-position'   => 'center center',
						'background-color'      => '#2d2d2d',
					),
					'required' => array( 'shop_single_title_bg_switch', '=', true ),
				),
				array(
					'id'      => 'shop_single_page_title_padding',
					'type'    => 'spacing',
					'title'   => esc_html__( 'Paddings Top/Bottom', 'integrio' ),
					'mode'    => 'padding',
					'all'     => false,
					'bottom'  => true,
					'top'     => true,
					'left'    => false,
					'right'   => false,
					'default' => array(
						'padding-top'    => '33',
						'padding-bottom' => '0',
					),
				),
				array(
					'id'      => 'shop_single_page_title_margin',
					'type'    => 'spacing',
					'title'   => esc_html__( 'Margin Bottom', 'integrio' ),
					'mode'    => 'margin',
					'all'     => false,
					'bottom'  => true,
					'top'     => false,
					'left'    => false,
					'right'   => false,
					'default' => array( 'margin-bottom' => '-7' ),
				),
				array(
					'id'      => 'shop_single_page_title_border_switch',
					'type'    => 'switch',
					'title'   => esc_html__( 'Enable Border Top?', 'integrio' ),
					'default' => false,
				),
				array(
					'id'       => 'shop_single_page_title_border_color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Border Top Color', 'integrio' ),
					'default'  => array(
						'color' => '#e5e5e5',
						'alpha' => '1',
                        'rgba'  => 'rgba(229,229,229,1)'
					),
					'required' => array( 'shop_single_page_title_border_switch', '=', true),
				),
				array(
					'id'     => 'shop_single_post_title-end',
					'type'   => 'section',
					'indent' => false,
				),
                array(
                    'id'      => 'shop_single_image_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Select Single Product Layout', 'integrio' ),
                    'options' => array( 
                        'default' => array(
                            'title' => esc_html__('Default', 'integrio'),
                            'alt' => 'Default',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                        ),
                        'sticky_layout' => array(
                            'title' => esc_html__('Sticky Image', 'integrio'),
                            'alt'   => '1',
                            'img'   => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                        ),
                        'image_gallery' => array(
                            'title' => esc_html__('Image Gallery', 'integrio'),
                            'alt'   => '2',
                            'img'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                        ),                        
                        'full_width_image_gallery' => array(
                            'title' => esc_html__('Full Width Image Gallery', 'integrio'),
                            'alt'   => '3',
                            'img'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                        ),                          
                        'with_background' => array(
                            'title' => esc_html__('With Background', 'integrio'),
                            'alt'   => '4',
                            'img'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                        ),                        
                    ),
                    'default'  => 'default'
                ), 
                array(
                    'id'       => 'shop_single_sidebar_layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Shop Single Sidebar Layout', 'integrio' ),
                    'options'  => array(
                        'none' => array(
                            'alt' => 'None',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
                        ),
                        'left' => array(
                            'alt' => 'Left',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
                        ),
                        'right' => array(
                            'alt' => 'Right',
                            'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
                        )
                    ),
                    'default'  => 'none',
                    'required' => array( array('shop_single_image_layout','!=','with_background'), array('shop_single_image_layout','!=','full_width_image_gallery') )
                ),
                array(
                    'id'       => 'shop_single_sidebar_def',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Shop Single Sidebar', 'integrio' ),
                    'data'     => 'sidebars',
                    'required' => array( 'shop_single_sidebar_layout', '!=', 'none' ),
                ),  
                array(
                    'id'       => 'shop_single_sidebar_def_width',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Shop Single Sidebar Width', 'integrio' ),
                    'options'  => array(
                        '9' => '25%',
                        '8' => '33%', 
                    ),
                    'default'  => '9',
                    'required' => array( 'shop_single_sidebar_layout', '!=', 'none' ),
                ),
                array(
                    'id'       => 'shop_single_sidebar_sticky',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Shop Single Sticky Sidebar On?', 'integrio' ),
                    'default'  => false,
                    'required' => array( 'shop_single_sidebar_layout', '!=', 'none' ),
                ),         
                array(
                    'id'      => 'shop_single_sidebar_gap',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Shop Single Sidebar Side Gap', 'integrio' ),
                    'options' => array(
                        'def' => esc_html__( 'Default', 'integrio' ),
                        '0'  => '0',     
                        '15' => '15',     
                        '20' => '20',     
                        '25' => '25',     
                        '30' => '30',     
                        '35' => '35',     
                        '40' => '40',     
                        '45' => '45',     
                        '50' => '50',     
                    ),
                    'default'  => 'def',
                    'required' => array( 'shop_single_sidebar_layout', '!=', 'none' ),
                ),
                array(
                    'id'       => 'shop_layout_with_background',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Background', 'integrio' ),
                    'default'  => array(
                        'color' => '#f3f3f3',
                        'alpha' => '1',
                        'rgba'  => 'rgba(243,243,243,1)'
                    ),
                    'mode'     => 'background',
                    'required' => array( 'shop_single_image_layout', '=', 'with_background' ),
                ),
                array(
                    'id'       => 'shop_single_share',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Share On/Off', 'integrio' ),
                    'default'  => false,
                ),
            )
            
        ) );        
        Redux::setSection( $theme_slug, array(
            'title'            => esc_html__( 'Related', 'integrio' ),
            'id'               => 'shop-related-option',
            'subsection'       => true,            
            'fields'           => array(
                array(
                    'id'       => 'shop_related_columns',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Related products column', 'integrio' ),
                    'options'  => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ),
                    'default'  => '4',
                ),              
                array(
                    'id'       => 'shop_r_products_per_page',
                    'type'     => 'spinner',
                    'title'    => esc_html__('Related products per page', 'integrio'),
                    'default'  => '4',
                    'min'      => '1',
                    'step'     => '1',
                    'max'      => '100',
                ),
            )
            
        ) );        
        Redux::setSection( $theme_slug, array(
            'title'            => esc_html__( 'Cart', 'integrio' ),
            'id'               => 'shop-cart-option',
            'subsection'       => true,            
            'fields'           => array(
                array(
                    'id'       => 'shop_cart_page_title_bg_image',
                    'type'     => 'background',
                    'background-color' => false,
                    'preview_media' => true,
                    'preview' => false,
                    'title'    => esc_html__( 'Cart Page Title Background Image', 'integrio' ),
                    'default'  => array(
                        'background-repeat' => 'repeat',
                        'background-size' => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position' => 'center center',
                        'background-color' => '#2d2d2d',
                    )
                ), 
            )
            
        ) );        
        Redux::setSection( $theme_slug, array(
            'title'            => esc_html__( 'Checkout', 'integrio' ),
            'id'               => 'shop-checkout-option',
            'subsection'       => true,            
            'fields'           => array(
                array(
                    'id'       => 'shop_checkout_page_title_bg_image',
                    'type'     => 'background',
                    'background-color' => false,
                    'preview_media' => true,
                    'preview' => false,
                    'title'    => esc_html__( 'Checkout Page Title Background Image', 'integrio' ),
                    'default'  => array(
                        'background-repeat' => 'repeat',
                        'background-size' => 'cover',
                        'background-attachment' => 'scroll',
                        'background-position' => 'center center',
                        'background-color' => '#2d2d2d',
                    )
                ),  
            )
            
        ) );
    }
