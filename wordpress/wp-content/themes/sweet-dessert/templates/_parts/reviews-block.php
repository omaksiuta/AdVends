<?php
// Get template args
extract(sweet_dessert_template_get_args('reviews-block'));

$reviews_markup = '';
if (($avg_author > 0 || $avg_users > 0) && sweet_dessert_param_is_on(sweet_dessert_get_custom_option('show_reviews'))) { 
	$reviews_first_author = sweet_dessert_get_theme_option('reviews_first')=='author';
	$reviews_second_hide = sweet_dessert_get_theme_option('reviews_second')=='hide';
	$use_tabs = !$reviews_second_hide;
	if ($use_tabs) wp_enqueue_script('jquery-ui-tabs', false, array('jquery','jquery-ui-core'), null, true);
	$max_level = max(5, (int) sweet_dessert_get_custom_option('reviews_max_level'));
	$allow_user_marks = (!$reviews_first_author || !$reviews_second_hide) && (!isset($_COOKIE['sweet_dessert_votes']) || sweet_dessert_strpos($_COOKIE['sweet_dessert_votes'], ','.($post_data['post_id']).',')===false) && (sweet_dessert_get_theme_option('reviews_can_vote')=='all' || is_user_logged_in());
	$reviews_markup = '<div class="reviews_block'.($use_tabs ? ' sc_tabs sc_tabs_style_2' : '').'">';
	$output = $marks = $users = '';
	if ($use_tabs) {
		$author_tab = '<li class="sc_tabs_title"><a href="#author_marks" class="theme_button">'.esc_html__('Author', 'sweet-dessert').'</a></li>';
		$users_tab = '<li class="sc_tabs_title"><a href="#users_marks" class="theme_button">'.esc_html__('Users', 'sweet-dessert').'</a></li>';
		$output .= '<ul class="sc_tabs_titles">' . ($reviews_first_author ? ($author_tab) . ($users_tab) : ($users_tab) . ($author_tab)) . '</ul>';
	}
	// Criterias list
	$field = array(
		"options" => sweet_dessert_get_theme_option('reviews_criterias')
	);
	if (!empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms) && is_array($post_data['post_terms'][$post_data['post_taxonomy']]->terms)) {
		foreach ($post_data['post_terms'][$post_data['post_taxonomy']]->terms as $cat) {
			$id = (int) $cat->term_id;
			$prop = sweet_dessert_taxonomy_get_inherited_property($post_data['post_taxonomy'], $id, 'reviews_criterias');
			if (!empty($prop) && !sweet_dessert_is_inherit_option($prop)) {
				$field['options'] = $prop;
				break;
			}
		}
	}
	// Author marks
	if ($reviews_first_author || !$reviews_second_hide) {
		$field["id"] = "reviews_marks_author";
		$field["descr"] = strip_tags($post_data['post_excerpt']);
		$field["accept"] = false;
		$marks = sweet_dessert_reviews_marks_to_display(sweet_dessert_reviews_marks_prepare(sweet_dessert_get_custom_option('reviews_marks'), count($field['options'])));
		$output .= '<div id="author_marks" class="sc_tabs_content">' . trim(sweet_dessert_reviews_get_markup($field, $marks, false, false, $reviews_first_author)) . '</div>';
	}
	// Users marks
	if (!$reviews_first_author || !$reviews_second_hide) {
		$marks = sweet_dessert_reviews_marks_to_display(sweet_dessert_reviews_marks_prepare(get_post_meta($post_data['post_id'], sweet_dessert_storage_get('options_prefix').'_reviews_marks2', true), count($field['options'])));
		$users = max(0, get_post_meta($post_data['post_id'], sweet_dessert_storage_get('options_prefix').'_reviews_users', true));
		$field["id"] = "reviews_marks_users";
		$field["descr"] = wp_kses_data( sprintf(__("Summary rating from <b>%s</b> user's marks.", 'sweet-dessert'), $users) 
									. ' ' 
                                    . ( !isset($_COOKIE['sweet_dessert_votes']) || sweet_dessert_strpos($_COOKIE['sweet_dessert_votes'], ','.($post_data['post_id']).',')===false
											? esc_html__('You can set own marks for this article - just click on stars above and press "Accept".', 'sweet-dessert')
                                            : esc_html__('Thanks for your vote!', 'sweet-dessert')
                                      ) );
		$field["accept"] = $allow_user_marks;
		$output .= '<div id="users_marks" class="sc_tabs_content"'.(!$output ? ' style="display: block;"' : '') . '>' . trim(sweet_dessert_reviews_get_markup($field, $marks, $allow_user_marks, false, !$reviews_first_author)) . '</div>';
	}
	$reviews_markup .= $output . '</div>';
	if ($allow_user_marks) {
		wp_enqueue_script('jquery-ui-draggable', false, array('jquery', 'jquery-ui-core'), null, true);
		sweet_dessert_storage_set_array('js_vars', 'reviews_allow_user_marks', $allow_user_marks);
		sweet_dessert_storage_set_array('js_vars', 'reviews_max_level', $max_level);
		sweet_dessert_storage_set_array('js_vars', 'reviews_levels', sweet_dessert_get_theme_option('reviews_criterias_levels'));
		sweet_dessert_storage_set_array('js_vars', 'reviews_vote', isset($_COOKIE['sweet_dessert_votes']) ? $_COOKIE['sweet_dessert_votes'] : '');
		sweet_dessert_storage_set_array('js_vars', 'reviews_marks', explode(',', $marks));
		sweet_dessert_storage_set_array('js_vars', 'reviews_users', max(0, $users));
		sweet_dessert_storage_set_array('js_vars', 'post_id', $post_data['post_id']);
	}
}
sweet_dessert_storage_set('reviews_markup', $reviews_markup);
?>