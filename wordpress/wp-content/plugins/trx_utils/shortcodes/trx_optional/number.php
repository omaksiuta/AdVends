<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('sweet_dessert_sc_number_theme_setup')) {
	add_action( 'sweet_dessert_action_before_init_theme', 'sweet_dessert_sc_number_theme_setup' );
	function sweet_dessert_sc_number_theme_setup() {
		add_action('sweet_dessert_action_shortcodes_list', 		'sweet_dessert_sc_number_reg_shortcodes');
		if (function_exists('sweet_dessert_exists_visual_composer') && sweet_dessert_exists_visual_composer())
			add_action('sweet_dessert_action_shortcodes_list_vc','sweet_dessert_sc_number_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_number id="unique_id" value="400"]
*/

if (!function_exists('sweet_dessert_sc_number')) {	
	function sweet_dessert_sc_number($atts, $content=null){	
		if (sweet_dessert_in_shortcode_blogger()) return '';
		extract(sweet_dessert_html_decode(shortcode_atts(array(
			// Individual params
			"value" => "",
			"align" => "",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . sweet_dessert_get_css_position_as_classes($top, $right, $bottom, $left);
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_number' 
					. (!empty($align) ? ' align'.esc_attr($align) : '') 
					. (!empty($class) ? ' '.esc_attr($class) : '') 
					. '"'
				. (!sweet_dessert_param_is_off($animation) ? ' data-animation="'.esc_attr(sweet_dessert_get_animation_classes($animation)).'"' : '')
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
				. '>';
		for ($i=0; $i < sweet_dessert_strlen($value); $i++) {
			$output .= '<span class="sc_number_item">' . trim(sweet_dessert_substr($value, $i, 1)) . '</span>';
		}
		$output .= '</div>';
		return apply_filters('sweet_dessert_shortcode_output', $output, 'trx_number', $atts, $content);
	}
	sweet_dessert_require_shortcode('trx_number', 'sweet_dessert_sc_number');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_number_reg_shortcodes' ) ) {
	function sweet_dessert_sc_number_reg_shortcodes() {
	
		sweet_dessert_sc_map("trx_number", array(
			"title" => esc_html__("Number", 'trx_utils'),
			"desc" => wp_kses_data( __("Insert number or any word as set separate characters", 'trx_utils') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"value" => array(
					"title" => esc_html__("Value", 'trx_utils'),
					"desc" => wp_kses_data( __("Number or any word", 'trx_utils') ),
					"value" => "",
					"type" => "text"
				),
				"align" => array(
					"title" => esc_html__("Align", 'trx_utils'),
					"desc" => wp_kses_data( __("Select block alignment", 'trx_utils') ),
					"value" => "none",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => sweet_dessert_get_sc_param('align')
				),
				"top" => sweet_dessert_get_sc_param('top'),
				"bottom" => sweet_dessert_get_sc_param('bottom'),
				"left" => sweet_dessert_get_sc_param('left'),
				"right" => sweet_dessert_get_sc_param('right'),
				"id" => sweet_dessert_get_sc_param('id'),
				"class" => sweet_dessert_get_sc_param('class'),
				"animation" => sweet_dessert_get_sc_param('animation'),
				"css" => sweet_dessert_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'sweet_dessert_sc_number_reg_shortcodes_vc' ) ) {
	function sweet_dessert_sc_number_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_number",
			"name" => esc_html__("Number", 'trx_utils'),
			"description" => wp_kses_data( __("Insert number or any word as set of separated characters", 'trx_utils') ),
			"category" => esc_html__('Content', 'trx_utils'),
			"class" => "trx_sc_single trx_sc_number",
			'icon' => 'icon_trx_number',
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "value",
					"heading" => esc_html__("Value", 'trx_utils'),
					"description" => wp_kses_data( __("Number or any word to separate", 'trx_utils') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment", 'trx_utils'),
					"description" => wp_kses_data( __("Select block alignment", 'trx_utils') ),
					"class" => "",
					"value" => array_flip(sweet_dessert_get_sc_param('align')),
					"type" => "dropdown"
				),
				sweet_dessert_get_vc_param('id'),
				sweet_dessert_get_vc_param('class'),
				sweet_dessert_get_vc_param('animation'),
				sweet_dessert_get_vc_param('css'),
				sweet_dessert_get_vc_param('margin_top'),
				sweet_dessert_get_vc_param('margin_bottom'),
				sweet_dessert_get_vc_param('margin_left'),
				sweet_dessert_get_vc_param('margin_right')
			)
		) );
		
		class WPBakeryShortCode_Trx_Number extends Sweet_Dessert_VC_ShortCodeSingle {}
	}
}
?>