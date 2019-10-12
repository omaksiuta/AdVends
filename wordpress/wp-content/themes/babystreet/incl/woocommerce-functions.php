<?php
// Woocommerce specific functions
/** @var $product WC_Product */

// Disable WooCommerce styles
if (version_compare(WOOCOMMERCE_VERSION, "2.1") >= 0) {
	add_filter('woocommerce_enqueue_styles', '__return_false');
} else {
	define('WOOCOMMERCE_USE_CSS', false);
}

/**
 * Overright WooCommerce Breadcrumb
 *
 * @access public
 * @return void
 */
function woocommerce_breadcrumb($args = array()) {
// If the breadcrumb is enabled
	if (babystreet_get_option('show_breadcrumb')) {
		$args = wp_parse_args($args, apply_filters('woocommerce_breadcrumb_defaults', array(
				'delimiter' => ' <span class="babystreet-breadcrumb-delimiter">/</span> ',
				'wrap_before' => '<div class="breadcrumb">',
				'wrap_after' => '</div>',
				'before' => '',
				'after' => '',
				'home' => esc_html__('Home', 'babystreet')
		)));

		$breadcrumbs = new WC_Breadcrumb();

		if ($args['home']) {
			$breadcrumbs->add_crumb($args['home'], babystreet_wpml_get_home_url());
		}

		$args['breadcrumb'] = $breadcrumbs->generate();

		wc_get_template('global/breadcrumb.php', $args);
	}
}

// removed breadcrumb from hook and call explicitly in wrapper-start
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/**
 * Display the image part of the product in loop
 *
 * Takes into account product_hover_onproduct theme option
 */
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_filter('woocommerce_before_shop_loop_item', 'babystreet_shop_loop_image', 10);

if ( ! function_exists( 'babystreet_shop_loop_image' ) ) {

	function babystreet_shop_loop_image() {
		global $post;
		echo '<div class="image">';

		?>

        <a href="<?php the_permalink(); ?>">
			<?php woocommerce_template_loop_product_thumbnail(); ?>
			<?php
			$second_image = babystreet_get_second_product_image_id( $post );
			// If we have swap image enabled and second image:
			if ( babystreet_get_option( 'product_hover_onproduct' ) == 'babystreet-prodhover-swap' && $second_image ):
				?>
				<?php
				$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'shop_catalog' );

				$props = wc_get_product_attachment_props( $second_image, $post );
				echo wp_get_attachment_image( $second_image, $image_size, false, array(
					'title' => $props['title'],
					'alt'   => $props['alt']
				) );
				?>
			<?php endif; ?>
        </a>
		<?php
		echo '</div>';
	}

}

if ( ! function_exists( 'babystreet_get_second_product_image_id' ) ) {
	/**
	 * Returns the second product image ID (if any)
	 * Else returns false
	 *
	 * @param mixed $post Post object or post ID of the product.
	 *
	 * @return int|bool false if no second image OR the attachment ID of the image
	 */
	function babystreet_get_second_product_image_id( $post ) {
		$product  = wc_get_product( $post );
		$imageIds = $product->get_gallery_image_ids();

		if ( array_key_exists( 0, $imageIds ) ) {
			return $imageIds[0];
		}

		return false;
	}
}

/**
 * Checks if the product is in the new period
 *
 * @param WC_Product $product
 * @return boolean
 */
if (!function_exists('babystreet_is_product_new')) {

	function babystreet_is_product_new($product) {
		/** @var $product WC_Product */

		$days_product_is_new = babystreet_get_option('new_label_period', 45);

		if($days_product_is_new != 0) {
			$post_date_dt = date_create( $product->get_date_created() );
			$curr_date_dt = date_create( 'now' );
			$post_date_ts = $post_date_dt->format( 'Y-m-d' );
			$curr_date_ts = $curr_date_dt->format( 'Y-m-d' );

			$diff = abs( strtotime( $post_date_ts ) - strtotime( $curr_date_ts ) );
			$diff /= 3600 * 24;

			if ( $diff < $days_product_is_new ) {
				return true;
			}
		}

		return false;
	}

}

