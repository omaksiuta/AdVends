<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));
$theme_gradient = Integrio_Theme_Helper::get_option('theme-gradient');

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        'name' => esc_html__('Services', 'integrio'),
        'base' => 'wgl_services',
        'class' => 'integrio_services',
        'category' => esc_html__('WGL Modules', 'integrio'),
        'icon' => 'wgl_icon_services',
        'content_element' => true,
        'description' => esc_html__('Add Services','integrio'),
        'params' => array(
            // General
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Service Animation', 'integrio' ),
                'param_name' => 'service_anim',
                'value'         => array(
                    esc_html__( 'Fade', 'integrio' )      => 'fade',
                    esc_html__( 'Front Side Slide', 'integrio' )      => 'front_slide',
                    esc_html__( 'Back Side Slide', 'integrio' )      => 'back_slide',
                ),
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Animation Direction', 'integrio' ),
                'param_name' => 'anim_dir',
                'value'         => array(
                    esc_html__( 'Slide to Right', 'integrio' )      => 'to_right',
                    esc_html__( 'Slide to Left', 'integrio' )      => 'to_left',
                    esc_html__( 'Slide to Top', 'integrio' )      => 'to_top',
                    esc_html__( 'Slide to Bottom', 'integrio' )      => 'to_bottom',
                ),
                'dependency' => array(
                    'element' => 'service_anim',
                    'value' => array('front_slide','back_slide'),
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Alignment', 'integrio' ),
                'param_name'    => 'service_align',
                'value'         => array(
					esc_html__( 'Left', 'integrio' )   => 'left',
					esc_html__( 'Center', 'integrio' ) => 'center',
					esc_html__( 'Right', 'integrio' )  => 'right',
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'integrio'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'integrio')
            ),
            // Front Side
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Front Side Background', 'integrio'),
                'param_name' => 'h_front_bg',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'front_bg_style',
                'value'         => array(
                    esc_html__( 'Frame', 'integrio' )      => 'front_frame',
                    esc_html__( 'Color', 'integrio' )      => 'front_color',
                    esc_html__( 'Image', 'integrio' )      => 'front_image',
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Frame Color', 'integrio'),
                'param_name' => 'front_frame_color',
                'value' => 'rgba(255,255,255,0.3)',
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => array('front_frame','front_color')
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'integrio'),
                'param_name' => 'front_bg_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_color'
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', 'integrio'),
                'param_name' => 'front_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_image'
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Front Side Icon', 'integrio'),
                'param_name' => 'h_front_content',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Info Box Icon/Image
            array(
                'type'          => 'dropdown',
                'param_name'    => 'front_icon_type',
                'value'         => array(
                    esc_html__( 'None', 'integrio' )      => 'none',
                    esc_html__( 'Font', 'integrio' )      => 'font',
                    esc_html__( 'Image', 'integrio' )     => 'image',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'front_icon_font_type',
                'value'         => array(
                    esc_html__( 'Fontawesome', 'integrio' )      => 'type_fontawesome',
                    esc_html__( 'Flaticon', 'integrio' )      => 'type_flaticon',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
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
                    'element' => 'front_icon_font_type',
                    'value' => 'type_fontawesome',
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_flaticon',
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon?
                    'type' => 'flaticon',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'front_icon_font_type',
                    'value' => 'type_flaticon',
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'integrio' ),
                'param_name' => 'front_icon_thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            // Custom image width
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Image Width', 'integrio'),
                'param_name' => 'custom_image_width',
                'description' => esc_html__( 'Enter image size in pixels.', 'integrio' ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Custom image height
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Image Height', 'integrio'),
                'param_name' => 'custom_image_height',
                'description' => esc_html__( 'Enter image size in pixels.', 'integrio' ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Icon Size', 'integrio'),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Enter Icon size in pixels.', 'integrio' ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'font',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Color', 'integrio'),
                'param_name' => 'front_icon_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Front Side Title
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Front Side Title', 'integrio'),
                'param_name' => 'h_front_title',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'front_title',
                'heading' => esc_html__('Title', 'integrio'),
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'integrio'),
                'param_name' => 'front_title_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            // Front Side Title
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Front Side Description', 'integrio'),
                'param_name' => 'h_front_descr',
                'group' => esc_html__( 'Front Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'front_descr',
                'heading' => esc_html__('Description', 'integrio'),
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Description Color', 'integrio'),
                'param_name' => 'front_descr_color',
                'value' => '#bebebe',
                'group' => esc_html__( 'Front Side', 'integrio' ),
            ),
            // Back Side
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Back Side Background', 'integrio'),
                'param_name' => 'h_back_bg',
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'back_bg_style',
                'value'         => array(
                    esc_html__( 'Color', 'integrio' )      => 'back_color',
                    esc_html__( 'Image', 'integrio' )      => 'back_image',
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'integrio'),
                'param_name' => 'back_bg_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_color'
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', 'integrio'),
                'param_name' => 'back_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_image'
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Back Side Button', 'integrio'),
                'param_name' => 'h_back_button',
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Read More Button', 'integrio' ),
                'param_name' => 'add_read_more',
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Read More Button Text', 'integrio'),
                'param_name' => 'read_more_text',
                'value' => esc_html__('Read More', 'integrio'),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Button Arrow', 'integrio' ),
                'param_name' => 'add_button_arrow',
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'integrio' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to read more button.', 'integrio'),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'integrio' ),
                'param_name' => 'button_customize',
                'value'         => array(
                    esc_html__( 'Default', 'integrio' )        => 'def',
                    esc_html__( 'Color', 'integrio' )          => 'color',
                    esc_html__( 'Gradient', 'integrio' )       => 'gradient',
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            // Button text-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Text Color', 'integrio'),
                'param_name' => 'button_text_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom text color for button.', 'integrio'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover text-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Text Color', 'integrio'),
                'param_name' => 'button_text_color_hover',
                'value' => $theme_color,
                'description' => esc_html__('Select custom text color for hover button.', 'integrio'),
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Background', 'integrio'),
                'param_name' => 'button_bg_color',
                'value' => $theme_color,
                'description' => esc_html__('Select custom background for button.', 'integrio'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover Bg
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Background', 'integrio'),
                'param_name' => 'button_bg_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom background for hover button.', 'integrio'),
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button border-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Border Color', 'integrio'),
                'param_name' => 'button_border_color',
                'value' => $theme_color,
                'description' => esc_html__('Select custom border color for button.', 'integrio'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover border-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Border Color', 'integrio'),
                'param_name' => 'button_border_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom border color for hover button.', 'integrio'),
                'group' => esc_html__( 'Back Side', 'integrio' ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
			// Bg gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'integrio' ),
				'param_name' => 'bg_gradient_idle_start',
				'value' =>  $theme_gradient['from'],
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Back Side', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'integrio' ),
				'param_name' => 'bg_gradient_idle_end',
				'value' =>  $theme_gradient['to'],
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Back Side', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'integrio' ),
				'param_name' => 'bg_gradient_hover_start',
				'value' =>  $theme_gradient['to'],
				'description' => esc_html__( 'For Hover State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Back Side', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'integrio' ),
				'param_name' => 'bg_gradient_hover_end',
				'value' =>  $theme_gradient['from'],
				'description' => esc_html__( 'For Hover State.', 'integrio' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Back Side', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Services extends WPBakeryShortCode {
        }
    }
}