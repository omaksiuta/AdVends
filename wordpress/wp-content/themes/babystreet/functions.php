<?php
/* Load core functions */
require_once (get_template_directory() . '/incl/system/core-functions.php');

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/*
 * Loads the Options Panel
 */
if (!function_exists('babystreet_optionsframework_init')) {
	define('BABYSTREET_OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/incl/babystreet-options-framework/');
	// framework
	require_once get_template_directory() . '/incl/babystreet-options-framework/babystreet-options-framework.php';
	// custom functions
	require_once get_template_directory() . '/incl/babystreet-options-framework/babystreet-options-functions.php';
}

/* Load configuration */
require_once (get_template_directory() . '/incl/system/config.php');

/**
 * Echo the pagination
 */
if (!function_exists('babystreet_pagination')) {

	function babystreet_pagination($pages = '', $wp_query = '') {
		if (empty($wp_query)) {
			global $wp_query;
		}

		$range = 3;
		$posts_per_page = get_query_var('posts_per_page');
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		$html = '';

		if ($pages == '') {

			if (isset($wp_query->max_num_pages)) {
				$pages = $wp_query->max_num_pages;
			}

			if (!$pages) {
				$pages = 1;
			}
		}

		if (1 != $pages) {
			$html .= "<div class='pagination'><div class='links'>";
			if ($paged > 2) {
				$html .= "<a href='" . esc_url(get_pagenum_link(1)) . "'>&laquo;</a>";
			}
			if ($paged > 1) {
				$html .= "<a class='prev_page' href='" . esc_url(get_pagenum_link($paged - 1)) . "'>&lsaquo;</a>";
			}

			for ($i = 1; $i <= $pages; $i++) {
				if (1 != $pages && (!( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) )) {
					$class = ( $paged == $i ) ? " class='selected'" : '';
					$html .= "<a href='" . esc_url(get_pagenum_link($i)) . "'$class >$i</a>";
				}
			}

			if ($paged < $pages) {
				$html .= "<a class='next_page' href='" . esc_url(get_pagenum_link($paged + 1)) . "'>&rsaquo;</a>";
			}
			if ($paged < $pages - 1) {
				$html .= "<a href='" . esc_url(get_pagenum_link($pages)) . "'>&raquo;</a>";
			}

			$first_article_on_page = ($posts_per_page * $paged ) - $posts_per_page + 1;

			$last_article_on_page = min($wp_query->found_posts, $wp_query->get('posts_per_page') * $paged);

			$html .= "</div><div class='results'>";
			$html .= sprintf(esc_html__('Showing %1$s to %2$s of %3$s (%4$s Pages)', 'babystreet'), $first_article_on_page, $last_article_on_page, $wp_query->found_posts, $pages);
			$html .= "</div></div>";
		}

		echo apply_filters('babystreet_pagination', $html);
	}

}

/**
 * Return the page breadcrumbs
 *
 */
