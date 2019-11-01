<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);
$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Flip Box', 'integrio' ),
        'base' => 'wgl_flip_box',
        'class' => 'integrio_flip_box',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_flip_box',
        'content_element' => true,
        'description' => esc_html__( 'Add Flip Box','integrio' ),
        'params' => array(
            // GENERAL TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Flip Direction', 'integrio' ),
				'param_name' => 'fb_dir',
				'value' => array(
					esc_html__( 'Flip to Right', 'integrio' ) => 'flip_right',
					esc_html__( 'Flip to Left', 'integrio' ) => 'flip_left',
					esc_html__( 'Flip to Top', 'integrio' ) => 'flip_top',
					esc_html__( 'Flip to Bottom', 'integrio' ) => 'flip_bottom',
				),
				'admin_label' => true,
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
				'param_name' => 'fb_align',
				'value' => array(
					esc_html__( 'Left', 'integrio' ) => 'left',
					esc_html__( 'Center', 'integrio' ) => 'center',
					esc_html__( 'Right', 'integrio' ) => 'right',
				),
				'std' => 'center',
				'edit_field_class' => 'vc_col-sm-6',
			),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_2',
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Flip Box Height', 'integrio' ),
                'param_name' => 'fb_height',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            // FRONT SIDE TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Front Side Background', 'integrio' ),
                'param_name' => 'h_front_bg',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'integrio' ),
                'param_name' => 'front_bg_style',
                'value' => array(
                    esc_html__( 'Color', 'integrio' ) => 'front_color',
                    esc_html__( 'Image', 'integrio' ) => 'front_image',
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Color', 'integrio' ),
                'param_name' => 'front_bg_color',
                'value' => '',
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_color'
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Background Image', 'integrio' ),
                'param_name' => 'front_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_image'
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Front Side Content', 'integrio' ),
                'param_name' => 'h_front_content',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Logo Image', 'integrio' ),
				'param_name' => 'front_logo_image',
				'description' => esc_html__( 'Select image from media library.', 'integrio' ),
				'group' => esc_html__( 'Front Side', 'integrio' ),
			),
            // Subtitle
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Subtitle', 'integrio' ),
                'param_name' => 'front_subtitle',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Subtitle color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Subtitle Color', 'integrio' ),
                'param_name' => 'front_subtitle_color',
                'value' => '',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Subtitle font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Subtitle Font Size', 'integrio' ),
                'param_name' => 'front_subtitle_font_size',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title
            array(
                'type' => 'textarea',
                'heading' => esc_html__( 'Title', 'integrio' ),
                'param_name' => 'front_title',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'integrio' ),
                'param_name' => 'front_title_color',
                'value' => '',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'integrio' ),
                'param_name' => 'front_title_font_size',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Description
            array(
                'type' => 'textarea',
                'heading' => esc_html__( 'Description', 'integrio' ),
                'param_name' => 'front_descr',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Description color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Description Color', 'integrio' ),
                'param_name' => 'front_descr_color',
                'value' => '',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Description font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Description Font Size', 'integrio' ),
                'param_name' => 'front_descr_font_size',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // BACK SIDE TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Back Side Background', 'integrio' ),
                'param_name' => 'h_back_bg',
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'integrio' ),
                'param_name' => 'back_bg_style',
                'value' => array(
                    esc_html__( 'Color', 'integrio' ) => 'back_color',
                    esc_html__( 'Image', 'integrio' ) => 'back_image',
                    esc_html__( 'Gradient', 'integrio' ) => 'gradient',
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Color', 'integrio' ),
                'param_name' => 'back_bg_color',
                'value' => '',
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_color'
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Background Image', 'integrio' ),
                'param_name' => 'back_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_image'
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'integrio' ),
				'param_name' => 'bg_gradient_idle_start',
				'value' =>  $theme_gradient_start,
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'back_bg_style',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Back Side', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'integrio' ),
				'param_name' => 'bg_gradient_idle_end',
				'value' =>  $theme_gradient_end,
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'back_bg_style',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Back Side', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Back Side Content', 'integrio' ),
                'param_name' => 'h_back_title',
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Logo Image', 'integrio' ),
				'param_name' => 'add_back_logo_image',
				'group' => esc_html__( 'Back Side', 'integrio' ),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Logo Image', 'integrio' ),
				'param_name' => 'back_logo_image',
				'description' => esc_html__( 'Select image from media library.', 'integrio' ),
				'dependency' => array(
					'element' => 'add_back_logo_image',
					'value' => 'true'
				),
				'group' => esc_html__( 'Back Side', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
            array(
                'type' => 'textfield',
                'param_name' => 'back_title',
                'heading' => esc_html__( 'Title', 'integrio' ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'integrio' ),
                'param_name' => 'back_title_color',
                'value' => '',
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'back_descr',
                'heading' => esc_html__( 'Content', 'integrio' ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Content Color', 'integrio' ),
                'param_name' => 'back_descr_color',
                'value' => '',
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Back Side Button', 'integrio' ),
                'param_name' => 'h_back_button',
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add \'Read More\' Button', 'integrio' ),
                'param_name' => 'add_read_more',
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text', 'integrio' ),
                'param_name' => 'read_more_text',
                'value' => esc_html__( 'Read More', 'integrio' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Button Color', 'integrio' ),
                'param_name' => 'read_more_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'integrio' ),
                'param_name' => 'link',
                'description' => esc_html__( 'Add link to \'Read more\' button.', 'integrio' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Icon to the Button', 'integrio' ),
                'param_name' => 'add_icon_button',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'button_icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon'    => false, // default true, display an 'EMPTY' icon?
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                    'element' => 'add_icon_button',
                    'value' => 'true'
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icon Position', 'integrio' ),
                'param_name' => 'button_icon_position',
                'value' => array(
                    esc_html__( 'Left', 'integrio' ) => 'left',
                    esc_html__( 'Right', 'integrio' ) => 'right'
                ),
                'dependency' => array(
                    'element' => 'add_icon_button',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            // SPACING TAB
            // Front side positioning
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Front Side Positioning', 'integrio' ),
				'param_name' => 'h_front_positioning',
				'group' => esc_html__( 'Spacings', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'css_editor',
				'param_name' => 'front_offsets',
				'group' => esc_html__( 'Spacings', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
			),
			// Back side positioning
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Back Side Positioning', 'integrio' ),
				'param_name' => 'h_back_positioning',
				'group' => esc_html__( 'Spacings', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'css_editor',
				'param_name' => 'back_offsets',
				'group' => esc_html__( 'Spacings', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
			),
        )
    ));

    if ( class_exists('WPBakeryShortCode') ) {
        class WPBakeryShortCode_wgl_Flip_Box extends WPBakeryShortCode {
        }
    }
}