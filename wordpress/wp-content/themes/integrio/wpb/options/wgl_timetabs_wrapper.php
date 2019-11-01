<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

if (function_exists('vc_map')) {
	vc_map(array(
		'name' => esc_html__('Time Tabs', 'integrio'),
		'base' => 'wgl_timetabs_wrapper',
		'class' => 'integrio_time_line_vertical',
		'category' => esc_html__('WGL Modules', 'integrio'),
		'icon' => 'wgl_icon_time_tabs',
		'as_parent' => array('only' => 'wgl_timetabs_container'),
		'content_element' => true,
		'show_settings_on_create' => false,
		'is_container' => true,
		'description' => esc_html__('Place Time Tabs','integrio'),
		'params' => array(
			// Title customize
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__('Title Customize', 'integrio'),
				'param_name' => 'h_title_colors',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Title colors
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Title Custom Color', 'integrio' ),
				'param_name' => 'title_custom_color',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Title Color', 'integrio'),
				'param_name' => 'title_color',
				'value' => $header_font_color,
				'description' => esc_html__('Select custom color', 'integrio'),
				'dependency' => array(
					'element' => 'title_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Title Hover Color', 'integrio'),
				'param_name' => 'title_color_hover',
				'value' => $header_font_color,
				'description' => esc_html__('Select custom color', 'integrio'),
				'dependency' => array(
					'element' => 'title_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon customize
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__('Icon Customize', 'integrio'),
				'param_name' => 'h_icon_colors',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Icon Custom Color', 'integrio' ),
				'param_name' => 'icon_custom_color',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Icon Color', 'integrio'),
				'param_name' => 'icon_color',
				'value' => $theme_color,
				'description' => esc_html__('Select custom color', 'integrio'),
				'dependency' => array(
					'element' => 'icon_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Icon Hover Color', 'integrio'),
				'param_name' => 'icon_color_hover',
				'value' => $theme_color,
				'description' => esc_html__('Select custom color', 'integrio'),
				'dependency' => array(
					'element' => 'icon_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
		),
		'js_view' => 'VcColumnView'
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_wgl_timetabs_wrapper extends WPBakeryShortCodesContainer {
		}
	}
}