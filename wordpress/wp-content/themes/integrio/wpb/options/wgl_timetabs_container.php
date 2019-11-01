<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
	vc_map(array(
		'name'		=> esc_html__('Time Tab Container', 'integrio'),
		'base'		=> 'wgl_timetabs_container',
		'class'		=> 'integrio_time_line_vertical',
		'category'	=> esc_html__('WGL Modules', 'integrio'),
		'icon'		=> 'wgl_icon_vertical-timeline',
		'as_child'  => array('only' => 'wgl_timetabs_wrapper'),
		'as_parent' => array('only' => 'wgl_counter, wgl_button, vc_column_text, wgl_pricing_table, wgl_info_box, wgl_custom_text, vc_single_image, vc_tta_tabs, vc_tta_accordion, vc_images_carousel, vc_gallery, vc_message, vc_row, wgl_flip_box, wgl_portfolio_list, wgl_team, wgl_blog_posts_standard'),
		'content_element' => true,
		'is_container' 	  => true,
		'description'	  => esc_html__('Container for tab items','integrio'),
		'params' => array(
			array(
                'type' => 'dropdown',
                'param_name' => 'icon_type',
                'heading' => esc_html__( 'Media', 'integrio' ),
                'value' => array(
                    esc_html__( 'None', 'integrio' )  => 'none',
                    esc_html__( 'Font', 'integrio' )  => 'font',
                    esc_html__( 'Image', 'integrio' ) => 'image',
                ),
                'save_always' => true,
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'icon_font_type',
                'value' => array(
                    esc_html__( 'Flaticon', 'integrio' )    => 'type_flaticon',
                    esc_html__( 'Fontawesome', 'integrio' ) => 'type_fontawesome',
                ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_fontawesome',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_flaticon',
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon
                    'type' => 'flaticon',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_flaticon',
                ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'integrio' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
            ),
			array(
				'type'		  => 'textfield',
				'heading'	  => esc_html__('Tab Title', 'integrio'),
				'param_name'  => 'tab_title',
				'admin_label' => true,
				'value'		  => '',
				'save_always' => true,
			),
			array(
				'type'		 => 'el_id',
				'heading' 	 => esc_html__( 'Tab ID', 'integrio' ),
				'param_name' => 'tab_id',
				'settings' 	 => array(
					'auto_generate' => true,
				),
			),
		),
		'js_view' => 'VcColumnView'
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_wgl_timetabs_container extends WPBakeryShortCodesContainer {
		}
	}
}