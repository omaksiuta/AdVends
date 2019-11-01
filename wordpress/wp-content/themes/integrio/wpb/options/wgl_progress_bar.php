<?php
if ( ! defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Integrio_Theme_Helper::get_option('theme-secondary-color'));
$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

if (function_exists( 'vc_map' )) {
    vc_map( array(
        'name' => esc_html__( 'Progress Bar', 'integrio' ),
        'base' => 'wgl_progress_bar',
        'class' => 'integrio_progress_bar',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_progress_bar',
        'content_element' => true,
        'description' => esc_html__( 'Display Progress Bar','integrio' ),
        'params' => array(
            array(
                'type' => 'param_group',
                'param_name' => 'values',
                'description' => esc_html__( 'Define values for each bar, such as label, value or colors.', 'integrio' ),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Label', 'integrio' ),
                        'param_name' => 'label',
                        'admin_label' => true,
                        'description' => esc_html__( 'Enter the bar title.', 'integrio' ),
                        'edit_field_class' => 'vc_col-sm-4',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Value', 'integrio' ),
                        'param_name' => 'point_value',
                        'description' => esc_html__( 'Enter the bar value.', 'integrio' ),
                        'edit_field_class' => 'vc_col-sm-4 no-top-padding',
                    ),
                    // Customize colors dropdown
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                        'param_name' => 'bar_color_type',
                        'value' => array(
                            esc_html__( 'Theme Defaults', 'integrio' ) => '',
                            esc_html__( 'Flat Colors', 'integrio' ) => 'color',
                            esc_html__( 'Gradient Colors', 'integrio' ) => 'gradient',
                        ),
                        'edit_field_class' => 'vc_col-sm-4 no-top-padding',
                    ),
                    // Bar color
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Bar Color', 'integrio' ),
                        'param_name' => 'bar_color',
                        'value' => $header_font_color,
                        'dependency' => array(
                            'element' => 'bar_color_type',
                            'value' => 'color'
                        ),
                        'edit_field_class' => 'vc_col-sm-4 clear-left',
                    ),
                    // Bar gradient start color
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Bar Gradient Start Color', 'integrio' ),
						'param_name' => 'bar_gradient_start',
						'value' => $theme_gradient_start,
						'dependency' => array(
							'element' => 'bar_color_type',
							'value' => 'gradient'
						),
						'edit_field_class' => 'vc_col-sm-4 clear-left',
					),
					// Bar gradient end color
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Bar Gradient End Color', 'integrio' ),
						'param_name' => 'bar_gradient_end',
						'value' => $theme_gradient_end,
						'dependency' => array(
							'element' => 'bar_color_type',
							'value' => 'gradient'
						),
						'edit_field_class' => 'vc_col-sm-4',
					),
					// Bg bar color
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Background Bar Color', 'integrio' ),
                        'param_name' => 'bar_bg_color',
                        'value' => '#e5e5e5',
                        'dependency' => array(
                            'element' => 'bar_color_type',
                            'value' => array('color', 'gradient')
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                    ),
                    // Label color
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Label Text Color', 'integrio' ),
                        'param_name' => 'label_color',
                        'value' => '#414141',
                        'dependency' => array(
                            'element' => 'bar_color_type',
                            'value' => array('color', 'gradient')
                        ),
                        'edit_field_class' => 'vc_col-sm-4 clear-left',
                    ),
                    // Value color
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Value Text Color', 'integrio' ),
                        'param_name' => 'value_color',
                        'value' => '#414141',
                        'dependency' => array(
                            'element' => 'bar_color_type',
                            'value' => array('color', 'gradient')
                        ),
                        'edit_field_class' => 'vc_col-sm-4',
                    ),
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Units', 'integrio' ),
                'param_name' => 'units',
                'value' => '%',
                'description' => esc_html__( 'Enter measurement units (Example: %, px, points, etc.)', 'integrio' ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
        )
    ));

    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_Progress_Bar extends WPBakeryShortCode {
        }
    }
}
