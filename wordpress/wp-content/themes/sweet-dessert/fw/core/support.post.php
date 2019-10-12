<?php
/**
 * Sweet Dessert Framework: post settings
 *
 * @package	sweet_dessert
 * @since	sweet_dessert 1.0
 */

// Theme init
if (!function_exists('sweet_dessert_post_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_post_theme_setup' );
	function sweet_dessert_post_theme_setup() {

		// Set up post type support
		add_post_type_support( 'post', array('excerpt', 'post-formats') );


		// Add post specific actions and filters
		if (sweet_dessert_storage_get_array('post_override_options', 'page') == 'post') {
			add_action('admin_enqueue_scripts', 						'sweet_dessert_post_admin_scripts');
			add_filter('sweet_dessert_filter_localize_script_admin',			'sweet_dessert_post_localize_script');
			add_action('sweet_dessert_action_post_before_show_override_options',		'sweet_dessert_post_before_show_override_options', 10, 2);
			add_action('sweet_dessert_action_post_after_show_override_options',		'sweet_dessert_post_after_show_override_options', 10, 2);
			add_filter('sweet_dessert_filter_post_load_custom_options',		'sweet_dessert_post_load_custom_options', 10, 3);
			add_filter('sweet_dessert_filter_post_save_custom_options',		'sweet_dessert_post_save_custom_options', 10, 3);
			add_filter('sweet_dessert_filter_post_show_custom_field_option',	'sweet_dessert_post_show_custom_field_option', 10, 4);
		}
		
		// Detect current page type, taxonomy and title
		add_filter('sweet_dessert_filter_get_blog_type',						'sweet_dessert_post_get_blog_type', 10, 2);
		add_filter('sweet_dessert_filter_get_blog_title',					'sweet_dessert_post_get_blog_title', 10, 2);
		add_filter('sweet_dessert_filter_get_current_taxonomy',				'sweet_dessert_post_get_current_taxonomy', 10, 2);
		add_filter('sweet_dessert_filter_is_taxonomy',						'sweet_dessert_post_is_taxonomy', 10, 2);
		add_filter('sweet_dessert_filter_get_stream_page_title',				'sweet_dessert_post_get_stream_page_title', 10, 2);
		add_filter('sweet_dessert_filter_get_stream_page_link',				'sweet_dessert_post_get_stream_page_link', 10, 2);
		add_filter('sweet_dessert_filter_get_stream_page_id',				'sweet_dessert_post_get_stream_page_id', 10, 2);
		add_filter('sweet_dessert_filter_get_period_links',					'sweet_dessert_post_get_period_links', 10, 3);
		add_filter('sweet_dessert_filter_detect_inheritance_key',			'sweet_dessert_post_detect_inheritance_key', 10, 1);
		add_filter('sweet_dessert_filter_list_post_types', 					'sweet_dessert_post_list_post_types', 9, 1);
		// Advanced Calendar filters
		add_filter('sweet_dessert_filter_calendar_get_month_link',			'sweet_dessert_post_calendar_get_month_link', 10, 2);
		add_filter('sweet_dessert_filter_calendar_get_prev_month',			'sweet_dessert_post_calendar_get_prev_month', 10, 2);
		add_filter('sweet_dessert_filter_calendar_get_next_month',			'sweet_dessert_post_calendar_get_next_month', 10, 2);
		add_filter('sweet_dessert_filter_calendar_get_curr_month_posts',		'sweet_dessert_post_calendar_get_curr_month_posts', 10, 2);

		// Extra column for posts/pages lists
		if (sweet_dessert_get_theme_option('show_overriden_posts')=='yes') {
			add_filter('manage_edit-post_columns',			'sweet_dessert_post_add_options_column', 9);
			add_filter('manage_post_posts_custom_column',	'sweet_dessert_post_fill_options_column', 9, 2);
			add_filter('manage_edit-page_columns',			'sweet_dessert_post_add_options_column', 9);
			add_filter('manage_page_posts_custom_column',	'sweet_dessert_post_fill_options_column', 9, 2);
		}
	}
}

