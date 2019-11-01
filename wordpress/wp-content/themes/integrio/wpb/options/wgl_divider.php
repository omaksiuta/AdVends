<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Divider', 'integrio'),
        'base' => 'wgl_divider',
        'class' => 'integrio_divider',
        'category' => esc_html__('WGL Modules', 'integrio'),
        'icon' => 'wgl_icon_divider', // need to change
        'content_element' => true,
        'description' => esc_html__('Divider', 'integrio'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Width', 'integrio'),
                'param_name' => 'width',
                'description' => esc_html__('Enter value.', 'integrio'),
                'value' => '100',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Width Units', 'integrio' ),
                'param_name' => 'width_units',
                'value' => array(
                    esc_html__( 'Pixels', 'integrio' )      => 'px',
                    esc_html__( 'Percentages', 'integrio' ) => '%',
                ),
                'std' => '%',
                'description' => esc_html__('Select value units.', 'integrio'),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Height', 'integrio'),
                'param_name' => 'height',
                'description' => esc_html__('Enter value in pixels.', 'integrio'),
                'value' => '1px',
                'save_always' => true,
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6 no-top-padding',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'integrio' ),
                'param_name' => 'divider_alignment',
                'value' => array(
                    esc_html__( 'Left', 'integrio' )   => 'left',
                    esc_html__( 'Center', 'integrio' ) => 'center',
                    esc_html__( 'Right', 'integrio' )  => 'right',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Divider Color', 'integrio' ),
                'param_name' => 'divider_color',
                'value' => '#e7e8e8',
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // EXTRA LINE TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Extra Line', 'integrio' ),
                'param_name' => 'add_divider_line',
                'description' => esc_html__( 'Short line above Divider.', 'integrio' ),
                'group' => esc_html__( 'Extra Line', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Extra Line Alignment', 'integrio' ),
                'param_name' => 'divider_line_alignment',
                'value' => array(
                    esc_html__( 'Left', 'integrio' )   => 'left',
                    esc_html__( 'Center', 'integrio' ) => 'center',
                    esc_html__( 'Right', 'integrio' )  => 'right',
                ),
                'dependency' => array(
                    'element' => 'add_divider_line',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Extra Line', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Extra Line Color', 'integrio' ),
                'param_name' => 'divider_line_color',
                'value' => $theme_color,
                'save_always' => true,
                'dependency' => array(
                    'element' => 'add_divider_line',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Extra Line', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6 no-top-padding',
            ),
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_divider extends WPBakeryShortCode {}
    }
}