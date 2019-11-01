<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Integrio_Theme_Helper::get_option( 'theme-custom-color' ));

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Social Icons', 'integrio' ),
        'base' => 'wgl_soc_icons',
        'class' => 'integrio_soc_icons',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_social-icons',
        'content_element' => true,
        'description' => esc_html__( 'Display Social Icons','integrio' ),
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'integrio' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Define social icons parameters - title, link and colors.', 'integrio' ),
                'value' => urlencode( json_encode( array(
                    array(
                        'link' => 'https://www.facebook.com/',
                        'icon' => 'fa fa-facebook',
                        'title' => esc_html__( 'Facebook', 'integrio' ),
                        'new_tab' => true,
                    ),
                    array(
                        'link' => 'https://twitter.com/',
                        'icon' => 'fa fa-twitter',
                        'title' => esc_html__( 'Twitter', 'integrio' ),
                        'new_tab' => true,
                    ),
                    array(
                        'link' => 'https://www.instagram.com/',
                        'icon' => 'fa fa-instagram',
                        'title' => esc_html__( 'Instagram', 'integrio' ),
                        'new_tab' => true,
                    ),
                ) ) ),
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__( 'Icon', 'integrio' ),
                        'param_name' => 'icon',
                        'value' => 'fa fa-adjust', // default value to backend editor admin_label
                        'settings' => array(
                            'emptyIcon' => true,
                            // default true, display an 'EMPTY' icon?
                            'iconsPerPage' => 200,
                            // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                        ),
                        'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                        'edit_field_class' => 'vc_col-sm-12',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title', 'integrio' ),
                        'param_name' => 'title',
                        'admin_label' => true,
                        'edit_field_class' => 'vc_col-sm-5',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Link', 'integrio' ),
                        'param_name' => 'link',
                        'admin_label' => true,
                        'edit_field_class' => 'vc_col-sm-7',
                    ),
                    array(
                        'type' => 'wgl_checkbox',
                        'heading' => esc_html__( 'Custom Colors', 'integrio' ),
                        'param_name' => 'custom_colors',
                        'edit_field_class' => 'vc_col-sm-5',
                    ),
                    array(
                        'type' => 'wgl_checkbox',
                        'heading' => esc_html__( 'Open in New Tab', 'integrio' ),
                        'param_name'    => 'new_tab',
                        'std' => 'true',
                        'edit_field_class' => 'vc_col-sm-7',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Icon Idle', 'integrio' ),
                        'param_name' => 'icon_color',
                        'value' => '#ffffff',
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-3',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Icon Hover', 'integrio' ),
                        'param_name' => 'icon_hover_color',
                        'value' => $theme_color,
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-9',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Background Idle', 'integrio' ),
                        'param_name' => 'bg_color',
                        'value' => $theme_color,
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-3',
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__( 'Background Hover', 'integrio' ),
                        'param_name' => 'bg_hover_color',
                        'value' => '#ffffff',
                        'dependency' => array(
                            'element' => 'custom_colors',
                            'value' => 'true'
                        ),
                        'edit_field_class' => 'vc_col-sm-9',
                    ),
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icons Alignment', 'integrio' ),
                'param_name' => 'icons_pos',
                'value' => array(
                    esc_html__( 'Left', 'integrio' ) => 'left',
                    esc_html__( 'Center', 'integrio' ) => 'center',
                    esc_html__( 'Right', 'integrio' ) => 'right',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Display inline checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Display: Inline', 'integrio' ),
                'param_name' => 'display_inline',
                'description' => esc_html__( 'Fill content width.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_1',
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Gap Between Icons', 'integrio' ),
                'param_name' => 'icon_gap',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon container dimensions (width, height, line-height)
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Icon Container Dimensions', 'integrio' ),
                'param_name' => 'bg_size',
                'description' => esc_html__( 'Width and height in pixels.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Border radius
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Border Radius', 'integrio' ),
                'param_name' => 'border_radius',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Add animated element
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Box Shadow', 'integrio' ),
                'param_name' => 'add_box_shadow_element',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Icon Font Size', 'integrio' ),
                'param_name' => 'icon_size',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            // COLORS TAB
            // Icon colors checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'all_custom_colors',
                'description' => esc_html__( 'For all icons.', 'integrio' ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Colored bg checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Colored Background', 'integrio' ),
                'param_name' => 'add_bg',
                'description' => esc_html__( 'For all icons.', 'integrio' ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9 no-top-padding',
            ),
            // Icon colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icons Idle', 'integrio' ),
                'param_name' => 'all_icon_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'all_custom_colors',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon hover colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icons Hover', 'integrio' ),
                'param_name' => 'all_icon_hover_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'all_custom_colors',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            // Icon bg colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Backgrounds Idle', 'integrio' ),
                'param_name' => 'all_bg_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'add_bg',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Custom icon bg colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Backgrounds Hover', 'integrio' ),
                'param_name' => 'all_bg_hover_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'add_bg',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Borders Idle', 'integrio' ),
                'param_name' => 'all_border_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'add_bg',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Borders Hover', 'integrio' ),
                'param_name' => 'all_border_hover_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'add_bg',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            // OFFSET TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Side offsets', 'integrio' ),
                'param_name' => 'heading',
                'dependency' => array(
                    'element' => 'display_inline',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Margin Left', 'integrio' ),
                'param_name' => 'left_margin',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'display_inline',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Margin Right', 'integrio' ),
                'param_name' => 'right_margin',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'display_inline',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Padding Left', 'integrio' ),
                'param_name' => 'left_padding',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'display_inline',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Padding Right', 'integrio' ),
                'param_name' => 'right_padding',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'display_inline',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Offsets', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
        )
    ));

    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_Soc_Icons extends WPBakeryShortCode {
        }
    }
}