if ( ! function_exists( 'babystreet_breadcrumb' ) ) {

	function babystreet_breadcrumb( $delimiter = ' <span class="babystreet-breadcrumb-delimiter">/</span> ' ) {

		if ( babystreet_get_option( 'show_breadcrumb', 1 ) && ! is_404() ) {
			$home      = esc_html__( 'Home', 'babystreet' ); // text for the 'Home' link
			$before    = '<span class="current-crumb">'; // tag before the current crumb
			$after     = '</span>'; // tag after the current crumb
			$brdcrmb   = '';

			global $post;
			global $wp_query;
			$homeLink = esc_url(babystreet_wpml_get_home_url());

			if ( ! is_home() && ! is_front_page() ) {
				$brdcrmb .= '<a class="home" href="' . esc_url( $homeLink ) . '">' . $home . '</a> ' . $delimiter . ' ';
			}

			if ( is_category() ) {
				$cat_obj   = $wp_query->get_queried_object();
				$thisCat   = $cat_obj->term_id;
				$thisCat   = get_category( $thisCat );
				$parentCat = get_category( $thisCat->parent );

				if ( $thisCat->parent != 0 ) {
					$brdcrmb .= get_category_parents( $parentCat, true, ' ' . $delimiter . ' ' );
				}

				$brdcrmb .= $before . single_cat_title( '', false ) . $after;
				/* If is taxonomy or BBPress topic tag */
			} elseif ( is_tax() || get_query_var( 'bbp_topic_tag' ) ) {
				$cat_obj   = $wp_query->get_queried_object();
				$thisCat   = $cat_obj->term_id;
				$thisCat   = get_term( $thisCat, $cat_obj->taxonomy );
				$parentCat = get_term( $thisCat->parent, $cat_obj->taxonomy );
				$tax_obj   = get_taxonomy( $cat_obj->taxonomy );
				$brdcrmb .= $tax_obj->labels->name . ': ';

				if ( $thisCat->parent != 0 ) {
					$brdcrmb .= babystreet_get_taxonomy_parents( $parentCat, $cat_obj->taxonomy, true, ' ' . $delimiter . ' ' );
				}
				$brdcrmb .= $before . $thisCat->name . $after;
			} elseif ( is_day() ) {
				$brdcrmb .= '<a class="no-link" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
				$brdcrmb .= '<a class="no-link" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . get_the_time( 'F' ) . '</a> ' . $delimiter . ' ';
				$brdcrmb .= $before . get_the_time( 'd' ) . $after;
			} elseif ( is_month() ) {
				$brdcrmb .= '<a class="no-link" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
				$brdcrmb .= $before . get_the_time( 'F' ) . $after;
			} elseif ( is_year() ) {
				$brdcrmb .= $before . get_the_time( 'Y' ) . $after;
			} elseif ( is_single() && ! is_attachment() ) {
				if ( get_post_type( $wp_query->post->ID ) == 'babystreet-portfolio' ) {

					$post_type = get_post_type_object( 'babystreet-portfolio' );
					$brdcrmb .= '<a class="no-link" href="' . esc_url( get_post_type_archive_link('babystreet-portfolio') ) . '">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';

					$terms = get_the_terms( $post->ID, 'babystreet_portfolio_category' );

					if ( $terms ) {
						$first_cat       = reset( $terms );
						$parent_term_ids = babystreet_get_babystreet_portfolio_category_parents( $first_cat->term_id );

						$term_links = '';
						foreach ( $parent_term_ids as $term_id ) {
							$term = get_term( $term_id, 'babystreet_portfolio_category' );
							$term_links .= '<a href="' . esc_url( get_term_link( $term_id ) ) . '">' . $term->name . '</a>' . $delimiter;
						}

						$brdcrmb .= $term_links;
					}

					$brdcrmb .= $before . get_the_title( $wp_query->post->ID ) . $after;
				} elseif ( get_post_type( $wp_query->post->ID ) != 'post' ) {
					$post_type = get_post_type_object( get_post_type( $wp_query->post->ID ) );
					$slug      = $post_type->rewrite;
					$real_slug = $slug['slug'];
					if ( $slug['slug'] == 'forums/forum' ) {
						$real_slug = 'forums';
					}
					if ( function_exists( 'bbp_is_single_topic' ) && bbp_is_single_topic() ) { // If is Topic
						if ( is_singular() ) {
							$ancestors = array_reverse( (array) get_post_ancestors( $wp_query->post->ID ) );
							// Ancestors exist
							if ( ! empty( $ancestors ) ) {
								// Loop through parents
								foreach ( (array) $ancestors as $parent_id ) {
									// Parents
									$parent = get_post( $parent_id );
									// Skip parent if empty or error
									if ( empty( $parent ) || is_wp_error( $parent ) ) {
										continue;
									}
									// Switch through post_type to ensure correct filters are applied
									switch ( $parent->post_type ) {
										// Forum
										case bbp_get_forum_post_type() :
											$crumbs[] = '<a href="' . esc_url( bbp_get_forum_permalink( $parent->ID ) ) . '" >' . bbp_get_forum_title( $parent->ID ) . '</a>';
											break;
										// Topic
										case bbp_get_topic_post_type() :
											$crumbs[] = '<a href="' . esc_url( bbp_get_topic_permalink( $parent->ID ) ) . '" >' . bbp_get_topic_title( $parent->ID ) . '</a>';
											break;
										// Reply (Note: not in most themes)
										case bbp_get_reply_post_type() :
											$crumbs[] = '<a href="' . esc_url( bbp_get_reply_permalink( $parent->ID ) ) . '" >' . bbp_get_reply_title( $parent->ID ) . '</a>';
											break;
										// WordPress Post/Page/Other
										default :
											$crumbs[] = '<a href="' . esc_url( get_permalink( $parent->ID ) ) . '" >' . get_the_title( $parent->ID ) . '</a>';
											break;
									}
								}

								// Edit topic tag
							}
						}

						$page = bbp_get_page_by_path( bbp_get_root_slug() );
						if ( ! empty( $page ) ) {
							$root_url = get_permalink( $page->ID );

							// Use the root slug
						} else {
							$root_url = get_post_type_archive_link( bbp_get_forum_post_type() );
						}

						$brdcrmb .= '<a class="no-link" href="' . esc_url( $root_url ) . '">' . esc_html__( 'Forums', 'babystreet' ) . '</a> ' . $delimiter . ' ';
						foreach ( $crumbs as $crumb ) {
							$brdcrmb .= $crumb . ' ' . $delimiter;
						}

					} elseif ( ! in_array( $post_type->name, array( 'tribe_venue', 'tribe_organizer' ) ) ) {
						$brdcrmb .= '<a class="no-link" href="' . esc_url( $homeLink . '/' . $real_slug ) . '/">' . $post_type->labels->name . '</a> ' . $delimiter . ' ';
					} else {
						$brdcrmb .= '<span>' . $post_type->labels->name . '</span> ' . $delimiter . ' ';
					}

					$brdcrmb .= $before . get_the_title( $wp_query->post->ID ) . $after;
				} else {
					$cat = get_the_category();
					$cat = $cat[0];
					$brdcrmb .= get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
					$brdcrmb .= $before . get_the_title( $wp_query->post->ID ) . $after;
				}
			} elseif ( ! is_single() && ! is_page() && ! is_404() && ! is_search() && get_post_type( $wp_query->post->ID ) != 'post') {
				$post_type = get_post_type_object( get_post_type( $wp_query->post->ID ) );
				if ( $post_type ) {
					$brdcrmb .= $before . $post_type->labels->singular_name . $after;
				}
			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				$cat    = get_the_category( $parent->ID );
				if ( ! empty( $cat ) ) {
					$cat         = $cat[0];
					$cat_parents = get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
					if ( ! is_wp_error( $cat_parents ) ) {
						$brdcrmb .= get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
					}
				}
				$brdcrmb .= '<a class="no-link" href="' . esc_url( get_permalink( $parent ) ) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
				$brdcrmb .= $before . get_the_title( $wp_query->post->ID ) . $after;
			} elseif ( is_page() && ! $post->post_parent ) {
				$brdcrmb .= $before . ucfirst( strtolower( get_the_title( $wp_query->post->ID ) ) ) . $after;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id   = $post->post_parent;
				$breadcrumbs = array();

				while ( $parent_id ) {
					$page          = get_post( $parent_id );
					$breadcrumbs[] = '<a class="no-link" href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a>';
					$parent_id     = $page->post_parent;
				}

				$breadcrumbs = array_reverse( $breadcrumbs );
				foreach ( $breadcrumbs as $crumb ) {
					$brdcrmb .= $crumb . ' ' . $delimiter . ' ';
				}

				$brdcrmb .= $before . get_the_title( $wp_query->post->ID ) . $after;
			} elseif ( is_search() ) {
				$brdcrmb .= $before . 'Search results for "' . get_search_query() . '"' . $after;
			} elseif ( is_tag() ) {
				$brdcrmb .= $before . 'Posts tagged "' . single_tag_title( '', false ) . '"' . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				$brdcrmb .= $before . 'Articles posted by ' . esc_attr( $userdata->display_name ) . $after;
			} elseif ( is_404() ) {
				$brdcrmb .= $before . 'Error 404' . $after;
			}

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					$brdcrmb .= ' (';
				}

				$brdcrmb .= $before . esc_html__( 'Page', 'babystreet' ) . ' ' . get_query_var( 'paged' ) . $after;

				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					$brdcrmb .= ')';
				}
			}

			if ( $brdcrmb ) {
				echo '<div class="breadcrumb">';
				echo wp_kses_post( $brdcrmb );
				echo '</div>';
			}
		} else {
			return false;
		}
	}

}

