<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option( 'theme-custom-color' ));

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Message Box', 'integrio' ),
        'base' => 'wgl_message_box',
        'class' => 'integrio_message_box',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_message_box',
        'content_element' => true,
        'description' => esc_html__( 'Message Box','integrio' ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Message Type', 'integrio' ),
                'param_name' => 'type',
                'value' => array(
                    esc_html__( 'Informational', 'integrio' ) => 'info',
                    esc_html__( 'Success', 'integrio' ) => 'success',
                    esc_html__( 'Warning', 'integrio' ) => 'warning',
                    esc_html__( 'Error', 'integrio' ) => 'error',
                    esc_html__( 'Custom', 'integrio' ) => 'custom',
                ),              
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust',
                'settings' => array(
                    'emptyIcon' => false,
                    'iconsPerPage' => 200,
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Message Color', 'integrio' ),
                'param_name' => 'icon_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title', 'integrio' ),
                'param_name' => 'title',
                'admin_label' => true,
            ),  
            array(
                'type' => 'textarea',
                'heading' => esc_html__( 'Text', 'integrio' ),
                'param_name' => 'text',
            ),       
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Closable?', 'integrio' ),
                'param_name' => 'closable',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            // TYPOGRAPHY TAB
            // Title styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Title Styles', 'integrio' ),
                'param_name' => 'h_title_styles',
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Tag', 'integrio' ),
                'param_name' => 'title_tag',
                'value' => array(
                    esc_html__( '‹div›', 'integrio' ) => 'div',
                    esc_html__( '‹span›', 'integrio' ) => 'span',
                    esc_html__( '‹h2›', 'integrio' ) => 'h2',
                    esc_html__( '‹h3›', 'integrio' ) => 'h3',
                    esc_html__( '‹h4›', 'integrio' ) => 'h4',
                    esc_html__( '‹h5›', 'integrio' ) => 'h5',
                    esc_html__( '‹h6›', 'integrio' ) => 'h6',
                ),
                'std' => 'h4',
                'description' => esc_html__( 'Custom HTML tag.', 'integrio' ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'integrio' ),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_title',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_title',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_title',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
            ),
            // title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Color', 'integrio' ),
                'param_name' => 'custom_title_color',
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'integrio' ),
                'param_name' => 'title_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // text styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Text Styles', 'integrio' ),
                'param_name' => 'h_text_styles',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Text Tag', 'integrio' ),
                'param_name' => 'text_tag',
                'value' => array(
                    esc_html__( '‹Div›', 'integrio' ) => 'div',
                    esc_html__( '‹Span›', 'integrio' ) => 'span',
                    esc_html__( '‹h2›', 'integrio' ) => 'h2',
                    esc_html__( '‹h3›', 'integrio' ) => 'h3',
                    esc_html__( '‹h4›', 'integrio' ) => 'h4',
                    esc_html__( '‹h5›', 'integrio' ) => 'h5',
                    esc_html__( '‹h6›', 'integrio' ) => 'h6',
                ),
                'std' => 'div',
                'description' => esc_html__( 'Custom html tag.', 'integrio' ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Text Font Size', 'integrio' ),
                'param_name' => 'text_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_text',
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_text',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_text',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
            ),
            // text color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Color', 'integrio' ),
                'param_name' => 'custom_text_color',
                'dependency'    => array(
                    'element'   => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Text Color', 'integrio' ),
                'param_name' => 'text_color',
                'value' => '#000000',
                'description' => esc_html__( 'Select text color', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_text_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),             
        )
    ));
    
    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_message_box extends WPBakeryShortCode {}
    } 
}
