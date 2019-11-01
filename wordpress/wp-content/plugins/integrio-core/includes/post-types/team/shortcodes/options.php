<?php
if (!class_exists('Integrio_Theme_Helper')) { return; }

$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(Integrio_Theme_Helper::get_option('theme-secondary-color'));
$header_font = Integrio_Theme_Helper::get_option('header-font');

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'wgl_team',
        'name' => esc_html__( 'Team List', 'integrio' ),
        'description' => esc_html__( 'Show Team Grid', 'integrio' ),
        'icon' => 'wgl_icon_team',
        'category' => esc_html__( 'WGL Modules', 'integrio' ),
        'params' => array(
            // GENERAL TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Columns in Row', 'integrio' ),
                'param_name' => 'posts_per_line',
                'admin_label' => true,
                'value' => array(
                    esc_html__( '1 Column', 'integrio' ) => '1',
                    esc_html__( '2 Columns', 'integrio' ) => '2',
                    esc_html__( '3 Columns', 'integrio' ) => '3',
                    esc_html__( '4 Columns', 'integrio' ) => '4',
                    esc_html__( '5 Columns', 'integrio' ) => '5',
                ),
                'std' => '3',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Team Info Alignment', 'integrio' ),
                'param_name' => 'info_align',
                'admin_label' => true,
                'value' => array(
                    esc_html__( 'Left', 'integrio' ) => 'left',
                    esc_html__( 'Center', 'integrio' ) => 'center',
                    esc_html__( 'Right', 'integrio' ) => 'right',
                ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Gap Between Items', 'integrio' ),
                'param_name' => 'grid_gap',
                'value' => array(
                    esc_html__( '0px', 'integrio' ) => '0',
                    esc_html__( '2px', 'integrio' ) => '2',
                    esc_html__( '4px', 'integrio' ) => '4',
                    esc_html__( '6px', 'integrio' ) => '6',
                    esc_html__( '10px', 'integrio' ) => '10',
                    esc_html__( '20px', 'integrio' ) => '20',
                    esc_html__( '30px', 'integrio' ) => '30',
                ),
                'std' => '30',
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_1',
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Link for Image', 'integrio' ),
                'param_name' => 'single_link_wrapper',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Link for Heading', 'integrio' ),
                'param_name' => 'single_link_heading',
                'value' => 'true',
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_2',
				'edit_field_class' => 'divider',
			),
            // Hide title checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Title', 'integrio' ),
                'param_name' => 'hide_title',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Hide department checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Department', 'integrio' ),
                'param_name' => 'hide_department',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Hide socials checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Social Icons', 'integrio' ),
                'param_name' => 'hide_soc_icons',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'item_el_class',
                'description' => esc_html__( 'To customly style particular element, use this field to add a class name and then refer to it fron Custom CSS settings.', 'integrio' ),
            ),
            // CAROUSEL TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Carousel', 'integrio' ),
                'param_name' => 'use_carousel',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-margin',
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
                    'element'   => 'autoplay',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_ca_1',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Infinite Loop Sliding', 'integrio' ),
                'param_name' => 'carousel_infinite',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Slide per single item at a time', 'integrio' ),
                'param_name' => 'scroll_items',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Center Mode', 'integrio' ),
                'param_name' => 'center_mode',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Сarousel pagination style
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Pagination Style', 'integrio' ),
                'param_name' => 'h_pag_controls',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'integrio' ),
                'param_name' => 'use_pagination',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'integrio_radio_image',
                'heading' => esc_html__( 'Pagination Type', 'integrio' ),
                'param_name' => 'pag_type',
                'fields' => array(
                    'circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
                        'label' => esc_html__( 'Circle', 'integrio' )),
                    'circle_border' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
                        'label' => esc_html__( 'Empty Circle', 'integrio' )),
                    'square' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
                        'label' => esc_html__( 'Square', 'integrio' )),
                    'line' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
                        'label' => esc_html__( 'Line', 'integrio' )),
                    'line_circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
                        'label' => esc_html__( 'Line - Circle', 'integrio' )),
                ),
                'value' => 'circle',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'integrio' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_pag_color',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Pagination Color', 'integrio' ),
                'param_name' => 'pag_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Carousel arrows style
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Arrows Style', 'integrio' ),
                'param_name' => 'h_arrow_control',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Arrows control', 'integrio' ),
                'param_name' => 'use_prev_next',
                'dependency' => array(
                    'element' => 'use_carousel',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_buttons_color',
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Color', 'integrio' ),
                'param_name' => 'buttons_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_buttons_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Responsive settings
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
            // Desktop breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Desktop Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
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
                'param_name' => 'divider_ca_2',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // Tablet breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablet Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
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
                'param_name' => 'divider_ca_3',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // Mobile breakpoint
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Mobile Screen Breakpoint', 'integrio' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
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
            // COLORS TAB
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Background', 'integrio' ),
                'param_name' => 'h_bg_styles',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Background color
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize Backgrounds', 'integrio' ),
                'param_name' => 'bg_color_type',
                'value' => array(
                    esc_html__( 'Theme Defaults', 'integrio' ) => 'def',
                    esc_html__( 'Color', 'integrio' ) => 'color',
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Background hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'integrio' ),
                'param_name' => 'background_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'integrio' ),
                'param_name' => 'background_hover_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Title', 'integrio' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Colors', 'integrio' ),
            ),
            // Title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Idle', 'integrio' ),
                'param_name' => 'title_color',
                'value' => $header_font['color'],
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Hover', 'integrio' ),
                'param_name' => 'title_hover_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Department', 'integrio' ),
                'param_name' => 'h_depart_styles',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Color', 'integrio' ),
                'param_name' => 'custom_depart_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Department Color', 'integrio' ),
                'param_name' => 'depart_color',
                'value' => $theme_color_secondary,
                'dependency' => array(
                    'element' => 'custom_depart_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title styles heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Social Icons', 'integrio' ),
                'param_name' => 'h_soc_styles',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'custom_soc_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Idle', 'integrio' ),
                'param_name' => 'soc_color',
                'value' => '#cfd1df',
                'dependency' => array(
                    'element' => 'custom_soc_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Hover', 'integrio' ),
                'param_name' => 'soc_hover_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_soc_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_co_1',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // Title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Backgrounds', 'integrio' ),
                'param_name' => 'custom_soc_bg_color',
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'integrio' ),
                'param_name' => 'soc_bg_color',
                'value' => '#f3f3f3',
                'dependency' => array(
                    'element' => 'custom_soc_bg_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'integrio' ),
                'param_name' => 'soc_bg_hover_color',
                'value' => '#f3f3f3',
                'dependency' => array(
                    'element' => 'custom_soc_bg_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Colors', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
        )
    ));
    Integrio_Loop_Settings::init('wgl_team', array( 'hide_cats' => true,
                    'hide_tags' => true));
    class WPBakeryShortCode_wgl_Team extends WPBakeryShortCode{}
}