/**
 * Template for comments and pingbacks.
 */
if (!function_exists('babystreet_comment')) {

	function babystreet_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type) {
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
					<p><?php esc_html_e('Pingback:', 'babystreet'); ?> <?php comment_author_link(); ?><?php edit_comment_link(esc_html__('Edit', 'babystreet'), '<span class="edit-link">', '</span>'); ?></p>
					<?php
					break;
				default :
					?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<div id="comment-<?php comment_ID(); ?>" class="comment-body">
						<?php
						$avatar_size = 70;
						echo get_avatar($comment, $avatar_size);
						echo sprintf('<span class="tuser">%s</span>', get_comment_author_link());
						echo sprintf('<span>%1$s</span>',
										/* translators: 1: date, 2: time */ sprintf(esc_html__('%1$s at %2$s', 'babystreet'), get_comment_date(), get_comment_time())
						);
						?>
						<?php edit_comment_link(esc_html__('Edit', 'babystreet'), '<span class="edit-link">', '</span>'); ?>
						<?php if ($comment->comment_approved == '0') : ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'babystreet'); ?></em>
							<br />
						<?php endif; ?>

						<p><?php comment_text(); ?></p>

						<?php comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply', 'babystreet'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

					</div><!-- #comment-## -->

					<?php
					break;
			}
		}

	}

	/*
	 * Add custom image sizes for the babystreet theme blog part
	 */
	if (function_exists('add_image_size')) {
		add_image_size('babystreet-portfolio-single-thumb', 1440); // (not cropped)
		add_image_size('babystreet-640x640', 640, 640, true); //(cropped)
		add_image_size('babystreet-general-small-size', 100, 100, true); //(cropped)
		add_image_size('babystreet-general-small-size-nocrop', 100); // (not cropped)
		add_image_size('babystreet-widgets-thumb', 60, 60, true); //(cropped)
		add_image_size('babystreet-related-posts', 400, 300, true); //(cropped)
	}

	add_filter('wp_prepare_attachment_for_js', 'babystreet_append_image_sizes_js', 10, 3);
	if (!function_exists('babystreet_append_image_sizes_js')) {

		/**
		 * Append the 'babystreet-general-small-size' custom
		 * sizes to the attachment elements returned by the wp.media
		 *
		 * @param type $response
		 * @param type $attachment
		 * @param type $meta
		 * @return string
		 */
		function babystreet_append_image_sizes_js($response, $attachment, $meta) {

			$size_array = array('babystreet-general-small-size');

			foreach ($size_array as $size):

				if (isset($meta['sizes'][$size])) {
					$attachment_url = wp_get_attachment_url($attachment->ID);
					$base_url = str_replace(wp_basename($attachment_url), '', $attachment_url);
					$size_meta = $meta['sizes'][$size];

					$response['sizes'][str_replace('-', '_', $size)] = array(
							'height' => $size_meta['height'],
							'width' => $size_meta['width'],
							'url' => $base_url . $size_meta['file'],
							'orientation' => $size_meta['height'] > $size_meta['width'] ? 'portrait' : 'landscape',
					);
				}

			endforeach;

			return $response;
		}

	}

	add_action('init', 'babystreet_enable_page_attributes');

	/**
	 * Add page attributes to page post type
	 * - Gives option to select template
	 * Adds excerpt support for pages - mainly used by the About widget
	 */
	if (!function_exists('babystreet_enable_page_attributes')) {

		function babystreet_enable_page_attributes() {
			add_post_type_support('page', 'page-attributes');
			add_post_type_support('page', 'excerpt');
		}

	}

	add_filter('template_include', 'babystreet_post_templater');

	/**
	 * Loading custom templates
	 *
	 * @global type $wp_query
	 * @param type $template
	 * @return String
	 */
	if (!function_exists('babystreet_post_templater')) {

		function babystreet_post_templater($template) {
			if (!is_single()) {
				return $template;
			}
			global $wp_query;
			$c_template = get_post_meta($wp_query->post->ID, '_wp_page_template', true);
			return empty($c_template) ? $template : $c_template;
		}

	}

	/**
	 * Display language switcher
	 *
	 * @return String
	 */
	if (!function_exists('babystreet_language_selector_flags')) {

		function babystreet_language_selector_flags() {
			$languages = icl_get_languages('skip_missing=0&orderby=code');

			if (!empty($languages)) {
				foreach ($languages as $l) {
					if (!$l['active']) {
						echo '<a title="' . esc_attr($l['native_name']) . '" href="' . esc_url($l['url']) . '">';
					}

					echo '<img src="' . esc_url($l['country_flag_url']) . '" height="12" alt="' . esc_attr($l['language_code']) . '" width="18" />';

					if (!$l['active']) {
						echo '</a>';
					}
				}
			}
		}

	}

    add_filter('excerpt_more', 'babystreet_new_excerpt_more');
	if (!function_exists('babystreet_new_excerpt_more')) {

		/**
		 * Set custom excerpt more
		 *
		 * @param type $more If is set as 'no_hash' #more keyword is not appended in the url
		 * @return string
		 */
		function babystreet_new_excerpt_more($more) {

			$more_html = '...<a class="r_more_blog" href="';
			if ('no_hash' === $more) {
				$more_html .= esc_url(get_the_permalink());
			} else {
				$more_html .= esc_url(get_the_permalink() . '#more-' . esc_attr(get_the_ID()));
			}

			$more_html .= '"> ' . esc_html__('continue reading', 'babystreet') . '</a>';

			return $more_html;
		}

	}

	/**
	 * Set custom content more link
	 *
	 * @return String
	 */
	add_filter('the_content_more_link', 'babystreet_content_more_link');

	if (!function_exists('babystreet_content_more_link')) {

		function babystreet_content_more_link() {
			return '<a class="r_more_blog" href="' . esc_url(get_permalink() . '#more-' . esc_attr(get_the_ID())) . '"> ' . esc_html__('continue reading', 'babystreet') . '</a>';
		}

	}

	/**
	 * Adds one-half one-third one-forth class to footer widgets
	 */
	if (!function_exists('babystreet_widget_class_append')) {

		function babystreet_widget_class_append($params) {

			$sidebar_id = $params[0]['id']; // Get the id for the current sidebar we're processing

			if ($sidebar_id != 'bottom_footer_sidebar' && $sidebar_id != 'pre_header_sidebar' && $sidebar_id != 'babystreet_product_filters_sidebar') {
				return $params;
			}

			$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets
			$num_widgets_sidebar = count($arr_registered_widgets[$sidebar_id]);
			$class = 'class="';

			switch ($num_widgets_sidebar) {
				case 0:
				case 1:
					break;
				case 2:
					$class .= 'one_half ';
					break;
				case 3:
					$class .= 'one_third ';
					break;
				default:
					$class .= 'one_fourth ';
			}

			if (!isset($arr_registered_widgets[$sidebar_id]) || !is_array($arr_registered_widgets[$sidebar_id])) { // Check if the current sidebar has no widgets
				return $params; // No widgets in this sidebar.
			}

			$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

			return $params;
		}

	}
	add_filter('dynamic_sidebar_params', 'babystreet_widget_class_append');

	if (!function_exists('babystreet_get_babystreet_portfolio_category_parents')) {

		/**
		 * Get list of all parent babystreet_portfolio_category-s
		 *
		 * @param int $term_id
		 * @return Array with term ids
		 */
		function babystreet_get_babystreet_portfolio_category_parents($term_id) {
			$parents = array();
			// start from the current term
			$parent = get_term_by('id', $term_id, 'babystreet_portfolio_category');
			$parents[] = $parent;
			// climb up the hierarchy until we reach a term with parent = '0'
			while ($parent->parent != '0') {
				$term_id = $parent->parent;

				$parent = get_term_by('id', $term_id, 'babystreet_portfolio_category');
				$parents[] = $parent;
			}
			return $parents;
		}

	}

	add_action('wp_ajax_babystreet_ajax_search', 'babystreet_ajax_search');
	add_action('wp_ajax_nopriv_babystreet_ajax_search', 'babystreet_ajax_search');

	if (!function_exists('babystreet_ajax_search')) {

		function babystreet_ajax_search() {

			unset($_REQUEST['action']);
			if (empty($_REQUEST['s'])) {
				$_REQUEST['s'] = array_shift(array_values($_REQUEST));
			}
			if (empty($_REQUEST['s'])) {
				wp_die();
			}

			$defaults = array(
			        'numberposts' => 5,
                    'post_type' => 'any',
                    'post_status' => 'publish',
                    'post_password' => '',
                    'suppress_filters' => false
            );

			$_REQUEST['s'] = apply_filters('get_search_query', $_REQUEST['s']);

			$parameters = array_merge($defaults, $_REQUEST);
			$query = http_build_query($parameters);
			$result = get_posts($query);

			// If there are WC products in the result and visibility is not set for search - remove them
            if(BABYSTREET_IS_WOOCOMMERCE) {
	            foreach ( $result as $key => $post ) {
	                $product = wc_get_product( $post );
		            if ( is_a($product, 'WC_Product') && !('visible' === $product->get_catalog_visibility() || 'search' === $product->get_catalog_visibility()) ) {
                        unset($result[$key]);
		            }
	            }
            }

			$search_messages = array(
					'no_criteria_matched' => esc_html__("Sorry, no posts matched your criteria", 'babystreet'),
					'another_search_term' => esc_html__("Please try another search term", 'babystreet'),
					'time_format' => esc_attr(get_option('date_format')),
					'all_results_query' => http_build_query($_REQUEST),
					'all_results_link' => esc_url(home_url('?' . http_build_query($_REQUEST))),
					'view_all_results' => esc_html__('View all results', 'babystreet')
			);

			if (empty($result)) {
				$output = "<ul>";
				$output .= "<li>";
				$output .= "<span class='ajax_search_unit ajax_not_found'>";
				$output .= "<span class='ajax_search_content'>";
				$output .= "    <span class='ajax_search_title'>";
				$output .= $search_messages['no_criteria_matched'];
				$output .= "    </span>";
				$output .= "    <span class='ajax_search_excerpt'>";
				$output .= $search_messages['another_search_term'];
				$output .= "    </span>";
				$output .= "</span>";
				$output .= "</span>";
				$output .= "</li>";
				$output .= "</ul>";
				echo wp_kses_post($output);
				wp_die();
			}

			// reorder posts by post type
			$output = "";
			$sorted = array();
			$post_type_obj = array();
			foreach ($result as $post) {
				$sorted[$post->post_type][] = $post;
				if (empty($post_type_obj[$post->post_type])) {
					$post_type_obj[$post->post_type] = get_post_type_object($post->post_type);
				}
			}

			//preapre the output
			foreach ($sorted as $key => $post_type) {
				if (isset($post_type_obj[$key]->labels->name)) {
					$label = $post_type_obj[$key]->labels->name;
					$output .= "<h4>" . esc_html($label) . "</h4>";
				} else {
					$output .= "<hr />";
				}

				$output .= "<ul>";

				foreach ($post_type as $post) {
					$image = get_the_post_thumbnail($post->ID, 'babystreet-widgets-thumb');

					$excerpt = "";

					if (!empty($post->post_excerpt)) {
						$excerpt = babystreet_generate_excerpt($post->post_excerpt, 70, " ", "...", true, '', true);
					} else {
						$excerpt = get_the_time($search_messages['time_format'], $post->ID);
					}

					$link = get_permalink($post->ID);

					$output .= "<li>";
					$output .= "<a class ='ajax_search_unit' href='" . esc_url($link) . "'>";
					if ($image) {
						$output .= "<span class='ajax_search_image'>";
						$output .= $image;
						$output .= "</span>";
					}
					$output .= "<span class='ajax_search_content'>";
					$output .= "    <span class='ajax_search_title'>";
					$output .= get_the_title($post->ID);
					$output .= "    </span>";
					$output .= "    <span class='ajax_search_excerpt'>";
					$output .= $excerpt;
					$output .= "    </span>";
					$output .= "</span>";
					$output .= "</a>";
					$output .= "</li>";
				}

				$output .= "</ul>";
			}

			$output .= "<a class='ajax_search_unit ajax_search_unit_view_all' href='" . esc_url($search_messages['all_results_link']) . "'>" . esc_html($search_messages['view_all_results']) . "</a>";

			echo wp_kses_post($output);
			wp_die();
		}

	}

	add_filter('wp_import_post_data_processed', 'babystreet_preserve_post_ids', 10, 2);

	if (!function_exists('babystreet_preserve_post_ids')) {

		/**
		 * WP Import.
		 * Add post id if the record exists
		 *
		 * @param type $postdata
		 * @param type $post
		 * @return Array
		 */
		function babystreet_preserve_post_ids($postdata, $post) {

			if (is_array($post) && isset($post['post_id']) && get_post($post['post_id'])) {
				$postdata['ID'] = $post['post_id'];
			}

			return $postdata;
		}

	}

	/* Define ajax calls for each import */
	for ($i = 0; $i <= 0; $i++) {
		add_action('wp_ajax_babystreet_import_babystreet' . $i, 'babystreet_import_babystreet' . $i . '_callback');
	}

	if (!function_exists('babystreet_import_babystreet0_callback')) {

		/**
		 * Import babystreet0 demo
		 */
		function babystreet_import_babystreet0_callback() {
			@set_time_limit(1200);
			$transfer = Babystreet_Transfer_Content::getInstance();
			$result = $transfer->doImportDemo('babystreet0');

			if ($result) {
				echo 'babystreet_import_done';
			}
		}

	}

	// Replace OF textarea sanitization with babystreet one - in admin_init, because we will allow <script> tag
	add_action('admin_init', 'babystreet_add_script_to_allowed');
	if (!function_exists('babystreet_add_script_to_allowed')) {

		function babystreet_add_script_to_allowed() {
			// Add script to allowed tags only for the logged users - to be able to add tracking code
			global $allowedposttags;
			$allowedposttags['script'] = array('type' => TRUE);
		}

	}

	/**
	 * Returns selected subsets from options to pass to google
	 */
	if (!function_exists('babystreet_get_google_subsets')) {

		function babystreet_get_google_subsets() {
			$selected_subsets = babystreet_get_option('google_subsets');
			$choosen = array();

			foreach ($selected_subsets as $subset => $is_selected) {
				if ($is_selected != '0') {
					$choosen[] = $subset;
				}
			}

			return implode(',', $choosen);
		}

	}

	/**
	 * WPML HOME URL
	 */
	if (!function_exists('babystreet_wpml_get_home_url')) {

		function babystreet_wpml_get_home_url() {
			if (function_exists('icl_get_home_url')) {
				return icl_get_home_url();
			} else {
				return home_url('/');
			}
		}

	}

	// Add classes to body
	add_filter('body_class', 'babystreet_append_body_classes');
	if (!function_exists('babystreet_append_body_classes')) {

		function babystreet_append_body_classes($classes) {
			global $wp_query;

			// the layout class
			$general_layout = babystreet_get_option('general_layout');

			// check is singular and not Blog/Shop/Forum so we get the real post_meta
			if (!(BABYSTREET_IS_WOOCOMMERCE && is_shop()) && !babystreet_is_blog() && !(BABYSTREET_IS_BBPRESS && bbp_is_forum_archive()) && is_singular()) {
				$specific_header_size = get_post_meta($wp_query->post->ID, 'babystreet_header_size', true) == '' ? 'default' : get_post_meta($wp_query->post->ID, 'babystreet_header_size', true);
				$specific_footer_size = get_post_meta($wp_query->post->ID, 'babystreet_footer_size', true) == '' ? 'default' : get_post_meta($wp_query->post->ID, 'babystreet_footer_size', true);
				$specific_footer_style = get_post_meta($wp_query->post->ID, 'babystreet_footer_style', true) == '' ? 'default' : get_post_meta($wp_query->post->ID, 'babystreet_footer_style', true);
				$specific_layout = get_post_meta( $wp_query->post->ID, 'babystreet_layout', true ) == '' ? 'default' : get_post_meta( $wp_query->post->ID, 'babystreet_layout', true );
			} else {
				$specific_header_size = 'default';
				$specific_footer_size = 'default';
				$specific_footer_style = 'default';
				$specific_layout = 'default';
			}

			if ($specific_layout !== 'default') {
				$classes[] = sanitize_html_class($specific_layout);
			} else {
				$classes[] = sanitize_html_class($general_layout);
			}

			// menu position class
			$classes[] = sanitize_html_class( babystreet_get_option( 'main_menu_alignment' ) );

			// header style
			if(isset($wp_query->post->ID)) {
				$is_header_style_meta = get_post_meta( $wp_query->post->ID, 'babystreet_header_syle', true );
			} else {
				$is_header_style_meta = '';
			}
			$is_header_style_blog = babystreet_get_option('blog_header_style');
			$is_header_style_shop = babystreet_get_option('shop_header_style');
			$is_header_style_forum = babystreet_get_option('forum_header_style');
			$is_header_style_events = babystreet_get_option('events_header_style');

			if(BABYSTREET_IS_WOOCOMMERCE && (is_product_category() || is_product_tag())) {
				$is_header_style_shop_category = get_term_meta($wp_query->queried_object_id , 'babystreet_term_header_style', true );
            }

			$header_style_class = '';
			if ($is_header_style_blog && (babystreet_is_blog() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())) {
				$header_style_class = $is_header_style_blog;
			} else if (BABYSTREET_IS_WOOCOMMERCE && is_shop() && $is_header_style_shop) {
				$header_style_class = $is_header_style_shop;
			} else if (BABYSTREET_IS_WOOCOMMERCE && ( is_product_category() || is_product_tag() ) && $is_header_style_shop_category) {
				$header_style_class = $is_header_style_shop_category;
			} else if (BABYSTREET_IS_BBPRESS && bbp_is_forum_archive() && $is_header_style_forum) {
				$header_style_class = $is_header_style_forum;
			} else if (BABYSTREET_IS_EVENTS && babystreet_is_events_part() && !is_singular( 'tribe_events' )) {
				$header_style_class = $is_header_style_events;
			} else if (is_singular()) {
				$header_style_class = $is_header_style_meta;
			}

			if ($header_style_class) {
				// If more than one class stored
				$header_style_class_array = explode(' ', $header_style_class);

				foreach ($header_style_class_array as $class) {
					$classes[] = sanitize_html_class( $class );
				}
			}

			// if no header-top
			if (!babystreet_get_option('enable_top_header')) {
				$classes[] = sanitize_html_class('babystreet-no-top-header');
			}

			// footer reveal
			if (babystreet_get_option('footer_style') && $specific_footer_style === 'default') {
				$classes[] = sanitize_html_class(babystreet_get_option('footer_style'));
			} elseif ($specific_footer_style !== 'standard' && $specific_footer_style !== 'default') {
				$classes[] = sanitize_html_class($specific_footer_style);
			}

			// Header size
			if (babystreet_get_option('header_width') && $specific_header_size === 'default') {
				$classes[] = sanitize_html_class(babystreet_get_option('header_width'));
			} else if ($specific_header_size !== 'standard' && $specific_header_size !== 'default') {
				$classes[] = sanitize_html_class($specific_header_size);
			}

			// Footer size
			if (babystreet_get_option('footer_width') && $specific_footer_size === 'default') {
				$classes[] = sanitize_html_class(babystreet_get_option('footer_width'));
			} else if ($specific_footer_size !== 'standard' && $specific_footer_size !== 'default') {
				$classes[] = sanitize_html_class($specific_footer_size);
			}

			// Sub-menu color Scheme
			if (babystreet_get_option('submenu_color_scheme')) {
				$classes[] = sanitize_html_class(babystreet_get_option('submenu_color_scheme'));
			}

			// If using video background
			if (babystreet_has_to_include_backgr_video()) {
				$classes[] = 'babystreet-page-has-video-background';
			}

			// Shop and Category Pages Width
            if(babystreet_get_option('shop_pages_width')) {
			    $classes[] = babystreet_get_option('shop_pages_width');
            }

			// Blog and Category Pages Width
			if(babystreet_get_option('blog_pages_width')) {
				$classes[] = babystreet_get_option('blog_pages_width');
			}

			// return the $classes array
			return $classes;
		}

	}

	add_filter('wp_setup_nav_menu_item', 'babystreet_setup_nav_menu_item');
	if (!function_exists('babystreet_setup_nav_menu_item')) {

		function babystreet_setup_nav_menu_item($menu_item) {
			if ($menu_item->db_id != 0) {
				$menu_item->description = apply_filters('nav_menu_description', $menu_item->post_content);
			}

			return $menu_item;
		}

	}

	if (!function_exists('babystreet_post_nav')) {

		/**
		 * Returns output for the prev / next links on posts and portfolios
		 *
		 * @param bool|type $same_category
		 * @param string|type $taxonomy
		 * @return string
		 * @global type $wp_version
		 */
		function babystreet_post_nav($same_category = false, $taxonomy = 'category') {
			global $wp_version;
			$excluded_terms = '';

			$type = get_post_type(get_queried_object_id());

			switch ($type) {
                case 'post':
	                $post_type_label = ' '.esc_html__('post', 'babystreet');
	                break;
                case 'product':
                    $post_type_label = ' '.esc_html__('product', 'babystreet');
	                break;
				case 'babystreet-portfolio':
					$post_type_label = ' '.esc_html__('project', 'babystreet');
					break;
                default:
	                $post_type_label = '';
            }

			if (!is_singular() || is_post_type_hierarchical($type)) {
				$is_hierarchical = true;
			}

			if (!empty($is_hierarchical)) {
				return;
			}

			$entries = array();
			$prev_translated_key = esc_html__('prev', 'babystreet');
			$next_translated_key = esc_html__('next', 'babystreet');

			if (version_compare($wp_version, '3.8', '>=')) {
				$entries[$prev_translated_key] = get_previous_post($same_category, $excluded_terms, $taxonomy);
				$entries[$next_translated_key] = get_next_post($same_category, $excluded_terms, $taxonomy);
			} else {
				$entries[$prev_translated_key] = get_previous_post($same_category);
				$entries[$next_translated_key] = get_next_post($same_category);
			}

			$output = "";

			foreach ($entries as $key => $entry) {
				if (empty($entry)) {
					continue;
				}

				$the_title = babystreet_generate_excerpt(get_the_title($entry->ID), 75, " ", " ", true, '', true);
				$link = get_permalink($entry->ID);

				$tc1 = $tc2 = "";

				$output .= "<a class='babystreet-post-nav babystreet-post-{$key} ' href='" . esc_url($link) . "' >";
				$output .= "    <span class='entry-info-wrap'>";
				$output .= "        <span class='entry-info'>";
				$tc1 = "            <span class='entry-title'><small>{$key}{$post_type_label}</small>{$the_title}</span>";
				$output .= $key == $prev_translated_key ? $tc1 . $tc2 : $tc2 . $tc1;
				$output .= "        </span>";
				$output .= "    </span>";
				$output .= "</a>";
			}
			return $output;
		}

	}

	// Disable autoptimize for bbPress pages
	add_filter('autoptimize_filter_noptimize', 'babystreet_bbpress_noptimize', 10, 0);
	if (!function_exists('babystreet_bbpress_noptimize')) {

		function babystreet_bbpress_noptimize() {
			global $post;
			if (function_exists('is_bbpress') && is_bbpress() || (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'bbp-forum-index'))) {
				return true;
			} else {
				return false;
			}
		}

	}

