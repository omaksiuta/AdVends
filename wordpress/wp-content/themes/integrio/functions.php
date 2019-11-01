<?php 

//Class Theme Helper
require_once ( get_template_directory() . '/core/class/theme-helper.php' );

//Class Theme Cache
require_once ( get_template_directory() . '/core/class/theme-cache.php' );

//Class Walker comments
require_once ( get_template_directory() . '/core/class/walker-comment.php' );

//Class Walker Mega Menu
require_once ( get_template_directory() . '/core/class/walker-mega-menu.php' );

//Class Theme Likes
require_once ( get_template_directory() . '/core/class/theme-likes.php' );

//Class Theme Cats Meta
require_once ( get_template_directory() . '/core/class/theme-cat-meta.php' );

//Class Single Post
require_once ( get_template_directory() . '/core/class/single-post.php' );

//Class Theme Autoload
require_once ( get_template_directory() . '/core/class/theme-autoload.php' );

//Class Theme Dashboard
require_once ( get_template_directory() . '/core/class/theme-panel.php' );

//Class Theme Verify
require_once ( get_template_directory() . '/core/class/theme-verify.php' );

//Class Tinymce
require_once(get_template_directory() . "/core/class/tinymce-icon.php");

function integrio_editor() {

    /* This theme styles the visual editor with editor-style.css to match the theme style. */
    add_editor_style( 'css/editor-styles.css' );
    add_editor_style('fonts/flaticon/flaticon.css');
    
    add_theme_support( 'editor-styles' );
    
}
add_action( 'after_setup_theme', 'integrio_editor' );

function integrio_content_width() {
    if ( ! isset( $content_width ) ) {
        $content_width = 940;
    }
}
add_action( 'after_setup_theme', 'integrio_content_width', 0 );

function integrio_theme_slug_setup() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'integrio_theme_slug_setup');

require_once(get_template_directory() . '/wpb/wpb-init.php');


add_action('init', 'integrio_page_init');
if (!function_exists('integrio_page_init')) {
    function integrio_page_init()
    {
        add_post_type_support('page', 'excerpt');
    }
}

if (!function_exists('integrio_main_menu')) {
    function integrio_main_menu ($location = ''){
        wp_nav_menu( array(
            'theme_location'  => 'main_menu',
            'menu'  => $location,
            'container' => '',
            'container_class' => '',  
            'after' => '',
            'link_before'     => '<span>',
            'link_after'      => '</span>',            
            'walker' => new Integrio_Mega_Menu_Waker()
        ) );
    }
}

// return all sidebars
if (!function_exists('integrio_get_all_sidebar')) {
    function integrio_get_all_sidebar() {
        global $wp_registered_sidebars;
        $out = array();
        if ( empty( $wp_registered_sidebars ) )
            return;
         foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar) :
            $out[$sidebar_id] = $sidebar['name'];
         endforeach; 
         return $out;
    }
}

if (!function_exists('integrio_get_custom_preset')) {
    function integrio_get_custom_preset() {
        $custom_preset = get_option('integrio_set_preset');
        $presets =  integrio_default_preset();
        
        $out = array();
        $out['default'] = esc_html__( 'Default', 'integrio' );
        $i = 1;
        if(is_array($presets)){
            foreach ($presets as $key => $value) {
                $out[$key] = $key;
                $i++;
            }            
        }
        if(is_array($custom_preset)){
            foreach ( $custom_preset as $preset_id => $preset) :
                $out[$preset_id] = $preset_id;
            endforeach;             
        }
        return $out;
    }
}

if (!function_exists('integrio_get_custom_menu')) {
    function integrio_get_custom_menu() {
        $taxonomies = array();

        $menus = get_terms('nav_menu');
        foreach ($menus as $key => $value) {
            $taxonomies[$value->name] = $value->name;
        }
        return $taxonomies;   
    }
}

function integrio_get_attachment( $attachment_id ) {
    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

if (!function_exists('integrio_reorder_comment_fields')) {
    function integrio_reorder_comment_fields($fields ) {
        $new_fields = array();

        $myorder = array('author', 'email', 'url', 'comment');

        foreach( $myorder as $key ){
            $new_fields[ $key ] = isset($fields[ $key ]) ? $fields[ $key ] : '';
            unset( $fields[ $key ] );
        }

        if( $fields ) {
            foreach( $fields as $key => $val ) {
                $new_fields[ $key ] = $val;
            }
        }

        return $new_fields;
    }
}
add_filter('comment_form_fields', 'integrio_reorder_comment_fields');

function integrio_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'integrio_mce_buttons_2' );


