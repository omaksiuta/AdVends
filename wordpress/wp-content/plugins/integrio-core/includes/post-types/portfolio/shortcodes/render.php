<?php
if ( !class_exists('Integrio_Theme_Helper') ) { return; }

class WglPortfolio{

    private $shortcodeName;
    public $post_count;
    private $content;

    public function __construct() {
        $this->shortcodeName = 'wgl_portfolio_list';
        add_action('vc_before_init', array($this, 'shortcodesMap'));
        $this->addShortcode();
    }

    public function shortcodesMap(){    
        require_once(WP_PLUGIN_DIR . '/' .trim(dirname(plugin_basename(__FILE__)), '/'). '/options.php');
    }

    public function addShortcode(){
        add_shortcode($this->shortcodeName, array($this, 'render'));
    }

    public function render($atts, $content = null){
        include_once get_template_directory() . '/wpb/google_fonts_enqueue.php';
        $header_font = Integrio_Theme_Helper::get_option('header-font');
        $main_font = Integrio_Theme_Helper::get_option('main-font');
        $theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
        $theme_gradient = Integrio_Theme_Helper::get_option('theme-gradient');

        $args = array(
            'posts_per_row' => 3,
            'show_filter' => '',
            'filter_align' => 'center',
            'portfolio_layout' => 'grid',
            'crop_images' => 'yes',
            'navigation' => 'none',
            'nav_align' => 'center',
            'items_load' => 4,
            'name_load_more' => esc_html__('Load More', 'integrio'),
            'grid_gap' => '30px',
            'add_animation' => false,
            'appear_animation' => 'fade-in',
            'css' => '',
            'item_el_class' => '',
            
            // Content
            'click_area' => 'popup',
            'single_link_title' => true,
            'info_position' => 'inside_image',
            'image_anim' => 'sub_layer',
            'horizontal_align' => 'center',
            'show_portfolio_title' => true,
            'show_meta_categories' => true,
            'show_content' => '',
            'content_letter_count' => '85',
            
            // Carousel
            'autoplay' => false,
            'autoplay_speed' => '3000',
            'multiple_items' => true,
            'slides_to_scroll' => false,
            'center_mode' => false,
            'center_info' => false,
            'variable_width' => false,
            'use_pagination' => false,
            'pag_type' => 'circle',
            'pag_offset' => '',
            'custom_pag_color' => false,
            'pag_color' => $theme_color,
            'use_prev_next' => false,
            'arrows_center_mode' => false,
            'custom_resp' => false,
            'resp_medium' => '1025',
            'resp_medium_slides' => '',
            'resp_tablets' => '800',
            'resp_tablets_slides' => '',
            'resp_mobile' => '480',
            'resp_mobile_slides' => '',
            
            // Custom style
            'heading_font_size' => '',
            'cat_font_size' => '',
            'custom_fonts_portfolio_headings' => '',
            'google_fonts_portfolio_headings' => '',
            'custom_heading' => false,
            'heading_color' => '#ffffff',
            'heading_color_hover' => 'rgba(255,255,255,0.7)',
            'custom_cat' => false,
            'cat_color' => $theme_color,
            'cat_color_hover' => 'rgba(255,255,255,0.8)',
            'custom_icons' => false,
            'icons_color' => esc_attr($header_font['color']),
            'icons_color_hover' => $theme_color,
            'custom_content' => false,
            'content_color' => esc_attr($main_font['color']),
            'bg_color_type' => 'def',
            'background_color' => 'rgba(65, 65, 65, 0.65)',
            'background_gradient_start' => 'rgba('.Integrio_Theme_Helper::HexToRGB($theme_gradient['from']).', 0.85)',
            'background_gradient_end' => 'rgba('.Integrio_Theme_Helper::HexToRGB($theme_gradient['to']).', 0.85)',
            'custom_sec_overlay' => false,
            'sec_overlay_color' => esc_attr($theme_color),

            // Metaboxes Settings
            'mb_pf_carousel_r' => '',
        );

        $params = vc_shortcode_attribute_parse($args, $atts);
        $this->content = $content;
        extract($params);

        // Build Query Visual Composer
        list($query_args) = Integrio_Loop_Settings::buildQuery($params);
       
        $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query_args['post_type'] = 'portfolio';
        
        // Add Query Not In Post in the Related Posts(Metaboxes)
        if(!empty($featured_render)){
            $query_args['post__not_in'] = array( get_the_id() );
        }

        $query_results = new WP_Query($query_args);
        $params['post_count'] = $this->post_count = $query_results->post_count;
        $params['found_posts'] = $query_results->found_posts;
        $params['query_args'] = $query_args;

        
        $sc_obj = Vc_Shortcodes_Manager::getInstance()->getElementClass( $this->shortcodeName );
        $class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $sc_obj->getExtraClass( $item_el_class );
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $css, $atts );

        // Add custom id
        $item_id = '';
        $item_id = uniqid( "portfolio_module_" );
        

        //Register css
        $this->register_css($params, $item_id);
                 
        //Metaxobes Related Items
        if(!empty($featured_render)){
            $portfolio_layout = 'related';
        }
        if(!empty($featured_render) && !empty($mb_pf_carousel_r)){
            $portfolio_layout = 'carousel';
        }
        
        if(!empty($show_filter) || $portfolio_layout == 'masonry2' || $portfolio_layout == 'masonry3' || $portfolio_layout == 'masonry4'){
            $portfolio_layout = 'masonry';
        }

