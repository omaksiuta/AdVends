<?php
if (!function_exists('sweet_dessert_theme_shortcodes_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_theme_shortcodes_setup', 1 );
	function sweet_dessert_theme_shortcodes_setup() {
		add_filter('sweet_dessert_filter_googlemap_styles', 'sweet_dessert_theme_shortcodes_googlemap_styles');
	}
}


// Add theme-specific Google map styles
if ( !function_exists( 'sweet_dessert_theme_shortcodes_googlemap_styles' ) ) {
	function sweet_dessert_theme_shortcodes_googlemap_styles($list) {
		$list['simple']		= esc_html__('Simple', 'trx_utils');
		$list['greyscale']	= esc_html__('Greyscale', 'trx_utils');
		$list['inverse']	= esc_html__('Inverse', 'trx_utils');
		$list['apple']		= esc_html__('Apple', 'trx_utils');
		return $list;
	}
}
?>