function integrio_tiny_mce_before_init( $settings ) {

    $settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';
    $style_formats = array(
        array(
            'title' => esc_html__( 'Dropcap', 'integrio' ),
            'items' => array(
                array(
                    'title' => esc_html__( 'Dropcap', 'integrio' ),
                    'inline' => 'span', 
                    'classes' => 'dropcap', 
                    'styles' => array( 'color' => esc_attr( Integrio_Theme_Helper::get_option('theme-custom-color') )),
                ),
                array(
                    'title' => esc_html__( 'Dropcap with background', 'integrio' ),
                    'inline' => 'span',
                    'classes' => 'dropcap-bg',
                    'styles' => array( 'background-color' => esc_attr( Integrio_Theme_Helper::get_option('theme-custom-color') )),
                ),
            ),
        ),
        array( 
            'title' => esc_html__( 'Highlighter', 'integrio' ), 
            'inline' => 'span', 
            'classes' => 'highlighter', 
            'styles' => array( 'color' => '#ffffff', 'background-color' => esc_attr( Integrio_Theme_Helper::get_option('theme-custom-color') )),
        ),
        array( 
            'title' => esc_html__( 'Double Heading Font', 'integrio' ), 
            'inline' => 'span', 
            'classes' => 'dbl_font',
        ),
        array( 
            'title' => esc_html__( 'Font Weight', 'integrio' ), 
            'items' => array(
                array( 'title' => esc_html__( 'Default', 'integrio' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => 'inherit' ) ),
                array( 'title' => esc_html__( 'Lightest (100)', 'integrio' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '100' ) ),
                array( 'title' => esc_html__( 'Lighter (200)', 'integrio' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '200' ) ),
                array( 'title' => esc_html__( 'Light (300)', 'integrio' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '300' ) ),
                array( 'title' => esc_html__( 'Normal (400)', 'integrio' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '400' ) ),
                array( 'title' => esc_html__( 'Medium (500)', 'integrio' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '500' ) ),
                array( 'title' => esc_html__( 'Semi-Bold (600)', 'integrio' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '600' ) ),
                array( 'title' => esc_html__( 'Bold (700)', 'integrio' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '700' ) ),
                array( 'title' => esc_html__( 'Bolder (800)', 'integrio' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '800' ) ),
                array( 'title' => esc_html__( 'Extra Bold (900)', 'integrio' ), 'inline' => 'span', 'classes' => '', 'styles' => array( 'font-weight' => '900' ) ),
            )
        ),
        array(
            'title' => esc_html__( 'List Style', 'integrio' ),
            'items' => array(
                array( 'title' => esc_html__( 'Check', 'integrio' ), 'selector' => 'ul', 'classes' => 'integrio_check' ),
                array( 'title' => esc_html__( 'Plus', 'integrio' ), 'selector' => 'ul', 'classes' => 'integrio_plus' ),
                array( 'title' => esc_html__( 'Dash', 'integrio' ), 'selector' => 'ul', 'classes' => 'integrio_dash' ),
                array( 'title' => esc_html__( 'Slash', 'integrio' ), 'selector' => 'ul', 'classes' => 'integrio_slash' ),
                array( 'title' => esc_html__( 'No List Style', 'integrio' ), 'selector' => 'ul', 'classes' => 'no-list-style' ),
            )
        ),
    );

    $settings['style_formats'] = str_replace( '"', "'", json_encode( $style_formats ) );
    $settings['extended_valid_elements'] = 'span[*],a[*],i[*]';
    return $settings;
}
add_filter( 'tiny_mce_before_init', 'integrio_tiny_mce_before_init' );

function integrio_theme_add_editor_styles() {
    add_editor_style( 'css/font-awesome.min.css' );
}
add_action( 'current_screen', 'integrio_theme_add_editor_styles' );

