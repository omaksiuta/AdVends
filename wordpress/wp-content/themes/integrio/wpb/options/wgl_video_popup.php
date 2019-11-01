<?php
if ( !defined('ABSPATH') ) { die( '-1' ); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);
$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);


if (function_exists('vc_map')) {
    vc_map( array(
        'base' => 'wgl_video_popup',
        'name' => esc_html__( 'Video Popup', 'integrio' ),
        'description' => esc_html__( 'Create a Button or Poster for Video Popup.', 'integrio' ),
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_video_popup',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title', 'integrio' ),
                'param_name' => 'title',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Position', 'integrio' ),
                'param_name' => 'title_pos',
                'value' => array(
                    esc_html__( 'Left', 'integrio' ) => 'left',
                    esc_html__( 'Right', 'integrio' ) => 'right',
                    esc_html__( 'Top', 'integrio' ) => 'top',
                    esc_html__( 'Bottom', 'integrio' ) => 'bot',
                ),
                'std' => 'bot',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Video Popup Button Alignment', 'integrio' ),
                'param_name' => 'button_pos',
                'value' => array(
                    esc_html__( 'Left', 'integrio' ) => 'left',
                    esc_html__( 'Center', 'integrio' ) => 'center',
                    esc_html__( 'Right', 'integrio' ) => 'right',
                    esc_html__( 'Inline', 'integrio' ) => 'inline',
                ),
                'std' => 'center',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Video Link', 'integrio' ),
                'param_name' => 'link',
                'description' => esc_html__( 'Enter video link from youtube or vimeo.', 'integrio')
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Background Image/Video', 'integrio' ),
                'param_name' => 'bg_image',
                'description' => esc_html__( 'Select video background image.', 'integrio')
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio')
            ),
            // STYLING TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Title Styles', 'integrio' ),
                'param_name' => 'h_background_title_styles',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'integrio' ),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title color', 'integrio' ),
                'param_name' => 'title_color',
                'value' => $header_font_color,
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_title',
                'group' => esc_html__( 'Style', 'integrio' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_title',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_title',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Button Styles', 'integrio' ),
                'param_name' => 'h_background_title_styles',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Button diameter
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Custom Button Size', 'integrio' ),
                'param_name' => 'btn_size',
                'description' => esc_html__( 'Enter button diameter in pixels.', 'integrio' ),
                'group' => esc_html__( 'Style', 'integrio' ),
            ),
            // Triangle size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Triangle Size', 'integrio' ),
                'param_name' => 'triangle_size',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Triangle color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Triangle Color', 'integrio' ),
                'param_name' => 'triangle_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize Background', 'integrio' ),
                'param_name' => 'bg_color_type',
                'value' => array(
                    esc_html__( 'Theme Defaults', 'integrio' ) => 'def',
                    esc_html__( 'Flat Colors', 'integrio' ) => 'color',
                    esc_html__( 'Gradient Colors', 'integrio' ) => 'gradient',
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Border Color', 'integrio' ),
                'param_name' => 'border_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Color', 'integrio' ),
                'param_name' => 'background_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Start Color', 'integrio' ),
                'param_name' => 'background_gradient_start',
                'value' => $theme_gradient_start,
                'description' => esc_html__( 'For Idle State.', 'integrio' ),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background End Color', 'integrio' ),
                'param_name' => 'background_gradient_end',
                'value' => $theme_gradient_end,
                'description' => esc_html__( 'For Idle State.', 'integrio' ),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // ANIMATION TAB
            // Animation style
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Select Animation Style', 'integrio' ),
                'param_name' => 'animation_style',
                'value' => array(
                    esc_html__( 'Pulsing Circles', 'integrio' ) => 'animation_circles',
                    esc_html__( 'Pulsing Ring', 'integrio' ) => 'animation_ring_pulse',
                    esc_html__( 'Rotating Ring', 'integrio' ) => 'animation_ring_rotate',
                ),
                'std' => 'animation_ring_pulse',
                'group' => esc_html__( 'Animation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Always Run Animation', 'integrio' ),
                'param_name' => 'always_run_animation',
                'description' => esc_html__( 'Run until hover state.', 'integrio' ),
                'group' => esc_html__( 'Animation', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            // Animation circles color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Animation Color', 'integrio' ),
                'param_name' => 'animation_color',
                'value' => $theme_color,
                'description' => esc_html__( 'Animated circles color', 'integrio' ),
                'dependency' => array(
                    'element' => 'animation_style',
                    'value' => 'animation_circles'
                ),
                'group' => esc_html__( 'Animation', 'integrio' ),
            ),
        ),
    ));

    class WPBakeryShortCode_wgl_Video_Popup extends WPBakeryShortCode { }

}