add_action('activate_the-events-calendar/the-events-calendar.php', 'babystreet_set_skeleton_styles_events');

if (!function_exists('babystreet_set_skeleton_styles_events')) {

	/**
	 * Set skeleton styles option upon The Events Calendar plugin activation
	 */
	function babystreet_set_skeleton_styles_events() {
		$events_options = get_option('tribe_events_calendar_options');
		if(is_array($events_options)) {
			$events_options['stylesheetOption'] = 'skeleton';

			update_option('tribe_events_calendar_options', $events_options);
		}
	}
}

// Remove &nbsp from titles
add_filter( 'the_title', 'babystreet_remove_nbsp_from_titles', 10, 2 );
if ( ! function_exists( 'babystreet_remove_nbsp_from_titles' ) ) {
	function babystreet_remove_nbsp_from_titles( $title, $id ) {
		return str_replace( '&nbsp;', ' ', $title );
	}
}

//override date display with the time - ago
add_filter( 'the_time', 'babystreet_convert_to_timeago_date_format', 10, 1 );

if ( ! function_exists( 'babystreet_convert_to_timeago_date_format' ) ) {
	/**
     * Convert to time ago format
     *
	 * @param $orig_time
	 *
	 * @return string
	 */
	function babystreet_convert_to_timeago_date_format( $orig_time ) {
		global $post;
		$post_unix_time = strtotime( $post->post_date );

		if (babystreet_get_option('date_format') == 'babystreet_format' && !babystreet_is_time_more_than_x_months_ago(6, $post_unix_time)) {
			return human_time_diff( $post_unix_time, current_time( 'timestamp' ) ) . ' ' . __( 'ago', 'babystreet' );
		}

		return $orig_time;
	}
}

