<?php
/**
 * Theme custom styles
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if (!function_exists('sweet_dessert_action_theme_styles_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_action_theme_styles_theme_setup', 1 );
	function sweet_dessert_action_theme_styles_theme_setup() {
	
		// Add theme fonts in the used fonts list
		add_filter('sweet_dessert_filter_used_fonts',			'sweet_dessert_filter_theme_styles_used_fonts');
		// Add theme fonts (from Google fonts) in the main fonts list (if not present).
		add_filter('sweet_dessert_filter_list_fonts',			'sweet_dessert_filter_theme_styles_list_fonts');

		// Add theme stylesheets
		add_action('sweet_dessert_action_add_styles',			'sweet_dessert_action_theme_styles_add_styles');
		// Add theme inline styles
		add_filter('sweet_dessert_filter_add_styles_inline',		'sweet_dessert_filter_theme_styles_add_styles_inline');

		// Add theme scripts
		add_action('sweet_dessert_action_add_scripts',			'sweet_dessert_action_theme_styles_add_scripts');
		// Add theme scripts inline
		add_filter('sweet_dessert_filter_localize_script',		'sweet_dessert_filter_theme_styles_localize_script');

		// Add theme less files into list for compilation
		add_filter('sweet_dessert_filter_compile_less',			'sweet_dessert_filter_theme_styles_compile_less');


		// Add color schemes
		sweet_dessert_add_color_scheme('original', array(

			'title'					=> esc_html__('Original', 'sweet-dessert'),
			
			// Whole block border and background
			'bd_color'				=> '#f7eeec',       //
			'bg_color'				=> '#ffffff',       //
			
			// Headers, text and links colors
			'text'					=> '#777777',       //
			'text_light'			=> '#ababab',       //
			'text_dark'				=> '#574c44',       //
			'text_link'				=> '#fe6787',       //
			'text_hover'			=> '#ea5171',       //

			// Inverse colors
			'inverse_text'			=> '#ffffff',       //
			'inverse_light'			=> '#e5e5e5',       //
			'inverse_dark'			=> '#2f2e2e',       //
			'inverse_link'			=> '#878382',       //
			'inverse_hover'			=> '#3e3735',       //
		
			// Input fields
			'input_text'			=> '#000000',       //
			'input_light'			=> '#494644',       //
			'input_dark'			=> '#5e524f',       //
			'input_bd_color'		=> '#f9f6f3',       //
			'input_bd_hover'		=> '#3f3531',       //
			'input_bg_color'		=> '#292321',       //
			'input_bg_hover'		=> '#f0f0f0',
		
			// Alternative blocks (submenu items, etc.)
			'alter_text'			=> '#a9a9a9',       //
			'alter_light'			=> '#acacab',       //
			'alter_dark'			=> '#412a25',       //
			'alter_link'			=> '#36383d',       //
			'alter_hover'			=> '#342e2c',       //
			'alter_bd_color'		=> '#8c8c8a',       //
			'alter_bd_hover'		=> '#bbbbbb',
			'alter_bg_color'		=> '#f7f7f7',
			'alter_bg_hover'		=> '#f0f0f0',
			)
		);

		// Add Custom fonts
		sweet_dessert_add_custom_font('h1', array(
			'title'			=> esc_html__('Heading 1', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> 'Amatic SC',
			'font-size' 	=> '7.143em',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1em',
			'margin-top'	=> '1.63em',
			'margin-bottom'	=> '0.5em'
			)
		);
		sweet_dessert_add_custom_font('h2', array(
			'title'			=> esc_html__('Heading 2', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> 'Amatic SC',
			'font-size' 	=> '4.286em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1em',
			'margin-top'	=> '1.66em',
			'margin-bottom'	=> '1.266em'
			)
		);
		sweet_dessert_add_custom_font('h3', array(
			'title'			=> esc_html__('Heading 3', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> 'Amatic SC',
			'font-size' 	=> '3.429em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1em',
			'margin-top'	=> '1.8em',
			'margin-bottom'	=> '0.56em'
			)
		);
		sweet_dessert_add_custom_font('h4', array(
			'title'			=> esc_html__('Heading 4', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> 'Amatic SC',
			'font-size' 	=> '2.571em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.1em',
			'margin-top'	=> '2em',
			'margin-bottom'	=> '0.58em'
			)
		);
		sweet_dessert_add_custom_font('h5', array(
			'title'			=> esc_html__('Heading 5', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> 'Amatic SC',
			'font-size' 	=> '2.143em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1.2em',
			'margin-top'	=> '2.8em',
			'margin-bottom'	=> '0.87em'
			)
		);
		sweet_dessert_add_custom_font('h6', array(
			'title'			=> esc_html__('Heading 6', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> 'Amatic SC',
			'font-size' 	=> '1.786em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1em',
			'margin-top'	=> '2.68em',
			'margin-bottom'	=> '0.6em'
			)
		);
		sweet_dessert_add_custom_font('p', array(
			'title'			=> esc_html__('Text', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> 'Poppins',
			'font-size' 	=> '14px',
			'font-weight'	=> '400',
			'font-style'	=> '',
			'line-height'	=> '1.75em',
			'margin-top'	=> '',
			'margin-bottom'	=> '1em'
			)
		);
		sweet_dessert_add_custom_font('link', array(
			'title'			=> esc_html__('Links', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> ''
			)
		);
		sweet_dessert_add_custom_font('info', array(
			'title'			=> esc_html__('Post info', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> 'Poppins',
			'font-size' 	=> '0.857em',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '1.2857em',
			'margin-top'	=> '',
			'margin-bottom'	=> '2.1em'
			)
		);
		sweet_dessert_add_custom_font('menu', array(
			'title'			=> esc_html__('Main menu items', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> 'Poppins',
			'font-size' 	=> '1.286em',
			'font-weight'	=> '600',
			'font-style'	=> '',
			'line-height'	=> '1.2857em',
			'margin-top'	=> '1.8em',
			'margin-bottom'	=> '1.8em'
			)
		);
		sweet_dessert_add_custom_font('submenu', array(
			'title'			=> esc_html__('Dropdown menu items', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> 'Poppins',
			'font-size' 	=> '1em',
			'font-weight'	=> '500',
			'font-style'	=> '',
			'line-height'	=> '1.2857em',
			'margin-top'	=> '',
			'margin-bottom'	=> ''
			)
		);
		sweet_dessert_add_custom_font('logo', array(
			'title'			=> esc_html__('Logo', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '2.8571em',
			'font-weight'	=> '700',
			'font-style'	=> '',
			'line-height'	=> '1em',
			'margin-top'	=> '2.5em',
			'margin-bottom'	=> '1.7em'
			)
		);
		sweet_dessert_add_custom_font('button', array(
			'title'			=> esc_html__('Buttons', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '1.2857em'
			)
		);
		sweet_dessert_add_custom_font('input', array(
			'title'			=> esc_html__('Input fields', 'sweet-dessert'),
			'description'	=> '',
			'font-family'	=> '',
			'font-size' 	=> '',
			'font-weight'	=> '',
			'font-style'	=> '',
			'line-height'	=> '1.2857em'
			)
		);

	}
}





//------------------------------------------------------------------------------
// Theme fonts
//------------------------------------------------------------------------------

// Add theme fonts in the used fonts list
if (!function_exists('sweet_dessert_filter_theme_styles_used_fonts')) {
	function sweet_dessert_filter_theme_styles_used_fonts($theme_fonts) {
		$theme_fonts['Poppins'] = 1;
        $theme_fonts['Amatic SC'] = 1;
		return $theme_fonts;
	}
}

// Add theme fonts (from Google fonts) in the main fonts list (if not present).
// To use custom font-face you not need add it into list in this function
// How to install custom @font-face fonts into the theme?
// All @font-face fonts are located in "theme_name/css/font-face/" folder in the separate subfolders for the each font. Subfolder name is a font-family name!
// Place full set of the font files (for each font style and weight) and css-file named stylesheet.css in the each subfolder.
// Create your @font-face kit by using Fontsquirrel @font-face Generator (http://www.fontsquirrel.com/fontface/generator)
// and then extract the font kit (with folder in the kit) into the "theme_name/css/font-face" folder to install
if (!function_exists('sweet_dessert_filter_theme_styles_list_fonts')) {
	function sweet_dessert_filter_theme_styles_list_fonts($list) {
		if (!isset($list['Poppins']))	$list['Poppins'] = array('family'=>'sans-serif',
            'link'=> 'Poppins:400,500,600,700'
        );
        if (!isset($list['Amatic SC']))	$list['Amatic SC'] = array('family'=>'cursive',
            'link'=> 'Amatic+SC:400,700');
		return $list;
	}
}



//------------------------------------------------------------------------------
// Theme stylesheets
//------------------------------------------------------------------------------

// Add theme.less into list files for compilation
if (!function_exists('sweet_dessert_filter_theme_styles_compile_less')) {
	function sweet_dessert_filter_theme_styles_compile_less($files) {
		if (file_exists(sweet_dessert_get_file_dir('css/theme.less'))) {
		 	$files[] = sweet_dessert_get_file_dir('css/theme.less');
		}
		return $files;	
	}
}

// Add theme stylesheets
if (!function_exists('sweet_dessert_action_theme_styles_add_styles')) {
	function sweet_dessert_action_theme_styles_add_styles() {
		// Add stylesheet files only if LESS supported
		if ( sweet_dessert_get_theme_setting('less_compiler') != 'no' ) {
			wp_enqueue_style( 'sweet-dessert-theme-style', sweet_dessert_get_file_url('css/theme.css'), array(), null );
			wp_add_inline_style( 'sweet-dessert-theme-style', sweet_dessert_get_inline_css() );
		}
	}
}

// Add theme inline styles
if (!function_exists('sweet_dessert_filter_theme_styles_add_styles_inline')) {
	function sweet_dessert_filter_theme_styles_add_styles_inline($custom_style) {
		// Todo: add theme specific styles in the $custom_style to override

		// Submenu width
		$menu_width = sweet_dessert_get_theme_option('menu_width');
		if (!empty($menu_width)) {
			$custom_style .= "
				/* Submenu width */
				.menu_side_nav > li ul,
				.menu_main_nav > li ul {
					width: ".intval($menu_width)."px;
				}
				.menu_side_nav > li > ul ul,
				.menu_main_nav > li > ul ul {
					left:".intval($menu_width+4)."px;
				}
				.menu_side_nav > li > ul ul.submenu_left,
				.menu_main_nav > li > ul ul.submenu_left {
					left:-".intval($menu_width+1)."px;
				}
			";
		}
	
		// Logo height
		$logo_height = sweet_dessert_get_custom_option('logo_height');
		if (!empty($logo_height)) {
			$custom_style .= "
				/* Logo header height */
				.sidebar_outer_logo .logo_main,
				.top_panel_wrap .logo_main,
				.top_panel_wrap .logo_fixed {
					height:".intval($logo_height)."px;
				}
			";
		}
	
		// Logo top offset
		$logo_offset = sweet_dessert_get_custom_option('logo_offset');
		if (!empty($logo_offset)) {
			$custom_style .= "
				/* Logo header top offset */
				.top_panel_wrap .logo {
					margin-top:".intval($logo_offset)."px;
				}
			";
		}

		// Logo footer height
		$logo_height = sweet_dessert_get_theme_option('logo_footer_height');
		if (!empty($logo_height)) {
			$custom_style .= "
				/* Logo footer height */
				.contacts_wrap .logo img {
					height:".intval($logo_height)."px;
				}
			";
		}

		// Custom css from theme options
		$custom_style .= sweet_dessert_get_custom_option('custom_css');

		return $custom_style;	
	}
}


//------------------------------------------------------------------------------
// Theme scripts
//------------------------------------------------------------------------------

// Add theme scripts
if (!function_exists('sweet_dessert_action_theme_styles_add_scripts')) {
	function sweet_dessert_action_theme_styles_add_scripts() {
		if (sweet_dessert_get_theme_option('show_theme_customizer') == 'yes' && file_exists(sweet_dessert_get_file_dir('js/theme.customizer.js')))
			wp_enqueue_script( 'sweet-dessert-theme-styles-customizer-script', sweet_dessert_get_file_url('js/theme.customizer.js'), array(), null );
	}
}

// Add theme scripts inline
if (!function_exists('sweet_dessert_filter_theme_styles_localize_script')) {
	function sweet_dessert_filter_theme_styles_localize_script($vars) {
		if (empty($vars['theme_font']))
			$vars['theme_font'] = sweet_dessert_get_custom_font_settings('p', 'font-family');
		$vars['theme_color'] = sweet_dessert_get_scheme_color('text_dark');
		$vars['theme_bg_color'] = sweet_dessert_get_scheme_color('bg_color');
		return $vars;
	}
}
?>