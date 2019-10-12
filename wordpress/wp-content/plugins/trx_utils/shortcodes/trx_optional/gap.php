<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('sweet_dessert_sc_gap_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_sc_gap_theme_setup' );
	function sweet_dessert_sc_gap_theme_setup() {
		add_action('sweet_dessert_action_shortcodes_list', 		'sweet_dessert_sc_gap_reg_shortcodes');
		if (function_exists('sweet_dessert_exists_visual_composer') && sweet_dessert_exists_visual_composer())
			add_action('sweet_dessert_action_shortcodes_list_vc','sweet_dessert_sc_gap_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

//[trx_gap]Fullwidth content[/trx_gap]

if (!function_exists('sweet_dessert_sc_gap')) {	
	function sweet_dessert_sc_gap($atts, $content = null) {
		if (sweet_dessert_in_shortcode_blogger()) return '';
		$output = sweet_dessert_gap_start() . do_shortcode($content) . sweet_dessert_gap_end();
		return apply_filters('sweet_dessert_shortcode_output', $output, 'trx_gap', $atts, $content);
	}
	sweet_dessert_require_shortcode("trx_gap", "sweet_dessert_sc_gap");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_gap_reg_shortcodes' ) ) {
	function sweet_dessert_sc_gap_reg_shortcodes() {
	
		sweet_dessert_sc_map("trx_gap", array(
			"title" => esc_html__("Gap", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert gap (fullwidth area) in the post content. Attention! Use the gap only in the posts (pages) without left or right sidebar", 'trx_utils') ),
			"decorate" => true,
			"container" => true,
			"params" => array(
				"_content_" => array(
					"title" => esc_html__("Gap content", 'trx_utils'),
					"desc" => wp_kses_data( __("Gap inner content", 'trx_utils') ),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				)
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_gap_reg_shortcodes_vc' ) ) {
	function sweet_dessert_sc_gap_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_gap",
			"name" => esc_html__("Gap", 'trx_utils'),
			"description" => wp_kses_data( __("Insert gap (fullwidth area) in the post content", 'trx_utils') ),
			"category" => esc_html__('Structure', 'trx_utils'),
			'icon' => 'icon_trx_gap',
			"class" => "trx_sc_collection trx_sc_gap",
			"content_element" => true,
			"is_container" => true,
			"show_settings_on_create" => false,
			"params" => array(
			)
		) );
		
		class WPBakeryShortCode_Trx_Gap extends Sweet_Dessert_VC_ShortCodeCollection {}
	}
}
?>