if ( ! function_exists( 'babystreet_is_time_x_months_ago' ) ) {
	/**
     * Return true if $unix_time is more than $months months ago than current time
     *
	 * @param $months
	 * @param $unix_time
	 *
	 * @return bool
	 */
	function babystreet_is_time_more_than_x_months_ago( $months, $unix_time ) {

		$x_months_ago = strtotime("-".$months." months");

		if ( $unix_time >= $x_months_ago ) {
			return false;
		}

		return true;
	}
}

// Fix All Import template error
add_action('pmxi_saved_post', 'babystreet_remove_page_template', 10, 1);
if ( ! function_exists( 'babystreet_remove_page_template' ) ) {
	function babystreet_remove_page_template( $id ) {
		delete_post_meta( $id, '_wp_page_template' );
	}
}

if ( ! function_exists( 'babystreet_should_show_account_icon' ) ) {
	function babystreet_should_show_account_icon() {
		return (BABYSTREET_IS_WOOCOMMERCE && babystreet_get_option('show_my_account') && get_option( 'woocommerce_myaccount_page_id' ) );
	}
}

if ( ! function_exists( 'babystreet_should_show_wishlist_icon' ) ) {
	function babystreet_should_show_wishlist_icon() {
		return (BABYSTREET_IS_WOOCOMMERCE && BABYSTREET_IS_WISHLIST && babystreet_get_option('show_wish_in_header'));
	}
}

