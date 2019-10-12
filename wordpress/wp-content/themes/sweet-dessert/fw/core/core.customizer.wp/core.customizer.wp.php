<?php
/**
 * Theme colors and fonts customization via WP Customizer
 */

/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'sweet_dessert_core_customizer_wp_theme_setup' ) ) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_core_customizer_wp_theme_setup' );
	function sweet_dessert_core_customizer_wp_theme_setup() {
		if (is_customize_preview() && !is_admin())
			add_action( 'wp_loaded', 						'sweet_dessert_customizer_wp_load_mods' );

		add_action( 'customize_register',					'sweet_dessert_customizer_wp_custom_controls' );
		add_action( 'customize_register', 					'sweet_dessert_customizer_wp_register_controls', 11 );
		add_action( 'customize_save_after',					'sweet_dessert_customizer_wp_action_save_after' );
		add_action( 'customize_controls_enqueue_scripts',	'sweet_dessert_customizer_wp_control_js' );
		add_action( 'customize_preview_init',				'sweet_dessert_customizer_wp_preview_js' );
	}
}

//--------------------------------------------------------------
//-- Register Customizer Controls
//--------------------------------------------------------------

define('CUSTOMIZE_PRIORITY', 200);		// Start priority for the new controls

if (!function_exists('sweet_dessert_customizer_wp_register_controls')) {
	function sweet_dessert_customizer_wp_register_controls( $wp_customize ) {

		// Setup standard WP Controls
		// ---------------------------------
		
		// Remove unused sections
		$wp_customize->remove_section( 'colors');
		$wp_customize->remove_section( 'static_front_page');

		// Reorder standard WP sections
		$sec = $wp_customize->get_panel( 'nav_menus' );
		if (is_object($sec)) $sec->priority = 30;
		$sec = $wp_customize->get_panel( 'widgets' );
		if (is_object($sec)) $sec->priority = 40;
		$sec = $wp_customize->get_section( 'title_tagline' );
		if (is_object($sec)) $sec->priority = 50;
		$sec = $wp_customize->get_section( 'background_image' );
		if (is_object($sec)) $sec->priority = 60;
		$sec = $wp_customize->get_section( 'header_image' );
		if (is_object($sec)) $sec->priority = 70;
		
		// Modify standard WP controls
		$sec = $wp_customize->get_setting( 'blogname' );
		if (is_object($sec)) $sec->transport = 'postMessage';

		$sec = $wp_customize->get_setting( 'blogdescription' );
		if (is_object($sec)) $sec->transport = 'postMessage';
		
		$sec = $wp_customize->get_section( 'background_image' );
		if (is_object($sec)) {
			$sec->title = esc_html__('Background', 'sweet-dessert');
			$sec->description = esc_html__('Used only if "Content - Body style" equal to "boxed"', 'sweet-dessert');
		}
		
		// Move standard option 'Background Color' to the section 'Background Image'
		$wp_customize->add_setting( 'background_color', array(
			'default'        => get_theme_support( 'custom-background', 'default-color' ),
			'theme_supports' => 'custom-background',
			'transport'		 => 'postMessage',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
			'label'   => esc_html__( 'Background color', 'sweet-dessert' ),
			'section' => 'background_image',
		) ) );


		// Add Theme specific controls
		// ---------------------------------
		
		// Custom colors
		$scheme = sweet_dessert_get_custom_option('body_scheme');
		if (empty($scheme) || sweet_dessert_storage_empty('custom_colors', $scheme)) $scheme = 'original';

		$options = array(
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('Color scheme', 'sweet-dessert'),
				"desc" => wp_kses_data( __("<b>Simple settings</b> - you can change only accented color, used for links, buttons and some accented areas.", 'sweet-dessert') )
						. '<br>'
						. wp_kses_data( __("<b>Advanced settings</b> - change all scheme's colors and get full control over the appearance of your site!", 'sweet-dessert') ),
				"priority" => 80,
				"type" => "section"
				),
		
			'color_settings' => array(
				"title" => esc_html__('Color settings', 'sweet-dessert'),
				"desc" => '',
				"val" => 'simple',
				"options" => array(
					"simple"  => esc_html__("Simple", 'sweet-dessert'),
					"advanced" => esc_html__("Advanced", 'sweet-dessert')
					),
				"refresh" => false,
				"type" => "switch"
				),
		
			'color_scheme' => array(
				"title" => esc_html__('Color Scheme', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site at once', 'sweet-dessert') ),
				"val" => $scheme,
				"options" => sweet_dessert_get_list_color_schemes(),
				"refresh" => false,
				"type" => "select"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Colors storage', 'sweet-dessert'),
				"desc" => esc_html__('Hidden storage of the all color from the all color shemes (only for internal usage)', 'sweet-dessert'),
				"val" => '',
				"refresh" => false,
				"type" => "hidden"
				),
		
			'scheme_info_main' => array(
				"title" => esc_html__('Colors for the main content', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Specify colors for the main content (not for alter blocks)', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
				
			'bg_color' => array(
				"title" => esc_html__('Background color', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Background color of the whole page', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'bg_color'),
				"refresh" => false,
				"type" => "color"
				),
			'bd_color' => array(
				"title" => esc_html__('Border color', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the bordered elements, separators, etc.', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'bd_color'),
				"refresh" => false,
				"type" => "color"
				),
		
			'text' => array(
				"title" => esc_html__('Text', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Plain text color on single page/post', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'text'),
				"refresh" => false,
				"type" => "color"
				),
			'text_light' => array(
				"title" => esc_html__('Light text', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the post meta: post date and author, comments number, etc.', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'text_light'),
				"refresh" => false,
				"type" => "color"
				),
			'text_dark' => array(
				"title" => esc_html__('Dark text', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the headers, strong text, etc.', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'text_dark'),
				"refresh" => false,
				"type" => "color"
				),
			'text_link' => array(
				"title" => esc_html__('Links', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of links and accented areas', 'sweet-dessert') ),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'text_link'),
				"refresh" => false,
				"type" => "color"
				),
			'text_hover' => array(
				"title" => esc_html__('Links hover', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Hover color for links and accented areas', 'sweet-dessert') ),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'text_hover'),
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_alter' => array(
				"title" => esc_html__('Colors for alternative blocks', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Specify colors for alternative blocks - rectangular blocks with its own background color (posts in homepage, blog archive, search results, widgets on sidebar, footer, etc.)', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'alter_bg_color' => array(
				"title" => esc_html__('Alter background color', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Background color of the alternative blocks', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'alter_bg_color'),
				"refresh" => false,
				"type" => "color"
				),
			'alter_bg_hover' => array(
				"title" => esc_html__('Alter hovered background color', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Background color for the hovered state of the alternative blocks', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'alter_bg_hover'),
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_color' => array(
				"title" => esc_html__('Alternative border color', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Border color of the alternative blocks', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'alter_bd_color'),
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_hover' => array(
				"title" => esc_html__('Alternative hovered border color', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Border color for the hovered state of the alter blocks', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'alter_bd_hover'),
				"refresh" => false,
				"type" => "color"
				),
			'alter_text' => array(
				"title" => esc_html__('Alter text', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Text color of the alternative blocks', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'alter_text'),
				"refresh" => false,
				"type" => "color"
				),
			'alter_light' => array(
				"title" => esc_html__('Alter light', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with alternative background', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'alter_light'),
				"refresh" => false,
				"type" => "color"
				),
			'alter_dark' => array(
				"title" => esc_html__('Alter dark', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the headers inside block with alternative background', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'alter_dark'),
				"refresh" => false,
				"type" => "color"
				),
			'alter_link' => array(
				"title" => esc_html__('Alter link', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the links inside block with alternative background', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'alter_link'),
				"refresh" => false,
				"type" => "color"
				),
			'alter_hover' => array(
				"title" => esc_html__('Alter hover', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with alternative background', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'alter_hover'),
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_input' => array(
				"title" => esc_html__('Colors for the form fields', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Specify colors for the form fields and textareas', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'input_bg_color' => array(
				"title" => esc_html__('Inactive background', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Background color of the inactive form fields', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'input_bg_color'),
				"refresh" => false,
				"type" => "color"
				),
			'input_bg_hover' => array(
				"title" => esc_html__('Active background', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Background color of the focused form fields', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'input_bg_hover'),
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_color' => array(
				"title" => esc_html__('Inactive border', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the border in the inactive form fields', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'input_bd_color'),
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_hover' => array(
				"title" => esc_html__('Active border', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the border in the focused form fields', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'input_bd_hover'),
				"refresh" => false,
				"type" => "color"
				),
			'input_text' => array(
				"title" => esc_html__('Inactive field', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the text in the inactive fields', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'input_text'),
				"refresh" => false,
				"type" => "color"
				),
			'input_light' => array(
				"title" => esc_html__('Disabled field', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the disabled field', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'input_light'),
				"refresh" => false,
				"type" => "color"
				),
			'input_dark' => array(
				"title" => esc_html__('Active field', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the active field', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'input_dark'),
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_inverse' => array(
				"title" => esc_html__('Colors for inverse blocks', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Specify colors for inverse blocks, rectangular blocks with background color equal to the links color or one of accented colors (if used in the current theme)', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'inverse_text' => array(
				"title" => esc_html__('Inverse text', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the text inside block with accented background', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'inverse_text'),
				"refresh" => false,
				"type" => "color"
				),
			'inverse_light' => array(
				"title" => esc_html__('Inverse light', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with accented background', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'inverse_light'),
				"refresh" => false,
				"type" => "color"
				),
			'inverse_dark' => array(
				"title" => esc_html__('Inverse dark', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the headers inside block with accented background', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'inverse_dark'),
				"refresh" => false,
				"type" => "color"
				),
			'inverse_link' => array(
				"title" => esc_html__('Inverse link', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the links inside block with accented background', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'inverse_link'),
				"refresh" => false,
				"type" => "color"
				),
			'inverse_hover' => array(
				"title" => esc_html__('Inverse hover', 'sweet-dessert'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with accented background', 'sweet-dessert') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"val" => sweet_dessert_storage_get_array('custom_colors', $scheme, 'inverse_hover'),
				"refresh" => false,
				"type" => "color"
				)
		);

		// Custom fonts
		$fonts = sweet_dessert_storage_get('custom_fonts');
		if (is_array($fonts) && count($fonts) > 0) {
			$list_fonts = sweet_dessert_get_list_fonts(true);
			$list_fonts_names = array();
			if (is_array($list_fonts) && count($list_fonts) > 0) {
				foreach ($list_fonts as $k=>$v)
					$list_fonts_names[$k] = $k;
			}
			$list_styles = sweet_dessert_get_list_fonts_styles(true);
			$list_weight = array(
				'inherit' => esc_html__("Inherit", 'sweet-dessert'), 
				'100' => esc_html__('100 (Light)', 'sweet-dessert'), 
				'300' => esc_html__('300 (Thin)',  'sweet-dessert'),
				'400' => esc_html__('400 (Normal)', 'sweet-dessert'),
				'500' => esc_html__('500 (Semibold)', 'sweet-dessert'),
				'600' => esc_html__('600 (Semibold)', 'sweet-dessert'),
				'700' => esc_html__('700 (Bold)', 'sweet-dessert'),
				'900' => esc_html__('900 (Black)', 'sweet-dessert')
			);
			// Section 'Fonts' - settings for the headers, plain text, logo, menu, etc.
			$options['fonts'] = array(
				"title" => esc_html__('Fonts', 'sweet-dessert'),
				"desc" => wp_kses_data( __("Font settings for the headers, plain text, logo, menu, etc.", 'sweet-dessert') ),
				"priority" => 90,
				"type" => "panel"
				);
			foreach ($fonts as $slug=>$font) {
				$options["{$slug}-font-info"] = array(
					"title" => isset($font['title']) ? $font['title'] : sweet_dessert_strtoproper($slug),
					"desc" => wp_kses_data( sprintf(__('Select font-family, size and style for %s', 'sweet-dessert'), isset($font['title']) ? $font['title'] : sweet_dessert_strtoproper($slug)) ),
					"type" => "section"
				);
				if (isset($font['font-family'])) {
					$options["{$slug}-font-family"] = array(
						"title" => isset($font['title']) ? $font['title'] : sweet_dessert_strtoproper($slug),
						"desc" => isset($font['description']) ? $font['description'] : '',
						"val" => $font['font-family'] ? $font['font-family'] : 'inherit',
						"options" => $list_fonts_names,
						"refresh" => false,
						"type" => "select");
				}
				if (isset($font['font-size'])) {
					$options["{$slug}-font-size"] = array(
						"title" => esc_html__('Size', 'sweet-dessert'),
						"desc" => '',
						"val" => sweet_dessert_is_inherit_option($font['font-size']) ? '' : $font['font-size'],
						"refresh" => false,
						"type" => "text");
				}
				if (isset($font['line-height'])) {
					$options["{$slug}-line-height"] = array(
						"title" => esc_html__('Line height', 'sweet-dessert'),
						"desc" => '',
						"val" => sweet_dessert_is_inherit_option($font['line-height']) ? '' : $font['line-height'],
						"refresh" => false,
						"type" => "text");
				}
				if (isset($font['font-weight'])) {
					$options["{$slug}-font-weight"] = array(
						"title" => esc_html__('Weight', 'sweet-dessert'),
						"desc" => '',
						"val" => $font['font-weight'] ? $font['font-weight'] : 'inherit',
						"options" => $list_weight,
						"refresh" => false,
						"type" => "select");
				}
				if (isset($font['font-style'])) {
					$options["{$slug}-font-style"] = array(
						"title" => esc_html__('Style', 'sweet-dessert'),
						"desc" => '',
						"val" => $font['font-style'] ? $font['font-style'] : 'inherit',
						"options" => $list_styles,
						"refresh" => false,
						"type" => "select");
				}
				if (isset($font['margin-top'])) {
					$options["{$slug}-margin-top"] = array(
						"title" => esc_html__('Margin Top', 'sweet-dessert'),
						"desc" => '',
						"val" => sweet_dessert_is_inherit_option($font['margin-top']) ? '' : $font['margin-top'],
						"refresh" => false,
						"type" => "text");
				}
				if (isset($font['margin-bottom'])) {
					$options["{$slug}-margin-bottom"] = array(
						"title" => esc_html__('Margin Bottom', 'sweet-dessert'),
						"desc" => '',
						"val" => sweet_dessert_is_inherit_option($font['margin-bottom']) ? '' : $font['margin-bottom'],
						"refresh" => false,
						"type" => "text");
				}
				$options["{$slug}-font-info-end"] = array(
					"type" => "section_end"
				);
			}
			$options['fonts_end'] = array(
				"type" => "panel_end"
				);
		}

		$panels = array('');
		$p = 0;
		$sections = array('');
		$s = 0;
		$i = 0;
		$depends = array();

		foreach ($options as $id=>$opt) {
			
			$i++;

			if (isset($opt['dependency'])) 
				$depends[$id] = $opt['dependency'];
			
			if (!empty($opt['hidden'])) continue;

			if ($opt['type'] == 'panel') {

				$sec = $wp_customize->get_panel( $id );
				if ( is_object($sec) && !empty($sec->title) ) {
					$sec->title      = $opt['title'];
					$sec->description= $opt['desc'];
					if ( !empty($opt['priority']) )	$sec->priority = $opt['priority'];
				} else {
					$wp_customize->add_panel( esc_attr($id) , array(
						'title'      => $opt['title'],
						'description'=> $opt['desc'],
						'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i
					) );
				}
				array_push($panels, $id);
				$p++;

			} else if ($opt['type'] == 'panel_end') {

				array_pop($panels);
				$p--;

			} else if ($opt['type'] == 'section') {

				$sec = $wp_customize->get_section( $id );
				if ( is_object($sec) && !empty($sec->title) ) {
					$sec->title      = $opt['title'];
					$sec->description= $opt['desc'];
					if ( !empty($opt['priority']) )	$sec->priority = $opt['priority'];
				} else {
					$wp_customize->add_section( esc_attr($id) , array(
						'title'      => $opt['title'],
						'description'=> $opt['desc'],
						'panel'  => esc_attr($panels[$p]),
						'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i
					) );
				}
				array_push($sections, $id);
				$s++;

			} else if ($opt['type'] == 'section_end') {

				array_pop($sections);
				$s--;

			} else if ($opt['type'] == 'select') {

				$wp_customize->add_setting( $id, array(
					'default'           => $opt['val'],
					'sanitize_callback' => 'sweet_dessert_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'select',
					'choices'  => $opt['options']
				) );

			} else if ($opt['type'] == 'radio') {

				$wp_customize->add_setting( $id, array(
					'default'           => $opt['val'],
					'sanitize_callback' => 'sweet_dessert_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'radio',
					'choices'  => $opt['options']
				) );

			} else if ($opt['type'] == 'switch') {

				$wp_customize->add_setting( $id, array(
					'default'           => $opt['val'],
					'sanitize_callback' => 'sweet_dessert_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new Sweet_Dessert_Customize_Switch_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'choices'  => $opt['options']
				) ) );

			} else if ($opt['type'] == 'checkbox') {

				$wp_customize->add_setting( $id, array(
					'default'           => $opt['val'],
					'sanitize_callback' => 'sweet_dessert_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'checkbox'
				) );

			} else if ($opt['type'] == 'color') {

				$wp_customize->add_setting( $id, array(
					'default'           => $opt['val'],
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'image') {

				$wp_customize->add_setting( $id, array(
					'default'           => $opt['val'],
					'sanitize_callback' => 'sweet_dessert_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'info') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => '',
					'sanitize_callback' => 'sweet_dessert_sanitize_value',
					'transport'         => 'postMessage'
				) );

				$wp_customize->add_control( new Sweet_Dessert_Customize_Info_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'hidden') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => $opt['val'],
					'sanitize_callback' => 'sweet_dessert_sanitize_html',
					'transport'         => 'postMessage'
				) );

				$wp_customize->add_control( new Sweet_Dessert_Customize_Hidden_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else {

				$wp_customize->add_setting( $id, array(
					'default'           => $opt['val'],
					'sanitize_callback' => 'sweet_dessert_sanitize_html',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => $opt['type']
				) );
			}

		}

		// Store dependencies for JS
		sweet_dessert_storage_set('customizer_depends', $depends);
	}
}


// Create custom controls for customizer
if (!function_exists('sweet_dessert_customizer_wp_custom_controls')) {
	function sweet_dessert_customizer_wp_custom_controls( $wp_customize ) {
	
		class Sweet_Dessert_Customize_Info_Control extends WP_Customize_Control {
			public $type = 'info';

			public function render_content() {
				?>
				<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="customize-control-description desctiption"><?php echo esc_html( $this->description ); ?></span>
				</label>
				<?php
			}
		}
	
		class Sweet_Dessert_Customize_Switch_Control extends WP_Customize_Control {
			public $type = 'switch';

			public function render_content() {
				?>
				<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="customize-control-description desctiption"><?php echo esc_html( $this->description ); ?></span>
				<?php
				if (is_array($this->choices) && count($this->choices)>0) {
					foreach ($this->choices as $k=>$v) {
						?><label><input type="radio" name="_customize-radio-<?php echo esc_attr($this->id); ?>" <?php $this->link(); ?> value="<?php echo esc_attr($k); ?>">
						<?php echo esc_html($v); ?></label><?php
					}
				}
				?>
				</label>
				<?php
			}
		}
	
		class Sweet_Dessert_Customize_Hidden_Control extends WP_Customize_Control {
			public $type = 'hidden';

			public function render_content() {
				?>
				<input type="hidden" name="_customize-hidden-<?php echo esc_attr($this->id); ?>" <?php $this->link(); ?> value="">
				<?php
			}
		}
	
	}
}


// Sanitize plain value
if (!function_exists('sweet_dessert_sanitize_value')) {
	function sweet_dessert_sanitize_value($value) {
		return empty($value) ? $value : trim(strip_tags($value));
	}
}


// Sanitize html value
if (!function_exists('sweet_dessert_sanitize_html')) {
	function sweet_dessert_sanitize_html($value) {
		return empty($value) ? $value : wp_kses_data($value);
	}
}


//--------------------------------------------------------------
// Step 2: Load current theme customization mods
//--------------------------------------------------------------
if (!function_exists('sweet_dessert_customizer_wp_load_mods')) {
	function sweet_dessert_customizer_wp_load_mods() {

		// Store new schemes colors
		$scheme_chg = false;
		$schemes = sweet_dessert_storage_get('custom_colors');
		$storage = get_theme_mod('scheme_storage', '');
		if (sweet_dessert_substr($storage, 0, 2)=='a:') {
			$storage = sweet_dessert_unserialize($storage);
			if (is_array($schemes) && count($schemes) > 0)  {
				foreach ($schemes as $k=>$v) {
					if (is_array($v)) {
						foreach ($v as $k1=>$v1) {
							if (isset($storage[$k][$k1])) {
								$scheme_chg = $scheme_chg || $v1!=$storage[$k][$k1];
								$schemes[$k][$k1] = $storage[$k][$k1];
						}
				}
					} else if (isset($storage[$k])) {
						$scheme_chg = $scheme_chg || $v!=$storage[$k];
						$schemes[$k] = $storage[$k];
					}
				}
				if ($scheme_chg) sweet_dessert_storage_set('custom_colors', $schemes);
			}
		}
		// Refresh array with fonts from POST data
		$fonts_chg = false;
		$fonts = sweet_dessert_storage_get('custom_fonts');
		if (is_array($fonts) && count($fonts) > 0) {
			foreach ($fonts as $slug=>$font) {
				if (is_array($font) && count($font) > 0) {
					foreach ($font as $key=>$value) {
						$val = get_theme_mod($slug.'-'.$key, $fonts[$slug][$key]);
						$fonts_chg = $fonts_chg || $fonts[$slug][$key] != $val;
						$fonts[$slug][$key] = sweet_dessert_is_inherit_option($val) ? '' : $val;
					}
				}
			}
			if ($fonts_chg) sweet_dessert_storage_set('custom_fonts', $fonts);
		}
		// Touch theme.less to recompile it with new fonts and colors
		if ( $scheme_chg || $fonts_chg ) {
			if (!empty($_COOKIE[sweet_dessert_storage_get('options_prefix').'_compile_less']) ) {
				// Delete cookie "compile_less"
				setcookie(sweet_dessert_storage_get('options_prefix').'_compile_less', '', time()-3600*24, '/');
				// Set option to restore less 
				update_option(sweet_dessert_storage_get('options_prefix') . '_compile_less', 1);
				// Touch theme.less
				touch(sweet_dessert_get_file_dir('css/theme.less'));
			}
		}
	}
}


//--------------------------------------------------------------
// Save custom settings in CSS file
//--------------------------------------------------------------

// Save CSS with custom colors and fonts after save custom options
if (!function_exists('sweet_dessert_customizer_wp_action_save_after')) {
	function sweet_dessert_customizer_wp_action_save_after($api=false) {
		$settings = $api->settings();

		// Store new schemes colors
		$scheme_chg = false;
		$schemes = sweet_dessert_storage_get('custom_colors');
		$storage = $settings['scheme_storage']->value();
		if (sweet_dessert_substr($storage, 0, 2)=='a:') {
			$storage = sweet_dessert_unserialize($storage);
			if (is_array($schemes) && count($schemes) > 0)  {
				foreach ($schemes as $k=>$v) {
					if (is_array($v)) {
						foreach ($v as $k1=>$v1) {
							if (isset($storage[$k][$k1])) {
								$scheme_chg = $scheme_chg || $v1!=$storage[$k][$k1];
								$schemes[$k][$k1]=$storage[$k][$k1];
							}
						}
					} else if (isset($storage[$k])) {
						$scheme_chg = $scheme_chg || $v!=$storage[$k];
						$schemes[$k] = $storage[$k];
						}
				}
				if ($scheme_chg) {
					$schemes = apply_filters('sweet_dessert_filter_save_custom_colors', $schemes);
					sweet_dessert_storage_set('custom_colors', $schemes);
					update_option( sweet_dessert_storage_get('options_prefix') . '_options_custom_colors', $schemes);
				}
			}
		}

		// Refresh array with fonts from POST data
		$fonts_chg = false;
		$fonts = sweet_dessert_storage_get('custom_fonts');
		if (is_array($fonts) && count($fonts) > 0) {
			foreach ($fonts as $slug=>$font) {
				if (is_array($font) && count($font) > 0) {
					foreach ($font as $key=>$value) {
						if (isset($settings[$slug.'-'.$key])) {
							$val = $settings[$slug.'-'.$key]->value();
							$fonts_chg = $fonts_chg || $fonts[$slug][$key] != $val;
							$fonts[$slug][$key] = sweet_dessert_is_inherit_option($val) ? '' : $val;
						}
					}
				}
			}
			if ($fonts_chg) {
				$fonts = apply_filters('sweet_dessert_filter_save_custom_fonts', $fonts);
				sweet_dessert_storage_set('custom_fonts', $fonts);
				update_option( sweet_dessert_storage_get('options_prefix') . '_options_custom_fonts', $fonts);
			}
		}
		
		// Save theme.css with new fonts and colors
		if ($scheme_chg || $fonts_chg) {
			if (sweet_dessert_get_theme_setting('less_compiler')=='no') {
				// Save custom css
				sweet_dessert_fpc( sweet_dessert_get_file_dir('css/theme.css'), sweet_dessert_get_custom_css());
			} else {
				// Recompile theme.less
				do_action('sweet_dessert_action_compile_less');
			}
		}
	}
}


//--------------------------------------------------------------
// Customizer JS and CSS
//--------------------------------------------------------------

// Binds JS listener to make Customizer color_scheme control.
// Passes color scheme data as color_scheme global.
if ( !function_exists( 'sweet_dessert_customizer_wp_control_js' ) ) {
	function sweet_dessert_customizer_wp_control_js() {
		wp_enqueue_style( 'sweet-dessert-customizer-wp', sweet_dessert_get_file_url('core/core.customizer.wp/core.customizer.wp.css') );
		wp_enqueue_script( 'sweet-dessert-customizer-wp-color-scheme-control', sweet_dessert_get_file_url('core/core.customizer.wp/core.customizer.wp.color-scheme.js'), array( 'customize-controls', 'iris', 'underscore', 'wp-util' ) );
		wp_localize_script( 'sweet-dessert-customizer-wp-color-scheme-control', 'sweet_dessert_color_schemes', sweet_dessert_storage_get('custom_colors') );
		wp_localize_script( 'sweet-dessert-customizer-wp-color-scheme-control', 'sweet_dessert_fonts', sweet_dessert_storage_get('custom_fonts') );
		wp_localize_script( 'sweet-dessert-customizer-wp-color-scheme-control', 'sweet_dessert_dependencies', sweet_dessert_storage_get('customizer_depends') );
		wp_localize_script( 'sweet-dessert-customizer-wp-color-scheme-control', 'sweet_dessert_customizer_vars', array(
			'need_refresh' => sweet_dessert_get_theme_setting('less_compiler')!='no',
			'msg_refresh' => esc_html__('Refresh', 'sweet-dessert')
		) );
	}
}

// Binds JS handlers to make the Customizer preview reload changes asynchronously.
if ( !function_exists( 'sweet_dessert_customizer_wp_preview_js' ) ) {
	function sweet_dessert_customizer_wp_preview_js() {
		wp_enqueue_script( 'sweet-dessert-customizer-wp-preview', sweet_dessert_get_file_url('core/core.customizer.wp/core.customizer.wp.preview.js'), array( 'customize-preview' ) );
		wp_localize_script( 'sweet-dessert-customizer-wp-preview', 'sweet_dessert_previewer_vars', array(
			'need_refresh' => sweet_dessert_get_theme_setting('less_compiler')!='no',
			'options_prefix' => sweet_dessert_storage_get('options_prefix')
		) );
	}
}
?>