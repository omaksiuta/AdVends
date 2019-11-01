<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
	vc_map(array(
		'name'		=> esc_html__('Left Slide', 'integrio'),
		'base'		=> 'wgl_split_slider_left',
		'class'		=> 'integrio_split_slider_left_module vc_col-sm-6',
		'category'	=> esc_html__('WGL Modules', 'integrio'),
		'icon'		=> 'wgl_icon_carousel',
		'as_child'  => array('only' => 'wgl_split_slider'),
		'as_parent' => array('only' => 'wgl_split_slider_item'),
		'content_element' => true,
		'show_settings_on_create' => false,
		'is_container' 	  => true,
		'params' => array(
		),
		'js_view' => 'VcColumnView'
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_wgl_split_slider_left extends WPBakeryShortCodesContainer {
		}
	}
}