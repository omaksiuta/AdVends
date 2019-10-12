<?php 
if (is_singular()) {
	if (sweet_dessert_get_theme_option('use_ajax_views_counter')=='yes') {
		sweet_dessert_storage_set_array('js_vars', 'ajax_views_counter', array(
			'post_id' => get_the_ID(),
			'post_views' => sweet_dessert_get_post_views(get_the_ID())
		));
	} else
		sweet_dessert_set_post_views(get_the_ID());
}
?>