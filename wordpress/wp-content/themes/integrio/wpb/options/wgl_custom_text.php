<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$main_font = Integrio_Theme_Helper::get_option('main-font');

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__( 'WGL Text Module', 'integrio' ),
        'base' => 'wgl_custom_text',
        'class' => 'integrio_custom_text',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_custom_text',
        'content_element' => true,
        'description' => esc_html__( 'Text with responsive settings','integrio' ),
        'params' => array(
            array(
                'type' => 'textarea_html',
                'holder' => 'div',
                'heading' => esc_html__( 'Content.', 'integrio' ) ,
                'param_name' => 'content',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'integrio' ),
                'param_name' => 'font_size',
                'value' => (int)$main_font['font-size'],
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Styling', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Line Height', 'integrio' ),
                'param_name' => 'line_height',
                'value' => $main_font['line-height'],
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Styling', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts',
                'group' => esc_html__( 'Styling', 'integrio' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_text',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Styling', 'integrio' ),
            ),
            // Responsive settings
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Responsive settings', 'integrio' ),
                'param_name' => 'h_responsive_elements',
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Desktops
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Desktop', 'integrio' ),
                'param_name' => 'responsive_font_desktop',
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array( 
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'integrio' ),
                'param_name' => 'font_size_desktop',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'responsive_font_desktop',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Line Height', 'integrio' ),
                'param_name' => 'line_height_desktop',
                'value' => $main_font['line-height'],
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'responsive_font_desktop',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'h_responsive_elements_talet',
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Tablet
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Tablet', 'integrio' ),
                'param_name' => 'responsive_font_tablet',
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'integrio' ),
                'param_name' => 'font_size_tablet',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'responsive_font_tablet',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Line Height', 'integrio' ),
                'param_name' => 'line_height_tablet',
                'value' => $main_font['line-height'],
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'responsive_font_tablet',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'h_responsive_elements_mobile',
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Mobile
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Mobile', 'integrio' ),
                'param_name' => 'responsive_font_mobile',
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'integrio' ),
                'param_name' => 'font_size_mobile',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'responsive_font_mobile',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Line Height', 'integrio' ),
                'param_name' => 'line_height_mobile',
                'value' => $main_font['line-height'],
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'responsive_font_mobile',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Responsive', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),              
        )
    ));
    
    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_custom_text extends WPBakeryShortCode {
            
        }
    } 
}