if ( !function_exists( 'sweet_dessert_post_settings_theme_setup2' ) ) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_post_settings_theme_setup2', 4 );
	function sweet_dessert_post_settings_theme_setup2() {
		sweet_dessert_add_theme_inheritance( array('archive' => array(
			'stream_template' => 'archive',
			'single_template' => '',
			'taxonomy' => array(),
			'taxonomy_tags' => array(),
			'post_type' => array(),
			'priority' => 20,
			'override' => 'page'
			) )
		);
		sweet_dessert_add_theme_inheritance( array('search' => array(
			'stream_template' => 'search',
			'single_template' => '',
			'taxonomy' => array(),
			'taxonomy_tags' => array(),
			'post_type' => array(),
			'priority' => 21,
			'override' => 'page'
			) )
		);
		sweet_dessert_add_theme_inheritance( array('error404' => array(
			'stream_template' => '404',
			'single_template' => '',
			'taxonomy' => array(),
			'taxonomy_tags' => array(),
			'post_type' => array(),
			'priority' => 30,
			'override' => 'page'
			) )
		);
		sweet_dessert_add_theme_inheritance( array('page' => array(
			'stream_template' => '',
			'single_template' => 'page',
			'taxonomy' => array(),
			'taxonomy_tags' => array(),
			'post_type' => array('page'),
			'priority' => 11,
			'override' => 'page'
			) )
		);
		sweet_dessert_add_theme_inheritance( array('post' => array(
			'stream_template' => 'blog',
			'single_template' => 'single',
			'taxonomy' => array('category'),
			'taxonomy_tags' => array('post_tag'),
			'post_type' => array('post'),
			'priority' => 10,
			'override' => 'post'
			) )
		);
	}
}

if (!function_exists('sweet_dessert_post_after_theme_setup')) {
	add_action( 'sweet_dessert_action_after_init_theme', 'sweet_dessert_post_after_theme_setup' );
	function sweet_dessert_post_after_theme_setup() {
		// Update fields in the override options
		if (sweet_dessert_storage_get_array('post_override_options', 'page') == 'post') {
			sweet_dessert_storage_set_array('post_override_options', 'fields', array(
					"partition_reviews" => array(
						"title" => esc_html__('Reviews', 'sweet-dessert'),
						"override" => "post",
						"divider" => false,
						"icon" => "iconadmin-newspaper",
						"type" => "partition"),
					"info_reviews_1" => array(
						"title" => esc_html__('Reviews criterias for this post', 'sweet-dessert'),
						"override" => "post",
						"divider" => false,
						"desc" => wp_kses_data( __('In this section you can put your reviews marks', 'sweet-dessert') ),
						"class" => "reviews_meta",
						"type" => "info"),
					"show_reviews" => array(
						"title" => esc_html__('Show reviews block',  'sweet-dessert'),
						"desc" => wp_kses_data( __("Show reviews block on single post page and average reviews rating after post's title in stream pages", 'sweet-dessert') ),
						"override" => "post",
						"class" => "reviews_meta",
						"std" => "inherit",
						"divider" => false,
						"type" => "radio",
						"style" => "horizontal",
						"options" => sweet_dessert_get_list_yesno()),
					"reviews_marks" => array(
						"title" => esc_html__('Reviews marks',  'sweet-dessert'),
						"override" => "post",
						"desc" => wp_kses_data( __("Marks for this review", 'sweet-dessert') ),
						"class" => "reviews_meta reviews_tab reviews_users",
						"std" => "",
						"type" => "reviews",
						"options" => sweet_dessert_get_theme_option('reviews_criterias'))
					)
			);
		}
	}
}


/* Extra column for posts/pages lists
-------------------------------------------------------------------------------------------- */

// Create additional column
if (!function_exists('sweet_dessert_post_add_options_column')) {
	function sweet_dessert_post_add_options_column( $columns ){
		$columns['theme_options'] = esc_html__('Theme Options', 'sweet-dessert');
		return $columns;
	}
}