/**
 * Returns the "not sale" price.
 * Used by babystreet_get_product_saving()
 *
 * @param WC_Product $product
 * @return type
 */
if (!function_exists('babystreet_get_product_not_sale_price')) {

	function babystreet_get_product_not_sale_price($product) {
		/** @var $product WC_Product */
		if($product->is_type('variable')) {
			return $product->get_variation_regular_price('min');
		} else {
			return $product->get_regular_price();
		}
	}

}

/**
 * Gets product saving
 *
 * @param WC_Product $product
 * @return type
 */
if (!function_exists('babystreet_get_product_saving')) {

	function babystreet_get_product_saving($product) {
		/** @var $product WC_Product */
		if ($product->is_on_sale()) {
			$sale_price = $product->get_price();
			$not_sale_price = babystreet_get_product_not_sale_price($product);

			$saving = 100 - $sale_price / $not_sale_price * 100;

			return round($saving);
		}
	}

}

// Unload PrettyPhoto init for Woocommerce only
add_action('wp_enqueue_scripts', 'babystreet_remove_wc_prettyphoto');

if (!function_exists('babystreet_remove_wc_prettyphoto')) {

	function babystreet_remove_wc_prettyphoto() {
		wp_dequeue_script('prettyPhoto-init');
	}

}

// remove result count showing on top of category
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Display content holder
add_action('woocommerce_before_shop_loop', 'babystreet_add_content_holder', 5);
if (!function_exists('babystreet_add_content_holder')) {

	function babystreet_add_content_holder() {

		echo '<div class="content_holder">';

		$style_class = 'columns-' . babystreet_get_option('category_columns_num');

		if (babystreet_get_option('enable_shop_cat_carousel')) {
			// owl carousel
			wp_localize_script('babystreet-libs-config', 'babystreet_owl_carousel_cat', array(
					'columns' => esc_js(babystreet_get_option('category_columns_num'))
			));

			$style_class = 'owl-carousel babystreet-owl-carousel';
		}

		$display_type = woocommerce_get_loop_display_mode();
		if ( 'subcategories' === $display_type || 'both' === $display_type ) {
			$before_categories_html = '<div class="babystreet_woo_categories_shop woocommerce ' . esc_attr( $style_class ) . '">';
			echo woocommerce_maybe_show_product_subcategories($before_categories_html);
			echo '</div>';
		}

		if (babystreet_get_option('show_refine_area') && woocommerce_products_will_display()) {
			echo '<div class="box-sort-filter'.(is_active_sidebar('babystreet_product_filters_sidebar') ? ' babystreet-product-filters-has-widgets' : '' ).'">';
			echo '<div class="product-filter">';
			if(is_active_sidebar('babystreet_product_filters_sidebar')) {
				echo '<a title="' . esc_attr__( 'More Filters', 'babystreet' ) . '" class="babystreet-filter-widgets-triger" href="#">' . esc_html__('Filter', 'babystreet') . '</a>';
			}
		}
	}

}

// Price filter on category pages
if (babystreet_get_option('show_pricefilter', 1) && babystreet_get_option('show_refine_area')) {
	add_action('woocommerce_before_shop_loop', 'babystreet_price_filter', 10);
}

