<?php
if ( !defined('ABSPATH') ) { die('-1'); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__( 'Counter', 'integrio' ),
        'base' => 'wgl_counter',
        'class' => 'integrio_counter',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_counter',
        'content_element' => true,
        'description' => esc_html__( 'Counter','integrio' ),
        'params' => array(
            array(
                'type' => 'integrio_radio_image',
                'heading' => esc_html__( 'Overall Layout', 'integrio' ),
                'param_name' => 'counter_layout',
                'fields' => array(
                    'top' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_def.png',
                        'label' => esc_html__( 'Top', 'integrio' )),
                    'left' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_left.png',
                        'label' => esc_html__( 'Left', 'integrio' )),
                    'right' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_right.png',
                        'label' => esc_html__( 'Right', 'integrio' )),
                ),
                'value' => 'top',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'integrio' ),
                'param_name' => 'counter_align',
                'value' => array(
                    esc_html__( 'Left', 'integrio' ) => 'left',
                    esc_html__( 'Center', 'integrio' ) => 'center',
                    esc_html__( 'Right', 'integrio' ) => 'right',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            // CONTENT TAB
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title', 'integrio' ),
                'param_name' => 'count_title',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Counter Divider', 'integrio' ),
                'param_name' => 'add_counter_divider',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Prefix', 'integrio' ),
                'description' => esc_html__( 'Enter prefix before counter value.', 'integrio' ),
                'param_name' => 'count_prefix',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value', 'integrio' ),
                'description' => esc_html__( 'Enter number without any special character', 'integrio' ),
                'param_name' => 'count_value',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Suffix', 'integrio' ),
                'description' => esc_html__( 'Enter suffix after counter value.', 'integrio' ),
                'param_name' => 'count_suffix',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'Counter Offsets', 'integrio' ),
                'param_name' => 'counter_offsets',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'h_shadow',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            // Counter shadow
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Counter Shadow', 'integrio' ),
                'param_name' => 'add_shadow',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Counter shadow appearance
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Shadow Appearance', 'integrio' ),
                'param_name' => 'shadow_appearance',
                'value' => array(
                    esc_html__( 'Visible While Hover', 'integrio' ) => 'on_hover',
                    esc_html__( 'Visible Until Hover', 'integrio' ) => 'before_hover',
                    esc_html__( 'Always Visible', 'integrio' ) => 'always',
                ),
                'std' => 'always',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Shadow Type', 'integrio' ),
                'param_name' => 'shadow_type',
                'value' => array(
                    esc_html__( 'Outset', 'integrio' ) => '',
                    esc_html__( 'Inset', 'integrio' ) => 'inset',
                ),
                'std' => 'inset',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'X Offset', 'integrio' ),
                'param_name' => 'shadow_offset_x',
                'value' => '0',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Y Offset', 'integrio' ),   
                'param_name' => 'shadow_offset_y',
                'value' => '14',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Blur', 'integrio' ),
                'param_name' => 'shadow_blur',
                'value' => '10',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-1',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Spread', 'integrio' ),
                'param_name' => 'shadow_spread',
                'value' => '0',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-1',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'integrio' ),
                'param_name' => 'shadow_color',
                'value' => 'rgba(0,0,0,0.06)',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // ICON TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Add icon/image', 'integrio' ),
                'param_name' => 'icon_type',
                'value' => array(
                    esc_html__( 'None', 'integrio' ) => '',
                    esc_html__( 'Font', 'integrio' ) => 'font',
                    esc_html__( 'Image', 'integrio' ) => 'image',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
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
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Custom Icon Size', 'integrio' ),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'settings' => array(
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon?
                    'iconsPerPage' => 200, // ddefault 100, defines how many icons will be displayed per page. Use big number to display all icons in single page
                ),
                'dependency' => array(
                    'element' => 'icon_pack',
                    'value' => 'fontawesome',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_flaticon',
                'value' => '',
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'settings' => array(
                    'emptyIcon' => false,
                    'type' => 'flaticon',
                    'iconsPerPage' => 200, 
                ),
                'dependency' => array(
                    'element' => 'icon_pack',
                    'value' => 'flaticon',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'integrio' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-8 no-top-padding',
            ),
            // Image width
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Width', 'integrio' ),
                'param_name' => 'custom_image_width',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Image height
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Height', 'integrio' ),
                'param_name' => 'custom_image_height',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // ICON CONTAINER TAB
            // Icon container width
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Container Width', 'integrio' ),
                'param_name' => 'custom_icon_bg_width',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('font', 'image')
                ),
                'group' => esc_html__( 'Icon Container', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5 no-top-padding',
            ),
			// Icon container height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Container Height', 'integrio' ),
				'param_name' => 'custom_icon_bg_height',
				'description' => esc_html__( 'Value in pixels.', 'integrio' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array('font', 'image')
				),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-5 no-top-padding',
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Icon Offsets', 'integrio' ),
				'param_name' => 'icon_offsets',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array('font', 'image')
				),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
			),
            // COLORS TAB
            // Value colors
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Value colors', 'integrio' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Value color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_value_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Value color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Value Color', 'integrio' ),
                'param_name' => 'value_color',
                'value' => $header_font_color,
                'dependency' => array(
                    'element' => 'custom_value_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Use text-stroke effect
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Text-Stroke', 'integrio' ),
                'param_name' => 'add_value_text_stroke',
                'dependency' => array(
                    'element' => 'custom_value_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text-stroke color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Text-stroke Color', 'integrio' ),
                'param_name' => 'value_text_stroke_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'add_value_text_stroke',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Title Colors', 'integrio' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'integrio' ),
                'param_name' => 'title_color',
                'value' => $header_font_color,
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon colors heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Icon Colors', 'integrio' ),
                'param_name' => 'h_icon_colors',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_icon_color',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Idle', 'integrio' ),
                'param_name' => 'icon_color',
                'value' => '#000000',
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Hover', 'integrio' ),
                'param_name' => 'icon_color_hover',
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_c_1',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // IC border color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Border Colors', 'integrio' ),
                'param_name' => 'custom_icon_border_color',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('font', 'image')
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // IC border idle
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Container Border Idle', 'integrio' ),
                'param_name' => 'icon_border_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_icon_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // IC border hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Container Border Hover', 'integrio' ),
                'param_name' => 'icon_border_color_hover',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_icon_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_c_2',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // IC bg color dropdown
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize Backgrounds', 'integrio' ),
                'param_name' => 'icon_bg_color_type',
                'value' => array(
                    esc_html__( 'Theme defaults', 'integrio' ) => '',
                    esc_html__( 'Flat colors', 'integrio' ) => 'color',
                    esc_html__( 'Gradient colors', 'integrio' ) => 'gradient',
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('font', 'image')
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // IC bg idle
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'integrio' ),
                'param_name' => 'icon_bg_color',
                'value' => '#000000',
                'dependency' => array(
                    'element' => 'icon_bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // IC bg hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'integrio' ),
                'param_name' => 'icon_bg_color_hover',
                'dependency' => array(
                    'element' => 'icon_bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
            // IC Background gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Start Color', 'integrio' ),
                'param_name' => 'icon_bg_gradient_start',
                'value' => $theme_gradient_start,
                'dependency' => array(
                    'element' => 'icon_bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // IC Background gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background End Color', 'integrio' ),
                'param_name' => 'icon_bg_gradient_end',
                'value' => $theme_gradient_end,
                'dependency' => array(
                    'element' => 'icon_bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // TYPOGRAPHY TAB
            // Title styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Counter Title Styles', 'integrio' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Title Tag dropdown
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Tag', 'integrio' ),
                'param_name' => 'title_tag',
                'value' => array(
                    esc_html__( '‹div›', 'integrio' ) => 'div',
                    esc_html__( '‹h2›', 'integrio' ) => 'h2',
                    esc_html__( '‹h3›', 'integrio' ) => 'h3',
                    esc_html__( '‹h4›', 'integrio' ) => 'h4',
                    esc_html__( '‹h5›', 'integrio' ) => 'h5',
                    esc_html__( '‹h6›', 'integrio' ) => 'h6',
                    esc_html__( '‹span›', 'integrio' ) => 'span',
                ),
                'std' => 'div',
                'group' => esc_html__( 'Typography', 'integrio' ),
                'description' => esc_html__( 'Select html tag for title.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title margin top
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Margin Top', 'integrio' ),
                'param_name' => 'title_margin_top',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'integrio' ),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Font Weight', 'integrio' ),
                'param_name' => 'title_weight',
                'value' => array(
                    esc_html__( 'Theme Default', 'integrio' ) => '',
                    esc_html__( '300 / Light', 'integrio' ) => '300',
                    esc_html__( '400 / Regular', 'integrio' ) => '400',
                    esc_html__( '500 / Medium', 'integrio' ) => '500',
                    esc_html__( '600 / SemiBold', 'integrio' ) => '600',
                    esc_html__( '700 / Bold', 'integrio' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'integrio' ) => '800',
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'description' => esc_html__( 'Select custom value.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family.', 'integrio' ),
                'param_name' => 'custom_fonts_title',
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
            // Value styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Counter Value Styles', 'integrio' ),
                'param_name' => 'h_count_value_styles',
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Value container height
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Container Height', 'integrio' ),
                'param_name' => 'value_height',
                'value' => '',
                'description' => esc_html__( 'Value wrapper height in pixels. Note: value may be cropped from bottom.', 'integrio' ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-10',
            ),
            // Value font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Font Size', 'integrio' ),
                'param_name' => 'value_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Value font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Value Font Weight', 'integrio' ),
                'param_name' => 'value_weight',
                'value' => array(
                    esc_html__( 'Theme Default', 'integrio' ) => '',
                    esc_html__( '300 / Light', 'integrio' ) => '300',
                    esc_html__( '400 / Regular', 'integrio' ) => '400',
                    esc_html__( '500 / Medium', 'integrio' ) => '500',
                    esc_html__( '600 / SemiBold', 'integrio' ) => '600',
                    esc_html__( '700 / Bold', 'integrio' ) => '700',
                    esc_html__( '800 / Extra Bold', 'integrio' ) => '800',
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'description' => esc_html__( 'Select custom value.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Value custom fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_count_value',
                'group' => esc_html__( 'Typography', 'integrio' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_count_value',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_count_value',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Counter extends WPBakeryShortCode {
        }
    }
}