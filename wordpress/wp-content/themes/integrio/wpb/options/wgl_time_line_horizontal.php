<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Integrio_Theme_Helper::get_option('theme-secondary-color'));

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Time Line Horizontal', 'integrio' ),
        'base' => 'wgl_time_line_horizontal',
        'class' => 'integrio_time_line_horizontal',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_horizont-timeline',
        'content_element' => true,
        'description' => esc_html__( 'Display Time Line Horizontal','integrio' ),
        'params' => array(
            array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Time Line Items', 'integrio' ),
				'param_name' => 'values',
				'description' => esc_html__( 'Enter values for each item, such as thumbnail, title, description and date.', 'integrio' ),
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Thumbnail', 'integrio' ),
						'param_name' => 'thumbnail',
						'edit_field_class' => 'vc_col-sm-10',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Date', 'integrio' ),
						'param_name' => 'date',
						'edit_field_class' => 'vc_col-sm-10',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'integrio' ),
						'param_name' => 'title',
						'edit_field_class' => 'vc_col-sm-10',
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Description', 'integrio' ),
						'param_name' => 'descr',
						'edit_field_class' => 'vc_col-sm-10',
					),
					array(
						'type' => 'wgl_checkbox',
						'heading' => esc_html__( 'Customize Colors', 'integrio' ),
						'param_name' => 'custom_item_colors',
						'edit_field_class' => 'vc_col-sm-3',
					),
					array(
						'type' => 'colorpicker', 
						'heading' => esc_html__( 'Circle Background', 'integrio' ),
						'param_name' => 'circle_background',
						'value' => '#ffffff',
						'dependency' => array(
							'element' => 'custom_item_colors',
							'value' => 'true'
						),
						'edit_field_class' => 'vc_col-sm-3',
					),
					array(
						'type' => 'colorpicker', 
						'heading' => esc_html__( 'Icon Color', 'integrio' ),
						'param_name' => 'icon_color',
						'value' => '#dae3f4',
						'dependency' => array(
							'element' => 'custom_item_colors',
							'value' => 'true'
						),
						'edit_field_class' => 'vc_col-sm-3',
					),
                ),
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Сrossline', 'integrio' ),
				'param_name' => 'custom_crossline',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Сrossline Сolor', 'integrio' ),
				'param_name' => 'crossline_color',
				'value' => '#dbe4f4',
				'dependency' => array(
					'element' => 'custom_crossline',
					'value' => 'true'
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Appear Animation', 'integrio' ),
				'param_name' => 'appear_anim',
				'std' => 'true',
			),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            // CAROUSEL TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Cloumns Amount', 'integrio' ),
                'param_name' => 'slide_to_show',
                'value' => array(
                    esc_html__( '1', 'integrio' ) => '1',
                    esc_html__( '2', 'integrio' ) => '2',
                    esc_html__( '3', 'integrio' ) => '3',
                    esc_html__( '4', 'integrio' ) => '4',
                    esc_html__( '5', 'integrio' ) => '5',
                    esc_html__( '6', 'integrio' ) => '6',
                ),           
                'std' => '4',   
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Slide one item at a time', 'integrio' ),
                'param_name' => 'slides_to_scroll',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Autoplay', 'integrio' ),
                'param_name' => 'autoplay',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-1 no-top-padding',
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
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            // carousel pagination heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Pagination Controls', 'integrio' ),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'integrio' ),
                'param_name' => 'use_pagination',
                'std' => 'true',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
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
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'value' => 'circle',
            ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pagination Alignment', 'integrio' ),
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
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Pagination Top Offset', 'integrio' ),
				'param_name' => 'pag_offset',
				'value' => '',
				'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
				'dependency' => array(
					'element' => 'use_pagination',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_c_1',
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_pag_color',
                'dependency' => array(
                	'element' => 'use_pagination',
                	'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
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
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // RESPONSIVE TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'integrio' ),
                'param_name' => 'custom_resp',
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Desktop breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Desktop Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
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
				'param_name' => 'divider_r_1',
				'group' => esc_html__( 'Responsive', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            // Tablets breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablets Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
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
				'param_name' => 'divider_r_2',
				'group' => esc_html__( 'Responsive', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            // Mobile breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Mobile Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
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
        )
    ));

    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_Time_Line_Horizontal extends WPBakeryShortCode {
        }
    }
}
