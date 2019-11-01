<?php
if ( !class_exists('Integrio_Theme_Helper') ) { return; }

$theme_color = Integrio_Theme_Helper::get_option('theme-custom-color');
$header_font = Integrio_Theme_Helper::get_option('header-font');
$main_font = Integrio_Theme_Helper::get_option('main-font');
$theme_gradient = Integrio_Theme_Helper::get_option( 'theme-gradient');

if (function_exists( 'vc_map' )) {
    vc_map( array(
        'name' => esc_html__( 'Portfolio List', 'integrio-core' ),
        'base' => $this->shortcodeName,
        'class' => 'integrio_portfolio_list',
        'category' => esc_html__( 'WGL Modules', 'integrio-core' ),
        'icon' => 'wgl_icon_portfolio_module',
        'content_element' => true,
        'description' => esc_html__( 'Portfolio List','integrio-core' ),
        'params' => array(
            array(
                'type' => 'integrio_radio_image',
                'heading' => esc_html__( 'Overall Layout', 'integrio-core' ),
                'param_name' => 'portfolio_layout',
                'fields' => array(
                    'grid' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_grid.png',
                        'label' => esc_html__( 'Grid', 'integrio-core' )),
                    'carousel' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_carousel.png',
                        'label' => esc_html__( 'Carousel', 'integrio-core' )),
                    'masonry' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
                        'label' => esc_html__( 'Masonry', 'integrio-core' )),
                    'masonry2' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
                        'label' => esc_html__( 'Masonry 2', 'integrio-core' )),
                    'masonry3' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
                        'label' => esc_html__( 'Masonry 3', 'integrio-core' )),
                    'masonry4' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
                        'label' => esc_html__( 'Masonry 4', 'integrio-core' )),
                ),
                'value' => 'grid',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Columns Amount', 'integrio-core' ),
                'param_name' => 'posts_per_row',
                'admin_label' => true,
                'value' => array(
                    esc_html__( '1', 'integrio-core' ) => '1',
                    esc_html__( '2', 'integrio-core' ) => '2',
                    esc_html__( '3', 'integrio-core' ) => '3',
                    esc_html__( '4', 'integrio-core' ) => '4',
                    esc_html__( '5', 'integrio-core' ) => '5',
                ),
                'std' => '3',
                'dependency' => array(
                    'element' => 'portfolio_layout',
                    'value' => array( 'grid', 'masonry', 'carousel' )
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Grid Gap', 'integrio-core' ),
				'param_name' => 'grid_gap',
				'value' => array(
					esc_html__( '0', 'integrio-core' ) => '0px',
					esc_html__( '1', 'integrio-core' ) => '1px',
					esc_html__( '2', 'integrio-core' ) => '2px',
					esc_html__( '3', 'integrio-core' ) => '3px',
					esc_html__( '4', 'integrio-core' ) => '4px',
					esc_html__( '5', 'integrio-core' ) => '5px',
					esc_html__( '10', 'integrio-core' ) => '10px',
					esc_html__( '15', 'integrio-core' ) => '15px',
					esc_html__( '20', 'integrio-core' ) => '20px',
					esc_html__( '25', 'integrio-core' ) => '25px',
					esc_html__( '30', 'integrio-core' ) => '30px',
					esc_html__( '35', 'integrio-core' ) => '35px',
				),
				'std' => '30px',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_1',
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Show Filter', 'integrio-core' ),
                'param_name' => 'show_filter',
                'value' => array( esc_html__( 'Yes', 'integrio-core' ) => 'yes' ),
                'std' => '',
                'save_always' => true,
                'dependency' => array(
                    'element' => 'portfolio_layout',
                    'value' => array( 'grid', 'masonry', 'masonry2', 'masonry3', 'masonry4' )
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Filter Align', 'integrio-core' ),
                'param_name' => 'filter_align',
                'value' => array(
                    esc_html__( 'Left', 'integrio-core' ) => 'left',
                    esc_html__( 'Right', 'integrio-core' ) => 'right',
                    esc_html__( 'Center', 'integrio-core' ) => 'center',
                ),
                'std' => 'center',
                'dependency' => array(
                    'element' => 'show_filter',
                    'value' => 'yes'
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Crop Images', 'integrio-core' ),
                'param_name' => 'crop_images',
                'value' => array( esc_html__( 'Yes', 'integrio-core' ) => 'yes' ),
                'std' => 'yes',
                'save_always' => true,
            ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Navigation Type', 'integrio-core' ),
				'param_name' => 'navigation',
				'admin_label' => true,
				'save_always' => true,
				'value' => array(
					esc_html__( 'None', 'integrio-core' ) => 'none',
					esc_html__( 'Pagination', 'integrio-core' ) => 'pagination',
					esc_html__( 'Infinite Scroll', 'integrio-core' ) => 'infinite',
					esc_html__( 'Load More', 'integrio-core' ) => 'load_more',
				),
				'dependency' => array(
					'element' => 'portfolio_layout',
					'value' => array( 'grid', 'masonry', 'masonry2', 'masonry3', 'masonry4' )
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Navigation\'s Alignment', 'integrio-core' ),
                'param_name' => 'nav_align',
                'value' => array(
                    esc_html__( 'Center', 'integrio-core' ) => 'center',
                    esc_html__( 'Left', 'integrio-core' ) => 'left',
                    esc_html__( 'Right', 'integrio-core' ) => 'right'
                ),
                'std' => 'center',
                'dependency' => array(
                    'element' => 'navigation',
                    'value' => 'pagination',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),                   
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Items on load', 'integrio-core' ),
                'param_name' => 'items_load',
                'value' => '4',
                'save_always' => true,
                'description' => esc_html__( 'Items to be load by \'Load more\' button.', 'integrio-core' ),
                'dependency' => array(
                    'element' => 'navigation',
                    'value' => array( 'load_more', 'infinite' )
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),        
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Name', 'integrio-core' ),
                'param_name' => 'name_load_more',
                'value' => esc_html__( 'Load More', 'integrio-core' ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'navigation',
                    'value' => 'load_more'
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			array(
				'type' => 'integrio_param_heading',
				'param_name' => 'divider_2',
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Appear Animation', 'integrio-core' ),
                'param_name' => 'add_animation',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Animation Style', 'integrio-core' ),
                'param_name' => 'appear_animation',
                'value' => array(
                    esc_html__( 'Fade In', 'integrio-core' ) => 'fade-in',
                    esc_html__( 'Slide Top', 'integrio-core' ) => 'slide-top',
                    esc_html__( 'Slide Bottom', 'integrio-core' ) => 'slide-bottom',
                    esc_html__( 'Slide Left', 'integrio-core' ) => 'slide-left',
                    esc_html__( 'Slide Right', 'integrio-core' ) => 'slide-right',
                    esc_html__( 'Zoom', 'integrio-core' ) => 'zoom',
                ),
                'std' => 'fade-in',
                'dependency' => array(
                    'element' => 'add_animation',
                    'value' => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio-core' ),
                'param_name' => 'item_el_class',
                'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'integrio-core' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Click Item', 'integrio-core' ),
                'param_name' => 'click_area',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-8',
                'group' => esc_html__( 'Content', 'integrio-core' ),
                'value' => array(
                    esc_html__( 'Single', 'integrio-core' ) => 'single',
                    esc_html__( 'Popup', 'integrio-core' ) => 'popup',
                    esc_html__( 'Custom Link', 'integrio-core' ) => 'custom',
                    esc_html__( 'Default', 'integrio-core' ) => 'none',
                ),
                'std' => 'popup',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Single Link to Title', 'integrio-core' ),
                'param_name' => 'single_link_title',
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
                'group' => esc_html__( 'Content', 'integrio-core' ),
                'std' => 'true',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Show Info Position', 'integrio-core' ),
                'param_name' => 'info_position',
                'admin_label' => true,
                'value' => array(
                    esc_html__( 'Inside Image', 'integrio-core' ) => 'inside_image',
                    esc_html__( 'Under Image', 'integrio-core' ) => 'under_image',
                ),
                'std' => 'inside_image',
                'group' => esc_html__( 'Content', 'integrio-core' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Inside Image Animation', 'integrio-core' ),
                'param_name' => 'image_anim',
                'value' => array(
                    esc_html__( 'On Sub-Layer', 'integrio-core' ) => 'sub_layer',
                    esc_html__( 'Simple', 'integrio-core' ) => 'simple',
                    esc_html__( 'Side Offset', 'integrio-core' ) => 'offset',
                    esc_html__( 'Zoom In', 'integrio-core' ) => 'zoom_in',
                    esc_html__( 'Outline', 'integrio-core' ) => 'outline',
                    esc_html__( 'Always Show Info', 'integrio-core' ) => 'always_info',
                ),
                'dependency' => array(
                    'element' => 'info_position',
                    'value' => array( 'inside_image' )
                ),
                'group' => esc_html__( 'Content', 'integrio-core' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Horizontal Content Align', 'integrio-core' ),
                'param_name' => 'horizontal_align',
                'value' => array(
                    esc_html__( 'Center', 'integrio-core' ) => 'center',
                    esc_html__( 'Left', 'integrio-core' ) => 'Left',
                    esc_html__( 'Right', 'integrio-core' ) => 'right'
                ),
                'admin_label' => true,
                'dependency' => array(
                    'element' => 'info_position',
                    'value' => array( 'under_image' )
                ),
                'group' => esc_html__( 'Content', 'integrio-core' ),
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Content Elements', 'integrio-core' ),
                'param_name' => 'h_content_elements',
                'group' => esc_html__( 'Content', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Show Title?', 'integrio-core' ),
                'param_name' => 'show_portfolio_title',
                'std' => 'true',
                'group' => esc_html__( 'Content', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Show categories?', 'integrio-core' ),
                'param_name' => 'show_meta_categories',
                'std' => 'true',
                'group' => esc_html__( 'Content', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Show Content?', 'integrio-core' ),
                'param_name' => 'show_content',
                'group' => esc_html__( 'Content', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Content Letter Count
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Letter Count', 'integrio-core' ),
                'param_name' => 'content_letter_count',
                'value' => '85',
                'description' => esc_html__( 'Enter content letter count.', 'integrio-core' ),
                'dependency' => array(
                    'element' => 'show_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Content', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // --- CAROUSEL GROUP --- //
			array(
				'type' => 'integrio_param_heading',
				'heading' => esc_html__( 'Carousel Options', 'integrio-core' ),
				'param_name' => 'h_portfolio_carousel',
				'dependency' => array(
				    'element' => 'portfolio_layout',
				    'value' => 'carousel'
				),
				'group' => esc_html__( 'Carousel', 'integrio-core' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'integrio-core' ),
				'param_name' => 'autoplay',
				'dependency' => array(
				    'element' => 'portfolio_layout',
				    'value' => 'carousel'
				),
				'group' => esc_html__( 'Carousel', 'integrio-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Autoplay Speed', 'integrio-core' ),
				'param_name' => 'autoplay_speed',
				'dependency' => array(
				    'element' => 'autoplay',
				    'value' => 'true'
				),
				'value' => '3000',
				'group' => esc_html__( 'Carousel', 'integrio-core' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Multiple Items', 'integrio-core' ),
                'param_name' => 'multiple_items',
                'dependency' => array(
                    'element' => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Slide One Item per time', 'integrio' ),
				'param_name' => 'slides_to_scroll',
				'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Center Mode', 'integrio' ),
				'param_name' => 'center_mode',
				'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Show Center Info', 'integrio' ),
				'param_name' => 'center_info',
				'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'center_mode',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Variable Width', 'integrio' ),
				'param_name' => 'variable_width',
				'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
			),
            // carousel pagination heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Pagination Controls', 'integrio-core' ),
                'param_name' => 'h_pag_controls',
                'dependency' => array(
                    'element' => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'integrio-core' ),
                'param_name' => 'use_pagination',
                'dependency' => array(
                    'element' => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'integrio_radio_image',
                'heading' => esc_html__( 'Pagination Type', 'integrio-core' ),
                'param_name' => 'pag_type',
                'fields' => array(
                    'circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
                        'label' => esc_html__( 'Circle', 'integrio-core' )),
                    'circle_border' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
                        'label' => esc_html__( 'Empty Circle', 'integrio-core' )),
                    'square' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
                        'label' => esc_html__( 'Square', 'integrio-core' )),
                    'line' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
                        'label' => esc_html__( 'Line', 'integrio-core' )),
                    'line_circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
                        'label' => esc_html__( 'Line - Circle', 'integrio-core' )),
                ),
                'value' => 'circle',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'integrio-core' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'description' => esc_html__( 'Enter pagination top offset in pixels.', 'integrio-core' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'integrio-core' ),
                'param_name' => 'custom_pag_color',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Pagination Color', 'integrio-core' ),
                'param_name' => 'pag_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel prev/next heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Prev/Next Buttons', 'integrio-core' ),
                'param_name' => 'h_prev_buttons',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'portfolio_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Prev/Next buttons', 'integrio-core' ),
                'param_name' => 'use_prev_next',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'portfolio_layout',
                    'value' => 'carousel'
                ),
            ),  
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Center Mode', 'integrio' ),
				'param_name' => 'arrows_center_mode',
				'edit_field_class' => 'vc_col-sm-4',
                'dependency'    => array(
                    'element'   => 'use_prev_next',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
			),
            // carousel pagination heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Responsive', 'integrio-core' ),
                'param_name' => 'h_resp',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'integrio-core' ),
                'param_name' => 'custom_resp',
                'dependency'    => array(
                    'element'   => 'portfolio_layout',
                    'value' => 'carousel'
                ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
            ),
            // medium desktop
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Medium Desktop', 'integrio-core' ),
                'param_name' => 'h_resp_medium',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'integrio-core' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio-core' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            
            // tablets
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Tablets', 'integrio-core' ),
                'param_name' => 'h_resp_tablets',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'integrio-core' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio-core' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            // mobile phones
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Mobile Phones', 'integrio-core' ),
                'param_name' => 'h_resp_mobile',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'integrio-core' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio-core' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),

            // --- CUSTOM GROUP --- //
            // Portfolio Headings Font
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Typography', 'integrio-core' ),
                'param_name' => 'h_typography',
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Headings Font Size', 'integrio-core' ),
                'param_name' => 'heading_font_size',
                'value' => '',
                'save_always' => true,
                'description' => esc_html__( 'Value in pixels.', 'integrio-core' ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Categories Font Size', 'integrio-core' ),
                'param_name' => 'cat_font_size',
                'value' => '',
                'save_always' => true,
                'description' => esc_html__( 'Value in pixels.', 'integrio-core' ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Headings Font Family', 'integrio-core' ),
                'param_name' => 'custom_fonts_portfolio_headings',
                'group' => esc_html__( 'Font', 'integrio-core' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_portfolio_headings',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'integrio-core' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'integrio-core' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'custom_fonts_portfolio_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
            ),
            // Heading Colors
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Custom Heading Colors', 'integrio-core' ),
                'param_name' => 'h_heading_colors',
                'group' => esc_html__( 'Font', 'integrio-core' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio-core' ),
                'param_name' => 'custom_heading',
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'integrio-core' ),
                'param_name' => 'heading_color',
                'value' => '#ffffff',
                'save_always' => true,
                'dependency' => array(
                    'element' => 'custom_heading',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Hover Color', 'integrio-core' ),
                'param_name' => 'heading_color_hover',
                'value' => 'rgba(255,255,255,0.7)',
                'save_always' => true,
                'dependency' => array(
                    'element' => 'custom_heading',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Categories Colors
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Custom Categories Colors', 'integrio-core' ),
                'param_name' => 'h_cat_colors',
                'group' => esc_html__( 'Font', 'integrio-core' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio-core' ),
                'param_name' => 'custom_cat',
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color Idle', 'integrio-core' ),
                'param_name' => 'cat_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_cat',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color Hover', 'integrio-core' ),
                'param_name' => 'cat_color_hover',
                'value' => 'rgba(255,255,255,0.8)',
                'dependency' => array(
                    'element' => 'custom_cat',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icons Colors
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Custom Icons Colors', 'integrio-core' ),
                'param_name' => 'h_icons_colors',
                'group' => esc_html__( 'Font', 'integrio-core' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio-core' ),
                'param_name' => 'custom_icons',
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color Idle', 'integrio-core' ),
                'param_name' => 'icons_color',
                'value' => esc_attr($header_font['color']),
                'dependency' => array(
                    'element' => 'custom_icons',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color Hover', 'integrio-core' ),
                'param_name' => 'icons_color_hover',
                'value' => esc_attr($theme_color),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'custom_icons',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Content Colors
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Custom Content Color', 'integrio-core' ),
                'param_name' => 'h_content_colors',
                'group' => esc_html__( 'Font', 'integrio-core' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Color', 'integrio-core' ),
                'param_name' => 'custom_content',
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'integrio-core' ),
                'param_name' => 'content_color',
                'value' => esc_attr($main_font['color']),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'custom_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Custom Overlay Colors', 'integrio-core' ),
                'param_name' => 'h_content_overlay',
                'group' => esc_html__( 'Font', 'integrio-core' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize Background', 'integrio-core' ),
                'param_name' => 'bg_color_type',
                'value' => array(
                    esc_html__( 'Default', 'integrio-core' ) => 'def',
                    esc_html__( 'Color', 'integrio-core' ) => 'color',
                    esc_html__( 'Gradient', 'integrio-core' ) => 'gradient',
                    esc_html__( 'None', 'integrio-core' ) => 'none',
                ),
                'std' => 'def',
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // background color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Color', 'integrio-core' ),
                'param_name' => 'background_color',
                'value' => 'rgba(65, 65, 65, 0.65)',
                'description' => esc_html__( 'Select background color', 'integrio-core' ),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // background Gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Start Color', 'integrio-core' ),
                'param_name' => 'background_gradient_start',
                'value' => 'rgba( '.Integrio_Theme_Helper::HexToRGB($theme_gradient['from']).', 0.85)',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // background Gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background End Color', 'integrio-core' ),
                'param_name' => 'background_gradient_end',
                'value' => 'rgba( '.Integrio_Theme_Helper::HexToRGB($theme_gradient['to']).', 0.85)',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Secondary overlay color
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Custom Secondary Overlay Color', 'integrio-core' ),
                'param_name' => 'h_sec_overlay_colors',
                'group' => esc_html__( 'Font', 'integrio-core' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Color', 'integrio-core' ),
                'param_name' => 'custom_sec_overlay',
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'integrio-core' ),
                'param_name' => 'sec_overlay_color',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'custom_sec_overlay',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Font', 'integrio-core' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-3',
            ),
        )
));
    Integrio_Loop_Settings::init($this->shortcodeName, array( 'hide_cats' => true,
                    'hide_tags' => true));
}
?>