// Fill column with data
if (!function_exists('sweet_dessert_post_fill_options_column')) {
	function sweet_dessert_post_fill_options_column($column_name='', $post_id=0) {
		if ($column_name != 'theme_options') return;
		if ($props = get_post_meta($post_id, sweet_dessert_storage_get('options_prefix') . '_post_options', true)) {
			$options = '';
			if (is_array($props) && count($props) > 0) {
				foreach ($props as $prop_name=>$prop_value) {
					if (!sweet_dessert_is_inherit_option($prop_value) && sweet_dessert_storage_get_array('options', $prop_name, 'type')!='hidden') {
						$prop_title = sweet_dessert_storage_get_array('options', $prop_name, 'title');
						if (empty($prop_title)) $prop_title = $prop_name;
						$options .= '<div class="sweet_dessert_options_prop_row"><span class="sweet_dessert_options_prop_name">' . esc_html($prop_title) . '</span>&nbsp;=&nbsp;<span class="sweet_dessert_options_prop_value">' . (is_array($prop_value) ? esc_html__('[Complex Data]', 'sweet-dessert') : '"' . esc_html(sweet_dessert_strshort($prop_value, 80)) . '"') . '</span></div>';
					}
				}
			}
		}
		if (!empty($options)) echo '<div class="sweet_dessert_options_list">'.trim(chop($options)).'</div>';
	}
}


// Admin scripts
if (!function_exists('sweet_dessert_post_admin_scripts')) {
	function sweet_dessert_post_admin_scripts() {
		if (sweet_dessert_storage_get_array('post_override_options', 'page')=='post' && sweet_dessert_storage_isset('options', 'show_reviews'))
			wp_enqueue_script( 'sweet-dessert-core-reviews-script', sweet_dessert_get_file_url('js/core.reviews.js'), array('jquery'), null, true );
	}
}


// Open reviews container before Theme options block
if (!function_exists('sweet_dessert_post_before_show_override_options')) {
	function sweet_dessert_post_before_show_override_options($post_type, $post_id) {
		?><div class="reviews_area reviews_<?php echo esc_attr(max(5, (int) sweet_dessert_get_theme_option('reviews_max_level'))); ?>"><?php
	}
}


// Close reviews container after Theme options block
if (!function_exists('sweet_dessert_post_after_show_override_options')) {
	function sweet_dessert_post_after_show_override_options($post_type, $post_id) {
		?></div><!-- /.reviews_area --><?php
	}
}


// Add JS vars into Theme options block
if (!function_exists('sweet_dessert_post_localize_script')) {
	function sweet_dessert_post_localize_script($vars) {
		$vars['reviews_levels'] = sweet_dessert_get_theme_option('reviews_criterias_levels');
		$vars['reviews_max_level'] = max(5, (int) sweet_dessert_get_theme_option('reviews_max_level'));
		$vars['reviews_allow_user_marks'] = true;
		return $vars;
	}
}

// Load custom options filter - prepare reviews marks
if (!function_exists('sweet_dessert_post_load_custom_options')) {
	function sweet_dessert_post_load_custom_options($custom_options, $post_type, $post_id) {
		if (isset($custom_options['reviews_marks'])) 
			$custom_options['reviews_marks'] = sweet_dessert_reviews_marks_to_display($custom_options['reviews_marks']);
		return $custom_options;
	}
}

// Before show reviews field - add taxonomy specific criterias
if (!function_exists('sweet_dessert_post_show_custom_field_option')) {
	function sweet_dessert_post_show_custom_field_option($option, $id, $post_type, $post_id) {
		if ($id == 'reviews_marks') {
			$cat_list = sweet_dessert_get_categories_by_post_id($post_id);
			if (!empty($cat_list['category']->terms) && is_array($cat_list['category']->terms)) {
				foreach ($cat_list['category']->terms as $cat) {
					$term_id = (int) $cat->term_id;
					$prop = sweet_dessert_taxonomy_get_inherited_property('category', $term_id, 'reviews_criterias');
					if (!empty($prop) && !sweet_dessert_is_inherit_option($prop)) {
						$option['options'] = $prop;
						break;
					}
				}
			}
		}
		return $option;
	}
}

