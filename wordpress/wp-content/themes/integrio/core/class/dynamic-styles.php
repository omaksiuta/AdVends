<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Integrio Dynamic Styles
*
*
* @class        Integrio_dynamic_styles
* @version      1.0
* @category     Class
* @author       WebGeniusLab
*/

class Integrio_dynamic_styles{

	public $settings;
	protected static $instance = null;
	private $gtdu;
	private $use_minify;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}  

	public function register_script(){
		$this->gtdu = get_template_directory_uri();
		$this->use_minify = Integrio_Theme_Helper::get_option('use_minify') ? '.min' : '';
		// Register action
		add_action('wp_enqueue_scripts', array($this,'css_reg') );
		add_action('wp_enqueue_scripts', array($this,'js_reg') );
		// Register action for Admin
		add_action('admin_enqueue_scripts', array($this,'admin_css_reg') );
		add_action('admin_enqueue_scripts', array($this, 'admin_js_reg') );
	}

	/* Register CSS */
	public function css_reg(){
	    /* Register CSS */
	    wp_enqueue_style('integrio-default-style', get_bloginfo('stylesheet_url'));
	    // Flaticon register
	    wp_enqueue_style('flaticon', $this->gtdu . '/fonts/flaticon/flaticon.css');
	    // Font-Awesome
		wp_enqueue_style('font-awesome', $this->gtdu . '/css/font-awesome.min.css');
		wp_enqueue_style('integrio-main', $this->gtdu . '/css/main'.$this->use_minify.'.css');
		wp_enqueue_style('swipebox', get_template_directory_uri() . '/js/swipebox/css/swipebox.min.css');
	}
	/* Register JS */
	public function js_reg(){

		wp_enqueue_script('integrio-theme-addons', $this->gtdu . '/js/theme-addons'.$this->use_minify.'.js', array('jquery'), false, true);
		wp_enqueue_script('integrio-theme', $this->gtdu . '/js/theme.js', array('jquery'), false, true);

	    wp_localize_script( 'integrio-theme', 'wgl_core', array(
	        'ajaxurl' => admin_url( 'admin-ajax.php' ),
	        'slickSlider' => esc_url(get_template_directory_uri() . '/js/slick.min.js'),
	        'JarallaxPlugin' => esc_url(get_template_directory_uri() . '/js/jarallax-video.min.js'),
	        'JarallaxPluginVideo' => esc_url(get_template_directory_uri() . '/js/jarallax.min.js'),
	        'like' => esc_html__( 'Like', 'integrio' ),
	        'unlike' => esc_html__( 'Unlike', 'integrio' )
	        ) );

	   	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/swipebox/js/jquery.swipebox.min.js', array(), false, false);
	}

	/* Register css for admin panel */
	public function admin_css_reg(){
	 	// Font-awesome
		wp_enqueue_style('font-awesome', $this->gtdu . '/css/font-awesome.min.css');
		// Main admin styles
		wp_enqueue_style('integrio-admin', $this->gtdu . '/core/admin/css/admin.css');
		// Add standard wp color picker
		wp_enqueue_style('wp-color-picker');
		// Colorbox https://gist.github.com/tmcw/6793969
	    wp_enqueue_style('colorbox', $this->gtdu . '/core/admin/css/colorbox.css');
	    // https://github.com/marcj/jquery-selectBox
		wp_enqueue_style('selectBox', $this->gtdu . '/core/admin/css/jquery.selectBox.css');
		wp_enqueue_style('integrio-vc-backend-style', $this->gtdu . '/core/admin/css/wgl-vc-backend.css');
	}

	/* Register css and js for admin panel */
	public function admin_js_reg(){
	    /* Register JS */
	    wp_enqueue_media();
	    wp_enqueue_script('wp-color-picker');
	    // Colorbox https://gist.github.com/tmcw/6793969
	    wp_enqueue_script('colorbox', $this->gtdu . '/core/admin/js/jquery.colorbox-min.js', array(), false, true);
	    // Select-box https://github.com/marcj/jquery-selectBox
		wp_enqueue_script('selectBox', $this->gtdu . '/core/admin/js/jquery.selectBox.js');		
		//Admin Js
		wp_enqueue_script('admin', $this->gtdu . '/core/admin/js/admin.js');
		// If active Metabox IO
		if (class_exists( 'RWMB_Loader' )) {
			wp_enqueue_script('metaboxes', $this->gtdu . '/core/admin/js/metaboxes.js');
		} 
		
		wp_localize_script( 'admin', 'wgl_verify', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'ajax_nonce'   => esc_js( wp_create_nonce( '_notice_nonce' ) )
		) );
	}

	public function init_style() {
		add_action('wp_enqueue_scripts', array($this, 'add_style') );
	}

	public function minify_css($css = null){
		if (!$css) { return; }
		$css = str_replace( ',{', '{', $css );
		$css = str_replace( ', ', ',', $css );
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		$css = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css );
		$css = trim( $css );

		return $css;
	}
	
	public function add_style() {
		$css = '';
		/*-----------------------------------------------------------------------------------*/
		/* Body Style
		/*-----------------------------------------------------------------------------------*/
		$page_colors_switch = Integrio_Theme_Helper::options_compare('page_colors_switch','mb_page_colors_switch','custom');
		$use_gradient_switch = Integrio_Theme_Helper::options_compare('use-gradient','mb_page_colors_switch','custom');
		if ($page_colors_switch == 'custom') {
			$theme_color = Integrio_Theme_Helper::options_compare('page_theme_color','mb_page_colors_switch','custom');
			$bg_body = Integrio_Theme_Helper::options_compare('body_background_color','mb_page_colors_switch','custom');
			// Go top color
			$scroll_up_bg_color = Integrio_Theme_Helper::options_compare('scroll_up_bg_color','mb_page_colors_switch','custom');
			$scroll_up_arrow_color = Integrio_Theme_Helper::options_compare('scroll_up_arrow_color','mb_page_colors_switch','custom');
			// Gradient colors
			$theme_gradient_from = Integrio_Theme_Helper::options_compare('theme-gradient-from','mb_page_colors_switch','custom');
			$theme_gradient_to = Integrio_Theme_Helper::options_compare('theme-gradient-to','mb_page_colors_switch','custom');
		} else {
			$theme_color = esc_attr(Integrio_Theme_Helper::get_option('theme-custom-color'));
			$bg_body = esc_attr(Integrio_Theme_Helper::get_option('body-background-color'));
			// Go top color
			$scroll_up_bg_color = Integrio_Theme_Helper::get_option('scroll_up_bg_color');
			$scroll_up_arrow_color = Integrio_Theme_Helper::get_option('scroll_up_arrow_color');
			// Gradient colors
			$theme_gradient = Integrio_Theme_Helper::get_option('theme-gradient');
			$second_gradient = Integrio_Theme_Helper::get_option('second-gradient');
			$theme_gradient_from = $theme_gradient['from'];
			$theme_gradient_to = $theme_gradient['to'];
		}

		/*-----------------------------------------------------------------------------------*/
		/* \End Body style
		/*-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/* Body Add Class
		/*-----------------------------------------------------------------------------------*/
		if ((bool)$use_gradient_switch) {
			add_filter( 'body_class', function( $classes ) {
				return array_merge( $classes, array( 'theme-gradient' ) );
			} );
			$gradient_class = '.theme-gradient';
		} else {
			$gradient_class = '';
		}
		/*-----------------------------------------------------------------------------------*/
		/* End Body Add Class
		/*-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/* Header Typography
		/*-----------------------------------------------------------------------------------*/
		$header_font = Integrio_Theme_Helper::get_option('header-font');

		$header_font_family = $header_font_weight = $header_font_color = '';
		if (!empty($header_font)) {
			$header_font_family = esc_attr($header_font['font-family']);
			$header_font_weight = esc_attr($header_font['font-weight']);
			$header_font_color = esc_attr($header_font['color']);
		}		

		// Add Heading h1,h2,h3,h4,h5,h6 variables
		for ($i = 1; $i <= 6; $i++) {
		    ${'header-h'.$i} = Integrio_Theme_Helper::get_option('header-h'.$i);
			${'header-h'.$i.'_family'} = ${'header-h'.$i.'_weight'} = ${'header-h'.$i.'_line_height'} = ${'header-h'.$i.'_size'} = ${'header-h'.$i.'_text_transform'} = '';
			
			if (!empty(${'header-h'.$i})) {
				${'header-h'.$i.'_family'} = !empty(${'header-h'.$i}["font-family"]) ? esc_attr(${'header-h'.$i}["font-family"]) : '';
				${'header-h'.$i.'_weight'} = !empty(${'header-h'.$i}["font-weight"]) ? esc_attr(${'header-h'.$i}["font-weight"]) : '';
				${'header-h'.$i.'_line_height'} = !empty(${'header-h'.$i}["line-height"]) ? esc_attr(${'header-h'.$i}["line-height"]) : '';
				${'header-h'.$i.'_size'} = !empty(${'header-h'.$i}["font-size"]) ? esc_attr(${'header-h'.$i}["font-size"]) : '';
				${'header-h'.$i.'_text_transform'} = !empty(${'header-h'.$i}["text-transform"]) ? esc_attr(${'header-h'.$i}["text-transform"]) : '';
			}
		}

		/*-----------------------------------------------------------------------------------*/
		/* \End Header Typography
		/*-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/* Body Typography
		/*-----------------------------------------------------------------------------------*/
		$main_font = Integrio_Theme_Helper::get_option('main-font');
		$content_font_family = $content_line_height = $content_font_size = $content_font_weight = $content_color = '';
		if (!empty($main_font)) {
			$content_font_family = esc_attr($main_font['font-family']);
			$content_font_size = esc_attr($main_font['font-size']);
			$content_font_weight = esc_attr($main_font['font-weight']);
			$content_color = esc_attr($main_font['color']);
			$content_line_height = esc_attr($main_font['line-height']);
			$content_line_height = !empty($content_line_height) ? round(((int)$content_line_height / (int)$content_font_size), 3) : '';
		}

		/*-----------------------------------------------------------------------------------*/
		/* \End Body Typography
		/*-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/* Menu, Sub-menu Typography
		/*-----------------------------------------------------------------------------------*/
		$menu_font = Integrio_Theme_Helper::get_option('menu-font');
		$menu_font_family = $menu_font_weight = $menu_font_line_height = $menu_font_size = '';
		if (!empty($menu_font)) {
			$menu_font_family = !empty($menu_font['font-family']) ? esc_attr($menu_font['font-family']) : '';
			$menu_font_weight = !empty($menu_font['font-weight']) ? esc_attr($menu_font['font-weight']) : '';
			$menu_font_line_height = !empty($menu_font['line-height']) ? esc_attr($menu_font['line-height']) : '';
			$menu_font_size = !empty($menu_font['font-size']) ? esc_attr($menu_font['font-size']) : '';
		}

		$sub_menu_font = Integrio_Theme_Helper::get_option('sub-menu-font');
		$sub_menu_font_family = $sub_menu_font_weight = $sub_menu_font_line_height = $sub_menu_font_size = '';
		if (!empty($sub_menu_font)) {
			$sub_menu_font_family = !empty($sub_menu_font['font-family']) ? esc_attr($sub_menu_font['font-family']) : '';
			$sub_menu_font_weight = !empty($sub_menu_font['font-weight']) ? esc_attr($sub_menu_font['font-weight']) : '';
			$sub_menu_font_line_height = !empty($sub_menu_font['line-height']) ? esc_attr($sub_menu_font['line-height']) : '';
			$sub_menu_font_size = !empty($sub_menu_font['font-size']) ? esc_attr($sub_menu_font['font-size']) : '';
		}
		/*-----------------------------------------------------------------------------------*/
		/* \End Menu, Sub-menu Typography
		/*-----------------------------------------------------------------------------------*/
		
		$name_preset = Integrio_Theme_Helper::header_preset_name();
		$get_def_name = get_option( 'integrio_set_preset' );
		$def_preset = false;
		if(isset($get_def_name['default']) && $name_preset){
			if(array_key_exists($name_preset, $get_def_name['default']) && !array_key_exists($name_preset, $get_def_name)){
				$def_preset = true;
			}
		}

		$menu_color_top = Integrio_Theme_Helper::get_option('header_top_color', $name_preset, $def_preset);
		if (!empty($menu_color_top['rgba'])) {
	        $menu_color_top = !empty($menu_color_top['rgba']) ? esc_attr($menu_color_top['rgba']) : '';
	    }

		$menu_color_middle = Integrio_Theme_Helper::get_option('header_middle_color', $name_preset, $def_preset);
		if(!empty($menu_color_middle['rgba'])){
			$menu_color_middle = !empty($menu_color_middle['rgba']) ? esc_attr($menu_color_middle['rgba']) : '';
		}

		$menu_color_bottom = Integrio_Theme_Helper::get_option('header_bottom_color', $name_preset, $def_preset);
		if(!empty($menu_color_bottom['rgba'])){
			$menu_color_bottom = !empty($menu_color_bottom['rgba']) ? esc_attr($menu_color_bottom['rgba']) : '';
		}

		// Set Queries width to apply mobile style
	    $sub_menu_color = Integrio_Theme_Helper::get_option('sub_menu_color' ,$name_preset, $def_preset);
	    $sub_menu_bg = Integrio_Theme_Helper::get_option('sub_menu_background' ,$name_preset, $def_preset);
	    $sub_menu_bg = $sub_menu_bg['rgba'];


		$mobile_sub_menu_bg = Integrio_Theme_Helper::get_option('mobile_sub_menu_background');
		$mobile_sub_menu_bg = $mobile_sub_menu_bg['rgba'];
		$mobile_sub_menu_color = Integrio_Theme_Helper::get_option('mobile_sub_menu_color');

		$hex_header_font_color = Integrio_Theme_Helper::HexToRGB($header_font_color);
		$hex_theme_color = Integrio_Theme_Helper::HexToRGB($theme_color);
		$hex_theme_content =  Integrio_Theme_Helper::HexToRGB($content_color);

		// sticky header logo 
	    $header_sticky_height = Integrio_Theme_Helper::get_option('header_sticky_height');
	    $header_sticky_height = (int)$header_sticky_height['height'].'px';
	    // sticky header color
	    $header_sticky_color = Integrio_Theme_Helper::get_option('header_sticky_color');

	    $footer_text_color = Integrio_Theme_Helper::get_option('footer_text_color');
	    $footer_heading_color = Integrio_Theme_Helper::get_option('footer_heading_color');

	    $copyright_text_color = Integrio_Theme_Helper::options_compare('copyright_text_color','mb_copyright_switch','on');

		// Page Title Background Color
		$page_title_bg_color = Integrio_Theme_Helper::get_option('page_title_bg_color');
		$hex_page_title_bg_color = Integrio_Theme_Helper::HexToRGB($page_title_bg_color);


		/*-----------------------------------------------------------------------------------*/
		/* Shop Dynamic Css
		/*-----------------------------------------------------------------------------------*/

		if(is_single()){
			if(function_exists('is_product') && is_product()){
				$layout_single = Integrio_Theme_Helper::options_compare('shop_single_image_layout', 'mb_product_layout', 'custom');
				if($layout_single === 'with_background'){
					$layout_bg = Integrio_Theme_Helper::get_option('shop_layout_with_background');
					if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
						$mb_layout_shop_switch = rwmb_meta('mb_product_layout');
						if ($mb_layout_shop_switch == 'custom') {
							$layout_bg = array();
							$layout_bg['rgba'] = rwmb_meta('mb_shop_layout_with_background');
						}
					}

					$css .= 'body.shop-single-layout-with_background .page-header, body.shop-single-layout-with_background .wgl-single-wrapper, body.shop-single-layout-with_background .woocommerce-notices-wrapper{
						background: '.esc_attr($layout_bg['rgba']).' !important;
					}';
				}				
			}

		}				

		/*-----------------------------------------------------------------------------------*/
		/* Shop Dynamic Css
		/*-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/* Parse css
		/*-----------------------------------------------------------------------------------*/
		global $wp_filesystem;
		if( empty( $wp_filesystem ) ) {
			require_once( ABSPATH .'/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		$files = array('theme_content', 'theme_color', 'footer');
		if(class_exists( 'WooCommerce' )){
			array_push($files, 'shop');
		}
		foreach ($files as $key => $file) {
			$file = get_template_directory() . '/core/admin/css/dynamic/'.$file.'.css';
			if ( $wp_filesystem->exists($file) ) {
				$file = $wp_filesystem->get_contents( $file );
				preg_match_all('/\s*\\$([A-Za-z1-9_\-]+)(\s*:\s*(.*?);)?\s*/', $file, $vars); 

				$found     = $vars[0];
				$varNames  = $vars[1];
				$count     = count($found);    

				for($i = 0; $i < $count; $i++) {
					$varName  = trim($varNames[$i]);
					$file = preg_replace('/\\$'.$varName.'(\W|\z)/', (isset(${$varName}) ? ${$varName} : "").'\\1', $file);
				}
				
				$line = str_replace($found, '', $file);

				$css .= $line;
			}
		}
		/*-----------------------------------------------------------------------------------*/
		/* \End Parse css
		/*-----------------------------------------------------------------------------------*/
		
		$css .= 'body {'
			.(!empty($bg_body) ? 'background:'.$bg_body.';' : '').'
		}
		ol.commentlist:after {
			'.(!empty($bg_body) ? 'background:'.$bg_body.';' : '').'
		}';
		
		/*-----------------------------------------------------------------------------------*/
		/* Typography render
		/*-----------------------------------------------------------------------------------*/
		for ($i = 1; $i <= 6; $i++) {
			$css .= 'h'.$i.',h'.$i.' a, h'.$i.' span { 
				'.(!empty(${'header-h'.$i.'_family'}) ? 'font-family:'.${'header-h'.$i.'_family'}.';' : '' ).'
				'.(!empty(${'header-h'.$i.'_weight'}) ? 'font-weight:'.${'header-h'.$i.'_weight'}.';' : '' ).'
				'.(!empty(${'header-h'.$i.'_size'}) ? 'font-size:'.${'header-h'.$i.'_size'}.';' : '' ).'
				'.(!empty(${'header-h'.$i.'_line_height'}) ? 'line-height:'.${'header-h'.$i.'_line_height'}.';' : '' ).'
				'.(!empty(${'header-h'.$i.'_text_transform'}) ? 'text-transform:'.${'header-h'.$i.'_text_transform'}.';' : '' ).'
			}';
		}	
		/*-----------------------------------------------------------------------------------*/
		/* \End Typography render
		/*-----------------------------------------------------------------------------------*/	

		/*-----------------------------------------------------------------------------------*/
		/* Mobile Header render
		/*-----------------------------------------------------------------------------------*/    
		$mobile_header = Integrio_Theme_Helper::get_option('mobile_header');

		// Fetch mobile header height to apply it for mobile styles
		$header_mobile_height = Integrio_Theme_Helper::get_option('header_mobile_height');
		$header_mobile_min_height = !empty($header_mobile_height['height']) ? 'calc(100vh - '.esc_attr((int)$header_mobile_height['height']).'px - 30px)' : '';		
		$header_mobile_height = !empty($header_mobile_height['height']) ? 'calc(100vh - '.esc_attr((int)$header_mobile_height['height']).'px)' : '';

		// Set Queries width to apply mobile style
		$header_queries = Integrio_Theme_Helper::get_option('header_mobile_queris', $name_preset, $def_preset);
		$mobile_over_content = Integrio_Theme_Helper::get_option('mobile_over_content');

		if ($mobile_header == '1') {
			$mobile_background = Integrio_Theme_Helper::get_option('mobile_background');
			$mobile_color = Integrio_Theme_Helper::get_option('mobile_color');

			$css .= '@media only screen and (max-width: '.(int)$header_queries.'px){
				.wgl-theme-header{
					background-color: '.esc_attr($mobile_background['rgba']).' !important;
					color: '.esc_attr($mobile_color).' !important;
				}
				.hamburger-inner, .hamburger-inner:before, .hamburger-inner:after{
					background-color:'.esc_attr($mobile_color).';
				}
			}';
		}
		
		$css .= '@media only screen and (max-width: '.(int)$header_queries.'px){
			.wgl-theme-header .wgl-mobile-header{
				display: block;
			}
			.wgl-site-header{
				display:none;
			}
			.wgl-theme-header .mobile-hamburger-toggle{
				display: inline-block;
			}
			.wgl-theme-header .primary-nav{
				display:none;
			}
			header.wgl-theme-header .mobile_nav_wrapper .primary-nav{
				display:block;
			}
			.wgl-theme-header .wgl-sticky-header{
				display: none;
			}
			body.mobile_switch_on .wgl-menu_outer {
				height: '.$header_mobile_height.';
			}
			.mobile_nav_wrapper .primary-nav{
				min-height: '.$header_mobile_min_height.';
			}
			.wgl-social-share_pages{
				display: none;
			}
		}';

		if ($mobile_over_content == '1') {
			$css .= '@media only screen and (max-width: '.(int)$header_queries.'px){	
				.wgl-theme-header{
					position: absolute;
				    z-index: 99;
				    width: 100%;
				    left: 0;
				    top: 0;
				}
			}';	
		}else{
			$css .= '@media only screen and (max-width: '.(int)$header_queries.'px){
				body .wgl-theme-header.header_overlap{
					position: relative;
					z-index: 2;
				}	
			}';			
		}
		/*-----------------------------------------------------------------------------------*/
		/* \End Mobile Header render
		/*-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/* Page Title Responsive
		/*-----------------------------------------------------------------------------------*/   
		$page_title_resp = Integrio_Theme_Helper::get_option('page_title_resp_switch');
		$mb_cond_logic = false; 
		 
		if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
			$mb_cond_logic = rwmb_meta('mb_page_title_switch') == 'on' && rwmb_meta('mb_page_title_resp_switch') == '1' ? '1' : ''; 
			
			if(rwmb_meta('mb_page_title_switch') == 'on'){
				if(rwmb_meta('mb_page_title_resp_switch') == '1'){
					$page_title_resp = '1';
				}
			}
		}

		if ($page_title_resp == '1') {
			
			$page_title_height = Integrio_Theme_Helper::get_option('page_title_resp_height');			
			$page_title_height = $page_title_height['height'];

			$page_title_queries = Integrio_Theme_Helper::options_compare('page_title_resp_resolution', 'mb_page_title_resp_switch', $mb_cond_logic);
			
			$page_title_padding = Integrio_Theme_Helper::options_compare('page_title_resp_padding', 'mb_page_title_resp_switch', $mb_cond_logic);
			
			if($mb_cond_logic == '1'){
				$page_title_height = rwmb_meta('mb_page_title_resp_height');
			}

			$page_title_font = Integrio_Theme_Helper::options_compare('page_title_resp_font', 'mb_page_title_resp_switch', $mb_cond_logic);
			$page_title_breadcrumbs_font = Integrio_Theme_Helper::options_compare('page_title_resp_breadcrumbs_font', 'mb_page_title_resp_switch', $mb_cond_logic);
			$page_title_breadcrumbs_switch = Integrio_Theme_Helper::options_compare('page_title_resp_breadcrumbs_switch', 'mb_page_title_resp_switch', $mb_cond_logic);

			// Title styles
			$page_title_font_color = !empty($page_title_font['color']) ? 'color:'.$page_title_font['color'].' !important;' : '';
			$page_title_font_size = !empty($page_title_font['font-size']) ? 'font-size:'.(int)$page_title_font['font-size'].'px !important;' : '';
			$page_title_font_height = !empty($page_title_font['line-height']) ? 'line-height:'.(int)$page_title_font['line-height'].'px !important;' : '';
			$page_title_additional_style = !(bool)$page_title_breadcrumbs_switch ? 'margin-bottom: 0 !important;' : '';

			$title_style = $page_title_font_color.$page_title_font_size.$page_title_font_height.$page_title_additional_style;

			// Breadcrumbs Styles
			$page_title_breadcrumbs_font_color = !empty($page_title_breadcrumbs_font['color']) ? 'color:'.$page_title_breadcrumbs_font['color'].' !important;' : '';
			$page_title_breadcrumbs_font_size = !empty($page_title_breadcrumbs_font['font-size']) ? 'font-size:'.(int)$page_title_breadcrumbs_font['font-size'].'px !important;' : '';
			$page_title_breadcrumbs_font_height = !empty($page_title_breadcrumbs_font['line-height']) ? 'line-height:'.(int)$page_title_breadcrumbs_font['line-height'].'px !important;' : '';
			
			$page_title_breadcrumbs_display = !(bool)$page_title_breadcrumbs_switch ? 'display: none !important;' : '';

			$breadcrumbs_style = $page_title_breadcrumbs_font_color.$page_title_breadcrumbs_font_size.$page_title_breadcrumbs_font_height.$page_title_breadcrumbs_display;				

			$css .= '@media only screen and (max-width: '.(int)$page_title_queries.'px){
				.page-header{
					'.( isset($page_title_padding['padding-top']) && !empty($page_title_padding['padding-top']) ? 'padding-top:'.(int)$page_title_padding['padding-top'].'px !important;' : '' ).'
					'.( isset($page_title_padding['padding-bottom']) && !empty($page_title_padding['padding-bottom']) ? 'padding-bottom:'.(int)$page_title_padding['padding-bottom'].'px  !important;' : '' ).'
					'.( isset($page_title_height) && !empty($page_title_height) ? 'height:'.(int)$page_title_height.'px !important;' : '' ).'
				}
				.page-header_content .page-header_title{
					'.(isset($title_style) && !empty($title_style) ? $title_style : '').'
				}				

				.page-header_content .page-header_breadcrumbs{
					'.(isset($breadcrumbs_style) && !empty($breadcrumbs_style) ? $breadcrumbs_style : '').'
				}

			}';
		}
		/*-----------------------------------------------------------------------------------*/
		/* \End Page Title Responsive
		/*-----------------------------------------------------------------------------------*/   

		/*-----------------------------------------------------------------------------------*/
		/* Footer page css
		/*-----------------------------------------------------------------------------------*/
		$footer_switch = Integrio_Theme_Helper::get_option('footer_switch');
		if ($footer_switch) {
			$footer_content_type = Integrio_Theme_Helper::get_option('footer_content_type');
			if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
				$mb_footer_switch = rwmb_meta('mb_footer_switch');
				if ($mb_footer_switch == 'on') {
					$footer_content_type = rwmb_meta('mb_footer_content_type');
				}
			}

			if($footer_content_type == 'pages'){
				$footer_page_id = Integrio_Theme_Helper::options_compare('footer_page_select');
				if ( $footer_page_id ) {
					$footer_page_id = intval($footer_page_id);
					$shortcodes_css = get_post_meta( $footer_page_id, '_wpb_shortcodes_custom_css', true );
					if ( ! empty( $shortcodes_css ) ) {
						$shortcodes_css = strip_tags( $shortcodes_css );
						$css .= $shortcodes_css;
					}
				}
			}		
		}
		/*-----------------------------------------------------------------------------------*/
		/* \End Footer page css
		/*-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/* Gradient css
		/*-----------------------------------------------------------------------------------*/

		require_once(get_template_directory() . '/core/admin/css/dynamic/gradient.php');

		/*-----------------------------------------------------------------------------------*/
		/* \End Gradient css
		/*-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/* Add Inline css
		/*-----------------------------------------------------------------------------------*/

		$css = $this->minify_css($css);
		wp_add_inline_style( 'integrio-main', $css );

		/*-----------------------------------------------------------------------------------*/
		/* \End Add Inline css
		/*-----------------------------------------------------------------------------------*/
	}
}

if(!function_exists('integrio_dynamic_styles')){
    function integrio_dynamic_styles() {
        return Integrio_dynamic_styles::instance();
    }
}

integrio_dynamic_styles()->register_script();
integrio_dynamic_styles()->init_style();



