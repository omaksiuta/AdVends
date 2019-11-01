<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}


if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        'name' => esc_html__('Earth', 'integrio'),
        'base' => 'wgl_earth',
        'class' => 'integrio_spacing',
        'category' => esc_html__('WGL Modules', 'integrio'),
        'icon' => 'wgl_icon_earth',
        'content_element' => true,
        'description' => esc_html__('Earth moving','integrio'),
        'params' => array(
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Sphere', 'integrio'),
                'param_name' => 'figure_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select sphere color', 'integrio'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Sphere Width', 'integrio'),
                'param_name' => 'width',
                'value' => '750',
                'description' => esc_html__( 'Enter size of sphere in px.', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'param_name' => 'add_second_sphere',                    
                'heading' => esc_html__( 'Add Inside Second Sphere', 'integrio' ),
            ),   
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_earth extends WPBakeryShortCode {
            
        }
    } 
}