// Before save custom options - calc and save average rating
if (!function_exists('sweet_dessert_post_save_custom_options')) {
	function sweet_dessert_post_save_custom_options($custom_options, $post_type, $post_id) {
		if (isset($custom_options['reviews_marks'])) {
			if (($avg = sweet_dessert_reviews_get_average_rating($custom_options['reviews_marks'])) > 0)
				update_post_meta($post_id, sweet_dessert_storage_get('options_prefix').'_reviews_avg', $avg);
		}
		return $custom_options;
	}
}


// Return true, if current page is single post page or category archive or blog stream page
if ( !function_exists( 'sweet_dessert_is_post_page' ) ) {
	function sweet_dessert_is_post_page() {
		if (!sweet_dessert_storage_empty('pre_query'))
			return sweet_dessert_storage_call_obj_method('pre_query', 'is_single') || sweet_dessert_storage_call_obj_method('pre_query', 'is_category') || sweet_dessert_storage_get_obj_property('pre_query', 'is_posts_page')==1;
		else
			return is_single() || is_category() || sweet_dessert_get_query_vars('is_posts_page');
	}
}

// Add custom post type into list
if ( !function_exists( 'sweet_dessert_post_list_post_types' ) ) {
	function sweet_dessert_post_list_post_types($list) {
		if( isset( $list['post'] ) ) $list['post'] = esc_html__('Post', 'sweet-dessert');
		if( isset( $list['page'] ) ) $list['page'] = esc_html__('Page', 'sweet-dessert');
		return $list;
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'sweet_dessert_post_detect_inheritance_key' ) ) {
	function sweet_dessert_post_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		if (!sweet_dessert_storage_empty('pre_query')) {
			if (sweet_dessert_storage_call_obj_method('pre_query', 'is_day') || sweet_dessert_storage_call_obj_method('pre_query', 'is_month') || sweet_dessert_storage_call_obj_method('pre_query', 'is_year'))
				$key = 'archive';
			else if (sweet_dessert_storage_call_obj_method('pre_query', 'is_search'))
				$key = 'search';
			else if (sweet_dessert_storage_call_obj_method('pre_query', 'is_404'))
				$key = 'error404';
			else if (sweet_dessert_storage_call_obj_method('pre_query', 'is_page'))
				$key = 'page';
			else if (sweet_dessert_is_post_page())
				$key = 'post';
		} else {
			if (is_day() || is_month() || is_year())
				$key = 'archive';
			else if (is_search())
				$key = 'search';
			else if (is_404())
				$key = 'error404';
			else if (is_page())
				$key = 'page';
			else if (sweet_dessert_is_post_page())
				$key = 'post';
		}
		return $key;
	}
}

