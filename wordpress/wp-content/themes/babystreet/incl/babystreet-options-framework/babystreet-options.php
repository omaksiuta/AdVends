<?php

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */
function babystreet_optionsframework_options() {

	// general layout values
	$general_layout_values = array(
			'babystreet_fullwidth' => BABYSTREET_IMAGES_PATH . 'babystreet_fullwidth.jpg',
			'babystreet_boxed' => BABYSTREET_IMAGES_PATH . 'babystreet_boxed.jpg'
	);


	// Blog style options
	$general_blog_style_values = array(
			'' => esc_html__('Standard', 'babystreet'),
			'babystreet_blog_masonry' => esc_html__('Masonry Tiles', 'babystreet'),
			'babystreet_blog_masonry babystreet-mozaic' => esc_html__('Mozaic', 'babystreet')
	);

	// Header Background Defaults
	$header_background_defaults = array(
			'color' => '#ffffff',
			'image' => '',
			'repeat' => '',
			'position' => '',
			'attachment' => 'scroll'
	);

	// Footer Background Defaults
	$footer_background_defaults = array(
			'color' => '#ebf7fa',
			'image' => '',
			'repeat' => '',
			'position' => '',
			'attachment' => 'scroll'
	);

	// Number of columns on products list
	$shop_default_product_columns_values = array(
			'columns-1' => '1',
			'columns-2' => '2',
			'columns-3' => '3',
			'columns-4' => '4',
			'columns-5' => '5',
			'columns-6' => '6'
	);

	$header_style_list = array(
			'' => esc_html__('Normal', 'babystreet'),
			'babystreet_transparent_header' => esc_html__('Transparent - Light Scheme', 'babystreet'),
			'babystreet_transparent_header babystreet-transparent-dark' => esc_html__('Transparent - Dark Scheme', 'babystreet')
	);

	$choose_menu_options = babystreet_get_choose_menu_options();

	// Date format values
	$date_format_default = array(
		'babystreet_format' => esc_html_x('Use "time-ago" (e.g. 3 days ago) date format for posts created in the last 6 months. For older posts, WordPress date format will be used. ', 'theme-options', 'babystreet'),
		'default' => esc_html_x('WordPress date format', 'theme-options', 'babystreet')
	);

	// Show/hide seasrchform
	$show_searchform_default = 1;

	// Search options values Array
	$search_options_array = array(
			'use_ajax' => esc_html_x('Use Ajax', 'theme-options', 'babystreet')
	);

	if (defined('BABYSTREET_IS_WOOCOMMERCE') && BABYSTREET_IS_WOOCOMMERCE) {
		$search_options_array['only_products'] = esc_html_x('Search only in Products', 'theme-options', 'babystreet');
	}

	// Search options Defaults
	$search_options_defaults = array(
			'use_ajax' => '1',
			'only_products' => '1'
	);

	// Enabled / Disabled select
	$enable_disable_array = array(
			'enabled' => esc_html_x('Enabled', 'theme-options', 'babystreet'),
			'disabled' => esc_html_x('Disabled', 'theme-options', 'babystreet')
	);

	// "NEW" label active period (days)
	$new_label_period_array = array(
			'0' => esc_html_x('Off', 'theme-options', 'babystreet'),
			'10' => 10,
			'20' => 20,
			'30' => 30,
			'45' => 45,
			'60' => 60,
			'90' => 90
	);

	$os_faces = babystreet_typography_get_os_fonts();
	$google_fonts = babystreet_typography_get_google_fonts();

	asort($os_faces);
	asort($google_fonts);
	$typography_mixed_fonts = array_merge($os_faces, $google_fonts);

	// Default google subsets
	$google_subsets_defaults = array('latin' => '1');

	// Google subsets
	$google_subsets_options = array(
			'cyrillic-ext' => 'Cyrillic Extended (cyrillic-ext)',
			'latin' => 'Latin (latin)',
			'greek-ext' => 'Greek Extended (greek-ext)',
			'greek' => 'Greek (greek)',
			'vietnamese' => 'Vietnamese (vietnamese)',
			'latin-ext' => 'Latin Extended (latin-ext)',
			'cyrillic' => 'Cyrillic (cyrillic)'
	);

	// body font default
	$body_font_default = array(
			'face' => 'Quicksand',
			'size' => '18px',
			'color' => '#777777'
	);

	// Headings font face default
	$headings_font_default = array(
			'face' => 'Quicksand'
	);

	// Heading fonts style and weight options
	$headings_fonts_styles_weight = array('false' => 'default');

	for ($n = 1; $n < 10; $n++) {
		$headings_fonts_styles_weight['{"font-weight":"' . $n . '00","font-style":"normal"}'] = $n . '00';
		$headings_fonts_styles_weight['{"font-weight":"' . $n . '00","font-style":"italic"}'] = $n . '00 italic';
	}

	// H1 deault
	$h1_font_default = array(
			'face' => $headings_font_default['face'],
			'size' => '60px',
			'color' => '#183a5c',
			'style' => '{"font-weight":"700","font-style":"normal"}'
	);

	// H2 deault
	$h2_font_default = array(
			'face' => $headings_font_default['face'],
			'size' => '48px',
			'color' => '#183a5c',
			'style' => '{"font-weight":"700","font-style":"normal"}'
	);

	// H3 deault
	$h3_font_default = array(
			'face' => $headings_font_default['face'],
			'size' => '30px',
			'color' => '#183a5c',
			'style' => '{"font-weight":"700","font-style":"normal"}'
	);

	// H4 deault
	$h4_font_default = array(
			'face' => $headings_font_default['face'],
			'size' => '24px',
			'color' => '#183a5c',
			'style' => '{"font-weight":"700","font-style":"normal"}'
	);

	// H5 deault
	$h5_font_default = array(
			'face' => $headings_font_default['face'],
			'size' => '21px',
			'color' => '#183a5c',
			'style' => '{"font-weight":"500","font-style":"normal"}'
	);

	// H6 deault
	$h6_font_default = array(
			'face' => $headings_font_default['face'],
			'size' => '19px',
			'color' => '#183a5c',
			'style' => '{"font-weight":"500","font-style":"normal"}'
	);

	// promo tooltip positions
	$promo_tooltip_positions = array(
		'above-price' => esc_html_x('Above Price', 'theme-options', 'babystreet'),
		'below-price' => esc_html_x('After Price', 'theme-options', 'babystreet'),
		'below-add-to-cart' => esc_html_x('Below "Add to cart"', 'theme-options', 'babystreet'),
	);

	// Stores registered sidebars
	global $wp_registered_sidebars;
	$registered_sidebars_array = array('none' => 'none');

	foreach ($wp_registered_sidebars as $sidebar_id => $sidebar) {
		if ($sidebar_id != 'pre_header_sidebar') {
			$registered_sidebars_array[$sidebar_id] = $sidebar['name'];
		}
	}

	$sidebar_positions = array(
		'babystreet-right-sidebar' => esc_html_x( 'Right', 'theme-options', 'babystreet' ),
		'babystreet-left-sidebar'  => esc_html_x( 'Left', 'theme-options', 'babystreet' )
	);

	$sidebar_positions_with_default = array_merge( array( 'default' => '- ' . esc_html_x( 'Default Position', 'theme-options', 'babystreet' ) . ' -' ), $sidebar_positions );

	$wp_editor_settings = array(
			'wpautop' => true, // Default
			'textarea_rows' => 5,
			'tinymce' => array('plugins' => 'wordpress'),
			'media_buttons' => true
	);

	$options = array();

	/*
	 * GENERAL SETTNIGS
	 */

	$options[] = array(
			'name' => esc_html_x('General', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'general'
	);
	$options[] = array(
			'name' => esc_html_x('Responsive', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enable responsive design.', 'theme-options', 'babystreet'),
			'id' => 'is_responsive',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Use Site Preloader', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enable preloader for the whole site.', 'theme-options', 'babystreet'),
			'id' => 'show_preloader',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Layout', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose layout to be used sitewide.', 'theme-options', 'babystreet'),
			'id' => 'general_layout',
			'std' => 'babystreet_fullwidth',
			'type' => 'images',
			'options' => $general_layout_values
	);
	$options[] = array(
			'name' => esc_html_x('Logo', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose or upload new logo.', 'theme-options', 'babystreet'),
			'id' => 'theme_logo',
			'std' => '',
			'type' => 'babystreet_upload'
	);
	$options[] = array(
			'name' => esc_html_x('Transparent Header Alternative Logo', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose or upload new logo.', 'theme-options', 'babystreet'),
			'id' => 'transparent_theme_logo',
			'type' => 'babystreet_upload'
	);
	$options[] = array(
		'name' => esc_html_x('Mobile Devices Logo (Optional) - if set, also used in sticky header', 'theme-options', 'babystreet'),
		'desc' => esc_html_x('Choose or upload new logo.', 'theme-options', 'babystreet').'<br>'.
		          esc_html_x('Recommended image size: 50x50 px.', 'theme-options', 'babystreet'),
		'id' => 'mobile_theme_logo',
		'type' => 'babystreet_upload'
	);
	$options[] = array(
			'name' => esc_html_x('Footer Logo (Needs to be enabled from Footer area->Show logo in footer)', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose or upload new logo.', 'theme-options', 'babystreet'),
			'id' => 'footer_logo',
			'type' => 'babystreet_upload'
	);
	$options[] = array(
			'name' => esc_html_x('Text Logo Typography', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Set font options for text logo (only active if there is no image logo selected).', 'theme-options', 'babystreet'),
			'id' => 'text_logo_typography',
			'std' => array(
					'size' => '16px',
					'style' => '{"font-weight":"500","font-style":"normal"}',
					'color' => '#333333'
			),
			'type' => 'typography',
			'options' => array(
					'faces' => false,
					'styles' => $headings_fonts_styles_weight,
					'color' => true
			)
	);
	$options[] = array(
		'name' => esc_html_x( 'Google Maps JavaScript API key', 'theme-options', 'babystreet' ),
		'desc' => sprintf( wp_kses( _x( 'Enter your Google Maps JavaScript API key, to be used for google map integration in Map shortcode. <a target="_blank" href="%s">Generate Google Maps JavaScript API key</a>', 'theme-options', 'babystreet' ), array(
			'a' => array(
				'target' => array(),
				'href'   => array()
			)
		) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' ) ),
		'id'   => 'google_maps_api_key',
		'std'  => '',
		'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Enable Smooth Scroll', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Smooth scrolling, when using anchors (known as one-pager).', 'theme-options', 'babystreet'),
			'id' => 'enable_smooth_scroll',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Show Previous / Next Links', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Show Previous / Next Links for posts, products and portfolios.', 'theme-options', 'babystreet'),
			'id' => 'show_prev_next',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
		'name' => esc_html_x('Global Date Format', 'theme-options', 'babystreet'),
		'desc' => esc_html_x('Choose between the WordPress settings format and the theme "time ago" format for posts and all custom post types.', 'theme-options', 'babystreet'),
		'id' => 'date_format',
		'std' => 'default',
		'type' => 'radio',
		'options' => $date_format_default
	);
	$options[] = array(
			'name' => esc_html_x('Enable Carousel Effect', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enable Carousel effect on related posts, portfolios and products.', 'theme-options', 'babystreet'),
			'id' => 'owl_carousel',
			'std' => 1,
			'type' => 'checkbox'
	);
	// When 'expandable_option' class is used,
	// the options with class as the id if this element will be shown/hide
	$options[] = array(
			'name' => esc_html_x('Show Search in Header', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Show search form in header.', 'theme-options', 'babystreet'),
			'id' => 'show_searchform',
			'std' => $show_searchform_default,
			'class' => 'expandable_option',
			'type' => 'checkbox'
	);
	$options[] = array(
			//'name' => esc_html__('Multicheck' , 'babystreet'),
			'desc' => esc_html_x('Choose whether to use Ajax or ordinary form. Search only in products or in the whole site (only if WooCommerce is activated).', 'theme-options', 'babystreet'),
			'id' => 'search_options',
			'std' => $search_options_defaults, // These items get checked by default
			'type' => 'multicheck',
			'options' => $search_options_array,
			'class' => 'show_searchform'
	);
	$options[] = array(
			'name' => esc_html_x('Enable Breadcrumb', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Show breadcrumb.', 'theme-options', 'babystreet'),
			'id' => 'show_breadcrumb',
			'std' => 1,
			'type' => 'checkbox'
	);
	/*
	 * HEADER AREA SETTNIGS
	 */
	$options[] = array(
			'name' => esc_html_x('Header area', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'class' => 'babystreet-expandable-cont',
			'tab_id' => 'headerarea'
	);
	$options[] = array(
		'name' => esc_html_x('Main Menu Alignment', 'theme-options', 'babystreet'),
		'desc' => esc_html_x('Set main menu alignment position.', 'theme-options', 'babystreet'),
		'id' => 'main_menu_alignment',
		'std' => 'babystreet-main-menu-left',
		'type' => 'select',
		'class' => 'logo_menu_position_babystreet_logo_left_menu_right',
		'options' => array(
			'babystreet-main-menu-left' => esc_html_x('Left', 'theme-options', 'babystreet'),
			'babystreet-main-menu-center' => esc_html_x('Center', 'theme-options', 'babystreet'),
			'babystreet-main-menu-right' => esc_html_x('Right', 'theme-options', 'babystreet')
		)
	);
	$options[] = array(
			'name' => esc_html_x('Header Size', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Standard / Fullwidth.', 'theme-options', 'babystreet'),
			'id' => 'header_width',
			'std' => 'babystreet-stretched-header',
			'type' => 'select',
			'options' => array(
					'' => esc_html_x('Standard', 'theme-options', 'babystreet'),
					'babystreet-stretched-header' => esc_html_x('Fullwidth', 'theme-options', 'babystreet')
			)
	);
	$options[] = array(
			'name' => esc_html_x('Sticky Header', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enable sticky header functionality.', 'theme-options', 'babystreet'),
			'id' => 'sticky_header',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html__('Header Background', 'babystreet'),
			'desc' => esc_html__('Set Header Background image and/or color.', 'babystreet'),
			'id' => 'header_background',
			'std' => $header_background_defaults,
			'type' => 'background'
	);
	$options[] = array(
			'name' => esc_html_x('Top Menu Bar', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Show the top menu bar', 'theme-options', 'babystreet'),
			'id' => 'enable_top_header',
			'std' => 0,
			'type' => 'checkbox',
			'class' => 'expandable_option'
	);
	$options[] = array(
			'name' => esc_html_x('Top Menu Bar Visible on Mobile', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Will be vsible on mobile devices', 'theme-options', 'babystreet'),
			'id' => 'header_top_mobile_visibility',
			'std' => 1,
			'type' => 'checkbox',
			'class' => 'enable_top_header'
	);
	$options[] = array(
			'name' => esc_html_x('Short Top Header Message', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('The message will appear in the top menu bar.', 'theme-options', 'babystreet'),
			'id' => 'top_bar_message',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'desc' => esc_html_x('Append Phone Number.', 'theme-options', 'babystreet'),
			'id' => 'top_bar_message_phone',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
		'desc' => esc_html_x('Make phone number a link to dial.', 'theme-options', 'babystreet'),
		'id' => 'top_bar_message_phone_link',
		'std' => 1,
		'type' => 'checkbox',
	);
	$options[] = array(
			'desc' => esc_html_x('Append Email Address.', 'theme-options', 'babystreet'),
			'id' => 'top_bar_message_email',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
		'desc' => esc_html_x('Make email address a link to open default mail client.', 'theme-options', 'babystreet'),
		'id' => 'top_bar_message_email_link',
		'std' => 1,
		'type' => 'checkbox',
	);
	$options[] = array(
			'name' => esc_html_x('Collapsible Pre-Header', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enable Collapsible Pre-Header widget area', 'theme-options', 'babystreet'),
			'id' => 'enable_pre_header',
			'std' => 0,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Collapsible Pre-Header Background Color', 'theme-options', 'babystreet'),
			'id' => 'collapsible_bckgr_color',
			'std' => '#fcfcfc',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Collapsible Pre-Header Titles Color', 'theme-options', 'babystreet'),
			'id' => 'collapsible_titles_color',
			'std' => '#333333',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Collapsible Pre-Header Titles Border Color', 'theme-options', 'babystreet'),
			'id' => 'collapsible_titles_border_color',
			'std' => '#f1f1f1',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Collapsible Pre-Header Links Color', 'theme-options', 'babystreet'),
			'id' => 'collapsible_links_color',
			'std' => '#333333',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Header Top Bar Background Color', 'theme-options', 'babystreet'),
			'id' => 'header_top_bar_color',
			'std' => '#ebf7fa',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Header Top Bar Menu Links Color', 'theme-options', 'babystreet'),
			'id' => 'top_bar_menu_links_color',
			'std' => '#3eafcb',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Header Top Bar Menu Links Hover Color', 'theme-options', 'babystreet'),
			'id' => 'top_bar_menu_links_hover_color',
			'std' => '#216272',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Main Menu Typography', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose Main menu font size and style.', 'theme-options', 'babystreet'),
			'id' => 'main_menu_typography',
			'std' => array(
					'size' => '16px',
					'style' => '{"font-weight":"700","font-style":"normal"}'
			),
			'type' => 'typography',
			'options' => array(
					'faces' => false,
					'styles' => $headings_fonts_styles_weight,
					'color' => false
			)
	);
	$options[] = array(
			'name' => esc_html_x('Main Menu Icons Color', 'theme-options', 'babystreet'),
			'id' => 'main_menu_icons_color',
			'std' => '#57c1db',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Main Menu Transform to Uppercase', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Transform main menu top level to uppercase.', 'theme-options', 'babystreet'),
			'id' => 'main_menu_transf_to_uppercase',
			'std' => 0,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Main Menu Links Color', 'theme-options', 'babystreet'),
			'id' => 'main_menu_links_color',
			'std' => '#183a5c',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Main Menu Links Hover Color', 'theme-options', 'babystreet'),
			'id' => 'main_menu_links_hover_color',
			'std' => '#ff8087',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Transparent Header Menu Color - Light Scheme', 'theme-options', 'babystreet'),
			'id' => 'transparent_header_menu_color',
			'std' => '#ffffff',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Transparent Header Menu Hover Color - Light Scheme', 'theme-options', 'babystreet'),
			'id' => 'transparent_header_menu_hover_color',
			'std' => '',
			'type' => 'color'
	);
	$options[] = array(
		'name' => esc_html_x('Transparent Header Menu Color - Dark Scheme', 'theme-options', 'babystreet'),
		'id' => 'transparent_header_dark_menu_color',
		'std' => '#333333',
		'type' => 'color'
	);
	$options[] = array(
		'name' => esc_html_x('Transparent Header Menu Hover - Dark Scheme', 'theme-options', 'babystreet'),
		'id' => 'transparent_header_dark_menu_hover_color',
		'std' => '#111111',
		'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Sub-Menu Color Scheme', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Select color scheme for the sub-menu.', 'theme-options', 'babystreet'),
			'id' => 'submenu_color_scheme',
			'std' => '',
			'type' => 'select',
			'options' => array(
					'' => esc_html_x('Light', 'theme-options', 'babystreet'),
					'babystreet-dark-menu' => esc_html_x('Dark', 'theme-options', 'babystreet')
			)
	);
	/*
	 * FOOTER AREA SETTNIGS
	 */
	$options[] = array(
			'name' => esc_html_x('Footer area', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'footerarea'
	);
	$options[] = array(
			'name' => esc_html_x('Footer Style', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('*Note: Reveal footer is only available in fullwidth layout mode and not available on mobile/touch devices and screens with height lower than 768px for compatibility reasons. Use this feature with extra attention on large footer, because of the fixed footer position, which could prevent the full footer visibility on smaller screens.', 'theme-options', 'babystreet'),
			'id' => 'footer_style',
			'std' => '',
			'type' => 'select',
			'options' => array(
					'' => esc_html_x('Standard', 'theme-options', 'babystreet'),
					'babystreet-reveal-footer' => esc_html_x('Reveal', 'theme-options', 'babystreet')
			)
	);
	$options[] = array(
			'name' => esc_html_x('Footer Size', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Standard / Fullwidth.', 'theme-options', 'babystreet'),
			'id' => 'footer_width',
			'std' => '',
			'type' => 'select',
			'options' => array(
					'' => esc_html_x('Standard', 'theme-options', 'babystreet'),
					'babystreet-stretched-footer' => esc_html_x('Fullwidth', 'theme-options', 'babystreet')
			)
	);
	$options[] = array(
			'name' => esc_html_x('Show Logo in Footer', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Main logo will be displayed in footer, unless General->Footer Logo is selected. In that case "Footer Logo" will be displayed.', 'theme-options', 'babystreet'),
			'id' => 'show_logo_in_footer',
			'std' => 0,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html__('Footer Background', 'babystreet'),
			'desc' => esc_html__('Set Footer Background image and/or color.', 'babystreet'),
			'id' => 'footer_background',
			'std' => $footer_background_defaults,
			'type' => 'background'
	);
	$options[] = array(
			'name' => esc_html_x('Footer Titles Color', 'theme-options', 'babystreet'),
			'id' => 'footer_titles_color',
			'std' => '#183a5c',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Footer Titles Border Color', 'theme-options', 'babystreet'),
			'id' => 'footer_title_border_color',
			'std' => '#f1f1f1',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Footer Menu Links Color', 'theme-options', 'babystreet'),
			'id' => 'footer_menu_links_color',
			'std' => '#ffffff',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Footer Widgets Links Color', 'theme-options', 'babystreet'),
			'id' => 'footer_links_color',
			'std' => '#183a5c',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Footer Text Color', 'theme-options', 'babystreet'),
			'id' => 'footer_text_color',
			'std' => '#999999',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Footer Copyright Bar Background Color', 'theme-options', 'babystreet'),
			'id' => 'footer_copyright_bar_bckgr_color',
			'std' => '',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Footer Copyright Bar Text Color', 'theme-options', 'babystreet'),
			'id' => 'footer_copyright_bar_text_color',
			'std' => '#183a5c',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Footer Copyright Bar Text', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enter Copyright text.', 'theme-options', 'babystreet'),
			'id' => 'copyright_text',
			'std' => 'Babystreet theme by <a target="_blank" title="theAlThemist\'s portfolio" href="http://themeforest.net/user/theAlThemist/portfolio?ref=theAlThemist">theAlThemist</a> | &#169; 2019 All rights reserved!',
			'type' => 'textarea'
	);

	/*
	 * COMMON STYLES
	 */
	$options[] = array(
			'name' => esc_html_x('Common Styles', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'commoncolors'
	);
	$options[] = array(
			'name' => esc_html_x('Site Main Accent Color', 'theme-options', 'babystreet'),
			'id' => 'accent_color',
			'std' => '#81d1e5',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Links Color', 'theme-options', 'babystreet'),
			'id' => 'links_color',
			'std' => '#57c1db',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Links Hover Color', 'theme-options', 'babystreet'),
			'id' => 'links_hover_color',
			'std' => '#81d1e5',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Widgets Title Color', 'theme-options', 'babystreet'),
			'id' => 'sidebar_titles_color',
			'std' => '#81d1e5',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Default Buttons Style', 'theme-options', 'babystreet'),
			'id' => 'all_buttons_style',
			'std' => 'round',
			'type' => 'select',
			'class' => 'mini',
			'options' => array(
					'classic' => esc_html__('Classic', 'babystreet'),
					'round' => esc_html__('Round', 'babystreet'),
			)
	);
	$options[] = array(
			'name' => esc_html_x('Default Buttons Color', 'theme-options', 'babystreet'),
			'id' => 'all_buttons_color',
			'std' => '#ff8087',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Default Buttons Hover Color', 'theme-options', 'babystreet'),
			'id' => 'all_buttons_hover_color',
			'std' => '#444444',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('NEW Label Color', 'theme-options', 'babystreet'),
			'id' => 'new_label_color',
			'std' => '#333333',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('SALE Label Color', 'theme-options', 'babystreet'),
			'id' => 'sale_label_color',
			'std' => '#ff8087',
			'type' => 'color'
	);
	$options[] = array(
		'name' => esc_html_x('Fancy Title Font', 'theme-options', 'babystreet'),
		'desc' => esc_html_x('Use fancy font for all page titles. NOTE: Supports only latin characters', 'theme-options', 'babystreet'),
		'id' => 'fancy_title_font',
		'std' => 0,
		'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Standard page title color (no background image)', 'theme-options', 'babystreet'),
			'id' => 'page_title_color',
			'std' => '#183a5c',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Standard page subtitle color (no background image)', 'theme-options', 'babystreet'),
			'id' => 'page_subtitle_color',
			'std' => '#49a3b9',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Standard page title background color (no background image)', 'theme-options', 'babystreet'),
			'id' => 'page_title_bckgr_color',
			'std' => '#ebf7fa',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Default page title background image', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Will be used on all pages, if there is no other explicitly set.', 'theme-options', 'babystreet'),
			'id' => 'page_title_default_bckgr_image',
			'std' => '',
			'type' => 'babystreet_upload',
			'is_multiple' => false
	);
	$options[] = array(
			'name' => esc_html_x('Standard page title border color (no background image)', 'theme-options', 'babystreet'),
			'id' => 'page_title_border_color',
			'std' => '#f0f0f0',
			'type' => 'color'
	);
	$options[] = array(
			'name' => esc_html_x('Customized page title color (with background image)', 'theme-options', 'babystreet'),
			'id' => 'custom_page_title_color',
			'std' => '#ffffff',
			'desc' => esc_html_x('Also applies for subtitle and breadcrumb.', 'theme-options', 'babystreet'),
			'type' => 'color'
	);

	/*
	 * Portfolio
	 */
	$options[] = array(
			'name' => esc_html_x('Portfolio', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'portfolio'
	);
	$options[] = array(
			'name' => esc_html_x('Portfolio Category Layout', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose the layout for the portfolio category view.', 'theme-options', 'babystreet'),
			'id' => 'portfoio_cat_layout',
			'std' => '{"babystreet_portfolio_style_class":"grid-unit","babystreet_columns_class":"portfolio-col-3"}',
			'type' => 'select',
			'options' => array(
					'{"babystreet_portfolio_style_class":"grid-unit","babystreet_columns_class":"portfolio-col-2"}' => esc_html_x('Grid 2 Columns', 'theme-options', 'babystreet'),
					'{"babystreet_portfolio_style_class":"grid-unit","babystreet_columns_class":"portfolio-col-3"}' => esc_html_x('Grid 3 Columns', 'theme-options', 'babystreet'),
					'{"babystreet_portfolio_style_class":"grid-unit","babystreet_columns_class":"portfolio-col-4"}' => esc_html_x('Grid 4 Columns', 'theme-options', 'babystreet'),
					'{"babystreet_portfolio_style_class":"masonry-unit","babystreet_columns_class":"babystreet_masonry_fullwidth"}' => esc_html_x('Masonry Fullwidth', 'theme-options', 'babystreet'),
					'{"babystreet_portfolio_style_class":"masonry-unit","babystreet_columns_class":false}' => esc_html_x('Masonry Grid', 'theme-options', 'babystreet')
			)
	);
	$options[] = array(
		'name' => esc_html_x('Enable Infinite Scroll', 'theme-options', 'babystreet'),
		'desc' => esc_html_x('Enable infinite scroll on portfolio listing pages.', 'theme-options', 'babystreet'),
		'id' => 'enable_portfolio_infinite',
		'std' => 1,
		'type' => 'checkbox',
		'class' => 'expandable_option'
	);
	$options[] = array(
		'name' => esc_html_x('Load More Button', 'theme-options', 'babystreet'),
		'desc' => esc_html_x('Use "Load More" button for the additional portfolios to load.', 'theme-options', 'babystreet'),
		'id' => 'use_load_more_on_portfolio',
		'std' => 0,
		'type' => 'checkbox',
		'class' => 'enable_portfolio_infinite'
	);
	$options[] = array(
			'name' => esc_html_x('Portfolio Gaps', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Will there be a gap between projects in category view.', 'theme-options', 'babystreet'),
			'id' => 'portfoio_cat_display',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Show Similar Styles', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Display similar styles on single project page.', 'theme-options', 'babystreet'),
			'id' => 'show_related_projects',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Lightbox', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Show link that opens the featured image in lightbox.', 'theme-options', 'babystreet'),
			'id' => 'show_light_projects',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Portfolio Overlay Text Color', 'theme-options', 'babystreet'),
			'id' => 'portfolio_overlay_text_color',
			'std' => '#ffffff',
			'type' => 'color'
	);
	/*
	 * FONTS
	 */
	$options[] = array(
			'name' => esc_html_x('Fonts', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'fonts'
	);
	$options[] = array(
			'name' => esc_html_x('Body Font', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose font parameters for the body text.', 'theme-options', 'babystreet'),
			'id' => 'body_font',
			'std' => $body_font_default,
			'type' => 'typography',
			'options' => array(
					'faces' => $typography_mixed_fonts,
					'styles' => false,
					'preview' => true
			)
	);
	$options[] = array(
			'name' => esc_html_x('Accent and Headings Google Font Face', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose Font Face.', 'theme-options', 'babystreet'),
			'id' => 'headings_font',
			'std' => $headings_font_default,
			'type' => 'typography',
			'options' => array(
					'faces' => $typography_mixed_fonts,
					'styles' => false,
					'color' => false,
					'sizes' => false
			)
	);
	$options[] = array(
			'desc' => esc_html_x('Use selected google font face also for', 'theme-options', 'babystreet'),
			'id' => 'use_google_face_for',
			'std' => array(
					'main_menu' => 1,
					'buttons' => 1
			),
			'type' => 'multicheck',
			'options' => array(
					'main_menu' => esc_html_x('Main Menu', 'theme-options', 'babystreet'),
					'buttons' => esc_html_x('Buttons', 'theme-options', 'babystreet')
			)
	);
	$options[] = array(
			'name' => esc_html__('Google Font Subsets', 'babystreet'),
			'desc' => esc_html_x('Choose Subsets.', 'theme-options', 'babystreet'),
			'id' => 'google_subsets',
			'std' => $google_subsets_defaults, // These items get checked by default
			'type' => 'multicheck',
			'options' => $google_subsets_options
	);
	$options[] = array(
			'name' => esc_html_x('H1 Font Options', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose H1 size, style and color.', 'theme-options', 'babystreet'),
			'id' => 'h1_font',
			'std' => $h1_font_default,
			'type' => 'typography',
			'options' => array(
					'faces' => false,
					'styles' => $headings_fonts_styles_weight,
					'preview' => true
			)
	);
	$options[] = array(
			'name' => esc_html_x('H2 Font Options', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose H2 size, style and color.', 'theme-options', 'babystreet'),
			'id' => 'h2_font',
			'std' => $h2_font_default,
			'type' => 'typography',
			'options' => array(
					'faces' => false,
					'styles' => $headings_fonts_styles_weight,
					'preview' => true
			)
	);
	$options[] = array(
			'name' => esc_html_x('H3 Font Options', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose H3 size, style and color.', 'theme-options', 'babystreet'),
			'id' => 'h3_font',
			'std' => $h3_font_default,
			'type' => 'typography',
			'options' => array(
					'faces' => false,
					'styles' => $headings_fonts_styles_weight,
					'preview' => true
			)
	);
	$options[] = array(
			'name' => esc_html_x('H4 Font Options', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose H4 size, style and color.', 'theme-options', 'babystreet'),
			'id' => 'h4_font',
			'std' => $h4_font_default,
			'type' => 'typography',
			'options' => array(
					'faces' => false,
					'styles' => $headings_fonts_styles_weight,
					'preview' => true
			)
	);
	$options[] = array(
			'name' => esc_html_x('H5 Font Options', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose H5 size, style and color.', 'theme-options', 'babystreet'),
			'id' => 'h5_font',
			'std' => $h5_font_default,
			'type' => 'typography',
			'options' => array(
					'faces' => false,
					'styles' => $headings_fonts_styles_weight,
					'preview' => true
			)
	);
	$options[] = array(
			'name' => esc_html_x('H6 Font Options', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose H6 size, style and color.', 'theme-options', 'babystreet'),
			'id' => 'h6_font',
			'std' => $h6_font_default,
			'type' => 'typography',
			'options' => array(
					'faces' => false,
					'styles' => $headings_fonts_styles_weight,
					'preview' => true
			)
	);
	/*
	 * Advanced Backgrounds
	 */
	$options[] = array(
			'name' => esc_html_x('Advanced Backgrounds', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'advancedbackgrounds'
	);
	$options[] = array(
			'name' => esc_html_x('Enable YouTube Video Background Sitewide.', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Check to enable below youtube video to be set as background on the whole site. Note that it will override any supersized and ordinary backgrounds.', 'theme-options', 'babystreet'),
			'id' => 'show_video_bckgr',
			'std' => 0,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('YouTube Video URL', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Paste the YouTube URL.', 'theme-options', 'babystreet'),
			'id' => 'video_bckgr_url',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Start Time', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Set the seconds the video should start at.', 'theme-options', 'babystreet'),
			'id' => 'video_bckgr_start',
			'class' => 'mini',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('End Time', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Set the seconds the video should stop at.', 'theme-options', 'babystreet'),
			'id' => 'video_bckgr_end',
			'class' => 'mini',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Loop', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Loops the movie once ended.', 'theme-options', 'babystreet'),
			'id' => 'video_bckgr_loop',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Mute', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Mute the audio.', 'theme-options', 'babystreet'),
			'id' => 'video_bckgr_mute',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Enable supersized slider sitewide.', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Check to enable below slider to be set as background on the whole site. Note that it will override your current background.', 'theme-options', 'babystreet'),
			'id' => 'show_super_gallery',
			'std' => '0',
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Choose images for the sitewide supersized slider.', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Use to manage / upload images.', 'theme-options', 'babystreet'),
			'id' => 'supersized_images',
			'std' => '',
			'type' => 'babystreet_upload',
			'is_multiple' => true
	);
	/*
	 * If Woocommerce is activated show the shop options
	 */
	if (defined('BABYSTREET_IS_WOOCOMMERCE') && BABYSTREET_IS_WOOCOMMERCE) {
		/*
		 * SHOP
		 */
		$options[] = array(
				'name' => esc_html_x('Shop', 'theme-options', 'babystreet'),
				'type' => 'heading',
				'tab_id' => 'shop'
		);
		$options[] = array(
				'name' => esc_html_x('Shop Page Header Style', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Choose the header style for the page set as Shop page.', 'theme-options', 'babystreet'),
				'id' => 'shop_header_style',
				'std' => '',
				'type' => 'select',
				'class' => '', //mini, tiny, small
				'options' => $header_style_list
		);
		$options[] = array(
				'name' => esc_html_x('Shop Page Top Menu', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Choose top menu for the shop page.', 'theme-options', 'babystreet'),
				'id' => 'shop_top_menu',
				'std' => 'default',
				'type' => 'select',
				'class' => '', //mini, tiny, small
				'options' => $choose_menu_options
		);
		$options[] = array(
				'name' => esc_html_x('Subtitle', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Subtitle for shop page.', 'theme-options', 'babystreet'),
				'id' => 'shop_subtitle',
				'std' => '',
				'type' => 'text'
		);
		$options[] = array(
				'name' => esc_html_x('Title with Image Background on Shop Page', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Use to manage / upload images.', 'theme-options', 'babystreet'),
				'id' => 'shop_title_background_imgid',
				'std' => '',
				'type' => 'babystreet_upload',
				'is_multiple' => false
		);
		$options[] = array(
				'desc' => esc_html_x('Title alignment.', 'theme-options', 'babystreet'),
				'id' => 'shop_title_alignment',
				'std' => 'centered_title',
				'type' => 'select',
				'options' => array(
						'left_title' => esc_html_x('Left', 'theme-options', 'babystreet'),
						'centered_title' => esc_html_x('Center', 'theme-options', 'babystreet'),
				)
		);
		$options[] = array(
			'name' => esc_html_x('Product Page Gallery Type', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose between default WooCommerce gallery and image list gallery. It can be set also on per product basis.', 'theme-options', 'babystreet'),
			'id' => 'single_product_gallery_type',
			'std' => 'woo_default',
			'type' => 'select',
			'options' => array(
				'woo_default' => esc_html_x('WooCommerce Default Gallery', 'theme-options', 'babystreet'),
				'image_list' => esc_html_x('Image List Gallery', 'theme-options', 'babystreet'),
				'mosaic_images' => esc_html_x('Mosaic Images Gallery', 'theme-options', 'babystreet'),
			)
		);
		$options[] = array(
			'name' => esc_html_x('Enable Infinite Scroll', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enable infinite scroll on shop and category pages.', 'theme-options', 'babystreet'),
			'id' => 'enable_shop_infinite',
			'std' => 1,
			'type' => 'checkbox',
			'class' => 'expandable_option'
		);
		$options[] = array(
			'name' => esc_html_x('Load More Button', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Use "Load More" button for the additional products to load.', 'theme-options', 'babystreet'),
			'id' => 'use_load_more_on_shop',
			'std' => 0,
			'type' => 'checkbox',
			'class' => 'enable_shop_infinite'
		);
		$options[] = array(
				'name' => esc_html_x('Show Products Filters Area', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Show the area with price range and sorting options on products listings', 'theme-options', 'babystreet'),
				'id' => 'show_refine_area',
				'std' => 1,
				'type' => 'checkbox'
		);
		$options[] = array(
			'name' => esc_html_x('Products Filtering Area Default State', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Opened / Closed state for the product filtering area on products listings', 'theme-options', 'babystreet'),
			'id' => 'refine_area_state',
			'std' => 'opened',
			'options' => array(
				'closed' => esc_html_x('Closed', 'theme-options', 'babystreet'),
				'opened' => esc_html_x('Opened', 'theme-options', 'babystreet'),
			),
			'type' => 'select'
		);
		$options[] = array(
			'name' => esc_html_x('Enable Ajax for Product Filtering', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enable ajax for the price filter, sorting, products per page and "Babystreet Product Filter" widget', 'theme-options', 'babystreet'),
			'id' => 'use_product_filter_ajax',
			'std' => 1,
			'type' => 'checkbox'
		);
		$options[] = array(
			'name' => esc_html_x('Show "My Account" Icon', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose whether to display "My Account" icon link in header.', 'theme-options', 'babystreet'),
			'id' => 'show_my_account',
			'std' => 1,
			'type' => 'checkbox'
		);
		$options[] = array(
				'name' => esc_html_x('Show Shopping Cart', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Choose whether to display shopping cart in header.', 'theme-options', 'babystreet'),
				'id' => 'show_shopping_cart',
				'std' => 1,
				'type' => 'checkbox'
		);
		$options[] = array(
			'name' => esc_html_x('Use Custom Free Delivery Option', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Hide other shipping methods if free delivery is available. NOTE: Do not enable this option if using additional shipping plugins, and always clear WooCommerce transients after change.', 'theme-options', 'babystreet'),
			'id' => 'only_free_delivery',
			'std' => 0,
			'type' => 'checkbox'
		);
		$options[] = array(
			'name' => esc_html_x('Enable AJAX Add to Cart on Single Product Pages', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Use AJAX when adding product to cart on single product pages.', 'theme-options', 'babystreet'),
			'id' => 'ajax_to_cart_single',
			'std' => 1,
			'type' => 'checkbox'
		);
		$options[] = array(
				'name' => esc_html_x('Add to Cart Background Color', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Set background color for "Add to Cart" button on products.', 'theme-options', 'babystreet'),
				'id' => 'add_to_cart_color',
				'std' => '#ff8087',
				'type' => 'color'
		);
		$options[] = array(
				'name' => esc_html_x('Add to Cart Sound', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Play sound notification when product is added to shopping cart.', 'theme-options', 'babystreet'),
				'id' => 'add_to_cart_sound',
				'std' => 1,
				'type' => 'checkbox'
		);
		$options[] = array(
				'name' => esc_html_x('Wishlist Counter in Header', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Display wishlist counter in header.', 'theme-options', 'babystreet'),
				'id' => 'show_wish_in_header',
				'std' => 1,
				'type' => 'checkbox'
		);
		$options[] = array(
				'name' => esc_html_x('Enable Product Quickview', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Enable Quick view on product listings.', 'theme-options', 'babystreet'),
				'id' => 'use_quickview',
				'std' => 1,
				'type' => 'checkbox'
		);
		$options[] = array(
			'name'    => esc_html_x( 'Shop and Category Pages Width', 'theme-options', 'babystreet' ),
			'desc'    => esc_html_x( 'Choose width for the shop and category pages.', 'theme-options', 'babystreet' ),
			'id'      => 'shop_pages_width',
			'std'     => 'babystreet-fullwidth-shop-pages',
			'type'    => 'select',
			'class'   => 'mini', //mini, tiny, small
			'options' => array( '' => esc_html_x( 'Standart', 'theme-options', 'babystreet' ),
			                    'babystreet-fullwidth-shop-pages' => esc_html_x( 'Fullwidth', 'theme-options', 'babystreet')
			)
		);
		$options[] = array(
			'name'    => esc_html_x( 'Product Listing Columns on Mobile Phones', 'theme-options', 'babystreet' ),
			'desc'    => esc_html_x( 'Choose the number of columns to be displayed on mobile phones.', 'theme-options', 'babystreet' ),
			'id'      => 'product_columns_mobile',
			'std'     => '1',
			'type'    => 'select',
			'class'   => 'mini', //mini, tiny, small
			'options' => array( '1' => esc_html_x( 'Single Column', 'theme-options', 'babystreet' ),
			                    '2' => esc_html_x( 'Two Columns', 'theme-options', 'babystreet')
			)
		);
		$options[] = array(
			'name'    => esc_html_x( 'Manage Buttons Visibility on Listings', 'theme-options', 'babystreet' ),
			'desc'    => esc_html_x( 'Should "Add to cart" and similar buttons are visible on product listings, or only on hover.', 'theme-options', 'babystreet' ),
			'id'      => 'product_list_buttons_visibility',
			'std'     => 'babystreet-buttons-on-hover',
			'type'    => 'select',
			'class'   => 'mini', //mini, tiny, small
			'options' => array( 'babystreet-buttons-on-hover' => esc_html_x( 'Visible on Hover', 'theme-options', 'babystreet' ),
			                    'babystreet-visible-buttons' => esc_html_x( 'Always Visible', 'theme-options', 'babystreet')
			)
		);
		$options[] = array(
			'name'    => esc_html_x( 'Hover Product Image Behaviour on Product List', 'theme-options', 'babystreet' ),
			'desc'    => esc_html_x( 'Choose hover behaviour for product listing.', 'theme-options', 'babystreet' ),
			'id'      => 'product_hover_onproduct',
			'std'     => 'babystreet-prodhover-swap',
			'type'    => 'select',
			'class'   => 'mini', //mini, tiny, small
			'options' => array( 'babystreet-prodhover-zoom' => esc_html_x( 'Zoom', 'theme-options', 'babystreet' ),
			                    'babystreet-prodhover-swap' => esc_html_x( 'Image Swap', 'theme-options', 'babystreet'),
			                    'none'                => esc_html_x( 'No Effect', 'theme-options', 'babystreet' )
			)
		);
		$options[] = array(
			'name' => esc_html_x('Product Categories Fancy Style', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enable fancy font and styling for category list. (NOTE: Not recommended if you have categories with long names)', 'theme-options', 'babystreet'),
			'id' => 'categories_fancy',
			'std' => 1,
			'type' => 'checkbox'
		);
		$options[] = array(
				'name' => esc_html_x('Enable Carousel for Shop Categories', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Enable carousel effect for the listed categories on shop pages (If categories are enabled from WooCommerce settings).', 'theme-options', 'babystreet'),
				'id' => 'enable_shop_cat_carousel',
				'std' => 1,
				'type' => 'checkbox'
		);
		$options[] = array(
				'name' => esc_html_x('Columns Number for Shop Categories', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Select the number of columns for the listed categories on shop pages (If categories are enabled from WooCommerce settings).', 'theme-options', 'babystreet'),
				'id' => 'category_columns_num',
				'std' => '3',
				'type' => 'select',
				'class' => 'mini', //mini, tiny, small
				'options' => array(2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6)
		);
		$options[] = array(
				'name' => esc_html_x('Shop Pages Default Product Columns', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Select the default number of product columns on shop/category pages.', 'theme-options', 'babystreet'),
				'id' => 'shop_default_product_columns',
				'std' => 'columns-4',
				'type' => 'select',
				'class' => 'mini', //mini, tiny, small
				'options' => $shop_default_product_columns_values
		);
		$options[] = array(
			'name' => esc_html_x('Number of Products per Page', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Set the number of products per page for product listings, like shop and product category pages.', 'theme-options', 'babystreet'),
			'id' => 'products_per_page',
			'std' => 12,
			'class' => 'mini',
			'type' => 'text'
		);
		$options[] = array(
				'name' => esc_html_x('Number of Related Products', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Set the number of related products shown on single product page.', 'theme-options', 'babystreet'),
				'id' => 'number_related_products',
				'std' => 4,
				'class' => 'mini',
				'type' => 'text'
		);
		$options[] = array(
				'name' => esc_html_x('Enable Price Filter on Product Categories', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Show Price Filter.', 'theme-options', 'babystreet'),
				'id' => 'show_pricefilter',
				'std' => 1,
				'type' => 'checkbox'
		);
		$options[] = array(
			'name' => esc_html_x('Enable Product Per Page on Product Categories', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Limit products on product category pages.', 'theme-options', 'babystreet'),
			'id' => 'show_products_limit',
			'std' => 1,
			'type' => 'checkbox'
		);
		$options[] = array(
				'name' => esc_html_x('Use Countdown on Sales', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Show countdown meter for products on sale.', 'theme-options', 'babystreet'),
				'id' => 'use_countdown',
				'std' => 'enabled',
				'type' => 'select',
				'class' => 'mini', //mini, tiny, small
				'options' => $enable_disable_array
		);
		$options[] = array(
				'name' => esc_html_x('"NEW" Label Active Period', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('in Days', 'theme-options', 'babystreet'),
				'id' => 'new_label_period',
				'std' => 45,
				'type' => 'select',
				'class' => 'mini', //mini, tiny, small
				'options' => $new_label_period_array
		);
		$options[] = array(
			'name' => esc_html_x( 'Product Promo Info Tooltips', 'theme-options', 'babystreet' ),
			'desc' => esc_html_x( 'Define up to three tooltips, triggered on hover. There are three predefined positions for single product view. And additional option to show tooltips in product listings.', 'theme-options', 'babystreet' ),
			'type' => 'info'
		);
		$num_to_words = array(
			1 => esc_html_x( 'First', 'theme-options', 'babystreet' ),
			2 => esc_html_x( 'Second', 'theme-options', 'babystreet' ),
			3 => esc_html_x( 'Third', 'theme-options', 'babystreet' ),
		);
		for ( $i = 1; $i <= 3; $i ++ ) {
			$options[] = array(
				'name' => $num_to_words[ $i ] . ' ' . esc_html_x( 'Tooltip', 'theme-options', 'babystreet' ),
				'type' => 'start_section',
				'id'   => 'promo_tooltip_' . $i,
			);
			$options[] = array(
				'name'  => esc_html_x( 'Promo Text', 'theme-options', 'babystreet' ),
				'id'    => 'promo_tooltip_' . $i . '_text',
				'std'   => '',
				'type'  => 'text',
				'class' => 'babystreet-options-two-columns'
			);
			$options[] = array(
				'name'  => esc_html_x( 'Tooltip Trigger Text', 'theme-options', 'babystreet' ),
				'desc'  => esc_html_x( 'When hovered, will show the tooltip content.', 'theme-options', 'babystreet' ),
				'id'    => 'promo_tooltip_' . $i . '_trigger_text',
				'std'   => '',
				'type'  => 'text',
				'class' => 'babystreet-options-two-columns'
			);
			$options[] = array(
				'name'    => esc_html_x( 'Position in Single Product', 'theme-options', 'babystreet' ),
				'id'      => 'promo_tooltip_' . $i . '_position',
				'std'     => 'above_price',
				'type'    => 'select',
				'options' => $promo_tooltip_positions,
				'class'   => 'babystreet-options-two-columns'
			);
			$options[] = array(
				'name'  => esc_html_x( 'Show Also in Product Listings', 'theme-options', 'babystreet' ),
				'desc'  => esc_html_x( 'Check to show tooltips also in product listings, just below the price.', 'theme-options', 'babystreet' ),
				'id'    => 'promo_tooltip_' . $i . '_show_in_listing',
				'std'   => 0,
				'type'  => 'checkbox',
				'class' => 'babystreet-options-two-columns'
			);
			$options[] = array(
				'name' => esc_html_x( 'Tooltip Content', 'theme-options', 'babystreet' ),
				'id'   => 'promo_tooltip_' . $i . '_content',
				'std'  => '',
				'type' => 'textarea'
			);
			$options[] = array(
				'type' => 'end_section'
			);
		}
		$options[] = array(
			'name' => esc_html_x('Single Product Page Custom Popup', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enter the link label and the content of the popup. The link will be shown in the single product page, in the short description area.', 'theme-options', 'babystreet'),
			'id' => 'custom_product_popup_link',
			'std' => '',
			'type' => 'text'
		);
		$options[] = array(
			'id' => 'custom_product_popup_content',
			'media_buttons' => true,
			'std' => '',
			'type' => 'editor',
			'settings' => $wp_editor_settings
		);
		// Video background
		$options[] = array(
				'name' => esc_html_x('Enable YouTube video background for Shop page', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Check to enable below youtube video to be set as background on the Shop page.', 'theme-options', 'babystreet'),
				'id' => 'show_shop_video_bckgr',
				'std' => 0,
				'type' => 'checkbox'
		);
		$options[] = array(
				'desc' => esc_html_x('Enable the video background for the whole shop area. NOTE: It will override all other video backgrounds in the shop area.', 'theme-options', 'babystreet'),
				'id' => 'shopwide_video_bckgr',
				'std' => '0',
				'type' => 'checkbox'
		);
		$options[] = array(
				'name' => esc_html_x('YouTube Video URL', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Paste the YouTube URL.', 'theme-options', 'babystreet'),
				'id' => 'shop_video_bckgr_url',
				'std' => '',
				'type' => 'text'
		);
		$options[] = array(
				'name' => esc_html_x('Start Time', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Set the seconds the video should start at.', 'theme-options', 'babystreet'),
				'id' => 'shop_video_bckgr_start',
				'class' => 'mini',
				'std' => '',
				'type' => 'text'
		);
		$options[] = array(
				'name' => esc_html_x('End Time', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Set the seconds the video should stop at.', 'theme-options', 'babystreet'),
				'id' => 'shop_video_bckgr_end',
				'class' => 'mini',
				'std' => '',
				'type' => 'text'
		);
		$options[] = array(
				'name' => esc_html_x('Loop', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Loops the movie once ended.', 'theme-options', 'babystreet'),
				'id' => 'shop_video_bckgr_loop',
				'std' => 1,
				'type' => 'checkbox'
		);
		$options[] = array(
				'name' => esc_html_x('Mute', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Mute the audio.', 'theme-options', 'babystreet'),
				'id' => 'shop_video_bckgr_mute',
				'std' => 1,
				'type' => 'checkbox'
		);
		// Supersized
		$options[] = array(
				'name' => esc_html_x('Enable supersized slider on Shop page.', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Check to enable below slider to be set as background on the Shop page.', 'theme-options', 'babystreet'),
				'id' => 'show_shop_super_gallery',
				'std' => '0',
				'type' => 'checkbox'
		);
		$options[] = array(
				'desc' => esc_html_x('Enable the slider for the whole shop area. NOTE: It will override all other supersized sliders in the shop area.', 'theme-options', 'babystreet'),
				'id' => 'shopwide_super_gallery',
				'std' => '0',
				'type' => 'checkbox'
		);
		$options[] = array(
				'name' => esc_html_x('Choose images for the Shop page supersized slider.', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Use to manage / upload images.', 'theme-options', 'babystreet'),
				'id' => 'shop_supersized_images',
				'std' => '',
				'type' => 'babystreet_upload',
				'is_multiple' => true
		);
	}
	/*
	 * If The Events Calendar is activated show the Events options
	 */
	if (defined('BABYSTREET_IS_EVENTS') && BABYSTREET_IS_EVENTS) {
		/*
		 * EVENTS
		 */
		$options[] = array(
			'name' => esc_html_x('Events', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'events'
		);
		$options[] = array(
			'desc' => esc_html_x('Options specific to The Events Calendar plugin.', 'theme-options', 'babystreet'),
			'type' => 'info'
		);
		$options[] = array(
			'name' => esc_html_x('Top Menu for Events Category View Pages', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose top menu for the Main Calendar Page, Calendar Category Pages, Main Events List, Category Events List.', 'theme-options', 'babystreet'),
			'id' => 'events_top_menu',
			'std' => 'default',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $choose_menu_options
		);
		$options[] = array(
			'name' => esc_html_x('Header Style for Events Category View Pages', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose the header style for Main Calendar Page, Calendar Category Pages, Main Events List, Category Events List.', 'theme-options', 'babystreet'),
			'id' => 'events_header_style',
			'std' => '',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $header_style_list
		);
		$options[] = array(
			'name' => esc_html_x('Events Title', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enter the title for Main Calendar Page, Main Events List. Use empty for default.', 'theme-options', 'babystreet'),
			'id' => 'events_title',
			'std' => '',
			'type' => 'text'
		);
		$options[] = array(
			'name' => esc_html_x('Events Subtitle', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Subtitle for Main Calendar Page, Main Events List.', 'theme-options', 'babystreet'),
			'id' => 'events_subtitle',
			'std' => '',
			'type' => 'text'
		);
		$options[] = array(
			'name' => esc_html_x('Title with Image Background for Events', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Use to manage / upload images', 'theme-options', 'babystreet'),
			'id' => 'events_title_background_imgid',
			'std' => '',
			'type' => 'babystreet_upload',
			'is_multiple' => false
		);
		$options[] = array(
			'desc' => esc_html_x('Title alignment', 'theme-options', 'babystreet'),
			'id' => 'events_title_alignment',
			'std' => 'none',
			'type' => 'select',
			'options' => array(
				'left_title' => esc_html_x('Left', 'theme-options', 'babystreet'),
				'centered_title' => esc_html_x('Center', 'theme-options', 'babystreet'),
			)
		);
		$options[] = array(
			'name' => esc_html_x('Use Countdown on Events', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Show countdown meter for starting time for an Event. Visible on single event pages.', 'theme-options', 'babystreet'),
			'id' => 'event_use_countdown',
			'std' => 1,
			'type' => 'checkbox'
		);
	}
	/*
	 * If bbPress is activated show the forum options
	 */
	if (defined('BABYSTREET_IS_BBPRESS') && BABYSTREET_IS_BBPRESS) {
		/*
		 * bbPress
		 */
		$options[] = array(
				'name' => esc_html_x('bbPress', 'theme-options', 'babystreet'),
				'type' => 'heading',
				'tab_id' => 'bbpress'
		);
		$options[] = array(
				'name' => esc_html_x('Header Style for Forum Root Page', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Choose the header style for the forum root page.', 'theme-options', 'babystreet'),
				'id' => 'forum_header_style',
				'std' => '',
				'type' => 'select',
				'class' => '', //mini, tiny, small
				'options' => $header_style_list
		);
		$options[] = array(
				'name' => esc_html_x('Forum Root Page Top Menu', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Choose top menu for the forum root page.', 'theme-options', 'babystreet'),
				'id' => 'forum_top_menu',
				'std' => 'default',
				'type' => 'select',
				'class' => '', //mini, tiny, small
				'options' => $choose_menu_options
		);
		$options[] = array(
				'name' => esc_html_x('Subtitle', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Subtitle for Forum Root Page.', 'theme-options', 'babystreet'),
				'id' => 'forum_subtitle',
				'std' => '',
				'type' => 'text'
		);
		$options[] = array(
				'name' => esc_html_x('Title with Image Background on Forum Root Page', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Use to manage / upload images.', 'theme-options', 'babystreet'),
				'id' => 'forum_title_background_imgid',
				'std' => '',
				'type' => 'babystreet_upload',
				'is_multiple' => false
		);
		$options[] = array(
				'desc' => esc_html_x('Title alignment.', 'theme-options', 'babystreet'),
				'id' => 'forum_title_alignment',
				'std' => 'none',
				'type' => 'select',
				'options' => array(
						'left_title' => esc_html_x('Left', 'theme-options', 'babystreet'),
						'centered_title' => esc_html_x('Center', 'theme-options', 'babystreet'),
				)
		);
	}
	/*
	 * BLOG
	 */
	$options[] = array(
			'name' => esc_html_x('Blog', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'blog'
	);
	$options[] = array(
			'name' => esc_html_x('Blog Style', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose how the posts will appear on the Blog.', 'theme-options', 'babystreet'),
			'id' => 'general_blog_style',
			'std' => '',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $general_blog_style_values
	);
	$options[] = array(
			'name' => esc_html_x('Top Menu for Blog page', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose top menu for Blog page.', 'theme-options', 'babystreet'),
			'id' => 'blog_top_menu',
			'std' => 'default',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $choose_menu_options
	);
	$options[] = array(
			'name' => esc_html_x('Header Style for Blog page, Category, Tags and Search', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose the header style for Blog page, Category, Tags and Search.', 'theme-options', 'babystreet'),
			'id' => 'blog_header_style',
			'std' => '',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $header_style_list
	);
	$options[] = array(
			'name' => esc_html_x('Show Title on the Blog page.', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('If selected, the page set as Blog page will have its title displayed.', 'theme-options', 'babystreet'),
			'id' => 'show_blog_title',
			'std' => '1',
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Blog Title', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enter the title of the Blog page as set up in the Settings->Reading.', 'theme-options', 'babystreet'),
			'id' => 'blog_title',
			'std' => 'Blog',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Blog Subtitle', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Subtitle for blog page.', 'theme-options', 'babystreet'),
			'id' => 'blog_subtitle',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Title with Image Background on Blog page, Category, Tags and Search', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Use to manage / upload images', 'theme-options', 'babystreet'),
			'id' => 'blog_title_background_imgid',
			'std' => '',
			'type' => 'babystreet_upload',
			'is_multiple' => false
	);
	$options[] = array(
			'desc' => esc_html_x('Title alignment', 'theme-options', 'babystreet'),
			'id' => 'blog_title_alignment',
			'std' => 'centered_title',
			'type' => 'select',
			'options' => array(
					'left_title' => esc_html_x('Left', 'theme-options', 'babystreet'),
					'centered_title' => esc_html_x('Center', 'theme-options', 'babystreet'),
			)
	);
	$options[] = array(
		'name'    => esc_html_x( 'Blog and Category Pages Width', 'theme-options', 'babystreet' ),
		'desc'    => esc_html_x( 'Choose width for the blog and category pages.', 'theme-options', 'babystreet' ),
		'id'      => 'blog_pages_width',
		'std'     => '',
		'type'    => 'select',
		'class'   => 'mini', //mini, tiny, small
		'options' => array( '' => esc_html_x( 'Standard', 'theme-options', 'babystreet' ),
		                    'babystreet-fullwidth-blog-pages' => esc_html_x( 'Fullwidth', 'theme-options', 'babystreet')
		)
	);
	$options[] = array(
			'name' => esc_html_x('Show Related Posts', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Display random posts from the same categories on single post page.', 'theme-options', 'babystreet'),
			'id' => 'show_related_posts',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Show Author Info on Blog Posts', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('If selected, Author section will be displayed below the post.', 'theme-options', 'babystreet'),
			'id' => 'show_author_info',
			'std' => '1',
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Show Author Avatar', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('If selected, Author avatar will be displayed on posts.', 'theme-options', 'babystreet'),
			'id' => 'show_author_avatar',
			'std' => '1',
			'type' => 'checkbox'
	);
	// Video background
	$options[] = array(
			'name' => esc_html_x('Enable YouTube video background for Blog page', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Check to enable below youtube video to be set as background on the Blog page.', 'theme-options', 'babystreet'),
			'id' => 'show_blog_video_bckgr',
			'std' => 0,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('YouTube Video URL', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Paste the YouTube URL.', 'theme-options', 'babystreet'),
			'id' => 'blog_video_bckgr_url',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Start Time', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Set the seconds the video should start at.', 'theme-options', 'babystreet'),
			'id' => 'blog_video_bckgr_start',
			'class' => 'mini',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('End Time', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Set the seconds the video should stop at.', 'theme-options', 'babystreet'),
			'id' => 'blog_video_bckgr_end',
			'class' => 'mini',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Loop', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Loops the movie once ended.', 'theme-options', 'babystreet'),
			'id' => 'blog_video_bckgr_loop',
			'std' => 1,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Mute', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Mute the audio.', 'theme-options', 'babystreet'),
			'id' => 'blog_video_bckgr_mute',
			'std' => 1,
			'type' => 'checkbox'
	);
	// Supersized
	$options[] = array(
			'name' => esc_html_x('Enable Supersized Slider on Blog Page', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Check to enable below slider to be set as background on the Blog page.', 'theme-options', 'babystreet'),
			'id' => 'show_blog_super_gallery',
			'std' => '0',
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Choose images for the Blog page supersized slider', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Use to manage / upload images.', 'theme-options', 'babystreet'),
			'id' => 'blog_supersized_images',
			'std' => '',
			'type' => 'babystreet_upload',
			'is_multiple' => true
	);
	/*
	 * SIDEBARS
	 */
	$options[] = array(
			'name' => esc_html_x('Sidebars', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'sidebars'
	);
	$options[] = array(
			'name' => esc_html_x('Sidebars Default Position', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Choose sitewide sidebars position. Can be changed in page/post edit.', 'theme-options', 'babystreet'),
			'id' => 'sidebar_position',
			'std' => 'babystreet-left-sidebar',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $sidebar_positions
	);
	$options[] = array(
			'name' => esc_html_x('Create new custom sidebar', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Enter the name of the custom sidebar.', 'theme-options', 'babystreet'),
			'id' => 'sidebar_ids',
			'std' => '',
			'type' => 'sidebar'
	);
	$options[] = array(
			'name' => esc_html_x('Sidebar for Blog, Archive and Category Pages', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Select sidebar to be displayed on Blog page and all post category, tag and search pages.', 'theme-options', 'babystreet'),
			'id' => 'blog_categoty_sidebar',
			'std' => 'right_sidebar',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $registered_sidebars_array
	);
	$options[] = array(
		'desc' => esc_html_x('Position', 'theme-options', 'babystreet'),
		'id' => 'blog_sidebar_position',
		'std' => 'default',
		'type' => 'select',
		'class' => '', //mini, tiny, small
		'options' => $sidebar_positions_with_default
	);
	$options[] = array(
			'name' => esc_html_x('Sidebar for Portfolio Archive and Category Pages', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Select sidebar to be displayed on all Portfolio Archive and Category Pages.', 'theme-options', 'babystreet'),
			'id' => 'portfolio_categoty_sidebar',
			'std' => 'none',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $registered_sidebars_array
	);
	if (defined('BABYSTREET_IS_WOOCOMMERCE') && BABYSTREET_IS_WOOCOMMERCE) {
		$default_shop_sdbr = 'none';
		if (array_key_exists('shop', $registered_sidebars_array)) {
			$default_shop_sdbr = 'shop';
		}
		$options[] = array(
				'name' => esc_html_x('Sidebar for WooCommerce part', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Select sidebar to be displayed on all WooCommerce pages that can have sidebar', 'theme-options', 'babystreet'),
				'id' => 'woocommerce_sidebar',
				'std' => $default_shop_sdbr,
				'type' => 'select',
				'class' => '', //mini, tiny, small
				'options' => $registered_sidebars_array
		);
		$options[] = array(
			'desc' => esc_html_x('Show sidebar on Shop and category pages.', 'theme-options', 'babystreet'),
			'id' => 'show_sidebar_shop',
			'std' => 0,
			'type' => 'checkbox'
		);
		$options[] = array(
			'desc' => esc_html_x('Position for the Shop and category pages sidebar.', 'theme-options', 'babystreet'),
			'id' => 'shop_sidebar_position',
			'std' => 'default',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $sidebar_positions_with_default
		);
		$options[] = array(
			'desc' => esc_html_x('Show sidebar on product pages.', 'theme-options', 'babystreet'),
			'id' => 'show_sidebar_product',
			'std' => 0,
			'type' => 'checkbox'
		);
		$options[] = array(
			'desc' => esc_html_x('Position for the Product pages sidebar.', 'theme-options', 'babystreet'),
			'id' => 'product_sidebar_position',
			'std' => 'default',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $sidebar_positions_with_default
		);
	}
	if (defined('BABYSTREET_IS_BBPRESS') && BABYSTREET_IS_BBPRESS) {
		$default_forum_sdbr = 'none';
		if (array_key_exists('babystreet_forum', $registered_sidebars_array)) {
			$default_forum_sdbr = 'babystreet_forum';
		}
		$options[] = array(
				'name' => esc_html_x('Sidebar for bbPress part', 'theme-options', 'babystreet'),
				'desc' => esc_html_x('Select sidebar to be displayed by default on all bbPress pages. May be overridden on specific forums and topics.', 'theme-options', 'babystreet'),
				'id' => 'bbpress_sidebar',
				'std' => $default_forum_sdbr,
				'type' => 'select',
				'class' => '', //mini, tiny, small
				'options' => $registered_sidebars_array
		);
	}
	if (defined('BABYSTREET_IS_EVENTS') && BABYSTREET_IS_EVENTS) {
		$default_events_sdbr = 'none';
		if (array_key_exists('right_sidebar', $registered_sidebars_array)) {
			$default_events_sdbr = 'right_sidebar';
		}
		$options[] = array(
			'name' => esc_html_x('Sidebar for Events Calendar part', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Select sidebar to be displayed by default on all Events Calendar pages. May be overridden on specific Events.', 'theme-options', 'babystreet'),
			'id' => 'events_sidebar',
			'std' => $default_events_sdbr,
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $registered_sidebars_array
		);
	}
	$options[] = array(
			'name' => esc_html_x('Off Canvas Sidebar', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Select sidebar to be displayed off canvas.', 'theme-options', 'babystreet'),
			'id' => 'offcanvas_sidebar',
			'std' => 'none',
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $registered_sidebars_array
	);
	$default_footer_sdbr = 'bottom_footer_sidebar';
	$options[] = array(
			'name' => esc_html_x('Footer Sidebar', 'theme-options', 'babystreet'),
			'desc' => esc_html_x('Select sidebar to be displayed in footer. May be overriden for the specific pages, posts and custom post types.', 'theme-options', 'babystreet'),
			'id' => 'footer_sidebar',
			'std' => $default_footer_sdbr,
			'type' => 'select',
			'class' => '', //mini, tiny, small
			'options' => $registered_sidebars_array
	);
	/*
	 * Social profiles settings
	 */
	$options[] = array(
			'name' => esc_html_x('Social Profiles', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'socialprofiles'
	);
	$options[] = array(
			'desc' => esc_html_x('Fill in your social profiles URLs and select where to appear.', 'theme-options', 'babystreet'),
			'type' => 'info'
	);
	$options[] = array(
			'name' => esc_html_x('Show in Header', 'theme-options', 'babystreet'),
			'id' => 'social_in_header',
			'desc' => esc_html_x('Show profiles in header.', 'theme-options', 'babystreet'),
			'std' => 0,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Show in Footer', 'theme-options', 'babystreet'),
			'id' => 'social_in_footer',
			'desc' => esc_html_x('Show profiles in footer.', 'theme-options', 'babystreet'),
			'std' => 0,
			'type' => 'checkbox'
	);
	$options[] = array(
			'name' => esc_html_x('Facebook Profile URL', 'theme-options', 'babystreet'),
			'id' => 'facebook_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Twitter Profile URL', 'theme-options', 'babystreet'),
			'id' => 'twitter_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Google+ Profile URL', 'theme-options', 'babystreet'),
			'id' => 'google_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('YouTube Profile URL', 'theme-options', 'babystreet'),
			'id' => 'youtube_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Vimeo Profile URL', 'theme-options', 'babystreet'),
			'id' => 'vimeo_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Dribbble Profile URL', 'theme-options', 'babystreet'),
			'id' => 'dribbble_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('LinkedIn Profile URL', 'theme-options', 'babystreet'),
			'id' => 'linkedin_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('StumbleUpon Profile URL', 'theme-options', 'babystreet'),
			'id' => 'stumbleupon_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Flickr Profile URL', 'theme-options', 'babystreet'),
			'id' => 'flicker_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Instagram Profile URL', 'theme-options', 'babystreet'),
			'id' => 'instegram_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Pinterest Profile URL', 'theme-options', 'babystreet'),
			'id' => 'pinterest_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('VKontakte Profile URL', 'theme-options', 'babystreet'),
			'id' => 'vkontakte_profile',
			'std' => '',
			'type' => 'text'
	);
	$options[] = array(
			'name' => esc_html_x('Behance Profile URL', 'theme-options', 'babystreet'),
			'id' => 'behance_profile',
			'std' => '',
			'type' => 'text'
	);
	/*
	 * Demo import
	 */
	$options[] = array(
			'name' => esc_html_x('Import Demo', 'theme-options', 'babystreet'),
			'type' => 'heading',
			'tab_id' => 'importdemo'
	);
	$options[] = array(
			'desc' => '<p><b>' . esc_html__('NOTE THAT THE IMPORT CAN OVERRIDE YOUR DATA AND SETTINGS.', 'babystreet') . '</b></p>' . sprintf(_x("<p><b>Make sure that the required plugins for the corresponding import are installed and activated.</b></p><p>Note also that the demo is using many images and takes longer to import. You may need to increase some of the PHP parameters, described here: %s . If for some reason is not possible to increase <i>max_execution_time</i> and still can't run the import, you may need to run it again, in order to import all the images.</p><p><b>Click the image of the desired demo to import.</b>The import can take several minutes. For best result use fresh WP installation.</p><p>You can use following plugin to reset WordPress: %s .</p>", 'theme-options', 'babystreet'), '<a href="http://althemist.com/are-you-sure-you-want-to-do-this/" target="_blank">Recommended settings for successfull import</a>', '<a href="https://wordpress.org/plugins/wordpress-reset/" target="_blank">WordPress Reset</a>'),
			'type' => 'info'
	);
	$options[] = array(
			'name' => esc_html_x('Import Babystreet Main Demo', 'theme-options', 'babystreet'),
			'desc' => sprintf(_x("<p><b>Demo Location:</b> %s <br/><b>NOTE:</b> Usually takes less than 3 minutes, but depending on the server it may take up to 10.</p><p><b>Required plugins for the import:</b><br/><b><a target=\"_blank\" href=\"https://wordpress.org/plugins/woocommerce/\">WooCommerce</a></b></p>", 'theme-options', 'babystreet'), '<a target="_blank" href="https://babystreet.althemist.com/demo-import/" >Babystreet Demo Import Site</a>'),
			'id' => 'import_babystreet0',
			'type' => 'images',
			'class' => 'import_babystreet_demo',
			'options' => array(
					'babystreet' => BABYSTREET_IMAGES_PATH . 'demo-image0.jpg'
			)
	);

	/*
	 * Babystreet Updates
	 */
	$options[] = array(
		'name' => esc_html_x('Babystreet Updates', 'theme-options', 'babystreet'),
		'type' => 'heading',
		'tab_id' => 'babystreetupdates'
	);

	if(defined('BABYSTREET_IS_ENVATO_MARKET') && BABYSTREET_IS_ENVATO_MARKET) {
		$options[] = array(
			'desc' => '<p>' . esc_html__( 'Babystreet automatic updates are managed by the Envato Market plugin (bundled with the theme).', 'babystreet' ) . '</p>' .
			          '<p><a class="babystreet-theme-updates" href="' . esc_url( admin_url( 'admin.php?page=envato-market' ) ) . '">' . esc_html_x( 'Manage your Envato purchased items', 'theme-options', 'babystreet' ) . '</a></p>',
			'type' => 'info'
		);
	} else {
		$options[] = array(
			'desc' => '<p>' . esc_html__( 'Babystreet automatic updates are managed by the Envato Market plugin (bundled with the theme).', 'babystreet' ) . '</p><p>' .
			          esc_html_x( 'Please install and activate "Envato Market" in order to manage all your WordPress themes and plugins purchased from Envato.', 'theme-options', 'babystreet' ) .
			          '</p><p><a class="babystreet-theme-updates" href="' . esc_url( admin_url( 'admin.php?page=tgmpa-install-plugins' ) ) . '">' . esc_html_x( 'Install/Activate Envato Market plugin', 'theme-options', 'babystreet' ) . '</a></p>',
			'type' => 'info'
		);
	}

	return $options;
}