if (!function_exists('babystreet_price_filter')) {

	function babystreet_price_filter() {
		global $wp, $wp_the_query;

		if (!is_post_type_archive('product') && !is_tax(get_object_taxonomies('product'))) {
			return;
		}

		if (!$wp_the_query->post_count) {
			return;
		}

		$min_price = isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : '';
		$max_price = isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : '';

		wp_enqueue_style('jquery-ui');
		wp_enqueue_script( 'babystreet-price-slider', get_template_directory_uri() . '/js/babystreet-price-slider.js', array('jquery-ui-slider', 'wc-jquery-ui-touchpunch', 'accounting' ), false, true );

		// Remember current filters/search
		$fields = '';

		if (get_search_query()) {
			$fields .= '<input type="hidden" name="s" value="' . get_search_query() . '" />';
		}

		if (!empty($_GET['post_type'])) {
			$fields .= '<input type="hidden" name="post_type" value="' . esc_attr($_GET['post_type']) . '" />';
		}

		if (!empty($_GET['product_cat'])) {
			$fields .= '<input type="hidden" name="product_cat" value="' . esc_attr($_GET['product_cat']) . '" />';
		}

		if (!empty($_GET['product_tag'])) {
			$fields .= '<input type="hidden" name="product_tag" value="' . esc_attr($_GET['product_tag']) . '" />';
		}

		if (!empty($_GET['orderby'])) {
			$fields .= '<input type="hidden" name="orderby" value="' . esc_attr($_GET['orderby']) . '" />';
		}

		if (!empty($_GET['min_rating'])) {
			$fields .= '<input type="hidden" name="min_rating" value="' . esc_attr($_GET['min_rating']) . '" />';
		}

		if ($_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes()) {
			foreach ($_chosen_attributes as $attribute => $data) {
				$taxonomy_filter = 'filter_' . str_replace('pa_', '', $attribute);

				$fields .= '<input type="hidden" name="' . esc_attr($taxonomy_filter) . '" value="' . esc_attr(implode(',', $data['terms'])) . '" />';

				if ('or' == $data['query_type']) {
					$fields .= '<input type="hidden" name="' . esc_attr(str_replace('pa_', 'query_type_', $attribute)) . '" value="or" />';
				}
			}
		}

		// Find min and max price in current result set
		$prices = babystreet_get_filtered_price();

		$min_from_result_set = floor($prices->min_price);
		$max_from_result_set = ceil($prices->max_price);

		if(!is_numeric($min_price)) {
			$min_price = $min_from_result_set;
		}
		if(!is_numeric($max_price)) {
			$max_price = $max_from_result_set;
		}

		if ($min_from_result_set === $max_from_result_set) {
			return;
		}

		if ('' === get_option('permalink_structure')) {
			$form_action = remove_query_arg(array('page', 'paged'), add_query_arg($wp->query_string, '', home_url($wp->request)));
		} else {
			$form_action = preg_replace('%\/page/[0-9]+%', '', home_url(trailingslashit($wp->request)));
		}

		echo '<form id="babystreet-price-filter-form" data-currency_pos="' . esc_attr(get_option('woocommerce_currency_pos')) . '" data-currency_symbol="' . esc_attr(get_woocommerce_currency_symbol()) . '"  method="get" action="' . esc_url($form_action) . '">
									<div id="price-filter" class="price_slider_wrapper">
										<div class="price_slider_amount">
                                                <input type="hidden" id="min_price" name="min_price" value="' . esc_attr($min_price) . '" data-min="' . esc_attr($min_from_result_set) . '" placeholder="' . esc_attr__('Min price', 'babystreet') . '" />
												<input type="hidden" id="max_price" name="max_price" value="' . esc_attr($max_price) . '" data-max="' . esc_attr($max_from_result_set) . '" placeholder="' . esc_attr__('Max price', 'babystreet') . '" />
												<div class="price_label">
														<p>
																' . esc_html__('Price range:', 'babystreet') . ' <span id="babystreet_price_range"><span class="from"></span> &mdash; <span class="to"></span></span>
														</p>
												</div>
												' . $fields . '
												<div class="clear"></div>
										</div>
										<div class="price_slider"></div>
								</div>
						</form>';
	}

}

