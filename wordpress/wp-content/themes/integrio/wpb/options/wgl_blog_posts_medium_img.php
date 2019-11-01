<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = Integrio_Theme_Helper::get_option('header-font');
$main_font = Integrio_Theme_Helper::get_option('main-font');
$theme_color = Integrio_Theme_Helper::get_option('theme-custom-color');

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'wgl_blog_posts_medium_img',
        'name' => esc_html__('Medium Image', 'integrio'),
        'description' => esc_html__('Display the blog posts', 'integrio'),
        'category' => esc_html__('WGL Blog Modules', 'integrio'),
        'icon' => 'wgl_icon_blog_medium_img',
        'params' => array(
             array(
                'type' => 'textfield',
                'heading' => esc_html__('Blog Title', 'integrio'),
                'param_name' => 'blog_title',
                'admin_label' => true,
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Blog Subtitle', 'integrio'),
                'param_name' => 'blog_subtitle',
                'admin_label' => true,
            ),   
            array(
                'type' => 'integrio_radio_image',
                'heading' => esc_html__('Layout', 'integrio'),
                'param_name' => 'blog_layout',
                'fields' => array(
                    'grid' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_grid.png',
                        'label' => esc_html__('Grid', 'integrio')),
                    'masonry' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
                        'label' => esc_html__('Masonry', 'integrio')),
                    'carousel' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_carousel.png',
                        'label' => esc_html__('Carousel', 'integrio')),
                ),
                'value' => 'grid',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Navigation', 'integrio' ),
                'param_name' => 'blog_navigation',
                'value'         => array(
                    esc_html__( 'None', 'integrio' ) => 'none',
                    esc_html__( 'Pagination', 'integrio' ) => 'pagination',
                    esc_html__( 'Load More', 'integrio' ) => 'load_more',
                ),
                'description' => esc_html__('Select Type of Navigation', 'integrio'),
                'std' => 'none',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value_not_equal_to' => 'carousel',
                ),
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
                'description' => esc_html__('Select Navigation\'s Alignment.', 'integrio'),
                'std' => 'left',
                'dependency' => array(
                    'element' => 'blog_navigation',
                    'value' => 'pagination'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Items on load', 'integrio'),
                'param_name' => 'items_load',
                'value' => '4',
                'save_always' => true,
                'description' => esc_html__( 'Items load by load more button.', 'integrio' ),
                'dependency' => array(
                    'element' => 'blog_navigation',
                    "value" => "load_more"
                )
            ),            
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Name', 'integrio'),
                'param_name' => 'name_load_more',
                'value' => esc_html__('Load More', 'integrio'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'blog_navigation',
                    "value" => "load_more"
                )
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'integrio'),
                'param_name' => 'extra_class',
                'description' => esc_html__("Add an extra class name to the element and refer to it from Custom CSS option.", 'integrio')
            ),
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Layout Settings', 'integrio'),
                'param_name' => 'h_layout_settings',
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Number of Columns', 'integrio' ),
                'param_name' => 'blog_columns',
                'value'         => array(
                    esc_html__( 'One', 'integrio' ) => '12',
                    esc_html__( 'Two', 'integrio' ) => '6',
                    esc_html__( 'Three', 'integrio' ) => '4',
                    esc_html__( 'Four', 'integrio' ) => '3'
                ),
                'description' => esc_html__('Select Number of Columns', 'integrio'),
                'std' => '12',
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            // Post Meta settings
            // Info Box Icon/Image heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Content Elements', 'integrio'),
                'param_name' => 'h_content_elements',
                'group' => esc_html__( 'Icon', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide Media?', 'integrio' ),
                'param_name' => 'hide_media',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide Title?', 'integrio' ),
                'param_name' => 'hide_blog_title',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide Content?', 'integrio' ),
                'param_name' => 'hide_content',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide all post-meta?', 'integrio' ),
                'param_name' => 'hide_postmeta',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide post-meta author?', 'integrio' ),
                'param_name' => 'meta_author',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide post-meta comments?', 'integrio' ),
                'param_name' => 'meta_comments',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide post-meta categories?', 'integrio' ),
                'param_name' => 'meta_categories',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide post-meta date?', 'integrio' ),
                'param_name' => 'meta_date',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide Likes?', 'integrio' ),
                'param_name' => 'hide_likes',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
                'std' => ''
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide Post Share?', 'integrio' ),
                'param_name' => 'hide_share',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            // Post Read More Link
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Content Trim', 'integrio'),
                'param_name' => 'h_content_trime',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Hide post read more link?', 'integrio' ),
                'param_name' => 'read_more_hide',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'integrio' ),
                'std' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Read More Text', 'integrio'),
                'param_name' => 'read_more_text',
                'edit_field_class' => 'vc_col-sm-8',
                'value' => esc_html__( 'Read More', 'integrio' ),
                'description' => esc_html__( 'Enter read more text.', 'integrio' ),
                'dependency' => array(
                    'element' => 'read_more_hide',
                    'value_not_equal_to' => 'true',
                ),
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            // Content Letter Count
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Letter Count', 'integrio'),
                'param_name' => 'content_letter_count',
                'value' => '290',
                'description' => esc_html__( 'Enter content letter count.', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__('Crop Images for Posts List?', 'integrio' ),
                'param_name' => 'crop_square_img',
                'description' => esc_html__( 'For correctly work uploaded image size should be larger than 700px height and width.', 'integrio' ),
                'group' => esc_html__( 'Content', 'integrio' ),
                'std' => 'true'
            ),
            
            // --- CAROUSEL GROUP --- //
            array(
                "type"          => "wgl_checkbox",
                'heading' => esc_html__( 'Autoplay', 'integrio' ),
                "param_name"    => "autoplay",
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Autoplay Speed', 'integrio' ),
                "param_name"    => "autoplay_speed",
                "dependency"    => array(
                    "element"   => "autoplay",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                "value"         => "3000",
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            // carousel pagination heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Pagination Controls', 'integrio'),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'integrio' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'integrio_radio_image',
                'heading' => esc_html__('Pagination Type', 'integrio'),
                'param_name' => 'pag_type',
                'fields' => array(
                    'circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
                        'label' => esc_html__('Circle', 'integrio')),
                    'circle_border' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
                        'label' => esc_html__('Empty Circle', 'integrio')),
                    'square' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
                        'label' => esc_html__('Square', 'integrio')),
                    'line' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
                        'label' => esc_html__('Line', 'integrio')),
                    'line_circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
                        'label' => esc_html__('Line - Circle', 'integrio')),
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'value' => 'circle',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'integrio' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
                'description' => esc_html__( 'Enter pagination top offset in pixels.', 'integrio' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'integrio' ),
                'param_name' => 'custom_pag_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Pagination Color', 'integrio'),
                'param_name' => 'pag_color',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel pagination heading            
            // carousel navigation heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Navigation Controls', 'integrio'),
                'param_name' => 'h_nav_controls',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Navigation control', 'integrio' ),
                'param_name' => 'use_navigation',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true'
            ),
            // carousel navigation heading
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Responsive', 'integrio'),
                'param_name' => 'h_resp',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'integrio' ),
                'param_name' => 'custom_resp',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Carousel', 'integrio' ),
            ),
            // medium desktop
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Medium Desktop', 'integrio'),
                'param_name' => 'h_resp_medium',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'integrio' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            
            // tablets
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Tablets', 'integrio'),
                'param_name' => 'h_resp_tablets',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'integrio' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            // mobile phones
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Mobile Phones', 'integrio'),
                'param_name' => 'h_resp_mobile',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'integrio' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'integrio' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),

            // --- CUSTOM GROUP --- //
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Heading tag', 'integrio' ),
                'param_name' => 'heading_tag',
                'value'         => array(
                    esc_html__( 'H1', 'integrio' ) => 'h1',
                    esc_html__( 'H2', 'integrio' ) => 'h2',
                    esc_html__( 'H3', 'integrio' ) => 'h3',
                    esc_html__( 'H4', 'integrio' ) => 'h4',
                    esc_html__( 'H5', 'integrio' ) => 'h5',
                    esc_html__( 'H6', 'integrio' ) => 'h6',
                ),
                'description' => esc_html__('Select Type Heading tag.', 'integrio'),
                'std' => 'h4',
                'group' => esc_html__( 'Custom', 'integrio' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading margin bottom', 'integrio'),
                'param_name' => 'heading_margin_bottom',
                'value' => '10px',
                'save_always' => true,
                'group' => esc_html__( 'Custom', 'integrio' ),
            ),  
            // Blog Headings Font
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Blog Headings Styles', 'integrio'),
                'param_name' => 'blog_heading_styles',
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for Blog Headings', 'integrio' ),
                'param_name' => 'custom_fonts_blog_headings',
                'group' => esc_html__( 'Custom', 'integrio' ),
            ),            
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog_headings',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font size for Blog Headings', 'integrio' ),
                'param_name' => 'custom_fonts_blog_size_headings',
                'group' => esc_html__( 'Custom', 'integrio' ),
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading Font Size', 'integrio'),
                'param_name' => 'heading_font_size',
                'value' => '24',
                'description' => esc_html__( 'Enter heading font-size in pixels.', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_headings',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading Line Height', 'integrio'),
                'param_name' => 'heading_line_height',
                'value' => '34',
                'description' => esc_html__( 'Enter heading line-height in pixels.', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_headings',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Heading Color', 'integrio' ),
                'param_name' => 'use_custom_heading_color',
                'description' => esc_html__( 'Select custom color', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Headings Color', 'integrio'),
                'param_name' => 'custom_headings_color',
                'value' => esc_attr($header_font['color']),
                'description' => esc_html__('Select custom headings color.', 'integrio'),
                'dependency' => array(
                    'element' => 'use_custom_heading_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),            
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Hover Headings Color', 'integrio'),
                'param_name' => 'custom_hover_headings_color',
                'value' => esc_attr($theme_color),
                'description' => esc_html__('Select custom hover headings color.', 'integrio'),
                'dependency' => array(
                    'element' => 'use_custom_heading_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Blog Font
            // Blog Headings Font
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Blog Content Styles', 'integrio'),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'param_name' => 'blog_content_styles',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font family for Blog Content', 'integrio' ),
                'param_name' => 'custom_fonts_blog_content',
                'group' => esc_html__( 'Custom', 'integrio' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom font size for Blog Content', 'integrio' ),
                'param_name' => 'custom_fonts_blog_size_content',
                'group' => esc_html__( 'Custom', 'integrio' ),
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Font Size', 'integrio'),
                'param_name' => 'content_font_size',
                'value' => '16',
                'description' => esc_html__( 'Enter content font-size in pixels.', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_content',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Line Height', 'integrio'),
                'param_name' => 'content_line_height',
                'value' => '30',
                'description' => esc_html__( 'Enter content line-height in pixels.', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_content',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Content Color', 'integrio' ),
                'param_name' => 'use_custom_content_color',
                'description' => esc_html__( 'Select custom color', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Content Color', 'integrio'),
                'param_name' => 'custom_content_color',
                'value' => esc_attr($main_font['color']),
                'description' => esc_html__('Select custom content color.', 'integrio'),
                'dependency' => array(
                    'element' => 'use_custom_content_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
             // Blog Style
            array(
                'type' => 'integrio_param_heading',
                'heading' => esc_html__('Blog Styles', 'integrio'),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-12',
                'param_name' => 'blog_content_styles',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Main Color', 'integrio' ),
                'param_name' => 'use_custom_main_color',
                'description' => esc_html__( 'Custom blog font size and font color.', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-7',
            ),
            // Custom blog style
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Main Color', 'integrio'),
                'param_name' => 'custom_main_color',
                'value' => '#abaebe',
                'description' => esc_html__('Select custom main color.', 'integrio'),
                'dependency' => array(
                    'element' => 'use_custom_main_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5 clearfix-col',
            ),  
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Custom Read More Color', 'integrio' ),
                'param_name' => 'use_custom_read_color',
                'description' => esc_html__( 'Custom read more color.', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Custom blog style
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Read More Color', 'integrio'),
                'param_name' => 'custom_read_more_color',
                'value' => esc_attr($theme_color),
                'description' => esc_html__('Select read more color.', 'integrio'),
                'dependency' => array(
                    'element' => 'use_custom_read_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4 clearfix-col',
            ),             
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Read More Color', 'integrio'),
                'param_name' => 'custom_hover_read_more_color',
                'value' => esc_attr($main_font['color']),
                'description' => esc_html__('Select read more color.', 'integrio'),
                'dependency' => array(
                    'element' => 'use_custom_read_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-4 clearfix-col',
            ),          
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Mask Image', 'integrio' ),
                'param_name' => 'custom_blog_mask',
                'description' => esc_html__( 'Custom blog image', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-7',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Mask Image Color', 'integrio'),
                'param_name' => 'custom_image_mask_color',
                'value' => esc_attr('rgba(14,21,30,.6)'),
                'dependency' => array(
                    'element' => 'custom_blog_mask',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Hover Mask', 'integrio' ),
                'param_name' => 'custom_blog_hover_mask',
                'description' => esc_html__( 'Custom blog hover mask', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-7',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Mask Hover Image Color', 'integrio'),
                'param_name' => 'custom_image_hover_mask_color',
                'value' => esc_attr('rgba(14,21,30,.6)'),
                'dependency' => array(
                    'element' => 'custom_blog_hover_mask',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ), 
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Background to Items', 'integrio' ),
                'param_name' => 'custom_blog_bg_item',
                'description' => esc_html__( 'Custom background items', 'integrio' ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-7',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Background Color', 'integrio'),
                'param_name' => 'custom_bg_color',
                'value' => esc_attr('rgba(19,17,31,1)'),
                'dependency' => array(
                    'element' => 'custom_blog_bg_item',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'integrio' ),
                'edit_field_class' => 'vc_col-sm-5',
            ), 
        ),

    ));
    
    Integrio_Loop_Settings::init('wgl_blog_posts_medium_img');
    
    class WPBakeryShortCode_wgl_Blog_Posts_Medium_Img extends WPBakeryShortCode
    {
    }
    

}