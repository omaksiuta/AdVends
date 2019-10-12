<?php
/**
 * Attachment page
 */
get_header(); 

while ( have_posts() ) { the_post();

	// Move sweet_dessert_set_post_views to the javascript - counter will work under cache system
	if (sweet_dessert_get_custom_option('use_ajax_views_counter')=='no') {
		sweet_dessert_set_post_views(get_the_ID());
	}

	sweet_dessert_show_post_layout(
		array(
			'layout' => 'attachment',
			'sidebar' => !sweet_dessert_param_is_off(sweet_dessert_get_custom_option('show_sidebar_main'))
		)
	);

}

get_footer();
?>