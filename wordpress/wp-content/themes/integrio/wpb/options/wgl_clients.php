<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Clients', 'integrio' ),
        'base' => 'wgl_clients',
        'class' => 'integrio_clients',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'icon' => 'wgl_icon_clients',
        'content_element' => true,
        'description' => esc_html__( 'Display Clients','integrio' ),
        'params' => array(
            // GENERAL TAB
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'integrio' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Specify values for each item - thumbnail(s) and link.', 'integrio' ),
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Thumbnail', 'integrio' ),
                        'param_name' => 'thumbnail',
                        'edit_field_class' => 'vc_col-sm-5',
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Hover Thumbnail', 'integrio' ),
                        'param_name' => 'hover_thumbnail',
                        'description' => esc_html__( 'Need for \'Exchange Images\' and \'Shadow\' animations only.', 'integrio' ),
                        'edit_field_class' => 'vc_col-sm-6 no-top-padding',
                    ),
                    array(
                        'type' => 'wgl_checkbox',
                        'heading' => esc_html__( 'Add Link', 'integrio' ),
                        'param_name' => 'add_link',
                        'edit_field_class' => 'vc_col-sm-12',
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link', 'integrio' ),
                        'param_name' => 'link',
                        'description' => esc_html__( 'Add link to client image.', 'integrio' ),
                        'dependency' => array(
                            'element' => 'add_link',
                            'value' => 'true'
                        ),
                    ),
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Grid Columns Amount', 'integrio' ),
                'param_name' => 'item_grid',
                'value' => array(
                    esc_html__( '1 Column', 'integrio' ) => '1',
                    esc_html__( '2 Columns', 'integrio' ) => '2',
                    esc_html__( '3 Columns', 'integrio' ) => '3',
                    esc_html__( '4 Columns', 'integrio' ) => '4',
                    esc_html__( '5 Columns', 'integrio' ) => '5',
                    esc_html__( '6 Columns', 'integrio' ) => '6',
                ),
                'std' => '4',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Thumbnail Animation', 'integrio' ),
                'param_name' => 'item_anim',
                'value' => array(
                    esc_html__( 'Grayscale', 'integrio' ) => 'grayscale',
                    esc_html__( 'Opacity', 'integrio' ) => 'opacity',
                    esc_html__( 'Shadow', 'integrio' ) => 'shadow',
                    esc_html__( 'Zoom', 'integrio' ) => 'zoom',
                    esc_html__( 'Contrast', 'integrio' ) => 'contrast',
                    esc_html__( 'Blur', 'integrio' ) => 'blur',
                    esc_html__( 'Invert', 'integrio' ) => 'invert',
                    esc_html__( 'Exchange Images', 'integrio' ) => 'ex_images',
                ),
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            // CAROUSEl TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Carousel', 'integrio' ),
                'param_name' => 'use_carousel',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Autoplay', 'integrio' ),
                'param_name' => 'autoplay',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-1 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Autoplay Speed', 'integrio' ),
                'param_name' => 'autoplay_speed',
                'value' => '3000',
                'description' => esc_html__( 'Value in milliseconds.', 'integrio' ),
                'dependency' => array(
                    'element' => 'autoplay',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Responsive Settings', 'integrio' ),
                'param_name' => 'h_resp',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'integrio' ),
                'param_name' => 'custom_resp',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Desktop resolution
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Desktop Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_1',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // Tablets resolution
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablet Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_2',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // Mobile resolution
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Mobile Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
        )
    ));

    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_Clients extends WPBakeryShortCode {
        }
    }
}
