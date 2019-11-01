<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Integrio Theme Helper
*
*
* @class        Integrio_Theme_Helper
* @version      1.0
* @category     Class
* @author       WebGeniusLab
*/

if (!class_exists('Integrio_Theme_Helper')) {
    class Integrio_Theme_Helper{

        private static $instance = null;
        public static function get_instance( ) {
            if ( null == self::$instance ) {
                self::$instance = new self( );
            }

            return self::$instance;
        }

        function __construct () { 
            $this->register_filter();
        }

        function register_filter () {
            add_filter( 'vc_iconpicker-type-flaticon', array($this , 'vc_iconpicker_type_flaticon' ) );

        }

        public static function get_option($name, $preset = null, $def_preset = null) {
            if (  class_exists( 'Redux' ) && class_exists( 'Integrio_Core_Public' ) ) {
                $preset = $preset == 'default' ? null : $preset;

                if (!$preset) {

                    // Customizer
                    if (!empty($GLOBALS['integrio_set']) && $GLOBALS['integrio_set'] != NULL) {
                        $theme_options = $GLOBALS['integrio_set'];
                    } else {
                        $theme_options = get_option( 'integrio_set' );
                    }

                } else {
                    $theme_options = get_option( 'integrio_set_preset' );
                }
                
                if (empty($theme_options)) {
                    $theme_options = get_option( 'integrio_default_options' );
                }

                if(!$preset){
                    return isset($theme_options[$name]) ? $theme_options[$name] : null;  
                }
                
                if(!empty($def_preset)){
                    return isset($theme_options['default'][$preset][$name]) ? $theme_options['default'][$preset][$name] : null;
                }else{
                    return isset($theme_options[$preset][$name]) ? $theme_options[$preset][$name] : null;
                }                
                

            }else{
                $default_option = get_option( 'integrio_default_options' );
                return isset($default_option[$name]) ? $default_option[$name] : null;
            }
        }

        public static function options_compare($name,$check_key = false,$check_value = false) {
            $option = self::get_option($name);
            if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
                if ( $check_key ) {
                    $var = rwmb_meta($check_key);
                    if ( !empty($var) ) {
                        if ( $var == $check_value ) {
                            $option = rwmb_meta('mb_'.$name);
                        }
                    }
                } else {
                    $var = rwmb_meta('mb_'.$name);
                    $option = !empty($var) ? rwmb_meta('mb_'.$name) : self::get_option($name);
                }
            }
            return $option;
        }

        public static function bg_render($name,$check_key = false,$check_value = false) {
            $image = Integrio_Theme_Helper::get_option($name."_bg_image");
            
            // Get image src
            $src = !empty($image['background-image']) ? $image['background-image'] : '';
            
            // Get image repeat
            $repeat = !empty($image['background-repeat']) ? $image['background-repeat'] : '';

            // Get image size
            $size = !empty($image['background-size']) ? $image['background-size'] : '';
            
            // Get image attachment
            $attachment = !empty($image['background-attachment']) ? $image['background-attachment'] : '';
            
            // Get image position
            $position = !empty($image['background-position']) ? $image['background-position'] : '';

            if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {

                $conditional_logic = rwmb_meta($check_key);

                if ($conditional_logic == 'on') {

                    $repeat = $size = $attachment = $position  = '';
                    // Get metaboxes image src
                    $src = rwmb_meta('mb_'.$name.'_bg')['image'];

                    // Check if metaboxes image exist
                    if (!empty($src)) {
                        // Get metaboxes image repeat
                        $repeat = rwmb_meta('mb_'.$name.'_bg')['repeat'];
                        $repeat = !empty($repeat) ? $repeat : '';

                        // Get metaboxes image size
                        $size = rwmb_meta('mb_'.$name.'_bg')['size'];
                        $size = !empty($size) ? $size : '';

                        // Get metaboxes image attachment
                        $attachment = rwmb_meta('mb_'.$name.'_bg')['attachment'];
                        $attachment = !empty($attachment) ? $attachment : '';

                        // Get metaboxes image position
                        $position = rwmb_meta('mb_'.$name.'_bg')['position'];
                        $position = !empty($position) ? $position : '';
                    }
                }
            }

            // Background render
            $style = '';
            $style .= !empty($src) ? 'background-image:url('.esc_url($src).');' : '';
            
            if (!empty($src)) {
                $style .= !empty($size) ? ' background-size:'.esc_attr($size).';' : '';
                $style .= !empty($repeat) ? ' background-repeat:'.esc_attr($repeat).';' : '';
                $style .= !empty($attachment) ? ' background-attachment:'.esc_attr($attachment).';' : '';
                $style .= !empty($position) ? ' background-position:'.esc_attr($position).';' : '';
            }
            return $style;
        }

        public static function preloader(){
            if (self::get_option('preloader') == '1' || self::get_option('preloader') == true) {
                $preloader_background = self::get_option('preloader_background');
                $preloader_color_1 = self::get_option('preloader_color_1');

                $bg_styles = !empty($preloader_background) ? ' style=background-color:'.$preloader_background.';' : "";
                $circle_color_1 = !empty($preloader_color_1) ? ' style=background-color:'.$preloader_color_1.';' : "";

                echo '<div id="preloader-wrapper" '.esc_attr($bg_styles).'>
                        <div class="preloader-container">
                          <div '.$circle_color_1.'></div>
                          <div '.$circle_color_1.'></div>
                          <div '.$circle_color_1.'></div>
                          <div '.$circle_color_1.'></div>
                          <div '.$circle_color_1.'></div>
                          <div '.$circle_color_1.'></div>
                          <div '.$circle_color_1.'></div>
                          <div '.$circle_color_1.'></div>
                          <div '.$circle_color_1.'></div>
                          </div>
                        </div>
                    </div>';
            }
        }

        public static function pagination($range = 5, $query = false, $alignment = 'left'){
            if ( $query != false ) {
                $wp_query = $query;
            } else {
                global $paged, $wp_query;
            }
            if (empty($paged)) {
                $query_vars = $wp_query->query_vars;
                $paged = isset($query_vars['paged']) ? $query_vars['paged'] : 1;
            }
            
            $output = '';
            $max_page = $wp_query->max_num_pages;


            // Exit if pagination not need
            if ( !($max_page > 1) ) return;

            switch ($alignment) {
                case 'left':
                    $class_alignment = '';
                    break;
                case 'right':
                    $class_alignment = 'aright';
                    break;
                case 'center':
                    $class_alignment = 'acenter';
                    break;
                default:
                    $class_alignment = '';
                    break;
            }

            //return $output;
            $big = 999999999;
            
            $test_pag = paginate_links(array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'type' => 'array',
                'current'    => max( 1, $paged ),
                'total'      => $max_page,
                'prev_text' => '<i class="fa fa-angle-left"></i>',
                'next_text' => '<i class="fa fa-angle-right"></i>',
            ));
            $test_comp = '';
            foreach ($test_pag as $key => $value) {
                $test_comp .= '<li class="page">'.$value.'</li>';
            }
            return '<ul class="wgl-pagination '.esc_attr($class_alignment).'">'.$test_comp.'</ul>';
        }

        public static function hexToRGB($hex = "#ffffff"){
            $color = array();
            if (strlen($hex) < 1) {
                $hex = "#ffffff";
            }
            $color['r'] = hexdec(substr($hex, 1, 2));
            $color['g'] = hexdec(substr($hex, 3, 2));
            $color['b'] = hexdec(substr($hex, 5, 2));
            return $color['r'] . "," . $color['g'] . "," . $color['b'];
        }
        //https://github.com/opensolutions/smarty/blob/master/plugins/modifier.truncate.php
        public static function modifier_character($string, $length = 80, $etc = '... ', $break_words = false) {
            if ($length == 0)
                return '';

            if (mb_strlen($string, 'utf8') > $length) {
                $length -= mb_strlen($etc, 'utf8');
                if (!$break_words) {
                    $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
                }
                return mb_substr($string, 0, $length, 'utf8') . $etc;
            } else {
                return $string;
            }
        }

		public static function load_more($query = false, $name_load_more = '', $class = ''){
			$name_load_more = !empty($name_load_more) ? $name_load_more : esc_html__( 'Load More', 'integrio' );

			$uniq = uniqid();
			$ajax_data_str = htmlspecialchars( json_encode($query), ENT_QUOTES, 'UTF-8' );

			$out = '<div class="clear"></div>';
			$out .= '<div class="load_more_wrapper'.(!empty($class) ? ' '.esc_attr($class) : '' ).'">';
			$out .= '<div class="button_wrapper">';
				$out .= '<a href="#" class="load_more_item"><span>'.esc_html($name_load_more).'</span></a>';
			$out .= '</div>';
			$out .= '<form class="posts_grid_ajax">';
				$out .= "<input type='hidden' class='ajax_data' name='".esc_attr($uniq)."_ajax_data' value='$ajax_data_str' />";
			$out .= '</form>';
			$out .= '</div>';
			
			return $out;
		}

        public static function header_preset_name(){
            $id = get_queried_object_id();
            $name_preset = '';

            // Redux options header
            $name_preset = self::get_option('header_def_js_preset');
            $get_def_name = get_option( 'integrio_set_preset' );
            if( !self::in_array_r($name_preset, get_option( 'integrio_set_preset' ))){                   
                $name_preset = 'default';
            }

            // Metaboxes options header
            if (class_exists( 'RWMB_Loader' ) && $id !== 0) {
                $customize_header = rwmb_meta('mb_customize_header');
                if (!empty($customize_header) && rwmb_meta('mb_customize_header') != 'default') {
                    $name_preset = rwmb_meta('mb_customize_header');                  
                    if( !self::in_array_r($name_preset, get_option( 'integrio_set_preset' ))){
                        $name_preset = 'default';
                    }
                }
            }
            return $name_preset;
        }

        public static function render_html ($args) {
            return isset($args) ? $args : '';
        }
 
        public static function in_array_r($needle, $haystack, $strict = false) {
            if(is_array($haystack)){
                foreach ($haystack as $item) {
                    if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && self::in_array_r($needle, $item, $strict))) {
                        return true;
                    }
                }                
            }

            return false;
        }

        public static function render_sidebars($args = 'page'){
            $output = array();
            $sidebar_style = '';

            $layout = self::get_option( $args.'_sidebar_layout');
            $sidebar = self::get_option( $args.'_sidebar_def');
            $sidebar_width = self::get_option($args.'_sidebar_def_width');
            $sticky_sidebar = self::get_option($args.'_sidebar_sticky');
            $sidebar_gap = self::get_option($args.'_sidebar_gap');
            $sidebar_class = $sidebar_style = '';
            
            $integrio_core = class_exists('Integrio_Core');  
            
            if( is_archive() || is_search() || is_home() || is_page()){
                if(!$integrio_core){
                    if(is_active_sidebar( 'sidebar_main-sidebar' )){
                        $layout = 'right';
                        $sidebar = 'sidebar_main-sidebar';
                        $sidebar_width = 9;                        
                    }

                }
            }            
            
            if(function_exists('is_shop') &&  is_shop()){
                if(!$integrio_core){
                    if(is_active_sidebar( 'shop_products' )){
                        $layout = 'right';
                        $sidebar = 'shop_products';
                        $sidebar_width = 9;
                    }else{
                        $column = 12;
                        $sidebar = '';
                        $layout = 'none';
                    }  
                }
            }

            if(is_single()){
                if(!$integrio_core){
                    if(function_exists('is_product') && is_product()){
                        if(is_active_sidebar( 'shop_single' )){
                            $layout = 'right';
                            $sidebar = 'shop_single';
                            $sidebar_width = 9;
                        }                        
                    }elseif(is_active_sidebar( 'sidebar_main-sidebar' )){
                        $layout = 'right';
                        $sidebar = 'sidebar_main-sidebar';
                        $sidebar_width = 9;
                    }
                }
            }

            if ( class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0 ) {
                $mb_layout = rwmb_meta('mb_page_sidebar_layout');
                if (!empty($mb_layout) && $mb_layout != 'default') {
                    $layout = $mb_layout;
                    $sidebar = rwmb_meta('mb_page_sidebar_def');
                    $sidebar_width = rwmb_meta('mb_page_sidebar_def_width');
                    $sticky_sidebar = rwmb_meta('mb_sticky_sidebar');
                    $sidebar_gap = rwmb_meta('mb_sidebar_gap');
                }
            }
            
            if((bool)$sticky_sidebar){
                wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.min.js', array(), false, false);
                $sidebar_class .= 'sticky-sidebar';
            }

            if (isset($sidebar_gap) && $sidebar_gap != 'def' && $layout != 'default') {
                $layout_pos = $layout == 'left' ? 'right' : 'left';
                $sidebar_style = 'style="padding-'.$layout_pos.': '.$sidebar_gap.'px;"';
            }

            $column = 12;
            if ( $layout == 'left' || $layout == 'right' ) {
                $column = (int) $sidebar_width;
            }else{
                $sidebar = '';
            }

            //GET Params sidebar
            if(isset($_GET['shop_sidebar']) && !empty($_GET['shop_sidebar'])){
                $layout = $_GET['shop_sidebar'];
                $sidebar = 'shop_products';
                $column = 9;
            }

            if(!is_active_sidebar( $sidebar )){
                $column = 12;
                $sidebar = '';
                $layout = 'none';
            }

            $output['column'] = $column;
            $output['row_class'] = $layout != 'none' ? ' sidebar_'.esc_attr($layout) : '';
            $output['layout'] = $layout;
            $output['content'] = '';

            if ($layout == 'left' || $layout == 'right') {
                    $output['content'] .= '<div class="sidebar-container '.$sidebar_class.' wgl_col-'.(12 - (int)$column).'" '.$sidebar_style.'>';
                        if (is_active_sidebar( $sidebar )) {
                            $output['content'] .= "<aside class='sidebar'>";
                                ob_start();
                                    dynamic_sidebar( $sidebar );
                                $output['content'] .= ob_get_clean();
                            $output['content'] .= "</aside>";
                        }
                    $output['content'] .= "</div>";
            }
            return $output;
        }

        public static function posted_meta_on(){
            global $post;
            $text_string = '<span><time class="entry-date published" datetime="%1$s">%2$s</time></span><span>' . esc_html__('Published in', 'integrio') . ' <a href="%3$s" rel="gallery">%4$s</a></span>';

            echo sprintf($text_string,
                esc_attr(get_the_date('c')),
                esc_html(get_the_date()),
                esc_url(get_permalink($post->post_parent)),
                esc_html(get_the_title($post->post_parent))
            );

            printf(
                '<span class="author vcard">%1$s</span>',
                sprintf(
                    '<a class="url fn n" href="%1$s">%2$s</a>',
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    esc_html( get_the_author() )
                )
            );

            $metadata = wp_get_attachment_metadata();

            if ( $metadata ) {
                printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s" title="%2$s">%1$s %3$s &times; %4$s</a></span>',
                    esc_html_x( 'Full size', 'Used before full size attachment link.', 'integrio' ),
                    esc_url( wp_get_attachment_url() ),
                    esc_attr( absint( $metadata['width'] ) ),
                    esc_attr( absint( $metadata['height'] ) )
                );
            }

            $allowed_html = array(
                'span' => array(
                    'class' => true,
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            );
            edit_post_link(
                sprintf(
                    /* translators: %s: Name of current post */
                    wp_kses( __( 'Edit<span class="screen-reader-text"> "%s"</span>', 'integrio' ), $allowed_html ) ,
                        get_the_title()
                    ),'<span class="edit-link">','</span>');
        }

        public function vc_iconpicker_type_flaticon( $icons ) {
            $flaticon_icons = array(
                array('flaticon-paint-palette' => 'paint-palette'),
                array('flaticon-contract' => 'contract'),
                array('flaticon-paint-roller' => 'paint-roller'),
                array('flaticon-medal' => 'medal'),
                array('flaticon-paint-brush' => 'paint-brush'),
                array('flaticon-heart' => 'heart'),
                array('flaticon-paint-bucket' => 'paint-bucket'),
                array('flaticon-search' => 'search'),
                array('flaticon-compass' => 'compass'),
                array('flaticon-blueprint' => 'blueprint'),
                array('flaticon-resources' => 'resources'),
                array('flaticon-charity' => 'charity'),
                array('flaticon-sketching' => 'sketching'),
                array('flaticon-money' => 'money'),
                array('flaticon-blur' => 'blur'),
                array('flaticon-file' => 'file'),
                array('flaticon-graphic-tablet' => 'graphic-tablet'),
                array('flaticon-exam' => 'exam'),
                array('flaticon-wireframe' => 'wireframe'),
                array('flaticon-note' => 'note'),
                array('flaticon-shutter' => 'shutter'),
                array('flaticon-clock' => 'clock'),
                array('flaticon-vision' => 'vision'),
                array('flaticon-arrows' => 'arrows'),
                array('flaticon-eye' => 'eye'),
                array('flaticon-analysis' => 'analysis'),
                array('flaticon-mouse' => 'mouse'),
                array('flaticon-time' => 'time'),
                array('flaticon-sketch' => 'sketch'),
                array('flaticon-video' => 'video'),
                array('flaticon-text-editor' => 'text-editor'),
                array('flaticon-shopping-cart' => 'shopping-cart'),
                array('flaticon-gps' => 'gps'),
                array('flaticon-search-1' => 'search-1'),
                array('flaticon-mail' => 'mail'),
                array('flaticon-search-2' => 'search-2'),
                array('flaticon-clock-1' => 'clock-1'),
                array('flaticon-user' => 'user'),
                array('flaticon-map' => 'map'),
                array('flaticon-bag' => 'bag'),
                array('flaticon-danger' => 'danger'),
                array('flaticon-shopping-bag' => 'shopping-bag'),
                array('flaticon-round-done-button' => 'round-done-button'),
                array('flaticon-heart-1' => 'heart-1'),
                array('flaticon-round-delete-button' => 'round-delete-button'),
                array('flaticon-search-3' => 'search-3'),
                array('flaticon-round-information-button' => 'round-information-button'),
                array('flaticon-bag-1' => 'bag-1'),
                array('flaticon-boxes' => 'boxes'),
                array('flaticon-shopping-bag-1' => 'shopping-bag-1'),
                array('flaticon-shopping-bag-2' => 'shopping-bag-2'),
                array('flaticon-phone' => 'phone'),
                array('flaticon-shopping-bag-3' => 'shopping-bag-3'),
                array('flaticon-mobile-phone' => 'mobile-phone'),
                array('flaticon-paper-bag' => 'paper-bag'),
                array('flaticon-mail-1' => 'mail-1'),
                array('flaticon-bag-2' => 'bag-2'),
                array('flaticon-bag-3' => 'bag-3'),
                array('flaticon-share' => 'share'),
                array('flaticon-chat' => 'chat'),
                array('flaticon-star' => 'star'),
                array('flaticon-random' => 'random'),
                array('flaticon-next' => 'next'),
                array('flaticon-speech-bubble' => 'speech-bubble'),
                array('flaticon-back' => 'back'),
                array('flaticon-arrows-1' => 'arrows-1'),
                array('flaticon-heart-2' => 'heart-2'),
                array('flaticon-right-arrow' => 'right-arrow'),
                array('flaticon-garbage' => 'garbage'),
                array('flaticon-left-arrow' => 'left-arrow'),
                array('flaticon-settings' => 'settings'),
                array('flaticon-star-1' => 'star-1'),
                array('flaticon-reload' => 'reload'),
                array('flaticon-star-2' => 'star-2'),
                array('flaticon-download' => 'download'),
                array('flaticon-star-3' => 'star-3'),
                array('flaticon-padlock' => 'padlock'),
                array('flaticon-support' => 'support'),
                array('flaticon-download-1' => 'download-1'),
                array('flaticon-backup' => 'backup'),
                array('flaticon-avatar' => 'avatar'),
                array('flaticon-plane' => 'plane'),
                array('flaticon-settings-1' => 'settings-1'),
                array('flaticon-menu' => 'menu'),
                array('flaticon-shuffle' => 'shuffle'),
                array('flaticon-menu-1' => 'menu-1'),
                array('flaticon-user-1' => 'user-1'),
                array('flaticon-play' => 'play'),
                array('flaticon-heart-3' => 'heart-3'),
                array('flaticon-menu-2' => 'menu-2'),
                array('flaticon-checked' => 'checked'),
                array('flaticon-menu-3' => 'menu-3'),
                array('flaticon-plus' => 'plus'),
                array('flaticon-tick' => 'tick'),
                array('flaticon-paper-plane' => 'paper-plane'),
                array('flaticon-close' => 'close'),
                array('flaticon-search-4' => 'search-4'),
                array('flaticon-expand' => 'expand'),
                array('flaticon-instagram' => 'instagram'),
                array('flaticon-pin' => 'pin'),
                array('flaticon-paper-plane-1' => 'paper-plane-1'),
                array('flaticon-send' => 'send'),
                array('flaticon-send-1' => 'send-1'),
                array('flaticon-forbidden' => 'forbidden'),
                array('flaticon-user-2' => 'user-2'),
                array('flaticon-close-1' => 'close-1'),
                array('flaticon-dress' => 'dress'),
                array('flaticon-shirt' => 'shirt'),
                array('flaticon-baby-clothes' => 'baby-clothes'),
                array('flaticon-cap' => 'cap'),
                array('flaticon-slipper' => 'slipper'),
                array('flaticon-bag-4' => 'bag-4'),
                array('flaticon-bra' => 'bra'),
                array('flaticon-soccer' => 'soccer'),
                array('flaticon-pen' => 'pen'),
                array('flaticon-rgb' => 'rgb'),
                array('flaticon-cube' => 'cube'),
                array('flaticon-next-1' => 'next-1'),
                array('flaticon-back-1' => 'back-1'),
                array('flaticon-up-arrow' => 'up-arrow'),
                array('flaticon-down-arrow' => 'down-arrow'),
                array('flaticon-arrow' => 'arrow'),
                array('flaticon-arrow-1' => 'arrow-1'),
                array('flaticon-search-5' => 'search-5'),
                array('flaticon-bag-5' => 'bag-5'),
                array('flaticon-menu-4' => 'menu-4'),
                array('flaticon-menu-5' => 'menu-5'),
                array('flaticon-check' => 'check'),
                array('flaticon-chain' => 'chain'),
                array('flaticon-feather' => 'feather'),
                array('flaticon-rgb-1' => 'rgb-1'),
                array('flaticon-loupe' => 'loupe'),
                array('flaticon-pen-1' => 'pen-1'),
                array('flaticon-photograph' => 'photograph'),
                array('flaticon-3d' => '3d'),
                array('flaticon-idea' => 'idea'),
                array('flaticon-paint-brushes' => 'paint-brushes'),
                array('flaticon-packaging' => 'packaging'),
                array('flaticon-quality' => 'quality'),
                array('flaticon-pencil-case' => 'pencil-case'),
                array('flaticon-pencil' => 'pencil'),
                array('flaticon-comment' => 'comment'),
                array('flaticon-music-player-play' => 'music-player-play'),
                array('flaticon-zoom' => 'zoom'),
                array('flaticon-next-2' => 'next-2'),
                array('flaticon-instagram-1' => 'instagram-1'),
                array('flaticon-instagram-2' => 'instagram-2'),
                array('flaticon-filter' => 'filter'),
                array('flaticon-list' => 'list'),
                array('flaticon-menu-6' => 'menu-6'),
                array('flaticon-magnifying-glass' => 'magnifying-glass'),
                array('flaticon-search-6' => 'search-6'),
                array('flaticon-draw' => 'draw'),
                array('flaticon-link' => 'link'),
                array('flaticon-makeup' => 'makeup'),
                array('flaticon-heart-4' => 'heart-4'),
                array('flaticon-crown' => 'crown'),
                array('flaticon-paper-plane-2' => 'paper-plane-2'),
                array('flaticon-light-bulb' => 'light-bulb'),
                array('flaticon-diamond' => 'diamond'),
                array('flaticon-medal-1' => 'medal-1'),
                array('flaticon-heart-5' => 'heart-5'),
                array('flaticon-eye-1' => 'eye-1'),
                array('flaticon-camera' => 'camera'),
                array('flaticon-cupcake' => 'cupcake'),
                array('flaticon-chef' => 'chef'),
                array('flaticon-geometry' => 'geometry'),
                array('flaticon-star-4' => 'star-4'),
                array('flaticon-tablet' => 'tablet'),
                array('flaticon-lifebuoy' => 'lifebuoy'),
                array('flaticon-gear' => 'gear'),
                array('flaticon-photo-camera' => 'photo-camera'),
                array('flaticon-artist' => 'artist'),
                array('flaticon-pin-1' => 'pin-1'),
                array('flaticon-email' => 'email'),
                array('flaticon-menu-7' => 'menu-7'),
                array('flaticon-turquoise' => 'turquoise'),
                array('flaticon-diamond-1' => 'diamond-1'),
                array('flaticon-jewel' => 'jewel'),
                array('flaticon-cart' => 'cart'),
                array('flaticon-cart-1' => 'cart-1'),
                array('flaticon-laptop' => 'laptop'),
                array('flaticon-browser' => 'browser'),
                array('flaticon-rocket' => 'rocket'),
                array('flaticon-pen-2' => 'pen-2'),
                array('flaticon-ink' => 'ink'),
                array('flaticon-laptop-1' => 'laptop-1'),
                array('flaticon-target' => 'target'),
                array('flaticon-industry' => 'industry'),
                array('flaticon-targeting' => 'targeting'),
                array('flaticon-translation' => 'translation'),
                array('flaticon-quality-1' => 'quality-1'),
                array('flaticon-coding' => 'coding'),
                array('flaticon-cash' => 'cash'),
                array('flaticon-pharmacy' => 'pharmacy'),
                array('flaticon-analytics' => 'analytics'),
                array('flaticon-tick-1' => 'tick-1'),
                array('flaticon-pen-3' => 'pen-3'),
                array('flaticon-cloud-computing' => 'cloud-computing'),
                array('flaticon-code' => 'code'),
                array('flaticon-nut' => 'nut'),
                array('flaticon-hanger' => 'hanger'),
                array('flaticon-hanger-1' => 'hanger-1'),
                array('flaticon-idea-1' => 'idea-1'),
                array('flaticon-app' => 'app'),
                array('flaticon-shopping-bag-4' => 'shopping-bag-4'),
                array('flaticon-paper-plane-3' => 'paper-plane-3'),
                array('flaticon-brain' => 'brain'),
                array('flaticon-paint-palette-1' => 'paint-palette-1'),
                array('flaticon-crayon' => 'crayon'),
                array('flaticon-earth' => 'earth'),
                array('flaticon-check-1' => 'check-1'),
                array('flaticon-dna' => 'dna'),
                array('flaticon-call' => 'call'),
                array('flaticon-phone-call' => 'phone-call'),
                array('flaticon-writer' => 'writer'),
                array('flaticon-idea-2' => 'idea-2'),
                array('flaticon-world' => 'world'),
                array('flaticon-scientific' => 'scientific'),
                array('flaticon-photograph-1' => 'photograph-1'),
                array('flaticon-computer' => 'computer'),
                array('flaticon-search-7' => 'search-7'),
                array('flaticon-books' => 'books'),
                array('flaticon-edit' => 'edit'),
                array('flaticon-link-1' => 'link-1'),
                array('flaticon-ui' => 'ui'),
                array('flaticon-chain-1' => 'chain-1'),
                array('flaticon-quote' => 'quote'),
                array('flaticon-map-1' => 'map-1'),
            );

            return array_merge( $icons, $flaticon_icons );
        }

        public static function hexagon_html($fill = '#fff' , $shadow = false){

            $rgb = self::hexToRGB($fill);
            $svg_shadow = (bool)$shadow ? 'filter: drop-shadow(4px 5px 4px rgba('.$rgb.',0.3));' : '';

            $output = '<div class="integrio_hexagon"><svg style="'.esc_attr($svg_shadow).' fill: '.esc_attr($fill).';" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 177.4 197.4"><path d="M0,58.4v79.9c0,6.5,3.5,12.6,9.2,15.8l70.5,40.2c5.6,3.2,12.4,3.2,18,0l70.5-40.2c5.7-3.2,9.2-9.3,9.2-15.8V58.4 c0-6.5-3.5-12.6-9.2-15.8L97.7,2.4c-5.6-3.2-12.4-3.2-18,0L9.2,42.5C3.5,45.8,0,51.8,0,58.4z"/></svg></div>';

            return $output;
        }

        /**
         * Check licence activation
         */
        public static function wgl_theme_activated(){
            $licence_key = get_option( 'wgl_licence_validated' );
            $licence_key = empty( $licence_key ) ? get_option( Wgl_Theme_Verify::get_instance()->item_id ) : $licence_key;
            
            if( !empty($licence_key) ){
                return $licence_key;
            }
            
            return false;
        }
        
    }
    new Integrio_Theme_Helper();
}
?>