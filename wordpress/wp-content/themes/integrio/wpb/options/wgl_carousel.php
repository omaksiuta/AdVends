<?php

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'base' => 'wgl_carousel',
        'name' => esc_html__( 'Carousel', 'integrio' ),
		'class' => 'integrio_carousel_module',
        'content_element' => true,      
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_carousel',
        'show_settings_on_create' => true,
        'is_container' => true,
		'as_parent' => array( 'only' => 'wgl_counter, wgl_button, vc_column_text, wgl_pricing_table, wgl_info_box, wgl_custom_text, vc_single_image, vc_tta_tabs, vc_tta_tour, vc_tta_accordion, vc_images_carousel, vc_gallery, vc_message, vc_row, wgl_flip_box, wgl_info_box, wgl_services_2, wgl_services_3, wgl_services_4, wgl_services' ),
        'params' => array(
            // GENERAL TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Columns Amount', 'integrio' ),
				'param_name' => 'slide_to_show',
				'value' => array(
					esc_html__( '1', 'integrio' ) => '1',
					esc_html__( '2', 'integrio' ) => '2',
					esc_html__( '3', 'integrio' ) => '3',
					esc_html__( '4', 'integrio' ) => '4',
					esc_html__( '5', 'integrio' ) => '5',
					esc_html__( '6', 'integrio' ) => '6',
				),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
			    'type' => 'integrio_param_heading',
			    'param_name' => 'divider_1',
			    'edit_field_class' => 'divider',
			),
			array(
			    'type' => 'textfield',
			    'heading' => esc_html__( 'Animation Speed', 'integrio' ),
			    'param_name' => 'speed',
			    'value' => '300',
			    'description' => esc_html__( 'Enter value in milliseconds.', 'integrio' ),
			    'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'integrio' ),
				'param_name' => 'autoplay',
				'value' => 'true',
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Autoplay Speed', 'integrio' ),
				'param_name' => 'autoplay_speed',
				'value' => '3000',
				'description' => esc_html__( 'Enter value in milliseconds.', 'integrio' ),
				'dependency' => array(
					'element' => 'autoplay',
					'value' => 'true'
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_2',
                'edit_field_class' => 'divider',
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Slide One Item per time', 'integrio' ),
				'param_name' => 'slides_to_scroll',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Infinite loop sliding', 'integrio' ),
				'param_name' => 'infinite',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Adaptive Height', 'integrio' ),
				'param_name' => 'adaptive_height',
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Fade Animation', 'integrio' ),
				'param_name' => 'fade_animation',
				'dependency' => array(
					'element' => 'slide_to_show',
					'value' => '1'
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            // NAVIGATION TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Pagination Controls', 'integrio' ),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'integrio' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'std' => 'true'
            ),
            array(
                'type' => 'integrio_radio_image',
                'heading' => esc_html__( 'Pagination Type', 'integrio' ),
                'param_name' => 'pag_type',
                'fields' => array(
                    'circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
                        'label' => esc_html__( 'Circle', 'integrio' )),
                    'circle_border' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
                        'label' => esc_html__( 'Empty Circle', 'integrio' )),
                    'square' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
                        'label' => esc_html__( 'Square', 'integrio' )),
                    'line' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
                        'label' => esc_html__( 'Line', 'integrio' )),
                    'line_circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
                        'label' => esc_html__( 'Line - Circle', 'integrio' )),
                ),
                'value' => 'circle',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Navigation', 'integrio' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Pagination Aligning', 'integrio' ),
                'param_name' => 'pag_align',
                'value' => array(
                    esc_html__( 'Left', 'integrio' ) => 'left',
                    esc_html__( 'Right', 'integrio' ) => 'right',
                    esc_html__( 'Center', 'integrio' ) => 'center',
                ),
                'std' => 'center',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'integrio' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_3',
				'group' => esc_html__( 'Navigation', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'integrio' ),
                'param_name' => 'custom_pag_color',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Navigation', 'integrio' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Pagination Color', 'integrio' ),
                'param_name' => 'pag_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel prev/next heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Prev/Next Buttons', 'integrio' ),
                'param_name' => 'h_prev_buttons',
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Prev/Next buttons', 'integrio' ),
                'param_name' => 'use_prev_next',
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom offset', 'integrio' ),
                'param_name' => 'custom_prev_next_offset',
                 'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-2',
                'group' => esc_html__( 'Navigation', 'integrio' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Buttons Top Offset', 'integrio' ),
                'param_name' => 'prev_next_offset',
                'value' => '50%',
                'description' => esc_html__( 'Value in percentages.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_prev_next_offset',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_4',
				'group' => esc_html__( 'Navigation', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_prev_next_color',
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Prev/Next Buttons Color', 'integrio' ),
                'param_name' => 'prev_next_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Buttons Background Color', 'integrio' ),
                'param_name' => 'prev_next_bg_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Navigation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // RESPONSIVE TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'integrio' ),
                'param_name' => 'custom_resp',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Responsive', 'integrio' ),
            ),
            // Desktop breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Desktop Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_5',
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // Tablet breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablet Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_6',
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // Mobile breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Mobile Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),			
        ),
		'js_view' => 'VcColumnView'
    ));


    if (class_exists( 'WPBakeryShortCodesContainer' )) {
        class WPBakeryShortCode_wgl_carousel extends WPBakeryShortCodesContainer {}
    }
}