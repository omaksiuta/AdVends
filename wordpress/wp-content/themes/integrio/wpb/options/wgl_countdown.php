<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Countdown Timer', 'integrio' ),
        'base' => 'wgl_countdown',
        'class' => 'integrio_countdown',
        'content_element' => true,
        'description' => esc_html__( 'Countdown','integrio' ),
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_countdown',
        'params' => array(
            // GENERAL TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Countdown to this date:', 'integrio' ),
                'param_name' => 'h_date',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Year', 'integrio' ),
                'param_name' => 'countdown_year',
                'description' => esc_html__( 'Example: 2020', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Month', 'integrio' ),
                'param_name' => 'countdown_month',
                'description' => esc_html__( 'Example: 12', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),            
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Day', 'integrio' ),
                'param_name' => 'countdown_day',
                'description' => esc_html__( 'Example: 31', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Hours', 'integrio' ),
                'param_name' => 'countdown_hours', 
                'description' => esc_html__( 'Example: 24', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Minutes', 'integrio' ),
                'param_name' => 'countdown_min',
                'description' => esc_html__( 'Example: 59', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ), 
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Hidden Content', 'integrio' ),
                'param_name' => 'h_hide',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Days?', 'integrio' ),
                'param_name' => 'hide_day',
                'edit_field_class' => 'vc_col-sm-2',
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Hours?', 'integrio' ),
                'param_name' => 'hide_hours',
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Minutes?', 'integrio' ),
                'param_name' => 'hide_minutes',
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Seconds?', 'integrio' ),
                'param_name' => 'hide_seconds',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Show Value Names?', 'integrio' ),
                'param_name' => 'show_value_names',
                'value' => 'true',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // STYLE TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Countdown Size', 'integrio' ),
                'param_name' => 'size',
                'value' => array(
                    esc_html__( 'Large','integrio' ) => 'large',
                    esc_html__( 'Medium','integrio' ) => 'medium',
                    esc_html__( 'Small','integrio' ) => 'small',
                    esc_html__( 'Custom','integrio' ) => 'custom',
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'integrio' ),
                'param_name' => 'align',
                'value' => array(
                    esc_html__( 'Left', 'integrio' ) => 'left',
                    esc_html__( 'Center', 'integrio' ) => 'center',
                    esc_html__( 'Right', 'integrio' ) => 'right',
                ),
                'std' => 'center',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_s_1',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'integrio' ),
                'param_name' => 'font_size',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'size',
                    'value' => 'custom',
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Number Font Size ', 'integrio' ),
                'param_name' => 'font_size_number',
                'description' => esc_html__( 'Enter value in em.', 'integrio' ),
                'dependency' => array(
                    'element' => 'size',
                    'value' => 'custom',
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),           
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Text Font Size ', 'integrio' ),
                'param_name' => 'font_size_text',
                'description' => esc_html__( 'Enter value in em.', 'integrio' ),
                'dependency' => array(
                    'element' => 'size',
                    'value' => 'custom',
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_s_2',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Number Font Weight', 'integrio' ),
                'param_name' => 'font_weight',
                'description' => esc_html__( 'Select custom value.', 'integrio' ),
                'value' => array(
                    esc_html__( 'Theme defaults', 'integrio' ) => '',
                    esc_html__( '300 / Light', 'integrio' ) => '300',
                    esc_html__( '400 / Regular', 'integrio' ) => '400',
                    esc_html__( '500 / Medium', 'integrio' ) => '500',
                    esc_html__( '600 / SemiBold', 'integrio' ) => '600',
                    esc_html__( '700 / Bold', 'integrio' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'integrio' ) => '800',
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Text Font Weight', 'integrio' ),
                'param_name' => 'font_text_weight',
                'description' => esc_html__( 'Select custom value.', 'integrio' ),
                'value' => array(
                    esc_html__( 'Theme defaults', 'integrio' ) => '',
                    esc_html__( '300 / Light', 'integrio' ) => '300',
                    esc_html__( '400 / Regular', 'integrio' ) => '400',
                    esc_html__( '500 / Medium', 'integrio' ) => '500',
                    esc_html__( '600 / SemiBold', 'integrio' ) => '600',
                    esc_html__( '700 / Bold', 'integrio' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'integrio' ) => '800',
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_s_3',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Values Color', 'integrio' ),
                'param_name' => 'values_color',
                'value' => $header_font_color,
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Value Names Color', 'integrio' ),
                'param_name' => 'value_names_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'show_value_names',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Separating Points Color', 'integrio' ),
                'param_name' => 'points_color',
                'value' => $theme_color,
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_s_4',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_countdown',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_countdown',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_countdown',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
        )
    ));
    
    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_countdown extends WPBakeryShortCode {}
    } 
}