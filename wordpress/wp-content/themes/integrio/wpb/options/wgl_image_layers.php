<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Image Layers', 'integrio'),
        'base' => 'wgl_image_layers',
        'class' => 'integrio_image_layers',
        'category' => esc_html__('WGL Modules', 'integrio'),
        'icon' => 'wgl_icon_image_layers',
        'content_element' => true,
        'description' => esc_html__('Display Image Layers','integrio'),
        'params' => array(
            // image styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Layers Settings', 'integrio'),
                'param_name' => 'h_settings',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'integrio' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph', 'integrio' ),
                'params' => array(
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Thumbnail', 'integrio' ),
                        'param_name'    => 'thumbnail',
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Top Offset', 'integrio' ),
                        'param_name'    => 'top_offset',
                        'edit_field_class' => 'vc_col-sm-6',
                        'description' => esc_html__( 'Enter offset in %, for example -100% or 100%', 'integrio' ),
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Left Offset', 'integrio' ),
                        'param_name'    => 'left_offset',
                        'edit_field_class' => 'vc_col-sm-6',
                        'description' => esc_html__( 'Enter offset in %, for example -100% or 100%', 'integrio' ),
                    ),          
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Image Animation', 'integrio' ),
                        'param_name'    => 'image_animation',
                        'edit_field_class' => 'vc_col-sm-6',
                        'value'         => array(
                            esc_html__( 'Fade In', 'integrio' )      => 'fade_in',
                            esc_html__( 'Slide Up', 'integrio' )      => 'slide_up',
                            esc_html__( 'Slide Down', 'integrio' )     => 'slide_down',
                            esc_html__( 'Slide Left', 'integrio' )     => 'slide_left',
                            esc_html__( 'Slide Right', 'integrio' )     => 'slide_right',
                            esc_html__( 'Slide Big Up', 'integrio' )      => 'slide_big_up',
                            esc_html__( 'Slide Big Down', 'integrio' )     => 'slide_big_down',
                            esc_html__( 'Slide Big Left', 'integrio' )     => 'slide_big_left',
                            esc_html__( 'Slide Big Right', 'integrio' )     => 'slide_big_right',
                            esc_html__( 'Slide Big Right', 'integrio' )     => 'slide_big_right',
                            esc_html__( 'Flip Horizontally', 'integrio' )     => 'flip_x',
                            esc_html__( 'Flip Vertically', 'integrio' )     => 'flip_y',
                            esc_html__( 'Zoom In', 'integrio' )     => 'zoom_in',
                        ),
                    ),         
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Image z-index', 'integrio' ),
                        'param_name'    => 'image_order',
                        'value'         => '1',
                        'edit_field_class' => 'vc_col-sm-6',
                    ),  
                ),
            ),
            // images interval
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Interval Images Appearing', 'integrio'),
                'param_name' => 'interval',
                'value' => '600',
                'description' => esc_html__( 'Enter interval in milliseconds', 'integrio' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Transition Speed', 'integrio'),
                'param_name' => 'transition',
                'value' => '800',
                'description' => esc_html__( 'Enter transition speed in milliseconds', 'integrio' ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'integrio' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to button.', 'integrio')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'integrio'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio')
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Image_Layers extends WPBakeryShortCode {
        }
    }
}
