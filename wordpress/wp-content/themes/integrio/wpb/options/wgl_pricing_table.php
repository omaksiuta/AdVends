<?php
if ( !defined('ABSPATH') ) { die('-1'); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(Integrio_Theme_Helper::get_option('main-font')['color']);
$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);

if (function_exists('vc_map')) {
	vc_map(array(
		'name' => esc_html__( 'Pricing Table', 'integrio' ),
		'base' => 'wgl_pricing_table',
		'class' => 'integrio_pricing_table',
		'category' => esc_html__( 'WGL Modules', 'integrio' ),
		'icon' => 'wgl_icon_price_table',
		'content_element' => true,
		'description' => esc_html__( 'Place Pricing Table', 'integrio' ),
		'params' => array(
			// GENERAL TAB
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'integrio' ),
				'param_name' => 'pricing_title',
				'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Currency', 'integrio' ),
				'param_name' => 'pricing_cur',
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Price', 'integrio' ),
				'param_name' => 'pricing_price',
				'edit_field_class' => 'vc_col-sm-2',
				'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Description', 'integrio' ),
				'param_name' => 'pricing_desc',
				'edit_field_class' => 'vc_col-sm-8',
			),
			// Add highlighting element
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add highlighting element', 'integrio' ),
				'param_name' => 'add_highlighter',
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Highlighter text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Highlighter Title', 'integrio' ),
				'param_name' => 'highlighter_title',
				'value' => 'RECOMENDED',
				'dependency' => array(
					'element' => 'add_highlighter',
					'value' => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Hover animation checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable hover animation', 'integrio' ),
				'param_name' => 'hover_animation',
				'value' => 'true',
				'description' => esc_html__( 'Lift up the item on hover.', 'integrio' ),
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'integrio' ),
				'param_name' => 'extra_class',
				'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
			),
			// ICON TAB
			// Add icon/image
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Add Icon/Image', 'integrio' ),
				'param_name' => 'icon_type',
				'value' => array(
					esc_html__( 'None', 'integrio' ) => '',
					esc_html__( 'Icon', 'integrio' ) => 'font',
					esc_html__( 'Image', 'integrio' ) => 'image',
				),
				'save_always' => true,
				'group' => esc_html__( 'Icon', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon pack dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon Pack', 'integrio' ),
				'param_name' => 'icon_pack',
				'value' => array(
					esc_html__( 'Fontawesome', 'integrio' ) => 'fontawesome',
					esc_html__( 'Flaticon', 'integrio' ) => 'flaticon',
				),
				'save_always' => true,
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font',
				),
				'group' => esc_html__( 'Icon', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-padding',
			),
			// Icon size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Icon Size', 'integrio' ),
				'param_name' => 'custom_icon_size',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font',
				),
				'group' => esc_html__( 'Icon', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-padding',
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'integrio' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an 'EMPTY' icon?
					'iconsPerPage' => 200, // default 100, how many icons will be displayed per page. Use big number to display all icons in single page
				),
				'description' => esc_html__( 'Select icon from library.', 'integrio' ),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'fontawesome',
				),
				'group' => esc_html__( 'Icon', 'integrio' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'integrio' ),
				'param_name' => 'icon_flaticon',
				'value' => '',
				'settings' => array(
					'emptyIcon' => false,
					'type' => 'flaticon',
					'iconsPerPage' => 200,
				),
				'description' => esc_html__( 'Select icon from library.', 'integrio' ),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'flaticon',
				),
				'group' => esc_html__( 'Icon', 'integrio' ),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'integrio' ),
				'param_name' => 'thumbnail',
				'value' => '',
				'description' => esc_html__( 'Choose image from media library.', 'integrio' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'image',
				),
				'group' => esc_html__( 'Icon', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-8 no-top-padding',
			),
			// Custom image width
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Image Width', 'integrio' ),
				'param_name' => 'custom_image_width',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'image',
				),
				'group' => esc_html__( 'Icon', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Custom image height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Image Height', 'integrio' ),
				'param_name' => 'custom_image_height',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'image',
				),
				'group' => esc_html__( 'Icon', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// CONTENT TAB
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__( 'Content.', 'integrio' ),
				'param_name' => 'content',
				'holder' => 'div',
				'admin_label' => false,
				'group' => esc_html__( 'Content', 'integrio' ),
			),
			// Description
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Description Text', 'integrio' ),
				'param_name' => 'descr_text',
				'group' => esc_html__( 'Content', 'integrio' ),
			),
			// Add button heading
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'CTA Button', 'integrio' ),
				'param_name' => 'h_button',
				'group' => esc_html__( 'Content', 'integrio' ),
			),
			// Button text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text', 'integrio' ),
				'param_name' => 'button_title',
				'value' => esc_html__( 'Choose Plan', 'integrio' ),
				'group' => esc_html__( 'Content', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button link
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Button Link', 'integrio' ),
				'param_name' => 'link',
				'group' => esc_html__( 'Content', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			// COLORS TAB
			// Header section customization
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Header Section', 'integrio' ),
				'param_name' => 'h_pricing_customize',
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Title color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Title', 'integrio' ),
				'param_name' => 'custom_title_color',
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Title color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title Color', 'integrio' ),
				'param_name' => 'title_color',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'custom_title_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_1',
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Price color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Price', 'integrio' ),
				'param_name' => 'custom_price_color',
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Price currency color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Currency Color', 'integrio' ),
				'param_name' => 'currency_color',
				'value' => $header_font_color,
				'dependency' => array(
					'element' => 'custom_price_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Price color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Price Color', 'integrio' ),
				'param_name' => 'price_color',
				'value' => $header_font_color,
				'dependency' => array(
					'element' => 'custom_price_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_2',
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			//  Description color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Description', 'integrio' ),
				'param_name' => 'custom_description_color',
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Description color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Description Color', 'integrio' ),
				'param_name' => 'description_color',
				'value' => '#939393',
				'dependency' => array(
					'element' => 'custom_description_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Sections backgrounds custom\ization heading
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Sections Backgrounds', 'integrio' ),
				'param_name' => 'h_backgrounds_customization',
				'group' => esc_html__( 'Colors', 'integrio' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pricing Table Customization', 'integrio' ),
				'param_name' => 'pricing_customize',
				'value' => array(
					esc_html__( 'Theme Defaults', 'integrio' ) => 'def',
					esc_html__( 'Color', 'integrio' ) => 'color',
					esc_html__( 'Image', 'integrio' ) => 'image',
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Pricing table bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Pricing Table Background', 'integrio' ),
				'param_name' => 'pricing_bg_color',
				'value' => '#fcf5f0',
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Pricing table bg image
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Pricing Table Background Image', 'integrio' ),
				'param_name'  => 'pricing_bg_image',
				'value' => '',
				'description' => esc_html__( 'Choose image from media library.', 'integrio' ),
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => 'image',
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_3',
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Header section dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Header Customization', 'integrio' ),
				'param_name' => 'header_customize',
				'value' => array(
					esc_html__( 'Theme Defaults', 'integrio' ) => '',
					esc_html__( 'Color', 'integrio' ) => 'color',
					esc_html__( 'Image', 'integrio' ) => 'image',
					esc_html__( 'Gradient', 'integrio' ) => 'gradient',
				),
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Header bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Header Background', 'integrio' ),
				'param_name' => 'header_bg_color',
				'value' => '#f7f9fd',
				'dependency' => array(
					'element' => 'header_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Header bg image
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Header Background Image', 'integrio' ),
				'param_name'  => 'header_bg_image',
				'value' => '',
				'description' => esc_html__( 'Choose image from media library.', 'integrio' ),
				'dependency' => array(
					'element' => 'header_customize',
					'value' => 'image',
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'integrio' ),
				'param_name' => 'bg_gradient_idle_start',
				'value' =>  $theme_gradient_start,
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'header_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'integrio' ),
				'param_name' => 'bg_gradient_idle_end',
				'value' =>  $theme_gradient_end,
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'header_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_4',
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Content section dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Content Customization', 'integrio' ),
				'param_name' => 'content_customize',
				'value' => array(
					esc_html__( 'Theme Defaults', 'integrio' ) => '',
					esc_html__( 'Color', 'integrio' ) => 'color',
				),
				'dependency' => array(
					'element' => 'pricing_customize',
					'value'   => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Content bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Content Background', 'integrio' ),
				'param_name'  => 'content_bg_color',
				'value' => '#f7f9fd',
				'dependency' => array(
					'element' => 'content_customize',
					'value' => array( 'color' )
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_5',
				'dependency' => array(
					'element' => 'pricing_customize',
					'value' => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Footer section dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Footer Customization', 'integrio' ),
				'param_name' => 'footer_customize',
				'value' => array(
					esc_html__( 'Theme Defaults', 'integrio' ) => '',
					esc_html__( 'Color', 'integrio' ) => 'color',
				),
				'dependency' => array(
					'element' => 'pricing_customize',
					'value' => array('def', 'color'),
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Footer bg colorpicker
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Footer Background', 'integrio' ),
				'param_name'  => 'footer_bg_color',
				'value' => '#f7f9fd',
				'dependency' => array(
					'element' => 'footer_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Button colors
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Button', 'integrio' ),
				'param_name' => 'h_button_colors',
				'group' => esc_html__( 'Colors', 'integrio' ),
			),
			// Button customization dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customization', 'integrio' ),
				'param_name' => 'button_customize',
				'value' => array(
					esc_html__( 'Theme Defaults', 'integrio' ) => 'def',
					esc_html__( 'Flat Colors', 'integrio' ) => 'color',
					esc_html__( 'Gradient Colors', 'integrio' ) => 'gradient',
				),
				'std' => 'color',
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_6',
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Button text color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Text Color Idle', 'integrio' ),
				'param_name' => 'button_text_color',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => array( 'color', 'gradient' )
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button text color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Text Color Hover', 'integrio' ),
				'param_name' => 'button_text_color_hover',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'button_customize',
					'value' => array( 'color', 'gradient' )
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			// Button bg idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'integrio' ),
				'param_name' => 'button_bg_color',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Hover', 'integrio' ),
				'param_name' => 'button_bg_color_hover',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'integrio' ),
				'param_name' => 'button_bg_gradient_idle_start',
				'value' => '#ffffff',
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'integrio' ),
				'param_name' => 'button_bg_gradient_idle_end',
				'value' => '#ffffff',
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'integrio' ),
				'param_name' => 'button_bg_gradient_hover_start',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Hover State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'integrio' ),
				'param_name' => 'button_bg_gradient_hover_end',
				'value' => $theme_gradient_end,
				'description' => esc_html__( 'For Hover State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_7',
				'dependency' => array(
					'element' => 'button_customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Button border color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Color Idle', 'integrio' ),
				'param_name' => 'button_border_color',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Color Hover', 'integrio' ),
				'param_name' => 'button_border_color_hover',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'integrio' ),
				'param_name' => 'button_border_gradient_idle_start',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'integrio' ),
				'param_name' => 'button_border_gradient_idle_end',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'integrio' ),
				'param_name' => 'button_border_gradient_hover_start',
				'value' => $theme_gradient_start,
				'description' => esc_html__( 'For Hover State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'integrio' ),
				'param_name' => 'button_border_gradient_hover_end',
				'value' => $theme_gradient_end,
				'description' => esc_html__( 'For Hover State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color heading
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Icon', 'integrio' ),
				'param_name' => 'h_icon_color',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font',
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
			),
			// Icon color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'integrio' ),
				'param_name' => 'custom_icon_color',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font',
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Color', 'integrio' ),
				'param_name' => 'icon_color',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'custom_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// TYPOGRAPHY TAB
			// Title styles heading
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Title Styles', 'integrio' ),
				'param_name' => 'h_title_styles',
				'group' => esc_html__( 'Typography', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Title font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'integrio' ),
				'param_name' => 'title_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'group' => esc_html__( 'Typography', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Title font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Font Weight', 'integrio' ),
                'param_name' => 'title_weight',
                'value' => array(
                    esc_html__( 'Theme Default', 'integrio' ) => '',
                    esc_html__( '300 / Light', 'integrio' ) => '300',
                    esc_html__( '400 / Regular', 'integrio' ) => '400',
                    esc_html__( '500 / Medium', 'integrio' ) => '500',
                    esc_html__( '600 / SemiBold', 'integrio' ) => '600',
                    esc_html__( '700 / Bold', 'integrio' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'integrio' ) => '800',
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'description' => esc_html__( 'Select custom value.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			// Title fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'integrio' ),
				'param_name' => 'custom_fonts_title',
				'group' => esc_html__( 'Typography', 'integrio' ),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_title',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_title',
					'value' => 'true',
				),
				'group' => esc_html__( 'Typography', 'integrio' ),
			),
			// Price styles 
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Price Styles', 'integrio' ),
				'param_name' => 'h_content_styles',
				'group' => esc_html__( 'Typography', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Price font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'integrio' ),
				'param_name' => 'price_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'group' => esc_html__( 'Typography', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Pricing description styles
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Descriptions Styles', 'integrio' ),
				'param_name' => 'description_styles',
				'group' => esc_html__( 'Typography', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Description font size 
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'integrio' ),
				'param_name' => 'description_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'group' => esc_html__( 'Typography', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
		)
	));

	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_wgl_Pricing_Table extends WPBakeryShortCode {}
	}
}
