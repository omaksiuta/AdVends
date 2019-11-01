<?php

if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);
$theme_gradient = Integrio_Theme_Helper::get_option('theme-gradient');

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__( 'Button', 'integrio' ),
        'base' => 'wgl_button',
        'class' => 'integrio_button',
        'icon' => 'wgl_icon_button',
        'content_element' => true,
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'description' => esc_html__( 'Add extended button','integrio'),
        'params' => array(
            // GENERAL TAB
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text', 'integrio' ),
                'value' => esc_html__( 'Button Text', 'integrio' ),
                'param_name' => 'button_text',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Button Link', 'integrio' ),
                'param_name' => 'link',
            ),
            // Animations
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            //  STYLE TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Button', 'integrio' ),
                'param_name' => 'h_button_style',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Size', 'integrio' ),
                'param_name' => 'size',
                'value' => array(
                    esc_html__( 'Extra Large', 'integrio' ) => 'xl',
                    esc_html__( 'Large', 'integrio' ) => 'l',
                    esc_html__( 'Medium', 'integrio' ) => 'm',
                    esc_html__( 'Small', 'integrio' ) => 's',
                ),
                'std' => 'l',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( '3D effect', 'integrio' ),
				'param_name' => 'effect_3d',
				'group' => esc_html__( 'Style', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_s_1',
				'group' => esc_html__( 'Style', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Button Alignment', 'integrio' ),
				'param_name' => 'align',
				'value' => array(
					esc_html__( 'Left', 'integrio' ) => 'left',
					esc_html__( 'Center', 'integrio' ) => 'center',
					esc_html__( 'Right', 'integrio' ) => 'right',
				),
				'group' => esc_html__( 'Style', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Button Full Width', 'integrio' ),
				'param_name' => 'full_width',
				'description' => esc_html__( 'Fill available width.', 'integrio' ),
				'group' => esc_html__( 'Style', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Display: Inline', 'integrio' ),
				'param_name' => 'inline',
				'description' => esc_html__( 'Fill content width.', 'integrio' ),
				'group' => esc_html__( 'Style', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
            // Border heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Button Border', 'integrio' ),
                'param_name' => 'h_button_border',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Border Radius
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Border Radius', 'integrio' ),
                'value' => '',
                'param_name' => 'border_radius',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Border checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Border', 'integrio' ),
                'param_name' => 'add_border',
                'value' => 'true',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            // Border width
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Border Width', 'integrio' ),
                'param_name' => 'border_width',
                'value' => '1px',
                'dependency' => array(
                    'element' => 'add_border',
                    'value' => 'true'
                ),
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            // Shadow
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Button Shadow', 'integrio' ),
                'param_name' => 'h_button_shadow',
                'group' => esc_html__( 'Style', 'integrio' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Shadow Appearance', 'integrio' ),
                'param_name' => 'shadow_style',
                'value' => array(
					esc_html__( 'Theme Defaults', 'integrio' ) => '',
					esc_html__( 'Disable Shadow', 'integrio' ) => 'none',
					esc_html__( 'Always Visible', 'integrio' ) => 'always',
					esc_html__( 'While Hover', 'integrio' ) => 'on_hover',
					esc_html__( 'Until Hover', 'integrio' ) => 'before_hover',
                ),
                'std' => '',
                'group' => esc_html__( 'Style', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // TYPOGRAPHY TAB
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text Font Size', 'integrio' ),
                'param_name' => 'font_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Text Font Weight', 'integrio' ),
                'param_name' => 'font_weight',
                'value' => array(
                    esc_html__( 'Theme defaults', 'integrio' ) => '',
                    esc_html__( '300 / Light', 'integrio' ) => '300',
                    esc_html__( '400 / Regular', 'integrio' ) => '400',
                    esc_html__( '500 / Medium', 'integrio' ) => '500',
                    esc_html__( '600 / SemiBold', 'integrio' ) => '600',
                    esc_html__( '700 / Bold', 'integrio' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'integrio' ) => '800',
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'description' => esc_html__( 'Select custom value.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'integrio' ),
				'param_name' => 'custom_fonts_button',
				'group' => esc_html__( 'Typography', 'integrio' ),
			),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_button',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_button',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
            ),
            // ICON TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Add Icon/Image', 'integrio' ),
                'param_name' => 'icon_type',
                'value' => array(
                    esc_html__( 'None','integrio') => 'none',
                    esc_html__( 'Font','integrio') => 'font',
                    esc_html__( 'Image','integrio') => 'image',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icon Pack', 'integrio' ),
                'param_name' => 'icon_pack',
                'value' => array(
                    esc_html__( 'Fontawesome', 'integrio' ) => 'fontawesome',
                    esc_html__( 'Flaticon', 'integrio' ) => 'flaticon',
                ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Icon Font Size', 'integrio' ),
				'param_name' => 'icon_font_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font'
				),
				'group' => esc_html__( 'Icon', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'integrio' ),
				'param_name' => 'image',
				'value' => '',
				'description' => esc_html__( 'Select image from media library.', 'integrio' ),
				'dependency' => array(
				    'element' => 'icon_type',
				    'value' => 'image'
				),
				'group' => esc_html__( 'Icon', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon Position', 'integrio' ),
				'param_name' => 'icon_position',
				'value' => array(
				    esc_html__( 'Left', 'integrio' ) => 'left',
				    esc_html__( 'Right', 'integrio' ) => 'right'
				),
				'description' => esc_html__( 'Select alignment.', 'integrio' ),
				'dependency' => array(
				    'element' => 'icon_type',
				    'value' => array('image', 'font')
				),
				'group' => esc_html__( 'Icon', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
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
                'dependency' => array(
                    'element' => 'icon_pack',
                    'value' => 'fontawesome',
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'group' => esc_html__( 'Icon', 'integrio' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_flaticon',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => false,
                    'type' => 'flaticon',
                    'iconsPerPage' => 200,
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_pack',
                    'value' => 'flaticon',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Width', 'integrio' ),
                'param_name' => 'img_width',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image'
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // OFFSETS TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Button Paddings', 'integrio' ),
                'param_name' => 'heading',
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Top Padding', 'integrio' ),
                'param_name' => 'top_pad',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Bottom Padding', 'integrio' ),
                'param_name' => 'bottom_pad',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Left Padding', 'integrio' ),
                'param_name' => 'left_pad',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Right Padding', 'integrio' ),
                'param_name' => 'right_pad',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Button Margins', 'integrio' ),
                'param_name' => 'heading',
                'group' => esc_html__( 'Offsets', 'integrio' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Top Margin', 'integrio' ),
                'param_name' => 'top_mar',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Bottom Margin', 'integrio' ),
                'param_name' => 'bottom_mar',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Left Margin', 'integrio' ),
                'param_name' => 'left_mar',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Right Margin', 'integrio' ),
                'param_name' => 'right_mar',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // COLORS TAB
			// Button colors heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Button', 'integrio' ),
                'param_name' => 'h_button_customize',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'integrio' ),
                'param_name' => 'customize',
                'value' => array(
                    esc_html__( 'Theme Defaults', 'integrio' ) => 'def',
                    esc_html__( 'Flat Colors', 'integrio' ) => 'color',
                    esc_html__( 'Gradient Colors', 'integrio' ) => 'gradient',
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_c_1',
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            // Text color idle
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Text Idle', 'integrio' ),
                'param_name' => 'text_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text color hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Text Hover', 'integrio' ),
                'param_name' => 'text_color_hover',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_c_2',
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'divider',
			),
            // Bg color idle
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'integrio' ),
                'param_name' => 'bg_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'customize',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Bg color hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'integrio' ),
                'param_name' => 'bg_color_hover',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'customize',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// Bg gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'integrio' ),
				'param_name' => 'bg_gradient_idle_start',
				'value' =>  $theme_gradient['from'],
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
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
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
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
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
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
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_c_3',
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Idle', 'integrio' ),
				'param_name' => 'border_color',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Hover', 'integrio' ),
				'param_name' => 'border_color_hover',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'integrio' ),
				'param_name' => 'border_gradient_idle_start',
				'value' =>  $theme_gradient['from'],
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'integrio' ),
				'param_name' => 'border_gradient_idle_end',
				'value' =>  $theme_gradient['to'],
				'description' => esc_html__( 'For Idle State.', 'integrio' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'integrio' ),
				'param_name' => 'border_gradient_hover_start',
				'value' =>  $theme_gradient['to'],
				'description' => esc_html__( 'For Hover State.', 'integrio' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'integrio' ),
				'param_name' => 'border_gradient_hover_end',
				'value' =>  $theme_gradient['from'],
				'description' => esc_html__( 'For Hover State.', 'integrio' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            // Icon colors heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'h_icon_color',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
			// Icon color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'integrio' ),
				'param_name' => 'custom_icon_color',
				'group' => esc_html__( 'Colors', 'integrio' ),
				'dependency' => array(
				    'element' => 'icon_type',
				    'value' => 'font'
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Idle', 'integrio' ),
				'param_name' => 'icon_color_idle',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'custom_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Hover', 'integrio' ),
				'param_name' => 'icon_color_hover',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'custom_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Button extends WPBakeryShortCode {
        }
    }
}