function integrio_categories_postcount_filter ($variable) {
    if(strpos($variable,'</a> (')){
        $variable = str_replace('</a> (', '</a> <span class="post_count">(', $variable); 
        $variable = str_replace('</a>&nbsp;(', '</a>&nbsp;<span class="post_count">(', $variable); 
        $variable = str_replace(')', ')</span>', $variable);      
    }
    else{
        $variable = str_replace('</a> <span class="count">(', '</a><span class="post_count">(', $variable);    
    }

    $pattern1 = '/cat-item-\d+/';
    preg_match_all( $pattern1, $variable,$matches );
    if(isset($matches[0])){
        foreach ($matches[0] as $key => $value) {
            $int = (int) str_replace('cat-item-','', $value);
            $icon_image_id = get_term_meta ( $int, 'category-icon-image-id', true );
            if(!empty($icon_image_id)){
                $icon_image = wp_get_attachment_image_src ( $icon_image_id, 'full' );
                $icon_image_alt = get_post_meta($icon_image_id, '_wp_attachment_image_alt', true);
                $replacement = '$1<img class="cats_item-image" src="'. esc_url($icon_image[0]) .'" alt="'.(!empty($icon_image_alt) ? esc_attr($icon_image_alt) : '').'"/>';
                $pattern = '/(cat-item-'.$int.'+.*?><a.*?>)/';
                $variable = preg_replace( $pattern, $replacement, $variable );
            }
        }        
    }   

    return $variable;
}
add_filter('wp_list_categories', 'integrio_categories_postcount_filter');

add_filter( 'get_archives_link', 'integrio_render_archive_widgets', 10, 6 );
function integrio_render_archive_widgets ( $link_html, $url, $text, $format, $before, $after ) {

    $text = wptexturize( $text );
    $url  = esc_url( $url );

    if ( 'link' == $format ) {
        $link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
    } elseif ( 'option' == $format ) {
        $link_html = "\t<option value='$url'>$before $text $after</option>\n";
    } elseif ( 'html' == $format ) {
        $after = str_replace('(', '', $after);
        $after = str_replace(' ', '', $after);
        $after = str_replace('&nbsp;', '', $after);
        $after = str_replace(')', '', $after);

        $after = !empty($after) ? " <span class='post_count'>(".esc_html($after).")</span> " : "";

        $link_html = "<li>".esc_html($before)."<a href='".esc_url($url)."'>".esc_html($text)."</a>".$after."</li>";
    } else { // custom
        $link_html = "\t$before<a href='$url'>$text</a>$after\n";
    }
    
    return $link_html;
}

// Add image size
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'integrio-700-550',  700, 550, true  );
    add_image_size( 'integrio-440-440',  440, 440, true  );
    add_image_size( 'integrio-180-180',  180, 180, true  );
    add_image_size( 'integrio-120-120',  120, 120, true  );
}

// Include Woocommerce init if plugin is active
if ( class_exists( 'WooCommerce' ) ) {
    require_once( get_template_directory() . '/woocommerce/woocommerce-init.php' ); 
}

add_filter('vc_css_editor_border_radius_options_data','integrio_border_radius_options');

function integrio_border_radius_options() {
    $output = array(
        '' => esc_html__( 'None', 'integrio' ),
        '1px' => esc_html__( '1px', 'integrio' ),
        '2px' => esc_html__( '2px', 'integrio' ),
        '3px' => esc_html__( '3px', 'integrio' ),
        '4px' => esc_html__( '4px', 'integrio' ),
        '5px' => esc_html__( '5px', 'integrio' ),
        '10px' => esc_html__( '10px', 'integrio' ),
        '15px' => esc_html__( '15px', 'integrio' ),
        '20px' => esc_html__( '20px', 'integrio' ),
        '25px' => esc_html__( '25px', 'integrio' ),
        '30px' => esc_html__( '30px', 'integrio' ),
        '35px' => esc_html__( '35px', 'integrio' ),
        '50%' => esc_html__( '50%', 'integrio' ),
    );
    return $output;
}

add_filter('integrio_enqueue_shortcode_css', 'integrio_render_css');
function integrio_render_css($styles){
    global $integrio_dynamic_css;
    if(! isset($integrio_dynamic_css['style'])){
        $integrio_dynamic_css = array();
        $integrio_dynamic_css['style'] = $styles;
    }else{
        $integrio_dynamic_css['style'] .= $styles;
    }
}