if ( ! function_exists( 'babystreet_build_mobile_menu_items_wrap' ) ) {
	function babystreet_build_mobile_menu_items_wrap() {
		global $post;
		ob_start();
		$current_user = wp_get_current_user();
		?>
        <ul class="babystreet-mobile-menu-tabs">
            <li>
                <a class="babystreet-mobile-menu-tab-link" href="#babystreet_mobile_menu_tab"><?php echo esc_html__('Menu', 'babystreet'); ?></a>
            </li>
	        <?php if (babystreet_should_show_account_icon() && wp_is_mobile() && (is_user_logged_in() || (!is_user_logged_in() && !has_shortcode($post->post_content, 'woocommerce_my_account')))): ?>
                <li>
                    <a class="babystreet-mobile-account-tab-link" href="#babystreet_mobile_account_tab"><?php echo esc_html__('My Account', 'babystreet'); ?></a>
                </li>
			<?php endif; ?>
			<?php if (babystreet_should_show_wishlist_icon()): ?>
                <li>
                    <a class="babystreet-mobile-wishlist" href="<?php echo esc_url(str_replace('%', '%%', YITH_WCWL()->get_wishlist_url())); ?>"><?php echo esc_html__('Wishlist', 'babystreet'); ?></a>
                </li>
			<?php endif; ?>
            <li>
                <a class="mob-close-toggle"></a>
            </li>
        </ul>
        <div id="babystreet_mobile_menu_tab">
            <ul id="%1$s" class="%2$s">%3$s</ul>
        </div>
		<?php if (babystreet_should_show_account_icon() && wp_is_mobile()): ?>
            <div id="babystreet_mobile_account_tab">
				<?php if(is_user_logged_in()): ?>
                    <ul>
                        <li>
                            <span class="babystreet-header-user-data">
                                <?php echo get_avatar($current_user->ID, 60); ?>
                                <small><?php echo esc_html($current_user->display_name); ?></small>
                            </span>
                        </li>
	                    <?php if (BABYSTREET_IS_WC_MARKETPLACE && is_user_wcmp_vendor($current_user)): ?>
                            <li class="babystreet-header-account-wcmp-dash">
			                    <?php $babystreet_wcmp_dashboard_page_link = wcmp_vendor_dashboard_page_id() ? get_permalink(wcmp_vendor_dashboard_page_id()) : '#'; ?>
			                    <?php echo apply_filters('wcmp_vendor_goto_dashboard', '<a href="' . esc_url(str_replace('%', '%%', $babystreet_wcmp_dashboard_page_link)) . '">' . esc_html__('Vendor Dashboard', 'babystreet') . '</a>'); ?>
                            </li>
	                    <?php elseif(BABYSTREET_IS_WC_VENDORS_PRO && WCV_Vendors::is_vendor( $current_user->ID )): ?>
                            <li class="babystreet-header-account-vcvendors-pro-dash">
			                    <?php $babystreet_wcv_pro_dashboard_page 	= WCVendors_Pro::get_option( 'dashboard_page_id' ); ?>
			                    <?php if($babystreet_wcv_pro_dashboard_page): ?>
                                    <a href="<?php echo esc_url(str_replace('%', '%%', get_permalink($babystreet_wcv_pro_dashboard_page))); ?>"><?php echo esc_html__('Vendor Dashboard', 'babystreet'); ?></a>
			                    <?php endif; ?>
                            </li>
	                    <?php elseif(BABYSTREET_IS_WC_VENDORS && WCV_Vendors::is_vendor( $current_user->ID )): ?>
                            <li class="babystreet-header-account-vcvendors-dash">
			                    <?php $babystreet_wcv_free_dashboard_page 	= WC_Vendors::$pv_options->get_option( 'vendor_dashboard_page' ); ?>
			                    <?php if($babystreet_wcv_free_dashboard_page): ?>
                                    <a href="<?php echo esc_url(str_replace('%', '%%', get_permalink($babystreet_wcv_free_dashboard_page))); ?>"><?php echo esc_html__('Vendor Dashboard', 'babystreet'); ?></a>
			                    <?php endif; ?>
                            </li>
	                    <?php endif; ?>
						<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                                <a href="<?php echo esc_url( str_replace('%', '%%', wc_get_account_endpoint_url( $endpoint )) ); ?>"><?php echo esc_html( $label ); ?></a>
                            </li>
						<?php endforeach; ?>
                    </ul>
				<?php elseif(!has_shortcode($post->post_content, 'woocommerce_my_account')): ?>
					<?php echo urldecode(do_shortcode('[woocommerce_my_account]')); ?>
				<?php endif; ?>
            </div>
		<?php endif; ?>
		<?php
		return ob_get_clean();
	}
}