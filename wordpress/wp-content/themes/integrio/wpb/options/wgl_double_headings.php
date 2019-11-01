<?php
if ( ! defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option( 'header-font' )['color']);

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Double Headings', 'integrio' ),
        'base' => 'wgl_double_headings',
        'class' => 'integrio_custom_text',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_double-text',
        'content_element' => true,
        'description' => esc_html__( 'Double Headings','integrio' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Subtitle', 'integrio' ),
                'param_name' => 'subtitle',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Squares', 'integrio' ),
                'param_name' => 'add_squares',
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Squares Color', 'integrio' ),
                'param_name' => 'squares_color',
                'value' => '#f6f6f6',
                'save_always' => true,
                'dependency' => array(
                    'element' => 'add_squares',
                    'value' => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'textarea',
                'holder' => 'div',
                'heading' => esc_html__( 'Title.', 'integrio' ) ,
                'param_name' => 'content',
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
                'edit_field_class' => 'vc_col-sm-12',
            ), 
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            // TITLE STYLES TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Title Styles', 'integrio' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'HTML Tag', 'integrio' ),
                'param_name' => 'title_tag',
                'value' => array(
                    esc_html__( '‹div›', 'integrio' ) => 'div',
                    esc_html__( '‹h1›', 'integrio' ) => 'h1',
                    esc_html__( '‹h2›', 'integrio' ) => 'h2',
                    esc_html__( '‹h3›', 'integrio' ) => 'h3',
                    esc_html__( '‹h4›', 'integrio' ) => 'h4',
                    esc_html__( '‹h5›', 'integrio' ) => 'h5',
                    esc_html__( '‹h6›', 'integrio' ) => 'h6',
                ),
                'std' => 'div',
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'description' => esc_html__( 'Your html tag for title', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'integrio' ),
                'param_name' => 'title_size',
                'value' => '42px',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Line Height', 'integrio' ),
                'param_name' => 'title_line_height',
                'value' => '52px',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Font Weight', 'integrio' ),
                'param_name' => 'title_weight',
                'value' => array(
                    esc_html__( 'Theme Defaults', 'integrio' ) => '',
                    esc_html__( '300 / Light', 'integrio' ) => '300',
                    esc_html__( '400 / Regular', 'integrio' ) => '400',
                    esc_html__( '500 / Medium', 'integrio' ) => '500',
                    esc_html__( '600 / SemiBold', 'integrio' ) => '600',
                    esc_html__( '700 / Bold', 'integrio' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'integrio' ) => '800',
                    esc_html__( '900 / Black', 'integrio' ) => '900',
                ),
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'description' => esc_html__( 'Select custom value.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'integrio' ),
                'param_name' => 'title_color',
                'value' => $header_font_color,
                'save_always' => true,
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_ts_1',
				'group' => esc_html__( 'Title Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Resonsive Font Size', 'integrio' ),
                'param_name' => 'responsive_font',
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Small Desktops', 'integrio' ),
                'param_name' => 'font_size_desktop',
                'description' => esc_html__( 'Font-size in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablets', 'integrio' ),
                'param_name' => 'font_size_tablet',
                'description' => esc_html__( 'Font-size in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Mobile', 'integrio' ),
                'param_name' => 'font_size_mobile',
                'description' => esc_html__( 'Font-size in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'responsive_font',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_ts_2',
				'group' => esc_html__( 'Title Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_title',
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_title',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_title',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Title Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),   
            // SUBTITLE STYLES TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Subtitle Styles', 'integrio' ),
                'param_name' => 'h_subtitle_styles',
                'group' => esc_html__( 'Subtitle Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'HTML Tag', 'integrio' ),
                'param_name' => 'subtitle_tag',
                'value' => array(
                    esc_html__( '‹div›', 'integrio' ) => 'div',
                    esc_html__( '‹h2›', 'integrio' ) => 'h2',
                    esc_html__( '‹h3›', 'integrio' ) => 'h3',
                    esc_html__( '‹h4›', 'integrio' ) => 'h4',
                    esc_html__( '‹h5›', 'integrio' ) => 'h5',
                    esc_html__( '‹h6›', 'integrio' ) => 'h6',
                ),
                'std' => 'div',
                'description' => esc_html__( 'Select custom html tag.', 'integrio' ),
                'group' => esc_html__( 'Subtitle Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'integrio' ),
                'param_name' => 'subtitle_size',
                'value' => '14px',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Subtitle Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Line Height', 'integrio' ),
                'param_name' => 'subtitle_line_height',
                'value' => '20px',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Subtitle Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Font Weight', 'integrio' ),
                'param_name' => 'subtitle_weight',
                'description' => esc_html__( 'Select custom value.', 'integrio' ),
                'value' => array(
                    esc_html__( 'Theme Defaults', 'integrio' ) => '',
                    esc_html__( '300 / Light', 'integrio' ) => '300',
                    esc_html__( '400 / Regular', 'integrio' ) => '400',
                    esc_html__( '500 / Medium', 'integrio' ) => '500',
                    esc_html__( '600 / SemiBold', 'integrio' ) => '600',
                    esc_html__( '700 / Bold', 'integrio' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'integrio' ) => '800',
                ),
                'group' => esc_html__( 'Subtitle Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_subtitle_color',
                'group' => esc_html__( 'Subtitle Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Subtitle Color', 'integrio' ),
                'param_name' => 'subtitle_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_subtitle_color',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Subtitle Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_ss_1',
				'group' => esc_html__( 'Subtitle Styles', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_subtitle',
                'group' => esc_html__( 'Subtitle Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_subtitle',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_subtitle',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Subtitle Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),              
        )
    ));
    
    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_Double_Headings extends WPBakeryShortCode {
            
        }
    } 
}
