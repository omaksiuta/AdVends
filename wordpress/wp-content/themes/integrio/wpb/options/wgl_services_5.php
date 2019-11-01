<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(integrio_Theme_Helper::get_option("theme-custom-color"));
$second_color = esc_attr(integrio_Theme_Helper::get_option("second-custom-color"));
$theme_gradient = integrio_Theme_Helper::get_option("theme-gradient");

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        'name' => esc_html__('Services 5', 'integrio'),
        'base' => 'wgl_services_5',
        'class' => 'integrio_services_5',
        'category' => esc_html__('WGL Modules', 'integrio'),
        'icon' => 'wgl_icon_services_5',
        'content_element' => true,
        'description' => esc_html__('Add Services','integrio'),
        'params' => array(
            // General
            array(
                "type" => "textarea",
                "heading" => esc_html__( 'Title', 'integrio' ),
                "param_name" => "title",
                'admin_label' => true,
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__( 'Content', 'integrio' ),
                "param_name" => "descr",
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Read More Button', 'integrio' ),
                'param_name' => 'add_read_more',
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'integrio' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to read more button.', 'integrio'),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__( 'Custom Service Min Height', 'integrio' ),
                "param_name" => "min_height",
                'description' => esc_html__('Set custom service min height in pixels', 'integrio'),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'integrio'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'integrio')
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Front Side Background', 'integrio'),
                'param_name' => 'h_icon_type',
                'group' => esc_html__( 'Background', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'front_side_type',
                'value' => array(
                    esc_html__( 'None', 'integrio' )  => 'none',
                    esc_html__( 'Color', 'integrio' )  => 'color',
                    esc_html__( 'Image', 'integrio' ) => 'image',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Background', 'integrio' ),
            ),
            // color dropdown
            array(
                'type' => 'dropdown',
                'param_name' => 'front_side_color_type',
                'heading' => esc_html__('Background Color Type', 'integrio'),
                'value' => array(
                    esc_html__( 'Color', 'integrio' )    => 'color',
                    esc_html__( 'Gradient', 'integrio' ) => 'gradient',
                ),
                'dependency' => array(
                    'element' => 'front_side_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Background', 'integrio' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'integrio'),
                'param_name' => 'bg_color',
                'value' => $theme_color,
                'description' => esc_html__('Select custom color.', 'integrio'),
                'dependency' => array(
                    'element' => 'front_side_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Background', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Gradient From', 'integrio'),
                'param_name' => 'bg_gradient_from',
                'value' => $theme_gradient['from'],
                'description' => esc_html__('Select gradient color from', 'integrio'),
                'dependency' => array(
                    'element' => 'front_side_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Background', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // gradient start color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Gradient To', 'integrio'),
                'param_name' => 'bg_gradient_to',
                'value' => $theme_gradient['to'],
                'description' => esc_html__('Select gradient color to', 'integrio'),
                'dependency' => array(
                    'element' => 'front_side_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Background', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'integrio' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'front_side_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Background', 'integrio' ),
            ),
            // Back Side Background
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Back Side Background', 'integrio'),
                'param_name' => 'h_back_bg_type',
                'group' => esc_html__( 'Background', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'back_side_type',
                'value' => array(
                    esc_html__( 'None', 'integrio' )  => 'none',
                    esc_html__( 'Color', 'integrio' )  => 'color',
                    esc_html__( 'Image', 'integrio' ) => 'image',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Background', 'integrio' ),
            ),
            // color dropdown
            array(
                'type' => 'dropdown',
                'param_name' => 'back_side_color_type',
                'heading' => esc_html__('Background Color Type', 'integrio'),
                'value' => array(
                    esc_html__( 'Color', 'integrio' )    => 'color',
                    esc_html__( 'Gradient', 'integrio' ) => 'gradient',
                ),
                'dependency' => array(
                    'element' => 'back_side_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Background', 'integrio' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'integrio'),
                'param_name' => 'back_bg_color',
                'value' => $theme_color,
                'description' => esc_html__('Select custom color.', 'integrio'),
                'dependency' => array(
                    'element' => 'back_side_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Background', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Gradient From', 'integrio'),
                'param_name' => 'back_bg_gradient_from',
                'value' => $theme_gradient['from'],
                'description' => esc_html__('Select gradient color from', 'integrio'),
                'dependency' => array(
                    'element' => 'back_side_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Background', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // gradient start color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Gradient To', 'integrio'),
                'param_name' => 'back_bg_gradient_to',
                'value' => $theme_gradient['to'],
                'description' => esc_html__('Select gradient color to', 'integrio'),
                'dependency' => array(
                    'element' => 'back_side_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Background', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'integrio' ),
                'param_name' => 'back_thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'back_side_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Background', 'integrio' ),
            ),
            // Styling
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Custom Title Color', 'integrio'),
                'param_name' => 'h_custom_colors',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Title Color', 'integrio' ),
                'param_name' => 'custom_title_color',
                'description' => esc_html__( 'Select custom color', 'integrio' ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'integrio'),
                'param_name' => 'title_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Custom Content Color', 'integrio'),
                'param_name' => 'h_custom_content_colors',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Content Color', 'integrio' ),
                'param_name' => 'custom_content_color',
                'description' => esc_html__( 'Select custom color', 'integrio' ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Content Color', 'integrio'),
                'param_name' => 'content_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_content_color',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Read More color checkbox
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Custom Read More Colors', 'integrio'),
                'param_name' => 'h_custom_btn_colors',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Read More Colors', 'integrio' ),
                'param_name' => 'custom_btn_color',
                'description' => esc_html__( 'Select custom colors', 'integrio' ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Read More color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Color', 'integrio'),
                'param_name' => 'btn_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select read more color', 'integrio'),
                'dependency' => array(
                    'element' => 'custom_btn_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'integrio'),
                'param_name' => 'btn_bg_color',
                'value' => 'transparent',
                'description' => esc_html__('Select read more bg color', 'integrio'),
                'dependency' => array(
                    'element' => 'custom_btn_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Read More hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Hover Color', 'integrio'),
                'param_name' => 'btn_color_hover',
                'value' => '#232323',
                'description' => esc_html__('Select read more hover color', 'integrio'),
                'dependency' => array(
                    'element' => 'custom_btn_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Hover Color', 'integrio'),
                'param_name' => 'btn_bg_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__('Select read more bg hover color', 'integrio'),
                'dependency' => array(
                    'element' => 'custom_btn_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Services_5 extends WPBakeryShortCode {
        }
    }
}