if (!function_exists('babystreet_get_filtered_price')) {

	function babystreet_get_filtered_price() {
		global $wpdb;

		$args = wc()->query->get_main_query()->query_vars;
		$tax_query = isset($args['tax_query']) ? $args['tax_query'] : array();
		$meta_query = isset($args['meta_query']) ? $args['meta_query'] : array();

		if ( ! is_post_type_archive( 'product' ) && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
			$tax_query[] = array(
					'taxonomy' => $args['taxonomy'],
					'terms' => array($args['term']),
					'field' => 'slug',
			);
		}

		foreach ( $meta_query + $tax_query as $key => $query ) {
			if (!empty($query['price_filter']) || !empty($query['rating_filter'])) {
				unset($meta_query[$key]);
			}
		}

		$meta_query = new WP_Meta_Query($meta_query);
		$tax_query = new WP_Tax_Query($tax_query);

		$meta_query_sql = $meta_query->get_sql('post', $wpdb->posts, 'ID');
		$tax_query_sql = $tax_query->get_sql($wpdb->posts, 'ID');

		$sql  = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
		$sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
		$sql .= " 	WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
					AND {$wpdb->posts}.post_status = 'publish'
					AND price_meta.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
					AND price_meta.meta_value > '' ";
		$sql .= $tax_query_sql['where'] . $meta_query_sql['where'];
		if ( $search = WC_Query::get_main_search_query_sql() ) {
			$sql .= ' AND ' . $search;
		}

		return $wpdb->get_row($sql);
	}

}

add_action('woocommerce_after_shop_loop', 'babystreet_wrap_after_shop_loop', 5);
if (!function_exists('babystreet_wrap_after_shop_loop')) {

	function babystreet_wrap_after_shop_loop() {
		echo '</div>'; // closes box-products
		echo '</div>'; // closes box-products container
	}

}
add_action('woocommerce_after_shop_loop', 'babystreet_shop_sidebar', 15);
if (!function_exists('babystreet_shop_sidebar')) {

	function babystreet_shop_sidebar() {
		echo '</div>'; // closes content_holder
		if (babystreet_get_option('show_sidebar_shop')) {
			do_action('woocommerce_sidebar');
			echo '<div class="clear"></div>';
		}
	}

}

// Disable the redirect on single search result
add_filter( 'woocommerce_redirect_single_search_result', '__return_false' );

add_action('woocommerce_before_shop_loop', 'babystreet_wrap_before_shop_loop_after', 60);
if (!function_exists('babystreet_wrap_before_shop_loop_after')) {

	function babystreet_wrap_before_shop_loop_after() {
		$shop_default_product_columns = babystreet_get_option('shop_default_product_columns');

		$uri_parts = explode('?', esc_url_raw($_SERVER['REQUEST_URI']), 2); // Reading only. Stripped to domain name. Used for redirection.

		$post_type_url_param = isset($_GET['post_type']) ? esc_attr($_GET['post_type']) : '';
		$babystreet_search_query = get_search_query();
		$reset_params_to_keep = '';
		if($babystreet_search_query && $post_type_url_param) {
			$reset_params_to_keep = '?s='.$babystreet_search_query.'&post_type='.$post_type_url_param;
		} elseif ($babystreet_search_query) {
			$reset_params_to_keep = '?s='.$babystreet_search_query;
		} elseif ($post_type_url_param) {
			$reset_params_to_keep = '?post_type='.$post_type_url_param;
		}

		$babystreet_reset_filter_url = $uri_parts[0];
		if($reset_params_to_keep) {
			$babystreet_reset_filter_url .= $reset_params_to_keep;
		}

		if (babystreet_get_option('show_refine_area') && woocommerce_products_will_display()) {
		    // Define widget area here for filters
			if(is_active_sidebar('babystreet_product_filters_sidebar')) {
				echo '<div class="babystreet-filter-widgets-holder">';
                    echo '<div id="babystreet-filter-widgets" '. ( 'opened' == babystreet_get_option('refine_area_state') ? 'class="babystreet_active_filter_area"' : '' ) .' >';
                    dynamic_sidebar('babystreet_product_filters_sidebar');
                    echo '</div>';
                    echo '<a href="'.esc_url($babystreet_reset_filter_url).'" data-babystreet_reset_query="'.esc_js($reset_params_to_keep).'" class="babystreet-reset-filters">'.esc_html__('Reset All Filters', 'babystreet').'</a>';
				echo '</div>';
			}

			echo '<div class="clear"></div>';
			echo '</div>';
			echo '</div>';
		}

		echo '<div class="box-product-list">';
		echo '<div class="box-products woocommerce ' . esc_attr($shop_default_product_columns) . '">';
	}

}