// Filter to detect current page slug
if ( !function_exists( 'sweet_dessert_post_get_blog_type' ) ) {
	function sweet_dessert_post_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;

		if (isset($query->queried_object) && isset($query->queried_object->post_type) && $query->queried_object->post_type=='page') {
			$page = get_post_meta($query->queried_object_id, '_wp_page_template', true);
			if (sweet_dessert_substr($page, 0, 7)=='default') $page = '';
		} else if (isset($query->query_vars['page_id'])) {
			$page = get_post_meta($query->query_vars['page_id'], '_wp_page_template', true);
		} else if (isset($query->queried_object) && isset($query->queried_object->taxonomy)) {
			$page = $query->queried_object->taxonomy;
		}

		if (!empty($page))
			$page = str_replace('.php', '', $page);
		else if ( $query && $query->is_404())						// -------------- 404 error page
			$page = 'error404';
		else if ( $query && $query->is_search())				// -------------- Search results
			$page = 'search';
		else if ( $query && $query->is_day())					// -------------- Archives daily
			$page = 'archives_day';
		else if ( $query && $query->is_month())				// -------------- Archives monthly
			$page = 'archives_month';
		else if ( $query && $query->is_year())				// -------------- Archives year
			$page = 'archives_year';
		else if ( $query && $query->is_category())	 		// -------------- Category
			$page = 'category';
		else if ( $query && $query->is_tag())					// -------------- Tag posts
			$page = 'tag';
		else if ( $query && $query->is_author())			// -------------- Author page
			$page = 'author';
		else if ( $query && $query->is_attachment())
			$page = 'attachment';
		else if ( $query && $query->is_single())			// -------------- Single post
			$page = 'single';
		else if ( $query && $query->is_front_page())
			$page = 'home';
		else if ( $query && $query->is_page())
			$page = 'page';
		else										// -------------- Home page
			$page = 'home';

		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'sweet_dessert_post_get_blog_title' ) ) {
	function sweet_dessert_post_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		
		if ( $page == 'blog' )
			$title = esc_html__( 'All Posts', 'sweet-dessert' );
		else if ( $page == 'author' ) {
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			$title = sprintf(esc_html__('Author page: %s', 'sweet-dessert'), $curauth->display_name);
		} else if ( $page == 'error404' )
			$title = esc_html__('URL not found', 'sweet-dessert');
		else if ( $page == 'search' )
			$title = sprintf( esc_html__( 'Search: %s', 'sweet-dessert' ), get_search_query() );
		else if ( $page == 'archives_day' )
			$title = sprintf( esc_html__( 'Daily Archives: %s', 'sweet-dessert' ), sweet_dessert_get_date_translations(get_the_date()) );
		else if ( $page == 'archives_month' )
			$title = sprintf( esc_html__( 'Monthly Archives: %s', 'sweet-dessert' ), sweet_dessert_get_date_translations(get_the_date( 'F Y' )) );
		else if ( $page == 'archives_year' )
			$title = sprintf( esc_html__( 'Yearly Archives: %s', 'sweet-dessert' ), get_the_date( 'Y' ) );
		 else if ( $page == 'category' )
			$title = sprintf(  '%s', single_cat_title( '', false ) );
		else if ( $page == 'tag' )
			$title = sprintf( esc_html__( 'Tag: %s', 'sweet-dessert' ), single_tag_title( '', false ) );
		else if ( $page == 'attachment' )
			$title = sprintf( esc_html__( 'Attachment: %s', 'sweet-dessert' ), sweet_dessert_get_post_title());
		else if ( $page == 'single' )
			$title = sweet_dessert_get_post_title();
		else if ( $page == 'page' )
			$title = sweet_dessert_get_post_title();
		else
			$title = get_bloginfo('name', 'raw');		// Unknown pages - as homepage

		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'sweet_dessert_post_get_stream_page_title' ) ) {
	function sweet_dessert_post_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if ( in_array($page, array('blog', 'error', 'search', 'archives_day', 'archives_month', 'archives_year', 'category', 'tag', 'author', 'attachment', 'single')) ) {		//, 'page', 'home'
			if (($page_id = sweet_dessert_post_get_stream_page_id(0, 'blog')) > 0)
				$title = sweet_dessert_get_post_title($page_id);
			else
				$title = esc_html__( 'All posts', 'sweet-dessert');
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'sweet_dessert_post_get_stream_page_id' ) ) {
	function sweet_dessert_post_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if ( in_array($page, array('blog', 'error', 'search', 'archives_day', 'archives_month', 'archives_year', 'category', 'tag', 'author', 'attachment', 'single')) )	//, 'page', 'home'
			$id = sweet_dessert_get_template_page_id('blog');
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'sweet_dessert_post_get_stream_page_link' ) ) {
	function sweet_dessert_post_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if ( in_array($page, array('blog', 'error', 'search', 'archives_day', 'archives_month', 'archives_year', 'category', 'tag', 'author', 'attachment', 'single')) ) {	//, 'page', 'home'
			$id = sweet_dessert_get_template_page_id('blog');
			if ($id) $url = get_permalink($id);
		}
		return $url;
	}
}

