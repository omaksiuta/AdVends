<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$header_font = Integrio_Theme_Helper::get_option('header-font');
$main_font = Integrio_Theme_Helper::get_option('main-font');
$theme_color = Integrio_Theme_Helper::get_option('theme-custom-color');

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'base' => 'wgl_blog_posts_standard',
        'name' => esc_html__( 'Blog Posts', 'integrio' ),
        'description' => esc_html__( 'Display the blog posts', 'integrio' ),
        'category' => esc_html__( 'WGL Blog Modules', 'integrio' ),
        'icon' => 'wgl_icon_blog',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Blog Title', 'integrio' ),
                'param_name' => 'blog_title',
                'admin_label' => true,
            ),
            array(
                'type' => 'textarea', 
                'heading' => esc_html__( 'Blog Subtitle', 'integrio' ),
                'param_name' => 'blog_subtitle',
                'admin_label' => true,
            ),
            array(
                'type' => 'integrio_radio_image',
                'heading' => esc_html__( 'Layout', 'integrio' ),
                'param_name' => 'blog_layout',
                'fields' => array(
                    'grid' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_grid.png',
                        'label' => esc_html__( 'Grid', 'integrio' )),
                    'masonry' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
                        'label' => esc_html__( 'Masonry', 'integrio' )),
                    'carousel' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_carousel.png',
                        'label' => esc_html__( 'Carousel', 'integrio' )),
                ),
                'value' => 'grid',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Navigation Type', 'integrio' ),
                'param_name' => 'blog_navigation',
                'value' => array(
                    esc_html__( 'None', 'integrio' ) => 'none',
                    esc_html__( 'Pagination', 'integrio' ) => 'pagination',
                    esc_html__( 'Load More', 'integrio' ) => 'load_more',
                ),
                'std' => 'none',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value_not_equal_to' => 'carousel',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Navigation\'s Alignment', 'integrio' ),
                'param_name' => 'blog_navigation_align',
                'value'         => array(
                    esc_html__( 'Left', 'integrio' ) => 'left',
                    esc_html__( 'Center', 'integrio' ) => 'center',
                    esc_html__( 'Right', 'integrio' ) => 'right'
                ),
                'std' => 'left',
                'dependency' => array(
                    'element' => 'blog_navigation',
                    'value' => 'pagination'
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Items to be loaded', 'integrio' ),
                'param_name' => 'items_load',
                'value' => '4',
                'save_always' => true,
                'description' => esc_html__( 'Items amount loaded by \'Load More\' button.', 'integrio' ),
                'dependency' => array(
                    'element' => 'blog_navigation',
                    'value' => 'load_more'
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),            
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text', 'integrio' ),
                'param_name' => 'name_load_more',
                'value' => esc_html__( 'Load More', 'integrio' ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'blog_navigation',
                    'value' => 'load_more'
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'integrio' ),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'integrio' )
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Layout Settings', 'integrio' ),
                'param_name' => 'h_layout_settings',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Grid Columns Amount', 'integrio' ),
                'param_name' => 'blog_columns',
                'value' => array(
                    esc_html__( 'One', 'integrio' ) => '12',
                    esc_html__( 'Two', 'integrio' ) => '6',
                    esc_html__( 'Three', 'integrio' ) => '4',
                    esc_html__( 'Four', 'integrio' ) => '3'
                ),
                'std' => '12',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Post Meta settings
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Content Elements', 'integrio' ),
                'param_name' => 'h_content_elements',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Media?', 'integrio' ),
                'param_name' => 'hide_media',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Title?', 'integrio' ),
                'param_name' => 'hide_blog_title',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Content?', 'integrio' ),
                'param_name' => 'hide_content',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide all post-meta?', 'integrio' ),
                'param_name' => 'hide_postmeta',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide post-meta author?', 'integrio' ),
                'param_name' => 'meta_author',
                'std' => '',
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide post-meta comments?', 'integrio' ),
                'param_name' => 'meta_comments',
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'std' => 'true',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide post-meta categories?', 'integrio' ),
                'param_name' => 'meta_categories',
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide post-meta date?', 'integrio' ),
                'param_name' => 'meta_date',
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Likes?', 'integrio' ),
                'param_name' => 'hide_likes',
                'std' => '',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Post Share?', 'integrio' ),
                'param_name' => 'hide_share',
                'std' => '',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            // Post Read More Link
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Content Trim', 'integrio' ),
                'param_name' => 'h_content_trime',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide post read more link?', 'integrio' ),
                'param_name' => 'read_more_hide',
                'std' => '',
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ), 
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Read More Text', 'integrio' ),
                'param_name' => 'read_more_text',
                'value' => esc_html__( 'Read More', 'integrio' ),
                'description' => esc_html__( 'Enter read more text.', 'integrio' ),
                'dependency' => array(
                    'element' => 'read_more_hide',
                    'value_not_equal_to' => 'true',
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            // Content Letter Count
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Characters Amount in Content', 'integrio' ),
                'param_name' => 'content_letter_count',
                'value' => '290',
                'description' => esc_html__( 'Limit the content to be displayed.', 'integrio' ),
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Crop Images for Posts List?', 'integrio' ),
                'param_name' => 'crop_square_img',
                'std' => 'true',
                'description' => esc_html__( 'For correctly work uploaded image size should be larger than 700px height and width.', 'integrio' ),
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            // CAROUSEL TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Autoplay', 'integrio' ),
                'param_name' => 'autoplay',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-1',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Autoplay Speed', 'integrio' ),
                'param_name' => 'autoplay_speed',
                'value' => '3000',
                'description' => esc_html__( 'Enter value in milliseconds.', 'integrio' ),
                'dependency' => array(
                    'element' => 'autoplay',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            // carousel pagination heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Pagination Controls', 'integrio' ),
                'param_name' => 'h_pag_controls',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'integrio' ),
                'param_name' => 'use_pagination',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true',
                'group' => esc_html__( 'Carousel', 'integrio' ),
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
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'integrio' ),
                'param_name' => 'custom_pag_color',
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Pagination Color', 'integrio' ),
                'param_name' => 'pag_color',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),           
            // Carousel navigation controls
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Navigation Controls', 'integrio' ),
                'param_name' => 'h_nav_controls',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Navigation control', 'integrio' ),
                'param_name' => 'use_navigation',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true',
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            // Carousel responsive settings
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Responsive Settings', 'integrio' ),
                'param_name' => 'h_resp',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'integrio' ),
                'param_name' => 'custom_resp',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value' => 'carousel'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            // Desktop screen breakpoint
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
                'param_name' => 'divider_ca_1',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // Tablet screen breakpoint
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
                'param_name' => 'divider_ca_2',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            // Mobile screen breakpoint
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
            // STYLES TAB
            // Blog headings styles
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Blog Headings Styles', 'integrio' ),
                'param_name' => 'blog_heading_styles',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Heading tag', 'integrio' ),
                'param_name' => 'heading_tag',
                'value' => array(
                    esc_html__( '‹h1›', 'integrio' ) => 'h1',
                    esc_html__( '‹h2›', 'integrio' ) => 'h2',
                    esc_html__( '‹h3›', 'integrio' ) => 'h3',
                    esc_html__( '‹h4›', 'integrio' ) => 'h4',
                    esc_html__( '‹h5›', 'integrio' ) => 'h5',
                    esc_html__( '‹h6›', 'integrio' ) => 'h6',
                ),
                'std' => 'h3',
                'description' => esc_html__( 'Select your html tag.', 'integrio' ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Heading margin bottom', 'integrio' ),
                'param_name' => 'heading_margin_bottom',
                'value' => '16px',
                'save_always' => true,
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),  
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_blog_headings',
                'group' => esc_html__( 'Styles', 'integrio' ),
            ),            
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog_headings',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font size', 'integrio' ),
                'param_name' => 'custom_fonts_blog_size_headings',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Heading Font Size', 'integrio' ),
                'param_name' => 'heading_font_size',
                'value' => '24',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Heading Line Height', 'integrio' ),
                'param_name' => 'heading_line_height',
                'value' => '34',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Heading Font Weight', 'integrio' ),
                'param_name' => 'heading_font_weight',
                'value' => array(
                    esc_html__( 'Theme defaults', 'integrio' ) => '',
                    esc_html__( '300 / Light', 'integrio' ) => '300',
                    esc_html__( '400 / Regular', 'integrio' ) => '400',
                    esc_html__( '500 / Medium', 'integrio' ) => '500',
                    esc_html__( '600 / SemiBold', 'integrio' ) => '600',
                    esc_html__( '700 / Bold', 'integrio' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'integrio' ) => '800',
                    esc_html__( '900 / Black', 'integrio' ) => '800',
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_headings',
                    'value' => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_c_1',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'use_custom_heading_color',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__( 'Heading Idle', 'integrio' ),
                'param_name' => 'custom_headings_color',
                'value' => esc_attr($header_font['color']),
                'dependency' => array(
                    'element' => 'use_custom_heading_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),            
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__( 'Heading Hover', 'integrio' ),
                'param_name' => 'custom_hover_headings_color',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'use_custom_heading_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Blog Font
            // Blog Headings Font
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Blog Content Styles', 'integrio' ),
                'param_name' => 'blog_content_styles',
                'group' => esc_html__( 'Styles', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_blog_content',
                'group' => esc_html__( 'Styles', 'integrio' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font size', 'integrio' ),
                'param_name' => 'custom_fonts_blog_size_content',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Font Size', 'integrio' ),
                'param_name' => 'content_font_size',
                'value' => '16',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Content Line Height', 'integrio' ),
                'param_name' => 'content_line_height',
                'value' => '30',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_c_2',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'integrio' ),
                'param_name' => 'use_custom_content_color',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Content Color', 'integrio' ),
                'param_name' => 'custom_content_color',
                'value' => esc_attr($main_font['color']),
                'dependency' => array(
                    'element' => 'use_custom_content_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),            
            // Blog meta styles
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Blog Meta Styles', 'integrio' ),
                'param_name' => 'blog_meta_styles',
                'group' => esc_html__( 'Styles', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'integrio' ),
                'param_name' => 'custom_fonts_blog_meta',
                'group' => esc_html__( 'Styles', 'integrio' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_meta',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font size', 'integrio' ),
                'param_name' => 'custom_fonts_blog_size_meta',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Blog Meta Font Size', 'integrio' ),
                'param_name' => 'meta_font_size',
                'value' => '14',
                'description' => esc_html__( 'Enter value in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_meta',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3 clearfix-col',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_c_3',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Main Color', 'integrio' ),
                'param_name' => 'use_custom_main_color',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Custom blog style
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Main Color', 'integrio' ),
                'param_name' => 'custom_main_color',
                'value' => '#abaebe',
                'description' => esc_html__( 'Custom blog meta info color.', 'integrio' ),
                'dependency' => array(
                    'element' => 'use_custom_main_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_c_4',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize \'Read More\' Color', 'integrio' ),
                'param_name' => 'use_custom_read_color',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Custom blog style
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__( 'Read More Idle', 'integrio' ),
                'param_name' => 'custom_read_more_color',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'use_custom_read_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),             
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Read More Hover', 'integrio' ),
                'param_name' => 'custom_hover_read_more_color',
                'value' => esc_attr($main_font['color']),
                'dependency' => array(
                    'element' => 'use_custom_read_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
             // Blog Style
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__( 'Media Styles', 'integrio' ),
                'param_name' => 'blog_content_styles',
                'group' => esc_html__( 'Styles', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Image Idle Overlay', 'integrio' ),
                'param_name' => 'custom_blog_mask',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__( 'Image Overlay Idle', 'integrio' ),
                'param_name' => 'custom_image_mask_color',
                'value' => esc_attr( 'rgba(14,21,30,.6)' ),
                'dependency' => array(
                    'element' => 'custom_blog_mask',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Image Hover Overlay', 'integrio' ),
                'param_name' => 'custom_blog_hover_mask',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Image Overlay Hover', 'integrio' ),
                'param_name' => 'custom_image_hover_mask_color',
                'value' => esc_attr( 'rgba(14,21,30,.6)' ),
                'dependency' => array(
                    'element' => 'custom_blog_hover_mask',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'integrio_param_heading',
                'param_name' => 'divider_c_5',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Items Background', 'integrio' ),
                'param_name' => 'custom_blog_bg_item',
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'integrio' ),
                'param_name' => 'custom_bg_color',
                'value' => esc_attr( 'rgba(19,17,31,1)' ),
                'dependency' => array(
                    'element' => 'custom_blog_bg_item',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Styles', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
        ),

    ));
    
    Integrio_Loop_Settings::init( 'wgl_blog_posts_standard' );
    
    class WPBakeryShortCode_wgl_Blog_Posts_Standard extends WPBakeryShortCode
    {
    }
    

}