// Changing products per page
add_filter('loop_shop_per_page', 'babystreet_set_products_per_page', 20);

if (!function_exists('babystreet_set_products_per_page')) {

	function babystreet_set_products_per_page() {
		$per_page = babystreet_get_option('products_per_page');
		if (array_key_exists('per_page', $_GET)) {
			$per_page = esc_attr($_GET['per_page']);
		}

		return $per_page;
	}

}

/**
 * Return the start and end sales dates for product on sale
 * If not on sale, return false
 *
 * @param type $post
 * @return boolean
 */
if (!function_exists('babystreet_get_product_sales_dates')) {

	function babystreet_get_product_sales_dates($post) {
		/** @var $product WC_Product */
		$start_sales_date = 9999999999;
		$end_sales_date = 0;

		$product = wc_get_product($post);
		if (!$product || !$product->is_on_sale())
			return false;

		$child_products = $product->get_children();
// If is variation product
		if (count($child_products)) {
			foreach ($child_products as $child_id) {
				$sale_price_dates_from = get_post_meta($child_id, '_sale_price_dates_from', true);
				$sale_price_dates_to = get_post_meta($child_id, '_sale_price_dates_to', true);

				if ($sale_price_dates_from && $sale_price_dates_from < $start_sales_date) {
					$start_sales_date = $sale_price_dates_from;
				}

				if ($sale_price_dates_to && $sale_price_dates_to > $end_sales_date) {
					$end_sales_date = $sale_price_dates_to;
				}
			}
		} else {
			$start_sales_date = get_post_meta($post->ID, '_sale_price_dates_from', true);
			$end_sales_date = get_post_meta($post->ID, '_sale_price_dates_to', true);
		}

		return array('from' => $start_sales_date, 'to' => $end_sales_date);
	}

}

// Show countdown for sales on product list
if (!function_exists('babystreet_shop_sale_countdown')) {

	function babystreet_shop_sale_countdown() {
		/**
		 * @var WC_Product $product
		 */
		global $post, $product;

		$sales_dates = babystreet_get_product_sales_dates($post);
		$now = time();

		if (babystreet_get_option('use_countdown', 'enabled') == 'enabled' && $product->is_on_sale() && $sales_dates['to'] && $now < $sales_dates['to']) {
			$random_num = uniqid();
			?>
			<div class="count_holder_small" data-countdown-id="<?php echo esc_js('#babystreetCountSmallLatest'.$post->ID . $random_num)?>" data-countdown-to="<?php echo esc_js(date('F j, Y G:i:s', $sales_dates['to'])) ?>">
                <div class="count_info"><?php esc_html_e('Offer ends in', 'babystreet') ?>:</div>
				<div id="babystreetCountSmallLatest<?php echo esc_attr($post->ID . $random_num) ?>"></div>
				<div class="clear"></div>
			</div>
			<?php
		}
	}

}

// Show countdown for sales on the product page
add_filter('woocommerce_single_product_summary', 'babystreet_product_sale_countdown', 8);