// Filter to detect taxonomy name (slug) for the current post, category, blog
if ( !function_exists( 'sweet_dessert_post_get_current_taxonomy' ) ) {
	function sweet_dessert_post_get_current_taxonomy($tax, $page) {
		if (!empty($tax)) return $tax;
		if ( in_array($page, array('blog', 'error', 'search', 'archives_day', 'archives_month', 'archives_year', 'category', 'tag', 'author', 'attachment', 'single', 'page', 'home')) ) {
			$tax = 'category';
		}
		return $tax;
	}
}

// Return taxonomy name (slug) if current page is this taxonomy page
if ( !function_exists( 'sweet_dessert_post_is_taxonomy' ) ) {
	function sweet_dessert_post_is_taxonomy($tax, $query=null) {
		if (!empty($tax))
			return $tax;
		else 
			return $query && $query->is_category() || is_category() ? 'category' : '';
	}
}

// Filter to return breadcrumbs links to the parent period
if ( !function_exists( 'sweet_dessert_post_get_period_links' ) ) {
	function sweet_dessert_post_get_period_links($links, $page, $delimiter='') {
		if (!empty($links)) return $links;
		global $post;
		if (in_array($page, array('archives_day', 'archives_month')) && is_object($post)) {
			$year  = get_the_time('Y'); 
			$month = get_the_time('m'); 
			$links = '<a class="breadcrumbs_item cat_parent" href="' . esc_url(get_year_link( $year )) . '">' . ($year) . '</a>';
			if ($page == 'archives_day')
				$links .= (!empty($links) ? $delimiter : '') . '<a class="breadcrumbs_item cat_parent" href="' . esc_url(get_month_link( $year, $month )) . '">' . trim(sweet_dessert_get_date_translations(get_the_date('F'))) . '</a>';
		}
		return $links;
	}
}


// Return month link
if ( !function_exists( 'sweet_dessert_post_calendar_get_month_link' ) ) {
	function sweet_dessert_post_calendar_get_month_link($link, $opt) {
		return $link ? $link : get_month_link($opt['year'], $opt['month']);
	}
}

// Return previous month and year with published posts
if ( !function_exists( 'sweet_dessert_post_calendar_get_prev_month' ) ) {
	function sweet_dessert_post_calendar_get_prev_month($prev, $opt) {
		$posts_types = array();
		if (!empty($opt['posts_types']) && is_array($opt['posts_types'])) {
			foreach ($opt['posts_types'] as $post_type) {
				if (empty($prev['done']) || !in_array($post_type, $prev['done']))
					$posts_types[] = $post_type;
			}
		}
		if (!empty($posts_types)) {
			$args = array(
				'post_type' => $posts_types,
				'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish',
				'posts_per_page' => 1,
				'ignore_sticky_posts' => true,
				'orderby' => 'post_date',
				'order' => 'desc',
				'date_query' => array(
					array(
						'before' => array(
							'year' => $opt['year'],
							'month' => $opt['month']
						)
					)
				)
			);
			if (in_array('post', $posts_types)) {
				$ex = sweet_dessert_get_theme_option('exclude_cats');
				if (!empty($ex))
					$args['category__not_in'] = explode(',', $ex);
			}
			$month = $year = 0;
			$q = new WP_Query($args);
			if ($q->have_posts()) {
				while ($q->have_posts()) { $q->the_post();
					$year = get_the_date('Y');
					$month = get_the_date('m');
				}
				wp_reset_postdata();
			}
			if (empty($prev) || ($year+$month > 0 && ($prev['year']+$prev['month']==0 || ($prev['year']).($prev['month']) < ($year).($month)))) {
				$prev['year']  = $year;
				$prev['month'] = $month;
			}
			if (empty($prev['done'])) $prev['done'] = array();
			$prev['done'] = array_merge($prev['done'], $posts_types);
		}
		return $prev;
	}
}

