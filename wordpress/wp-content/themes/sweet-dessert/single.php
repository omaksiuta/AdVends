<?php
/**
 * Single post
 */
get_header(); 

$single_style = sweet_dessert_storage_get('single_style');
if (empty($single_style)) $single_style = sweet_dessert_get_custom_option('single_style');

while ( have_posts() ) { the_post();
	sweet_dessert_show_post_layout(
		array(
			'layout' => $single_style,
			'sidebar' => !sweet_dessert_param_is_off(sweet_dessert_get_custom_option('show_sidebar_main')),
			'content' => sweet_dessert_get_template_property($single_style, 'need_content'),
			'terms_list' => sweet_dessert_get_template_property($single_style, 'need_terms')
		)
	);
}

get_footer();
?>