<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('sweet_dessert_sc_tooltip_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_sc_tooltip_theme_setup' );
	function sweet_dessert_sc_tooltip_theme_setup() {
		add_action('sweet_dessert_action_shortcodes_list', 		'sweet_dessert_sc_tooltip_reg_shortcodes');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_tooltip id="unique_id" title="Tooltip text here"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/tooltip]
*/

if (!function_exists('sweet_dessert_sc_tooltip')) {	
	function sweet_dessert_sc_tooltip($atts, $content=null){	
		if (sweet_dessert_in_shortcode_blogger()) return '';
		extract(sweet_dessert_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
		), $atts)));
		$output = '<span' . ($id ? ' id="'.esc_attr($id).'"' : '') 
					. ' class="sc_tooltip_parent'. (!empty($class) ? ' '.esc_attr($class) : '').'"'
					. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
					. '>'
						. do_shortcode($content)
						. '<span class="sc_tooltip">' . ($title) . '</span>'
					. '</span>';
		return apply_filters('sweet_dessert_shortcode_output', $output, 'trx_tooltip', $atts, $content);
	}
	sweet_dessert_require_shortcode('trx_tooltip', 'sweet_dessert_sc_tooltip');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_tooltip_reg_shortcodes' ) ) {
	function sweet_dessert_sc_tooltip_reg_shortcodes() {
	
		sweet_dessert_sc_map("trx_tooltip", array(
			"title" => esc_html__("Tooltip", 'trx_utils'),
			"desc" => wp_kses_data( __("Create tooltip for selected text", 'trx_utils') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"title" => array(
					"title" => esc_html__("Title", 'trx_utils'),
					"desc" => wp_kses_data( __("Tooltip title (required)", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"_content_" => array(
					"title" => esc_html__("Tipped content", 'trx_utils'),
					"desc" => wp_kses_data( __("Highlighted content with tooltip", 'trx_utils') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"id" => sweet_dessert_get_sc_param('id'),
				"class" => sweet_dessert_get_sc_param('class'),
				"css" => sweet_dessert_get_sc_param('css')
			)
		));
	}
}
?>