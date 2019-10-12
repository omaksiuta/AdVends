<?php
/* Woocommerce support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('sweet_dessert_woocommerce_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_woocommerce_theme_setup', 1 );
	function sweet_dessert_woocommerce_theme_setup() {

		if (sweet_dessert_exists_woocommerce()) {
			
			add_theme_support( 'woocommerce' );
			// Next setting from the WooCommerce 3.0+ enable built-in image zoom on the single product page
			add_theme_support( 'wc-product-gallery-zoom' );
			// Next setting from the WooCommerce 3.0+ enable built-in image slider on the single product page
			add_theme_support( 'wc-product-gallery-slider' );
			// Next setting from the WooCommerce 3.0+ enable built-in image lightbox on the single product page
			add_theme_support( 'wc-product-gallery-lightbox' );
			
			add_action('sweet_dessert_action_add_styles', 				'sweet_dessert_woocommerce_frontend_scripts' );

			// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
			add_filter('sweet_dessert_filter_get_blog_type',				'sweet_dessert_woocommerce_get_blog_type', 9, 2);
			add_filter('sweet_dessert_filter_get_blog_title',			'sweet_dessert_woocommerce_get_blog_title', 9, 2);
			add_filter('sweet_dessert_filter_get_current_taxonomy',		'sweet_dessert_woocommerce_get_current_taxonomy', 9, 2);
			add_filter('sweet_dessert_filter_is_taxonomy',				'sweet_dessert_woocommerce_is_taxonomy', 9, 2);
			add_filter('sweet_dessert_filter_get_stream_page_title',		'sweet_dessert_woocommerce_get_stream_page_title', 9, 2);
			add_filter('sweet_dessert_filter_get_stream_page_link',		'sweet_dessert_woocommerce_get_stream_page_link', 9, 2);
			add_filter('sweet_dessert_filter_get_stream_page_id',		'sweet_dessert_woocommerce_get_stream_page_id', 9, 2);
			add_filter('sweet_dessert_filter_detect_inheritance_key',	'sweet_dessert_woocommerce_detect_inheritance_key', 9, 1);
			add_filter('sweet_dessert_filter_detect_template_page_id',	'sweet_dessert_woocommerce_detect_template_page_id', 9, 2);
			add_filter('sweet_dessert_filter_orderby_need',				'sweet_dessert_woocommerce_orderby_need', 9, 2);

			add_filter('sweet_dessert_filter_show_post_navi', 			'sweet_dessert_woocommerce_show_post_navi');
			add_filter('sweet_dessert_filter_list_post_types', 			'sweet_dessert_woocommerce_list_post_types');

			add_action('sweet_dessert_action_shortcodes_list', 			'sweet_dessert_woocommerce_reg_shortcodes', 20);
			if (function_exists('sweet_dessert_exists_visual_composer') && sweet_dessert_exists_visual_composer())
				add_action('sweet_dessert_action_shortcodes_list_vc',	'sweet_dessert_woocommerce_reg_shortcodes_vc', 20);


		}

		if (is_admin()) {

			add_filter( 'sweet_dessert_filter_required_plugins',					'sweet_dessert_woocommerce_required_plugins' );
		}
	}
}

if ( !function_exists( 'sweet_dessert_woocommerce_settings_theme_setup2' ) ) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_woocommerce_settings_theme_setup2', 3 );
	function sweet_dessert_woocommerce_settings_theme_setup2() {
		if (sweet_dessert_exists_woocommerce()) {
			// Add WooCommerce pages in the Theme inheritance system
			sweet_dessert_add_theme_inheritance( array( 'woocommerce' => array(
				'stream_template' => 'blog-woocommerce',		// This params must be empty
				'single_template' => 'single-woocommerce',		// They are specified to enable separate settings for blog and single wooc
				'taxonomy' => array('product_cat'),
				'taxonomy_tags' => array('product_tag'),
				'post_type' => array('product'),
				'override' => 'custom'
				) )
			);

			// Add WooCommerce specific options in the Theme Options

			sweet_dessert_storage_set_array_before('options', 'partition_service', array(
				
				"partition_woocommerce" => array(
					"title" => esc_html__('WooCommerce', 'sweet-dessert'),
					"icon" => "iconadmin-basket",
					"type" => "partition"),

				"info_wooc_1" => array(
					"title" => esc_html__('WooCommerce products list parameters', 'sweet-dessert'),
					"desc" => esc_html__("Select WooCommerce products list's style and crop parameters", 'sweet-dessert'),
					"type" => "info"),
		
				"shop_mode" => array(
					"title" => esc_html__('Shop list style',  'sweet-dessert'),
					"desc" => esc_html__("WooCommerce products list's style: thumbs or list with description", 'sweet-dessert'),
					"std" => "thumbs",
					"divider" => false,
					"options" => array(
						'thumbs' => esc_html__('Thumbs', 'sweet-dessert'),
						'list' => esc_html__('List', 'sweet-dessert')
					),
					"type" => "checklist"),
		
				"show_mode_buttons" => array(
					"title" => esc_html__('Show style buttons',  'sweet-dessert'),
					"desc" => esc_html__("Show buttons to allow visitors change list style", 'sweet-dessert'),
					"std" => "yes",
					"options" => sweet_dessert_get_options_param('list_yes_no'),
					"type" => "switch"),

				"shop_loop_columns" => array(
					"title" => esc_html__('Shop columns',  'sweet-dessert'),
					"desc" => esc_html__("How many columns used to show products on shop page", 'sweet-dessert'),
					"std" => "3",
					"step" => 1,
					"min" => 1,
					"max" => 6,
					"type" => "spinner"),

				"show_currency" => array(
					"title" => esc_html__('Show currency selector', 'sweet-dessert'),
					"desc" => esc_html__('Show currency selector in the user menu', 'sweet-dessert'),
					"std" => "yes",
					"options" => sweet_dessert_get_options_param('list_yes_no'),
					"type" => "switch"),
		
				"show_cart" => array(
					"title" => esc_html__('Show cart button', 'sweet-dessert'),
					"desc" => esc_html__('Show cart button in the user menu', 'sweet-dessert'),
					"std" => "shop",
					"options" => array(
						'hide'   => esc_html__('Hide', 'sweet-dessert'),
						'always' => esc_html__('Always', 'sweet-dessert'),
						'shop'   => esc_html__('Only on shop pages', 'sweet-dessert')
					),
					"type" => "checklist"),

				"crop_product_thumb" => array(
					"title" => esc_html__("Crop product's thumbnail",  'sweet-dessert'),
					"desc" => esc_html__("Crop product's thumbnails on search results page or scale it", 'sweet-dessert'),
					"std" => "no",
					"options" => sweet_dessert_get_options_param('list_yes_no'),
					"type" => "switch")
				
				)
			);

		}
	}
}

// WooCommerce hooks
if (!function_exists('sweet_dessert_woocommerce_theme_setup3')) {
	add_action( 'sweet_dessert_action_after_init_theme', 'sweet_dessert_woocommerce_theme_setup3' );
	function sweet_dessert_woocommerce_theme_setup3() {

		if (sweet_dessert_exists_woocommerce()) {
			add_action(    'woocommerce_before_subcategory_title',		'sweet_dessert_woocommerce_open_thumb_wrapper', 9 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'sweet_dessert_woocommerce_open_thumb_wrapper', 9 );

			add_action(    'woocommerce_before_subcategory_title',		'sweet_dessert_woocommerce_open_item_wrapper', 20 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'sweet_dessert_woocommerce_open_item_wrapper', 20 );

			add_action(    'woocommerce_after_subcategory',				'sweet_dessert_woocommerce_close_item_wrapper', 20 );
			add_action(    'woocommerce_after_shop_loop_item',			'sweet_dessert_woocommerce_close_item_wrapper', 20 );

			add_action(    'woocommerce_after_shop_loop_item_title',	'sweet_dessert_woocommerce_after_shop_loop_item_title', 7);

			add_action(    'woocommerce_after_subcategory_title',		'sweet_dessert_woocommerce_after_subcategory_title', 10 );

			add_action(    'the_title',									'sweet_dessert_woocommerce_the_title');

			// Wrap category title into link
            remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
			add_action(		'woocommerce_shop_loop_subcategory_title',  'sweet_dessert_woocommerce_shop_loop_subcategory_title', 9, 1);

			// Remove link around product item
			remove_action('woocommerce_before_shop_loop_item',			'woocommerce_template_loop_product_link_open', 10);
			remove_action('woocommerce_after_shop_loop_item',			'woocommerce_template_loop_product_link_close', 5);
			// Remove link around product category
			remove_action('woocommerce_before_subcategory',				'woocommerce_template_loop_category_link_open', 10);
			remove_action('woocommerce_after_subcategory',				'woocommerce_template_loop_category_link_close', 10);

		}

		if (sweet_dessert_is_woocommerce_page()) {
			
			remove_action( 'woocommerce_sidebar', 						'woocommerce_get_sidebar', 10 );					// Remove WOOC sidebar
			
			remove_action( 'woocommerce_before_main_content',			'woocommerce_output_content_wrapper', 10);
			add_action(    'woocommerce_before_main_content',			'sweet_dessert_woocommerce_wrapper_start', 10);
			
			remove_action( 'woocommerce_after_main_content',			'woocommerce_output_content_wrapper_end', 10);		
			add_action(    'woocommerce_after_main_content',			'sweet_dessert_woocommerce_wrapper_end', 10);

			add_action(    'woocommerce_show_page_title',				'sweet_dessert_woocommerce_show_page_title', 10);

			remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_title', 5);		
			add_action(    'woocommerce_single_product_summary',		'sweet_dessert_woocommerce_show_product_title', 5 );

            remove_action(  'woocommerce_single_product_summary',       'woocommerce_template_single_excerpt', 20);
            add_action(    'woocommerce_single_product_summary',		'sweet_dessert_template_single_excerpt', 20 );

			add_action(    'woocommerce_before_shop_loop', 				'sweet_dessert_woocommerce_before_shop_loop', 10 );

			remove_action( 'woocommerce_after_shop_loop',				'woocommerce_pagination', 10 );
			add_action(    'woocommerce_after_shop_loop',				'sweet_dessert_woocommerce_pagination', 10 );

			add_action(    'woocommerce_product_meta_end',				'sweet_dessert_woocommerce_show_product_id', 10);

            if (sweet_dessert_param_is_on(sweet_dessert_get_custom_option('show_post_related'))) {
                add_filter('woocommerce_output_related_products_args', 'sweet_dessert_woocommerce_output_related_products_args');
                add_filter('woocommerce_related_products_args', 'sweet_dessert_woocommerce_related_products_args');
            } else {
                remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
            }

			add_filter(    'woocommerce_product_thumbnails_columns',	'sweet_dessert_woocommerce_product_thumbnails_columns' );

			add_filter(    'get_product_search_form',					'sweet_dessert_woocommerce_get_product_search_form' );


			add_filter(    'post_class',								'sweet_dessert_woocommerce_loop_shop_columns_class' );
			add_filter(    'product_cat_class',							'sweet_dessert_woocommerce_loop_shop_columns_class', 10, 3 );
			
			sweet_dessert_enqueue_popup();
		}
	}
}



// Check if WooCommerce installed and activated
if ( !function_exists( 'sweet_dessert_exists_woocommerce' ) ) {
	function sweet_dessert_exists_woocommerce() {
		return class_exists('Woocommerce');
	}
}

// Return true, if current page is any woocommerce page
if ( !function_exists( 'sweet_dessert_is_woocommerce_page' ) ) {
	function sweet_dessert_is_woocommerce_page() {
		$rez = false;
		if (sweet_dessert_exists_woocommerce()) {
			if (!sweet_dessert_storage_empty('pre_query')) {
				$id = sweet_dessert_storage_get_obj_property('pre_query', 'queried_object_id', 0);
				$rez = sweet_dessert_storage_call_obj_method('pre_query', 'get', 'post_type')=='product' 
						|| $id==wc_get_page_id('shop')
						|| $id==wc_get_page_id('cart')
						|| $id==wc_get_page_id('checkout')
						|| $id==wc_get_page_id('myaccount')
						|| sweet_dessert_storage_call_obj_method('pre_query', 'is_tax', 'product_cat')
						|| sweet_dessert_storage_call_obj_method('pre_query', 'is_tax', 'product_tag')
						|| sweet_dessert_storage_call_obj_method('pre_query', 'is_tax', get_object_taxonomies('product'));
						
			} else
				$rez = is_shop() || is_product() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_cart() || is_checkout() || is_account_page();
		}
		return $rez;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'sweet_dessert_woocommerce_detect_inheritance_key' ) ) {
	//Handler of add_filter('sweet_dessert_filter_detect_inheritance_key',	'sweet_dessert_woocommerce_detect_inheritance_key', 9, 1);
	function sweet_dessert_woocommerce_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return sweet_dessert_is_woocommerce_page() ? 'woocommerce' : '';
	}
}

// Filter to detect current template page id
if ( !function_exists( 'sweet_dessert_woocommerce_detect_template_page_id' ) ) {
	//Handler of add_filter('sweet_dessert_filter_detect_template_page_id',	'sweet_dessert_woocommerce_detect_template_page_id', 9, 2);
	function sweet_dessert_woocommerce_detect_template_page_id($id, $key) {
		if (!empty($id)) return $id;
		if ($key == 'woocommerce_cart')				$id = get_option('woocommerce_cart_page_id');
		else if ($key == 'woocommerce_checkout')	$id = get_option('woocommerce_checkout_page_id');
		else if ($key == 'woocommerce_account')		$id = get_option('woocommerce_account_page_id');
		else if ($key == 'woocommerce')				$id = get_option('woocommerce_shop_page_id');
		return $id;
	}
}

// Filter to detect current page type (slug)
if ( !function_exists( 'sweet_dessert_woocommerce_get_blog_type' ) ) {
	//Handler of add_filter('sweet_dessert_filter_get_blog_type',	'sweet_dessert_woocommerce_get_blog_type', 9, 2);
	function sweet_dessert_woocommerce_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		
		if (is_shop()) 					$page = 'woocommerce_shop';
		else if ($query && $query->get('post_type')=='product' || is_product())		$page = 'woocommerce_product';
		else if ($query && $query->get('product_tag')!='' || is_product_tag())		$page = 'woocommerce_tag';
		else if ($query && $query->get('product_cat')!='' || is_product_category())	$page = 'woocommerce_category';
		else if (is_cart())				$page = 'woocommerce_cart';
		else if (is_checkout())			$page = 'woocommerce_checkout';
		else if (is_account_page())		$page = 'woocommerce_account';
		else if (is_woocommerce())		$page = 'woocommerce';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'sweet_dessert_woocommerce_get_blog_title' ) ) {
	//Handler of add_filter('sweet_dessert_filter_get_blog_title',	'sweet_dessert_woocommerce_get_blog_title', 9, 2);
	function sweet_dessert_woocommerce_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		
		if ( sweet_dessert_strpos($page, 'woocommerce')!==false ) {
			if ( $page == 'woocommerce_category' ) {
				$term = get_term_by( 'slug', get_query_var( 'product_cat' ), 'product_cat', OBJECT);
				$title = $term->name;
			} else if ( $page == 'woocommerce_tag' ) {
				$term = get_term_by( 'slug', get_query_var( 'product_tag' ), 'product_tag', OBJECT);
				$title = esc_html__('Tag:', 'sweet-dessert') . ' ' . esc_html($term->name);
			} else if ( $page == 'woocommerce_cart' ) {
				$title = esc_html__( 'Your cart', 'sweet-dessert' );
			} else if ( $page == 'woocommerce_checkout' ) {
				$title = esc_html__( 'Checkout', 'sweet-dessert' );
			} else if ( $page == 'woocommerce_account' ) {
				$title = esc_html__( 'Account', 'sweet-dessert' );
			} else if ( $page == 'woocommerce_product' ) {
				$title = sweet_dessert_get_post_title();
			} else if (($page_id=get_option('woocommerce_shop_page_id')) > 0) {
				$title = sweet_dessert_get_post_title($page_id);
			} else {
				$title = esc_html__( 'Shop', 'sweet-dessert' );
			}
		}
		
		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'sweet_dessert_woocommerce_get_stream_page_title' ) ) {
	//Handler of add_filter('sweet_dessert_filter_get_stream_page_title',	'sweet_dessert_woocommerce_get_stream_page_title', 9, 2);
	function sweet_dessert_woocommerce_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (sweet_dessert_strpos($page, 'woocommerce')!==false) {
			if (($page_id = sweet_dessert_woocommerce_get_stream_page_id(0, $page)) > 0)
				$title = sweet_dessert_get_post_title($page_id);
			else
				$title = esc_html__('Shop', 'sweet-dessert');				
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'sweet_dessert_woocommerce_get_stream_page_id' ) ) {
	//Handler of add_filter('sweet_dessert_filter_get_stream_page_id',	'sweet_dessert_woocommerce_get_stream_page_id', 9, 2);
	function sweet_dessert_woocommerce_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (sweet_dessert_strpos($page, 'woocommerce')!==false) {
			$id = get_option('woocommerce_shop_page_id');
		}
		return $id;
	}
}

// Filter to detect stream page link
if ( !function_exists( 'sweet_dessert_woocommerce_get_stream_page_link' ) ) {
	//Handler of add_filter('sweet_dessert_filter_get_stream_page_link',	'sweet_dessert_woocommerce_get_stream_page_link', 9, 2);
	function sweet_dessert_woocommerce_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (sweet_dessert_strpos($page, 'woocommerce')!==false) {
			$id = sweet_dessert_woocommerce_get_stream_page_id(0, $page);
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect current taxonomy
if ( !function_exists( 'sweet_dessert_woocommerce_get_current_taxonomy' ) ) {
	//Handler of add_filter('sweet_dessert_filter_get_current_taxonomy',	'sweet_dessert_woocommerce_get_current_taxonomy', 9, 2);
	function sweet_dessert_woocommerce_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( sweet_dessert_strpos($page, 'woocommerce')!==false ) {
			$tax = 'product_cat';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'sweet_dessert_woocommerce_is_taxonomy' ) ) {
	//Handler of add_filter('sweet_dessert_filter_is_taxonomy',	'sweet_dessert_woocommerce_is_taxonomy', 9, 2);
	function sweet_dessert_woocommerce_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query!==null && $query->get('product_cat')!='' || is_product_category() ? 'product_cat' : '';
	}
}

// Return false if current plugin not need theme orderby setting
if ( !function_exists( 'sweet_dessert_woocommerce_orderby_need' ) ) {
	//Handler of add_filter('sweet_dessert_filter_orderby_need',	'sweet_dessert_woocommerce_orderby_need', 9, 1);
	function sweet_dessert_woocommerce_orderby_need($need) {
		if ($need == false || sweet_dessert_storage_empty('pre_query'))
			return $need;
		else {
			return sweet_dessert_storage_call_obj_method('pre_query', 'get', 'post_type')!='product' 
					&& sweet_dessert_storage_call_obj_method('pre_query', 'get', 'product_cat')==''
					&& sweet_dessert_storage_call_obj_method('pre_query', 'get', 'product_tag')=='';
		}
	}
}

// Add custom post type into list
if ( !function_exists( 'sweet_dessert_woocommerce_list_post_types' ) ) {
	//Handler of add_filter('sweet_dessert_filter_list_post_types', 	'sweet_dessert_woocommerce_list_post_types', 10, 1);
	function sweet_dessert_woocommerce_list_post_types($list) {
		$list = is_array($list) ? $list : array();
		$list['product'] = esc_html__('Products', 'sweet-dessert');
		return $list;
	}
}


	
// Enqueue WooCommerce custom styles
if ( !function_exists( 'sweet_dessert_woocommerce_frontend_scripts' ) ) {
	//Handler of add_action( 'sweet_dessert_action_add_styles', 'sweet_dessert_woocommerce_frontend_scripts' );
	function sweet_dessert_woocommerce_frontend_scripts() {
		if (sweet_dessert_is_woocommerce_page() || sweet_dessert_get_custom_option('show_cart')=='always')
			if (file_exists(sweet_dessert_get_file_dir('css/plugin.woocommerce.css')))
                wp_enqueue_style( 'sweet-dessert-plugin-woocommerce-style',  sweet_dessert_get_file_url('css/plugin.woocommerce.css'), array(), null );
	}
}

// Before main content
if ( !function_exists( 'sweet_dessert_woocommerce_wrapper_start' ) ) {
	//Handler of add_action('woocommerce_before_main_content', 'sweet_dessert_woocommerce_wrapper_start', 10);
	function sweet_dessert_woocommerce_wrapper_start() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			<article class="post_item post_item_single post_item_product">
			<?php
		} else {
			?>
			<div class="list_products shop_mode_<?php echo !sweet_dessert_storage_empty('shop_mode') ? sweet_dessert_storage_get('shop_mode') : 'thumbs'; ?>">
			<?php
		}
	}
}

// After main content
if ( !function_exists( 'sweet_dessert_woocommerce_wrapper_end' ) ) {
	//Handler of add_action('woocommerce_after_main_content', 'sweet_dessert_woocommerce_wrapper_end', 10);
	function sweet_dessert_woocommerce_wrapper_end() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			</article>	<!-- .post_item -->
			<?php
		} else {
			?>
			</div>	<!-- .list_products -->
			<?php
		}
	}
}

// Check to show page title
if ( !function_exists( 'sweet_dessert_woocommerce_show_page_title' ) ) {
	//Handler of add_action('woocommerce_show_page_title', 'sweet_dessert_woocommerce_show_page_title', 10);
	function sweet_dessert_woocommerce_show_page_title($defa=true) {
		return sweet_dessert_get_custom_option('show_page_title')=='no';
	}
}

// Check to show product title
if ( !function_exists( 'sweet_dessert_woocommerce_show_product_title' ) ) {
	//Handler of add_action( 'woocommerce_single_product_summary', 'sweet_dessert_woocommerce_show_product_title', 5 );
	function sweet_dessert_woocommerce_show_product_title() {
		if (sweet_dessert_get_custom_option('show_post_title')=='yes' || sweet_dessert_get_custom_option('show_page_title')=='no') {
			wc_get_template( 'single-product/title.php' );
		}
	}
}

// New product excerpt with video shortcode
if ( !function_exists( 'sweet_dessert_template_single_excerpt' ) ) {
    //Handler of add_action(    'woocommerce_single_product_summary',		'sweet_dessert_template_single_excerpt', 20 );
    function sweet_dessert_template_single_excerpt() {
        if ( ! defined( 'ABSPATH' ) ) {
            exit; // Exit if accessed directly
        }
        global $post;
        if ( ! $post->post_excerpt ) {
            return;
        }
        ?>
        <div itemprop="description">
            <?php echo sweet_dessert_substitute_all(apply_filters( 'woocommerce_short_description', $post->post_excerpt )); ?>
        </div>
    <?php
    }
}

// Add list mode buttons
if ( !function_exists( 'sweet_dessert_woocommerce_before_shop_loop' ) ) {
	//Handler of add_action( 'woocommerce_before_shop_loop', 'sweet_dessert_woocommerce_before_shop_loop', 10 );
	function sweet_dessert_woocommerce_before_shop_loop() {
		if (sweet_dessert_get_custom_option('show_mode_buttons')=='yes') {
			echo '<div class="mode_buttons"><form action="' . esc_url(sweet_dessert_get_current_url()) . '" method="post">'
				. '<input type="hidden" name="sweet_dessert_shop_mode" value="'.esc_attr(sweet_dessert_storage_get('shop_mode')).'" />'
				. '<a href="#" class="woocommerce_thumbs icon-th" title="'.esc_attr__('Show products as thumbs', 'sweet-dessert').'"></a>'
				. '<a href="#" class="woocommerce_list icon-th-list" title="'.esc_attr__('Show products as list', 'sweet-dessert').'"></a>'
				. '</form></div>';
		}
	}
}


// Open thumbs wrapper for categories and products
if ( !function_exists( 'sweet_dessert_woocommerce_open_thumb_wrapper' ) ) {
	//Handler of add_action( 'woocommerce_before_subcategory_title', 'sweet_dessert_woocommerce_open_thumb_wrapper', 9 );
	//Handler of add_action( 'woocommerce_before_shop_loop_item_title', 'sweet_dessert_woocommerce_open_thumb_wrapper', 9 );
	function sweet_dessert_woocommerce_open_thumb_wrapper($cat='') {
		sweet_dessert_storage_set('in_product_item', true);
		?>
		<div class="post_item_wrap">
			<div class="post_featured">
				<div class="post_thumb">
					<a class="hover_icon hover_icon_link" href="<?php echo esc_url(is_object($cat) ? get_term_link($cat->slug, 'product_cat') : get_permalink()); ?>">
		<?php
	}
}

// Open item wrapper for categories and products
if ( !function_exists( 'sweet_dessert_woocommerce_open_item_wrapper' ) ) {
	//Handler of add_action( 'woocommerce_before_subcategory_title', 'sweet_dessert_woocommerce_open_item_wrapper', 20 );
	//Handler of add_action( 'woocommerce_before_shop_loop_item_title', 'sweet_dessert_woocommerce_open_item_wrapper', 20 );
	function sweet_dessert_woocommerce_open_item_wrapper($cat='') {
		?>
				</a>
			</div>
		</div>
		<div class="post_content">
		<?php
	}
}

// Close item wrapper for categories and products
if ( !function_exists( 'sweet_dessert_woocommerce_close_item_wrapper' ) ) {
	//Handler of add_action( 'woocommerce_after_subcategory', 'sweet_dessert_woocommerce_close_item_wrapper', 20 );
	//Handler of add_action( 'woocommerce_after_shop_loop_item', 'sweet_dessert_woocommerce_close_item_wrapper', 20 );
	function sweet_dessert_woocommerce_close_item_wrapper($cat='') {
		?>
			</div>
		</div>
		<?php
		sweet_dessert_storage_set('in_product_item', false);
	}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'sweet_dessert_woocommerce_after_shop_loop_item_title' ) ) {
	//Handler of add_action( 'woocommerce_after_shop_loop_item_title', 'sweet_dessert_woocommerce_after_shop_loop_item_title', 7);
	function sweet_dessert_woocommerce_after_shop_loop_item_title() {
		if (sweet_dessert_storage_get('shop_mode') == 'list') {
		    $excerpt = apply_filters('the_excerpt', get_the_excerpt());
			echo '<div class="description">'.trim($excerpt).'</div>';
		}
	}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'sweet_dessert_woocommerce_after_subcategory_title' ) ) {
	//Handler of add_action( 'woocommerce_after_subcategory_title', 'sweet_dessert_woocommerce_after_subcategory_title', 10 );
	function sweet_dessert_woocommerce_after_subcategory_title($category) {
		if (sweet_dessert_storage_get('shop_mode') == 'list')
			echo '<div class="description">' . trim($category->description) . '</div>';
	}
}

// Add Product ID for single product
if ( !function_exists( 'sweet_dessert_woocommerce_show_product_id' ) ) {
	//Handler of add_action( 'woocommerce_product_meta_end', 'sweet_dessert_woocommerce_show_product_id', 10);
	function sweet_dessert_woocommerce_show_product_id() {
		global $post, $product;
		echo '<span class="product_id">'.esc_html__('Product ID: ', 'sweet-dessert') . '<span>' . ($post->ID) . '</span></span>';
	}
}

// Redefine number of related products
if ( !function_exists( 'sweet_dessert_woocommerce_output_related_products_args' ) ) {
	//Handler of add_filter( 'woocommerce_output_related_products_args', 'sweet_dessert_woocommerce_output_related_products_args' );
	function sweet_dessert_woocommerce_output_related_products_args($args) {
		$ppp = $ccc = 0;
		if (sweet_dessert_param_is_on(sweet_dessert_get_custom_option('show_post_related'))) {
			$ccc_add = in_array(sweet_dessert_get_custom_option('body_style'), array('fullwide', 'fullscreen')) ? 1 : 0;
			$ccc =  sweet_dessert_get_custom_option('post_related_columns');
			$ccc = $ccc > 0 ? $ccc : (sweet_dessert_param_is_off(sweet_dessert_get_custom_option('show_sidebar_main')) ? 3+$ccc_add : 2+$ccc_add);
			$ppp = sweet_dessert_get_custom_option('post_related_count');
			$ppp = $ppp > 0 ? $ppp : $ccc;
		}
		$args['posts_per_page'] = $ppp;
		$args['columns'] = $ccc;
		return $args;
	}
}

// Redefine post_type if number of related products == 0
if ( !function_exists( 'sweet_dessert_woocommerce_related_products_args' ) ) {
	//Handler of add_filter( 'woocommerce_related_products_args', 'sweet_dessert_woocommerce_related_products_args' );
	function sweet_dessert_woocommerce_related_products_args($args) {
		if ($args['posts_per_page'] == 0)
			$args['post_type'] .= '_';
		return $args;
	}
}

// Number columns for product thumbnails
if ( !function_exists( 'sweet_dessert_woocommerce_product_thumbnails_columns' ) ) {
	//Handler of add_filter( 'woocommerce_product_thumbnails_columns', 'sweet_dessert_woocommerce_product_thumbnails_columns' );
	function sweet_dessert_woocommerce_product_thumbnails_columns($cols) {
		return 4;
	}
}

// Add column class into product item in shop streampage
if ( !function_exists( 'sweet_dessert_woocommerce_loop_shop_columns_class' ) ) {
	//Handler of add_filter( 'post_class', 'sweet_dessert_woocommerce_loop_shop_columns_class' );
	//Handler of add_filter( 'product_cat_class', 'sweet_dessert_woocommerce_loop_shop_columns_class', 10, 3 );
	function sweet_dessert_woocommerce_loop_shop_columns_class($class, $class2='', $cat='') {
        if (!is_product() && !is_cart() && !is_checkout() && !is_account_page()) {
            $cols = function_exists('wc_get_default_products_per_row') ? wc_get_default_products_per_row() : 2;
            $class[] = ' column-1_' . $cols;
        }
        return $class;
	}
}


// Search form
if ( !function_exists( 'sweet_dessert_woocommerce_get_product_search_form' ) ) {
	//Handler of add_filter( 'get_product_search_form', 'sweet_dessert_woocommerce_get_product_search_form' );
	function sweet_dessert_woocommerce_get_product_search_form($form) {
		return '
		<form role="search" method="get" class="search_form" action="' . esc_url(home_url('/')) . '">
			<input type="text" class="search_field" placeholder="' . esc_attr__('Search for products &hellip;', 'sweet-dessert') . '" value="' . get_search_query() . '" name="s" title="' . esc_attr__('Search for products:', 'sweet-dessert') . '" /><button class="search_button icon-search" type="submit"></button>
			<input type="hidden" name="post_type" value="product" />
		</form>
		';
	}
}

// Wrap product title into link
if ( !function_exists( 'sweet_dessert_woocommerce_the_title' ) ) {
	//Handler of add_filter( 'the_title', 'sweet_dessert_woocommerce_the_title' );
	function sweet_dessert_woocommerce_the_title($title) {
		if (sweet_dessert_storage_get('in_product_item') && get_post_type()=='product') {
			$title = '<a href="'.esc_url(get_permalink()).'">'.($title).'</a>';
		}
		return $title;
	}
}

// Wrap category title into link
if ( !function_exists( 'sweet_dessert_woocommerce_shop_loop_subcategory_title' ) ) {
    //Handler of the add_filter( 'woocommerce_shop_loop_subcategory_title', 'sweet_dessert_woocommerce_shop_loop_subcategory_title' );
    function sweet_dessert_woocommerce_shop_loop_subcategory_title($cat) {

        $cat->name = sprintf('<a href="%s">%s</a>', esc_url(get_term_link($cat->slug, 'product_cat')), $cat->name);
        ?>
        <h2 class="woocommerce-loop-category__title">
        <?php
        echo trim($cat->name);

        if ( $cat->count > 0 ) {
            echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . esc_html( $cat->count ) . ')</mark>', $cat ); // WPCS: XSS ok.
        }
        ?>
        </h2><?php

    }
}


// Show pagination links
if ( !function_exists( 'sweet_dessert_woocommerce_pagination' ) ) {
	//Handler of add_filter( 'woocommerce_after_shop_loop', 'sweet_dessert_woocommerce_pagination', 10 );
	function sweet_dessert_woocommerce_pagination() {
        if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
            return;
        }
		$style = sweet_dessert_get_custom_option('blog_pagination');
		sweet_dessert_show_pagination(array(
			'class' => 'pagination_wrap pagination_' . esc_attr($style),
			'style' => $style,
			'button_class' => '',
			'first_text'=> '',
			'last_text' => '',
			'prev_text' => '',
			'next_text' => '',
			'pages_in_group' => $style=='pages' ? 10 : 20
			)
		);
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'sweet_dessert_woocommerce_required_plugins' ) ) {
	//Handler of add_filter('sweet_dessert_filter_required_plugins',	'sweet_dessert_woocommerce_required_plugins');
	function sweet_dessert_woocommerce_required_plugins($list=array()) {
		if (in_array('woocommerce', (array)sweet_dessert_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> 'WooCommerce',
					'slug' 		=> 'woocommerce',
					'required' 	=> false
				);

		return $list;
	}
}

// Show products navigation
if ( !function_exists( 'sweet_dessert_woocommerce_show_post_navi' ) ) {
	//Handler of add_filter('sweet_dessert_filter_show_post_navi', 'sweet_dessert_woocommerce_show_post_navi');
	function sweet_dessert_woocommerce_show_post_navi($show=false) {
		return $show || (sweet_dessert_get_custom_option('show_page_title')=='yes' && is_single() && sweet_dessert_is_woocommerce_page());
	}
}

if ( ! function_exists( 'sweet_dessert_woocommerce_price_filter_widget_step' ) ) {
    add_filter('woocommerce_price_filter_widget_step', 'sweet_dessert_woocommerce_price_filter_widget_step');
    function sweet_dessert_woocommerce_price_filter_widget_step( $step = '' ) {
        $step = 1;
        return $step;
    }
}

// Register shortcodes to the internal builder
//------------------------------------------------------------------------
if ( !function_exists( 'sweet_dessert_woocommerce_reg_shortcodes' ) ) {
	//Handler of add_action('sweet_dessert_action_shortcodes_list', 'sweet_dessert_woocommerce_reg_shortcodes', 20);
	function sweet_dessert_woocommerce_reg_shortcodes() {

		// WooCommerce - Cart
		sweet_dessert_sc_map("woocommerce_cart", array(
			"title" => esc_html__("Woocommerce: Cart", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show Cart page", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array()
			)
		);
		
		// WooCommerce - Checkout
		sweet_dessert_sc_map("woocommerce_checkout", array(
			"title" => esc_html__("Woocommerce: Checkout", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show Checkout page", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array()
			)
		);
		
		// WooCommerce - My Account
		sweet_dessert_sc_map("woocommerce_my_account", array(
			"title" => esc_html__("Woocommerce: My Account", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show My Account page", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array()
			)
		);
		
		// WooCommerce - Order Tracking
		sweet_dessert_sc_map("woocommerce_order_tracking", array(
			"title" => esc_html__("Woocommerce: Order Tracking", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show Order Tracking page", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array()
			)
		);
		
		// WooCommerce - Shop Messages
		sweet_dessert_sc_map("shop_messages", array(
			"title" => esc_html__("Woocommerce: Shop Messages", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show shop messages", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array()
			)
		);
		
		// WooCommerce - Product Page
		sweet_dessert_sc_map("product_page", array(
			"title" => esc_html__("Woocommerce: Product Page", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: display single product page", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"sku" => array(
					"title" => esc_html__("SKU", 'sweet-dessert'),
					"desc" => wp_kses_data( __("SKU code of displayed product", 'sweet-dessert') ),
					"value" => "",
					"type" => "text"
				),
				"id" => array(
					"title" => esc_html__("ID", 'sweet-dessert'),
					"desc" => wp_kses_data( __("ID of displayed product", 'sweet-dessert') ),
					"value" => "",
					"type" => "text"
				),
				"posts_per_page" => array(
					"title" => esc_html__("Number", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
					"value" => "1",
					"min" => 1,
					"type" => "spinner"
				),
				"post_type" => array(
					"title" => esc_html__("Post type", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Post type for the WP query (leave 'product')", 'sweet-dessert') ),
					"value" => "product",
					"type" => "text"
				),
				"post_status" => array(
					"title" => esc_html__("Post status", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Display posts only with this status", 'sweet-dessert') ),
					"value" => "publish",
					"type" => "select",
					"options" => array(
						"publish" => esc_html__('Publish', 'sweet-dessert'),
						"protected" => esc_html__('Protected', 'sweet-dessert'),
						"private" => esc_html__('Private', 'sweet-dessert'),
						"pending" => esc_html__('Pending', 'sweet-dessert'),
						"draft" => esc_html__('Draft', 'sweet-dessert')
						)
					)
				)
			)
		);
		
		// WooCommerce - Product
		sweet_dessert_sc_map("product", array(
			"title" => esc_html__("Woocommerce: Product", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: display one product", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"sku" => array(
					"title" => esc_html__("SKU", 'sweet-dessert'),
					"desc" => wp_kses_data( __("SKU code of displayed product", 'sweet-dessert') ),
					"value" => "",
					"type" => "text"
				),
				"id" => array(
					"title" => esc_html__("ID", 'sweet-dessert'),
					"desc" => wp_kses_data( __("ID of displayed product", 'sweet-dessert') ),
					"value" => "",
					"type" => "text"
					)
				)
			)
		);
		
		// WooCommerce - Best Selling Products
		sweet_dessert_sc_map("best_selling_products", array(
			"title" => esc_html__("Woocommerce: Best Selling Products", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show best selling products", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
					)
				)
			)
		);
		
		// WooCommerce - Recent Products
		sweet_dessert_sc_map("recent_products", array(
			"title" => esc_html__("Woocommerce: Recent Products", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show recent products", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'sweet-dessert'),
						"title" => esc_html__('Title', 'sweet-dessert')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => sweet_dessert_get_sc_param('ordering')
					)
				)
			)
		);
		
		// WooCommerce - Related Products
		sweet_dessert_sc_map("related_products", array(
			"title" => esc_html__("Woocommerce: Related Products", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show related products", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"posts_per_page" => array(
					"title" => esc_html__("Number", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'sweet-dessert'),
						"title" => esc_html__('Title', 'sweet-dessert')
						)
					)
				)
			)
		);
		
		// WooCommerce - Featured Products
		sweet_dessert_sc_map("featured_products", array(
			"title" => esc_html__("Woocommerce: Featured Products", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show featured products", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'sweet-dessert'),
						"title" => esc_html__('Title', 'sweet-dessert')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => sweet_dessert_get_sc_param('ordering')
					)
				)
			)
		);
		
		// WooCommerce - Top Rated Products
		sweet_dessert_sc_map("featured_products", array(
			"title" => esc_html__("Woocommerce: Top Rated Products", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show top rated products", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'sweet-dessert'),
						"title" => esc_html__('Title', 'sweet-dessert')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => sweet_dessert_get_sc_param('ordering')
					)
				)
			)
		);
		
		// WooCommerce - Sale Products
		sweet_dessert_sc_map("featured_products", array(
			"title" => esc_html__("Woocommerce: Sale Products", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: list products on sale", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'sweet-dessert'),
						"title" => esc_html__('Title', 'sweet-dessert')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => sweet_dessert_get_sc_param('ordering')
					)
				)
			)
		);
		
		// WooCommerce - Product Category
		sweet_dessert_sc_map("product_category", array(
			"title" => esc_html__("Woocommerce: Products from category", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: list products in specified category(-ies)", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'sweet-dessert'),
						"title" => esc_html__('Title', 'sweet-dessert')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => sweet_dessert_get_sc_param('ordering')
				),
				"category" => array(
					"title" => esc_html__("Categories", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Comma separated category slugs", 'sweet-dessert') ),
					"value" => '',
					"type" => "text"
				),
				"operator" => array(
					"title" => esc_html__("Operator", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Categories operator", 'sweet-dessert') ),
					"value" => "IN",
					"type" => "checklist",
					"size" => "medium",
					"options" => array(
						"IN" => esc_html__('IN', 'sweet-dessert'),
						"NOT IN" => esc_html__('NOT IN', 'sweet-dessert'),
						"AND" => esc_html__('AND', 'sweet-dessert')
						)
					)
				)
			)
		);
		
		// WooCommerce - Products
		sweet_dessert_sc_map("products", array(
			"title" => esc_html__("Woocommerce: Products", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: list all products", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"skus" => array(
					"title" => esc_html__("SKUs", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Comma separated SKU codes of products", 'sweet-dessert') ),
					"value" => "",
					"type" => "text"
				),
				"ids" => array(
					"title" => esc_html__("IDs", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Comma separated ID of products", 'sweet-dessert') ),
					"value" => "",
					"type" => "text"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'sweet-dessert'),
						"title" => esc_html__('Title', 'sweet-dessert')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => sweet_dessert_get_sc_param('ordering')
					)
				)
			)
		);
		
		// WooCommerce - Product attribute
		sweet_dessert_sc_map("product_attribute", array(
			"title" => esc_html__("Woocommerce: Products by Attribute", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show products with specified attribute", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"per_page" => array(
					"title" => esc_html__("Number", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'sweet-dessert'),
						"title" => esc_html__('Title', 'sweet-dessert')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => sweet_dessert_get_sc_param('ordering')
				),
				"attribute" => array(
					"title" => esc_html__("Attribute", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Attribute name", 'sweet-dessert') ),
					"value" => "",
					"type" => "text"
				),
				"filter" => array(
					"title" => esc_html__("Filter", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Attribute value", 'sweet-dessert') ),
					"value" => "",
					"type" => "text"
					)
				)
			)
		);
		
		// WooCommerce - Products Categories
		sweet_dessert_sc_map("product_categories", array(
			"title" => esc_html__("Woocommerce: Product Categories", 'sweet-dessert'),
			"desc" => wp_kses_data( __("WooCommerce shortcode: show categories with products", 'sweet-dessert') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"number" => array(
					"title" => esc_html__("Number", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many categories showed", 'sweet-dessert') ),
					"value" => 4,
					"min" => 1,
					"type" => "spinner"
				),
				"columns" => array(
					"title" => esc_html__("Columns", 'sweet-dessert'),
					"desc" => wp_kses_data( __("How many columns per row use for categories output", 'sweet-dessert') ),
					"value" => 4,
					"min" => 2,
					"max" => 4,
					"type" => "spinner"
				),
				"orderby" => array(
					"title" => esc_html__("Order by", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "date",
					"type" => "select",
					"options" => array(
						"date" => esc_html__('Date', 'sweet-dessert'),
						"title" => esc_html__('Title', 'sweet-dessert')
					)
				),
				"order" => array(
					"title" => esc_html__("Order", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
					"value" => "desc",
					"type" => "switch",
					"size" => "big",
					"options" => sweet_dessert_get_sc_param('ordering')
				),
				"parent" => array(
					"title" => esc_html__("Parent", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Parent category slug", 'sweet-dessert') ),
					"value" => "",
					"type" => "text"
				),
				"ids" => array(
					"title" => esc_html__("IDs", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Comma separated ID of products", 'sweet-dessert') ),
					"value" => "",
					"type" => "text"
				),
				"hide_empty" => array(
					"title" => esc_html__("Hide empty", 'sweet-dessert'),
					"desc" => wp_kses_data( __("Hide empty categories", 'sweet-dessert') ),
					"value" => "yes",
					"type" => "switch",
					"options" => sweet_dessert_get_sc_param('yes_no')
					)
				)
			)
		);
	}
}



// Register shortcodes to the VC builder
//------------------------------------------------------------------------
if ( !function_exists( 'sweet_dessert_woocommerce_reg_shortcodes_vc' ) ) {
	//Handler of add_action('sweet_dessert_action_shortcodes_list_vc', 'sweet_dessert_woocommerce_reg_shortcodes_vc');
	function sweet_dessert_woocommerce_reg_shortcodes_vc() {
	
		if (false && function_exists('sweet_dessert_exists_woocommerce') && sweet_dessert_exists_woocommerce()) {
		
			// WooCommerce - Cart
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "woocommerce_cart",
				"name" => esc_html__("Cart", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show cart page", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_wooc_cart',
				"class" => "trx_sc_alone trx_sc_woocommerce_cart",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array(
					array(
						"param_name" => "dummy",
						"heading" => esc_html__("Dummy data", 'sweet-dessert'),
						"description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'sweet-dessert') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Woocommerce_Cart extends Sweet_Dessert_VC_ShortCodeAlone {}
		
		
			// WooCommerce - Checkout
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "woocommerce_checkout",
				"name" => esc_html__("Checkout", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show checkout page", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_wooc_checkout',
				"class" => "trx_sc_alone trx_sc_woocommerce_checkout",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array(
					array(
						"param_name" => "dummy",
						"heading" => esc_html__("Dummy data", 'sweet-dessert'),
						"description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'sweet-dessert') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Woocommerce_Checkout extends Sweet_Dessert_VC_ShortCodeAlone {}
		
		
			// WooCommerce - My Account
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "woocommerce_my_account",
				"name" => esc_html__("My Account", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show my account page", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_wooc_my_account',
				"class" => "trx_sc_alone trx_sc_woocommerce_my_account",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array(
					array(
						"param_name" => "dummy",
						"heading" => esc_html__("Dummy data", 'sweet-dessert'),
						"description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'sweet-dessert') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Woocommerce_My_Account extends Sweet_Dessert_VC_ShortCodeAlone {}
		
		
			// WooCommerce - Order Tracking
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "woocommerce_order_tracking",
				"name" => esc_html__("Order Tracking", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show order tracking page", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_wooc_order_tracking',
				"class" => "trx_sc_alone trx_sc_woocommerce_order_tracking",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array(
					array(
						"param_name" => "dummy",
						"heading" => esc_html__("Dummy data", 'sweet-dessert'),
						"description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'sweet-dessert') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Woocommerce_Order_Tracking extends Sweet_Dessert_VC_ShortCodeAlone {}
		
		
			// WooCommerce - Shop Messages
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "shop_messages",
				"name" => esc_html__("Shop Messages", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show shop messages", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_wooc_shop_messages',
				"class" => "trx_sc_alone trx_sc_shop_messages",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => false,
				"params" => array(
					array(
						"param_name" => "dummy",
						"heading" => esc_html__("Dummy data", 'sweet-dessert'),
						"description" => wp_kses_data( __("Dummy data - not used in shortcodes", 'sweet-dessert') ),
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Shop_Messages extends Sweet_Dessert_VC_ShortCodeAlone {}
		
		
			// WooCommerce - Product Page
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "product_page",
				"name" => esc_html__("Product Page", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: display single product page", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_product_page',
				"class" => "trx_sc_single trx_sc_product_page",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "sku",
						"heading" => esc_html__("SKU", 'sweet-dessert'),
						"description" => wp_kses_data( __("SKU code of displayed product", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "id",
						"heading" => esc_html__("ID", 'sweet-dessert'),
						"description" => wp_kses_data( __("ID of displayed product", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "posts_per_page",
						"heading" => esc_html__("Number", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "post_type",
						"heading" => esc_html__("Post type", 'sweet-dessert'),
						"description" => wp_kses_data( __("Post type for the WP query (leave 'product')", 'sweet-dessert') ),
						"class" => "",
						"value" => "product",
						"type" => "textfield"
					),
					array(
						"param_name" => "post_status",
						"heading" => esc_html__("Post status", 'sweet-dessert'),
						"description" => wp_kses_data( __("Display posts only with this status", 'sweet-dessert') ),
						"class" => "",
						"value" => array(
							esc_html__('Publish', 'sweet-dessert') => 'publish',
							esc_html__('Protected', 'sweet-dessert') => 'protected',
							esc_html__('Private', 'sweet-dessert') => 'private',
							esc_html__('Pending', 'sweet-dessert') => 'pending',
							esc_html__('Draft', 'sweet-dessert') => 'draft'
						),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Product_Page extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Product
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "product",
				"name" => esc_html__("Product", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: display one product", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_product',
				"class" => "trx_sc_single trx_sc_product",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "sku",
						"heading" => esc_html__("SKU", 'sweet-dessert'),
						"description" => wp_kses_data( __("Product's SKU code", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "id",
						"heading" => esc_html__("ID", 'sweet-dessert'),
						"description" => wp_kses_data( __("Product's ID", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Product extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
			// WooCommerce - Best Selling Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "best_selling_products",
				"name" => esc_html__("Best Selling Products", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show best selling products", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_best_selling_products',
				"class" => "trx_sc_single trx_sc_best_selling_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Best_Selling_Products extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Recent Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "recent_products",
				"name" => esc_html__("Recent Products", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show recent products", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_recent_products',
				"class" => "trx_sc_single trx_sc_recent_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"

					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'sweet-dessert') => 'date',
							esc_html__('Title', 'sweet-dessert') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip((array)sweet_dessert_get_sc_param('ordering')),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Recent_Products extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Related Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "related_products",
				"name" => esc_html__("Related Products", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show related products", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_related_products',
				"class" => "trx_sc_single trx_sc_related_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "posts_per_page",
						"heading" => esc_html__("Number", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'sweet-dessert') => 'date',
							esc_html__('Title', 'sweet-dessert') => 'title'
						),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Related_Products extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Featured Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "featured_products",
				"name" => esc_html__("Featured Products", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show featured products", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_featured_products',
				"class" => "trx_sc_single trx_sc_featured_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'sweet-dessert') => 'date',
							esc_html__('Title', 'sweet-dessert') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip((array)sweet_dessert_get_sc_param('ordering')),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Featured_Products extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Top Rated Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "top_rated_products",
				"name" => esc_html__("Top Rated Products", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show top rated products", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_top_rated_products',
				"class" => "trx_sc_single trx_sc_top_rated_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'sweet-dessert') => 'date',
							esc_html__('Title', 'sweet-dessert') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip((array)sweet_dessert_get_sc_param('ordering')),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Top_Rated_Products extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Sale Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "sale_products",
				"name" => esc_html__("Sale Products", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: list products on sale", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_sale_products',
				"class" => "trx_sc_single trx_sc_sale_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'sweet-dessert') => 'date',
							esc_html__('Title', 'sweet-dessert') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip((array)sweet_dessert_get_sc_param('ordering')),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Sale_Products extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Product Category
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "product_category",
				"name" => esc_html__("Products from category", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: list products in specified category(-ies)", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_product_category',
				"class" => "trx_sc_single trx_sc_product_category",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'sweet-dessert') => 'date',
							esc_html__('Title', 'sweet-dessert') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip((array)sweet_dessert_get_sc_param('ordering')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "category",
						"heading" => esc_html__("Categories", 'sweet-dessert'),
						"description" => wp_kses_data( __("Comma separated category slugs", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "operator",
						"heading" => esc_html__("Operator", 'sweet-dessert'),
						"description" => wp_kses_data( __("Categories operator", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('IN', 'sweet-dessert') => 'IN',
							esc_html__('NOT IN', 'sweet-dessert') => 'NOT IN',
							esc_html__('AND', 'sweet-dessert') => 'AND'
						),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Product_Category extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Products
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "products",
				"name" => esc_html__("Products", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: list all products", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_products',
				"class" => "trx_sc_single trx_sc_products",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "skus",
						"heading" => esc_html__("SKUs", 'sweet-dessert'),
						"description" => wp_kses_data( __("Comma separated SKU codes of products", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "ids",
						"heading" => esc_html__("IDs", 'sweet-dessert'),
						"description" => wp_kses_data( __("Comma separated ID of products", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'sweet-dessert') => 'date',
							esc_html__('Title', 'sweet-dessert') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip((array)sweet_dessert_get_sc_param('ordering')),
						"type" => "dropdown"
					)
				)
			) );
			
			class WPBakeryShortCode_Products extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
		
		
			// WooCommerce - Product Attribute
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "product_attribute",
				"name" => esc_html__("Products by Attribute", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show products with specified attribute", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_product_attribute',
				"class" => "trx_sc_single trx_sc_product_attribute",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "per_page",
						"heading" => esc_html__("Number", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many products showed", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many columns per row use for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'sweet-dessert') => 'date',
							esc_html__('Title', 'sweet-dessert') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip((array)sweet_dessert_get_sc_param('ordering')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "attribute",
						"heading" => esc_html__("Attribute", 'sweet-dessert'),
						"description" => wp_kses_data( __("Attribute name", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "filter",
						"heading" => esc_html__("Filter", 'sweet-dessert'),
						"description" => wp_kses_data( __("Attribute value", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					)
				)
			) );
			
			class WPBakeryShortCode_Product_Attribute extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		
		
			// WooCommerce - Products Categories
			//-------------------------------------------------------------------------------------
			
			vc_map( array(
				"base" => "product_categories",
				"name" => esc_html__("Product Categories", 'sweet-dessert'),
				"description" => wp_kses_data( __("WooCommerce shortcode: show categories with products", 'sweet-dessert') ),
				"category" => esc_html__('WooCommerce', 'sweet-dessert'),
				'icon' => 'icon_trx_product_categories',
				"class" => "trx_sc_single trx_sc_product_categories",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array(
					array(
						"param_name" => "number",
						"heading" => esc_html__("Number", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many categories showed", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "4",
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'sweet-dessert'),
						"description" => wp_kses_data( __("How many columns per row use for categories output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "1",
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array(
							esc_html__('Date', 'sweet-dessert') => 'date',
							esc_html__('Title', 'sweet-dessert') => 'title'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'sweet-dessert'),
						"description" => wp_kses_data( __("Sorting order for products output", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => array_flip((array)sweet_dessert_get_sc_param('ordering')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "parent",
						"heading" => esc_html__("Parent", 'sweet-dessert'),
						"description" => wp_kses_data( __("Parent category slug", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "date",
						"type" => "textfield"
					),
					array(
						"param_name" => "ids",
						"heading" => esc_html__("IDs", 'sweet-dessert'),
						"description" => wp_kses_data( __("Comma separated ID of products", 'sweet-dessert') ),
						"admin_label" => true,
						"class" => "",
						"value" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "hide_empty",
						"heading" => esc_html__("Hide empty", 'sweet-dessert'),
						"description" => wp_kses_data( __("Hide empty categories", 'sweet-dessert') ),
						"class" => "",
						"value" => array("Hide empty" => "1" ),
						"type" => "checkbox"
					)
				)
			) );
			
			class WPBakeryShortCode_Products_Categories extends Sweet_Dessert_VC_ShortCodeSingle {}
		
		}
	}
}
?>