if (!function_exists('babystreet_product_sale_countdown')) {

	function babystreet_product_sale_countdown() {
		global $post, $product;

		$sales_dates = babystreet_get_product_sales_dates($post);
		$now = time();

		if (babystreet_get_option('use_countdown', 'enabled') == 'enabled' && $product->is_on_sale() && $sales_dates['to'] && $now < $sales_dates['to']) {
			$unique_id = uniqid('babystreet_sale_countdown');
			?>
            <script>
                <!--
                jQuery(function () { jQuery('#<?php echo esc_attr($unique_id)?>').countdown({until: new Date("<?php echo esc_js(date('F j, Y G:i:s', $sales_dates['to']))?>"), compact: false, layout: '<span class="countdown_time_tiny">{dn} {dl} {hn}:{mnn}:{snn}</span>'});});
                // -->
            </script>
			<div class="count_holder"> <span class="offer_title"><?php esc_html_e('Offer ends in', 'babystreet') ?>:</span>
				<div id="<?php echo esc_attr($unique_id) ?>"></div>
				<div class="clear"></div>
			</div>
			<?php
		}
	}

}

// Wrap cart with div before
add_filter('woocommerce_before_cart_table', 'babystreet_wrap_cart_before', 10);

if (!function_exists('babystreet_wrap_cart_before')) {

	function babystreet_wrap_cart_before() {
		echo '<div class="cart-info">';
	}

}

// Wrap cart with div after
add_filter('woocommerce_after_cart_table', 'babystreet_wrap_cart_after', 10);

if (!function_exists('babystreet_wrap_cart_after')) {

	function babystreet_wrap_cart_after() {
		echo '</div>';
	}

}

// Ensure cart contents update when products are added to the cart via AJAX
add_filter('woocommerce_add_to_cart_fragments', 'babystreet_header_add_to_cart_fragment');
if (!function_exists('babystreet_header_add_to_cart_fragment')) {

	function babystreet_header_add_to_cart_fragment($fragments) {
		ob_start();

		babystreet_cart_link();

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}

}

/**
 * Override woocommerce_taxonomy_archive_description
 * Show an archive description on taxonomy archives
 *
 * @return void
 */
function woocommerce_taxonomy_archive_description() {
	if (is_tax(array('product_cat', 'product_tag')) && get_query_var('paged') == 0) {
		$description = wpautop(do_shortcode(term_description()));

		$thumbnail_id = get_metadata( 'woocommerce_term', get_queried_object()->term_id, 'thumbnail_id', true );
		$image = wp_get_attachment_url($thumbnail_id);

		if ($description || $image) {
			if ($image) {
				$output = '<img class="pic-cat-main" src="' . esc_url($image) . '" alt="' . esc_attr(single_term_title('', false)) . '" />' . $description;
			} else {
				$output = $description;
			}

			echo '<div class="term-description fixed">' . $output . '</div>';
		}
	}
}

/**
 * Override the woocommerce function
 * Show a shop page description on product archives
 *
 * @subpackage	Archives
 */
function woocommerce_product_archive_description() {
	if (is_post_type_archive('product') && get_query_var('paged') == 0) {
		$shop_page = get_post(wc_get_page_id('shop'));
		if ($shop_page) {
			$description = wc_format_content($shop_page->post_content);
			if ($description) {
				echo '<div class="page-description fixed">' . $description . '</div>';
			}
		}
	}
}

// Override Woocommerce Compare add link
// if Woocompare is activated
if (defined('YITH_WOOCOMPARE')) {
	global $yith_woocompare;

	$woocompareFrontEnd = $yith_woocompare->obj;
	remove_action('woocommerce_after_shop_loop_item', array($woocompareFrontEnd, 'add_compare_link'), 20);

	if (!function_exists('babystreet_add_compare_link')) {

		function babystreet_add_compare_link($product_id = false, $args = array()) {
			extract($args);

			global $yith_woocompare;
			$woocompareFrontEnd = $yith_woocompare->obj;

			if (!method_exists($woocompareFrontEnd, 'add_product_url')) {
				return false;
			}

			if (!$product_id) {
				global $product;
				$product_id = ($product->get_id()) && $product->exists() ? $product->get_id() : 0;
			}

			// return if product doesn't exist
			if (empty($product_id)) {
				return;
			}

			$is_button = !isset($button_or_link) || !$button_or_link ? get_option('yith_woocompare_is_button') : $button_or_link;

			if (!isset($button_text) || $button_text == 'default') {
				$button_text = get_option('yith_woocompare_button_text', esc_html__('Compare', 'babystreet'));
				$button_text = function_exists('icl_translate') ? icl_translate('Plugins', 'plugin_yit_compare_button_text', $button_text) : $button_text;
			}

			printf('<a href="%s" class="%s" data-product_id="%d" title="%s"><i class="fa fa-tasks"></i></a>', esc_url($woocompareFrontEnd->add_product_url($product_id)), 'compare' . ( $is_button == 'button' ? ' button' : '' ), esc_attr($product_id), esc_attr($button_text));
		}

	}
}