// Return next month and year with published posts
if ( !function_exists( 'sweet_dessert_post_calendar_get_next_month' ) ) {
	function sweet_dessert_post_calendar_get_next_month($next, $opt) {
		$posts_types = array();
		if (!empty($opt['posts_types']) && is_array($opt['posts_types'])) {
			foreach ($opt['posts_types'] as $post_type) {
				if (empty($next['done']) || !in_array($post_type, $next['done']))
					$posts_types[] = $post_type;
			}
		}
		if (!empty($posts_types)) {
			$args = array(
				'post_type' => $posts_types,
				'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish',
				'posts_per_page' => 1,
				'ignore_sticky_posts' => true,
				'orderby' => 'post_date',
				'order' => 'asc',
				'date_query' => array(
					array(
						'after' => array(
							'year' => $opt['year'],
							'month' => $opt['month']
						)
					)
				)
			);
			if (in_array('post', $posts_types)) {
				$ex = sweet_dessert_get_theme_option('exclude_cats');
				if (!empty($ex))
					$args['category__not_in'] = explode(',', $ex);
			}
			$q = new WP_Query($args);
			$month = $year = 0;
			if ($q->have_posts()) {
				while ($q->have_posts()) { $q->the_post();
					$year = get_the_date('Y');
					$month = get_the_date('m');
				}
				wp_reset_postdata();
			}
			if (empty($next) || ($year+$month > 0 && ($next['year']+$next['month']==0 || ($next['year']).($next['month']) > ($year).($month)))) {
				$next['year']  = $year;
				$next['month'] = $month;
			}
			if (empty($next['done'])) $next['done'] = array();
			$next['done'] = array_merge($next['done'], $posts_types);
		}
		return $next;
	}
}

// Return current month published posts
if ( !function_exists( 'sweet_dessert_post_calendar_get_curr_month_posts' ) ) {
	function sweet_dessert_post_calendar_get_curr_month_posts($posts, $opt) {
		$posts_types = array();
		if (!empty($opt['posts_types']) && is_array($opt['posts_types'])) {
			foreach ($opt['posts_types'] as $post_type) {
				if (empty($posts['done']) || !in_array($post_type, $posts['done']))
					$posts_types[] = $post_type;
			}
		}
		if (!empty($posts_types)) {
			$args = array(
				'post_type' => $posts_types,
				'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish',
				'posts_per_page' => -1,
				'ignore_sticky_posts' => true,
				'orderby' => 'post_date',
				'order' => 'asc',
				'date_query' => array(
					array(
						'before' => array(
							'year' => $opt['year'],
							'month' => $opt['month'],
							'day' => $opt['last_day']
						),
						'after' => array(
							'year' => $opt['year'],
							'month' => $opt['month'],
							'day' => 1
						),
						'inclusive' => true
					)
				)
			);
			if (in_array('post', $posts_types)) {
				$ex = sweet_dessert_get_theme_option('exclude_cats');
				if (!empty($ex))
					$args['category__not_in'] = explode(',', $ex);
			}
			$q = new WP_Query($args);
			if ($q->have_posts()) {
				if (empty($posts)) $posts = array();
				while ($q->have_posts()) { $q->the_post();
					$day = (int) get_the_date('d');
					$title = get_the_title();
					if (empty($posts[$day]))
						$posts[$day] = array();
					if (empty($posts[$day]['link']))
						$posts[$day]['link'] = get_day_link($opt['year'], $opt['month'], $day);
					if (empty($posts[$day]['titles']))
						$posts[$day]['titles'] = $title;
					else
						$posts[$day]['titles'] = is_int($posts[$day]['titles']) ? $posts[$day]['titles']+1 : 2;
					if (empty($posts[$day]['posts'])) $posts[$day]['posts'] = array();
					$posts[$day]['posts'][] = array(
						'post_id' => get_the_ID(),
						'post_type' => get_post_type(),
						'post_date' => get_the_date(),
						'post_title' => $title,
						'post_link' => get_permalink()
					);
				}
				wp_reset_postdata();
			}
			if (empty($posts['done'])) $posts['done'] = array();
			$posts['done'] = array_merge($posts['done'], $posts_types);
		}
		return $posts;
	}
}
?>