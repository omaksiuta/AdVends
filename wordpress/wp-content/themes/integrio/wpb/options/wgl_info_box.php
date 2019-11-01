<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$theme_gradient_start = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(Integrio_Theme_Helper::get_option('theme-gradient')['to']);
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(Integrio_Theme_Helper::get_option('main-font')['color']);

add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
    wp_enqueue_style( 'flaticon', get_template_directory_uri().'/fonts/flaticon/flaticon.css' );
}

if (function_exists( 'vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__( 'Info Box', 'integrio' ),
        'base' => 'wgl_info_box',
        'class' => 'integrio_info_box',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_info_box',
        'content_element' => true,
        'description' => esc_html__( 'Block with icon','integrio' ),
        'params' => array(
        	// GENERAL TAB
        	// Overall layout radio
			array(
				'type' => 'integrio_radio_image',
				'heading' => esc_html__( 'Overall Layout', 'integrio' ),
				'param_name' => 'layout',
				'fields' => array(
					'top' => array(
					    'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_def.png',
					    'label' => esc_html__( 'Top', 'integrio')),
					'left' => array(
					    'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_left.png',
					    'label' => esc_html__( 'Left', 'integrio')),
					'right' => array(
					    'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_right.png',
					    'label' => esc_html__( 'Right', 'integrio')),
				),
				'value' => 'top',
			),
			// Alignment dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'integrio' ),
				'param_name' => 'alignment',
				'value' => array(
					esc_html__( 'Left', 'integrio' ) => 'left',
					esc_html__( 'Center', 'integrio' ) => 'center',
					esc_html__( 'Right', 'integrio' ) => 'right',
				),
				'std' => 'center',
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Hover effect
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable Hover Animation', 'integrio' ),
				'param_name' => 'hover_animation',
				'description' => esc_html__( 'Lift up the item on Hover State.', 'integrio'),
				'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Link to Whole Item', 'integrio' ),
				'param_name' => 'add_item_link',
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Link', 'integrio' ),
				'param_name' => 'item_link',
				'description' => esc_html__( 'Add link to \'Read More\' button.', 'integrio' ),
				'dependency' => array(
					'element' => 'add_item_link',
					'value' => 'true'
				),
			),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio')
            ),
            // CONTENT TAB
            array(
                'type' => 'textarea',
                'heading' => esc_html__( 'Info Box Title', 'integrio' ),
                'param_name' => 'ib_title',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__( 'Info Box Text', 'integrio' ),
                'param_name' => 'ib_content',
                'save_always' => true,
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Info Box Offsets', 'integrio' ),
				'param_name' => 'ib_offsets',
                'group' => esc_html__( 'Content', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Add Image for Background', 'integrio' ),
                'param_name' => 'ib_bg_image',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'h_shadow',
				'group' => esc_html__( 'Content', 'integrio' ),
			),
			// Info box shadow
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Info-Box Shadow', 'integrio' ),
				'param_name' => 'add_shadow',
				'group' => esc_html__( 'Content', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Info box shadow appearance
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Appearance', 'integrio' ),
				'param_name' => 'shadow_appearance',
				'value'	=> array(
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
				'value'	=> array(
					esc_html__( 'Outset', 'integrio' ) => '',
					esc_html__( 'Inset', 'integrio' ) => 'inset',
				),
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
				'value' => '6',
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
				'value' => '13',
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
                'value' => 'rgba(145,145,145,0.2)',
                'dependency' => array(
                    'element' => 'add_shadow',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			array(
                'type' => 'integrio_param_heading',
                'param_name' => 'h_button_2',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
			// Read more button dropdown
            array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Add \'Read More\' Button', 'integrio' ),
				'param_name' => 'add_read_more',
				'value'	=> array(
					esc_html__( 'None', 'integrio' ) => '',
					esc_html__( 'With Custom Text', 'integrio' ) => 'alphameric',
					esc_html__( 'With Custom Icon', 'integrio' ) => 'icon',
				),
				'group' => esc_html__( 'Content', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text', 'integrio' ),
                'param_name' => 'read_more_text',
                'value' => 'Read More',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value'   => 'alphameric'
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Icon Font Size', 'integrio' ),
                'param_name' => 'read_more_icon_size',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'icon',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// Stick button checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Stick the button', 'integrio' ),
				'param_name' => 'read_more_icon_sticky',
				'description' => esc_html__( 'Attach to the bottom right corner.', 'integrio' ),
				'dependency' => array(
					'element' => 'add_read_more',
					'value' => 'icon'
				),
				'group' => esc_html__( 'Content', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'read_more_icon',
                'value' => 'flaticon-next-1',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon
                    'type' => 'flaticon',
                    'iconsPerPage' => 200, // default 100, defines how many icons will be displayed per page. Use big number to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'icon',
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Link', 'integrio' ),
				'param_name' => 'link',
				'description' => esc_html__( 'Add link to \'Read More\' button.', 'integrio' ),
				'dependency' => array(
					'element' => 'add_read_more',
					'value' => array('alphameric', 'icon')
				),
				'group' => esc_html__( 'Content', 'integrio' ),
			),
            // ICON TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Add Icon or Image', 'integrio' ),
                'param_name' => 'icon_type',
                'value' => array(
                    esc_html__( 'None', 'integrio' ) => 'none',
                    esc_html__( 'Icon', 'integrio' ) => 'font',
                    esc_html__( 'Image', 'integrio' ) => 'image',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon pack dropdown
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icon Pack', 'integrio' ),
                'param_name' => 'icon_font_type',
                'value' => array(
                    esc_html__( 'Flaticon', 'integrio' ) => 'type_flaticon',
                    esc_html__( 'Fontawesome', 'integrio' ) => 'type_fontawesome',
                ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            // Icon font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Icon Font Size', 'integrio' ),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Icon', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust',
                'settings' => array(
                    'emptyIcon' => false,
                    'type' => 'fontawesome',
                    'iconsPerPage' => 200,
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_fontawesome',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_flaticon',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon
                    'type' => 'flaticon',
                    'iconsPerPage' => 200, // default 100, defines how many icons will be displayed per page. Use big number to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_flaticon',
                ),
                'group' => esc_html__( 'Icon', 'integrio' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image from Media Library ', 'integrio' ),
                'param_name' => 'thumbnail',
                'value' => '',
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
			// Icon full width
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Full Width Image', 'integrio' ),
				'param_name' => 'bg_full_width',
                'description' => esc_html__( 'Define as \'100%\'.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image'
                ),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-2 no-top-padding',
			),
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
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'h_icon_shadow',
				'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('font', 'image')
                ),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
			),
			// Icon container shadow checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Container Shadow', 'integrio' ),
				'param_name' => 'add_icon_shadow',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array('font', 'image')
				),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon container shadow appearance
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Appearance', 'integrio' ),
				'param_name' => 'icon_shadow_appearance',
				'value'	=> array(
					esc_html__( 'Visible While Hover', 'integrio' ) => 'on_hover',
					esc_html__( 'Visible Until Hover', 'integrio' ) => 'before_hover',
					esc_html__( 'Always Visible', 'integrio' ) => 'always',
				),
				'std' => 'always',
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true'
				),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-8',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Type', 'integrio' ),
				'param_name' => 'icon_shadow_type',
				'value'	=> array(
					esc_html__( 'Outset', 'integrio' ) => '',
					esc_html__( 'Inset', 'integrio' ) => 'inset',
				),
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true'
				),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'X Offset', 'integrio' ),
				'param_name' => 'icon_shadow_offset_x',
				'value' => '0',
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true',
				),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Y Offset', 'integrio' ),
				'param_name' => 'icon_shadow_offset_y',
				'value' => '6',
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true',
				),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Blur', 'integrio' ),
				'param_name' => 'icon_shadow_blur',
				'value' => '13',
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true',
				),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-1',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Spread', 'integrio' ),
				'param_name' => 'icon_shadow_spread',
				'value' => '0',
				'dependency' => array(
					'element' => 'add_icon_shadow',
					'value' => 'true',
				),
				'group' => esc_html__( 'Icon Container', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-1',
			),
			array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'integrio' ),
                'param_name' => 'icon_shadow_color',
                'value' => 'rgba(145,145,145,0.2)',
                'dependency' => array(
                    'element' => 'add_icon_shadow',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Icon Container', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // COLORS TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Title Colors', 'integrio' ),
                'param_name' => 'h_title_colors',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
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
                'heading' => esc_html__( 'Title Idle', 'integrio' ),
                'param_name' => 'title_color',
                'value' => $header_font_color,
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Hover', 'integrio' ),
                'param_name' => 'title_color_hover',
                'value' => $header_font_color,
                'description' => esc_html__( 'While Info Box at Hover State', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Content colors heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Content Colors', 'integrio' ),
                'param_name' => 'h_content_colors',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Content color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_content_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Content color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Content Idle', 'integrio' ),
                'param_name' => 'content_color',
                'value' => $main_font_color,
                'dependency' => array(
                    'element' => 'custom_content_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Content Hover', 'integrio' ),
                'param_name' => 'content_color_hover',
                'value' => $main_font_color,
                'description' => esc_html__( 'While Info Box at Hover State', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_content_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Icon Colors', 'integrio' ),
                'param_name' => 'h_icon_colors',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_icon_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Idle', 'integrio' ),
                'param_name' => 'icon_color',
                'value' => $theme_color,
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
                'value' => $theme_color,
                'description' => esc_html__( 'While Info Box at Hover State', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon/image container color heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Icon Container Colors', 'integrio' ),
                'param_name' => 'h_icon_bg_colors',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon container colors dropdown
            array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customize Colors', 'integrio' ),
				'param_name' => 'custom_icon_bg_color',
				'value' => array(
					esc_html__( 'Theme defaults', 'integrio' ) => '',
					esc_html__( 'Flat colors', 'integrio' ) => 'color',
					esc_html__( 'Gradient colors', 'integrio' ) => 'gradient',
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            // Icon container color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Container Background Idle', 'integrio' ),
                'param_name' => 'icon_bg_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_icon_bg_color',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// Icon container hover color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Container Background Hover', 'integrio' ),
				'param_name' => 'icon_bg_color_hover',
				'value' => '#ffffff',
				'description' => esc_html__( 'While Info Box at Hover State', 'integrio' ),
				'dependency' => array(
					'element' => 'custom_icon_bg_color',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon container gradient start color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Container Gradient Start', 'integrio' ),
				'param_name' => 'icon_bg_gradient_start',
				'value' => $theme_gradient_start,
				'dependency' => array(
					'element' => 'custom_icon_bg_color',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon container gradient end color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Container Gradient End', 'integrio' ),
				'param_name' => 'icon_bg_gradient_end',
				'value' => $theme_gradient_end,
				'dependency' => array(
					'element' => 'custom_icon_bg_color',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            // Icon/image border
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Icon Border Colors', 'integrio' ),
                'param_name' => 'h_icon_border_colors',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon container border color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_icon_border_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon container border color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Border Idle', 'integrio' ),
                'param_name' => 'icon_border_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'custom_icon_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon container border hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Border Hover', 'integrio' ),
                'param_name' => 'icon_border_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__( 'While Info Box at Hover State', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_icon_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			// Background color
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Info Box Background Colors', 'integrio' ),
				'param_name' => 'h_bg_colors',
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Background color dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customize Colors', 'integrio' ),
				'param_name' => 'custom_bg_color',
				'value' => array(
					esc_html__( 'Theme defaults', 'integrio' ) => '',
					esc_html__( 'Flat colors', 'integrio' ) => 'color',
					esc_html__( 'Gradient colors', 'integrio' ) => 'gradient',
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Background idle color 
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'integrio' ),
				'param_name' => 'ib_bg_color',
				'value' => '#f6f5f3',
				'dependency' => array(
					'element' => 'custom_bg_color',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            // Background hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'integrio' ),
                'param_name' => 'ib_bg_color_hover',
                'value' => '#f6f5f3',
                'description' => esc_html__( 'While Info Box at Hover State', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_bg_color',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			// Background gradient start color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'integrio' ),
				'param_name' => 'ib_bg_gradient_start',
				'value' => $theme_gradient_start,
				'dependency' => array(
					'element' => 'custom_bg_color',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Background gradient end color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'integrio' ),
				'param_name' => 'ib_bg_gradient_end',
				'value' => $theme_gradient_end,
				'dependency' => array(
					'element' => 'custom_bg_color',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'integrio' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Info Box Border Colors', 'integrio' ),
                'param_name' => 'h_border_colors',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Border color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_border_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Border color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Border Idle', 'integrio' ),
                'param_name' => 'border_color',
                'value' => '#cbcbcb',
                'dependency' => array(
                    'element' => 'custom_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Border color hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Border Hover', 'integrio' ),
                'param_name' => 'border_color_hover',
                'value' => '#cbcbcb',
                'description' => esc_html__( 'While Info Box at Hover State', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_border_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ), 
            // Button colors
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Button Colors', 'integrio' ),
                'param_name' => 'h_button_colors',
                'group' => esc_html__( 'Colors', 'integrio' ),
            ),
            // Button color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_button_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Button color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Button Idle', 'integrio' ),
                'param_name' => 'button_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_button_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Button color hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Button Hover', 'integrio' ),
                'param_name' => 'button_color_hover',
                'value' => $header_font_color,
                'description' => esc_html__( 'While Button at Hover State', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_button_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // button color on info box hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Button Hover Color', 'integrio' ),
                'param_name' => 'button_color_item_hover',
                'value' => $header_font_color,
                'description' => esc_html__( 'While Info Box at Hover State', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_button_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Title Styles', 'integrio' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Tag', 'integrio' ),
                'param_name' => 'title_tag',
                'value' => array(
                    esc_html__( '‹span›', 'integrio' ) => 'span',
                    esc_html__( '‹div›', 'integrio' ) => 'div',
                    esc_html__( '‹h2›', 'integrio' ) => 'h2',
                    esc_html__( '‹h3›', 'integrio' ) => 'h3',
                    esc_html__( '‹h4›', 'integrio' ) => 'h4',
                    esc_html__( '‹h5›', 'integrio' ) => 'h5',
                    esc_html__( '‹h6›', 'integrio' ) => 'h6',
                ),
                'std' => 'h3',
                'description' => esc_html__( 'Choose your tag for info box title', 'integrio' ),
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
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title margin bottom
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Bottom Offset', 'integrio' ),
                'param_name' => 'title_bot_offset',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title Fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
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
            // Content styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Content Styles', 'integrio' ),
                'param_name' => 'h_content_styles',
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Content Tag', 'integrio' ),
                'param_name' => 'content_tag',
                'value' => array(
                    esc_html__( '‹span›', 'integrio' ) => 'span',
                    esc_html__( '‹div›', 'integrio' ) => 'div',
                    esc_html__( '‹h2›', 'integrio' ) => 'h2',
                    esc_html__( '‹h3›', 'integrio' ) => 'h3',
                    esc_html__( '‹h4›', 'integrio' ) => 'h4',
                    esc_html__( '‹h5›', 'integrio' ) => 'h5',
                    esc_html__( '‹h6›', 'integrio' ) => 'h6',
                ),
                'std' => 'div',
                'group' => esc_html__( 'Typography', 'integrio' ),
                'description' => esc_html__( 'Select html tag for content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Content font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Content Font Weight', 'integrio' ),
                'param_name' => 'content_weight',
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
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Content font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Font Size', 'integrio' ),
                'param_name' => 'content_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Content line height
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Line Height', 'integrio' ),
                'param_name' => 'content_line_height',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Content Fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_content',
                'group' => esc_html__( 'Typography', 'integrio' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_content',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_content',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'integrio' ),
            ),
            // Button styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( '\'Read More\' Button Styles', 'integrio' ),
                'param_name' => 'h_button_styles',
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Button Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Font Size', 'integrio' ),
                'param_name' => 'button_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Top Offset', 'integrio' ),
                'param_name' => 'read_more_offset',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Typography', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Button Fonts
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
        )
    ));
    
    if (class_exists( 'WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_info_box extends WPBakeryShortCode {
            
        }
    } 
}