// Move woocommerce_template_loop_price to be below the title
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

// If related products are set to zero hide them
if(babystreet_get_option('number_related_products') == 0) {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

add_filter('woocommerce_output_related_products_args', 'babystreet_related_products_args');
if (!function_exists('babystreet_related_products_args')) {

	/**
	 * WooCommerce Extra Feature
	 * --------------------------
	 *
	 * Change number of related products on product page
	 * Set your own value for 'posts_per_page'
	 *
	 */
	function babystreet_related_products_args($args) {

		$args['posts_per_page'] = babystreet_get_option('number_related_products'); // number_related_products theme option
		$args['columns'] = 1; // arranged in 1 columns

		return $args;
	}

}

add_action('woocommerce_before_single_product_summary', 'babystreet_add_this_share', 99);
if (!function_exists('babystreet_add_this_share')) {

	/**
	 * Display share links on product pages
	 */
	function babystreet_add_this_share() {
		if (function_exists('babystreet_share_links')) {
			babystreet_share_links( the_title_attribute( 'echo=0' ), get_permalink());
		}
	}

}

/**
 * Cart Link
 * Displayed a link to the cart including the number of items present and the cart total
 * @param  array $settings Settings
 * @return array           Settings
 */
if (!function_exists('babystreet_cart_link')) {

	function babystreet_cart_link() {
		if (is_cart()) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<li class="<?php echo sanitize_html_class($class); ?>">
			<a id="babystreet_quick_cart_link" class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'babystreet'); ?>">
				<span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
			</a>
		</li>
		<?php
	}

}

// Quickview ajax actions
if (!function_exists('babystreet_quickview')) {

	function babystreet_quickview() {
		global $post, $product, $authordata;
		$prod_id = esc_attr($_POST["productid"]);
		$post = get_post($prod_id);
		$product = wc_get_product($prod_id);
		$authordata = get_userdata($post->post_author);

		Babystreet_WCVS();
		Babystreet_WC_Variation_Swatches_Frontend::instance();

		if(function_exists('YITH_WCWL_Init')) {
			$wishlist = YITH_WCWL_Init();
			$wishlist->add_button();
		}

		// We also need the wp.template for this script :)
		wc_get_template( 'single-product/add-to-cart/variation.php' );
		wc_get_template('content-single-product-babystreet-quickview.php');

		wp_die();
	}

}

add_action('wp_ajax_babystreet_quickview', 'babystreet_quickview');
add_action('wp_ajax_nopriv_babystreet_quickview', 'babystreet_quickview');

// Move description before title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );

// Ajax add to cart on product single
if (!function_exists('babystreet_wc_add_cart_ajax')) {
	function babystreet_wc_add_cart_ajax() {

		$wc_notices = WC()->session->get('wc_notices');
		WC()->session->set('wc_notices', array());

		if ( is_array( $wc_notices ) ) {
			foreach ( $wc_notices as $notice => $notice_message ) {
				if ( $notice === 'error' ) {
					// regex to remove html tags and content
					$regex         = '/<[^>]*>[^<]*<[^>]*>/';
					$alert_message = html_entity_decode( preg_replace( $regex, '', $notice_message[0] ) );
					$response      = array(
						'error_message' => $alert_message
					);

					wp_send_json( $response );
				}
			}
		}

		WC_AJAX::get_refreshed_fragments();

		wp_die();
	}
}

