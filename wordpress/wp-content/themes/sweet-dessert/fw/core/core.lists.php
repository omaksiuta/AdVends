<?php
/**
 * Sweet Dessert Framework: return lists
 *
 * @package sweet_dessert
 * @since sweet_dessert 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Return styles list
if ( !function_exists( 'sweet_dessert_get_list_styles' ) ) {
	function sweet_dessert_get_list_styles($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = sprintf(esc_html__('Style %d', 'sweet-dessert'), $i);
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the shortcodes margins
if ( !function_exists( 'sweet_dessert_get_list_margins' ) ) {
	function sweet_dessert_get_list_margins($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_margins'))=='') {
			$list = array(
				'null'		=> esc_html__('0 (No margin)',	'sweet-dessert'),
				'tiny'		=> esc_html__('Tiny',		'sweet-dessert'),
				'small'		=> esc_html__('Small',		'sweet-dessert'),
				'medium'	=> esc_html__('Medium',		'sweet-dessert'),
				'large'		=> esc_html__('Large',		'sweet-dessert'),
				'huge'		=> esc_html__('Huge',		'sweet-dessert'),
				'tiny-'		=> esc_html__('Tiny (negative)',	'sweet-dessert'),
				'small-'	=> esc_html__('Small (negative)',	'sweet-dessert'),
				'medium-'	=> esc_html__('Medium (negative)',	'sweet-dessert'),
				'large-'	=> esc_html__('Large (negative)',	'sweet-dessert'),
				'huge-'		=> esc_html__('Huge (negative)',	'sweet-dessert')
				);
			$list = apply_filters('sweet_dessert_filter_list_margins', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_margins', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the line styles
if ( !function_exists( 'sweet_dessert_get_list_line_styles' ) ) {
	function sweet_dessert_get_list_line_styles($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_line_styles'))=='') {
			$list = array(
				'solid'	=> esc_html__('Solid', 'sweet-dessert'),
				'dashed'=> esc_html__('Dashed', 'sweet-dessert'),
				'dotted'=> esc_html__('Dotted', 'sweet-dessert'),
				'double'=> esc_html__('Double', 'sweet-dessert'),
				'image'	=> esc_html__('Image', 'sweet-dessert')
				);
			$list = apply_filters('sweet_dessert_filter_list_line_styles', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_line_styles', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the animations
if ( !function_exists( 'sweet_dessert_get_list_animations' ) ) {
	function sweet_dessert_get_list_animations($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_animations'))=='') {
			$list = array(
				'none'			=> esc_html__('- None -',	'sweet-dessert'),
				'bounce'		=> esc_html__('Bounce',		'sweet-dessert'),
				'elastic'		=> esc_html__('Elastic',	'sweet-dessert'),
				'flash'			=> esc_html__('Flash',		'sweet-dessert'),
				'flip'			=> esc_html__('Flip',		'sweet-dessert'),
				'pulse'			=> esc_html__('Pulse',		'sweet-dessert'),
				'rubberBand'	=> esc_html__('Rubber Band','sweet-dessert'),
				'shake'			=> esc_html__('Shake',		'sweet-dessert'),
				'swing'			=> esc_html__('Swing',		'sweet-dessert'),
				'tada'			=> esc_html__('Tada',		'sweet-dessert'),
				'wobble'		=> esc_html__('Wobble',		'sweet-dessert')
				);
			$list = apply_filters('sweet_dessert_filter_list_animations', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_animations', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the enter animations
if ( !function_exists( 'sweet_dessert_get_list_animations_in' ) ) {
	function sweet_dessert_get_list_animations_in($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_animations_in'))=='') {
			$list = array(
				'none'				=> esc_html__('- None -',			'sweet-dessert'),
				'bounceIn'			=> esc_html__('Bounce In',			'sweet-dessert'),
				'bounceInUp'		=> esc_html__('Bounce In Up',		'sweet-dessert'),
				'bounceInDown'		=> esc_html__('Bounce In Down',		'sweet-dessert'),
				'bounceInLeft'		=> esc_html__('Bounce In Left',		'sweet-dessert'),
				'bounceInRight'		=> esc_html__('Bounce In Right',	'sweet-dessert'),
				'elastic'			=> esc_html__('Elastic In',			'sweet-dessert'),
				'fadeIn'			=> esc_html__('Fade In',			'sweet-dessert'),
				'fadeInUp'			=> esc_html__('Fade In Up',			'sweet-dessert'),
				'fadeInUpSmall'		=> esc_html__('Fade In Up Small',	'sweet-dessert'),
				'fadeInUpBig'		=> esc_html__('Fade In Up Big',		'sweet-dessert'),
				'fadeInDown'		=> esc_html__('Fade In Down',		'sweet-dessert'),
				'fadeInDownBig'		=> esc_html__('Fade In Down Big',	'sweet-dessert'),
				'fadeInLeft'		=> esc_html__('Fade In Left',		'sweet-dessert'),
				'fadeInLeftBig'		=> esc_html__('Fade In Left Big',	'sweet-dessert'),
				'fadeInRight'		=> esc_html__('Fade In Right',		'sweet-dessert'),
				'fadeInRightBig'	=> esc_html__('Fade In Right Big',	'sweet-dessert'),
				'flipInX'			=> esc_html__('Flip In X',			'sweet-dessert'),
				'flipInY'			=> esc_html__('Flip In Y',			'sweet-dessert'),
				'lightSpeedIn'		=> esc_html__('Light Speed In',		'sweet-dessert'),
				'rotateIn'			=> esc_html__('Rotate In',			'sweet-dessert'),
				'rotateInUpLeft'	=> esc_html__('Rotate In Down Left','sweet-dessert'),
				'rotateInUpRight'	=> esc_html__('Rotate In Up Right',	'sweet-dessert'),
				'rotateInDownLeft'	=> esc_html__('Rotate In Up Left',	'sweet-dessert'),
				'rotateInDownRight'	=> esc_html__('Rotate In Down Right','sweet-dessert'),
				'rollIn'			=> esc_html__('Roll In',			'sweet-dessert'),
				'slideInUp'			=> esc_html__('Slide In Up',		'sweet-dessert'),
				'slideInDown'		=> esc_html__('Slide In Down',		'sweet-dessert'),
				'slideInLeft'		=> esc_html__('Slide In Left',		'sweet-dessert'),
				'slideInRight'		=> esc_html__('Slide In Right',		'sweet-dessert'),
				'wipeInLeftTop'		=> esc_html__('Wipe In Left Top',	'sweet-dessert'),
				'zoomIn'			=> esc_html__('Zoom In',			'sweet-dessert'),
				'zoomInUp'			=> esc_html__('Zoom In Up',			'sweet-dessert'),
				'zoomInDown'		=> esc_html__('Zoom In Down',		'sweet-dessert'),
				'zoomInLeft'		=> esc_html__('Zoom In Left',		'sweet-dessert'),
				'zoomInRight'		=> esc_html__('Zoom In Right',		'sweet-dessert')
				);
			$list = apply_filters('sweet_dessert_filter_list_animations_in', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_animations_in', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the out animations
if ( !function_exists( 'sweet_dessert_get_list_animations_out' ) ) {
	function sweet_dessert_get_list_animations_out($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_animations_out'))=='') {
			$list = array(
				'none'				=> esc_html__('- None -',			'sweet-dessert'),
				'bounceOut'			=> esc_html__('Bounce Out',			'sweet-dessert'),
				'bounceOutUp'		=> esc_html__('Bounce Out Up',		'sweet-dessert'),
				'bounceOutDown'		=> esc_html__('Bounce Out Down',	'sweet-dessert'),
				'bounceOutLeft'		=> esc_html__('Bounce Out Left',	'sweet-dessert'),
				'bounceOutRight'	=> esc_html__('Bounce Out Right',	'sweet-dessert'),
				'fadeOut'			=> esc_html__('Fade Out',			'sweet-dessert'),
				'fadeOutUp'			=> esc_html__('Fade Out Up',		'sweet-dessert'),
				'fadeOutUpBig'		=> esc_html__('Fade Out Up Big',	'sweet-dessert'),
				'fadeOutDown'		=> esc_html__('Fade Out Down',		'sweet-dessert'),
				'fadeOutDownSmall'	=> esc_html__('Fade Out Down Small','sweet-dessert'),
				'fadeOutDownBig'	=> esc_html__('Fade Out Down Big',	'sweet-dessert'),
				'fadeOutLeft'		=> esc_html__('Fade Out Left',		'sweet-dessert'),
				'fadeOutLeftBig'	=> esc_html__('Fade Out Left Big',	'sweet-dessert'),
				'fadeOutRight'		=> esc_html__('Fade Out Right',		'sweet-dessert'),
				'fadeOutRightBig'	=> esc_html__('Fade Out Right Big',	'sweet-dessert'),
				'flipOutX'			=> esc_html__('Flip Out X',			'sweet-dessert'),
				'flipOutY'			=> esc_html__('Flip Out Y',			'sweet-dessert'),
				'hinge'				=> esc_html__('Hinge Out',			'sweet-dessert'),
				'lightSpeedOut'		=> esc_html__('Light Speed Out',	'sweet-dessert'),
				'rotateOut'			=> esc_html__('Rotate Out',			'sweet-dessert'),
				'rotateOutUpLeft'	=> esc_html__('Rotate Out Down Left','sweet-dessert'),
				'rotateOutUpRight'	=> esc_html__('Rotate Out Up Right','sweet-dessert'),
				'rotateOutDownLeft'	=> esc_html__('Rotate Out Up Left',	'sweet-dessert'),
				'rotateOutDownRight'=> esc_html__('Rotate Out Down Right','sweet-dessert'),
				'rollOut'			=> esc_html__('Roll Out',			'sweet-dessert'),
				'slideOutUp'		=> esc_html__('Slide Out Up',		'sweet-dessert'),
				'slideOutDown'		=> esc_html__('Slide Out Down',		'sweet-dessert'),
				'slideOutLeft'		=> esc_html__('Slide Out Left',		'sweet-dessert'),
				'slideOutRight'		=> esc_html__('Slide Out Right',	'sweet-dessert'),
				'zoomOut'			=> esc_html__('Zoom Out',			'sweet-dessert'),
				'zoomOutUp'			=> esc_html__('Zoom Out Up',		'sweet-dessert'),
				'zoomOutDown'		=> esc_html__('Zoom Out Down',		'sweet-dessert'),
				'zoomOutLeft'		=> esc_html__('Zoom Out Left',		'sweet-dessert'),
				'zoomOutRight'		=> esc_html__('Zoom Out Right',		'sweet-dessert')
				);
			$list = apply_filters('sweet_dessert_filter_list_animations_out', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_animations_out', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return classes list for the specified animation
if (!function_exists('sweet_dessert_get_animation_classes')) {
	function sweet_dessert_get_animation_classes($animation, $speed='normal', $loop='none') {
		return sweet_dessert_param_is_off($animation) ? '' : 'animated '.esc_attr($animation).' '.esc_attr($speed).(!sweet_dessert_param_is_off($loop) ? ' '.esc_attr($loop) : '');
	}
}


// Return list of the main menu hover effects
if ( !function_exists( 'sweet_dessert_get_list_menu_hovers' ) ) {
	function sweet_dessert_get_list_menu_hovers($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_menu_hovers'))=='') {
			$list = array(
				'fade'			=> esc_html__('Fade',		'sweet-dessert'),
				'slide_line'	=> esc_html__('Slide Line',	'sweet-dessert'),
				'slide_box'		=> esc_html__('Slide Box',	'sweet-dessert'),
				'zoom_line'		=> esc_html__('Zoom Line',	'sweet-dessert'),
				'path_line'		=> esc_html__('Path Line',	'sweet-dessert'),
				'roll_down'		=> esc_html__('Roll Down',	'sweet-dessert'),
				'color_line'	=> esc_html__('Color Line',	'sweet-dessert'),
				);
			$list = apply_filters('sweet_dessert_filter_list_menu_hovers', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_menu_hovers', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the button's hover effects
if ( !function_exists( 'sweet_dessert_get_list_button_hovers' ) ) {
	function sweet_dessert_get_list_button_hovers($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_button_hovers'))=='') {
			$list = array(
				'default'		=> esc_html__('Default',			'sweet-dessert'),
				'fade'			=> esc_html__('Fade',				'sweet-dessert'),
				'slide_left'	=> esc_html__('Slide from Left',	'sweet-dessert'),
				'slide_top'		=> esc_html__('Slide from Top',		'sweet-dessert'),
				'arrow'			=> esc_html__('Arrow',				'sweet-dessert'),
				);
			$list = apply_filters('sweet_dessert_filter_list_button_hovers', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_button_hovers', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the input field's hover effects
if ( !function_exists( 'sweet_dessert_get_list_input_hovers' ) ) {
	function sweet_dessert_get_list_input_hovers($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_input_hovers'))=='') {
			$list = array(
				'default'	=> esc_html__('Default',	'sweet-dessert'),
				'accent'	=> esc_html__('Accented',	'sweet-dessert'),
				'path'		=> esc_html__('Path',		'sweet-dessert'),
				'jump'		=> esc_html__('Jump',		'sweet-dessert'),
				'underline'	=> esc_html__('Underline',	'sweet-dessert'),
				'iconed'	=> esc_html__('Iconed',		'sweet-dessert'),
				);
			$list = apply_filters('sweet_dessert_filter_list_input_hovers', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_input_hovers', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the search field's styles
if ( !function_exists( 'sweet_dessert_get_list_search_styles' ) ) {
	function sweet_dessert_get_list_search_styles($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_search_styles'))=='') {
			$list = array(
				'default'	=> esc_html__('Default',	'sweet-dessert'),
				'fullscreen'=> esc_html__('Fullscreen',	'sweet-dessert'),
				'slide'		=> esc_html__('Slide',		'sweet-dessert'),
				'expand'	=> esc_html__('Expand',		'sweet-dessert'),
				);
			$list = apply_filters('sweet_dessert_filter_list_search_styles', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_search_styles', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of categories
if ( !function_exists( 'sweet_dessert_get_list_categories' ) ) {
	function sweet_dessert_get_list_categories($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_categories'))=='') {
			$list = array();
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => 'category',
				'pad_counts'               => false );
			$taxonomies = get_categories( $args );
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_categories', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'sweet_dessert_get_list_terms' ) ) {
	function sweet_dessert_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		if (($list = sweet_dessert_storage_get('list_taxonomies_'.($taxonomy)))=='') {
			$list = array();
			if ( is_array($taxonomy) || taxonomy_exists($taxonomy) ) {
				$terms = get_terms( $taxonomy, array(
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $taxonomy,
					'pad_counts'               => false
					)
				);
			} else {
				$terms = sweet_dessert_get_terms_by_taxonomy_from_db($taxonomy);
			}
			if (!is_wp_error( $terms ) && is_array($terms) && count($terms) > 0) {
				foreach ($terms as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_taxonomies_'.($taxonomy), $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'sweet_dessert_get_list_posts_types' ) ) {
	function sweet_dessert_get_list_posts_types($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_posts_types'))=='') {
			// Return only theme inheritance supported post types
			$list = apply_filters('sweet_dessert_filter_list_post_types', array());
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_posts_types', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'sweet_dessert_get_list_posts' ) ) {
	function sweet_dessert_get_list_posts($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'taxonomy'			=> 'category',
			'taxonomy_value'	=> '',
			'posts_per_page'	=> -1,
			'orderby'			=> 'post_date',
			'order'				=> 'desc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));

		$hash = 'list_posts_'.($opt['post_type']).'_'.($opt['taxonomy']).'_'.($opt['taxonomy_value']).'_'.($opt['orderby']).'_'.($opt['order']).'_'.($opt['return']).'_'.($opt['posts_per_page']);
		if (($list = sweet_dessert_storage_get($hash))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'sweet-dessert');
			$args = array(
				'post_type' => $opt['post_type'],
				'post_status' => $opt['post_status'],
				'posts_per_page' => $opt['posts_per_page'],
				'ignore_sticky_posts' => true,
				'orderby'	=> $opt['orderby'],
				'order'		=> $opt['order']
			);
			if (!empty($opt['taxonomy_value'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $opt['taxonomy'],
						'field' => (int) $opt['taxonomy_value'] > 0 ? 'id' : 'slug',
						'terms' => $opt['taxonomy_value']
					)
				);
			}
			$posts = get_posts( $args );
			if (is_array($posts) && count($posts) > 0) {
				foreach ($posts as $post) {
					$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
				}
			}
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set($hash, $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list pages
if ( !function_exists( 'sweet_dessert_get_list_pages' ) ) {
	function sweet_dessert_get_list_pages($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'page',
			'post_status'		=> 'publish',
			'posts_per_page'	=> -1,
			'orderby'			=> 'title',
			'order'				=> 'asc',
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));
		return sweet_dessert_get_list_posts($prepend_inherit, $opt);
	}
}


// Return list of registered users
if ( !function_exists( 'sweet_dessert_get_list_users' ) ) {
	function sweet_dessert_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		if (($list = sweet_dessert_storage_get('list_users'))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'sweet-dessert');
			$args = array(
				'orderby'	=> 'display_name',
				'order'		=> 'ASC' );
			$users = get_users( $args );
			if (is_array($users) && count($users) > 0) {
				foreach ($users as $user) {
					$accept = true;
					if (is_array($user->roles)) {
						if (is_array($user->roles) && count($user->roles) > 0) {
							$accept = false;
							foreach ($user->roles as $role) {
								if (in_array($role, $roles)) {
									$accept = true;
									break;
								}
							}
						}
					}
					if ($accept) $list[$user->user_login] = $user->display_name;
				}
			}
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_users', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return slider engines list, prepended inherit (if need)
if ( !function_exists( 'sweet_dessert_get_list_sliders' ) ) {
	function sweet_dessert_get_list_sliders($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_sliders'))=='') {
			$list = array(
				'swiper' => esc_html__("Posts slider (Swiper)", 'sweet-dessert')
			);
			$list = apply_filters('sweet_dessert_filter_list_sliders', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_sliders', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return slider controls list, prepended inherit (if need)
if ( !function_exists( 'sweet_dessert_get_list_slider_controls' ) ) {
	function sweet_dessert_get_list_slider_controls($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_slider_controls'))=='') {
			$list = array(
				'no'		=> esc_html__('None', 'sweet-dessert'),
				'side'		=> esc_html__('Side', 'sweet-dessert'),
				'bottom'	=> esc_html__('Bottom', 'sweet-dessert'),
				'pagination'=> esc_html__('Pagination', 'sweet-dessert')
				);
			$list = apply_filters('sweet_dessert_filter_list_slider_controls', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_slider_controls', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return slider controls classes
if ( !function_exists( 'sweet_dessert_get_slider_controls_classes' ) ) {
	function sweet_dessert_get_slider_controls_classes($controls) {
		if (sweet_dessert_param_is_off($controls))	$classes = 'sc_slider_nopagination sc_slider_nocontrols';
		else if ($controls=='bottom')			$classes = 'sc_slider_nopagination sc_slider_controls sc_slider_controls_bottom';
		else if ($controls=='pagination')		$classes = 'sc_slider_pagination sc_slider_pagination_bottom sc_slider_nocontrols';
		else									$classes = 'sc_slider_nopagination sc_slider_controls sc_slider_controls_side';
		return $classes;
	}
}

// Return list with popup engines
if ( !function_exists( 'sweet_dessert_get_list_popup_engines' ) ) {
	function sweet_dessert_get_list_popup_engines($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_popup_engines'))=='') {
			$list = array(
				"pretty"	=> esc_html__("Pretty photo", 'sweet-dessert'),
				"magnific"	=> esc_html__("Magnific popup", 'sweet-dessert')
				);
			$list = apply_filters('sweet_dessert_filter_list_popup_engines', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_popup_engines', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_menus' ) ) {
	function sweet_dessert_get_list_menus($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_menus'))=='') {
			$list = array();
			$list['default'] = esc_html__("Default", 'sweet-dessert');
			$menus = wp_get_nav_menus();
			if (is_array($menus) && count($menus) > 0) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_menus', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'sweet_dessert_get_list_sidebars' ) ) {
	function sweet_dessert_get_list_sidebars($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_sidebars'))=='') {
			if (($list = sweet_dessert_storage_get('registered_sidebars'))=='') $list = array();
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_sidebars', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'sweet_dessert_get_list_sidebars_positions' ) ) {
	function sweet_dessert_get_list_sidebars_positions($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_sidebars_positions'))=='') {
			$list = array(
				'none'  => esc_html__('Hide',  'sweet-dessert'),
				'left'  => esc_html__('Left',  'sweet-dessert'),
				'right' => esc_html__('Right', 'sweet-dessert')
				);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_sidebars_positions', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return sidebars class
if ( !function_exists( 'sweet_dessert_get_sidebar_class' ) ) {
	function sweet_dessert_get_sidebar_class() {
		$sb_main = sweet_dessert_get_custom_option('show_sidebar_main');
		$sb_outer = sweet_dessert_get_custom_option('show_sidebar_outer');
		return (sweet_dessert_param_is_off($sb_main) ? 'sidebar_hide' : 'sidebar_show sidebar_'.($sb_main))
				. ' ' . (sweet_dessert_param_is_off($sb_outer) ? 'sidebar_outer_hide' : 'sidebar_outer_show sidebar_outer_'.($sb_outer));
	}
}

// Return body styles list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_body_styles' ) ) {
	function sweet_dessert_get_list_body_styles($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_body_styles'))=='') {
			$list = array(
				'boxed'	=> esc_html__('Boxed',		'sweet-dessert'),
				'wide'	=> esc_html__('Wide',		'sweet-dessert')
				);
			if (sweet_dessert_get_theme_setting('allow_fullscreen')) {
				$list['fullwide']	= esc_html__('Fullwide',	'sweet-dessert');
				$list['fullscreen']	= esc_html__('Fullscreen',	'sweet-dessert');
			}
			$list = apply_filters('sweet_dessert_filter_list_body_styles', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_body_styles', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return templates list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_templates' ) ) {
	function sweet_dessert_get_list_templates($mode='') {
		if (($list = sweet_dessert_storage_get('list_templates_'.($mode)))=='') {
			$list = array();
			$tpl = sweet_dessert_storage_get('registered_templates');
			if (is_array($tpl) && count($tpl) > 0) {
				foreach ($tpl as $k=>$v) {
					if ($mode=='' || in_array($mode, explode(',', $v['mode'])))
						$list[$k] = !empty($v['icon']) 
									? $v['icon'] 
									: (!empty($v['title']) 
										? $v['title'] 
										: sweet_dessert_strtoproper($v['layout'])
										);
				}
			}
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_templates_'.($mode), $list);
		}
		return $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_templates_blog' ) ) {
	function sweet_dessert_get_list_templates_blog($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_templates_blog'))=='') {
			$list = sweet_dessert_get_list_templates('blog');
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_templates_blog', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return blogger styles list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_templates_blogger' ) ) {
	function sweet_dessert_get_list_templates_blogger($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_templates_blogger'))=='') {
			$list = sweet_dessert_array_merge(sweet_dessert_get_list_templates('blogger'), sweet_dessert_get_list_templates('blog'));
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_templates_blogger', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return single page styles list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_templates_single' ) ) {
	function sweet_dessert_get_list_templates_single($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_templates_single'))=='') {
			$list = sweet_dessert_get_list_templates('single');
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_templates_single', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return header styles list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_templates_header' ) ) {
	function sweet_dessert_get_list_templates_header($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_templates_header'))=='') {
			$list = sweet_dessert_get_list_templates('header');
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_templates_header', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return form styles list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_templates_forms' ) ) {
	function sweet_dessert_get_list_templates_forms($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_templates_forms'))=='') {
			$list = sweet_dessert_get_list_templates('forms');
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_templates_forms', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return article styles list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_article_styles' ) ) {
	function sweet_dessert_get_list_article_styles($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_article_styles'))=='') {
			$list = array(
				"boxed"   => esc_html__('Boxed', 'sweet-dessert'),
				"stretch" => esc_html__('Stretch', 'sweet-dessert')
				);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_article_styles', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return post-formats filters list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_post_formats_filters' ) ) {
	function sweet_dessert_get_list_post_formats_filters($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_post_formats_filters'))=='') {
			$list = array(
				"no"      => esc_html__('All posts', 'sweet-dessert'),
				"thumbs"  => esc_html__('With thumbs', 'sweet-dessert'),
				"reviews" => esc_html__('With reviews', 'sweet-dessert'),
				"video"   => esc_html__('With videos', 'sweet-dessert'),
				"audio"   => esc_html__('With audios', 'sweet-dessert'),
				"gallery" => esc_html__('With galleries', 'sweet-dessert')
				);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_post_formats_filters', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return portfolio filters list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_portfolio_filters' ) ) {
	function sweet_dessert_get_list_portfolio_filters($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_portfolio_filters'))=='') {
			$list = array(
				"hide"		=> esc_html__('Hide', 'sweet-dessert'),
				"tags"		=> esc_html__('Tags', 'sweet-dessert'),
				"categories"=> esc_html__('Categories', 'sweet-dessert')
				);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_portfolio_filters', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return hover styles list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_hovers' ) ) {
	function sweet_dessert_get_list_hovers($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_hovers'))=='') {
			$list = array();
			$list['circle effect1']  = esc_html__('Circle Effect 1',  'sweet-dessert');
			$list['circle effect2']  = esc_html__('Circle Effect 2',  'sweet-dessert');
			$list['circle effect3']  = esc_html__('Circle Effect 3',  'sweet-dessert');
			$list['circle effect4']  = esc_html__('Circle Effect 4',  'sweet-dessert');
			$list['circle effect5']  = esc_html__('Circle Effect 5',  'sweet-dessert');
			$list['circle effect6']  = esc_html__('Circle Effect 6',  'sweet-dessert');
			$list['circle effect7']  = esc_html__('Circle Effect 7',  'sweet-dessert');
			$list['circle effect8']  = esc_html__('Circle Effect 8',  'sweet-dessert');
			$list['circle effect9']  = esc_html__('Circle Effect 9',  'sweet-dessert');
			$list['circle effect10'] = esc_html__('Circle Effect 10',  'sweet-dessert');
			$list['circle effect11'] = esc_html__('Circle Effect 11',  'sweet-dessert');
			$list['circle effect12'] = esc_html__('Circle Effect 12',  'sweet-dessert');
			$list['circle effect13'] = esc_html__('Circle Effect 13',  'sweet-dessert');
			$list['circle effect14'] = esc_html__('Circle Effect 14',  'sweet-dessert');
			$list['circle effect15'] = esc_html__('Circle Effect 15',  'sweet-dessert');
			$list['circle effect16'] = esc_html__('Circle Effect 16',  'sweet-dessert');
			$list['circle effect17'] = esc_html__('Circle Effect 17',  'sweet-dessert');
			$list['circle effect18'] = esc_html__('Circle Effect 18',  'sweet-dessert');
			$list['circle effect19'] = esc_html__('Circle Effect 19',  'sweet-dessert');
			$list['circle effect20'] = esc_html__('Circle Effect 20',  'sweet-dessert');
			$list['square effect1']  = esc_html__('Square Effect 1',  'sweet-dessert');
			$list['square effect2']  = esc_html__('Square Effect 2',  'sweet-dessert');
			$list['square effect3']  = esc_html__('Square Effect 3',  'sweet-dessert');
			$list['square effect5']  = esc_html__('Square Effect 5',  'sweet-dessert');
			$list['square effect6']  = esc_html__('Square Effect 6',  'sweet-dessert');
			$list['square effect7']  = esc_html__('Square Effect 7',  'sweet-dessert');
			$list['square effect8']  = esc_html__('Square Effect 8',  'sweet-dessert');
			$list['square effect9']  = esc_html__('Square Effect 9',  'sweet-dessert');
			$list['square effect10'] = esc_html__('Square Effect 10',  'sweet-dessert');
			$list['square effect11'] = esc_html__('Square Effect 11',  'sweet-dessert');
			$list['square effect12'] = esc_html__('Square Effect 12',  'sweet-dessert');
			$list['square effect13'] = esc_html__('Square Effect 13',  'sweet-dessert');
			$list['square effect14'] = esc_html__('Square Effect 14',  'sweet-dessert');
			$list['square effect15'] = esc_html__('Square Effect 15',  'sweet-dessert');
			$list['square effect_dir']   = esc_html__('Square Effect Dir',   'sweet-dessert');
			$list['square effect_shift'] = esc_html__('Square Effect Shift', 'sweet-dessert');
			$list['square effect_book']  = esc_html__('Square Effect Book',  'sweet-dessert');
			$list['square effect_more']  = esc_html__('Square Effect More',  'sweet-dessert');
			$list['square effect_fade']  = esc_html__('Square Effect Fade',  'sweet-dessert');
			$list['square effect_pull']  = esc_html__('Square Effect Pull',  'sweet-dessert');
			$list['square effect_slide'] = esc_html__('Square Effect Slide', 'sweet-dessert');
			$list['square effect_border'] = esc_html__('Square Effect Border', 'sweet-dessert');
			$list = apply_filters('sweet_dessert_filter_portfolio_hovers', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_hovers', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the blog counters
if ( !function_exists( 'sweet_dessert_get_list_blog_counters' ) ) {
	function sweet_dessert_get_list_blog_counters($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_blog_counters'))=='') {
			$list = array(
				'views'		=> esc_html__('Views', 'sweet-dessert'),
				'likes'		=> esc_html__('Likes', 'sweet-dessert'),
				'rating'	=> esc_html__('Rating', 'sweet-dessert'),
				'comments'	=> esc_html__('Comments', 'sweet-dessert')
				);
			$list = apply_filters('sweet_dessert_filter_list_blog_counters', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_blog_counters', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list of the item sizes for the portfolio alter style, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_alter_sizes' ) ) {
	function sweet_dessert_get_list_alter_sizes($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_alter_sizes'))=='') {
			$list = array(
					'1_1' => esc_html__('1x1', 'sweet-dessert'),
					'1_2' => esc_html__('1x2', 'sweet-dessert'),
					'2_1' => esc_html__('2x1', 'sweet-dessert'),
					'2_2' => esc_html__('2x2', 'sweet-dessert'),
					'1_3' => esc_html__('1x3', 'sweet-dessert'),
					'2_3' => esc_html__('2x3', 'sweet-dessert'),
					'3_1' => esc_html__('3x1', 'sweet-dessert'),
					'3_2' => esc_html__('3x2', 'sweet-dessert'),
					'3_3' => esc_html__('3x3', 'sweet-dessert')
					);
			$list = apply_filters('sweet_dessert_filter_portfolio_alter_sizes', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_alter_sizes', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return extended hover directions list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_hovers_directions' ) ) {
	function sweet_dessert_get_list_hovers_directions($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_hovers_directions'))=='') {
			$list = array(
				'left_to_right' => esc_html__('Left to Right',  'sweet-dessert'),
				'right_to_left' => esc_html__('Right to Left',  'sweet-dessert'),
				'top_to_bottom' => esc_html__('Top to Bottom',  'sweet-dessert'),
				'bottom_to_top' => esc_html__('Bottom to Top',  'sweet-dessert'),
				'scale_up'      => esc_html__('Scale Up',  'sweet-dessert'),
				'scale_down'    => esc_html__('Scale Down',  'sweet-dessert'),
				'scale_down_up' => esc_html__('Scale Down-Up',  'sweet-dessert'),
				'from_left_and_right' => esc_html__('From Left and Right',  'sweet-dessert'),
				'from_top_and_bottom' => esc_html__('From Top and Bottom',  'sweet-dessert')
			);
			$list = apply_filters('sweet_dessert_filter_portfolio_hovers_directions', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_hovers_directions', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the label positions in the custom forms
if ( !function_exists( 'sweet_dessert_get_list_label_positions' ) ) {
	function sweet_dessert_get_list_label_positions($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_label_positions'))=='') {
			$list = array(
				'top'		=> esc_html__('Top',		'sweet-dessert'),
				'bottom'	=> esc_html__('Bottom',		'sweet-dessert'),
				'left'		=> esc_html__('Left',		'sweet-dessert'),
				'over'		=> esc_html__('Over',		'sweet-dessert')
			);
			$list = apply_filters('sweet_dessert_filter_label_positions', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_label_positions', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the bg image positions
if ( !function_exists( 'sweet_dessert_get_list_bg_image_positions' ) ) {
	function sweet_dessert_get_list_bg_image_positions($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_bg_image_positions'))=='') {
			$list = array(
				'left top'	   => esc_html__('Left Top', 'sweet-dessert'),
				'center top'   => esc_html__("Center Top", 'sweet-dessert'),
				'right top'    => esc_html__("Right Top", 'sweet-dessert'),
				'left center'  => esc_html__("Left Center", 'sweet-dessert'),
				'center center'=> esc_html__("Center Center", 'sweet-dessert'),
				'right center' => esc_html__("Right Center", 'sweet-dessert'),
				'left bottom'  => esc_html__("Left Bottom", 'sweet-dessert'),
				'center bottom'=> esc_html__("Center Bottom", 'sweet-dessert'),
				'right bottom' => esc_html__("Right Bottom", 'sweet-dessert')
			);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_bg_image_positions', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the bg image repeat
if ( !function_exists( 'sweet_dessert_get_list_bg_image_repeats' ) ) {
	function sweet_dessert_get_list_bg_image_repeats($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_bg_image_repeats'))=='') {
			$list = array(
				'repeat'	=> esc_html__('Repeat', 'sweet-dessert'),
				'repeat-x'	=> esc_html__('Repeat X', 'sweet-dessert'),
				'repeat-y'	=> esc_html__('Repeat Y', 'sweet-dessert'),
				'no-repeat'	=> esc_html__('No Repeat', 'sweet-dessert')
			);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_bg_image_repeats', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the bg image attachment
if ( !function_exists( 'sweet_dessert_get_list_bg_image_attachments' ) ) {
	function sweet_dessert_get_list_bg_image_attachments($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_bg_image_attachments'))=='') {
			$list = array(
				'scroll'	=> esc_html__('Scroll', 'sweet-dessert'),
				'fixed'		=> esc_html__('Fixed', 'sweet-dessert'),
				'local'		=> esc_html__('Local', 'sweet-dessert')
			);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_bg_image_attachments', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}


// Return list of the bg tints
if ( !function_exists( 'sweet_dessert_get_list_bg_tints' ) ) {
	function sweet_dessert_get_list_bg_tints($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_bg_tints'))=='') {
			$list = array(
				'white'	=> esc_html__('White', 'sweet-dessert'),
				'light'	=> esc_html__('Light', 'sweet-dessert'),
				'dark'	=> esc_html__('Dark', 'sweet-dessert')
			);
			$list = apply_filters('sweet_dessert_filter_bg_tints', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_bg_tints', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return custom fields types list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_field_types' ) ) {
	function sweet_dessert_get_list_field_types($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_field_types'))=='') {
			$list = array(
				'text'     => esc_html__('Text',  'sweet-dessert'),
				'textarea' => esc_html__('Text Area','sweet-dessert'),
				'password' => esc_html__('Password',  'sweet-dessert'),
				'radio'    => esc_html__('Radio',  'sweet-dessert'),
				'checkbox' => esc_html__('Checkbox',  'sweet-dessert'),
				'select'   => esc_html__('Select',  'sweet-dessert'),
				'date'     => esc_html__('Date','sweet-dessert'),
				'time'     => esc_html__('Time','sweet-dessert'),
				'button'   => esc_html__('Button','sweet-dessert')
			);
			$list = apply_filters('sweet_dessert_filter_field_types', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_field_types', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return Google map styles
if ( !function_exists( 'sweet_dessert_get_list_googlemap_styles' ) ) {
	function sweet_dessert_get_list_googlemap_styles($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_googlemap_styles'))=='') {
			$list = array(
				'default' => esc_html__('Default', 'sweet-dessert')
			);
			$list = apply_filters('sweet_dessert_filter_googlemap_styles', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_googlemap_styles', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'sweet_dessert_get_list_icons' ) ) {
	function sweet_dessert_get_list_icons($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_icons'))=='') {
			$list = sweet_dessert_parse_icons_classes(sweet_dessert_get_file_dir("css/fontello/css/fontello-codes.css"));
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_icons', $list);
		}
		return $prepend_inherit ? array_merge(array('inherit'), $list) : $list;
	}
}

// Return socials list
if ( !function_exists( 'sweet_dessert_get_list_socials' ) ) {
	function sweet_dessert_get_list_socials($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_socials'))=='') {
			$list = sweet_dessert_get_list_images("images/socials", "png");
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_socials', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with 'Yes' and 'No' items
if ( !function_exists( 'sweet_dessert_get_list_yesno' ) ) {
	function sweet_dessert_get_list_yesno($prepend_inherit=false) {
		$list = array(
			'yes' => esc_html__("Yes", 'sweet-dessert'),
			'no'  => esc_html__("No", 'sweet-dessert')
		);
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'sweet_dessert_get_list_onoff' ) ) {
	function sweet_dessert_get_list_onoff($prepend_inherit=false) {
		$list = array(
			"on" => esc_html__("On", 'sweet-dessert'),
			"off" => esc_html__("Off", 'sweet-dessert')
		);
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'sweet_dessert_get_list_showhide' ) ) {
	function sweet_dessert_get_list_showhide($prepend_inherit=false) {
		$list = array(
			"show" => esc_html__("Show", 'sweet-dessert'),
			"hide" => esc_html__("Hide", 'sweet-dessert')
		);
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with 'Ascending' and 'Descending' items
if ( !function_exists( 'sweet_dessert_get_list_orderings' ) ) {
	function sweet_dessert_get_list_orderings($prepend_inherit=false) {
		$list = array(
			"asc" => esc_html__("Ascending", 'sweet-dessert'),
			"desc" => esc_html__("Descending", 'sweet-dessert')
		);
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'sweet_dessert_get_list_directions' ) ) {
	function sweet_dessert_get_list_directions($prepend_inherit=false) {
		$list = array(
			"horizontal" => esc_html__("Horizontal", 'sweet-dessert'),
			"vertical" => esc_html__("Vertical", 'sweet-dessert')
		);
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with item's shapes
if ( !function_exists( 'sweet_dessert_get_list_shapes' ) ) {
	function sweet_dessert_get_list_shapes($prepend_inherit=false) {
		$list = array(
			"round"  => esc_html__("Round", 'sweet-dessert'),
			"square" => esc_html__("Square", 'sweet-dessert')
		);
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with item's sizes
if ( !function_exists( 'sweet_dessert_get_list_sizes' ) ) {
	function sweet_dessert_get_list_sizes($prepend_inherit=false) {
		$list = array(
			"tiny"   => esc_html__("Tiny", 'sweet-dessert'),
			"small"  => esc_html__("Small", 'sweet-dessert'),
			"medium" => esc_html__("Medium", 'sweet-dessert'),
			"large"  => esc_html__("Large", 'sweet-dessert')
		);
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with slider (scroll) controls positions
if ( !function_exists( 'sweet_dessert_get_list_controls' ) ) {
	function sweet_dessert_get_list_controls($prepend_inherit=false) {
		$list = array(
			"hide" => esc_html__("Hide", 'sweet-dessert'),
			"side" => esc_html__("Side", 'sweet-dessert'),
			"bottom" => esc_html__("Bottom", 'sweet-dessert')
		);
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with float items
if ( !function_exists( 'sweet_dessert_get_list_floats' ) ) {
	function sweet_dessert_get_list_floats($prepend_inherit=false) {
		$list = array(
			"none" => esc_html__("None", 'sweet-dessert'),
			"left" => esc_html__("Float Left", 'sweet-dessert'),
			"right" => esc_html__("Float Right", 'sweet-dessert')
		);
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with alignment items
if ( !function_exists( 'sweet_dessert_get_list_alignments' ) ) {
	function sweet_dessert_get_list_alignments($justify=false, $prepend_inherit=false) {
		$list = array(
			"none" => esc_html__("None", 'sweet-dessert'),
			"left" => esc_html__("Left", 'sweet-dessert'),
			"center" => esc_html__("Center", 'sweet-dessert'),
			"right" => esc_html__("Right", 'sweet-dessert')
		);
		if ($justify) $list["justify"] = esc_html__("Justify", 'sweet-dessert');
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with horizontal positions
if ( !function_exists( 'sweet_dessert_get_list_hpos' ) ) {
	function sweet_dessert_get_list_hpos($prepend_inherit=false, $center=false) {
		$list = array();
		$list['left'] = esc_html__("Left", 'sweet-dessert');
		if ($center) $list['center'] = esc_html__("Center", 'sweet-dessert');
		$list['right'] = esc_html__("Right", 'sweet-dessert');
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with vertical positions
if ( !function_exists( 'sweet_dessert_get_list_vpos' ) ) {
	function sweet_dessert_get_list_vpos($prepend_inherit=false, $center=false) {
		$list = array();
		$list['top'] = esc_html__("Top", 'sweet-dessert');
		if ($center) $list['center'] = esc_html__("Center", 'sweet-dessert');
		$list['bottom'] = esc_html__("Bottom", 'sweet-dessert');
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return sorting list items
if ( !function_exists( 'sweet_dessert_get_list_sortings' ) ) {
	function sweet_dessert_get_list_sortings($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_sortings'))=='') {
			$list = array(
				"date" => esc_html__("Date", 'sweet-dessert'),
				"title" => esc_html__("Alphabetically", 'sweet-dessert'),
				"views" => esc_html__("Popular (views count)", 'sweet-dessert'),
				"comments" => esc_html__("Most commented (comments count)", 'sweet-dessert'),
				"author_rating" => esc_html__("Author rating", 'sweet-dessert'),
				"users_rating" => esc_html__("Visitors (users) rating", 'sweet-dessert'),
				"random" => esc_html__("Random", 'sweet-dessert')
			);
			$list = apply_filters('sweet_dessert_filter_list_sortings', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_sortings', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list with columns widths
if ( !function_exists( 'sweet_dessert_get_list_columns' ) ) {
	function sweet_dessert_get_list_columns($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_columns'))=='') {
			$list = array(
				"none" => esc_html__("None", 'sweet-dessert'),
				"1_1" => esc_html__("100%", 'sweet-dessert'),
				"1_2" => esc_html__("1/2", 'sweet-dessert'),
				"1_3" => esc_html__("1/3", 'sweet-dessert'),
				"2_3" => esc_html__("2/3", 'sweet-dessert'),
				"1_4" => esc_html__("1/4", 'sweet-dessert'),
				"3_4" => esc_html__("3/4", 'sweet-dessert'),
				"1_5" => esc_html__("1/5", 'sweet-dessert'),
				"2_5" => esc_html__("2/5", 'sweet-dessert'),
				"3_5" => esc_html__("3/5", 'sweet-dessert'),
				"4_5" => esc_html__("4/5", 'sweet-dessert'),
				"1_6" => esc_html__("1/6", 'sweet-dessert'),
				"5_6" => esc_html__("5/6", 'sweet-dessert'),
				"1_7" => esc_html__("1/7", 'sweet-dessert'),
				"2_7" => esc_html__("2/7", 'sweet-dessert'),
				"3_7" => esc_html__("3/7", 'sweet-dessert'),
				"4_7" => esc_html__("4/7", 'sweet-dessert'),
				"5_7" => esc_html__("5/7", 'sweet-dessert'),
				"6_7" => esc_html__("6/7", 'sweet-dessert'),
				"1_8" => esc_html__("1/8", 'sweet-dessert'),
				"3_8" => esc_html__("3/8", 'sweet-dessert'),
				"5_8" => esc_html__("5/8", 'sweet-dessert'),
				"7_8" => esc_html__("7/8", 'sweet-dessert'),
				"1_9" => esc_html__("1/9", 'sweet-dessert'),
				"2_9" => esc_html__("2/9", 'sweet-dessert'),
				"4_9" => esc_html__("4/9", 'sweet-dessert'),
				"5_9" => esc_html__("5/9", 'sweet-dessert'),
				"7_9" => esc_html__("7/9", 'sweet-dessert'),
				"8_9" => esc_html__("8/9", 'sweet-dessert'),
				"1_10"=> esc_html__("1/10", 'sweet-dessert'),
				"3_10"=> esc_html__("3/10", 'sweet-dessert'),
				"7_10"=> esc_html__("7/10", 'sweet-dessert'),
				"9_10"=> esc_html__("9/10", 'sweet-dessert'),
				"1_11"=> esc_html__("1/11", 'sweet-dessert'),
				"2_11"=> esc_html__("2/11", 'sweet-dessert'),
				"3_11"=> esc_html__("3/11", 'sweet-dessert'),
				"4_11"=> esc_html__("4/11", 'sweet-dessert'),
				"5_11"=> esc_html__("5/11", 'sweet-dessert'),
				"6_11"=> esc_html__("6/11", 'sweet-dessert'),
				"7_11"=> esc_html__("7/11", 'sweet-dessert'),
				"8_11"=> esc_html__("8/11", 'sweet-dessert'),
				"9_11"=> esc_html__("9/11", 'sweet-dessert'),
				"10_11"=> esc_html__("10/11", 'sweet-dessert'),
				"1_12"=> esc_html__("1/12", 'sweet-dessert'),
				"5_12"=> esc_html__("5/12", 'sweet-dessert'),
				"7_12"=> esc_html__("7/12", 'sweet-dessert'),
				"10_12"=> esc_html__("10/12", 'sweet-dessert'),
				"11_12"=> esc_html__("11/12", 'sweet-dessert')
			);
			$list = apply_filters('sweet_dessert_filter_list_columns', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_columns', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return list of locations for the dedicated content
if ( !function_exists( 'sweet_dessert_get_list_dedicated_locations' ) ) {
	function sweet_dessert_get_list_dedicated_locations($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_dedicated_locations'))=='') {
			$list = array(
				"default" => esc_html__('As in the post defined', 'sweet-dessert'),
				"center"  => esc_html__('Above the text of the post', 'sweet-dessert'),
				"left"    => esc_html__('To the left the text of the post', 'sweet-dessert'),
				"right"   => esc_html__('To the right the text of the post', 'sweet-dessert'),
				"alter"   => esc_html__('Alternates for each post', 'sweet-dessert')
			);
			$list = apply_filters('sweet_dessert_filter_list_dedicated_locations', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_dedicated_locations', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return post-format name
if ( !function_exists( 'sweet_dessert_get_post_format_name' ) ) {
	function sweet_dessert_get_post_format_name($format, $single=true) {
		$name = '';
		if ($format=='gallery')		$name = $single ? esc_html__('gallery', 'sweet-dessert') : esc_html__('galleries', 'sweet-dessert');
		else if ($format=='video')	$name = $single ? esc_html__('video', 'sweet-dessert') : esc_html__('videos', 'sweet-dessert');
		else if ($format=='audio')	$name = $single ? esc_html__('audio', 'sweet-dessert') : esc_html__('audios', 'sweet-dessert');
		else if ($format=='image')	$name = $single ? esc_html__('image', 'sweet-dessert') : esc_html__('images', 'sweet-dessert');
		else if ($format=='quote')	$name = $single ? esc_html__('quote', 'sweet-dessert') : esc_html__('quotes', 'sweet-dessert');
		else if ($format=='link')	$name = $single ? esc_html__('link', 'sweet-dessert') : esc_html__('links', 'sweet-dessert');
		else if ($format=='status')	$name = $single ? esc_html__('status', 'sweet-dessert') : esc_html__('statuses', 'sweet-dessert');
		else if ($format=='aside')	$name = $single ? esc_html__('aside', 'sweet-dessert') : esc_html__('asides', 'sweet-dessert');
		else if ($format=='chat')	$name = $single ? esc_html__('chat', 'sweet-dessert') : esc_html__('chats', 'sweet-dessert');
		else						$name = $single ? esc_html__('standard', 'sweet-dessert') : esc_html__('standards', 'sweet-dessert');
		return apply_filters('sweet_dessert_filter_list_post_format_name', $name, $format);
	}
}

// Return post-format icon name (from Fontello library)
if ( !function_exists( 'sweet_dessert_get_post_format_icon' ) ) {
	function sweet_dessert_get_post_format_icon($format) {
		$icon = 'icon-';
		if ($format=='gallery')		$icon .= 'pictures';
		else if ($format=='video')	$icon .= 'video';
		else if ($format=='audio')	$icon .= 'note';
		else if ($format=='image')	$icon .= 'picture';
		else if ($format=='quote')	$icon .= 'quote';
		else if ($format=='link')	$icon .= 'link';
		else if ($format=='status')	$icon .= 'comment';
		else if ($format=='aside')	$icon .= 'doc-text';
		else if ($format=='chat')	$icon .= 'chat';
		else						$icon .= 'book-open';
		return apply_filters('sweet_dessert_filter_list_post_format_icon', $icon, $format);
	}
}

// Return fonts styles list, prepended inherit
if ( !function_exists( 'sweet_dessert_get_list_fonts_styles' ) ) {
	function sweet_dessert_get_list_fonts_styles($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_fonts_styles'))=='') {
			$list = array(
				'i' => esc_html__('I','sweet-dessert'),
				'u' => esc_html__('U', 'sweet-dessert')
			);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_fonts_styles', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return Google fonts list
if ( !function_exists( 'sweet_dessert_get_list_fonts' ) ) {
	function sweet_dessert_get_list_fonts($prepend_inherit=false) {
		if (($list = sweet_dessert_storage_get('list_fonts'))=='') {
			$list = array();
			$list = sweet_dessert_array_merge($list, sweet_dessert_get_list_font_faces());
			$list = sweet_dessert_array_merge($list, array(
				'Advent Pro' => array('family'=>'sans-serif'),
				'Alegreya Sans' => array('family'=>'sans-serif'),
				'Arimo' => array('family'=>'sans-serif'),
				'Asap' => array('family'=>'sans-serif'),
				'Averia Sans Libre' => array('family'=>'cursive'),
				'Averia Serif Libre' => array('family'=>'cursive'),
				'Bree Serif' => array('family'=>'serif',),
				'Cabin' => array('family'=>'sans-serif'),
				'Cabin Condensed' => array('family'=>'sans-serif'),
				'Caudex' => array('family'=>'serif'),
				'Comfortaa' => array('family'=>'cursive'),
				'Cousine' => array('family'=>'sans-serif'),
				'Crimson Text' => array('family'=>'serif'),
				'Cuprum' => array('family'=>'sans-serif'),
				'Dosis' => array('family'=>'sans-serif'),
				'Economica' => array('family'=>'sans-serif'),
				'Exo' => array('family'=>'sans-serif'),
				'Expletus Sans' => array('family'=>'cursive'),
				'Karla' => array('family'=>'sans-serif'),
				'Lato' => array('family'=>'sans-serif'),
				'Lekton' => array('family'=>'sans-serif'),
				'Lobster Two' => array('family'=>'cursive'),
				'Maven Pro' => array('family'=>'sans-serif'),
				'Merriweather' => array('family'=>'serif'),
				'Montserrat' => array('family'=>'sans-serif'),
				'Neuton' => array('family'=>'serif'),
				'Noticia Text' => array('family'=>'serif'),
				'Old Standard TT' => array('family'=>'serif'),
				'Open Sans' => array('family'=>'sans-serif'),
				'Orbitron' => array('family'=>'sans-serif'),
				'Oswald' => array('family'=>'sans-serif'),
				'Overlock' => array('family'=>'cursive'),
				'Oxygen' => array('family'=>'sans-serif'),
				'Philosopher' => array('family'=>'serif'),
				'PT Serif' => array('family'=>'serif'),
				'Puritan' => array('family'=>'sans-serif'),
				'Raleway' => array('family'=>'sans-serif'),
				'Roboto' => array('family'=>'sans-serif'),
				'Roboto Slab' => array('family'=>'sans-serif'),
				'Roboto Condensed' => array('family'=>'sans-serif'),
				'Rosario' => array('family'=>'sans-serif'),
				'Share' => array('family'=>'cursive'),
				'Signika' => array('family'=>'sans-serif'),
				'Signika Negative' => array('family'=>'sans-serif'),
				'Source Sans Pro' => array('family'=>'sans-serif'),
				'Tinos' => array('family'=>'serif'),
				'Ubuntu' => array('family'=>'sans-serif'),
				'Vollkorn' => array('family'=>'serif')
				)
			);
			$list = apply_filters('sweet_dessert_filter_list_fonts', $list);
			if (sweet_dessert_get_theme_setting('use_list_cache')) sweet_dessert_storage_set('list_fonts', $list);
		}
		return $prepend_inherit ? sweet_dessert_array_merge(array('inherit' => esc_html__("Inherit", 'sweet-dessert')), $list) : $list;
	}
}

// Return Custom font-face list
if ( !function_exists( 'sweet_dessert_get_list_font_faces' ) ) {
	function sweet_dessert_get_list_font_faces($prepend_inherit=false) {
		static $list = false;
		if (is_array($list)) return $list;
		$fonts = sweet_dessert_storage_get('required_custom_fonts');
		$list = array();
		if (is_array($fonts)) {
			foreach ($fonts as $font) {
				if (($url = sweet_dessert_get_file_url('css/font-face/'.trim($font).'/stylesheet.css'))!='') {
					$list[sprintf(esc_html__('%s (uploaded font)', 'sweet-dessert'), $font)] = array('css' => $url);
				}
			}
		}
		return $list;
	}
}
?>