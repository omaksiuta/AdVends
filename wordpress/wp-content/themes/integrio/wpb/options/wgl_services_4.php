<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(Integrio_Theme_Helper::get_option("theme-custom-color"));
$header_font_color = esc_attr(Integrio_Theme_Helper::get_option('header-font')['color']);

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        'name' => esc_html__('Services 4', 'integrio'),
        'base' => 'wgl_services_4',
        'class' => 'integrio_services_4',
        'category' => esc_html__('WGL Modules', 'integrio'),
        'icon' => 'wgl_icon_services_4',
        'content_element' => true,
        'description' => esc_html__('Add Services','integrio'),
        'params' => array(
            // General
            array(
                'type' => 'dropdown',
                'param_name' => 'icon_type',
                'heading' => esc_html__( 'Media', 'integrio' ),
                'value' => array(
                    esc_html__( 'None', 'integrio' )  => 'none',
                    esc_html__( 'Font', 'integrio' )  => 'font',
                    esc_html__( 'Image', 'integrio' ) => 'image',
                ),
                'save_always' => true,
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'icon_font_type',
                'value' => array(
                    esc_html__( 'Flaticon', 'integrio' )    => 'type_flaticon',
                    esc_html__( 'Fontawesome', 'integrio' ) => 'type_fontawesome',
                ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_fontawesome',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'integrio' ),
                'param_name' => 'icon_flaticon',
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon
                    'type' => 'flaticon',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_font_type',
                    'value' => 'type_flaticon',
                ),
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
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Icon Size', 'integrio'),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Enter Icon size in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__( 'Title', 'integrio' ),
                "param_name" => "title",
                'admin_label' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__( 'Subtitle', 'integrio' ),
                "param_name" => "subtitle",
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__( 'Content', 'integrio' ),
                "param_name" => "service_content",
            ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'integrio' ),
				'param_name' => 'alignment',
				'value' => array(
					esc_html__( 'Left', 'integrio' ) => 'left',
					esc_html__( 'Right', 'integrio' ) => 'right',
					esc_html__( 'Center', 'integrio' ) => 'center',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Item Paddings Left/Right', 'integrio' ),
                'param_name' => 'item_pad',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Item Paddings Top', 'integrio' ),
                'param_name' => 'item_pad_top',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Shadow', 'integrio' ),
                'description' => esc_html__( 'Add shadow instead of border', 'integrio' ),
                'param_name' => 'add_shadow',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Link', 'integrio' ),
                'param_name' => 'add_link',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'For Container Itself', 'integrio' ),
                'param_name' => 'link_container',
                'dependency' => array(
                    'element' => 'add_link',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'integrio' ),
                'param_name' => 'link',
                'dependency' => array(
                    'element' => 'add_link',
                    'value' => 'true'
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'integrio'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'integrio')
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Custom Colors', 'integrio'),
                'param_name' => 'h_custom_colors',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'integrio'),
                'param_name' => 'title_color',
                'value' => $header_font_color,
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Color', 'integrio'),
                'param_name' => 'icon_color',
                'value' => $theme_color,
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Title Styles', 'integrio'),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Title font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'integrio' ),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Styles', 'integrio' ),
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
                'group' => esc_html__( 'Styles', 'integrio' ),
                'description' => esc_html__( 'Select custom value.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Content Styles', 'integrio'),
                'param_name' => 'h_content_styles',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // content font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Font Size', 'integrio' ),
                'param_name' => 'content_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Services_4 extends WPBakeryShortCode {
        }
    }
}