        // Classes
        $container_classes = '';
        $container_classes .= $grid_gap == '0px' ? ' no_gap' : '';
        $container_classes .= (bool)$add_animation ? ' appear-animation' : '';
        $container_classes .= (bool)$add_animation && !empty($appear_animation) ? ' anim-'.$appear_animation : '';

        $out = '';               
        $out .= '<section class="wgl_cpt_section">';               
        $out .= '<div class="'.esc_attr($this->shortcodeName).'"'.((bool)$item_id ? ' id="'.esc_attr($item_id).'"' : "" ).'>';
        
        wp_enqueue_script( 'imagesloaded' );    
        if ((bool)$add_animation) {
            wp_enqueue_script('appear', get_template_directory_uri() . '/js/jquery.appear.js', array(), false, false); 
        }  
        if($click_area == 'popup'){
            wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/swipebox/js/jquery.swipebox.min.js', array(), false, false);
            wp_enqueue_style('swipebox', get_template_directory_uri() . '/js/swipebox/css/swipebox.min.css');            
        }
        if ($portfolio_layout == 'masonry') {
            //Call Wordpress Masonry
            wp_enqueue_script('isotope');
        }

        if ( (bool) $show_filter) {         
            $filter_class = $portfolio_layout != "carousel" ? 'isotope-filter' : '';
            $filter_class .= ' filter-'.$filter_align;
            $out .= '<div class="'.esc_attr($this->shortcodeName).'__filter '.esc_attr($filter_class).'">';
            $out .= $this->getCategories($query_args, $query_results);
            $out .= '</div>'; 
        }

        $style_gap = isset($grid_gap) && !empty($grid_gap) ? ' style="margin-right:-'.((int)$grid_gap/2).'px; margin-left:-'.((int)$grid_gap/2).'px; margin-bottom:-'.$grid_gap.';"' : '';
        
        $out .= '<div class="'.esc_attr($this->shortcodeName).'-wrapper">';
            $out .= '<div class="'.esc_attr($this->shortcodeName).'-container container-grid row '.esc_attr($this->row_class($params, $portfolio_layout)).esc_attr($css_class).esc_attr($container_classes).'" '.$style_gap.'>'; 
                $out .= $this->output_loop_query($query_results, $params);        
            $out .= '</div>';
        $out .= '</div>';

        wp_reset_postdata();     

        if ( $navigation == 'pagination' ) {
            global $paged;
            if ( empty($paged) ) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }

            $out .= Integrio_Theme_Helper::pagination('10', $query_results, $nav_align);            
        }

        if ( $navigation == 'load_more' && ( $params['post_count'] < $params['found_posts'] ) ) {
            $out .= $this->loadMore ($params, $name_load_more); 
        }          

        if ( $navigation == 'infinite' && ( $params['post_count'] < $params['found_posts'] ) ) {
            $out .= $this->infinite_more ($params); 
        }     
        
        $out .= '</div>';
        $out .= '</section>';
        return $out;
    }

    public function output_loop_query($q, $params){
        extract($params);
        $out = '';
        $count = 0;

        switch ($portfolio_layout) {
            case 'masonry4': $max_count = 6; break;
            case 'masonry2':
            case 'masonry3': $max_count = 4; break;
            default:         $max_count = 6; break;
        }
        // Metaxobes Related Items
        if(!empty($featured_render)){
            $portfolio_layout = 'related';
        }
        if(!empty($featured_render) && !empty($mb_pf_carousel_r)){
            $portfolio_layout = 'carousel';
        }  
        
        if($q->have_posts()):   
            ob_start();  
            if ($portfolio_layout == 'masonry2' || $portfolio_layout == 'masonry3' || $portfolio_layout == 'masonry4') {
                echo '<div class="wgl_portfolio_list-item-size" style="width:25%;"></div>';
            }         

            while ( $q->have_posts() ) : $q->the_post();

                if ($count < $max_count) { $count++; } else { $count = 1; }
                
                $item_class = $this->grid_class($params,$count);
                switch ($portfolio_layout) {                                                  
                    case 'single':
                    echo $this->wgl_portfolio_single_item($params, $item_class);
                    break; 
                    default:
                    echo $this->wgl_portfolio_item($params, $item_class, $count, $grid_gap);
                    break;            
                }

            endwhile;  
            $render = ob_get_clean();                

            $out .= $portfolio_layout == 'carousel' ? $this->wgl_portfolio_carousel_item($params, $item_class , $render) : $render;
        endif;  
        return $out;
    }

    public function wgl_portfolio_carousel_item($params, $item_class, $return){
        extract($params);
        $wrap_class = '';
        $wrap_class .= (bool)$arrows_center_mode ? ' arrows_center_mode' : '';
        $wrap_class .= (bool)$center_info ? ' center_info' : '';

        $carousel_options_arr = array(
            'slide_to_show' => $posts_per_row,
            'autoplay' => $autoplay,
            'autoplay_speed' => $autoplay_speed,
            'use_pagination' => $use_pagination,
            'pag_type' => $pag_type,
            'pag_offset' => $pag_offset,
            'custom_pag_color' => $custom_pag_color,
            'pag_color' => $pag_color,
            'use_prev_next' => $use_prev_next,
            'custom_resp' => $custom_resp,
            'resp_medium' => $resp_medium,
            'resp_medium_slides' => $resp_medium_slides,
            'resp_tablets' => $resp_tablets,
            'resp_tablets_slides' => $resp_tablets_slides,
            'resp_mobile' => $resp_mobile,
            'resp_mobile_slides' => $resp_mobile_slides,
            'infinite' => $multiple_items,
            'slides_to_scroll' => $slides_to_scroll,
            'extra_class' => $wrap_class,
            'adaptive_height'   => false,
            'center_mode'   => $center_mode,    
            'variable_width'   => $variable_width,  
        );

        // carousel options
        $carousel_options = array_map( function($k, $v) { return "$k=\"$v\" "; }, array_keys($carousel_options_arr), $carousel_options_arr);
        $carousel_options = implode('', $carousel_options);

        wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);

        $portfolio_items = do_shortcode('[wgl_carousel '.$carousel_options.']'. $return .'[/wgl_carousel]');

        return $portfolio_items;
    }

    private function register_css($params,$item_id){
        extract($params);
        
        // Start Custom CSS
        $styles = '';

        // Render Google Fonts
        if( (bool)$custom_fonts_portfolio_headings ) {

            $portfolio_value_font_headings = '';
            $sc_obj = Vc_Shortcodes_Manager::getInstance()->getElementClass( $this->shortcodeName );
            
            extract( Integrio_GoogleFontsRender::getAttributes( $params, $sc_obj, array('google_fonts_portfolio_headings')));

            if ( ! empty( $styles_google_fonts_portfolio_headings ) ) {
                $portfolio_value_font_headings = esc_attr( $styles_google_fonts_portfolio_headings );
                $styles .= "
                #$item_id .title {
                    ".$portfolio_value_font_headings."
                }";
            }
        }

        ob_start();

        // Header Styles
            if ( !empty($heading_font_size) ) {
                echo "#$item_id .title{
                    font-size: ".(int)$heading_font_size."px;
                }";
            }
            if ( (bool)$custom_heading ) {
                echo "#$item_id .title{
                          color: ".(!empty($heading_color) ? $heading_color : '').";
                      }";
                echo "#$item_id .title:hover{
                          color: ".(!empty($heading_color_hover) ? $heading_color_hover : '').";
                      }";
            }

        // Categories Styles
            if ( !empty($cat_font_size) ) {
                echo "#$item_id .post_cats{
                          font-size: ".(int)$cat_font_size."px;
                      }";
            }
            if ( (bool)$custom_cat ) {
                echo "#$item_id .post_cats{
                          color: ".(!empty($cat_color) ? $cat_color : '').";
                      }";
                echo "#$item_id .post_cats a:hover{
                          color: ".(!empty($cat_color_hover) ? $cat_color_hover : '').";
                      }";
            }
        
        // Icons Styles
            if ( (bool)$custom_icons ) {
                echo "#$item_id .portfolio_link{
                          color: ".(!empty($icons_color) ? $icons_color : '').";
                      }";
                echo "#$item_id .portfolio_link-icon:hover{
                          color: ".(!empty($icons_color_hover) ? $icons_color_hover : '').";
                      }";
            }
        
        // Content Styles
            if ( (bool)$custom_content ) {
				echo "#$item_id .wgl_portfolio_item-content{
 						  color: ".(!empty($content_color) ? $content_color : '').";
 					  }";
            }

        // Overlay Styles
            if($bg_color_type == 'color'){
                echo "#$item_id .overlay{
                    background-color: ".$background_color."
                }";
            }
            if($bg_color_type == 'gradient'){
                echo "#$item_id .overlay{          
                    background: linear-gradient(90deg, $background_gradient_start, $background_gradient_end);
                }";
            }

		// Secondary Overlay Styles
			if ( (bool)$custom_sec_overlay ) {
				echo "#$item_id .inside_image .overlay:before,
					  #$item_id .inside_image.always_info_animation:hover .overlay:before{
						  box-shadow: inset 0px 0px 0px 0px rgba(".Integrio_Theme_Helper::HexToRGB($sec_overlay_color).", 1);
					  }";
				echo "#$item_id .inside_image:hover .overlay:before,
					  #$item_id .inside_image.always_info_animation .overlay:before{
						  box-shadow: inset 0px 0px 0px 10px rgba(".Integrio_Theme_Helper::HexToRGB($sec_overlay_color).", 1);
					  }";
				echo "#$item_id .inside_image.offset_animation:before{
						  border-color: ".$sec_overlay_color.";
					  }";
			}

		// Gap Fix
			if ((int)$grid_gap == '0') {
				echo "#$item_id .wgl_portfolio_item-image img,
					  #$item_id .inside_image .wgl_portfolio_item-image{
						  border-radius: 0px;
					  }";
            }

        $styles .= ob_get_clean(); 

        // Register css
        if (!empty($styles)) {
            if(function_exists('Integrio_shortcode_css')){
               Integrio_shortcode_css()->enqueue_integrio_css($styles); 
            }
        }
    }

    private function row_class($params, $pf_layout){
        extract($params);
        $class = '';
        switch ($pf_layout) {
            case 'carousel': $class .= 'carousel'; break;               
            case 'related': $class .= !empty($mb_pf_carousel_r) ? 'carousel' : 'isotope'; break; 
            case 'masonry': $class .= 'isotope'; break;            
            default: $class .= 'grid'; break;
        }         
        $class .= ' portfolio_columns-'.$posts_per_row.'';

        return $class;
    }

    public function grid_class ($params,$count) {
        $class = '';
        if ($params['portfolio_layout'] == 'masonry2') {
            switch ($count) {
                case 1:
                case 6:  $class .= 'wgl_col-6'; break;
                default: $class .= 'wgl_col-3';
            }
        }elseif ($params['portfolio_layout'] == 'masonry3') {
            switch ($count) {
                case 1:
                case 2:  $class .= 'wgl_col-6'; break;
                default: $class .= 'wgl_col-3';
            }
        }elseif ($params['portfolio_layout'] == 'masonry4') {
            switch ($count) {
                case 3:
                case 4:  $class .= 'wgl_col-6'; break;
                default: $class .= 'wgl_col-3';
            }
        }else{
            switch ($params['posts_per_row']) {
                case 1:  $class .= 'wgl_col-12';  break;
                case 2:  $class .= 'wgl_col-6';   break;
                case 3:  $class .= 'wgl_col-4';   break;
                case 4:  $class .= 'wgl_col-3';   break;
                case 5:  $class .= 'wgl_col-1-5'; break;
                default: $class .= 'wgl_col-12';
            }
        }
        $class .= $this->post_cats_class();
        return $class;
    }

    private function post_cats_links( $cat ){
        
        if(!(bool) $cat) return;
        $p_cats = wp_get_post_terms(get_the_id(), 'portfolio-category');
        $p_cats_str = $p_cats_links = '';
        if (!empty($p_cats)) {
            $p_cats_links = '<span class="post_cats">';
            for ($i=0; $i<count( $p_cats ); $i++) {
                $p_cat_term = $p_cats[$i];
                $p_cat_name = $p_cat_term->name;
                $p_cats_str .= ' '.$p_cat_name;
                $p_cats_link = get_category_link( $p_cat_term->term_id );
                $p_cats_links .= '<a href='.esc_html($p_cats_link).' class="portfolio-category">'.esc_html($p_cat_name).'</a>';
                if($i !== count( $p_cats ) - 1) {
                    $p_cats_links .= '<span class="delimiter-comma">/</span>';
                }
            }
            $p_cats_links .= '</span>';
        }
        return $p_cats_links;
    }        

    private function post_cats_class(){
        $p_cats = wp_get_post_terms(get_the_id(), 'portfolio-category');
        $p_cats_class = '';
        for ($i=0; $i<count( $p_cats ); $i++) {
            $p_cat_term = $p_cats[$i];
            $p_cats_class .= ' '.$p_cat_term->slug;
        }
        return $p_cats_class;
    }   

    private function chars_count ( $cols = null ){
        $number = 155;
        switch ( $cols ){
            case '1': $number = 300; break;
            case '2': $number = 130; break;
            case '3': $number = 70;  break;
            case '4': $number = 55;  break;
        }
        return $number;
    }

    private function post_content ($params){
        extract( $params );
        
        if (!(bool)$show_content) return;

        if(class_exists('WPBMap')){
            WPBMap::addAllMappedShortcodes();
        }
       
        $pid = get_the_id ();
        $post = get_post( $pid );
        
        $out = $content = "";
        $chars_count = !empty($content_letter_count) ? $content_letter_count : $this->chars_count( $posts_per_row );
        $content = !empty( $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
        $content = preg_replace( '~\[[^\]]+\]~', '', $content);
        $content = strip_tags( $content );
        $content = Integrio_Theme_Helper::modifier_character($content, $chars_count, "");

        if(!empty($content)){
            $out .= '<div class="wgl_portfolio_item-content">';
            $tag = 'div';
            $out .= sprintf('<%s class="content">%s</%s>', $tag, $content, $tag);                  
            $out .= '</div>';  
        }
        return $out;
    }

    public function wgl_portfolio_item($params, $class, $count, $grid_gap){
        extract($params);
        $out = $link = '';
        
        // Post meta
        $post_cats_links = $this->post_cats_links($show_meta_categories);
        
        // Post meta
        $post_meta = $post_cats_links;    
        
        $crop = isset($crop_images) && !empty($crop_images) ? true : false;
        $wrapper_class = isset($info_position)  ? ' '. $info_position : "";
        
        $wrapper_class = isset($info_position)  ? ' '. $info_position : "";
        $wrapper_class .= isset($horizontal_align) && !empty($horizontal_align)  ? ' h_align_'. $horizontal_align : "";
        $wrapper_class .= $info_position == 'inside_image' ? ' '.$image_anim.'_animation' : '';
        $wrapper_class .= (!(bool)$show_portfolio_title && !(bool)($post_meta)) ? ' gallery_type' : '';

        $style_gap = isset($grid_gap) && !empty($grid_gap) ? ' style="padding-right:'.((int)$grid_gap/2).'px; padding-left:'.((int)$grid_gap/2).'px; padding-bottom:'.$grid_gap.'"' : '';

        // set post options
        $p_id = get_the_ID();
        $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id($p_id), 'full');

        switch ($click_area) {
            case 'popup':
                $link = "<a href='" . $wp_get_attachment_url . "' class='portfolio_link swipebox'><i class='portfolio_link-icon flaticon-search-4'></i></a>";
                break;
            case 'single':
                $link = "<a href='" . get_permalink() . "' class='portfolio_link single_link'><i class='portfolio_link-icon flaticon-right-arrow'></i></a>";
                break;
            case 'custom':
                if (rwmb_meta('mb_portfolio_link') == 1) {
                    $mb_custom_url = !empty(rwmb_meta('portfolio_custom_url')) ? rwmb_meta('portfolio_custom_url') : get_permalink();
                    $mb_custom_url_target = !empty(rwmb_meta('portfolio_custom_url_target')) ? '_blank' : '';
                    $link = "<a href='" . esc_url($mb_custom_url) . "' target=".esc_attr($mb_custom_url_target)." class='portfolio_link custom_link'><i class='portfolio_link-icon flaticon-chain'></i></a>";
                }
                break;
        }

        $out .= '<article class="wgl_portfolio_list-item item '.esc_attr($class).'" '.$style_gap.'>';
        $out .= '<div class="wgl_portfolio_item-wrapper'.esc_attr($wrapper_class).'">';   
        $out .= $image_anim == 'offset' ? '<div class="wgl_portfolio_item-offset">' : '';   
        $out .= '<div class="wgl_portfolio_item-image">';
        $out .= self::getImgUrl($params, $wp_get_attachment_url, $crop, $count, $grid_gap);

        if($info_position == 'under_image'){
            //Overlay settings in css
            $out .= '<div class="overlay"></div>';

            //Links
            $out .= $link;            
        }
        $out .= '</div>';   

        $out .= '<div class="wgl_portfolio_item-description">';                  
        
        if((bool)$post_meta){
            $out .= '<div class="wgl_portfolio_item-meta">' . $post_meta . '</div>';
        }

        if((bool)$show_portfolio_title){
            $out .= '<div class="wgl_portfolio_item-title">';
            $tag = 'h4';
            $tag_title = (bool)$single_link_title ? 'a' : 'span';
            $tag_attr = (bool)$single_link_title ? 'href="'.get_permalink().'"' : '';
            $out .= sprintf('<%s class="title"><%s %s>'.get_the_title().'</%s></%s>', 
                $tag,
                $tag_title, 
                $tag_attr, 
                $tag_title, 
                $tag
            );                  
            $out .= '</div>';                                  
        }
    
        if((bool)$show_content){
            $out .= $this->post_content($params);
        }
        
        
        $out .= '</div>'; 
        // Links
        $out .= ($info_position != 'under_image' && $image_anim != 'sub_layer') ? $link : ''; 
        
        if($info_position != 'under_image' && $image_anim != 'sub_layer'){
            // Overlay settings in css
            $out .= '<div class="overlay"></div>';
        }

        $out .= ($image_anim == 'sub_layer') ? $link : ''; 
        
        $out .= $image_anim == 'offset' ? '</div>' : ''; 

        $out .= '</div>';

        $out .= '</article>';
        return $out;
    } 

    private function single_post_date(){ 

        if (rwmb_meta('mb_portfolio_single_meta_date') == 'default') {
            $date = Integrio_Theme_Helper::get_option('portfolio_single_meta_date');
        } else {
            $date = rwmb_meta('mb_portfolio_single_meta_date');
        }

        if($date == "1" || $date == "yes"){
           return '<span>' . esc_html(get_the_time(get_option( 'date_format' ))) . '</span>'; 
        }       
    }      

    private function single_post_likes(){
        $show_likes = Integrio_Theme_Helper::get_option('portfolio_single_meta_likes');   
        if ( function_exists('wgl_simple_likes') && (bool) $show_likes) {
            return wgl_simple_likes()->likes_button( get_the_ID(), 0 );
        }      
    }    

    private function single_post_author(){
        $author = Integrio_Theme_Helper::get_option('portfolio_single_meta_author');   
        if( !empty($author) ) {
           return '<span>' . esc_html__("by", "wgl_core") . ' <a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author_meta('display_name')) . '</a></span>';
        }       
    }       

    private function single_post_comments(){
        $comments = Integrio_Theme_Helper::get_option('portfolio_single_meta_comments');  

        $post_comments = '';
        if ( !empty($comments) ) {
            $comments_num = '' . get_comments_number(get_the_ID()) . '';
            $comments_text = '' . $comments_num == 1 ? esc_html__('comment', 'wgl_core') : esc_html__('comments', 'wgl_core') . '';
            return $post_comments = '<span><a href="' . esc_url(get_comments_link()) . '">' . esc_html(get_comments_number(get_the_ID())) . ' ' . $comments_text . '</a></span>';   
        } 
    }    

    private function single_post_cats(){
        
        if (rwmb_meta('mb_portfolio_single_meta_categories') == 'default') {
            $cat = Integrio_Theme_Helper::get_option('portfolio_single_meta_categories');
        } else {
            $cat = rwmb_meta('mb_portfolio_single_meta_categories');
        }

        if($cat == "1" || $cat == "yes"){
            $post_cats = wp_get_post_terms(get_the_id(), 'portfolio-category');
            $post_cats_str = '';
            $post_cats_class = '';
            $post_cats_links = '<span class="wgl_portfolio_item-cats">';
            for ($i=0; $i<count( $post_cats ); $i++) {
                $post_cat_term = $post_cats[$i];
                $post_cat_name = $post_cat_term->name;
                $post_cats_str .= ' '.$post_cat_name;
                $post_cats_class .= ' '.$post_cat_term->slug;
                $post_cats_link = get_category_link( $post_cat_term->term_id );
                $post_cats_links .= '<a href='.esc_html($post_cats_link).' class="portfolio-category">'.esc_html($post_cat_name).'</a>';
            }
            $post_cats_links .= '</span>';
            return $post_cats_links;              
        }
    }

    private function single_portfolio_info(){
        $portfolio_info = '';
        
        $mb_info = rwmb_meta('mb_portfolio_info_items');
        if (isset($mb_info) && !empty($mb_info)) {
            for ( $i=0; $i<count( $mb_info ); $i++ ){
                $info = $mb_info[$i];
                $info_name = !empty($info['name']) ? $info['name'] : '';
                $info_description = !empty($info['description']) ? $info['description'] : '';
                $info_link = !empty($info['link']) ? $info['link'] : '';

                if (!empty($info_name) &&!empty($info_description)) {
                    $portfolio_info .= '<div class="portfolio_info_item-info_desc">';
                        $portfolio_info .= '<h5>'.$info_name.'</h5>';
                        $portfolio_info .= !empty($info_link) ? '<a href="'.esc_url($info_link).'">' : '';
                            $portfolio_info .= '<span>'.$info_description.'</span>';
                        $portfolio_info .= !empty($info_link) ? '</a>' : '';
                    $portfolio_info .= '</div>';
                }
            }
        }
        return $portfolio_info; 
    }

    public function wgl_portfolio_single_fw(){
        $output = '';
        $p_id = get_the_ID();
        $mb_featured_img = $mb_meta_info = $mb_title = true;
        if (class_exists( 'RWMB_Loader' )) {
            $mb_featured_img = rwmb_meta('mb_portfolio_featured_img');
            $mb_title = rwmb_meta('mb_portfolio_title');
            $mb_meta_info = Integrio_Theme_Helper::get_option('portfolio_single_meta');
        }

        $single_post_type = Integrio_Theme_Helper::options_compare('portfolio_single_type_layout','mb_portfolio_post_conditional','custom');
        $single_post_align = Integrio_Theme_Helper::options_compare('portfolio_single_align','mb_portfolio_post_conditional','custom');
        $portfolio_single_padding = Integrio_Theme_Helper::options_compare('portfolio_single_padding','mb_portfolio_post_conditional','custom');

        $portfolio_parallax = Integrio_Theme_Helper::options_compare('portfolio_parallax', 'mb_portfolio_post_conditional', 'custom');
        $portfolio_parallax_speed = Integrio_Theme_Helper::options_compare('portfolio_parallax_speed', 'mb_portfolio_post_conditional', 'custom');

        // Post meta
        $post_comments = $this->single_post_comments();
        $post_cats_links = $this->single_post_cats();
        $post_date = $this->single_post_date();
        $post_author = $this->single_post_author();
        $portfolio_info = $this->single_portfolio_info();

        $post_meta = $post_date . $post_author . $post_comments;


        if ((bool)$portfolio_parallax) {
            wp_enqueue_script('paroller', get_template_directory_uri() . '/js/jquery.paroller.min.js', array(), false, false);
        }

        $portfolio_parallax_class = (bool)$portfolio_parallax ? ' portfolio_parallax' : '';
        $portfolio_parallax_data_speed = !empty($portfolio_parallax_speed) ? $portfolio_parallax_speed : '0.3';
        $portfolio_parallax_data = (!empty($portfolio_parallax_data_speed) && (bool)$portfolio_parallax) ? 'data-paroller-factor='.$portfolio_parallax_data_speed : '';

        $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id($p_id), 'full');

        $paddings = !empty($portfolio_single_padding) ? 'padding-top: '.(int)$portfolio_single_padding['padding-top'].'px; padding-bottom: '.(int)$portfolio_single_padding['padding-bottom'].'px; ' : '';
        $bg_image = (!empty($wp_get_attachment_url) && (bool)$mb_featured_img) ? 'background-image: url('.$wp_get_attachment_url.')' : '';
        $bg_styles = !empty($bg_image) ? 'style="'.$bg_image.'"' : '';
        $wrapper_styles = !empty($paddings) ? 'style="'.$paddings.'"' : '';

        $output .= '<div class="wgl_portfolio_item-bg a'.esc_attr($single_post_align).$portfolio_parallax_class.'" '.$bg_styles.' '.$portfolio_parallax_data.'>';
            $output .= '<div class="wgl-container wgl_portfolio_item-title_wrap" '.$wrapper_styles.'>';
                $output .= $post_cats_links;
                $output .= !empty($mb_title) ? '<h1 class="wgl_portfolio_item-title">'.get_the_title().'</h1>' : '';
                if (!empty($post_meta) && !(bool)$mb_meta_info) {
                    $output .= '<div class="wgl_portfolio_item-meta">' . $post_meta . '</div>';
                }
            $output .= '</div>';
            $output .= ($single_post_type == '4' && !empty($portfolio_info)) ? '<div class="wgl-container wgl_portfolio_item-info">'.$portfolio_info.'</div>' : '';
        $output .= '</div>';
        
        return $output;
    }

    public function wgl_portfolio_single_item($parameters, $item_class = ''){
        $out = $post_type4 = '';

        // MetaBoxes
        $p_id = get_the_ID();
        $mb_featured_img = $mb_meta_info = $mb_title = true;
        $mb_cats_under = $mb_soc_under = '';
        if (class_exists( 'RWMB_Loader' )) {
            $mb_featured_img = rwmb_meta('mb_portfolio_featured_img');
            $mb_title = rwmb_meta('mb_portfolio_title');
            $mb_info = rwmb_meta('mb_portfolio_info_items');
            $mb_editor = rwmb_meta('mb_portfolio_editor');
            $mb_download = rwmb_meta('mb_portfolio_download');
            $mb_download_text = rwmb_meta('mb_portfolio_download_text');
            $mb_download_link = rwmb_meta('mb_portfolio_download_link');

            $mb_meta_info = Integrio_Theme_Helper::get_option('portfolio_single_meta');
            
            if (rwmb_meta('mb_portfolio_above_content_cats') == 'default') {
                $mb_cats_under = Integrio_Theme_Helper::get_option('portfolio_above_content_cats');
            } else {
                $mb_cats_under = rwmb_meta('mb_portfolio_above_content_cats');
            }
            if (rwmb_meta('mb_portfolio_above_content_share') == 'default') {
                $mb_soc_under = Integrio_Theme_Helper::get_option('portfolio_above_content_share');
            } else {
                $mb_soc_under = rwmb_meta('mb_portfolio_above_content_share');
            }
        }
        
        $single_post_type = Integrio_Theme_Helper::options_compare('portfolio_single_type_layout','mb_portfolio_post_conditional','custom');
        $single_post_align = Integrio_Theme_Helper::options_compare('portfolio_single_align','mb_portfolio_post_conditional','custom');

        // Post meta
        $post_comments = $this->single_post_comments();
        $post_cats_links = $this->single_post_cats();
        $post_date = $this->single_post_date();
        $post_author = $this->single_post_author();
        $post_likes = $this->single_post_likes();
        $portfolio_info = $this->single_portfolio_info();

        // Post meta
        $post_meta = $post_date . $post_author . $post_comments;    
        // set post options
        
        $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id($p_id), 'full');

        $single = Integrio_SinglePost::getInstance();

        ob_start();
        if ($mb_soc_under == 1 || $mb_soc_under == 'yes') {
            echo '<div class="single_info-share_social-wpapper">';
                echo '<span class="share_title">'.esc_html__('Share:','integrio-core').'</span>';
                if ( function_exists('wgl_theme_helper') ) {
					echo wgl_theme_helper()->render_post_share($mb_soc_under);
				}
            echo '</div>';
        }
        $social_share = ob_get_clean();

        // portfolio download
        ob_start();
        if ((bool)$mb_download) {
            echo '<div class="portfolio_info_item-download">';
                echo '<div class="integrio_module_button wgl_button wgl_button-m acenter wgl_button-full"><a class="wgl_button_link" href="'.esc_url($mb_download_link).'">'.esc_html($mb_download_text).'</a></div>';
            echo '</div>';
        }
        $portfolio_download = ob_get_clean();

        // portfolio featured image
        ob_start();
        if(!empty($mb_featured_img)){
            echo '<div class="wgl_portfolio_item-image">';
                echo WglPortfolio::getImgUrl($parameters, $wp_get_attachment_url, false, false, false);
            echo '</div>';                    
        }
        $portfolio_featured_image = ob_get_clean();

        // portfolio title
        ob_start();
        if ( !empty($mb_title) ) {
            $tag = 'h1';
            echo sprintf('<%s class="wgl_portfolio_item-title">'.get_the_title().'</%s>', 
                $tag, 
                $tag);
        }
        $portfolio_title = ob_get_clean();

        // portfolio meta
        ob_start();
        if(!empty($post_meta) && !(bool)$mb_meta_info){
            echo '<div class="wgl_portfolio_item-meta">' . $post_meta . '</div>';
        }
        $portfolio_meta = ob_get_clean();

        // portfolio article
        $out .= '<article class="wgl_portfolio_single-item">';
            $out .= '<div class="wgl_portfolio_item-wrapper">';

            switch ($single_post_type) {
                case '1':
                    $out .= '<div class="wgl_portfolio_item-title_wrap a'.$single_post_align.'">';
                        $out .= !(bool)$mb_meta_info ? $post_cats_links : '';
                        $out .= $portfolio_title;
                        $out .= $portfolio_meta;
                    $out .= '</div>';
                    $out .= $portfolio_featured_image; 
                    break;
                case '2':
                    $out .= $portfolio_featured_image; 
                    $out .= '<div class="wgl_portfolio_item-title_wrap a'.$single_post_align.'">';
                        $out .= !(bool)$mb_meta_info ? $post_cats_links : '';
                        $out .= $portfolio_title;
                        $out .= $portfolio_meta;
                    $out .= '</div>';
                    break;
                case '4':
                    if (!empty($mb_editor)) {
                        if (!empty($mb_editor)) {
                            $out .= '<div class="wgl_portfolio_info-desc">'.$mb_editor.'</div>';
                        }
                    }
                    $post_type4 = true;
                default:
                    break;
            }

            if ((!empty($mb_editor) || !empty($portfolio_info)) && !(bool)$post_type4) {
                $out .= '<div class="wgl_portfolio_info-wrap">';
                    if (!empty($mb_editor)) {
                        $out .= '<div class="wgl_portfolio_info-desc wgl_col-8">'.$mb_editor.'</div>';
                    }
                    if(!empty($portfolio_info)){
                        $tag = 'div';
                        $out .= sprintf('<div class="wgl_portfolio_item-annotation-wrap wgl_col-4"><div class="wgl_portfolio_item-annotation">%1$s%2$s</div></div>', $portfolio_info, $social_share);     
                    }
                $out .= '</div>';
            }
           
            $content =  apply_filters('the_content', get_post_field('post_content', get_the_id()));

            if(!empty($content)){
                $out .= '<div class="wgl_portfolio_item-content">';              
                $tag = 'div';              
                $out .= sprintf('<%s class="content"><div class="wrapper">%s</div></%s>', 
                    $tag, 
                    $content, 
                    $tag
                );                 
                $out .= '</div>';                  
            }
            ob_start();
            if($mb_cats_under == "1" || $mb_cats_under == "yes"){
                $this->getTags('<div class="tagcloud">', ' ', '</div>');
            }
            $post_tags = ob_get_clean();
            
            if(!empty($post_tags) || !empty($post_likes)){
                $tag = 'div';
                $out .= sprintf('<%1$s class="post_info single_post_info post_info-portfolio"><div class="tags_likes_wrap">%2$s%3$s</div></%1$s>', 
                        $tag, 
                        $post_tags,
                        $post_likes
                    );                
            }

            $out .= $single_post_type == '4' ? $social_share : '';  
            $out .= '</div>';  
        $out .= '</article>';
        
        return $out;
    }

    static public function getImgUrl ($params, $wp_get_attachment_url, $crop = false, $count = '0', $grid_gap) {
        $masonry_gap = '';

        if (strlen($wp_get_attachment_url)) {
            if ($params['portfolio_layout'] == 'masonry2') {
                switch ($count) {
                    case "2":
                        $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "350", "740", $crop, true, true);
                        $masonry_gap = 'style="margin-top: -'.(33-(int)$grid_gap).'px;"';
                        break;
                    default:
                        $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "740", "740", $crop, true, true);
                }
            }elseif ($params['portfolio_layout'] == 'masonry3') {
                switch ($count) {
                    case "2":
                        $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "740", "350", $crop, true, true);
                        break;
                    default:
                        $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "740", "740", $crop, true, true);
                }
            }elseif ($params['portfolio_layout'] == 'masonry4') {
                switch ($count) {
                    case 3:
                    case 4:
                        $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "1140", "570", $crop, true, true);
                        $masonry_gap = 'style="margin-top: -'.((int)$grid_gap/2).'px;"';
                        break;
                    default:
                        $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "1140", "1140", $crop, true, true);
                }
            } elseif ($params['portfolio_layout'] == 'carousel') {
                $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "970", "600", $crop, true, true);
            }else{
                switch ($params['posts_per_row']) {
                    case "1": $wgl_featured_image_url = $wp_get_attachment_url; break;
                    case "2": $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "1170", "1170", $crop, true, true); break;
                    case "3": $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "740", "740", $crop, true, true); break;
                    case "4": $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "570", "570", $crop, true, true); break;
                    default: $wgl_featured_image_url = aq_resize($wp_get_attachment_url, "1170", "1170", $crop, true, true); break;
                }
            }
            if (!(bool)$wgl_featured_image_url) {
                $wgl_featured_image_url = $wp_get_attachment_url;
            }
            
            $featured_image = '<img  src="' . $wgl_featured_image_url . '" '.$masonry_gap.' alt="" />';
        } else {
            $featured_image = '';
        }
        return $featured_image;

    }

    public function getTags($before = null, $sep = ', ', $after = ''){
       if ( null === $before )
        $before = __('Tags: ', 'integrio-core');

        $the_tags = $this->get_the_tag_list( $before, $sep, $after );

        if ( !is_wp_error($the_tags) ) { echo $the_tags; } 
    }
    private function get_the_tag_list( $before = '', $sep = '', $after = '', $id = 0 ) {

        /**
         * Filters the tags list for a given post.
         */
        global $post;

        return apply_filters( 'the_tags', get_the_term_list( $post->ID, 'portfolio_tag', $before, $sep, $after ), $before, $sep, $after, $post->ID );
    }

    public function getCategories($params, $query){
        $data_category = isset($params['tax_query']) ? $params['tax_query'] : array();
        $include = array();
        $exclude = array();
        if (!is_tax()) {
            if (!empty($data_category) && isset($data_category[0]) && $data_category[0]['operator'] === 'IN') {
                foreach ($data_category[0]['terms'] as $key => $value) {
                    $idObj = get_term_by('slug', $value, 'portfolio-category'); 
                    $id_list[] = $idObj->term_id;
                }
                $include = implode(",", $id_list);
            } elseif (!empty($data_category) && isset($data_category[0]) && $data_category[0]['operator'] === 'NOT IN') {
                foreach ($data_category[0]['terms'] as $key => $value) {
                    $idObj = get_term_by('slug', $value, 'portfolio-category'); 
                    $id_list[] = $idObj->term_id;
                }
                $exclude = implode(",", $id_list);
            }    
        }

        $cats = get_terms(array(
                'taxonomy' => 'portfolio-category',
                'include' => $include,
                'exclude' => $exclude,
                'hide_empty' => true
            ));
        $out = '<a href="#" data-filter=".item" class="active">'.esc_html__('All','integrio-core').'<span class="number_filter"></span></a>';
        foreach ($cats as $cat) {
            if($cat->count > 0){
                $out .= '<a href="'.get_term_link($cat->term_id, 'portfolio-category').'" data-filter=".'.$cat->slug.'">';
                $out .= $cat->name;
                $out .= '<span class="number_filter"></span>';
                $out .= '</a>';
            }   
        }
        return $out;
    }

    public function loadMore ($params , $name_load_more) {

        $out = '';
        if (!empty($name_load_more)) {
            $uniq = uniqid();
            $ajax_data_str = htmlspecialchars( json_encode( $params ), ENT_QUOTES, 'UTF-8' );

			$out .= '<div class="clear"></div>';
			$out .= '<div class="load_more_wrapper">';
			$out .= '<div class="button_wrapper">';
				$out .= '<a href="#" class="load_more_item"><span>'.$name_load_more.'</span></a>';
			$out .= '</div>';
            $out .= '<form class="posts_grid_ajax">';
                $out .= "<input type='hidden' class='ajax_data' name='{$uniq}_ajax_data' value='$ajax_data_str' />";
            $out .= '</form>';
            $out .= '</div>';
        }

        return $out;
    }    

    public function infinite_more ($params ) {

        $out = '';
        wp_enqueue_script( 'waypoints' );
        $out .= '<div class="clear"></div>
        <div class="text-center load_more_wrapper">
            <div class="infinity_item">
                <span class="wgl-ellipsis">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </div>
        ';

        $uniq = uniqid();
        $ajax_data_str = htmlspecialchars( json_encode( $params ), ENT_QUOTES, 'UTF-8' );
        $out .= "<form class='posts_grid_ajax'>";
        $out .= "<input type='hidden' class='ajax_data' name='{$uniq}_ajax_data' value='$ajax_data_str' />";
        $out .= "</form>";
        
        $out .= "</div>";

        return $out;
    }

}