add_action('wp_ajax_babystreet_wc_add_cart', 'babystreet_wc_add_cart_ajax');
add_action('wp_ajax_nopriv_babystreet_wc_add_cart', 'babystreet_wc_add_cart_ajax');

// Force variable attributes to show below the product
add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );

// Specifically for Babystreet, for the gallery images use the main image size as flexslider is disabled
add_filter( 'woocommerce_gallery_image_size', function () {
	return 'woocommerce_single';
} );

if(babystreet_get_option('only_free_delivery')) {
	add_filter( 'woocommerce_package_rates', 'babystreet_hide_shipping_when_free_is_available', 100 );
}

if (!function_exists('babystreet_hide_shipping_when_free_is_available')) {
	/**
	 * Hide shipping rates when free shipping is available.
	 * Updated to support WooCommerce 2.6 Shipping Zones.
	 *
	 * @param array $rates Array of rates found for the package.
	 *
	 * @return array
	 */
	function babystreet_hide_shipping_when_free_is_available( $rates ) {
		$free = array();
		foreach ( $rates as $rate_id => $rate ) {
			if ( 'free_shipping' === $rate->method_id ) {
				$free[ $rate_id ] = $rate;
				break;
			}
		}

		return ! empty( $free ) ? $free : $rates;
	}
}

// Move single product sale flash to summary section
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 1);

// WooCommerce single product gallery type
add_action('wp', 'babystreet_apply_effective_gallery_type_setting' );
if (!function_exists( 'babystreet_apply_effective_gallery_type_setting' )) {
	function babystreet_apply_effective_gallery_type_setting() {
		$effective_gallery_type_setting = babystreet_get_effective_gallery_type_setting();

		if(in_array($effective_gallery_type_setting, array('image_list', 'mosaic_images'))) {
		    remove_theme_support('wc-product-gallery-zoom');
		    remove_theme_support('wc-product-gallery-slider');
        }
	}
}

if (!function_exists( 'babystreet_get_gallery_type_classes' )) {
	function babystreet_get_gallery_type_classes() {
		$effective_gallery_type_setting = babystreet_get_effective_gallery_type_setting();
		$classes = array();

		switch ($effective_gallery_type_setting) {
			case 'woo_default':
				$classes[] = 'babystreet-standard-product-gallery';
				break;
			case 'image_list':
				$classes[] = 'babystreet-image-list-product-gallery';
				break;
			case 'mosaic_images':
				$classes[] = 'babystreet-image-list-product-gallery';
				$classes[] = 'babystreet-mosaic-gallery';
				break;
		}

		return $classes;
	}
}

if (!function_exists( 'babystreet_get_effective_gallery_type_setting' )) {
	function babystreet_get_effective_gallery_type_setting() {
		global $post;

		$per_product_gallery_type_setting = '';
		$global_gallery_type_setting = babystreet_get_option('single_product_gallery_type');

		if(is_product()) {
			$per_product_gallery_type_setting = get_post_meta($post->ID, 'babystreet_single_product_gallery_type', true);
		}

		if($per_product_gallery_type_setting && $per_product_gallery_type_setting != 'default') {
			$effective_gallery_type_setting = $per_product_gallery_type_setting;
		} else {
			$effective_gallery_type_setting = $global_gallery_type_setting;
		}

		return $effective_gallery_type_setting;
	}
}

add_action('woocommerce_before_add_to_cart_form', 'babystreet_add_to_cart_separator', 99);
if (!function_exists( 'babystreet_add_to_cart_separator' )) {
	function babystreet_add_to_cart_separator() {
        echo '<span class="babystreet-separator"></span>';
	}
}

// Move ratings a bit so we have place for countdown and promo between price and rating
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 7 );