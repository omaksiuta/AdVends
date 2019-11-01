<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

if (function_exists( 'vc_map' )) {
	vc_map(array(
		'name' => esc_html__( 'Testimonials', 'integrio' ),
		'base' => 'wgl_testimonials',
		'class' => 'integrio_testimonials',
		'category' => esc_html__( 'WGL Modules', 'integrio' ),
		'icon' => 'wgl_icon_testimonial',
		'content_element' => true,
		'description' => esc_html__( 'Represent clients feedback.','integrio' ),
		'params' => array(
			// GENERAL TAB
			array(
				'type' => 'integrio_radio_image',
				'heading' => esc_html__( 'Overall Layout', 'integrio' ),
				'param_name' => 'item_type',
				'fields' => array(
					'author_top' => array(
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_1.png',
						'label' => esc_html__( 'Top', 'integrio' )),
					'author_bottom' => array(
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_4.png',
						'label' => esc_html__( 'Bottom', 'integrio' )),
					'inline_top' => array(
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_2.png',
						'label' => esc_html__( 'Top Inline', 'integrio' )),
					'inline_bottom' => array(
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_3.png',
						'label' => esc_html__( 'Bottom Inline', 'integrio' )),
				),
				'value' => 'author_top',
				'admin_label' => true,
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Grid Columns Amount', 'integrio' ),
				'param_name' => 'item_grid',
				'value' => array(
					esc_html__( 'One Column', 'integrio' ) => '1',
					esc_html__( 'Two Columns', 'integrio' ) => '2',
					esc_html__( 'Three Columns', 'integrio' ) => '3',
					esc_html__( 'Four Columns', 'integrio' ) => '4',
					esc_html__( 'Five Columns', 'integrio' ) => '5',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_1',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'integrio' ),
				'param_name' => 'item_align',
				'value' => array(
					esc_html__( 'Left', 'integrio' ) => 'left',
					esc_html__( 'Center', 'integrio' ) => 'center',
					esc_html__( 'Right', 'integrio' ) => 'right',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_2',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable Hover Animation', 'integrio' ),
				'param_name' => 'hover_animation',
				'description' => esc_html__( 'Lift up the item on hover.', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_3',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Background Image', 'integrio' ),
				'param_name' => 'add_bg_image',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', 'integrio' ),
				'param_name' => 'bg_image',
				'dependency' => array(
					'element' => 'add_bg_image',
					'value' => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'integrio' ),
				'param_name' => 'extra_class',
				'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Items', 'integrio' ),
				'description' => esc_html__( 'Enter values for each item - thumbnail, quote, author name, author position.', 'integrio' ),
				'param_name' => 'values',
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Thumbnail image', 'integrio' ),
						'param_name' => 'thumbnail',
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Quote', 'integrio' ),
						'param_name' => 'quote',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Author Name', 'integrio' ),
						'param_name' => 'author_name',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Author Position', 'integrio' ),
						'param_name' => 'author_position',
					),
				),
				'group' => esc_html__( 'Items', 'integrio' ),
			),
			// Thumbnail image dimensions
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Thumbnail Image Dimensions', 'integrio' ),
				'param_name' => 'h_image_styles',
				'group' => esc_html__( 'Items', 'integrio' ),
			),
			// Thumbnail width
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Width', 'integrio' ),
				'param_name' => 'custom_img_width',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'group' => esc_html__( 'Items', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Thumbnail height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Height', 'integrio' ),
				'param_name' => 'custom_img_height',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'group' => esc_html__( 'Items', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Thumbnail border radius
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Border Radius', 'integrio' ),
				'param_name' => 'custom_img_radius',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'group' => esc_html__( 'Items', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// STYLES TAB
			// Quote styles
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Quote', 'integrio' ),
				'param_name' => 'h_quote_styles',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'HTML Tag', 'integrio' ),
                'param_name' => 'quote_tag',
                'value' => array(
                    esc_html__( '‹div›', 'integrio' )  => 'div',
                    esc_html__( '‹span›', 'integrio' ) => 'span',
                    esc_html__( '‹h2›', 'integrio' )   => 'h2',
                    esc_html__( '‹h3›', 'integrio' )   => 'h3',
                    esc_html__( '‹h4›', 'integrio' )   => 'h4',
                    esc_html__( '‹h5›', 'integrio' )   => 'h5',
                    esc_html__( '‹h6›', 'integrio' )   => 'h6',
                ),
                'std' => 'div',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'description' => esc_html__( 'Select custom tag.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// Quote font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'integrio' ),
				'param_name' => 'quote_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_s_1',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Quote font
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'integrio' ),
				'param_name' => 'custom_fonts_quote',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_quote',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_quote',
					'value' => 'true',
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_s_2',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Quote color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Color', 'integrio' ),
				'param_name' => 'custom_quote_color',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Quote colorpicker
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Quote Color', 'integrio' ),
				'param_name' => 'quote_color',
				'value' => '#606568',
				'dependency' => array(
					'element' => 'custom_quote_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_s_3',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Quote icon color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom Quote Icon Color', 'integrio' ),
				'param_name' => 'custom_quote_icon_color',
				'dependency' => array(
					'element' => 'item_type',
					'value' => array( 'inline_top', 'inline_bottom' )
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Quote icon color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Quote Icon Color', 'integrio' ),
				'param_name' => 'quote_icon_color',
				'value' => $theme_color_secondary,
				'dependency' => array(
					'element' => 'custom_quote_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author name styles
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Author Name', 'integrio' ),
				'param_name' => 'h_name_styles',
				'group' => esc_html__( 'Styles', 'integrio' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'HTML Tag', 'integrio' ),
				'param_name' => 'name_tag',
				'value' => array(
                    esc_html__( '‹div›', 'integrio' )  => 'div',
                    esc_html__( '‹span›', 'integrio' ) => 'span',
                    esc_html__( '‹h2›', 'integrio' )   => 'h2',
                    esc_html__( '‹h3›', 'integrio' )   => 'h3',
                    esc_html__( '‹h4›', 'integrio' )   => 'h4',
                    esc_html__( '‹h5›', 'integrio' )   => 'h5',
                    esc_html__( '‹h6›', 'integrio' )   => 'h6',
				),
				'std' => 'h3',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'description' => esc_html__( 'Select your html tag.', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author name Font Size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name Font Size', 'integrio' ),
				'param_name' => 'name_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_s_4',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Author name color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'integrio' ),
				'param_name' => 'custom_name_color',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author name color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Author Name Color', 'integrio' ),
				'param_name' => 'name_color',
				'value' => '#000000',
				'dependency' => array(
					'element' => 'custom_name_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author name Fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'integrio' ),
				'param_name' => 'custom_fonts_name',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_name',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_name',
					'value' => 'true',
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_s_5',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Author position styles heading
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Author Position', 'integrio' ),
				'param_name' => 'h_status_styles',
				'group' => esc_html__( 'Styles', 'integrio' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'HTML Tag', 'integrio' ),
				'param_name' => 'position_tag',
				'value' => array(
                    esc_html__( '‹span›', 'integrio' ) => 'span',
                    esc_html__( '‹div›', 'integrio' ) => 'div',
                    esc_html__( '‹h2›', 'integrio' ) => 'h2',
                    esc_html__( '‹h3›', 'integrio' ) => 'h3',
                    esc_html__( '‹h4›', 'integrio' ) => 'h4',
                    esc_html__( '‹h5›', 'integrio' ) => 'h5',
                    esc_html__( '‹h6›', 'integrio' ) => 'h6',
				),
				'std' => 'span',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'description' => esc_html__( 'Select custom tag.', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author position font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'integrio' ),
				'param_name' => 'position_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_s_6',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Author position fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'integrio' ),
				'param_name' => 'custom_fonts_status',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_status',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_status',
					'value' => 'true',
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_s_7',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Author position color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Color', 'integrio' ),
				'param_name' => 'custom_position_color',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author position color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Author Position Color', 'integrio' ),
				'param_name' => 'position_color',
				'value' => '#9a9a9a',
				'dependency' => array(
					'element' => 'custom_position_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Date styles heading
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Date Stamp', 'integrio' ),
				'param_name' => 'h_data_styles',
				'group' => esc_html__( 'Styles', 'integrio' ),
			),
			// Date font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'integrio' ),
				'param_name' => 'date_size',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_s_8',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Date color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Color', 'integrio' ),
				'param_name' => 'custom_date_color',
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Date color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Author Status Color', 'integrio' ),
				'param_name' => 'date_color',
				'value' => '#c4cdd7',
				'dependency' => array(
					'element' => 'custom_date_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// CAROUSEL TAB
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Carousel', 'integrio' ),
				'param_name' => 'use_carousel',
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-2 no-top-margin',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'integrio' ),
				'param_name' => 'autoplay',
				'dependency' => array(
					'element'   => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-1 no-top-padding',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Autoplay Speed', 'integrio' ),
				'param_name' => 'autoplay_speed',
				'value' => '3000',
				'description' => esc_html__( 'Value in milliseconds.', 'integrio' ),
				'dependency' => array(
					'element' => 'autoplay',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_c_1',
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Fade Animation', 'integrio' ),
				'param_name' => 'fade_animation',
				'description' => esc_html__( 'Requires single full-width column.', 'integrio' ),
				'dependency' => array(
					'element'   => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Carousel pagination controls
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Pagination Controls', 'integrio' ),
				'param_name' => 'h_pag_controls',
				'dependency' => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'integrio' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Pagination control', 'integrio' ),
				'param_name' => 'use_pagination',
				'std' => 'true',
				'dependency' => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'integrio' ),
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
				'group' => esc_html__( 'Carousel', 'integrio' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pagination Alignment', 'integrio' ),
				'param_name' => 'pag_align',
				'value' => array(
					esc_html__( 'Left', 'integrio' ) => 'left',
					esc_html__( 'Center', 'integrio' ) => 'center',
					esc_html__( 'Right', 'integrio' )	=> 'right',
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
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'dependency' => array(
					'element' => 'use_pagination',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_c_2',
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
				'value' => $header_font_color,
				'dependency' => array(
					'element' => 'custom_pag_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Prev/Next buttons
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Prev/Next Buttons', 'integrio' ),
                'param_name' => 'h_prev_next',
                'dependency' => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            // Prev/Next checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Prev/Next buttons', 'integrio' ),
                'param_name' => 'use_prev_next',
                'dependency' => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Prev/Next positioning dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Buttons Positioning', 'integrio' ),
				'param_name' => 'prev_next_position',
				'value' => array(
					esc_html__( 'Opposite each other', 'integrio' ) => '',
					esc_html__( 'Bottom right corner', 'integrio' ) => 'right',
				),
				'dependency' => array(
					'element' => 'use_prev_next',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_c_3',
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            // Prev/Next colors checkbox
			array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_prev_next_color',
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            // Prev/Next color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Idle', 'integrio' ),
                'param_name' => 'prev_next_color',
                'value' => 'rgba( '.Integrio_Theme_Helper::hexToRGB($header_font_color).',0.5)',
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Prev/Next hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Hover', 'integrio' ),
                'param_name' => 'prev_next_color_hover',
                'value' => $header_font_color,
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_c_4',
				'group' => esc_html__( 'Carousel', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            // Prev/Next bg color
			array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'integrio' ),
                'param_name' => 'prev_next_bg_idle',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Prev/Next bg color hover
			array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'integrio' ),
                'param_name' => 'prev_next_bg_hover',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
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
				'dependency'  => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Responsive', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Desktop screen breakpoint
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
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Responsive', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Tablet screen breakpoint
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Tablet Screen Breakpoint', 'integrio' ),
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
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Responsive', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			// Mobile screen breakpoint
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
		class WPBakeryShortCode_wgl_Testimonials extends WPBakeryShortCode {}
	}
}
